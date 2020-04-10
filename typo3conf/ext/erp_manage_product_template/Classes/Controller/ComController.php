<?php
namespace ERP\ErpManageProductTemplate\Controller;


/***
 *
 * This file is part of the "发票管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Shichang Yang <yangshichang@ngoos.org>, 极益科技
 *
 ***/

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

/**
 * InvoiceController
 */
class ComController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface
     * @inject
     */
    protected $persistanceManager;
    
    /**
     * templateRepository
     * 
     * @var \ERP\ErpManageProductTemplate\Domain\Repository\TemplateRepository
     * @inject
     */
    protected $templateRepository = null;

    
    protected $categoryController = null;
    protected $dictitemController = null;
    protected $dicttypeController = null;
    protected $regionController = null;


    protected $page = 0;

    public function initializeAction()
    {
        
        $this->categoryController = $this->objectManager->get(\ERP\ErpManagementDict\Controller\CategoryController::class);
        $this->dictitemController = $this->objectManager->get(\ERP\ErpManagementDict\Controller\DictitemController::class);
        $this->dicttypeController = $this->objectManager->get(\ERP\ErpManagementDict\Controller\DicttypeController::class);
        if ($_GET['tx_erpmanagetemplate_pi1']['@widget_0']['currentPage']) {
            $this->page = $_GET['tx_erpmanagetemplate_pi1']['@widget_0']['currentPage'];
        } else {
            $this->page = 1;
        }
        
    }

    /**
     * Undocumented function
     *
     * @param integer $pid
     * @param array $uids
     * @return void
     * @author wanghongbin
     * tstamp: 2020-03-01
     */
    public function getCategories()
    {
        $res = $this->categoryController->getCategory();
    }
    
    /**
     * Undocumented function
     *
     * @param integer $pid
     * @param array $uids
     * @return void
     * @author wanghongbin
     * tstamp: 2020-03-01
     */
    public function getChildrens($parentid)
    {
        $res = $this->categoryController->getChildren($parentid);
    }

    /**
     * 获取审核状态
     *
     * @return void
     * @author wanghongbin
     * tstamp: 2020-03-01
     */
    public function getApprovals()
    {
        return $this->dictitemController->findItemsByParent(1);
    }

    /**
     * 获取上架状态
     *
     * @return void
     * @author wanghongbin
     * tstamp: 2020-03-01
     */
    public function getShelves()
    {
        return $this->dictitemController->findItemsByParent(2);
    }

    /**
     * 获取商品获取类型
     *
     * @return void
     * @author wanghongbin
     * tstamp: 2020-03-01
     */
    public function getGettypes()
    {
        return $this->dictitemController->findItemsByParent(3);
    }
    
    /**
     * 分类
     *
     * @param [type] $id
     * @return void
     * @author wanghongbin
     * tstamp: 2020-03-11
     */
    public function getCategoryById($id)
    {
        return $this->categoryController->getCategoryById($id);
    }

    /**
     * 获取商品变体
     *
     * @return void
     * @author wanghongbin
     * tstamp: 2020-03-01
     */
    public function getVariant($pvaId)
    {
        return $this->dictitemController->findItemsByParent($pvaId);
    }
    
    /**
     * 获取商品变体图片
     *
     * @return void
     * @author wanghongbin
     * tstamp: 2020-03-01
     */
    public function getVariantImages($pvaId)
    {
        $ftp = $GLOBALS['TYPO3_CONF_VARS']['FTP']['sever'];
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_erpmanagementimages_domain_model_images');
        $rows = $queryBuilder
        ->add('select','uid,name,re_name,CONCAT("'.$ftp.'",original) original,CONCAT("'.$ftp.'",thumbnail) thumbnail,size')
        ->from('tx_erpmanagementimages_domain_model_images')
        ->where(
            $queryBuilder->expr()->eq('product', $queryBuilder->createNamedParameter($pvaId))
        )
        ->execute()
        ->fetchAll();
        return $rows;
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     * @author wanghongbin
     * tstamp: 2020-03-11
     */
    public function getApprovalById($id)
    {
        return $this->dictitemController->findByUid($id);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     * @author wanghongbin
     * tstamp: 2020-03-11
     */
    public function getShelvesById($id)
    {
        return $this->dictitemController->findByUid($id);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     * @author wanghongbin
     * tstamp: 2020-03-11
     */
    public function getGettypeById($id)
    {
        return $this->dictitemController->findByUid($id);
    }

    private function getDatetime($dateobj){
        $kval="";
        foreach ($dateobj as $key => $value){
            if($key=="date")  $kval = $value;
        }
        return substr($kval,0,10);
    }

}
