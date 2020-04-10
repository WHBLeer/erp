<?php
namespace ERP\ErpManagementProduct\Domain\Model;


/***
 *
 * This file is part of the "产品管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * 产品信息
 */
class Info extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 厂家名称
     * 
     * @var string
     */
    protected $tradeName = '';

    /**
     * 品牌名称
     * 
     * @var string
     */
    protected $brandName = '';

    /**
     * 厂家编号
     * 
     * @var string
     */
    protected $tradeNum = '';

    /**
     * 内部sku
     * 
     * @var string
     */
    protected $sku = '';

    /**
     * 产品来源
     * 
     * @var string
     */
    protected $source = '';

    /**
     * 产品地址
     * 
     * @var string
     */
    protected $link = '';

    /**
     * 产品码
     * 
     * @var string
     */
    protected $code = '';

    /**
     * 备注
     * 
     * @var string
     */
    protected $remark = '';

    /**
     * Returns the tradeName
     * 
     * @return string $tradeName
     */
    public function getTradeName()
    {
        return $this->tradeName;
    }

    /**
     * Sets the tradeName
     * 
     * @param string $tradeName
     * @return void
     */
    public function setTradeName($tradeName)
    {
        $this->tradeName = $tradeName;
    }

    /**
     * Returns the brandName
     * 
     * @return string $brandName
     */
    public function getBrandName()
    {
        return $this->brandName;
    }

    /**
     * Sets the brandName
     * 
     * @param string $brandName
     * @return void
     */
    public function setBrandName($brandName)
    {
        $this->brandName = $brandName;
    }

    /**
     * Returns the tradeNum
     * 
     * @return string $tradeNum
     */
    public function getTradeNum()
    {
        return $this->tradeNum;
    }

    /**
     * Sets the tradeNum
     * 
     * @param string $tradeNum
     * @return void
     */
    public function setTradeNum($tradeNum)
    {
        $this->tradeNum = $tradeNum;
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
     * Returns the source
     * 
     * @return string $source
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Sets the source
     * 
     * @param string $source
     * @return void
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * Returns the link
     * 
     * @return string $link
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Sets the link
     * 
     * @param string $link
     * @return void
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * Returns the code
     * 
     * @return string $code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Sets the code
     * 
     * @param string $code
     * @return void
     */
    public function setCode($code)
    {
        $this->code = $code;
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
}
