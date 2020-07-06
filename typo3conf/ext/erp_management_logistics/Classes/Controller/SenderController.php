<?php
namespace ERP\ErpManagementLogistics\Controller;


/***
 *
 * This file is part of the "物流管理系统" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>, 三里林
 *
 ***/
/**
 * SenderController
 */
class SenderController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * senderRepository
     * 
     * @var \ERP\ErpManagementLogistics\Domain\Repository\SenderRepository
     * @inject
     */
    protected $senderRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $senders = $this->senderRepository->findAll();
        $this->view->assign('senders', $senders);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\Sender $sender
     * @return void
     */
    public function showAction(\ERP\ErpManagementLogistics\Domain\Model\Sender $sender)
    {
        $this->view->assign('sender', $sender);
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
     * @param \ERP\ErpManagementLogistics\Domain\Model\Sender $newSender
     * @return void
     */
    public function createAction(\ERP\ErpManagementLogistics\Domain\Model\Sender $newSender)
    {
        $this->addFlashMessage('数据已保存!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->senderRepository->add($newSender);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\Sender $sender
     * @ignorevalidation $sender
     * @return void
     */
    public function editAction(\ERP\ErpManagementLogistics\Domain\Model\Sender $sender)
    {
        $this->view->assign('sender', $sender);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\Sender $sender
     * @return void
     */
    public function updateAction(\ERP\ErpManagementLogistics\Domain\Model\Sender $sender)
    {
        $this->addFlashMessage('数据已修改', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->senderRepository->update($sender);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\Sender $sender
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementLogistics\Domain\Model\Sender $sender)
    {
        $this->addFlashMessage('数据已删除', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->senderRepository->remove($sender);
        $this->redirect('list');
    }
}
