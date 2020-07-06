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
 * ReceiverController
 */
class ReceiverController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * receiverRepository
     * 
     * @var \ERP\ErpManagementLogistics\Domain\Repository\ReceiverRepository
     * @inject
     */
    protected $receiverRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $receivers = $this->receiverRepository->findAll();
        $this->view->assign('receivers', $receivers);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\Receiver $receiver
     * @return void
     */
    public function showAction(\ERP\ErpManagementLogistics\Domain\Model\Receiver $receiver)
    {
        $this->view->assign('receiver', $receiver);
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
     * @param \ERP\ErpManagementLogistics\Domain\Model\Receiver $newReceiver
     * @return void
     */
    public function createAction(\ERP\ErpManagementLogistics\Domain\Model\Receiver $newReceiver)
    {
        $this->addFlashMessage('数据已保存!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->receiverRepository->add($newReceiver);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\Receiver $receiver
     * @ignorevalidation $receiver
     * @return void
     */
    public function editAction(\ERP\ErpManagementLogistics\Domain\Model\Receiver $receiver)
    {
        $this->view->assign('receiver', $receiver);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\Receiver $receiver
     * @return void
     */
    public function updateAction(\ERP\ErpManagementLogistics\Domain\Model\Receiver $receiver)
    {
        $this->addFlashMessage('数据已修改', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->receiverRepository->update($receiver);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\Receiver $receiver
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementLogistics\Domain\Model\Receiver $receiver)
    {
        $this->addFlashMessage('数据已删除', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->receiverRepository->remove($receiver);
        $this->redirect('list');
    }
}
