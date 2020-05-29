<?php
namespace ERP\ErpManagementOrder\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

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
 * OrderController
 */
class OrderController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * orderRepository
     * 
     * @var \ERP\ErpManagementOrder\Domain\Repository\OrderRepository
     * @inject
     */
    protected $orderRepository = null;
    public function initializeAction()
    {
    }

    /**
     * action list
     * 
     * @param ERP\ErpManagementOrder\Domain\Model\Order
     * @return void
     */
    public function listAction()
    {
        $orders = $this->orderRepository->findHiddenAll();
        $this->view->assign('orders', $orders);
    }

    /**
     * action show
     * 
     * @param ERP\ErpManagementOrder\Domain\Model\Order
     * @return void
     */
    public function showAction(\ERP\ErpManagementOrder\Domain\Model\Order $order)
    {
        $this->view->assign('order', $order);
    }

    /**
     * action new
     * 
     * @param ERP\ErpManagementOrder\Domain\Model\Order
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param ERP\ErpManagementOrder\Domain\Model\Order
     * @return void
     */
    public function createAction(\ERP\ErpManagementOrder\Domain\Model\Order $order)
    {
        $this->addFlashMessage('订单创建成功', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->orderRepository->add($order);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param ERP\ErpManagementOrder\Domain\Model\Order
     * @ignorevalidation $order
     * @return void
     */
    public function editAction(\ERP\ErpManagementOrder\Domain\Model\Order $order)
    {
        $this->view->assign('order', $order);
    }

    /**
     * action update
     * 
     * @param ERP\ErpManagementOrder\Domain\Model\Order
     * @return void
     */
    public function updateAction(\ERP\ErpManagementOrder\Domain\Model\Order $order)
    {
        $this->addFlashMessage('订单编辑成功', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->orderRepository->update($order);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param ERP\ErpManagementOrder\Domain\Model\Order
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementOrder\Domain\Model\Order $order)
    {
        $this->addFlashMessage('订单删除成功', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->orderRepository->remove($order);
        $this->redirect('list');
    }

    /**
     * action api
     * 
     * @param ERP\ErpManagementOrder\Domain\Model\Order
     * @return void
     */
    public function apiAction()
    {
        dump($_GET);
        dump($_POST);
        exit;
    }

    /**
     * 提交订单
     * action push
     * 
     * @return void
     */
    public function pushAction()
    {
    }

    /**
     * 拉取订单
     * action pull
     * 
     * @return void
     */
    public function pullAction()
    {
    }
}
