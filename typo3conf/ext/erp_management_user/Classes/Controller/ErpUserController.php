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
 * ErpUserController
 */
class ErpUserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * erpUserRepository
     * 
     * @var \ERP\ErpManagementUser\Domain\Repository\ErpUserRepository
     * @inject
     */
    protected $erpUserRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $erpUsers = $this->erpUserRepository->findAll();
        $this->view->assign('erpUsers', $erpUsers);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser
     * @return void
     */
    public function showAction(\ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser)
    {
        $this->view->assign('erpUser', $erpUser);
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
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUser $newErpUser
     * @return void
     */
    public function createAction(\ERP\ErpManagementUser\Domain\Model\ErpUser $newErpUser)
    {
        $this->addFlashMessage('数据已保存!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->erpUserRepository->add($newErpUser);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser
     * @ignorevalidation $erpUser
     * @return void
     */
    public function editAction(\ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser)
    {
        $this->view->assign('erpUser', $erpUser);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser
     * @return void
     */
    public function updateAction(\ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser)
    {
        $this->addFlashMessage('数据已修改', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->erpUserRepository->update($erpUser);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementUser\Domain\Model\ErpUser $erpUser)
    {
        $this->addFlashMessage('数据已删除', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->erpUserRepository->remove($erpUser);
        $this->redirect('list');
    }

    /**
     * action register
     * 
     * @return void
     */
    public function registerAction()
    {
    }

    /**
     * action changepwd
     * 
     * @return void
     */
    public function changepwdAction()
    {
    }

    /**
     * 用户中心
     *
     * @return void
     * @author wanghongbin
     * tstamp: 2020-05-28
     */
    public function profileAction()
    {
        # code...
    }
    
    /**
     * 账户授权
     *
     * @return void
     * @author wanghongbin
     * tstamp: 2020-05-28
     */
    public function oauthAction()
    {
        # code...
    }

    /**
     * action retrievepwd
     * 
     * @return void
     */
    public function retrievepwdAction()
    {
    }

    /**
     * action check
     * 
     * @return void
     */
    public function checkAction()
    {
    }

    /**
     * action ajaxdata
     * 
     * @return void
     */
    public function ajaxdataAction()
    {
    }
}
