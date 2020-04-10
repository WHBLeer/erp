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
 * 产品类型
 */
class Category extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 名称
     * 
     * @var string
     */
    protected $name = '';

    /**
     * nameEn
     * 
     * @var string
     */
    protected $nameEn = '';

    /**
     * 代码
     * 
     * @var string
     */
    protected $code = '';

    /**
     * 状态 默认启用
     * 
     * @var int
     */
    protected $close = 0;

    /**
     * parentId
     * 
     * @var string
     */
    protected $parentId = 0;

    /**
     * 父类
     * 
     * @var \ERP\ErpManagementDict\Domain\Model\Category
     */
    protected $parent = null;

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
     * Returns the close
     * 
     * @return int close
     */
    public function getClose()
    {
        return $this->close;
    }

    /**
     * Sets the close
     * 
     * @param int $close
     * @return void
     */
    public function setClose($close)
    {
        $this->close = $close;
    }

    /**
     * Returns the parent
     * 
     * @return \ERP\ErpManagementDict\Domain\Model\Category $parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Sets the parent
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Category $parent
     * @return void
     */
    public function setParent(\ERP\ErpManagementDict\Domain\Model\Category $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Returns the nameEn
     * 
     * @return string nameEn
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * Sets the nameEn
     * 
     * @param string $nameEn
     * @return void
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;
    }

    /**
     * Returns the parentId
     * 
     * @return string parentId
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Sets the parentId
     * 
     * @param int $parentId
     * @return void
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }
}
