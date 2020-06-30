<?php
namespace ERP\ErpManagementOrder\Domain\Model;


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
 * 物流
 */
class Shipper extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 中文名称
     * 
     * @var string
     */
    protected $nameZh = '';

    /**
     * 英文名称
     * 
     * @var string
     */
    protected $nameEn = '';

    /**
     * 货物SKU
     * 
     * @var string
     */
    protected $sku = '';

    /**
     * 运输数量
     * 
     * @var int
     */
    protected $number = 0;

    /**
     * 重量 kg
     * 
     * @var float
     */
    protected $weight = 0.0;

    /**
     * 长度 cm
     * 
     * @var float
     */
    protected $length = 0.0;

    /**
     * 宽度 cm
     * 
     * @var float
     */
    protected $width = 0.0;

    /**
     * 高度 cm
     * 
     * @var float
     */
    protected $height = 0.0;

    /**
     * 收货人邮箱
     * 
     * @var string 
     */
    protected $email = '';

    /**
     * 物流路线
     * 
     * @var int
     */
    protected $route = 0;

    /**
     * 物流商
     * 
     * @var int
     */
    protected $providers = 0;

    /**
     * 国内运单号
     * 
     * @var string
     */
    protected $gnWaybill = '';

    /**
     * 国内追踪号
     * 
     * @var string
     */
    protected $gnTracking = '';

    /**
     * 国际发货状态 0:未发货 1:已发货 2:运输中 3:待签收 4已签收
     * 5拒签
     * 
     * @var int
     */
    protected $gnStatus = 0;

    /**
     * 国际运单号
     * 
     * @var string
     */
    protected $gjWaybill = '';

    /**
     * 国际追踪号
     * 
     * @var string
     */
    protected $gjTracking = '';

    /**
     * 国际发货状态 0:未发货 1:已发货 2:运输中 3:待签收 4已签收
     * 5拒签
     * 
     * @var int
     */
    protected $gjStatus = 0;

    /**
     * 送货地址1
     * 
     * 
     * @var string
     */
    protected $shipperAddressLine1 = '';

    /**
     * 送货地址2
     * 
     * 
     * @var int
     */
    protected $shipperAddressLine2 = '';

    /**
     * 送货地址3
     * 
     * @var int
     */
    protected $shipperAddressLine3 = '';

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
     * 0:正常发货 1:补发货
     * 
     * @var int
     */
    protected $deliveryType = 0;

    /**
     * 备注
     * 
     * @var string
     */
    protected $remark = '';

    /**
     * 邮件
     * 
     * @var string
     */
    protected $customermail = '';

    /**
     * 操作日志 json
     * 
     * @var string
     */
    protected $logs = '';

    /**
     * 补发 ,重新生成运单号,追踪号
     * 
     * @var \ERP\ErpManagementOrder\Domain\Model\Shipper
     */
    protected $reissue = null;

    /**
     * Returns the nameZh
     * 
     * @return string $nameZh
     */
    public function getNameZh()
    {
        return $this->nameZh;
    }

    /**
     * Sets the nameZh
     * 
     * @param string $nameZh
     * @return void
     */
    public function setNameZh($nameZh)
    {
        $this->nameZh = $nameZh;
    }

    /**
     * Returns the nameEn
     * 
     * @return string $nameEn
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * Sets the nameEn
     * 
     * @param string $nameEn
     * @return void
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;
    }

    /**
     * Returns the sku
     * 
     * @return string $sku
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Sets the sku
     * 
     * @param string $sku
     * @return void
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * Returns the number
     * 
     * @return int $number
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Sets the number
     * 
     * @param int $number
     * @return void
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * Returns the weight
     * 
     * @return float $weight
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Sets the weight
     * 
     * @param float $weight
     * @return void
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * Returns the length
     * 
     * @return float $length
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Sets the length
     * 
     * @param float $length
     * @return void
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * Returns the width
     * 
     * @return float $width
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Sets the width
     * 
     * @param float $width
     * @return void
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * Returns the height
     * 
     * @return float $height
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Sets the height
     * 
     * @param float $height
     * @return void
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * Returns the email
     * 
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     * 
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Returns the route
     * 
     * @return int $route
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Sets the route
     * 
     * @param int $route
     * @return void
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * Returns the providers
     * 
     * @return int $providers
     */
    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * Sets the providers
     * 
     * @param int $providers
     * @return void
     */
    public function setProviders($providers)
    {
        $this->providers = $providers;
    }

    /**
     * Returns the gnWaybill
     * 
     * @return string $gnWaybill
     */
    public function getGnWaybill()
    {
        return $this->gnWaybill;
    }

    /**
     * Sets the gnWaybill
     * 
     * @param string $gnWaybill
     * @return void
     */
    public function setGnWaybill($gnWaybill)
    {
        $this->gnWaybill = $gnWaybill;
    }

    /**
     * Returns the gnTracking
     * 
     * @return string $gnTracking
     */
    public function getGnTracking()
    {
        return $this->gnTracking;
    }

    /**
     * Sets the gnTracking
     * 
     * @param string $gnTracking
     * @return void
     */
    public function setGnTracking($gnTracking)
    {
        $this->gnTracking = $gnTracking;
    }

    /**
     * Returns the gnStatus
     * 
     * @return int $gnStatus
     */
    public function getGnStatus()
    {
        return $this->gnStatus;
    }

    /**
     * Sets the gnStatus
     * 
     * @param int $gnStatus
     * @return void
     */
    public function setGnStatus($gnStatus)
    {
        $this->gnStatus = $gnStatus;
    }

    /**
     * Returns the gjWaybill
     * 
     * @return string $gjWaybill
     */
    public function getGjWaybill()
    {
        return $this->gjWaybill;
    }

    /**
     * Sets the gjWaybill
     * 
     * @param string $gjWaybill
     * @return void
     */
    public function setGjWaybill($gjWaybill)
    {
        $this->gjWaybill = $gjWaybill;
    }

    /**
     * Returns the gjTracking
     * 
     * @return string $gjTracking
     */
    public function getGjTracking()
    {
        return $this->gjTracking;
    }

    /**
     * Sets the gjTracking
     * 
     * @param string $gjTracking
     * @return void
     */
    public function setGjTracking($gjTracking)
    {
        $this->gjTracking = $gjTracking;
    }

    /**
     * Returns the gjStatus
     * 
     * @return int $gjStatus
     */
    public function getGjStatus()
    {
        return $this->gjStatus;
    }

    /**
     * Sets the gjStatus
     * 
     * @param int $gjStatus
     * @return void
     */
    public function setGjStatus($gjStatus)
    {
        $this->gjStatus = $gjStatus;
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
     * @param string $shipperAddressLine1
     * @return void
     */
    public function setShipperAddressLine1($shipperAddressLine1)
    {
        $this->shipperAddressLine1 = $shipperAddressLine1;
    }

    /**
     * Returns the shipperAddressLine2
     * 
     * @return string shipperAddressLine2
     */
    public function getShipperAddressLine2()
    {
        return $this->shipperAddressLine2;
    }

    /**
     * Sets the shipperAddressLine2
     * 
     * @param string $shipperAddressLine2
     * @return void
     */
    public function setShipperAddressLine2($shipperAddressLine2)
    {
        $this->shipperAddressLine2 = $shipperAddressLine2;
    }

    /**
     * Returns the shipperAddressLine3
     * 
     * @return string shipperAddressLine3
     */
    public function getShipperAddressLine3()
    {
        return $this->shipperAddressLine3;
    }

    /**
     * Sets the shipperAddressLine3
     * 
     * @param string $shipperAddressLine3
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
     * Returns the deliveryType
     * 
     * @return int $deliveryType
     */
    public function getDeliveryType()
    {
        return $this->deliveryType;
    }

    /**
     * Sets the deliveryType
     * 
     * @param int $deliveryType
     * @return void
     */
    public function setDeliveryType($deliveryType)
    {
        $this->deliveryType = $deliveryType;
    }

    /**
     * Returns the remark
     * 
     * @return string $remark
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Sets the remark
     * 
     * @param string $remark
     * @return void
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
    }

    /**
     * Returns the customermail
     * 
     * @return string $customermail
     */
    public function getCustomermail()
    {
        return $this->customermail;
    }

    /**
     * Sets the customermail
     * 
     * @param string $customermail
     * @return void
     */
    public function setCustomermail($customermail)
    {
        $this->customermail = $customermail;
    }

    /**
     * Returns the logs
     * 
     * @return string $logs
     */
    public function getLogs()
    {
        return $this->logs;
    }

    /**
     * Sets the logs
     * 
     * @param string $logs
     * @return void
     */
    public function setLogs($logs)
    {
        $this->logs = $logs;
    }

    /**
     * Returns the reissue
     * 
     * @return \ERP\ErpManagementOrder\Domain\Model\Shipper $reissue
     */
    public function getReissue()
    {
        return $this->reissue;
    }

    /**
     * Sets the reissue
     * 
     * @param \ERP\ErpManagementOrder\Domain\Model\Shipper $reissue
     * @return void
     */
    public function setReissue(\ERP\ErpManagementOrder\Domain\Model\Shipper $reissue)
    {
        $this->reissue = $reissue;
    }
}
