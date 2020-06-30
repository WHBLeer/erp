<?php
namespace ERP\ErpManagementDict\Domain\Model;


/***
 *
 * This file is part of the "数据字典" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * 区域管理
 */
class Region extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 名称
     * 
     * @var string
     */
    protected $name = '';

    /**
     * 简称
     * 
     * @var string
     */
    protected $short = '';

    /**
     * 代码
     * 
     * @var string
     */
    protected $code = '';

    /**
     * 分级
     * 
     * @var int
     */
    protected $level = 0;

    /**
     * 上级区域
     * 
     * @var int
     */
    protected $parent = 0;

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
     * Returns the short
     * 
     * @return string $short
     */
    public function getShort()
    {
        return $this->short;
    }

    /**
     * Sets the short
     * 
     * @param string $short
     * @return void
     */
    public function setShort($short)
    {
        $this->short = $short;
    }

    /**
     * Returns the code
     * 
     * @return string $code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Sets the code
     * 
     * @param string $code
     * @return void
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Returns the level
     * 
     * @return int $level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Sets the level
     * 
     * @param int $level
     * @return void
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * Returns the parent
     * 
     * @return int $parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Sets the parent
     * 
     * @param int $parent
     * @return void
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }
}
