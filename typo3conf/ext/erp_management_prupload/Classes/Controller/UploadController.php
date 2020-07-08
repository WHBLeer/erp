<?php
namespace ERP\ErpManagementPrupload\Controller;

use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Configuration\ConfigurationManager;
use TYPO3\CMS\Core\Crypto\Random;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Saltedpasswords\Salt\SaltFactory;
use TYPO3\CMS\Saltedpasswords\Utility\SaltedPasswordsUtility;

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
require_once ExtensionManagementUtility::extPath('erp_management_interaction') . 'Classes/Library/ErpServerApi.php';

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
 * UploadController
 */
class UploadController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * uploadRepository
     * 
     * @var \ERP\ErpManagementPrupload\Domain\Repository\UploadRepository
     * @inject
     */
    protected $uploadRepository = null;

    /**
     * productRepository
     * 
     * @var \ERP\ErpManagementProduct\Domain\Repository\ProductRepository
     * @inject
     */
    protected $productRepository = null;

    /**
     * erpUserRepository
     * 
     * @var \ERP\ErpManagementUser\Domain\Repository\ErpUserRepository
     * @inject
     */
    protected $erpUserRepository = null;

    protected $times = array(
        array('val'=>'18:00:00','title'=>'当日 18:00'),
        array('val'=>'21:00:00','title'=>'当日 21:00'),
        array('val'=>'00:00:00','title'=>'次日 00:00'),
        array('val'=>'03:00:00','title'=>'次日 03:00'),
    );

    protected $page = 0;
    public function initializeAction()
    {
        if ($_GET['tx_erpmanagementprupload_pi1']['@widget_0']['currentPage']) {
            $this->page = $_GET['tx_erpmanagementprupload_pi1']['@widget_0']['currentPage'];
        } else {
            $this->page = 1;
        }
    }

    /**
     * action list
     * 
     * @param ERP\ErpManagementPrupload\Domain\Model\Upload
     * @return void
     */
    public function listAction()
    {
        $uploads = $this->uploadRepository->findAll();
        $this->view->assign('uploads', $uploads);
        $this->view->assign('page', $this->page);
        $user = $this->erpUserRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
        $this->view->assign('page', $this->page);
        $markets = [];
        foreach ($user->getAuth() as $key => $auths) {
            $markets = json_decode( $auths->getAuthcountry(), true );
            foreach ($markets as $key => &$val) {
                $val['name'] = $auths->getShopalias().'('.$val['name'].')';
            }
        }
        $this->view->assign('markets', $markets);
        $this->view->assign('times', $this->times);
    }

    /**
     * action show
     * 
     * @param ERP\ErpManagementPrupload\Domain\Model\Upload
     * @return void
     */
    public function showAction(\ERP\ErpManagementPrupload\Domain\Model\Upload $upload)
    {
        $this->view->assign('upload', $upload);
    }

    /**
     * action new
     * 
     * @param ERP\ErpManagementPrupload\Domain\Model\Upload
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param ERP\ErpManagementPrupload\Domain\Model\Upload
     * @return void
     */
    public function createAction(\ERP\ErpManagementPrupload\Domain\Model\Upload $upload)
    {
        $datas = $this->request->getArguments();
        // dump($datas);exit;
        $userid = $GLOBALS['TSFE']->fe_user->user["uid"];
        $erpUser = $this->erpUserRepository->findByUid($userid);
        $upload->setMarket($datas['market']);
        $upload->setCategoryText($datas['categoryText']);
        $upload->setTemplate($datas['template']);
        $upload->setLastUpdateDate(time());
        $upload->setUploadtime($this->composeUploadTime($datas['uploadTime']));
        $upload->setUser($erpUser);
        $this->addFlashMessage('数据已提交!排队上传中', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->uploadRepository->add($upload);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param ERP\ErpManagementPrupload\Domain\Model\Upload
     * @ignorevalidation $upload
     * @return void
     */
    public function editAction(\ERP\ErpManagementPrupload\Domain\Model\Upload $upload)
    {
        $this->view->assign('upload', $upload);
    }

    /**
     * action update
     * 
     * @param ERP\ErpManagementPrupload\Domain\Model\Upload
     * @return void
     */
    public function updateAction(\ERP\ErpManagementPrupload\Domain\Model\Upload $upload)
    {
        $this->addFlashMessage('数据已修改', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->uploadRepository->update($upload);
        $actionname = $this->request->hasArgument('actionname') ? $this->request->getArgument('actionname') : 'list';
        $this->redirect($actionname);
    }

    /**
     * action delete
     * 
     * @param ERP\ErpManagementPrupload\Domain\Model\Upload
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementPrupload\Domain\Model\Upload $upload)
    {
        $this->addFlashMessage('数据已删除', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->uploadRepository->remove($upload);
        $this->redirect('list');
    }

    /**
     * 批量处理
     * 
     * @return void
     */
    public function batchAction()
    {
        $items = $this->request->hasArgument('datas') ? $this->request->getArgument('datas') : array();
        if ($items['items']) {
            $item = substr($items['items'], 0, strlen($items['items']) - 1);
            $iRet = $this->uploadRepository->deleteByUidstring($item);
            if ($iRet > 0) {
                $this->addFlashMessage('删除成功！', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);

                //刷新前台缓存
                GeneralUtility::makeInstance(CacheManager::class)->flushCachesInGroup('pages');
            } else {
                $this->addFlashMessage('删除失败！', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
            }
            $this->redirect('list');
        }
        $this->addFlashMessage('没有可删除对象！', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->redirect('list');
    }

    /**
     * action ajax
     * 
     * @return void
     */
    public function ajaxAction()
    {
        $cmd = GeneralUtility::_GP('cmd');

        // 获取上传数据
        if ($cmd == 'getupload') {
            $uid = GeneralUtility::_GP('uid');
            $upload = $this->uploadRepository->finByUid($uid);
            $datas[] = array(
                'uid' => $upload->getUid(),
                'puids' => $upload->getName(),
                // 'updateOption' => $upload->getName(),
                'market' => $upload->getMarket(),
                'lang' => $upload->getLang(),
                'categoryText' => $upload->getCategoryText(),
                'categoryId' => $upload->getCategoryNode(),
                'uploadType' => $upload->getTemplate(),
                'uploadTime' => $upload->getUploadtime(),
            );
            JSON($datas);
        } 
        JSON(array('code'=>-1,'message'=>'没有请求的动作'));
    }

    /**
     * 查询符合条件的商品进行上传
     * 
     * @return void
     */
    public function pullAction()
    {
        $prupload = $this->uploadRepository->findAllUploadByTime();
        $this->uploadProduct($prupload);
        
    }

    /**
     * 上传商品
     *
     * @param [type] $product
     * @return void
     * @author wanghongbin
     * tstamp: 2020-07-07
     */
    public function uploadProduct($prupload)
    {
        $uids = array_filter(array_unique(explode(',',trim($this->getProducts()))));
        $productinfo = [];
        for ($i=0; $i < count($uids); $i++) { 
            $product = $this->productRepository->findByUid($uids[$i]);
            $descArr = array();
            foreach ($product->getDescr() as $key => $desc) {
                $descArr[$desc->getLang()] = array(
                    'title' => $desc->getTitle(),// 标题
                    'keyword' => $desc->getKeyword(),// 关键字
                    'keyPoints' => $desc->getKeyPoints(),// 要点说明
                    'description' => $desc->getDescription(),// 产品介绍
                );
            }
            $variantsArr = array();
            foreach ($product->getVariants() as $key => $variants) {
                $variantsArr[] = array(
                    'combination' => $variants->getCombination(),//组合
                    'skuNew' => $variants->getSkuNew(),//sku修正
                    'markup' => $variants->getMarkup(),//加价
                    'kucun' => $variants->getKucun(),//库存
                    'upcEan' => $variants->getUpcEan(),//UPC/EAN
                    'images' => $variants->getImages(),//已选图片
                );
            }
            //与服务端数据对接
            $productinfo[] = array(
                'productId' => $product->getUid(),//数据库主键id
                'numbering' => $product->getNumbering(), //产品编号
                'name' => $product->getName(), //产品名称
                'business' => $product->getBusiness(), //产品主页链接
                'original' => $product->getOriginal(), //原始规格
                'categoryZh' => $product->getCategory()->getName(),//产品分类中文
                'categoryEn' => $product->getCategory()->getNameEn(),//产品分类英文
                'approval' => $product->getApproval()->getCode(),//审核状态(0待审核.1通过.2失效)
                'shelves' => $product->getShelves()->getCode(),//上架状态(4屏蔽,3侵权,2过滤,1下架,0上架)
                'gtypes' => $product->getGtypes()->getCode(),//商品获取类型(5其他,4产品库,3抓取,2海外,1原创,0重点)
                'info' => array(
                    'tradeName' => $product->getInfo()->getTradeName(),
                    'brandName' => $product->getInfo()->getBrandName(),
                    'tradeNum' => $product->getInfo()->getTradeNum(),
                    'sku' => $product->getInfo()->getSku(),
                    'source' => $product->getInfo()->getSource(),
                    'link' => $product->getInfo()->getLink(),
                    'code' => $product->getInfo()->getCode(),
                    'remark' => $product->getInfo()->getRemark(),
                ),
                'cost' => array(
                    'cg' => $product->getCost()->getCg(), //采购价
                    'zl' => $product->getCost()->getZl(), //重量
                    'cc' => $product->getCost()->getCc(), //尺寸
                    'kd' => $product->getCost()->getKd(), //宽度
                    'gd' => $product->getCost()->getGd(), //高度
                    'yf' => $product->getCost()->getYf(), //国内运费
                    'zk' => $product->getCost()->getZk(), //折扣
                    'calculation' => $product->getCost()->getCalculation(), //计算结果
                    'sy' => $product->getCost()->getSy(), //库存
                    'sj' => $product->getCost()->getSj(), //预处理时间
                ),
                'desc' => $descArr,
                'variants' => $variantsArr,
            );
        }

        //上传到服务端
        if (!empty($productinfo)) {
            $ErpServer = new \ERP\Api\ErpServer\ErpProductApi();
            $res = $ErpServer->productOnTheShelf(array(
                'accountId' => $prupload->getUser()->getAccountId(),
                'productinfo' => $productinfo
            ));
            if ($res['rspCode'==0]) {
                //更新上传记录
                $prupload->setLastUpdateDate(time());
                $prupload->setCpStatus(1);
                $prupload->setGxStatus(1);
                $prupload->setTpStatus(1);
                $prupload->setKcStatus(1);
                $prupload->setJgStatus(1);
                $this->uploadRepository->update($prupload);
                $this->refreshObject();
            }
        }
        
    }

    /**
     * 上传记录
     *
     * @param array $datas
     * @return void
     * @author wanghongbin
     * tstamp: 2020-07-06
     */
    public function addPrupload($datas=array())
    { 
        $userid = $GLOBALS['TSFE']->fe_user->user["uid"];
        $erpUser = $this->erpUserRepository->findByUid($userid);
        // dump($datas);
        $product = $this->productRepository->findByUid($datas['pruid']);
        //添加上传记录
        $prupload = new \ERP\ErpManagementPrupload\Domain\Model\Upload();
        $prupload->setMarket($datas['market']);
        $prupload->setLang($datas['lang']);
        $prupload->setCategoryText($datas['categoryValuetext']);
        $prupload->setCategoryNode($datas['categoryValueid']);
        $prupload->setTemplate($datas['uploadType']);
        $prupload->setUploadtime($this->composeUploadTime($datas['uploadTime']));
        // $prupload->setLastUpdateDate(time());
        $prupload->setProduct($product);
        $prupload->setUser($erpUser);
        // dump($prupload);exit;
        $this->uploadRepository->add($prupload);
        $this->refreshObject();
        // dump($prupload);
        return $prupload;
    }

    /**
     * 组合上传时间
     *
     * @param string $timestr
     * @return void
     * @author wanghongbin
     * tstamp: 2020-07-07
     */
    public function composeUploadTime($timestr='')
    {
        switch ($timestr) {
            case '18:00:00':
                $time = strtotime(date('Y-m-d 18:00:00'));
                break;
            case '21:00:00':
                $time = strtotime(date('Y-m-d 21:00:00'));
                break;
            case '00:00:00':
                $time = strtotime(date("Y-m-d 00:00:00",strtotime("+1 day")));
                break;
            case '03:00:00':
                $time = strtotime(date('Y-m-d 03:00:00',strtotime("+1 day")));
                break;
            default:
                $time = strtotime(date('Y-m-d H:i:s',strtotime("+1 hours")));
                break;
        }
        return $time;
    }

    /**
     * 对象存储刷新
     * 
     * @return [type] [description]
     */
    public function refreshObject()
    {
        $persistenceManager = $this->objectManager->get(PersistenceManager::class);
        $persistenceManager->persistAll();
    }
}
