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
 * 用户管理
 */
class UserManagement extends \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
{

    /**
     * 授权码
     * 
     * @var string
     */
    protected $authcode = '';

    /**
     * 微信openid
     * 
     * @var string
     */
    protected $wxopenid = '';

    /**
     * 绑定IP
     * 
     * @var string
     */
    protected $bindip = '';

    /**
     * nickname
     * 
     * @var string
     */
    protected $nickname = '';

    /**
     * 所在市
     * 
     * @var \ERP\ErpManagementDict\Domain\Model\Region
     */
    protected $city = null;

    /**
     * 所在省份
     * 
     * @var \ERP\ErpManagementDict\Domain\Model\Region
     */
    protected $province = null;

    /**
     * Returns the authcode
     * 
     * @return string authcode
     */
    public function getAuthcode()
    {
        return $this->authcode;
    }

    /**
     * Sets the authcode
     * 
     * @param string $authcode
     * @return void
     */
    public function setAuthcode($authcode)
    {
        $this->authcode = $authcode;
    }

    /**
     * Returns the wxopenid
     * 
     * @return string wxopenid
     */
    public function getWxopenid()
    {
        return $this->wxopenid;
    }

    /**
     * Sets the wxopenid
     * 
     * @param string $wxopenid
     * @return void
     */
    public function setWxopenid($wxopenid)
    {
        $this->wxopenid = $wxopenid;
    }

    /**
     * Returns the bindip
     * 
     * @return string bindip
     */
    public function getBindip()
    {
        return $this->bindip;
    }

    /**
     * Sets the bindip
     * 
     * @param string $bindip
     * @return void
     */
    public function setBindip($bindip)
    {
        $this->bindip = $bindip;
    }

    /**
     * Returns the nickname
     * 
     * @return string $nickname
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Sets the nickname
     * 
     * @param string $nickname
     * @return void
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * Returns the city
     * 
     * @return \ERP\ErpManagementDict\Domain\Model\Region $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Sets the city
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Region $city
     * @return void
     */
    public function setCity(\ERP\ErpManagementDict\Domain\Model\Region $city)
    {
        $this->city = $city;
    }

    /**
     * Returns the province
     * 
     * @return \ERP\ErpManagementDict\Domain\Model\Region $province
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Sets the province
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Region $province
     * @return void
     */
    public function setProvince(\ERP\ErpManagementDict\Domain\Model\Region $province)
    {
        $this->province = $province;
    }
}
