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
     * 预计运费
     * 
     * @var float
     */
    protected $estimateFreight = 0.0;

    /**
     * 实际运费
     * 
     * @var float
     */
    protected $actualFreight = 0.0;

    /**
     * 预计时效,工作日
     * 
     * @var int
     */
    protected $aging = 0;

    /**
     * 重量(kg)
     * 
     * @var float
     */
    protected $weight = 0.0;

    /**
     * 体积-长(cm)
     * 
     * @var int
     */
    protected $length = 0;

    /**
     * 体积-宽(cm)
     * 
     * @var int
     */
    protected $width = 0;

    /**
     * 体积-高(cm)
     * 
     * @var int
     */
    protected $height = 0;

    /**
     * 商品数量
     * 
     * @var int
     */
    protected $quantity = 0;

    /**
     * 货物类型
     * 
     * @var int
     */
    protected $goodstype = 0;

    /**
     * 目的地国家
     * 
     * @var \ERP\ErpManagementDict\Domain\Model\Region
     */
    protected $country = null;

    /**
     * 目的地国家
     * 
     * @var \ERP\ErpManagementUser\Domain\Model\ErpUser
     */
    protected $erpuser = null;

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
     * Returns the estimateFreight
     * 
     * @return float $estimateFreight
     */
    public function getEstimateFreight()
    {
        return $this->estimateFreight;
    }

    /**
     * Sets the estimateFreight
     * 
     * @param float $estimateFreight
     * @return void
     */
    public function setEstimateFreight($estimateFreight)
    {
        $this->estimateFreight = $estimateFreight;
    }

    /**
     * Returns the actualFreight
     * 
     * @return float $actualFreight
     */
    public function getActualFreight()
    {
        return $this->actualFreight;
    }

    /**
     * Sets the actualFreight
     * 
     * @param float $actualFreight
     * @return void
     */
    public function setActualFreight($actualFreight)
    {
        $this->actualFreight = $actualFreight;
    }

    /**
     * Returns the aging
     * 
     * @return int $aging
     */
    public function getAging()
    {
        return $this->aging;
    }

    /**
     * Sets the aging
     * 
     * @param int $aging
     * @return void
     */
    public function setAging($aging)
    {
        $this->aging = $aging;
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
     * @return int $length
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
     * @return int $width
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
     * @return int $height
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
     * Returns the quantity
     * 
     * @return int $quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Sets the quantity
     * 
     * @param int $quantity
     * @return void
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Returns the goodstype
     * 
     * @return int $goodstype
     */
    public function getGoodstype()
    {
        return $this->goodstype;
    }

    /**
     * Sets the goodstype
     * 
     * @param int $goodstype
     * @return void
     */
    public function setGoodstype($goodstype)
    {
        $this->goodstype = $goodstype;
    }

    /**
     * Returns the country
     * 
     * @return \ERP\ErpManagementDict\Domain\Model\Region country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Sets the country
     * 
     * @param string $country
     * @return void
     */
    public function setCountry($country)
    {
        $this->country = $country;
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
