<?php
namespace ERP\ErpManagementProduct\Domain\Model;


/***
 *
 * This file is part of the "产品管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * 成本运费
 */
class Cost extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 计算结果dom
     * 
     * @var string
     */
    protected $calculationdom = '';

    /**
     * 采购价
     * 
     * @var float
     */
    protected $cg = 0.0;

    /**
     * 重量
     * 
     * @var float
     */
    protected $zl = 0.0;

    /**
     * 尺寸
     * 
     * @var string
     */
    protected $cc = '';

    /**
     * 宽度
     * 
     * @var int
     */
    protected $kd = 0;

    /**
     * 高度
     * 
     * @var int
     */
    protected $gd = 0;

    /**
     * 国内运费
     * 
     * @var float
     */
    protected $yf = 0.0;

    /**
     * 折扣
     * 
     * @var float
     */
    protected $zk = 0.0;

    /**
     * 计算结果
     * 
     * @var string
     */
    protected $calculation = '';

    /**
     * 库存
     * 
     * @var int
     */
    protected $sy = 0;

    /**
     * 预处理时间
     * 
     * @var int
     */
    protected $sj = 0;

    /**
     * Returns the cg
     * 
     * @return float $cg
     */
    public function getCg()
    {
        return $this->cg;
    }

    /**
     * Sets the cg
     * 
     * @param float $cg
     * @return void
     */
    public function setCg($cg)
    {
        $this->cg = $cg;
    }

    /**
     * Returns the zl
     * 
     * @return float $zl
     */
    public function getZl()
    {
        return $this->zl;
    }

    /**
     * Sets the zl
     * 
     * @param float $zl
     * @return void
     */
    public function setZl($zl)
    {
        $this->zl = $zl;
    }

    /**
     * Returns the cc
     * 
     * @return string $cc
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Sets the cc
     * 
     * @param string $cc
     * @return void
     */
    public function setCc($cc)
    {
        $this->cc = $cc;
    }

    /**
     * Returns the kd
     * 
     * @return int $kd
     */
    public function getKd()
    {
        return $this->kd;
    }

    /**
     * Sets the kd
     * 
     * @param int $kd
     * @return void
     */
    public function setKd($kd)
    {
        $this->kd = $kd;
    }

    /**
     * Returns the gd
     * 
     * @return int $gd
     */
    public function getGd()
    {
        return $this->gd;
    }

    /**
     * Sets the gd
     * 
     * @param int $gd
     * @return void
     */
    public function setGd($gd)
    {
        $this->gd = $gd;
    }

    /**
     * Returns the yf
     * 
     * @return float $yf
     */
    public function getYf()
    {
        return $this->yf;
    }

    /**
     * Sets the yf
     * 
     * @param float $yf
     * @return void
     */
    public function setYf($yf)
    {
        $this->yf = $yf;
    }

    /**
     * Returns the zk
     * 
     * @return float $zk
     */
    public function getZk()
    {
        return $this->zk;
    }

    /**
     * Sets the zk
     * 
     * @param float $zk
     * @return void
     */
    public function setZk($zk)
    {
        $this->zk = $zk;
    }

    /**
     * Returns the calculation
     * 
     * @return string $calculation
     */
    public function getCalculation()
    {
        return $this->calculation;
    }

    /**
     * Sets the calculation
     * 
     * @param string $calculation
     * @return void
     */
    public function setCalculation($calculation)
    {
        $this->calculation = $calculation;
    }

    /**
     * Returns the calculationdom
     * 
     * @return string $calculationdom
     */
    public function getCalculationdom()
    {
        return $this->calculationdom;
    }

    /**
     * Sets the calculationdom
     * 
     * @param string $calculationdom
     * @return void
     */
    public function setCalculationdom($calculationdom)
    {
        $this->calculationdom = $calculationdom;
    }

    /**
     * Returns the sy
     * 
     * @return int $sy
     */
    public function getSy()
    {
        return $this->sy;
    }

    /**
     * Sets the sy
     * 
     * @param int $sy
     * @return void
     */
    public function setSy($sy)
    {
        $this->sy = $sy;
    }

    /**
     * Returns the sj
     * 
     * @return int $sj
     */
    public function getSj()
    {
        return $this->sj;
    }

    /**
     * Sets the sj
     * 
     * @param int $sj
     * @return void
     */
    public function setSj($sj)
    {
        $this->sj = $sj;
    }
}
