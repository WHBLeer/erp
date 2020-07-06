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
 * ChildOrdersController
 */
class ChildOrdersController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * childOrdersRepository
     * 
     * @var \ERP\ErpManagementLogistics\Domain\Repository\ChildOrdersRepository
     * @inject
     */
    protected $childOrdersRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $childOrders = $this->childOrdersRepository->findAll();
        $this->view->assign('childOrders', $childOrders);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\ChildOrders $childOrders
     * @return void
     */
    public function showAction(\ERP\ErpManagementLogistics\Domain\Model\ChildOrders $childOrders)
    {
        $this->view->assign('childOrders', $childOrders);
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
     * @param \ERP\ErpManagementLogistics\Domain\Model\ChildOrders $newChildOrders
     * @return void
     */
    public function createAction(\ERP\ErpManagementLogistics\Domain\Model\ChildOrders $newChildOrders)
    {
        $this->addFlashMessage('数据已保存!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->childOrdersRepository->add($newChildOrders);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\ChildOrders $childOrders
     * @ignorevalidation $childOrders
     * @return void
     */
    public function editAction(\ERP\ErpManagementLogistics\Domain\Model\ChildOrders $childOrders)
    {
        $this->view->assign('childOrders', $childOrders);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\ChildOrders $childOrders
     * @return void
     */
    public function updateAction(\ERP\ErpManagementLogistics\Domain\Model\ChildOrders $childOrders)
    {
        $this->addFlashMessage('数据已修改', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->childOrdersRepository->update($childOrders);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\ChildOrders $childOrders
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementLogistics\Domain\Model\ChildOrders $childOrders)
    {
        $this->addFlashMessage('数据已删除', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->childOrdersRepository->remove($childOrders);
        $this->redirect('list');
    }
}
