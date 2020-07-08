<?php
namespace ERP\ErpManagementPrupload\Domain\Model;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
/***
 *
 * This file is part of the "产品上传" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * 产品上传
 */
class Upload extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 上传的店铺
     * 
     * @var string
     */
    protected $market = '';

    /**
     * 上传语言
     * 
     * @var string
     */
    protected $lang = '';

    /**
     * 分类
     * 
     * @var string
     */
    protected $categoryText = '';

    /**
     * 分类节点
     * 
     * @var string
     */
    protected $categoryNode = '';

    /**
     * 分类模板
     * 
     * @var string
     */
    protected $template = '';

    /**
     * 上传时间
     * 
     * @var int
     */
    protected $uploadtime = '';

    /**
     * 上传状态 0上传中 1上传成功 2上传失败
     * 
     * @var int
     */
    protected $cpStatus = 0;

    /**
     * 关系状态 0上传中 1上传成功 2上传失败
     * 
     * @var int
     */
    protected $gxStatus = 0;

    /**
     * 图片状态 0上传中 1上传成功 2上传失败
     * 
     * @var int
     */
    protected $tpStatus = 0;

    /**
     * 库存状态 0上传中 1上传成功 2上传失败
     * 
     * @var int
     */
    protected $kcStatus = 0;

    /**
     * 价格状态 0上传中 1上传成功 2上传失败
     * 
     * @var int
     */
    protected $jgStatus = 0;

    /**
     * 最后更新时间
     * 
     * @var int
     */
    protected $lastUpdateDate = 0;

    /**
     * 操作人
     * 
     * @var \ERP\ErpManagementUser\Domain\Model\ErpUser
     */
    protected $user = null;

    /**
     * 上传的产品
     * 
     * @var string
     */
    protected $products = '';

    /**
     * 变体
     * 
     * @var string
     */
    protected $variants = 0;

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
     * Returns the market
     * 
     * @return string $market
     */
    public function getMarket()
    {
        return $this->market;
    }

    /**
     * Sets the market
     * 
     * @param string $market
     * @return void
     */
    public function setMarket($market)
    {
        $this->market = $market;
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
     * Returns the categoryText
     * 
     * @return string $categoryText
     */
    public function getCategoryText()
    {
        return $this->categoryText;
    }

    /**
     * Sets the categoryText
     * 
     * @param string $categoryText
     * @return void
     */
    public function setCategoryText($categoryText)
    {
        $this->categoryText = $categoryText;
    }

    /**
     * Returns the categoryNode
     * 
     * @return string $categoryNode
     */
    public function getCategoryNode()
    {
        return $this->categoryNode;
    }

    /**
     * Sets the categoryNode
     * 
     * @param string $categoryNode
     * @return void
     */
    public function setCategoryNode($categoryNode)
    {
        $this->categoryNode = $categoryNode;
    }

    /**
     * Returns the template
     * 
     * @return string $template
     */
    public function getTemplate()
    {
        $this->template = substr($this->template, 0, strrpos($this->template, ")") + 1);
        return $this->template;
    }

    /**
     * Sets the template
     * 
     * @param string $template
     * @return void
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * Returns the cpStatus
     * 
     * @return int $cpStatus
     */
    public function getCpStatus()
    {
        return $this->cpStatus;
    }

    /**
     * Sets the cpStatus
     * 
     * @param int $cpStatus
     * @return void
     */
    public function setCpStatus($cpStatus)
    {
        $this->cpStatus = $cpStatus;
    }

    /**
     * Returns the gxStatus
     * 
     * @return int $gxStatus
     */
    public function getGxStatus()
    {
        return $this->gxStatus;
    }

    /**
     * Sets the gxStatus
     * 
     * @param int $gxStatus
     * @return void
     */
    public function setGxStatus($gxStatus)
    {
        $this->gxStatus = $gxStatus;
    }

    /**
     * Returns the tpStatus
     * 
     * @return int $tpStatus
     */
    public function getTpStatus()
    {
        return $this->tpStatus;
    }

    /**
     * Sets the tpStatus
     * 
     * @param int $tpStatus
     * @return void
     */
    public function setTpStatus($tpStatus)
    {
        $this->tpStatus = $tpStatus;
    }

    /**
     * Returns the kcStatus
     * 
     * @return int $kcStatus
     */
    public function getKcStatus()
    {
        return $this->kcStatus;
    }

    /**
     * Sets the kcStatus
     * 
     * @param int $kcStatus
     * @return void
     */
    public function setKcStatus($kcStatus)
    {
        $this->kcStatus = $kcStatus;
    }

    /**
     * Returns the jgStatus
     * 
     * @return int $jgStatus
     */
    public function getJgStatus()
    {
        return $this->jgStatus;
    }

    /**
     * Sets the jgStatus
     * 
     * @param int $jgStatus
     * @return void
     */
    public function setJgStatus($jgStatus)
    {
        $this->jgStatus = $jgStatus;
    }

    /**
     * Returns the user
     * 
     * @return \ERP\ErpManagementUser\Domain\Model\ErpUser $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Sets the user
     * 
     * @param \ERP\ErpManagementUser\Domain\Model\ErpUser $user
     * @return void
     */
    public function setUser(\ERP\ErpManagementUser\Domain\Model\ErpUser $user)
    {
        $this->user = $user;
    }

    /**
     * Returns the uploadtime
     * 
     * @return int uploadtime
     */
    public function getUploadtime()
    {
        return $this->uploadtime;
    }

    /**
     * Sets the uploadtime
     * 
     * @param string $uploadtime
     * @return void
     */
    public function setUploadtime($uploadtime)
    {
        $this->uploadtime = $uploadtime;
    }

    /**
     * Returns the lastUpdateDate
     * 
     * @return int $lastUpdateDate
     */
    public function getLastUpdateDate()
    {
        return $this->lastUpdateDate;
    }

    /**
     * Sets the lastUpdateDate
     * 
     * @param int $lastUpdateDate
     * @return void
     */
    public function setLastUpdateDate($lastUpdateDate)
    {
        $this->lastUpdateDate = $lastUpdateDate;
    }

    /**
     * Returns the products
     * 
     * @return string $products
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Sets the products
     * 
     * @param string $products
     * @return void
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * Returns the variants
     * 
     * @return string $variants
     */
    public function getVariants()
    {
        $uidsArr = array_filter(array_unique(explode(',',trim($this->products))));
        for ($i=0; $i < count($uidsArr); $i++) { 
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_erpmanagementproduct_domain_model_product');
            $this->variants += $queryBuilder
            ->count('uid')
            ->from('tx_erpmanagementproduct_domain_model_product')
            ->where(
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uidsArr[$i]))
            )
            ->execute()
            ->fetchColumn(0);
        }
        
        return $this->variants;
    }
}
