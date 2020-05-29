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
    protected $purchaseDate = '';

    /**
     * 最后一次更新时间
     * 
     * 
     * @var int
     */
    protected $lastUpdateDate = 0.0;

    /**
     * 订单状态
     * 
     * 
     * @var int
     */
    protected $orderStatus = 0.0;

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
    protected $shipServiceLevel = 0.0;

    /**
     * 销售渠道
     * 
     * 
     * @var string
     */
    protected $salesChannel = 0;

    /**
     * 送货人
     * 
     * 
     * @var string
     */
    protected $shipperName = 0;

    /**
     * 送货地址1
     * 
     * 
     * @var string
     */
    protected $shipperAddressLine1 = 0;

    /**
     * 送货地址2
     * 
     * 
     * @var int
     */
    protected $shipperAddressLine2 = 0;

    /**
     * 送货地址3
     * 
     * @var int
     */
    protected $shipperAddressLine3 = 0;

    /**
     * 发货城市
     * 
     * 
     * @var string
     */
    protected $shipperCity = '';

    /**
     * 发货地区
     * 
     * 
     * @var string
     */
    protected $shipperStateOrRegion = '';

    /**
     * 发货城市代码
     * 
     * 
     * @var string
     */
    protected $shipperCountryCode = '';

    /**
     * 发货人电话
     * 
     * 
     * @var string
     */
    protected $shipperPhone = '';

    /**
     * 地址类型
     * 
     * 
     * @var string
     */
    protected $shipperAddressType = '';

    /**
     * 是否地址共享
     * 
     * 
     * @var int
     */
    protected $shipperIsAddressSharingConfidential = 0;

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
    protected $amount = '';

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
     * 买家电子邮件
     * 
     * 
     * @var string
     */
    protected $buyerEmail = '';

    /**
     * 买家姓名
     * 
     * 
     * @var string
     */
    protected $buyerName = '';

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
     * 目的地国家
     * 
     * @var \ERP\ErpManagementUser\Domain\Model\ErpUser
     */
    protected $erpuser = null;

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
     * @param string $purchaseDate
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
     * @param float $lastUpdateDate
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
     * @param float $orderStatus
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
     * @param int $salesChannel
     * @return void
     */
    public function setSalesChannel($salesChannel)
    {
        $this->salesChannel = $salesChannel;
    }

    /**
     * Returns the shipperName
     * 
     * @return string shipperName
     */
    public function getShipperName()
    {
        return $this->shipperName;
    }

    /**
     * Sets the shipperName
     * 
     * @param int $shipperName
     * @return void
     */
    public function setShipperName($shipperName)
    {
        $this->shipperName = $shipperName;
    }

    /**
     * Returns the shipperAddressLine1
     * 
     * @return string shipperAddressLine1
     */
    public function getShipperAddressLine1()
    {
        return $this->shipperAddressLine1;
    }

    /**
     * Sets the shipperAddressLine1
     * 
     * @param int $shipperAddressLine1
     * @return void
     */
    public function setShipperAddressLine1($shipperAddressLine1)
    {
        $this->shipperAddressLine1 = $shipperAddressLine1;
    }

    /**
     * Returns the shipperAddressLine2
     * 
     * @return int shipperAddressLine2
     */
    public function getShipperAddressLine2()
    {
        return $this->shipperAddressLine2;
    }

    /**
     * Sets the shipperAddressLine2
     * 
     * @param int $shipperAddressLine2
     * @return void
     */
    public function setShipperAddressLine2($shipperAddressLine2)
    {
        $this->shipperAddressLine2 = $shipperAddressLine2;
    }

    /**
     * Returns the shipperAddressLine3
     * 
     * @return int shipperAddressLine3
     */
    public function getShipperAddressLine3()
    {
        return $this->shipperAddressLine3;
    }

    /**
     * Sets the shipperAddressLine3
     * 
     * @param int $shipperAddressLine3
     * @return void
     */
    public function setShipperAddressLine3($shipperAddressLine3)
    {
        $this->shipperAddressLine3 = $shipperAddressLine3;
    }

    /**
     * Returns the shipperCity
     * 
     * @return string $shipperCity
     */
    public function getShipperCity()
    {
        return $this->shipperCity;
    }

    /**
     * Sets the shipperCity
     * 
     * @param string $shipperCity
     * @return void
     */
    public function setShipperCity($shipperCity)
    {
        $this->shipperCity = $shipperCity;
    }

    /**
     * Returns the shipperStateOrRegion
     * 
     * @return string $shipperStateOrRegion
     */
    public function getShipperStateOrRegion()
    {
        return $this->shipperStateOrRegion;
    }

    /**
     * Sets the shipperStateOrRegion
     * 
     * @param string $shipperStateOrRegion
     * @return void
     */
    public function setShipperStateOrRegion($shipperStateOrRegion)
    {
        $this->shipperStateOrRegion = $shipperStateOrRegion;
    }

    /**
     * Returns the shipperCountryCode
     * 
     * @return string $shipperCountryCode
     */
    public function getShipperCountryCode()
    {
        return $this->shipperCountryCode;
    }

    /**
     * Sets the shipperCountryCode
     * 
     * @param string $shipperCountryCode
     * @return void
     */
    public function setShipperCountryCode($shipperCountryCode)
    {
        $this->shipperCountryCode = $shipperCountryCode;
    }

    /**
     * Returns the shipperPhone
     * 
     * @return string $shipperPhone
     */
    public function getShipperPhone()
    {
        return $this->shipperPhone;
    }

    /**
     * Sets the shipperPhone
     * 
     * @param string $shipperPhone
     * @return void
     */
    public function setShipperPhone($shipperPhone)
    {
        $this->shipperPhone = $shipperPhone;
    }

    /**
     * Returns the shipperAddressType
     * 
     * @return string $shipperAddressType
     */
    public function getShipperAddressType()
    {
        return $this->shipperAddressType;
    }

    /**
     * Sets the shipperAddressType
     * 
     * @param string $shipperAddressType
     * @return void
     */
    public function setShipperAddressType($shipperAddressType)
    {
        $this->shipperAddressType = $shipperAddressType;
    }

    /**
     * Returns the shipperIsAddressSharingConfidential
     * 
     * @return int $shipperIsAddressSharingConfidential
     */
    public function getShipperIsAddressSharingConfidential()
    {
        return $this->shipperIsAddressSharingConfidential;
    }

    /**
     * Sets the shipperIsAddressSharingConfidential
     * 
     * @param int $shipperIsAddressSharingConfidential
     * @return void
     */
    public function setShipperIsAddressSharingConfidential($shipperIsAddressSharingConfidential)
    {
        $this->shipperIsAddressSharingConfidential = $shipperIsAddressSharingConfidential;
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
     * Returns the buyerEmail
     * 
     * @return string $buyerEmail
     */
    public function getBuyerEmail()
    {
        return $this->buyerEmail;
    }

    /**
     * Sets the buyerEmail
     * 
     * @param string $buyerEmail
     * @return void
     */
    public function setBuyerEmail($buyerEmail)
    {
        $this->buyerEmail = $buyerEmail;
    }

    /**
     * Returns the buyerName
     * 
     * @return string $buyerName
     */
    public function getBuyerName()
    {
        return $this->buyerName;
    }

    /**
     * Sets the buyerName
     * 
     * @param string $buyerName
     * @return void
     */
    public function setBuyerName($buyerName)
    {
        $this->buyerName = $buyerName;
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
}
