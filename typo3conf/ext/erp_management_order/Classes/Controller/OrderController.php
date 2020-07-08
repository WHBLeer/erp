<?php
namespace ERP\ErpManagementOrder\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

require_once ExtensionManagementUtility::extPath('erp_management_interaction') . 'Classes/Library/ErpServerApi.php';

/***
 *
 * This file is part of the "订单管理系统" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>, 三里林
 *
 ***/
/**
 * OrderController
 */
class OrderController extends ComController
{

    /**
     * action list
     * 
     * @param ERP\ErpManagementOrder\Domain\Model\Order
     * @return void
     */
    public function listAction()
    {
        $this->pullOrderByAccountId($this->user['account_id']);
        $keywords = $this->request->hasArgument('keywords')?$this->request->getArgument('keywords'):[];
        $orders = $this->orderRepository->findAlls($keywords);
        $this->view->assign('orders', $orders);
        $this->view->assign('keywords', $keywords);
        $this->view->assign('page', $this->page);
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
     * 更新订单
     * action refresh
     * 
     * @return void
     */
    public function refreshAction()
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

    /**
     * 获取用户订单信息
     *
     * @param [type] $accountid
     * @return void
     * @author wanghongbin
     * tstamp: 2020-06-30
     */
    public function pullOrderByAccountId($accountid)
    {
        //判断用户订单更新间隔 超过两小时再请求数据
        if ((abs($this->user['order_lasttime']-time()) <= 7200)) return;

        //与服务端数据对接
        $ErpServer = new \ERP\Api\ErpServer\ErpOrderApi();
        $res = $ErpServer->getOrdersList(['accountId'=>$accountid]);
        if ($res['rspCode'] == 0) {
            //更新用户订单最后写入时间
            $this->updateOrderLasttime();

            $orderres = $res['data'];
            // dump($orderres);
            foreach ($orderres as $key => $result) {
                $orders = $this->orderRepository->findByAmazonOrderId($result['amazonOrderId']);
                $count = $orders->count();
                if ($count > 0) {
                    // 订单存在时 处理所有情况订单 更新订单 
                    $order   = $orders->getFirst();
                    // $address = $order->getAddress();
                    // $revenue = $order->getRevenue();
                    // $shipper = $order->getshipper();

                    $order->setLastUpdateDate(strtotime($result['lastUpdateDate']));//最后更新时间
                    $order->setOrderStatus($result['orderStatus']);//订单状态
                    $order->setNumberOfItemsShipped($result['numberOfItemsShipped']);//已发货数量
                    $order->setNumberOfItemsUnshipped($result['numberOfItemsUnshipped']);//未发货数
                    $this->orderRepository->update($order);
                    $this->refreshObject();
                } else {
                    // 订单不存在时 处理非取消订单 新增订单
                    if ($result['orderStatus']=='Canceled') continue;

                    $order   = new \ERP\ErpManagementOrder\Domain\Model\Order();
                    $address = new \ERP\ErpManagementOrder\Domain\Model\Address;
                    $revenue = new \ERP\ErpManagementOrder\Domain\Model\Revenue;
                    $shipper = new \ERP\ErpManagementOrder\Domain\Model\Shipper;

                    $user = $this->erpUserRepository->findByAuthcode($result['accountId']);
                    $order->setErpuser($user);
                    $order->setLastUpdateDate(strtotime($result['lastUpdateDate']));//最后更新时间
                    $order->setPurchaseDate(strtotime($result['purchaseDate']));//下单时间
                    $order->setEarliestDeliveryDate(strtotime($result['earliestDeliveryDate']));//最早交货日期
                    $order->setEarliestShipDate(strtotime($result['earliestShipDate']));//最早装运日期
                    $order->setLatestShipDate(strtotime($result['latestShipDate']));//最迟装运日期
                    $order->setLatestDeliveryDate(strtotime($result['latestDeliveryDate']));//最迟装运日期
                    $order->setGoodsTitle($result['prodTitle']);//产品名称
                    $order->setGoodsImage($result['goodsImage']);//产品名称
                    $order->setAsinNum($result['asin']);//产品码
                    $order->setSellerSku($result['sellerSku']);//商品SKU
                    $order->setSalesLink($result['salesLink']);//售卖链接地址
                    $order->setAmazonOrderId($result['amazonOrderId']);//订单编号
                    $order->setOrderType($result['orderType']);//订单类型
                    $order->setOrderStatus($result['orderStatus']);//订单状态
                    $order->setAmount($result['amount']);//订单金额
                    $order->setCurrencyCode($result['currencyCode']);//货币代码
                    $order->setMarketplaceId($result['marketplaceId']);//市场
                    $order->setFulfillmentChannel($result['fulfillmentChannel']);//履行渠道
                    $order->setShipServiceLevel($result['shipServiceLevel']);//服务等级
                    $order->setSalesChannel($result['salesChannel']);//销售渠道
                    $order->setNumberOfItemsShipped($result['numberOfItemsShipped']);//已发货数量
                    $order->setNumberOfItemsUnshipped($result['numberOfItemsUnshipped']);//未发货数
                    $order->setPaymentMethod($result['paymentMethod']);//付款方式
                    $order->setBusinessOrder($result['businessOrder']);
                    $order->setPrime($result['isPrime']);//用黄金支付
                    $order->setGlobalExpressEnabled($result['globalExpressEnabled']);//全球快递已启用
                    $order->setPremiumOrder($result['premiumOrder']);//预购订单
                    $order->setReplacementOrder($result['replacementOrder']);//替换订单
                    $order->setSoldByAB($result['soldByAB']);//由销售顾问出售
                    //地址
                    $address->setName($result['buyerName']);//购买人名称
                    $this->addressRepository->add($address);
                    $this->refreshObject();
                    $order->setAddress($address);

                    //营收
                    $revenue->setOrderAmount($result['amount']);//订单金额
                    $revenue->setCommission($data['commission']);//佣金
                    $revenue->setCostAmount($data['costAmount']);//成本
                    $revenue->setActualAmount($data['costAmount']);//实际金额
                    $revenue->setCurrencyCode($data['currencyCode']);//货币代码
                    $this->revenueRepository->add($revenue);
                    $this->refreshObject();
                    $order->setRevenue($revenue);
                    
                    //物流
                    $shipper->setNameZh($result['buyerName']);//购买人名称
                    $shipper->setEmail($result['buyerEmail']);//购买人邮箱
                    $shipper->setNameEn($result['buyerName']);//购买人名称
                    $shipper->setSku($result['sellerSku']);//售卖SKU
                    $shipper->setShipperAddressLine1($result['shipperAddressLine1']);//发件人地址1
                    $shipper->setShipperAddressLine2($result['shipperAddressLine2']);//发件人地址1
                    $shipper->setShipperAddressLine3($result['shipperAddressLine3']);//发件人地址1
                    $shipper->setShipperCity($result['shipperCity']);//发件人城市
                    $shipper->setShipperStateOrRegion($result['shipperStateOrRegion']);//发件人区域
                    $shipper->setShipperCountryCode($result['shipperCountryCode']);//发件人国家代码
                    $shipper->setShipperPhone($result['shipperPhone']);//发件人电话
                    $shipper->setShipperAddressType($result['shipperAddressType']);//发件人地址类型
                    $shipper->setShipperIsAddressSharingConfidential($result['shipperIsAddressSharingConfidential']);//发件人地址共享
                    $this->shipperRepository->add($shipper);
                    $this->refreshObject();
                    $order->setShipper($shipper);
                    
                    $this->orderRepository->add($order);
                    $this->refreshObject();

                }
            }
        }
    }

    /**
     * 写入用户订单最后更新时间
     *
     * @return void
     * @author wanghongbin
     * tstamp: 2020-06-30
     */
    public function updateOrderLasttime()
    {
        $result = GeneralUtility::makeInstance(ConnectionPool::class)
        ->getConnectionForTable('fe_users')
        ->update(
            'fe_users',
            ['order_lasttime'=>time()],
            ['uid'=>$this->user['uid']]
        );
        return ;
    }
    /**
     * 更新地址
     *
     * @param \ERP\ErpManagementOrder\Domain\Model\Address $address
     * @param array $datas
     * @return void
     * @author wanghongbin
     * tstamp: 2020-06-30
     */
    public function updateAddress(\ERP\ErpManagementOrder\Domain\Model\Address $address,array $datas)
    {
        $address->setTelephone($datas['telephone']);
        $address->setPostcode($datas['postcode']);
        $address->setState($datas['state']);
        $address->setCity($datas['city']);
        $address->setStreetNumber($datas['streetnumber']);
        $address->setAddress($datas['address']);
        $this->addressRepository->update($address);
        $this->refreshObject();
    }

    /**
     * 更新营收
     *
     * @param \ERP\ErpManagementOrder\Domain\Model\Revenue $revenue
     * @param array $datas
     * @return void
     * @author wanghongbin
     * tstamp: 2020-06-30
     */
    public function updateRevenue(\ERP\ErpManagementOrder\Domain\Model\Revenue $revenue,array $datas)
    {
        $revenue->setArrive($data['arrive']);
        $revenue->setFreight($data['freight']);
        $revenue->setServiceFee($data['serviceFee']);
        $revenue->setProfit($data['profit']);
        $revenue->setProfitMargin($data['profitMargin']);
        $this->revenueRepository->update($revenue);
        $this->refreshObject();
    }
    
    /**
     * 更新物流
     *
     * @param \ERP\ErpManagementOrder\Domain\Model\Shipper $shipper
     * @param array $datas
     * @return void
     * @author wanghongbin
     * tstamp: 2020-06-30
     */
    public function updateShipper(\ERP\ErpManagementOrder\Domain\Model\Shipper $shipper,array $datas)
    {
        $shipper->setNumber($datas['Number']);
        $shipper->setWeight($datas['Weight']);
        $shipper->setLength($datas['Length']);
        $shipper->setWidth($datas['Width']);
        $shipper->setHeight($datas['Height']);
        $shipper->setRoute($datas['Route']);
        $shipper->setProviders($datas['Providers']);
        $shipper->setGnWaybill($datas['GnWaybill']);
        $shipper->setGnTracking($datas['GnTracking']);
        $shipper->setGnStatus($datas['GnStatus']);
        $shipper->setGjWaybill($datas['GjWaybill']);
        $shipper->setGjTracking($datas['GjTracking']);
        $shipper->setGjStatus($datas['GjStatus']);
        $shipper->setDeliveryType($datas['DeliveryType']);
        $shipper->setRemark($datas['Remark']);
        $shipper->setCustomermail($datas['Customermail']);
        $shipper->setLogs($datas['Logs']);
        $this->shipperRepository->update($shipper);
        $this->refreshObject();
    }

    /**
     * 创建物流运单
     *
     * @param array $datas
     * @return void
     * @author wanghongbin
     * tstamp: 2020-06-30
     */
    public function createLogistics(array $datas)
    {
        # code...
    }

    /**
     * 更新物流运单
     *
     * @param array $datas
     * @return void
     * @author wanghongbin
     * tstamp: 2020-06-30
     */
    public function updateLogistics(array $datas)
    {
        # code...
    }

    /**
     * 对象存储刷新
     * 
     * @return [type] [description]
     */
    public function refreshObject()
    {
        $persistenceManager = $this->objectManager->get(PersistenceManager::class);
        $persistenceManager->persistAll();
    }
}
