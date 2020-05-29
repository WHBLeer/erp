<?php
namespace TYPO3\CMS\SysAction;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Doctrine\DBAL\DBALException;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Database\Query\Restriction\HiddenRestriction;
use TYPO3\CMS\Core\Database\Query\Restriction\RootLevelRestriction;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Type\Bitmask\Permission;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\HttpUtility;

/**
 * This class provides a task for the taskcenter
 * @internal
 */
class ActionTask implements \TYPO3\CMS\Taskcenter\TaskInterface
{
    /**
     * @var \TYPO3\CMS\Taskcenter\Controller\TaskModuleController
     */
    protected $taskObject;

    /**
     * All hook objects get registered here for later use
     *
     * @var array
     */
    protected $hookObjects = [];

    /**
     * URL to task module
     *
     * @var string
     */
    protected $moduleUrl;

    /**
     * @var IconFactory
     */
    protected $iconFactory;

    /**
     * Constructor
     * @param \TYPO3\CMS\Taskcenter\Controller\TaskModuleController $taskObject
     */
    public function __construct(\TYPO3\CMS\Taskcenter\Controller\TaskModuleController $taskObject)
    {
        $this->iconFactory = GeneralUtility::makeInstance(IconFactory::class);
        /** @var \TYPO3\CMS\Backend\Routing\UriBuilder $uriBuilder */
        $uriBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Backend\Routing\UriBuilder::class);
        $this->moduleUrl = (string)$uriBuilder->buildUriFromRoute('user_task');
        $this->taskObject = $taskObject;
        $this->getLanguageService()->includeLLFile('EXT:sys_action/Resources/Private/Language/locallang.xlf');
        foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['sys_action']['tx_sysaction_task'] ?? [] as $className) {
            $this->hookObjects[] = GeneralUtility::makeInstance($className);
        }
    }

    /**
     * This method renders the task
     *
     * @return string The task as HTML
     */
    public function getTask()
    {
        $content = '';
        $show = (int)GeneralUtility::_GP('show');
        foreach ($this->hookObjects as $hookObject) {
            if (method_exists($hookObject, 'getTask')) {
                $show = $hookObject->getTask($show, $this);
            }
        }
        // If no task selected, render the menu
        if ($show == 0) {
            $content .= $this->taskObject->description($this->getLanguageService()->getLL('sys_action'), $this->getLanguageService()->getLL('description'));
            $content .= $this->renderActionList();
        } else {
            $record = BackendUtility::getRecord('sys_action', $show);
            // If the action is not found
            if (empty($record)) {
                $this->addMessage(
                    $this->getLanguageService()->getLL('action_error-not-found'),
                    $this->getLanguageService()->getLL('action_error'),
                    FlashMessage::ERROR
                );
            } else {
                // Render the task
                $content .= $this->taskObject->description($record['title'], $record['description']);
                // Output depends on the type
                switch ($record['type']) {
                    case 1:
                        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
                        $pageRenderer->loadRequireJsModule('TYPO3/CMS/SysAction/ActionTask');
                        $content .= $this->viewNewBackendUser($record);
                        break;
                    case 2:
                        $content .= $this->viewSqlQuery($record);
                        break;
                    case 3:
                        $content .= $this->viewRecordList($record);
                        break;
                    case 4:
                        $content .= $this->viewEditRecord($record);
                        break;
                    case 5:
                        $content .= $this->viewNewRecord($record);
                        break;
                    default:
                        $this->addMessage(
                            $this->getLanguageService()->getLL('action_noType'),
                            $this->getLanguageService()->getLL('action_error'),
                            FlashMessage::ERROR
                        );
                        $content .= $this->renderFlashMessages();
                }
            }
        }
        return $content;
    }

    /**
     * General overview over the task in the taskcenter menu
     *
     * @return string Overview as HTML
     */
    public function getOverview()
    {
        $content = '<p>' . htmlspecialchars($this->getLanguageService()->getLL('description')) . '</p>';
        // Get the actions
        $actionList = $this->getActions();
        if (!empty($actionList)) {
            $items = '';
            // Render a single action menu item
            foreach ($actionList as $action) {
                $active = GeneralUtility::_GP('show') === $action['uid'] ? 'active' : '';
                $items .= '<a class="list-group-item ' . $active . '" href="' . $action['link'] . '" title="' . htmlspecialchars($action['description']) . '">' . htmlspecialchars($action['title']) . '</a>';
            }
            $content .= '<div class="list-group">' . $items . '</div>';
        }
        return $content;
    }

    /**
     * Get all actions of an user. Admins can see any action, all others only those
     * which are allowed in sys_action record itself.
     *
     * @return array Array holding every needed information of a sys_action
     */
    protected function getActions()
    {
        $backendUser = $this->getBackendUser();
        $actionList = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_action');
        $queryBuilder->select('sys_action.*')
            ->from('sys_action');

        if (!empty($GLOBALS['TCA']['sys_action']['ctrl']['sortby'])) {
            $queryBuilder->orderBy('sys_action.' . $GLOBALS['TCA']['sys_action']['ctrl']['sortby']);
        }

        $queryBuilder->getRestrictions()
            ->removeAll()
            ->add(GeneralUtility::makeInstance(RootLevelRestriction::class, ['sys_action']));

        // Editors can only see the actions which are assigned to a usergroup they belong to
        if (!$backendUser->isAdmin()) {
            $groupList = $backendUser->groupList ?: '0';

            $queryBuilder->getRestrictions()
                ->add(GeneralUtility::makeInstance(HiddenRestriction::class));

            $queryBuilder
                ->join(
                    'sys_action',
                    'sys_action_asgr_mm',
                    'sys_action_asgr_mm',
                    $queryBuilder->expr()->eq(
                        'sys_action_asgr_mm.uid_local',
                        $queryBuilder->quoteIdentifier('sys_action.uid')
                    )
                )
                ->join(
                    'sys_action_asgr_mm',
                    'be_groups',
                    'be_groups',
                    $queryBuilder->expr()->eq(
                        'sys_action_asgr_mm.uid_foreign',
                        $queryBuilder->quoteIdentifier('be_groups.uid')
                    )
                )
                ->where(
                    $queryBuilder->expr()->in(
                        'be_groups.uid',
                        $queryBuilder->createNamedParameter(
                            GeneralUtility::intExplode(',', $groupList, true),
                            Connection::PARAM_INT_ARRAY
                        )
                    )
                )
                ->groupBy('sys_action.uid');
        }
        /** @var \TYPO3\CMS\Backend\Routing\UriBuilder $uriBuilder */
        $uriBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Backend\Routing\UriBuilder::class);
        $queryResult = $queryBuilder->execute();
        while ($actionRow = $queryResult->fetch()) {
            $editActionLink = '';

            // Admins are allowed to edit sys_action records
            if ($this->getBackendUser()->isAdmin()) {
                $uidEditArgument = 'edit[sys_action][' . (int)$actionRow['uid'] . ']';

                $link = (string)$uriBuilder->buildUriFromRoute(
                    'record_edit',
                    [
                        $uidEditArgument => 'edit',
                        'returnUrl' => GeneralUtility::getIndpEnv('REQUEST_URI')
                    ]
                );

                $title = $this->getLanguageService()->getLL('edit-sys_action');
                $icon = $this->iconFactory->getIcon('actions-open', Icon::SIZE_SMALL)->render();
                $editActionLink = '<a class="btn btn-default btn-sm" href="' . htmlspecialchars($link) . '" title="' . htmlspecialchars($title) . '">';
                $editActionLink .= $icon . ' ' . htmlspecialchars($title) . '</a>';
            }

            $actionList[] = [
                'uid' => 'actiontask' . $actionRow['uid'],
                'title' => $actionRow['title'],
                'description' => $actionRow['description'],
                'descriptionHtml' => (
                    $actionRow['description']
                        ? '<p>' . nl2br(htmlspecialchars($actionRow['description'])) . '</p>'
                        : ''
                ) . $editActionLink,
                'link' => $this->moduleUrl
                    . '&SET[function]=sys_action.'
                    . self::class
                    . '&show='
                    . (int)$actionRow['uid']
            ];
        }

        return $actionList;
    }

    /**
     * Render the menu of sys_actions
     *
     * @return string List of sys_actions as HTML
     */
    protected function renderActionList()
    {
        $content = '';
        // Get the sys_action records
        $actionList = $this->getActions();
        // If any actions are found for the current users
        if (!empty($actionList)) {
            $content .= $this->taskObject->renderListMenu($actionList);
        } else {
            $this->addMessage(
                $this->getLanguageService()->getLL('action_not-found-description'),
                $this->getLanguageService()->getLL('action_not-found'),
                FlashMessage::INFO
            );
        }
        // Admin users can create a new action
        if ($this->getBackendUser()->isAdmin()) {
            /** @var \TYPO3\CMS\Backend\Routing\UriBuilder $uriBuilder */
            $uriBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Backend\Routing\UriBuilder::class);
            $link = (string)$uriBuilder->buildUriFromRoute(
                'record_edit',
                [
                    'edit[sys_action][0]' => 'new',
                    'returnUrl' => $this->moduleUrl
                ]
            );

            $title = $this->getLanguageService()->getLL('new-sys_action');
            $content .= '<p>' .
                '<a class="btn btn-default" href="' . htmlspecialchars($link) . '" title="' . htmlspecialchars($title) . '">' .
                $this->iconFactory->getIcon('actions-add', Icon::SIZE_SMALL)->render() . ' ' . htmlspecialchars($title) .
                '</a></p>';
        }
        return $content;
    }

    /**
     * Action to create a new BE user
     *
     * @param array $record sys_action record
     * @return string form to create a new user
     */
    protected function viewNewBackendUser($record)
    {
        $content = '';
        $beRec = BackendUtility::getRecord('be_users', (int)$record['t1_copy_of_user']);
        // A record is need which is used as copy for the new user
        if (!is_array($beRec)) {
            $this->addMessage(
                $this->getLanguageService()->getLL('action_notReady'),
                $this->getLanguageService()->getLL('action_error'),
                FlashMessage::ERROR
            );
            $content .= $this->renderFlashMessages();
            return $content;
        }
        $vars = GeneralUtility::_POST('data');
        $key = 'NEW';
        if ($vars['sent'] == 1) {
            $errors = [];
            // Basic error checks
            if (!empty($vars['email']) && !GeneralUtility::validEmail($vars['email'])) {
                $errors[] = $this->getLanguageService()->getLL('error-wrong-email');
            }
            if (empty($vars['username'])) {
                $errors[] = $this->getLanguageService()->getLL('error-username-empty');
            }
            if ($vars['key'] === 'NEW' && empty($vars['password'])) {
                $errors[] = $this->getLanguageService()->getLL('error-password-empty');
            }
            if ($vars['key'] !== 'NEW' && !$this->isCreatedByUser($vars['key'], $record)) {
                $errors[] = $this->getLanguageService()->getLL('error-wrong-user');
            }
            foreach ($this->hookObjects as $hookObject) {
                if (method_exists($hookObject, 'viewNewBackendUser_Error')) {
                    $errors = $hookObject->viewNewBackendUser_Error($vars, $errors, $this);
                }
            }
            // Show errors if there are any
            if (!empty($errors)) {
                $this->addMessage(
                    implode(LF, $errors),
                    $this->getLanguageService()->getLL('action_error'),
                    FlashMessage::ERROR
                );
            } else {
                // Save user
                $key = $this->saveNewBackendUser($record, $vars);
                // Success message
                $message = $vars['key'] === 'NEW'
                    ? $this->getLanguageService()->getLL('success-user-created')
                    : $this->getLanguageService()->getLL('success-user-updated');
                $this->addMessage(
                    $message,
                    $this->getLanguageService()->getLL('success')
                );
            }
            $content .= $this->renderFlashMessages();
        }
        // Load BE user to edit
        if ((int)GeneralUtility::_GP('be_users_uid') > 0) {
            $tmpUserId = (int)GeneralUtility::_GP('be_users_uid');
            // Check if the selected user is created by the current user
            $rawRecord = $this->isCreatedByUser($tmpUserId, $record);
            if ($rawRecord) {
                // Delete user
                if (GeneralUtility::_GP('delete') == 1) {
                    $this->deleteUser($tmpUserId, $record['uid']);
                }
                $key = $tmpUserId;
                $vars = $rawRecord;
            }
        }
        $content .= '<form action="" class="panel panel-default" method="post" enctype="multipart/form-data">
                        <fieldset class="form-section">
                            <h4 class="form-section-headline">' . htmlspecialchars($this->getLanguageService()->getLL('action_t1_legend_generalFields')) . '</h4>
                            <div class="form-group">
                                <label for="field_disable">' . htmlspecialchars($this->getLanguageService()->sL('LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.disable')) . '</label>
                                <input type="checkbox" id="field_disable" name="data[disable]" value="1" class="checkbox" ' . ($vars['disable'] == 1 ? ' checked="checked" ' : '') . ' />
                            </div>
                            <div class="form-group">
                                <label for="field_realname">' . htmlspecialchars($this->getLanguageService()->sL('LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.name')) . '</label>
                                <input type="text" id="field_realname" class="form-control" name="data[realName]" value="' . htmlspecialchars($vars['realName']) . '" />
                            </div>
                            <div class="form-group">
                                <label for="field_username">' . htmlspecialchars($this->getLanguageService()->sL('LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:be_users.username')) . '</label>
                                <input type="text" id="field_username" class="form-control" name="data[username]" value="' . htmlspecialchars($vars['username']) . '" />
                            </div>
                            <div class="form-group">
                                <label for="field_password">' . htmlspecialchars($this->getLanguageService()->sL('LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:be_users.password')) . '</label>
                                <input type="password" id="field_password" class="form-control" name="data[password]" value="" />
                            </div>
                            <div class="form-group">
                                <label for="field_email">' . htmlspecialchars($this->getLanguageService()->sL('LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.email')) . '</label>
                                <input type="text" id="field_email" class="form-control" name="data[email]" value="' . htmlspecialchars($vars['email']) . '" />
                            </div>
                        </fieldset>
                        <fieldset class="form-section">
                            <h4 class="form-section-headline">' . htmlspecialchars($this->getLanguageService()->getLL('action_t1_legend_configuration')) . '</h4>
                            <div class="form-group">
                                <label for="field_usergroup">' . htmlspecialchars($this->getLanguageService()->sL('LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:be_users.usergroup')) . '</label>
                                <select id="field_usergroup" class="form-control" name="data[usergroup][]" multiple="multiple">
                                    ' . $this->getUsergroups($record, $vars) . '
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="data[key]" value="' . $key . '" />
                                <input type="hidden" name="data[sent]" value="1" />
                                <input class="btn btn-default" type="submit" value="' . htmlspecialchars($this->getLanguageService()->getLL($key === 'NEW' ? 'action_Create' : 'action_Update')) . '" />
                            </div>
                        </fieldset>
                    </form>';
        $content .= $this->getCreatedUsers($record, $key);
        return $content;
    }

    /**
     * Delete a BE user and redirect to the action by its id
     *
     * @param int $userId Id of the BE user
     * @param int $actionId Id of the action
     */
    protected function deleteUser($userId, $actionId)
    {
        GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('be_users')->update(
            'be_users',
            ['deleted' => 1, 'tstamp' => (int)$GLOBALS['ACCESS_TIME']],
            ['uid' => (int)$userId]
        );

        // redirect to the original task
        HttpUtility::redirect($this->moduleUrl . '&show=' . (int)$actionId);
    }

    /**
     * Check if a BE user is created by the current user
     *
     * @param int $id Id of the BE user
     * @param array $action sys_action record.
     * @return mixed The record of the BE user if found, otherwise FALSE
     */
    protected function isCreatedByUser($id, $action)
    {
        $record = BackendUtility::getRecord('be_users', $id, '*', ' AND cruser_id=' . $this->getBackendUser()->user['uid'] . ' AND createdByAction=' . $action['uid']);
        if (is_array($record)) {
            return $record;
        }
        return false;
    }

    /**
     * Render all users who are created by the current BE user including a link to edit the record
     *
     * @param array $action sys_action record.
     * @param int $selectedUser Id of a selected user
     * @return string html list of users
     */
    protected function getCreatedUsers($action, $selectedUser)
    {
        $content = '';
        $userList = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('be_users');

        $queryBuilder->getRestrictions()
            ->removeAll()
            ->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        $res = $queryBuilder
            ->select('*')
            ->from('be_users')
            ->where(
                $queryBuilder->expr()->eq(
                    'cruser_id',
                    $queryBuilder->createNamedParameter($this->getBackendUser()->user['uid'], \PDO::PARAM_INT)
                ),
                $queryBuilder->expr()->eq(
                    'createdByAction',
                    $queryBuilder->createNamedParameter($action['uid'], \PDO::PARAM_INT)
                )
            )
            ->orderBy('username')
            ->execute();

        // Render the user records
        while ($row = $res->fetch()) {
            $icon = '<span title="' . htmlspecialchars('uid=' . $row['uid']) . '">' . $this->iconFactory->getIconForRecord('be_users', $row, Icon::SIZE_SMALL)->render() . '</span>';
            $line = $icon . $this->action_linkUserName($row['username'], $row['realName'], $action['uid'], $row['uid']);
            // Selected user
            if ($row['uid'] == $selectedUser) {
                $line = '<strong>' . $line . '</strong>';
            }
            $userList[] = '<li class="list-group-item">' . $line . '</li>';
        }

        // If any records found
        if (!empty($userList)) {
            $content .= '<div class="panel panel-default">';
            $content .= '<div class="panel-heading">';
            $content .= '<h3 class="panel-title">' . htmlspecialchars($this->getLanguageService()->getLL('action_t1_listOfUsers')) . '</h3>';
            $content .= '</div>';
            $content .= '<ul class="list-group">' . implode($userList) . '</ul>';
            $content .= '</div>';
        }
        return $content;
    }

    /**
     * Create a link to edit a user
     *
     * @param string $username Username
     * @param string $realName Real name of the user
     * @param int $sysActionUid Id of the sys_action record
     * @param int $userId Id of the user
     * @return string html link
     */
    protected function action_linkUserName($username, $realName, $sysActionUid, $userId)
    {
        if (!empty($realName)) {
            $username .= ' (' . $realName . ')';
        }
        // Link to update the user record
        $href = $this->moduleUrl . '&SET[function]=sys_action.TYPO3\\CMS\\SysAction\\ActionTask&show=' . (int)$sysActionUid . '&be_users_uid=' . (int)$userId;
        $link = '<a href="' . htmlspecialchars($href) . '">' . htmlspecialchars($username) . '</a>';
        // Link to delete the user record
        $link .= '
				<a href="' . htmlspecialchars($href . '&delete=1') . '" class="t3js-confirm-trigger" data-title="' . htmlspecialchars($this->getLanguageService()->getLL('lDelete_warning_title')) . '" data-message="' . htmlspecialchars($this->getLanguageService()->getLL('lDelete_warning')) . '">'
                    . $this->iconFactory->getIcon('actions-edit-delete', Icon::SIZE_SMALL)->render() .
                '</a>';
        return $link;
    }

    /**
     * Save/Update a BE user
     *
     * @param array $record Current action record
     * @param array $vars POST vars
     * @return int Id of the new/updated user
     */
    protected function saveNewBackendUser($record, $vars)
    {
        // Check if the usergroup is allowed
        $vars['usergroup'] = $this->fixUserGroup($vars['usergroup'], $record);
        $key = $vars['key'];
        $vars['password'] = trim($vars['password']);
        // Check if md5 is used as password encryption
        if ($vars['password'] !== '' && strpos($GLOBALS['TCA']['be_users']['columns']['password']['config']['eval'], 'md5') !== false) {
            $vars['password'] = md5($vars['password']);
        }
        $data = '';
        $newUserId = 0;
        if ($key === 'NEW') {
            $beRec = BackendUtility::getRecord('be_users', (int)$record['t1_copy_of_user']);
            if (is_array($beRec)) {
                $data = [];
                $data['be_users'][$key] = $beRec;
                $data['be_users'][$key]['username'] = $this->fixUsername($vars['username'], $record['t1_userprefix']);
                $data['be_users'][$key]['password'] = $vars['password'];
                $data['be_users'][$key]['realName'] = $vars['realName'];
                $data['be_users'][$key]['email'] = $vars['email'];
                $data['be_users'][$key]['disable'] = (int)$vars['disable'];
                $data['be_users'][$key]['admin'] = 0;
                $data['be_users'][$key]['usergroup'] = $vars['usergroup'];
                $data['be_users'][$key]['createdByAction'] = $record['uid'];
            }
        } else {
            // Check ownership
            $beRec = BackendUtility::getRecord('be_users', (int)$key);
            if (is_array($beRec) && $beRec['cruser_id'] == $this->getBackendUser()->user['uid']) {
                $data = [];
                $data['be_users'][$key]['username'] = $this->fixUsername($vars['username'], $record['t1_userprefix']);
                if ($vars['password'] !== '') {
                    $data['be_users'][$key]['password'] = $vars['password'];
                }
                $data['be_users'][$key]['realName'] = $vars['realName'];
                $data['be_users'][$key]['email'] = $vars['email'];
                $data['be_users'][$key]['disable'] = (int)$vars['disable'];
                $data['be_users'][$key]['admin'] = 0;
                $data['be_users'][$key]['usergroup'] = $vars['usergroup'];
                $newUserId = $key;
            }
        }
        // Save/update user by using DataHandler
        if (is_array($data)) {
            $dataHandler = GeneralUtility::makeInstance(\TYPO3\CMS\Core\DataHandling\DataHandler::class);
            $dataHandler->start($data, [], $this->getBackendUser());
            $dataHandler->admin = 1;
            $dataHandler->process_datamap();
            $newUserId = (int)$dataHandler->substNEWwithIDs['NEW'];
            if ($newUserId) {
                // Create
                $this->action_createDir($newUserId);
            } else {
                // Update
                $newUserId = (int)$key;
            }
            unset($tce);
        }
        return $newUserId;
    }

    /**
     * Create the username based on the given username and the prefix
     *
     * @param string $username Username
     * @param string $prefix Prefix
     * @return string Combined username
     */
    protected function fixUsername($username, $prefix)
    {
        $prefix = trim($prefix);
        if ($prefix !== '' && strpos($username, $prefix) === 0) {
            $username = substr($username, strlen($prefix));
        }
        return $prefix . $username;
    }

    /**
     * Clean the to be applied usergroups from not allowed ones
     *
     * @param array $appliedUsergroups Array of to be applied user groups
     * @param array $actionRecord The action record
     * @return array Cleaned array
     */
    protected function fixUserGroup($appliedUsergroups, $actionRecord)
    {
        if (is_array($appliedUsergroups)) {
            $cleanGroupList = [];
            // Create an array from the allowed usergroups using the uid as key
            $allowedUsergroups = array_flip(explode(',', $actionRecord['t1_allowed_groups']));
            // Walk through the array and check every uid if it is under the allowed ines
            foreach ($appliedUsergroups as $group) {
                if (isset($allowedUsergroups[$group])) {
                    $cleanGroupList[] = $group;
                }
            }
            $appliedUsergroups = $cleanGroupList;
        }
        return $appliedUsergroups;
    }

    /**
     * Check if a page is inside the rootline the current user can see
     *
     * @param int $pageId Id of the the page to be checked
     * @return bool Access to the page
     */
    protected function checkRootline($pageId)
    {
        $access = false;
        $dbMounts = array_flip(explode(',', trim($this->getBackendUser()->dataLists['webmount_list'], ',')));
        $rootline = BackendUtility::BEgetRootLine($pageId);
        foreach ($rootline as $page) {
            if (isset($dbMounts[$page['uid']]) && !$access) {
                $access = true;
            }
        }
        return $access;
    }

    /**
     * Create a user directory if defined
     *
     * @param int $uid Id of the user record
     */
    protected function action_createDir($uid)
    {
        $path = $this->action_getUserMainDir();
        if ($path) {
            GeneralUtility::mkdir($path . $uid);
            GeneralUtility::mkdir($path . $uid . '/_temp_/');
        }
    }

    /**
     * Get the path to the user home directory which is set in the localconf.php
     *
     * @return string Path
     */
    protected function action_getUserMainDir()
    {
        $path = $GLOBALS['TYPO3_CONF_VARS']['BE']['userHomePath'];
        // If path is set and a valid directory
        if ($path && @is_dir($path) && $GLOBALS['TYPO3_CONF_VARS']['BE']['lockRootPath'] && GeneralUtility::isFirstPartOfStr($path, $GLOBALS['TYPO3_CONF_VARS']['BE']['lockRootPath']) && substr($path, -1) === '/') {
            return $path;
        }
    }

    /**
     * Get all allowed usergroups which can be applied to a user record
     *
     * @param array $record sys_action record
     * @param array $vars Selected be_user record
     * @return string Rendered user groups
     */
    protected function getUsergroups($record, $vars)
    {
        $content = '';
        // Do nothing if no groups are allowed
        if (empty($record['t1_allowed_groups'])) {
            return $content;
        }
        $content .= '<option value=""></option>';
        $grList = GeneralUtility::trimExplode(',', $record['t1_allowed_groups'], true);
        foreach ($grList as $group) {
            $checkGroup = BackendUtility::getRecord('be_groups', $group);
            if (is_array($checkGroup)) {
                $selected = GeneralUtility::inList($vars['usergroup'], $checkGroup['uid']) ? ' selected="selected" ' : '';
                $content .= '<option ' . $selected . 'value="' . (int)$checkGroup['uid'] . '">' . htmlspecialchars($checkGroup['title']) . '</option>';
            }
        }
        return $content;
    }

    /**
     * Action to create a new record
     *
     * @param array $record sys_action record
     */
    protected function viewNewRecord($record)
    {
        /** @var \TYPO3\CMS\Backend\Routing\UriBuilder $uriBuilder */
        $uriBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Backend\Routing\UriBuilder::class);
        $link = (string)$uriBuilder->buildUriFromRoute(
            'record_edit',
            [
                'edit[' . $record['t3_tables'] . '][' . (int)$record['t3_listPid'] . ']' => 'new',
                'returnUrl' => $this->moduleUrl
            ]
        );
        HttpUtility::redirect($link);
    }

    /**
     * Action to edit records
     *
     * @param array $record sys_action record
     * @return string list of records
     */
    protected function viewEditRecord($record)
    {
        $content = '';
        $actionList = [];
        $dbAnalysis = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\RelationHandler::class);
        $dbAnalysis->setFetchAllFields(true);
        $dbAnalysis->start($record['t4_recordsToEdit'], '*');
        $dbAnalysis->getFromDB();
        // collect the records
        foreach ($dbAnalysis->itemArray as $el) {
            $path = BackendUtility::getRecordPath(
                $el['id'],
                $this->getBackendUser()->getPagePermsClause(Permission::PAGE_SHOW),
                $this->getBackendUser()->uc['titleLen']
            );
            $record = BackendUtility::getRecord($el['table'], $dbAnalysis->results[$el['table']][$el['id']]);
            $title = BackendUtility::getRecordTitle($el['table'], $dbAnalysis->results[$el['table']][$el['id']]);
            $description = htmlspecialchars($this->getLanguageService()->sL($GLOBALS['TCA'][$el['table']]['ctrl']['title']));
            // @todo: which information could be needful
            if (isset($record['crdate'])) {
                $description .= ' - ' . htmlspecialchars(BackendUtility::dateTimeAge($record['crdate']));
            }
            /** @var \TYPO3\CMS\Backend\Routing\UriBuilder $uriBuilder */
            $uriBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Backend\Routing\UriBuilder::class);
            $link = (string)$uriBuilder->buildUriFromRoute(
                'record_edit',
                [
                    'edit[' . $el['table'] . '][' . $el['id'] . ']' => 'edit',
                    'returnUrl' => $this->moduleUrl
                ]
            );
            $actionList[$el['id']] = [
                'uid' => 'record-' . $el['table'] . '-' . $el['id'],
                'title' => $title,
                'description' => BackendUtility::getRecordTitle($el['table'], $dbAnalysis->results[$el['table']][$el['id']]),
                'descriptionHtml' => $description,
                'link' => $link,
                'icon' => '<span title="' . htmlspecialchars($path) . '">' . $this->iconFactory->getIconForRecord($el['table'], $dbAnalysis->results[$el['table']][$el['id']], Icon::SIZE_SMALL)->render() . '</span>'
            ];
        }
        // Render the record list
        $content .= $this->taskObject->renderListMenu($actionList);
        return $content;
    }

    /**
     * Action to view the result of a SQL query
     *
     * @param array $record sys_action record
     * @return string Result of the query
     */
    protected function viewSqlQuery($record)
    {
        $content = '';
        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('lowlevel')) {
            $sql_query = unserialize($record['t2_data']);
            if (!is_array($sql_query) || is_array($sql_query) && stripos(trim($sql_query['qSelect']), 'SELECT') === 0) {
                $actionContent = '';
                $type = $sql_query['qC']['search_query_makeQuery'];
                if ($sql_query['qC']['labels_noprefix'] === 'on') {
                    $this->taskObject->MOD_SETTINGS['labels_noprefix'] = 'on';
                }
                $sqlQuery = $sql_query['qSelect'];
                $queryIsEmpty = false;
                if ($sqlQuery) {
                    try {
                        $dataRows = GeneralUtility::makeInstance(ConnectionPool::class)
                            ->getConnectionForTable($sql_query['qC']['queryTable'])
                            ->executeQuery($sqlQuery)->fetchAll();
                        // Additional configuration
                        $this->taskObject->MOD_SETTINGS['search_result_labels'] = $sql_query['qC']['search_result_labels'];
                        $this->taskObject->MOD_SETTINGS['queryFields'] = $sql_query['qC']['queryFields'];

                        $fullsearch = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\QueryView::class, $GLOBALS['SOBE']->MOD_SETTINGS);
                        $fullsearch->noDownloadB = 1;
                        $fullsearch->formW = 48;
                        $cP = $fullsearch->getQueryResultCode($type, $dataRows, $sql_query['qC']['queryTable']);
                        $actionContent = $cP['content'];
                        // If the result is rendered as csv or xml, show a download link
                        if ($type === 'csv' || $type === 'xml') {
                            $actionContent .= '<a href="' . htmlspecialchars(GeneralUtility::getIndpEnv('REQUEST_URI') . '&download_file=1') . '">'
                                . '<strong>' . htmlspecialchars($this->getLanguageService()->getLL('action_download_file')) . '</strong></a>';
                        }
                    } catch (DBALException $e) {
                        $actionContent .= $e->getMessage();
                    }
                } else {
                    // Query is empty (not built)
                    $queryIsEmpty = true;
                    $this->addMessage(
                        $this->getLanguageService()->getLL('action_emptyQuery'),
                        $this->getLanguageService()->getLL('action_error'),
                        FlashMessage::ERROR
                    );
                    $content .= $this->renderFlashMessages();
                }
                // Admin users are allowed to see and edit the query
                if ($this->getBackendUser()->isAdmin()) {
                    if (!$queryIsEmpty) {
                        $actionContent .= '<div class="panel panel-default"><div class="panel-body"><pre>' . htmlspecialchars($sql_query['qSelect']) . '</pre></div></div>';
                    }
                    /** @var \TYPO3\CMS\Backend\Routing\UriBuilder $uriBuilder */
                    $uriBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Backend\Routing\UriBuilder::class);
                    $actionContent .= '<a title="' . htmlspecialchars($this->getLanguageService()->getLL('action_editQuery')) . '" class="btn btn-default" href="'
                        . htmlspecialchars((string)$uriBuilder->buildUriFromRoute('system_dbint')
                            . '&id=' . '&SET[function]=search' . '&SET[search]=query'
                            . '&storeControl[STORE]=-' . $record['uid'] . '&storeControl[LOAD]=1')
                        . '">'
                        . $this->iconFactory->getIcon('actions-open', Icon::SIZE_SMALL)->render() . ' '
                        . $this->getLanguageService()->getLL(($queryIsEmpty ? 'action_createQuery'
                        : 'action_editQuery')) . '</a>';
                }
                $content .= '<h2>' . htmlspecialchars($this->getLanguageService()->getLL('action_t2_result')) . '</h2>' . $actionContent;
            } else {
                // Query is not configured
                $this->addMessage(
                    $this->getLanguageService()->getLL('action_notReady'),
                    $this->getLanguageService()->getLL('action_error'),
                    FlashMessage::ERROR
                );
                $content .= $this->renderFlashMessages();
            }
        } else {
            // Required sysext lowlevel is not installed
            $this->addMessage(
                $this->getLanguageService()->getLL('action_lowlevelMissing'),
                $this->getLanguageService()->getLL('action_error'),
                FlashMessage::ERROR
            );
            $content .= $this->renderFlashMessages();
        }
        return $content;
    }

    /**
     * Action to create a list of records of a specific table and pid
     *
     * @param array $record sys_action record
     * @return string list of records
     */
    protected function viewRecordList($record)
    {
        $content = '';
        $this->id = (int)$record['t3_listPid'];
        $this->table = $record['t3_tables'];
        if ($this->id == 0) {
            $this->addMessage(
                $this->getLanguageService()->getLL('action_notReady'),
                $this->getLanguageService()->getLL('action_error'),
                FlashMessage::ERROR
            );
            $content .= $this->renderFlashMessages();
            return $content;
        }
        // Loading current page record and checking access:
        $this->pageinfo = BackendUtility::readPageAccess(
            $this->id,
            $this->getBackendUser()->getPagePermsClause(Permission::PAGE_SHOW)
        );
        $access = is_array($this->pageinfo);
        // If there is access to the page, then render the list contents and set up the document template object:
        if ($access) {
            // Initialize the dblist object:
            $dblist = GeneralUtility::makeInstance(\TYPO3\CMS\SysAction\ActionList::class);
            $dblist->script = GeneralUtility::getIndpEnv('REQUEST_URI');
            $dblist->calcPerms = $this->getBackendUser()->calcPerms($this->pageinfo);
            $dblist->thumbs = $this->getBackendUser()->uc['thumbnailsByDefault'];
            $dblist->allFields = 1;
            $dblist->showClipboard = 0;
            $dblist->disableSingleTableView = 1;
            $dblist->pageRow = $this->pageinfo;
            $dblist->counter++;
            $dblist->MOD_MENU = ['bigControlPanel' => '', 'clipBoard' => ''];
            $dblist->modTSconfig = $this->taskObject->modTSconfig;
            $dblist->dontShowClipControlPanels = (!$this->taskObject->MOD_SETTINGS['bigControlPanel'] && $dblist->clipObj->current === 'normal' && !$this->modTSconfig['properties']['showClipControlPanelsDespiteOfCMlayers']);
            // Initialize the listing object, dblist, for rendering the list:
            $this->pointer = \TYPO3\CMS\Core\Utility\MathUtility::forceIntegerInRange(GeneralUtility::_GP('pointer'), 0, 100000);
            $dblist->start($this->id, $this->table, $this->pointer);
            $dblist->setDispFields();
            // Render the list of tables:
            $dblist->generateList();
            /** @var \TYPO3\CMS\Backend\Routing\UriBuilder $uriBuilder */
            $uriBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Backend\Routing\UriBuilder::class);
            // Add JavaScript functions to the page:
            $this->taskObject->getModuleTemplate()->addJavaScriptCode(
                'ActionTaskInlineJavascript',
                '

				function jumpExt(URL,anchor) {
					var anc = anchor?anchor:"";
					window.location.href = URL+(T3_THIS_LOCATION?"&returnUrl="+T3_THIS_LOCATION:"")+anc;
					return false;
				}
				function jumpSelf(URL) {
					window.location.href = URL+(T3_RETURN_URL?"&returnUrl="+T3_RETURN_URL:"");
					return false;
				}

				function setHighlight(id) {
					top.fsMod.recentIds["web"] = id;
					top.fsMod.navFrameHighlightedID["web"] = top.fsMod.currentBank + "_" + id; // For highlighting

					if (top.nav_frame && top.nav_frame.refresh_nav) {
						top.nav_frame.refresh_nav();
					}
				}

				' . $dblist->CBfunctions() . '
				function editRecords(table,idList,addParams,CBflag) {
				    var recordEditUrl = ' . GeneralUtility::quoteJSvalue($uriBuilder->buildUriFromRoute('record_edit', ['returnUrl' => GeneralUtility::getIndpEnv('REQUEST_URI')])) . ';
					window.location.href = recordEditUrl + "&edit[" + table + "][" + idList + "]=edit" + addParams;
				}
				function editList(table,idList) {
					var list="";

						// Checking how many is checked, how many is not
					var pointer=0;
					var pos = idList.indexOf(",");
					while (pos!=-1) {
						if (cbValue(table+"|"+idList.substr(pointer,pos-pointer))) {
							list+=idList.substr(pointer,pos-pointer)+",";
						}
						pointer=pos+1;
						pos = idList.indexOf(",",pointer);
					}
					if (cbValue(table+"|"+idList.substr(pointer))) {
						list+=idList.substr(pointer)+",";
					}

					return list ? list : idList;
				}
				T3_THIS_LOCATION = ' . GeneralUtility::quoteJSvalue(rawurlencode(GeneralUtility::getIndpEnv('REQUEST_URI'))) . ';

				if (top.fsMod) top.fsMod.recentIds["web"] = ' . (int)$this->id . ';
			'
            );
            // Setting up the context sensitive menu:
            $this->taskObject->getModuleTemplate()->getPageRenderer()->loadRequireJsModule('TYPO3/CMS/Backend/ContextMenu');
            $this->taskObject->getModuleTemplate()->getPageRenderer()->loadRequireJsModule('TYPO3/CMS/Backend/AjaxDataHandler');
            // Begin to compile the whole page
            $content .= '<form action="' . htmlspecialchars($dblist->listURL()) . '" method="post" name="dblistForm">' . $dblist->HTMLcode . '<input type="hidden" name="cmd_table" /><input type="hidden" name="cmd" /></form>';
            // If a listing was produced, create the page footer with search form etc:
            // Making field select box (when extended view for a single table is enabled):
            if ($dblist->HTMLcode && $dblist->table) {
                $content .= $dblist->fieldSelectBox($dblist->table);
            }
        } else {
            // Not enough rights to access the list view or the page
            $this->addMessage(
                $this->getLanguageService()->getLL('action_error-access'),
                $this->getLanguageService()->getLL('action_error'),
                FlashMessage::ERROR
            );
            $content .= $this->renderFlashMessages();
        }
        return $content;
    }

    /**
     * @param string $message
     * @param string $title
     * @param int $severity
     *
     * @throws \TYPO3\CMS\Core\Exception
     */
    protected function addMessage($message, $title = '', $severity = FlashMessage::OK)
    {
        $flashMessage = GeneralUtility::makeInstance(FlashMessage::class, $message, $title, $severity);
        $flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
        $defaultFlashMessageQueue = $flashMessageService->getMessageQueueByIdentifier();
        $defaultFlashMessageQueue->enqueue($flashMessage);
    }

    /**
     * Render all currently enqueued FlashMessages
     *
     * @return string
     */
    protected function renderFlashMessages()
    {
        $flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
        $defaultFlashMessageQueue = $flashMessageService->getMessageQueueByIdentifier();
        return $defaultFlashMessageQueue->renderFlashMessages();
    }

    /**
     * Returns LanguageService
     *
     * @return \TYPO3\CMS\Core\Localization\LanguageService
     */
    protected function getLanguageService()
    {
        return $GLOBALS['LANG'];
    }

    /**
     * Returns the current BE user.
     *
     * @return \TYPO3\CMS\Core\Authentication\BackendUserAuthentication
     */
    protected function getBackendUser()
    {
        return $GLOBALS['BE_USER'];
    }
}
