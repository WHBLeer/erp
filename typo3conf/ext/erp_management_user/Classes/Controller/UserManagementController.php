<?php
namespace ERP\ErpManagementUser\Controller;


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
 * UserManagementController
 */
class UserManagementController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * userManagementRepository
     * 
     * @var \ERP\ErpManagementUser\Domain\Repository\UserManagementRepository
     * @inject
     */
    protected $userManagementRepository = null;

    /**
     * action list
     * 
     * @param ERP\ErpManagementUser\Domain\Model\UserManagement
     * @return void
     */
    public function listAction()
    {
        $userManagements = $this->userManagementRepository->findAll();
        $this->view->assign('userManagements', $userManagements);
    }

    /**
     * action show
     * 
     * @param ERP\ErpManagementUser\Domain\Model\UserManagement
     * @return void
     */
    public function showAction(\ERP\ErpManagementUser\Domain\Model\UserManagement $userManagement)
    {
        $this->view->assign('userManagement', $userManagement);
    }

    /**
     * action new
     * 
     * @param ERP\ErpManagementUser\Domain\Model\UserManagement
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param ERP\ErpManagementUser\Domain\Model\UserManagement
     * @return void
     */
    public function createAction(\ERP\ErpManagementUser\Domain\Model\UserManagement $newUserManagement)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userManagementRepository->add($newUserManagement);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param ERP\ErpManagementUser\Domain\Model\UserManagement
     * @ignorevalidation $userManagement
     * @return void
     */
    public function editAction(\ERP\ErpManagementUser\Domain\Model\UserManagement $userManagement)
    {
        $this->view->assign('userManagement', $userManagement);
    }

    /**
     * action update
     * 
     * @param ERP\ErpManagementUser\Domain\Model\UserManagement
     * @return void
     */
    public function updateAction(\ERP\ErpManagementUser\Domain\Model\UserManagement $userManagement)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userManagementRepository->update($userManagement);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param ERP\ErpManagementUser\Domain\Model\UserManagement
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementUser\Domain\Model\UserManagement $userManagement)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userManagementRepository->remove($userManagement);
        $this->redirect('list');
    }

    /**
     * action register
     * 
     * @param ERP\ErpManagementUser\Domain\Model\UserManagement
     * @return void
     */
    public function registerAction()
    {
    }

    /**
     * action changepwd
     * 
     * @param ERP\ErpManagementUser\Domain\Model\UserManagement
     * @return void
     */
    public function changepwdAction()
    {
    }

    /**
     * action retrievepwd
     * 
     * @param ERP\ErpManagementUser\Domain\Model\UserManagement
     * @return void
     */
    public function retrievepwdAction()
    {
    }

    /**
     * action check
     * 
     * @param ERP\ErpManagementUser\Domain\Model\UserManagement
     * @return void
     */
    public function checkAction()
    {
    }

    /**
     * action ajaxdata
     * 
     * @param ERP\ErpManagementUser\Domain\Model\UserManagement
     * @return void
     */
    public function ajaxdataAction()
    {
    }
}
