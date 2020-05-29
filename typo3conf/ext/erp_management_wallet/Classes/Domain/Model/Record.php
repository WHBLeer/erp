<?php
namespace ERP\ErpManagementWallet\Domain\Model;


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
class Record extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 金额（充值10的整数倍）
     * 
     * @var float
     */
    protected $amount = '';

    /**
     * 交易完成时间
     * 
     * @var int
     */
    protected $successTime = '';

    /**
     * 交易方式：0其他 1支付宝 2微信 3银行卡
     * 
     * @var int
     */
    protected $payment = 0.0;

    /**
     * 支付状态：0进行中 -1失败 1成功
     * 
     * @var int
     */
    protected $status = 0.0;

    /**
     * 交易流水号
     * 
     * @var string
     */
    protected $serialNumber = 0;

    /**
     * 交易订单号
     * 
     * @var string
     */
    protected $orderNumber = 0.0;

    /**
     * 类型：0其他、1充值、2提现、3交易
     * 
     * @var int
     */
    protected $billtype = 0;

    /**
     * 目的地国家
     * 
     * @var \ERP\ErpManagementDict\Domain\Model\Region
     */
    protected $country = null;

    /**
     * 目的地国家
     * 
     * @var \ERP\ErpManagementUser\Domain\Model\ErpUser
     */
    protected $erpuser = null;

    /**
     * 备注
     * 
     * @var string
     */
    protected $remark = '';

    /**
     * Returns the amount
     * 
     * @return float amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Sets the amount
     * 
     * @param string $amount
     * @return void
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Returns the successTime
     * 
     * @return int successTime
     */
    public function getSuccessTime()
    {
        return $this->successTime;
    }

    /**
     * Sets the successTime
     * 
     * @param string $successTime
     * @return void
     */
    public function setSuccessTime($successTime)
    {
        $this->successTime = $successTime;
    }

    /**
     * Returns the payment
     * 
     * @return int payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Sets the payment
     * 
     * @param float $payment
     * @return void
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }

    /**
     * Returns the status
     * 
     * @return int status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the status
     * 
     * @param float $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Returns the serialNumber
     * 
     * @return string serialNumber
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * Sets the serialNumber
     * 
     * @param int $serialNumber
     * @return void
     */
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;
    }

    /**
     * Returns the orderNumber
     * 
     * @return string orderNumber
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Sets the orderNumber
     * 
     * @param float $orderNumber
     * @return void
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * Returns the billtype
     * 
     * @return int billtype
     */
    public function getBilltype()
    {
        return $this->billtype;
    }

    /**
     * Sets the billtype
     * 
     * @param int $billtype
     * @return void
     */
    public function setBilltype($billtype)
    {
        $this->billtype = $billtype;
    }

    /**
     * Returns the country
     * 
     * @return \ERP\ErpManagementDict\Domain\Model\Region country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Sets the country
     * 
     * @param string $country
     * @return void
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * Returns the erpuser
     * 
     * @return \ERP\ErpManagementUser\Domain\Model\ErpUser erpuser
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
