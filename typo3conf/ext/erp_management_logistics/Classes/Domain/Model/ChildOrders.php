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
 * 箱子明细信息
 */
class ChildOrders extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 箱子编号，FBA订单必填
     * 
     * @var string
     */
    protected $boxNumber = '';

    /**
     * 预估包裹单边长，单位cm，默认 1，FBA订单必填
     * 
     * @var int
     */
    protected $length = 0;

    /**
     * 预估包裹单边宽，单位cm，默认 1，FBA订单必填
     * 
     * @var int
     */
    protected $width = 0;

    /**
     * 预估包裹单边高，单位cm，默认 1，FBA订单必填
     * 
     * @var int
     */
    protected $height = 0;

    /**
     * 预估包裹总重量，单位kg,最多3位小数，FBA订单必填
     * 
     * @var float
     */
    protected $boxWeight = 0.0;

    /**
     * json存储"ChildDetails": [{
     *             "Sku": "sku1001",
     *             "Quantity": 1
     *         }]sku信息
     * 
     * @var string
     */
    protected $childDetails = '';

    /**
     * Returns the boxNumber
     * 
     * @return string $boxNumber
     */
    public function getBoxNumber()
    {
        return $this->boxNumber;
    }

    /**
     * Sets the boxNumber
     * 
     * @param string $boxNumber
     * @return void
     */
    public function setBoxNumber($boxNumber)
    {
        $this->boxNumber = $boxNumber;
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
     * Returns the boxWeight
     * 
     * @return float $boxWeight
     */
    public function getBoxWeight()
    {
        return $this->boxWeight;
    }

    /**
     * Sets the boxWeight
     * 
     * @param float $boxWeight
     * @return void
     */
    public function setBoxWeight($boxWeight)
    {
        $this->boxWeight = $boxWeight;
    }

    /**
     * Returns the childDetails
     * 
     * @return string $childDetails
     */
    public function getChildDetails()
    {
        return $this->childDetails;
    }

    /**
     * Sets the childDetails
     * 
     * @param string $childDetails
     * @return void
     */
    public function setChildDetails($childDetails)
    {
        $this->childDetails = $childDetails;
    }
}
