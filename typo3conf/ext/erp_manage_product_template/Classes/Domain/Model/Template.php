<?php
namespace ERP\ErpManageProductTemplate\Domain\Model;


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
 * 图片
 */
class Template extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * crdate
     * 操作时间
     * @var \DateTime
     */
    protected $crdate = null;

    /**
     * 最后修改时间
     *  
     * @var \DateTime
     */
    protected $tstamp = null;

    /**
     * 名称
     * 
     * @var string
     */
    protected $name = '';

    /**
     * 名称
     * 
     * @var string
     */
    protected $nameEn = '';
    
    /**
     * 名称
     * 
     * @var string
     */
    protected $title = '';

    /**
     * 代码
     * 
     * @var string
     */
    protected $code = '';

    /**
     * 状态 默认启用
     * 
     * 
     * @var int
     */
    protected $close = 0;

    /**
     * parent
     * 
     * @var int
     */
    protected $parentId = 0;

    /**
     * 内容
     * 
     * @var string
     */
    protected $bodytext = '';

    /**
     * 父级
     * 
     * @var \ERP\ErpManageProductTemplate\Domain\Model\Template
     */
    protected $parent = null;

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
     * Returns the code
     * 
     * @return string code
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
     * Returns the close
     * 
     * @return int $close
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
     * Returns the parentId
     * 
     * @return int $parentId
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

    /**
     * Returns the bodytext
     * 
     * @return string $bodytext
     */
    public function getBodytext()
    {
        return $this->bodytext;
    }

    /**
     * Sets the bodytext
     * 
     * @param string $bodytext
     * @return void
     */
    public function setBodytext($bodytext)
    {
        $this->bodytext = $bodytext;
    }

    /**
     * Returns the parent
     * 
     * @return \ERP\ErpManageProductTemplate\Domain\Model\Template $parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Sets the parent
     * 
     * @param \ERP\ErpManageProductTemplate\Domain\Model\Template $parent
     * @return void
     */
    public function setParent(\ERP\ErpManageProductTemplate\Domain\Model\Template $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Returns the crdate
     *
     * @return \DateTime $crdate
     */
    public function getCrdate()
    {
        return $this->crdate;
    }
    
    
    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTstamp()
    {
        return $this->tstamp;
    }

    /**
     * Returns the title
     * 
     * @return string $title
     */
    public function getTitle()
    {
        $this->title = $this->getName().'('.$this->getNameEn().')';
        return $this->title;
    }
}
