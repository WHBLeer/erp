<?php
namespace ERP\ErpManagementUser\Domain\Model;


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
 * 用户位置信息
 */
class Position extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * ip
     * 
     * @var string
     */
    protected $ip = '';

    /**
     * locatlat
     * 
     * @var string
     */
    protected $locatlat = '';

    /**
     * locatLng
     * 
     * @var string
     */
    protected $locatLng = '';

    /**
     * nation
     * 
     * @var string
     */
    protected $nation = '';

    /**
     * province
     * 
     * @var string
     */
    protected $province = '';

    /**
     * city
     * 
     * @var string
     */
    protected $city = '';

    /**
     * district
     * 
     * @var string
     */
    protected $district = '';

    /**
     * adcode
     * 
     * @var int
     */
    protected $adcode = 0;

    /**
     * Returns the ip
     * 
     * @return string $ip
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Sets the ip
     * 
     * @param string $ip
     * @return void
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * Returns the locatlat
     * 
     * @return string $locatlat
     */
    public function getLocatlat()
    {
        return $this->locatlat;
    }

    /**
     * Sets the locatlat
     * 
     * @param string $locatlat
     * @return void
     */
    public function setLocatlat($locatlat)
    {
        $this->locatlat = $locatlat;
    }

    /**
     * Returns the locatLng
     * 
     * @return string $locatLng
     */
    public function getLocatLng()
    {
        return $this->locatLng;
    }

    /**
     * Sets the locatLng
     * 
     * @param string $locatLng
     * @return void
     */
    public function setLocatLng($locatLng)
    {
        $this->locatLng = $locatLng;
    }

    /**
     * Returns the nation
     * 
     * @return string $nation
     */
    public function getNation()
    {
        return $this->nation;
    }

    /**
     * Sets the nation
     * 
     * @param string $nation
     * @return void
     */
    public function setNation($nation)
    {
        $this->nation = $nation;
    }

    /**
     * Returns the province
     * 
     * @return string $province
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Sets the province
     * 
     * @param string $province
     * @return void
     */
    public function setProvince($province)
    {
        $this->province = $province;
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
     * Returns the district
     * 
     * @return string $district
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Sets the district
     * 
     * @param string $district
     * @return void
     */
    public function setDistrict($district)
    {
        $this->district = $district;
    }

    /**
     * Returns the adcode
     * 
     * @return int $adcode
     */
    public function getAdcode()
    {
        return $this->adcode;
    }

    /**
     * Sets the adcode
     * 
     * @param int $adcode
     * @return void
     */
    public function setAdcode($adcode)
    {
        $this->adcode = $adcode;
    }
}
