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
 * 发货地址
 */
class Address extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 联系人
     * 
     * @var string
     */
    protected $name = '';

    /**
     * 电话
     * 
     * @var string
     */
    protected $telephone = '';

    /**
     * 邮编
     * 
     * @var string
     */
    protected $postcode = '';

    /**
     * 州
     * 
     * @var string
     */
    protected $state = '';

    /**
     * 市
     * 
     * @var string
     */
    protected $city = '';

    /**
     * 街道门牌
     * 
     * @var string
     */
    protected $streetNumber = '';

    /**
     * 地址
     * 
     * @var string
     */
    protected $address = '';

    /**
     * Returns the name
     * 
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     * 
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the telephone
     * 
     * @return string $telephone
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Sets the telephone
     * 
     * @param string $telephone
     * @return void
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * Returns the postcode
     * 
     * @return string $postcode
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Sets the postcode
     * 
     * @param string $postcode
     * @return void
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * Returns the state
     * 
     * @return string $state
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Sets the state
     * 
     * @param string $state
     * @return void
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Returns the city
     * 
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Sets the city
     * 
     * @param string $city
     * @return void
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Returns the streetNumber
     * 
     * @return string $streetNumber
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * Sets the streetNumber
     * 
     * @param string $streetNumber
     * @return void
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;
    }

    /**
     * Returns the address
     * 
     * @return string $address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets the address
     * 
     * @param string $address
     * @return void
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }
}
