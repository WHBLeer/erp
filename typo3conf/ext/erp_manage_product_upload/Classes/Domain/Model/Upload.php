<?php
namespace ERP\ErpManageProductUpload\Domain\Model;


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
class Upload extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

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
     * 商品获取类型
     * 
     * @var \ERP\ErpManagementDict\Domain\Model\Dictitem
     */
    protected $gtypes = null;

    /**
     * 上传时间
     * 
     * @var int
     */
    protected $subdate = '';

    /**
     * 语言
     * 
     * @var string
     */
    protected $lang = '';

    /**
     * 定时上传时间
     * 
     * @var int
     */
    protected $timing = 0;

    /**
     * 产品状态
     * 
     * @var int
     */
    protected $st1 = '';

    /**
     * 关系状态
     * 
     * @var int
     */
    protected $st2 = '';

    /**
     * 图片状态
     * 
     * 
     * @var int
     */
    protected $st3 = 0;

    /**
     * 库存状态
     * 
     * @var int
     */
    protected $st4 = 0;

    /**
     * 价格状态
     * 
     * @var int
     */
    protected $st5 = 0;

    /**
     * 上传用户
     * 
     * @var \ERP\ErpManagementUser\Domain\Model\UserManagement
     */
    protected $user = null;

    /**
     * AMZ分类
     * 
     * @var \ERP\ErpManagementDict\Domain\Model\Category
     */
    protected $category = null;

    /**
     * 分类模板
     * 
     * @var \ERP\ErpManageProductTemplate\Domain\Model\Template
     */
    protected $template = null;

    /**
     * 上传到店铺
     * 
     * @var
     */
    protected $shop = null;

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
     * Returns the firstimage
     * 
     * @return string $firstimage
     */
    public function getFirstimage()
    {
        foreach ($this->images as $key => $img) {
            $this->firstimage = $GLOBALS['TYPO3_CONF_VARS']['FTP']['sever'] . $img->getOriginal();
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
     * Returns the subdate
     * 
     * @return int subdate
     */
    public function getSubdate()
    {
        return $this->subdate;
    }

    /**
     * Sets the subdate
     * 
     * @param string $subdate
     * @return void
     */
    public function setSubdate($subdate)
    {
        $this->subdate = $subdate;
    }

    /**
     * Returns the st1
     * 
     * @return int st1
     */
    public function getSt1()
    {
        return $this->st1;
    }

    /**
     * Sets the st1
     * 
     * @param string $st1
     * @return void
     */
    public function setSt1($st1)
    {
        $this->st1 = $st1;
    }

    /**
     * Returns the st2
     * 
     * @return int st2
     */
    public function getSt2()
    {
        return $this->st2;
    }

    /**
     * Sets the st2
     * 
     * @param string $st2
     * @return void
     */
    public function setSt2($st2)
    {
        $this->st2 = $st2;
    }

    /**
     * Returns the category
     * 
     * @return \ERP\ErpManagementDict\Domain\Model\Category category
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
     * Returns the lang
     * 
     * @return string $lang
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Sets the lang
     * 
     * @param string $lang
     * @return void
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * Returns the timing
     * 
     * @return int $timing
     */
    public function getTiming()
    {
        return $this->timing;
    }

    /**
     * Sets the timing
     * 
     * @param int $timing
     * @return void
     */
    public function setTiming($timing)
    {
        $this->timing = $timing;
    }

    /**
     * Returns the st3
     * 
     * @return int $st3
     */
    public function getSt3()
    {
        return $this->st3;
    }

    /**
     * Sets the st3
     * 
     * @param int $st3
     * @return void
     */
    public function setSt3($st3)
    {
        $this->st3 = $st3;
    }

    /**
     * Returns the st4
     * 
     * @return int $st4
     */
    public function getSt4()
    {
        return $this->st4;
    }

    /**
     * Sets the st4
     * 
     * @param int $st4
     * @return void
     */
    public function setSt4($st4)
    {
        $this->st4 = $st4;
    }

    /**
     * Returns the st5
     * 
     * @return int $st5
     */
    public function getSt5()
    {
        return $this->st5;
    }

    /**
     * Sets the st5
     * 
     * @param int $st5
     * @return void
     */
    public function setSt5($st5)
    {
        $this->st5 = $st5;
    }

    /**
     * Returns the user
     * 
     * @return \ERP\ErpManagementUser\Domain\Model\UserManagement $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Sets the user
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\UserManagement $user
     * @return void
     */
    public function setUser(\ERP\ErpManagementUser\Domain\Model\UserManagement $user)
    {
        $this->user = $user;
    }

    /**
     * Returns the shop
     * 
     * @return $shop
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * Sets the shop
     * 
     * @param string $shop
     * @return void
     */
    public function setShop($shop)
    {
        $this->shop = $shop;
    }

    /**
     * Returns the template
     * 
     * @return \ERP\ErpManageProductTemplate\Domain\Model\Template template
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Sets the template
     * 
     * @param \ERP\ErpManageProductTemplate\Domain\Model\Template $template
     * @return void
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }
}
