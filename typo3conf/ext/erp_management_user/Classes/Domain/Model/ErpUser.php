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
class ErpUser extends \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
{

    /**
     * 用户唯一编码
     * 
     * @var string
     */
    protected $accountId = '';

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
     * 订单最后更新时间
     * 
     * @var int
     */
    protected $orderLasttime=0;

    /**
     * 所在市
     * 
     * @var \ERP\ErpManagementDict\Domain\Model\Region
     */
    protected $citys = null;

    /**
     * 所在省份
     * 
     * @var \ERP\ErpManagementDict\Domain\Model\Region
     */
    protected $province = null;

    /**
     * 授权
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementUser\Domain\Model\ErpUserAuth>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $auth = null;

    /**
     * 位置信息
     * 
     * @var \ERP\ErpManagementUser\Domain\Model\Position
     */
    protected $position = null;

    /**
     * __construct
     */
    public function __construct()
    {

        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     * 
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->auth = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the accountId
     * 
     * @return string $accountId
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Sets the accountId
     * 
     * @param string $accountId
     * @return void
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * Returns the wxopenid
     * 
     * @return string $wxopenid
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
     * @return string $bindip
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
     * Returns the orderLasttime
     * 
     * @return int $orderLasttime
     */
    public function getOrderLasttime()
    {
        return $this->orderLasttime;
    }

    /**
     * Sets the orderLasttime
     * 
     * @param int $orderLasttime
     * @return void
     */
    public function setOrderLasttime($orderLasttime)
    {
        $this->orderLasttime = $orderLasttime;
    }

    /**
     * Returns the citys
     * 
     * @return \ERP\ErpManagementDict\Domain\Model\Region $citys
     */
    public function getCitys()
    {
        return $this->citys;
    }

    /**
     * Sets the citys
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Region $citys
     * @return void
     */
    public function setCitys(\ERP\ErpManagementDict\Domain\Model\Region $citys)
    {
        $this->citys = $citys;
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

    /**
     * Adds a ErpUserAuth
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUserAuth $auth
     * @return void
     */
    public function addAuth(\ERP\ErpManagementUser\Domain\Model\ErpUserAuth $auth)
    {
        $this->auth->attach($auth);
    }

    /**
     * Removes a ErpUserAuth
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUserAuth $authToRemove The ErpUserAuth to be removed
     * @return void
     */
    public function removeAuth(\ERP\ErpManagementUser\Domain\Model\ErpUserAuth $authToRemove)
    {
        $this->auth->detach($authToRemove);
    }

    /**
     * Returns the auth
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementUser\Domain\Model\ErpUserAuth> $auth
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * Sets the auth
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementUser\Domain\Model\ErpUserAuth> $auth
     * @return void
     */
    public function setAuth(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Returns the position
     * 
     * @return \ERP\ErpManagementUser\Domain\Model\Position $position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Sets the position
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\Position $position
     * @return void
     */
    public function setPosition(\ERP\ErpManagementUser\Domain\Model\Position $position)
    {
        $this->position = $position;
    }
}
