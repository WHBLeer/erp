<?php
namespace ERP\ErpManagementOrder\Domain\Model;


/***
 *
 * This file is part of the "订单管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * 订单管理
 */
class Order extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 服务端交互id
     * 
     * @var string
     */
    protected $accountId = '';

    /**
     * 服务端主键
     * 
     * @var string
     */
    protected $srvOrderId = '';
    
    /**
     * 商品名称
     * 
     * @var string
     */
    protected $goodsTitle ='';
    
    /**
     * 商品图片
     * 
     * @var string
     */
    protected $goodsImage ='';

    /**
     * 商品码
     * 
     * @var string
     */
    protected $asinNum ='';

    /**
     * 销售SKU
     * 
     * @var string
     */
    protected $sellerSku ='';

    /**
     * 商品链接
     * 
     * @var string
     */
    protected $salesLink='';

    /**
     * 采购数量
     * 
     * @var string
     */
    protected $purchase = 0;

    /**
     * 亚马逊订单
     * 
     * 
     * @var string
     */
    protected $amazonOrderId = '';

    /**
     * 购买日期
     * 
     * 
     * @var int
     */
    protected $purchaseDate = 0;

    /**
     * 最后一次更新时间
     * 
     * 
     * @var int
     */
    protected $lastUpdateDate = 0;

    /**
     * 订单状态
     * 
     * 
     * @var int
     */
    protected $orderStatus = 0;

    /**
     * 履行渠道
     * 
     * 
     * @var int
     */
    protected $fulfillmentChannel = 0;

    /**
     * 服务等级
     * 
     * 
     * @var int
     */
    protected $shipServiceLevel = 0;

    /**
     * 销售渠道
     * 
     * 
     * @var string
     */
    protected $salesChannel = '';

    
    /**
     * 销售渠道
     * 
     * 
     * @var string
     */
    protected $salesChannelName = '';

    /**
     * 货币代码
     * 
     * 
     * @var string
     */
    protected $currencyCode = '';

    /**
     * 金额
     * 
     * 
     * @var string
     */
    protected $amount = 0.0;

    /**
     * 已发货数量
     * 
     * 
     * @var int
     */
    protected $numberOfItemsShipped = 0;

    /**
     * 未发货数量
     * 
     * 
     * @var int
     */
    protected $numberOfItemsUnshipped = 0;

    /**
     * 支付方式
     * 
     * 
     * @var string
     */
    protected $paymentMethod = '';

    /**
     * 付款方式详情
     * 
     * 
     * @var string
     */
    protected $paymentMethodDetails = '';

    /**
     * 市场
     * 
     * 
     * @var string
     */
    protected $marketplaceId = '';

    /**
     * 船货等级
     * 
     * 
     * @var string
     */
    protected $shipmentServiceLevelCategory = '';

    /**
     * 是否亚马逊TFM发货
     * 
     * 
     * @var int
     */
    protected $shippedByAmazonTFM = 0;

    /**
     * 订单类型
     * 
     * 
     * @var string
     */
    protected $orderType = '';

    /**
     * 最早装运日期
     * 
     * 
     * @var int
     */
    protected $earliestShipDate = 0;

    /**
     * 最迟装载日期
     * 
     * 
     * @var int
     */
    protected $latestShipDate = 0;

    /**
     * 最早交货日期
     * 
     * 
     * @var int
     */
    protected $earliestDeliveryDate = 0;

    /**
     * 最新交货日期
     * 
     * 
     * @var int
     */
    protected $latestDeliveryDate = 0;

    /**
     * 是否商业订单
     * 
     * 
     * @var int
     */
    protected $businessOrder = 0;

    /**
     * 是否是黄金
     * 
     * 
     * @var int
     */
    protected $prime = 0;

    /**
     * 是否启用全球快递
     * 
     * 
     * @var int
     */
    protected $globalExpressEnabled = 0;

    /**
     * 是否是高级订单
     * 
     * 
     * @var int
     */
    protected $premiumOrder = 0;

    /**
     * 是否是替换单
     * 
     * 
     * @var int
     */
    protected $replacementOrder = 0;

    /**
     * 由AB出售
     * 
     * 
     * @var int
     */
    protected $soldByAB = 0;

    /**
     * 订单商品
     * 
     * @var \ERP\ErpManagementProduct\Domain\Model\Product
     */
    protected $goods = null;

    /**
     * 订单商户
     * 
     * @var \ERP\ErpManagementUser\Domain\Model\ErpUser
     */
    protected $erpuser = null;

    /**
     * 发货地址
     * 
     * @var \ERP\ErpManagementOrder\Domain\Model\Address
     */
    protected $address = null;

    /**
     * 物流
     * 
     * @var \ERP\ErpManagementOrder\Domain\Model\Shipper
     */
    protected $shipper = null;

    /**
     * 营收
     * 
     * @var \ERP\ErpManagementOrder\Domain\Model\Revenue
     */
    protected $revenue = null;

    var $gj = array(
        'Amazon.co.uk'=>'英国',
        'Amazon.es'=>'西班牙',
        'Amazon.it'=>'意大利',
        'Amazon.fr'=>'法国',
        'Amazon.de'=>'德国',
    );

    /**
     * Returns the accountId
     * 
     * @return string accountId
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Sets the accountId
     * 
     * @param string $accountId
     * @return void
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * Returns the srvOrderId
     * 
     * @return string srvOrderId
     */
    public function getSrvOrderId()
    {
        return $this->srvOrderId;
    }

    /**
     * Sets the srvOrderId
     * 
     * @param string $srvOrderId
     * @return void
     */
    public function setSrvOrderId($srvOrderId)
    {
        $this->srvOrderId = $srvOrderId;
    }

    /**
     * Returns the goodsTitle
     * 
     * @return string goodsTitle
     */
    public function getGoodsTitle()
    {
        return $this->goodsTitle;
    }

    /**
     * Sets the goodsTitle
     * 
     * @param string $goodsTitle
     * @return void
     */
    public function setGoodsTitle($goodsTitle)
    {
        $this->goodsTitle = $goodsTitle;
    }
    
    /**
     * Returns the goodsImage
     * 
     * @return string goodsImage
     */
    public function getGoodsImage()
    {
        return $this->goodsImage;
    }

    /**
     * Sets the goodsImage
     * 
     * @param string $goodsImage
     * @return void
     */
    public function setGoodsImage($goodsImage)
    {
        $this->goodsImage = $goodsImage;
    }

    /**
     * Returns the asinNum
     * 
     * @return string asinNum
     */
    public function getAsinNum()
    {
        return $this->asinNum;
    }

    /**
     * Sets the asinNum
     * 
     * @param string $asinNum
     * @return void
     */
    public function setAsinNum($asinNum)
    {
        $this->asinNum = $asinNum;
    }

    /**
     * Returns the sellerSku
     * 
     * @return string sellerSku
     */
    public function getSellerSku()
    {
        return $this->sellerSku;
    }

    /**
     * Sets the sellerSku
     * 
     * @param string $sellerSku
     * @return void
     */
    public function setSellerSku($sellerSku)
    {
        $this->sellerSku = $sellerSku;
    }

    /**
     * Returns the salesLink
     * 
     * @return string salesLink
     */
    public function getSalesLink()
    {
        return $this->salesLink;
    }

    /**
     * Sets the salesLink
     * 
     * @param string $salesLink
     * @return void
     */
    public function setSalesLink($salesLink)
    {
        $this->salesLink = $salesLink;
    }

    /**
     * Returns the amazonOrderId
     * 
     * @return string amazonOrderId
     */
    public function getAmazonOrderId()
    {
        return $this->amazonOrderId;
    }

    /**
     * Sets the amazonOrderId
     * 
     * @param string $amazonOrderId
     * @return void
     */
    public function setAmazonOrderId($amazonOrderId)
    {
        $this->amazonOrderId = $amazonOrderId;
    }

    /**
     * Returns the purchaseDate
     * 
     * @return int purchaseDate
     */
    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    /**
     * Sets the purchaseDate
     * 
     * @param int $purchaseDate
     * @return void
     */
    public function setPurchaseDate($purchaseDate)
    {
        $this->purchaseDate = $purchaseDate;
    }

    /**
     * Returns the lastUpdateDate
     * 
     * @return int lastUpdateDate
     */
    public function getLastUpdateDate()
    {
        return $this->lastUpdateDate;
    }

    /**
     * Sets the lastUpdateDate
     * 
     * @param int $lastUpdateDate
     * @return void
     */
    public function setLastUpdateDate($lastUpdateDate)
    {
        $this->lastUpdateDate = $lastUpdateDate;
    }

    /**
     * Returns the orderStatus
     * 
     * @return int orderStatus
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * Sets the orderStatus
     * 
     * @param int $orderStatus
     * @return void
     */
    public function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;
    }

    /**
     * Returns the fulfillmentChannel
     * 
     * @return int fulfillmentChannel
     */
    public function getFulfillmentChannel()
    {
        return $this->fulfillmentChannel;
    }

    /**
     * Sets the fulfillmentChannel
     * 
     * @param int $fulfillmentChannel
     * @return void
     */
    public function setFulfillmentChannel($fulfillmentChannel)
    {
        $this->fulfillmentChannel = $fulfillmentChannel;
    }

    /**
     * Returns the shipServiceLevel
     * 
     * @return int shipServiceLevel
     */
    public function getShipServiceLevel()
    {
        return $this->shipServiceLevel;
    }

    /**
     * Sets the shipServiceLevel
     * 
     * @param float $shipServiceLevel
     * @return void
     */
    public function setShipServiceLevel($shipServiceLevel)
    {
        $this->shipServiceLevel = $shipServiceLevel;
    }

    /**
     * Returns the salesChannelName
     * 
     * @return string salesChannelName
     */
    public function getSalesChannelName()
    {
        $this->salesChannelName = $this->gj[$this->salesChannel];
        return $this->salesChannelName;
    }

    /**
     * Returns the salesChannel
     * 
     * @return string salesChannel
     */
    public function getSalesChannel()
    {
        return $this->salesChannel;
    }

    /**
     * Sets the salesChannel
     * 
     * @param string $salesChannel
     * @return void
     */
    public function setSalesChannel($salesChannel)
    {
        $this->salesChannel = $salesChannel;
    }

    /**
     * Returns the currencyCode
     * 
     * @return string $currencyCode
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * Sets the currencyCode
     * 
     * @param string $currencyCode
     * @return void
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
    }

    /**
     * Returns the amount
     * 
     * @return string $amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Sets the amount
     * 
     * @param string $amount
     * @return void
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Returns the purchase
     * 
     * @return int $purchase
     */
    public function getPurchase()
    {
        return $this->purchase;
    }

    /**
     * Sets the purchase
     * 
     * @param int $purchase
     * @return void
     */
    public function setPurchase($purchase)
    {
        $this->purchase = $purchase;
    }

    /**
     * Returns the freight
     * 
     * @return string $freight
     */
    public function getFreight()
    {
        return $this->freight;
    }

    /**
     * Sets the freight
     * 
     * @param string $freight
     * @return void
     */
    public function setFreight($freight)
    {
        $this->freight = $freight;
    }

    /**
     * Returns the numberOfItemsShipped
     * 
     * @return int $numberOfItemsShipped
     */
    public function getNumberOfItemsShipped()
    {
        return $this->numberOfItemsShipped;
    }

    /**
     * Sets the numberOfItemsShipped
     * 
     * @param int $numberOfItemsShipped
     * @return void
     */
    public function setNumberOfItemsShipped($numberOfItemsShipped)
    {
        $this->numberOfItemsShipped = $numberOfItemsShipped;
    }

    /**
     * Returns the numberOfItemsUnshipped
     * 
     * @return int $numberOfItemsUnshipped
     */
    public function getNumberOfItemsUnshipped()
    {
        return $this->numberOfItemsUnshipped;
    }

    /**
     * Sets the numberOfItemsUnshipped
     * 
     * @param int $numberOfItemsUnshipped
     * @return void
     */
    public function setNumberOfItemsUnshipped($numberOfItemsUnshipped)
    {
        $this->numberOfItemsUnshipped = $numberOfItemsUnshipped;
    }

    /**
     * Returns the paymentMethod
     * 
     * @return string $paymentMethod
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Sets the paymentMethod
     * 
     * @param string $paymentMethod
     * @return void
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * Returns the paymentMethodDetails
     * 
     * @return string $paymentMethodDetails
     */
    public function getPaymentMethodDetails()
    {
        return $this->paymentMethodDetails;
    }

    /**
     * Sets the paymentMethodDetails
     * 
     * @param string $paymentMethodDetails
     * @return void
     */
    public function setPaymentMethodDetails($paymentMethodDetails)
    {
        $this->paymentMethodDetails = $paymentMethodDetails;
    }

    /**
     * Returns the marketplaceId
     * 
     * @return string $marketplaceId
     */
    public function getMarketplaceId()
    {
        return $this->marketplaceId;
    }

    /**
     * Sets the marketplaceId
     * 
     * @param string $marketplaceId
     * @return void
     */
    public function setMarketplaceId($marketplaceId)
    {
        $this->marketplaceId = $marketplaceId;
    }

    /**
     * Returns the shipmentServiceLevelCategory
     * 
     * @return string $shipmentServiceLevelCategory
     */
    public function getShipmentServiceLevelCategory()
    {
        return $this->shipmentServiceLevelCategory;
    }

    /**
     * Sets the shipmentServiceLevelCategory
     * 
     * @param string $shipmentServiceLevelCategory
     * @return void
     */
    public function setShipmentServiceLevelCategory($shipmentServiceLevelCategory)
    {
        $this->shipmentServiceLevelCategory = $shipmentServiceLevelCategory;
    }

    /**
     * Returns the shippedByAmazonTFM
     * 
     * @return int $shippedByAmazonTFM
     */
    public function getShippedByAmazonTFM()
    {
        return $this->shippedByAmazonTFM;
    }

    /**
     * Sets the shippedByAmazonTFM
     * 
     * @param int $shippedByAmazonTFM
     * @return void
     */
    public function setShippedByAmazonTFM($shippedByAmazonTFM)
    {
        $this->shippedByAmazonTFM = $shippedByAmazonTFM;
    }

    /**
     * Returns the orderType
     * 
     * @return string $orderType
     */
    public function getOrderType()
    {
        return $this->orderType;
    }

    /**
     * Sets the orderType
     * 
     * @param string $orderType
     * @return void
     */
    public function setOrderType($orderType)
    {
        $this->orderType = $orderType;
    }

    /**
     * Returns the earliestShipDate
     * 
     * @return int $earliestShipDate
     */
    public function getEarliestShipDate()
    {
        return $this->earliestShipDate;
    }

    /**
     * Sets the earliestShipDate
     * 
     * @param int $earliestShipDate
     * @return void
     */
    public function setEarliestShipDate($earliestShipDate)
    {
        $this->earliestShipDate = $earliestShipDate;
    }

    /**
     * Returns the latestShipDate
     * 
     * @return int $latestShipDate
     */
    public function getLatestShipDate()
    {
        return $this->latestShipDate;
    }

    /**
     * Sets the latestShipDate
     * 
     * @param int $latestShipDate
     * @return void
     */
    public function setLatestShipDate($latestShipDate)
    {
        $this->latestShipDate = $latestShipDate;
    }

    /**
     * Returns the earliestDeliveryDate
     * 
     * @return int $earliestDeliveryDate
     */
    public function getEarliestDeliveryDate()
    {
        return $this->earliestDeliveryDate;
    }

    /**
     * Sets the earliestDeliveryDate
     * 
     * @param int $earliestDeliveryDate
     * @return void
     */
    public function setEarliestDeliveryDate($earliestDeliveryDate)
    {
        $this->earliestDeliveryDate = $earliestDeliveryDate;
    }

    /**
     * Returns the latestDeliveryDate
     * 
     * @return int $latestDeliveryDate
     */
    public function getLatestDeliveryDate()
    {
        return $this->latestDeliveryDate;
    }

    /**
     * Sets the latestDeliveryDate
     * 
     * @param int $latestDeliveryDate
     * @return void
     */
    public function setLatestDeliveryDate($latestDeliveryDate)
    {
        $this->latestDeliveryDate = $latestDeliveryDate;
    }

    /**
     * Returns the businessOrder
     * 
     * @return int $businessOrder
     */
    public function getBusinessOrder()
    {
        return $this->businessOrder;
    }

    /**
     * Sets the businessOrder
     * 
     * @param int $businessOrder
     * @return void
     */
    public function setBusinessOrder($businessOrder)
    {
        $this->businessOrder = $businessOrder;
    }

    /**
     * Returns the prime
     * 
     * @return int $prime
     */
    public function getPrime()
    {
        return $this->prime;
    }

    /**
     * Sets the prime
     * 
     * @param int $prime
     * @return void
     */
    public function setPrime($prime)
    {
        $this->prime = $prime;
    }

    /**
     * Returns the globalExpressEnabled
     * 
     * @return int $globalExpressEnabled
     */
    public function getGlobalExpressEnabled()
    {
        return $this->globalExpressEnabled;
    }

    /**
     * Sets the globalExpressEnabled
     * 
     * @param int $globalExpressEnabled
     * @return void
     */
    public function setGlobalExpressEnabled($globalExpressEnabled)
    {
        $this->globalExpressEnabled = $globalExpressEnabled;
    }

    /**
     * Returns the premiumOrder
     * 
     * @return int $premiumOrder
     */
    public function getPremiumOrder()
    {
        return $this->premiumOrder;
    }

    /**
     * Sets the premiumOrder
     * 
     * @param int $premiumOrder
     * @return void
     */
    public function setPremiumOrder($premiumOrder)
    {
        $this->premiumOrder = $premiumOrder;
    }

    /**
     * Returns the replacementOrder
     * 
     * @return int $replacementOrder
     */
    public function getReplacementOrder()
    {
        return $this->replacementOrder;
    }

    /**
     * Sets the replacementOrder
     * 
     * @param int $replacementOrder
     * @return void
     */
    public function setReplacementOrder($replacementOrder)
    {
        $this->replacementOrder = $replacementOrder;
    }

    /**
     * Returns the soldByAB
     * 
     * @return int $soldByAB
     */
    public function getSoldByAB()
    {
        return $this->soldByAB;
    }

    /**
     * Sets the soldByAB
     * 
     * @param int $soldByAB
     * @return void
     */
    public function setSoldByAB($soldByAB)
    {
        $this->soldByAB = $soldByAB;
    }

    /**
     * Returns the goods
     * 
     * @return \ERP\ErpManagementProduct\Domain\Model\Product goods
     */
    public function getGoods()
    {
        return $this->goods;
    }

    /**
     * Sets the goods
     * 
     * @param string $goods
     * @return void
     */
    public function setGoods($goods)
    {
        $this->goods = $goods;
    }

    /**
     * Returns the erpuser
     * 
     * @return \ERP\ErpManagementUser\Domain\Model\ErpUser erpuser
     */
    public function getErpuser()
    {
        return $this->erpuser;
    }

    /**
     * Sets the erpuser
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUser $erpuser
     * @return void
     */
    public function setErpuser(\ERP\ErpManagementUser\Domain\Model\ErpUser $erpuser)
    {
        $this->erpuser = $erpuser;
    }

    /**
     * Returns the address
     * 
     * @return \ERP\ErpManagementOrder\Domain\Model\Address $address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets the address
     * 
     * @param \ERP\ErpManagementOrder\Domain\Model\Address $address
     * @return void
     */
    public function setAddress(\ERP\ErpManagementOrder\Domain\Model\Address $address)
    {
        $this->address = $address;
    }

    /**
     * Returns the shipper
     * 
     * @return \ERP\ErpManagementOrder\Domain\Model\Shipper $shipper
     */
    public function getShipper()
    {
        return $this->shipper;
    }

    /**
     * Sets the shipper
     * 
     * @param \ERP\ErpManagementOrder\Domain\Model\Shipper $shipper
     * @return void
     */
    public function setShipper(\ERP\ErpManagementOrder\Domain\Model\Shipper $shipper)
    {
        $this->shipper = $shipper;
    }

    /**
     * Returns the revenue
     * 
     * @return \ERP\ErpManagementOrder\Domain\Model\Revenue $revenue
     */
    public function getRevenue()
    {
        return $this->revenue;
    }

    /**
     * Sets the revenue
     * 
     * @param \ERP\ErpManagementOrder\Domain\Model\Revenue $revenue
     * @return void
     */
    public function setRevenue(\ERP\ErpManagementOrder\Domain\Model\Revenue $revenue)
    {
        $this->revenue = $revenue;
    }

    
}
