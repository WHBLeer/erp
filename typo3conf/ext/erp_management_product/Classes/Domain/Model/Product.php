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
 * 图片
 */
class Product extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 图片id
     * 
     * @var string
     */
    protected $imageuids = '';

    /**
     * 原图
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementImages\Domain\Model\Images>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $images = null;

    /**
     * 缩略图
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementImages\Domain\Model\Images>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $thumbnail = null;

    /**
     * 原图1
     * 
     * @var string
     */
    protected $firstimage = '';

    /**
     * 缩略图1
     * 
     * @var string
     */
    protected $firstthumb = '';

    /**
     * 编号
     * 
     * @var string
     */
    protected $numbering = '';

    /**
     * 名称
     * 
     * @var string
     */
    protected $name = '';

    /**
     * 商品主页
     * 
     * @var string
     */
    protected $business = '';

    /**
     * 原始规格
     * 
     * @var string
     */
    protected $original = '';

    /**
     * 产品分类
     * 
     * @var \ERP\ErpManagementDict\Domain\Model\Category
     */
    protected $category = null;

    /**
     * 审核状态
     * 
     * @var \ERP\ErpManagementDict\Domain\Model\Dictitem
     */
    protected $approval = null;

    /**
     * 上架状态
     * 
     * @var \ERP\ErpManagementDict\Domain\Model\Dictitem
     */
    protected $shelves = null;

    /**
     * 商品获取类型
     * 
     * @var \ERP\ErpManagementDict\Domain\Model\Dictitem
     */
    protected $gtypes = null;

    /**
     * 产品信息
     * 
     * @var \ERP\ErpManagementProduct\Domain\Model\Info
     */
    protected $info = null;

    /**
     * 成本运费
     * 
     * @var \ERP\ErpManagementProduct\Domain\Model\Cost
     */
    protected $cost = null;

    /**
     * 产品介绍
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementProduct\Domain\Model\Desc>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $descr = null;

    /**
     * 规格变体
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementProduct\Domain\Model\Variants>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $variants = null;

    /**
     * 添加用户
     * 
     * @var \ERP\ErpManagementUser\Domain\Model\ErpUser
     */
    protected $adduser = null;

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
        $this->descr = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->variants = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->images = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the firstimage
     * 
     * @return string $firstimage
     */
    public function getFirstimage()
    {
        
        foreach ($this->images as $key => $img) {
            $this->firstimage = $GLOBALS['TYPO3_CONF_VARS']['FTP']['sever'].$img->getOriginal();
            break;
        }
        return $this->firstimage;
    }

    /**
     * Returns the firstthumb
     * 
     * @return string $firstthumb
     */
    public function getFirstthumb()
    {
        return $this->firstthumb;
    }

    /**
     * Returns the numbering
     * 
     * @return string $numbering
     */
    public function getNumbering()
    {
        return $this->numbering;
    }

    /**
     * Sets the numbering
     * 
     * @param string $numbering
     * @return void
     */
    public function setNumbering($numbering)
    {
        $this->numbering = $numbering;
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
     * Returns the business
     * 
     * @return string $business
     */
    public function getBusiness()
    {
        return $this->business;
    }

    /**
     * Sets the business
     * 
     * @param string $business
     * @return void
     */
    public function setBusiness($business)
    {
        $this->business = $business;
    }

    /**
     * Returns the original
     * 
     * @return string $original
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /**
     * Sets the original
     * 
     * @param string $original
     * @return void
     */
    public function setOriginal($original)
    {
        $this->original = $original;
    }

    /**
     * Returns the imageuids
     * 
     * @return string $imageuids
     */
    public function getImageuids()
    {
        return $this->imageuids;
    }

    /**
     * Sets the imageuids
     * 
     * @param string $imageuids
     * @return void
     */
    public function setImageuids($imageuids)
    {
        $this->imageuids = $imageuids;
    }

    /**
     * Returns the category
     * 
     * @return \ERP\ErpManagementDict\Domain\Model\Category $category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Sets the category
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Category $category
     * @return void
     */
    public function setCategory(\ERP\ErpManagementDict\Domain\Model\Category $category)
    {
        $this->category = $category;
    }

    /**
     * Returns the gtypes
     * 
     * @return \ERP\ErpManagementDict\Domain\Model\Dictitem $gtypes
     */
    public function getGtypes()
    {
        // dump($this->gtypes);
        return $this->gtypes;
    }

    /**
     * Sets the gtypes
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Dictitem $gtypes
     * @return void
     */
    public function setGtypes(\ERP\ErpManagementDict\Domain\Model\Dictitem $gtypes)
    {
        $this->gtypes = $gtypes;
    }

    /**
     * Adds a Image
     * 
     * @param \ERP\ErpManagementImages\Domain\Model\Images $image
     * @return void
     */
    public function addImage(\ERP\ErpManagementImages\Domain\Model\Images $image)
    {
        $this->images->attach($image);
    }

    /**
     * Removes a Image
     * 
     * @param \ERP\ErpManagementImages\Domain\Model\Images $imageToRemove The Image to be removed
     * @return void
     */
    public function removeImage(\ERP\ErpManagementImages\Domain\Model\Images $imageToRemove)
    {
        $this->images->detach($imageToRemove);
    }

    /**
     * Returns the images
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementImages\Domain\Model\Images> $images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Sets the images
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementImages\Domain\Model\Images> $images
     * @return void
     */
    public function setImages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $images)
    {
        $this->images = $images;
    }

    /**
     * Adds a Image
     * 
     * @param \ERP\ErpManagementImages\Domain\Model\Images $thumbnail
     * @return void
     */
    public function addThumbnail(\ERP\ErpManagementImages\Domain\Model\Images $thumbnail)
    {
        $this->thumbnail->attach($thumbnail);
    }

    /**
     * Removes a Image
     * 
     * @param \ERP\ErpManagementImages\Domain\Model\Images $thumbnailToRemove The Image to be removed
     * @return void
     */
    public function removeThumbnail(\ERP\ErpManagementImages\Domain\Model\Images $thumbnailToRemove)
    {
        $this->thumbnail->detach($thumbnailToRemove);
    }

    /**
     * Returns the thumbnail
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementImages\Domain\Model\Images> $thumbnail
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Sets the thumbnail
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementImages\Domain\Model\Images> $thumbnail
     * @return void
     */
    public function setThumbnail(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * Returns the info
     * 
     * @return \ERP\ErpManagementProduct\Domain\Model\Info $info
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Sets the info
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Info $info
     * @return void
     */
    public function setInfo(\ERP\ErpManagementProduct\Domain\Model\Info $info)
    {
        $this->info = $info;
    }

    /**
     * Returns the cost
     * 
     * @return \ERP\ErpManagementProduct\Domain\Model\Cost $cost
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Sets the cost
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Cost $cost
     * @return void
     */
    public function setCost(\ERP\ErpManagementProduct\Domain\Model\Cost $cost)
    {
        $this->cost = $cost;
    }

    /**
     * Adds a Desc
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Desc $descr
     * @return void
     */
    public function addDescr(\ERP\ErpManagementProduct\Domain\Model\Desc $descr)
    {
        $this->descr->attach($descr);
    }

    /**
     * Removes a Desc
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Desc $descrToRemove The Desc to be removed
     * @return void
     */
    public function removeDescr(\ERP\ErpManagementProduct\Domain\Model\Desc $descrToRemove)
    {
        $this->descr->detach($descrToRemove);
    }

    /**
     * Returns the descr
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementProduct\Domain\Model\Desc> $descr
     */
    public function getDescr()
    {
        return $this->descr;
    }

    /**
     * Sets the descr
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementProduct\Domain\Model\Desc> $descr
     * @return void
     */
    public function setDescr(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $descr)
    {
        $this->descr = $descr;
    }

    /**
     * Adds a Variants
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Variants $variant
     * @return void
     */
    public function addVariant(\ERP\ErpManagementProduct\Domain\Model\Variants $variant)
    {
        $this->variants->attach($variant);
    }

    /**
     * Removes a Variants
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Variants $variantToRemove The Variants to be removed
     * @return void
     */
    public function removeVariant(\ERP\ErpManagementProduct\Domain\Model\Variants $variantToRemove)
    {
        $this->variants->detach($variantToRemove);
    }

    /**
     * Returns the variants
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementProduct\Domain\Model\Variants> $variants
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * Sets the variants
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ERP\ErpManagementProduct\Domain\Model\Variants> $variants
     * @return void
     */
    public function setVariants(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $variants)
    {
        $this->variants = $variants;
    }

    /**
     * Returns the approval
     * 
     * @return \ERP\ErpManagementDict\Domain\Model\Dictitem approval
     */
    public function getApproval()
    {
        return $this->approval;
    }

    /**
     * Sets the approval
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Dictitem $approval
     * @return void
     */
    public function setApproval(\ERP\ErpManagementDict\Domain\Model\Dictitem $approval)
    {
        $this->approval = $approval;
    }

    /**
     * Returns the shelves
     * 
     * @return \ERP\ErpManagementDict\Domain\Model\Dictitem shelves
     */
    public function getShelves()
    {
        return $this->shelves;
    }

    /**
     * Sets the shelves
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Dictitem $shelves
     * @return void
     */
    public function setShelves(\ERP\ErpManagementDict\Domain\Model\Dictitem $shelves)
    {
        $this->shelves = $shelves;
    }

    /**
     * Returns the adduser
     * 
     * @return \ERP\ErpManagementUser\Domain\Model\ErpUser $adduser
     */
    public function getAdduser()
    {
        return $this->adduser;
    }

    /**
     * Sets the adduser
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUser $adduser
     * @return void
     */
    public function setAdduser(\ERP\ErpManagementUser\Domain\Model\ErpUser $adduser)
    {
        $this->adduser = $adduser;
    }
}
