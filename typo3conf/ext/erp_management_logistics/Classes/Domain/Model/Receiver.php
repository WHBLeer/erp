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
 * 收件人信息
 */
class Receiver extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 收件人所在国家，填写国际通用标准 2
     * 位简码，可通过国家查询服务查询
     * 
     * @var string
     */
    protected $countryCode = '';

    /**
     * 姓
     * 
     * @var string
     */
    protected $firstName = '';

    /**
     * 名
     * 
     * @var string
     */
    protected $lastName = '';

    /**
     * 公司
     * 
     * @var string
     */
    protected $company = '';

    /**
     * 详细地址
     * 
     * @var string
     */
    protected $street = '';

    /**
     * 详细地址1
     * 
     * @var string
     */
    protected $streetAddress1 = '';

    /**
     * 详细地址2
     * 
     * @var string
     */
    protected $streetAddress2 = '';

    /**
     * 所在城市
     * 
     * @var string
     */
    protected $city = '';

    /**
     * 州/省
     * 
     * @var string
     */
    protected $state = '';

    /**
     * 邮编
     * 
     * @var string
     */
    protected $zip = '';

    /**
     * 收件人电话
     * 
     * @var string
     */
    protected $phone = '';

    /**
     * 街道门牌号
     * 
     * @var string
     */
    protected $houseNumber = '';

    /**
     * 邮箱
     * 
     * @var string
     */
    protected $email = '';

    /**
     * Returns the countryCode
     * 
     * @return string $countryCode
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Sets the countryCode
     * 
     * @param string $countryCode
     * @return void
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * Returns the firstName
     * 
     * @return string $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Sets the firstName
     * 
     * @param string $firstName
     * @return void
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Returns the lastName
     * 
     * @return string $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Sets the lastName
     * 
     * @param string $lastName
     * @return void
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Returns the company
     * 
     * @return string $company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Sets the company
     * 
     * @param string $company
     * @return void
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * Returns the street
     * 
     * @return string $street
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Sets the street
     * 
     * @param string $street
     * @return void
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * Returns the streetAddress1
     * 
     * @return string $streetAddress1
     */
    public function getStreetAddress1()
    {
        return $this->streetAddress1;
    }

    /**
     * Sets the streetAddress1
     * 
     * @param string $streetAddress1
     * @return void
     */
    public function setStreetAddress1($streetAddress1)
    {
        $this->streetAddress1 = $streetAddress1;
    }

    /**
     * Returns the streetAddress2
     * 
     * @return string $streetAddress2
     */
    public function getStreetAddress2()
    {
        return $this->streetAddress2;
    }

    /**
     * Sets the streetAddress2
     * 
     * @param string $streetAddress2
     * @return void
     */
    public function setStreetAddress2($streetAddress2)
    {
        $this->streetAddress2 = $streetAddress2;
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
     * Returns the zip
     * 
     * @return string $zip
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Sets the zip
     * 
     * @param string $zip
     * @return void
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * Returns the phone
     * 
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Sets the phone
     * 
     * @param string $phone
     * @return void
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Returns the houseNumber
     * 
     * @return string $houseNumber
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * Sets the houseNumber
     * 
     * @param string $houseNumber
     * @return void
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;
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
}
