<?php
namespace ERP\ErpManagementImages\Domain\Model;


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
class Images extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 名称
     * 
     * @var string
     */
    protected $name = '';

    /**
     * 重命名
     * 
     * @var string
     */
    protected $reName = '';

    /**
     * 原图链接
     * 
     * @var string
     */
    protected $original = '';

    /**
     * 缩略图链接
     * 
     * @var string
     */
    protected $thumbnail = '';

    /**
     * 文件size
     * 
     * @var string
     */
    protected $size = '';

    /**
     * Returns the name
     * 
     * @return string name
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
     * Returns the reName
     * 
     * @return string reName
     */
    public function getReName()
    {
        return $this->reName;
    }

    /**
     * Sets the reName
     * 
     * @param string $reName
     * @return void
     */
    public function setReName($reName)
    {
        $this->reName = $reName;
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
     * Returns the thumbnail
     * 
     * @return string $thumbnail
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Sets the thumbnail
     * 
     * @param string $thumbnail
     * @return void
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * Returns the size
     * 
     * @return string $size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Sets the size
     * 
     * @param string $size
     * @return void
     */
    public function setSize($size)
    {
        $this->size = $size;
    }
}
