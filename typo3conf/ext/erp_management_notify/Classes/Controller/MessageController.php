<?php
namespace ERP\ErpManagementNotify\Controller;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Service\OpcodeCacheService;
use TYPO3\CMS\Install\Service\ClearCacheService;
use TYPO3\CMS\Install\Service\ClearTableService;
use TYPO3\CMS\Install\Service\LanguagePackService;
use TYPO3\CMS\Install\Service\Typo3tempFileService;

/***
 *
 * This file is part of the "用户管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * MessageController
 */
class MessageController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * messageRepository
     * 
     * @var \ERP\ErpManagementNotify\Domain\Repository\MessageRepository
     * @inject
     */
    protected $messageRepository = null;

    /**
     * Get details about all configured database connections
     * 
     * @return array
     */
    protected function getDatabaseConnectionInformation()
    {
        $connectionInfos = [];
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        foreach ($connectionPool->getConnectionNames() as $connectionName) {
            $connection = $connectionPool->getConnectionByName($connectionName);
            $connectionParameters = $connection->getParams();
            $connectionInfo = [
            'connectionName' => $connectionName, 
            'version' => $connection->getServerVersion(), 
            'databaseName' => $connection->getDatabase(), 
            'username' => $connection->getUsername(), 
            'host' => $connection->getHost(), 
            'port' => $connection->getPort(), 
            'socket' => $connectionParameters['unix_socket'] ?? '', 
            'numberOfTables' => count($connection->getSchemaManager()->listTableNames())
            ];
            if (isset($GLOBALS['TYPO3_CONF_VARS']['DB']['TableMapping']) && is_array($GLOBALS['TYPO3_CONF_VARS']['DB']['TableMapping'])) {

                // Count number of array keys having $connectionName as value
                $connectionInfo['numberOfMappedTables'] = count(
                array_intersect(
                $GLOBALS['TYPO3_CONF_VARS']['DB']['TableMapping'], 
                [$connectionName]
                )
                );
            }
            $connectionInfos[] = $connectionInfo;
        }
        return $connectionInfos;
    }

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $messages = $this->messageRepository->findAll();
        $this->view->assign('messages', $messages);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementNotify\Domain\Model\Message $message
     * @return void
     */
    public function showAction(\ERP\ErpManagementNotify\Domain\Model\Message $message)
    {
        $this->view->assign('message', $message);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param \ERP\ErpManagementNotify\Domain\Model\Message $newMessage
     * @return void
     */
    public function createAction(\ERP\ErpManagementNotify\Domain\Model\Message $newMessage)
    {
        $this->addFlashMessage('数据已保存!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->messageRepository->add($newMessage);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementNotify\Domain\Model\Message $message
     * @ignorevalidation $message
     * @return void
     */
    public function editAction(\ERP\ErpManagementNotify\Domain\Model\Message $message)
    {
        $this->view->assign('message', $message);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementNotify\Domain\Model\Message $message
     * @return void
     */
    public function updateAction(\ERP\ErpManagementNotify\Domain\Model\Message $message)
    {
        $this->addFlashMessage('数据已修改', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->messageRepository->update($message);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementNotify\Domain\Model\Message $message
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementNotify\Domain\Model\Message $message)
    {
        $this->addFlashMessage('数据已删除', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->messageRepository->remove($message);
        $this->redirect('list');
    }

    /**
     * action ajax
     * 
     * @return void
     */
    public function ajaxAction()
    {
    }
}
