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
 * 用户授权
 */
class ErpUserAuth extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 开发者id
     * 
     * @var string
     */
    protected $developerId = '';

    /**
     * 店铺别名
     * 
     * @var string
     */
    protected $shopalias = '';

    /**
     * 亚马逊账号
     * 
     * @var string
     */
    protected $awsaccount = '';

    /**
     * 授权国家
     * 
     * @var string
     */
    protected $authcountry = '';

    /**
     * 授权时间
     * 
     * @var int
     */
    protected $authtime = 0;

    /**
     * 卖家编号
     * 
     * @var string
     */
    protected $amazonId = '';

    /**
     * 授权令牌
     * 
     * @var string
     */
    protected $amazonToken = '';

    /**
     * 授权平台 0亚马逊 1shopee
     * 
     * @var int
     */
    protected $authtype = 0;

    /**
     * 绑定市场
     * 
     * @var \ERP\ErpManagementDict\Domain\Model\Dictitem
     */
    protected $market = null;

    /**
     * Returns the developerId
     * 
     * @return string $developerId
     */
    public function getDeveloperId()
    {
        return $this->developerId;
    }

    /**
     * Sets the developerId
     * 
     * @param string $developerId
     * @return void
     */
    public function setDeveloperId($developerId)
    {
        $this->developerId = $developerId;
    }

    /**
     * Returns the shopalias
     * 
     * @return string $shopalias
     */
    public function getShopalias()
    {
        return $this->shopalias;
    }

    /**
     * Sets the shopalias
     * 
     * @param string $shopalias
     * @return void
     */
    public function setShopalias($shopalias)
    {
        $this->shopalias = $shopalias;
    }

    /**
     * Returns the awsaccount
     * 
     * @return string $awsaccount
     */
    public function getAwsaccount()
    {
        return $this->awsaccount;
    }

    /**
     * Sets the awsaccount
     * 
     * @param string $awsaccount
     * @return void
     */
    public function setAwsaccount($awsaccount)
    {
        $this->awsaccount = $awsaccount;
    }

    /**
     * Returns the authcountry
     * 
     * @return string $authcountry
     */
    public function getAuthcountry()
    {
        return $this->authcountry;
    }

    /**
     * Sets the authcountry
     * 
     * @param string $authcountry
     * @return void
     */
    public function setAuthcountry($authcountry)
    {
        $this->authcountry = $authcountry;
    }

    /**
     * Returns the authtime
     * 
     * @return int $authtime
     */
    public function getAuthtime()
    {
        return $this->authtime;
    }

    /**
     * Sets the authtime
     * 
     * @param int $authtime
     * @return void
     */
    public function setAuthtime($authtime)
    {
        $this->authtime = $authtime;
    }

    /**
     * Returns the amazonId
     * 
     * @return string $amazonId
     */
    public function getAmazonId()
    {
        return $this->amazonId;
    }

    /**
     * Sets the amazonId
     * 
     * @param string $amazonId
     * @return void
     */
    public function setAmazonId($amazonId)
    {
        $this->amazonId = $amazonId;
    }

    /**
     * Returns the amazonToken
     * 
     * @return string $amazonToken
     */
    public function getAmazonToken()
    {
        return $this->amazonToken;
    }

    /**
     * Sets the amazonToken
     * 
     * @param string $amazonToken
     * @return void
     */
    public function setAmazonToken($amazonToken)
    {
        $this->amazonToken = $amazonToken;
    }

    /**
     * Returns the authtype
     * 
     * @return int $authtype
     */
    public function getAuthtype()
    {
        return $this->authtype;
    }

    /**
     * Sets the authtype
     * 
     * @param int $authtype
     * @return void
     */
    public function setAuthtype($authtype)
    {
        $this->authtype = $authtype;
    }

    /**
     * Returns the market
     * 
     * @return \ERP\ErpManagementDict\Domain\Model\Dictitem $market
     */
    public function getMarket()
    {
        return $this->market;
    }

    /**
     * Sets the market
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Dictitem $market
     * @return void
     */
    public function setMarket(\ERP\ErpManagementDict\Domain\Model\Dictitem $market)
    {
        $this->market = $market;
    }
}
