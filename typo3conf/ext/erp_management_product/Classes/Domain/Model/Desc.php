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
 * 产品介绍
 */
class Desc extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 标题
     * 
     * @var string
     */
    protected $title = '';

    /**
     * 关键字
     * 
     * @var string
     */
    protected $keyword = '';

    /**
     * 要点说明
     * 
     * @var string
     */
    protected $keyPoints = '';

    /**
     * 产品介绍
     * 
     * @var string
     */
    protected $description = '';

    /**
     * 翻译语言
     * 
     * @var string
     */
    protected $lang = '';

    /**
     * Returns the title
     * 
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     * 
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the keyword
     * 
     * @return string $keyword
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Sets the keyword
     * 
     * @param string $keyword
     * @return void
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * Returns the keyPoints
     * 
     * @return string $keyPoints
     */
    public function getKeyPoints()
    {
        return $this->keyPoints;
    }

    /**
     * Sets the keyPoints
     * 
     * @param string $keyPoints
     * @return void
     */
    public function setKeyPoints($keyPoints)
    {
        $this->keyPoints = $keyPoints;
    }

    /**
     * Returns the description
     * 
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     * 
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
}
