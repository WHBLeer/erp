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
 * 营收
 */
class Revenue extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 订单金额
     * 
     * @var float
     */
    protected $orderAmount = 0.0;

    /**
     * 佣金
     * 
     * @var float
     */
    protected $commission = 0.0;

    /**
     * 到账
     * 
     * @var float 
     */
    protected $arrive = 0.0;

    /**
     * 成本
     * 
     * @var float
     */
    protected $costAmount = 0.0;

    /**
     * 实际金额
     * 
     * @var float
     */
    protected $actualAmount = 0.0;

    /**
     * 运费
     * 
     * @var float
     */
    protected $freight = 0.0;

    /**
     * 服务费
     * 
     * @var float
     */
    protected $serviceFee = 0.0;

    /**
     * 利润
     * 
     * @var float
     */
    protected $profit = 0.0;

    /**
     * 利润率
     * 
     * @var float
     */
    protected $profitMargin = 0.0;

    /**
     * 货币代码
     * 
     * @var string
     */
    protected $currencyCode = '';
    
    /**
     * Returns the orderAmount
     * 
     * @return float $orderAmount
     */
    public function getOrderAmount()
    {
        return $this->orderAmount;
    }

    /**
     * Sets the orderAmount
     * 
     * @param float $orderAmount
     * @return void
     */
    public function setOrderAmount($orderAmount)
    {
        $this->orderAmount = $orderAmount;
    }

    /**
     * Returns the commission
     * 
     * @return float $commission
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * Sets the commission
     * 
     * @param float $commission
     * @return void
     */
    public function setCommission($commission)
    {
        $this->commission = $commission;
    }

    /**
     * Returns the arrive
     * 
     * @return float $arrive
     */
    public function getArrive()
    {
        return $this->arrive;
    }

    /**
     * Sets the arrive
     * 
     * @param float $arrive
     * @return void
     */
    public function setArrive($arrive)
    {
        $this->arrive = $arrive;
    }

    /**
     * Returns the costAmount
     * 
     * @return float $costAmount
     */
    public function getCostAmount()
    {
        return $this->costAmount;
    }

    /**
     * Sets the costAmount
     * 
     * @param float $costAmount
     * @return void
     */
    public function setCostAmount($costAmount)
    {
        $this->costAmount = $costAmount;
    }

    /**
     * Returns the actualAmount
     * 
     * @return float $actualAmount
     */
    public function getActualAmount()
    {
        return $this->actualAmount;
    }

    /**
     * Sets the actualAmount
     * 
     * @param float $actualAmount
     * @return void
     */
    public function setActualAmount($actualAmount)
    {
        $this->actualAmount = $actualAmount;
    }
    
    /**
     * Returns the freight
     * 
     * @return float $freight
     */
    public function getFreight()
    {
        return $this->freight;
    }

    /**
     * Sets the freight
     * 
     * @param float $freight
     * @return void
     */
    public function setFreight($freight)
    {
        $this->freight = $freight;
    }

    /**
     * Returns the serviceFee
     * 
     * @return float $serviceFee
     */
    public function getServiceFee()
    {
        return $this->serviceFee;
    }

    /**
     * Sets the serviceFee
     * 
     * @param float $serviceFee
     * @return void
     */
    public function setServiceFee($serviceFee)
    {
        $this->serviceFee = $serviceFee;
    }

    /**
     * Returns the profit
     * 
     * @return float $profit
     */
    public function getProfit()
    {
        return $this->profit;
    }

    /**
     * Sets the profit
     * 
     * @param float $profit
     * @return void
     */
    public function setProfit($profit)
    {
        $this->profit = $profit;
    }

    /**
     * Returns the profitMargin
     * 
     * @return float $profitMargin
     */
    public function getProfitMargin()
    {
        return $this->profitMargin;
    }

    /**
     * Sets the profitMargin
     * 
     * @param float $profitMargin
     * @return void
     */
    public function setProfitMargin($profitMargin)
    {
        $this->profitMargin = $profitMargin;
    }

    /**
     * Returns the currencyCode
     * 
     * @return string $currencyCode
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * Sets the currencyCode
     * 
     * @param string $currencyCode
     * @return void
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
    }
    
}
