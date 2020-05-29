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
 * 钱包变动日志
 */
class Log extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 动账后余额
     * 
     * @var float
     */
    protected $balance = 0.0;

    /**
     * 变动金额 增+ 减-
     * 
     * @var float
     */
    protected $chmoney = 0.0;

    /**
     * 备注
     * 
     * @var string
     */
    protected $remark = '';

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
     * Returns the chmoney
     * 
     * @return float $chmoney
     */
    public function getChmoney()
    {
        return $this->chmoney;
    }

    /**
     * Sets the chmoney
     * 
     * @param float $chmoney
     * @return void
     */
    public function setChmoney($chmoney)
    {
        $this->chmoney = $chmoney;
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
