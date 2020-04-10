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
 * 规格变体
 */
class Variants extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 组合
     * 
     * @var string
     */
    protected $combination = '';

    /**
     * sku修正
     * 
     * @var string
     */
    protected $skuNew = '';

    /**
     * 加价
     * 
     * @var float
     */
    protected $markup = 0.0;

    /**
     * 库存
     * 
     * @var int
     */
    protected $kucun = 0;

    /**
     * UPC/EAN
     * 
     * @var string
     */
    protected $upcEan = '';

    /**
     * 已选图片
     * 
     * @var string
     */
    protected $images = '';

    /**
     * Returns the combination
     * 
     * @return string $combination
     */
    public function getCombination()
    {
        return $this->combination;
    }

    /**
     * Sets the combination
     * 
     * @param string $combination
     * @return void
     */
    public function setCombination($combination)
    {
        $this->combination = $combination;
    }

    /**
     * Returns the markup
     * 
     * @return float $markup
     */
    public function getMarkup()
    {
        return $this->markup;
    }

    /**
     * Sets the markup
     * 
     * @param float $markup
     * @return void
     */
    public function setMarkup($markup)
    {
        $this->markup = $markup;
    }

    /**
     * Returns the kucun
     * 
     * @return int $kucun
     */
    public function getKucun()
    {
        return $this->kucun;
    }

    /**
     * Sets the kucun
     * 
     * @param int $kucun
     * @return void
     */
    public function setKucun($kucun)
    {
        $this->kucun = $kucun;
    }

    /**
     * Returns the upcEan
     * 
     * @return string $upcEan
     */
    public function getUpcEan()
    {
        return $this->upcEan;
    }

    /**
     * Sets the upcEan
     * 
     * @param string $upcEan
     * @return void
     */
    public function setUpcEan($upcEan)
    {
        $this->upcEan = $upcEan;
    }

    /**
     * Returns the images
     * 
     * @return string $images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Sets the images
     * 
     * @param string $images
     * @return void
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * Returns the skuNew
     * 
     * @return string skuNew
     */
    public function getSkuNew()
    {
        return $this->skuNew;
    }

    /**
     * Sets the skuNew
     * 
     * @param string $skuNew
     * @return void
     */
    public function setSkuNew($skuNew)
    {
        $this->skuNew = $skuNew;
    }
}
