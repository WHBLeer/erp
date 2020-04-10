<?php
namespace ERP\ErpManagementProduct\Controller;


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
     * productRepository
     * 
     * @var \ERP\ErpManagementProduct\Domain\Repository\ProductRepository
     * @inject
     */
    protected $productRepository = null;

    /**
     * infoRepository
     * 
     * @var \ERP\ErpManagementProduct\Domain\Repository\InfoRepository
     * @inject
     */
    protected $infoRepository = null;

    /**
     * costRepository
     * 
     * @var \ERP\ErpManagementProduct\Domain\Repository\CostRepository
     * @inject
     */
    protected $costRepository = null;

    /**
     * descRepository
     * 
     * @var \ERP\ErpManagementProduct\Domain\Repository\DescRepository
     * @inject
     */
    protected $descRepository = null;

    /**
     * variantsRepository
     * 
     * @var \ERP\ErpManagementProduct\Domain\Repository\VariantsRepository
     * @inject
     */
    protected $variantsRepository = null;

    /**
     * imagesRepository
     * 
     * @var \ERP\ErpManagementImages\Domain\Repository\ImagesRepository
     * @inject
     */
    protected $imagesRepository = null;
    
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
        $this->regionController   = $this->objectManager->get(\ERP\ErpManagementDict\Controller\RegionController::class);

        if ($_GET['tx_erpmanagementproduct_pi1']['@widget_0']['currentPage']) {
            $this->page = $_GET['tx_erpmanagementproduct_pi1']['@widget_0']['currentPage'];
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

    /**
     * 翻译
     *
     * @param array $data
     * @return void
     * @author wanghongbin
     * tstamp: 2020-03-18
     */
    public function translate($data=array(),$transtype=0)
    {
        require_once (ExtensionManagementUtility::extPath('common') . 'Classes/Library/translate.php');
        $config = $GLOBALS['TYPO3_CONF_VARS']['TRANSLATE'];
        $trans = new \Sll\Common\Library\Translate(['app_key' => $config['app_key'],'sec_key' => $config['sec_key']]);
        
        $datas = array();
        if ($transtype!=0) {
            for ($i=0; $i < count($data['to']); $i++) { 
                $to = ($data['to'][$i]=='zh')? 'zh-CHS' : $data['to'][$i];
                $ret = $trans->do_request($data['query'],$data['from'],$to);
                $ret = json_decode($ret, true);
    
                if ($ret['errorCode']==0) {
                    $datas['text'][$data['to'][$i]] = $ret['translation'][0];
                }else{
                    $datas['text'][$data['to'][$i]] = $data['query'];
                }
            }
        } else {
            for ($i=0; $i < count($data['to']); $i++) { 
                if ($data['from']===$data['to'][$i]) {
                    //from==to时不进行翻译
                    $datas['text'][$data['to'][$i]] = $data['query'];
                    $datas['id'][$data['to'][$i]] = $data['key'].$data['to'][$i];
                    continue;
                }
                $to = ($data['to'][$i]=='zh')? 'zh-CHS' : $data['to'][$i];
                $ret = $trans->do_request($data['query'],$data['from'],$to);
                $ret = json_decode($ret, true);
    
                if ($ret['errorCode']==0) {
                    $datas['text'][$data['to'][$i]] = $ret['translation'][0];
                    $datas['id'][$data['to'][$i]] = $data['key'].$data['to'][$i];
                }else{
                    $datas['text'][$data['to'][$i]] = $data['query'];
                    $datas['id'][$data['to'][$i]] = $data['key'].$data['to'][$i];
                }
            }
        }
        return $datas;
    }

    /**
     * 数据导出
     */
    private function excelExport($datas)
    {
        /** @var \ArminVieweg\PhpexcelService\Service\Phpexcel $phpExcelService */
        $phpExcelService = GeneralUtility::makeInstanceService('phpexcel');
        $phpExcel = $phpExcelService->getPHPExcel();
        $sheet  = $phpExcel->setActiveSheetIndex(0);
        $dataArray[] = array('收据抬头', '捐赠时间', '税号', '捐赠金额', '捐赠渠道', '联系人',  '联系电话');
        if($invoices->count()){
            foreach($invoices as $invoice){
                $dataArray[] = array(
                    $invoice->getHeader(),
                    $this->getDatetime($invoice->getdonatetime()),
                    $invoice->getSpare1(),
                    $invoice->getMoney(),
                    $invoice->getChannelid()->getName(),
                    $invoice->getPeople(),
                    $invoice->getTelphone(),
                );
            }
            $sheet->fromArray($dataArray, NULL, 'A1');
            $objWriter = $phpExcelService->getInstanceOf('PHPExcel_Writer_Excel2007', $phpExcel);
            $fileName = '票据信息_'.date('Y-m-d');
            header('Pragma: public');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Content-Type: application/force-download');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$fileName.'.xlsx"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            exit;
        }
    }

    /**
     * 数据导入
     */
    private function excelImport(){
        $file = $this->request->getArgument('excelImport');
        $fI = GeneralUtility::split_fileref($file['name']);
        if (GeneralUtility::inList('xls,xlsx', $fI['fileext'])) {
            $objPHPReader = $this->objectManager->get($fI['fileext'] == 'xls' ? 'PHPExcel_Reader_Excel5' : 'PHPExcel_Reader_Excel2007');
            $objPHPExcel = $objPHPReader->load($file['tmp_name']);
            $currentSheet = $objPHPExcel->getSheet(0);
            $allRow = $currentSheet->getHighestRow();
            $i = 0;
            $j = 0;
            
            //合作伙伴用户导入
            for ($currentRow = 2; $currentRow <= $allRow; $currentRow++) {
                $A = $currentSheet->getCell('A' . $currentRow)->getValue();
                if (is_object($A)) {
                    $A = trim($A->__toString());
                }
                //手机号
                $B = $currentSheet->getCell('B' . $currentRow)->getValue();
                if (is_object($B)) {
                    $B = $B->__toString();
                }
                //姓名
                $C = $currentSheet->getCell('C' . $currentRow)->getValue();
                if (is_object($C)) {
                    $C = $C->__toString();
                }
                //企业名称
                $D = $currentSheet->getCell('D' . $currentRow)->getValue();
                if (is_object($D)) {
                    $D = $D->__toString();
                }
                //电子邮箱
                $E = $currentSheet->getCell('E' . $currentRow)->getValue();
                if (is_object($E)) {
                    $E = $E->__toString();
                }
                //微信号
                if ($A != '' && $B != '' && $C != '') {
                    $us = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow("*", "fe_users", "disable=0 and  deleted=0 and username='" . $A . "'");
                    if (empty($us)) {
                        //向partner表中插入记录
                        /** @var \Jykj\Umanage\Controller\PartnerController $partner */
                        $partner = $this->objectManager->get(\Jykj\Umanage\Controller\PartnerController::class);
                        $perObj = $partner->saveExplode($C);

                        $tuser = $this->addUserInfo($roletype, 0, $A, $B, $perObj, $E, $D);
                        
                        // 添加用户积分
                        /** @var \Jykj\Newinte\Controller\ListsController $lists */
                        $lists = $this->objectManager->get(\Jykj\Newinte\Controller\ListsController::class);
                        $lists->addIntegation2User(['uid' => $tuser->getUid(), 'openscore' => $xueqi[0], 'closescore' => $xueqi[1],'igroup'=>5, 'inround' => $xueqi[1]]);
                        $i++;
                    }
                }
            }
            $point = ($j > 0) ? '共更新' . $j . '人试讲得分。' : '';
            $this->addFlashMessage('导入成功,本次共导入 ' . $i . ' 条记录。' . $point.$point1, '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        } else {
            $this->addFlashMessage('文件格式不正确，请上传xls, xlsx格式文件。', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        }
        $this->redirect('list', 'Tuser', 'Umanage', array('keyword' => $keyword, 'sgroup' => $sgroup));
    }
}
