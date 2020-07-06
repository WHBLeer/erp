<?php
namespace ERP\ErpManagementLogistics\Domain\Model;


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
 * 用户管理
 */
class Logistics extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 国内运单号
     * 
     * @var string
     */
    protected $domesticWaybill = '';

    /**
     * 国际运单号
     * 
     * @var string
     */
    protected $internationalWaybill = '';

    /**
     * 客户订单号,不能重复
     * 
     * @var string
     */
    protected $customerOrderNumber = 0.0;

    /**
     * 运输方式代码
     * 
     * @var string
     */
    protected $shippingMethodCode = 0.0;

    /**
     * 包裹跟踪号，可以不填写
     * 
     * @var string
     */
    protected $trackingNumber = 0;

    /**
     * 平台交易号（wish 邮）
     * 
     * @var string
     */
    protected $transactionNumber = 0.0;

    /**
     * 收件人税号，巴西国家必填 CPF 或 CNPJ，CPF 码格式为
     * 000.000.000-00,CNPJ 码格式为 00.000.000/0000-00，欧盟可以填 EORI
     * 
     * @var string
     */
    protected $taxNumber = 0;

    /**
     * 预估包裹单边长，单位 cm，非必填，默认1
     * 
     * @var int
     */
    protected $length = 0;

    /**
     * 预估包裹单边宽，单位 cm，非必填，默认1
     * 
     * @var int
     */
    protected $width = 0;

    /**
     * 预估包裹单边高，单位 cm，非必填，默认1
     * 
     * @var int
     */
    protected $height = 0;

    /**
     * 运单包裹的件数，必须大于 0 的整数
     * 
     * @var int
     */
    protected $packageCount = 0;

    /**
     * 预估包裹总重量，单位 kg,最多 3 位小数
     * 
     * @var float
     */
    protected $weight = 0.0;

    /**
     * 申报类型, 用于打印 CN22，1-Gift,2-Sameple,3-Documents,4-Others, 默认
     * 4-Other
     * 
     * @var int
     */
    protected $applicationType = 0;

    /**
     * 是否退回,包裹无人签收时是否退回，1-退回，0-不退回，默认
     * 0
     * 
     * @var int
     */
    protected $returnOption = 0;

    /**
     * 关税预付服务费，1-参加关税预付，0-不参加关税预付，默认
     * 0 (渠道需开通关税预付服务)
     * 
     * @var int
     */
    protected $tariffPrepay = 0;

    /**
     * 包裹投保类型，0-不参保，1-按件，2-按比例，默认
     * 0，表示不参加运输保险，具体参考包裹运输
     * 
     * @var int
     */
    protected $insuranceOption = 0;

    /**
     * 保险的最高额度，单位 RMB
     * 
     * @var float
     */
    protected $coverage = 0.0;

    /**
     * 包裹中特殊货品类型，可调用货品类型查询服务查询，可以不填写，表示普通货品
     * 
     * @var int
     */
    protected $sensitiveTypeID = 0;

    /**
     * 订单来源代码
     * 
     * @var string
     */
    protected $sourceCode = '';

    /**
     * 用户
     * 
     * @var \ERP\ErpManagementUser\Domain\Model\ErpUser
     */
    protected $erpuser = null;

    /**
     * 收件人
     * 
     * @var \ERP\ErpManagementLogistics\Domain\Model\Receiver
     */
    protected $receiver = null;

    /**
     * 发件人
     * 
     * @var \ERP\ErpManagementLogistics\Domain\Model\Sender
     */
    protected $sender = null;

    /**
     * 申报信息
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementLogistics\Domain\Model\Parcels>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $parcels = null;

    /**
     * 箱子明细信息，FBA 订单必填
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementLogistics\Domain\Model\ChildOrders>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $childOrders = null;

    /**
     * Returns the domesticWaybill
     * 
     * @return string $domesticWaybill
     */
    public function getDomesticWaybill()
    {
        return $this->domesticWaybill;
    }

    /**
     * Sets the domesticWaybill
     * 
     * @param string $domesticWaybill
     * @return void
     */
    public function setDomesticWaybill($domesticWaybill)
    {
        $this->domesticWaybill = $domesticWaybill;
    }

    /**
     * Returns the internationalWaybill
     * 
     * @return string $internationalWaybill
     */
    public function getInternationalWaybill()
    {
        return $this->internationalWaybill;
    }

    /**
     * Sets the internationalWaybill
     * 
     * @param string $internationalWaybill
     * @return void
     */
    public function setInternationalWaybill($internationalWaybill)
    {
        $this->internationalWaybill = $internationalWaybill;
    }

    /**
     * Returns the customerOrderNumber
     * 
     * @return string customerOrderNumber
     */
    public function getCustomerOrderNumber()
    {
        return $this->customerOrderNumber;
    }

    /**
     * Sets the customerOrderNumber
     * 
     * @param float $customerOrderNumber
     * @return void
     */
    public function setCustomerOrderNumber($customerOrderNumber)
    {
        $this->customerOrderNumber = $customerOrderNumber;
    }

    /**
     * Returns the shippingMethodCode
     * 
     * @return string shippingMethodCode
     */
    public function getShippingMethodCode()
    {
        return $this->shippingMethodCode;
    }

    /**
     * Sets the shippingMethodCode
     * 
     * @param float $shippingMethodCode
     * @return void
     */
    public function setShippingMethodCode($shippingMethodCode)
    {
        $this->shippingMethodCode = $shippingMethodCode;
    }

    /**
     * Returns the trackingNumber
     * 
     * @return string trackingNumber
     */
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }

    /**
     * Sets the trackingNumber
     * 
     * @param int $trackingNumber
     * @return void
     */
    public function setTrackingNumber($trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;
    }

    /**
     * Returns the transactionNumber
     * 
     * @return string transactionNumber
     */
    public function getTransactionNumber()
    {
        return $this->transactionNumber;
    }

    /**
     * Sets the transactionNumber
     * 
     * @param float $transactionNumber
     * @return void
     */
    public function setTransactionNumber($transactionNumber)
    {
        $this->transactionNumber = $transactionNumber;
    }

    /**
     * Returns the taxNumber
     * 
     * @return string taxNumber
     */
    public function getTaxNumber()
    {
        return $this->taxNumber;
    }

    /**
     * Sets the taxNumber
     * 
     * @param int $taxNumber
     * @return void
     */
    public function setTaxNumber($taxNumber)
    {
        $this->taxNumber = $taxNumber;
    }

    /**
     * Returns the length
     * 
     * @return int length
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Sets the length
     * 
     * @param int $length
     * @return void
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * Returns the width
     * 
     * @return int width
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Sets the width
     * 
     * @param int $width
     * @return void
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * Returns the height
     * 
     * @return int height
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Sets the height
     * 
     * @param int $height
     * @return void
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * Returns the packageCount
     * 
     * @return int packageCount
     */
    public function getPackageCount()
    {
        return $this->packageCount;
    }

    /**
     * Sets the packageCount
     * 
     * @param int $packageCount
     * @return void
     */
    public function setPackageCount($packageCount)
    {
        $this->packageCount = $packageCount;
    }

    /**
     * __construct
     */
    public function __construct()
    {

        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     * 
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->parcels = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->childOrders = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
     * Returns the applicationType
     * 
     * @return int $applicationType
     */
    public function getApplicationType()
    {
        return $this->applicationType;
    }

    /**
     * Sets the applicationType
     * 
     * @param int $applicationType
     * @return void
     */
    public function setApplicationType($applicationType)
    {
        $this->applicationType = $applicationType;
    }

    /**
     * Returns the returnOption
     * 
     * @return int $returnOption
     */
    public function getReturnOption()
    {
        return $this->returnOption;
    }

    /**
     * Sets the returnOption
     * 
     * @param int $returnOption
     * @return void
     */
    public function setReturnOption($returnOption)
    {
        $this->returnOption = $returnOption;
    }

    /**
     * Returns the tariffPrepay
     * 
     * @return int $tariffPrepay
     */
    public function getTariffPrepay()
    {
        return $this->tariffPrepay;
    }

    /**
     * Sets the tariffPrepay
     * 
     * @param int $tariffPrepay
     * @return void
     */
    public function setTariffPrepay($tariffPrepay)
    {
        $this->tariffPrepay = $tariffPrepay;
    }

    /**
     * Returns the insuranceOption
     * 
     * @return int $insuranceOption
     */
    public function getInsuranceOption()
    {
        return $this->insuranceOption;
    }

    /**
     * Sets the insuranceOption
     * 
     * @param int $insuranceOption
     * @return void
     */
    public function setInsuranceOption($insuranceOption)
    {
        $this->insuranceOption = $insuranceOption;
    }

    /**
     * Returns the coverage
     * 
     * @return float $coverage
     */
    public function getCoverage()
    {
        return $this->coverage;
    }

    /**
     * Sets the coverage
     * 
     * @param float $coverage
     * @return void
     */
    public function setCoverage($coverage)
    {
        $this->coverage = $coverage;
    }

    /**
     * Returns the sensitiveTypeID
     * 
     * @return int $sensitiveTypeID
     */
    public function getSensitiveTypeID()
    {
        return $this->sensitiveTypeID;
    }

    /**
     * Sets the sensitiveTypeID
     * 
     * @param int $sensitiveTypeID
     * @return void
     */
    public function setSensitiveTypeID($sensitiveTypeID)
    {
        $this->sensitiveTypeID = $sensitiveTypeID;
    }

    /**
     * Returns the sourceCode
     * 
     * @return string $sourceCode
     */
    public function getSourceCode()
    {
        return $this->sourceCode;
    }

    /**
     * Sets the sourceCode
     * 
     * @param string $sourceCode
     * @return void
     */
    public function setSourceCode($sourceCode)
    {
        $this->sourceCode = $sourceCode;
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
     * Returns the receiver
     * 
     * @return \ERP\ErpManagementLogistics\Domain\Model\Receiver receiver
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Sets the receiver
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\Receiver $receiver
     * @return void
     */
    public function setReceiver(\ERP\ErpManagementLogistics\Domain\Model\Receiver $receiver)
    {
        $this->receiver = $receiver;
    }

    /**
     * Returns the sender
     * 
     * @return \ERP\ErpManagementLogistics\Domain\Model\Sender $sender
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Sets the sender
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\Sender $sender
     * @return void
     */
    public function setSender(\ERP\ErpManagementLogistics\Domain\Model\Sender $sender)
    {
        $this->sender = $sender;
    }

    /**
     * Adds a Parcels
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\Parcels $parcel
     * @return void
     */
    public function addParcel(\ERP\ErpManagementLogistics\Domain\Model\Parcels $parcel)
    {
        $this->parcels->attach($parcel);
    }

    /**
     * Removes a Parcels
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\Parcels $parcelToRemove The Parcels to be removed
     * @return void
     */
    public function removeParcel(\ERP\ErpManagementLogistics\Domain\Model\Parcels $parcelToRemove)
    {
        $this->parcels->detach($parcelToRemove);
    }

    /**
     * Returns the parcels
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementLogistics\Domain\Model\Parcels> $parcels
     */
    public function getParcels()
    {
        return $this->parcels;
    }

    /**
     * Sets the parcels
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementLogistics\Domain\Model\Parcels> $parcels
     * @return void
     */
    public function setParcels(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $parcels)
    {
        $this->parcels = $parcels;
    }

    /**
     * Adds a ChildOrders
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\ChildOrders $childOrder
     * @return void
     */
    public function addChildOrder(\ERP\ErpManagementLogistics\Domain\Model\ChildOrders $childOrder)
    {
        $this->childOrders->attach($childOrder);
    }

    /**
     * Removes a ChildOrders
     * 
     * @param \ERP\ErpManagementLogistics\Domain\Model\ChildOrders $childOrderToRemove The ChildOrders to be removed
     * @return void
     */
    public function removeChildOrder(\ERP\ErpManagementLogistics\Domain\Model\ChildOrders $childOrderToRemove)
    {
        $this->childOrders->detach($childOrderToRemove);
    }

    /**
     * Returns the childOrders
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementLogistics\Domain\Model\ChildOrders> $childOrders
     */
    public function getChildOrders()
    {
        return $this->childOrders;
    }

    /**
     * Sets the childOrders
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementLogistics\Domain\Model\ChildOrders> $childOrders
     * @return void
     */
    public function setChildOrders(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $childOrders)
    {
        $this->childOrders = $childOrders;
    }
}
