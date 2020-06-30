<?php
namespace ERP\ErpManagementWallet\Domain\Model;


/***
 *
 * This file is part of the "钱包模块管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>, 三里林
 *
 ***/
/**
 * 用户钱包
 */
class Wallet extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 钱包识别码，32位随机字符串
     * 
     * @var string
     */
    protected $walletNumber = '';

    /**
     * 余额
     * 
     * @var float
     */
    protected $balance = 0.0;

    /**
     * 支付密码
     * 
     * @var string
     */
    protected $password = '';

    /**
     * 提现名称
     * 
     * @var string
     */
    protected $name = '';

    /**
     * 提现支付宝账户
     * 
     * @var string
     */
    protected $alipay = '';

    /**
     * 提现微信账户
     * 
     * @var string
     */
    protected $wxpay = '';

    /**
     * 操作人
     * 
     * @var \ERP\ErpManagementUser\Domain\Model\ErpUser
     */
    protected $erpuser = null;

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
    }

    /**
     * Returns the walletNumber
     * 
     * @return string $walletNumber
     */
    public function getWalletNumber()
    {
        return $this->walletNumber;
    }

    /**
     * Sets the walletNumber
     * 
     * @param string $walletNumber
     * @return void
     */
    public function setWalletNumber($walletNumber)
    {
        $this->walletNumber = $walletNumber;
    }

    /**
     * Returns the balance
     * 
     * @return float $balance
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Sets the balance
     * 
     * @param float $balance
     * @return void
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * Returns the password
     * 
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the password
     * 
     * @param string $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

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
     * Returns the alipay
     * 
     * @return string $alipay
     */
    public function getAlipay()
    {
        return $this->alipay;
    }

    /**
     * Sets the alipay
     * 
     * @param string $alipay
     * @return void
     */
    public function setAlipay($alipay)
    {
        $this->alipay = $alipay;
    }

    /**
     * Returns the wxpay
     * 
     * @return string $wxpay
     */
    public function getWxpay()
    {
        return $this->wxpay;
    }

    /**
     * Sets the wxpay
     * 
     * @param string $wxpay
     * @return void
     */
    public function setWxpay($wxpay)
    {
        $this->wxpay = $wxpay;
    }

    /**
     * Returns the erpuser
     * 
     * @return \ERP\ErpManagementUser\Domain\Model\ErpUser $erpuser
     */
    public function getErpuser()
    {
        return $this->erpuser;
    }

    /**
     * Sets the erpuser
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUser $erpuser
     * @return void
     */
    public function setErpuser(\ERP\ErpManagementUser\Domain\Model\ErpUser $erpuser)
    {
        $this->erpuser = $erpuser;
    }
}
