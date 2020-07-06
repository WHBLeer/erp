<?php
namespace ERP\ErpManagementLogistics\Domain\Model;


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
 * 申报信息
 */
class Parcels extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 包裹申报名称(英文)必填
     * 
     * @var string
     */
    protected $eName = '';

    /**
     * 包裹申报名称
     * 
     * @var string
     */
    protected $cName = '';

    /**
     * 海关编码
     * 
     * @var string
     */
    protected $hSCode = '';

    /**
     * 申报数量
     * 
     * @var int
     */
    protected $quantity = 0;

    /**
     * 申报价格(单价),单位 USD,必填
     * 
     * @var float
     */
    protected $unitPrice = 0.0;

    /**
     * 申报重量(单重)，单位 kg
     * 
     * @var float
     */
    protected $unitWeight = 0.0;

    /**
     * 备注
     * 
     * @var string
     */
    protected $remark = '';

    /**
     * 产品销售链接地址
     * 
     * @var string
     */
    protected $productUrl = '';

    /**
     * 用于填写商品SKU，FBA订单必填
     * 
     * @var string
     */
    protected $sku = '';

    /**
     * 配货信息
     * 
     * @var string
     */
    protected $invoiceRemark = '';

    /**
     * 申报币种，默认：USD
     * 
     * @var string
     */
    protected $currencyCode = '';

    /**
     * Returns the eName
     * 
     * @return string $eName
     */
    public function getEName()
    {
        return $this->eName;
    }

    /**
     * Sets the eName
     * 
     * @param string $eName
     * @return void
     */
    public function setEName($eName)
    {
        $this->eName = $eName;
    }

    /**
     * Returns the cName
     * 
     * @return string $cName
     */
    public function getCName()
    {
        return $this->cName;
    }

    /**
     * Sets the cName
     * 
     * @param string $cName
     * @return void
     */
    public function setCName($cName)
    {
        $this->cName = $cName;
    }

    /**
     * Returns the hSCode
     * 
     * @return string $hSCode
     */
    public function getHSCode()
    {
        return $this->hSCode;
    }

    /**
     * Sets the hSCode
     * 
     * @param string $hSCode
     * @return void
     */
    public function setHSCode($hSCode)
    {
        $this->hSCode = $hSCode;
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
     * Returns the unitPrice
     * 
     * @return float $unitPrice
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * Sets the unitPrice
     * 
     * @param float $unitPrice
     * @return void
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * Returns the unitWeight
     * 
     * @return float $unitWeight
     */
    public function getUnitWeight()
    {
        return $this->unitWeight;
    }

    /**
     * Sets the unitWeight
     * 
     * @param float $unitWeight
     * @return void
     */
    public function setUnitWeight($unitWeight)
    {
        $this->unitWeight = $unitWeight;
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
     * Returns the productUrl
     * 
     * @return string $productUrl
     */
    public function getProductUrl()
    {
        return $this->productUrl;
    }

    /**
     * Sets the productUrl
     * 
     * @param string $productUrl
     * @return void
     */
    public function setProductUrl($productUrl)
    {
        $this->productUrl = $productUrl;
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
     * Returns the invoiceRemark
     * 
     * @return string $invoiceRemark
     */
    public function getInvoiceRemark()
    {
        return $this->invoiceRemark;
    }

    /**
     * Sets the invoiceRemark
     * 
     * @param string $invoiceRemark
     * @return void
     */
    public function setInvoiceRemark($invoiceRemark)
    {
        $this->invoiceRemark = $invoiceRemark;
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
}
