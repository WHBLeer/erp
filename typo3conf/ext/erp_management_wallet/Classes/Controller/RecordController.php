<?php
namespace ERP\ErpManagementWallet\Controller;

use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Cache\CacheManager;
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
 * RecordController
 */
class RecordController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * recordRepository
     * 
     * @var \ERP\ErpManagementWallet\Domain\Repository\RecordRepository
     * @inject
     */
    protected $recordRepository = null;

    /**
     * walletRepository
     * 
     * @var \ERP\ErpManagementWallet\Domain\Repository\WalletRepository
     * @inject
     */
    protected $walletRepository = null;

    /**
     * erpUserRepository
     * 
     * @var \ERP\ErpManagementUser\Domain\Repository\ErpUserRepository
     * @inject
     */
    protected $erpUserRepository = null;

    public function initializeAction()
    {
    }

    /**
     * action list
     * 
     * @param ERP\ErpManagementWallet\Domain\Model\Record
     * @return void
     */
    public function listAction()
    {
        $recordes = $this->recordRepository->findAll();
        $this->view->assign('recordes', $recordes);
    }

    /**
     * action show
     * 
     * @param ERP\ErpManagementWallet\Domain\Model\Record
     * @return void
     */
    public function showAction(\ERP\ErpManagementWallet\Domain\Model\Record $record)
    {
        $this->view->assign('record', $record);
    }

    /**
     * action new
     * 
     * @param ERP\ErpManagementWallet\Domain\Model\Record
     * @return void
     */
    public function newAction()
    {
        $userid = $GLOBALS['TSFE']->fe_user->user["uid"];
        $wallet = $this->walletRepository->findByUser($userid);
        if (!$wallet) {
            //钱包不存在时重新创建钱包
            $this->forward('index', 'Wallet', null, []);
        }
        $recordid = ($this->request->hasArgument('record')) ? $this->request->getArgument('record') : null;
        if ($recordid) {
            $record = $this->recordRepository->findByUid($recordid);
            $erpUser = $record->getErpuser();
        } else {
            $erpUser = $this->erpUserRepository->findByUid($userid);
            $record = new \ERP\ErpManagementWallet\Domain\Model\Record;
            $record->setWalletid($wallet->getUid());
            $record->setErpuser($erpUser);
        }
        $this->view->assign('wallet', $wallet);
        $this->view->assign('record', $record);
        $this->view->assign('erpuser', $erpUser);
    }

    /**
     * action create
     * 
     * @param ERP\ErpManagementWallet\Domain\Model\Record
     * @return void
     */
    public function createAction(\ERP\ErpManagementWallet\Domain\Model\Record $record)
    {
        $this->addFlashMessage('充值订单已提交,请尽快充值完成!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $record->setRemark('账户余额充值');
        $record->setSerialNumber('HLCZ$'.date('YmdHis').'$'.$record->getErpuser()->getUid());
        // dd($record);
        $this->recordRepository->add($record);
        $this->refresh_obj();

        if ($record->getPayment()==1) {
            //调用支付宝支付
            $this->aliPay($record);
        } elseif ($record->getPayment()==2) {
            //调用微信支付
            $this->wechatPay($record);
        } elseif ($record->getPayment()==3) {
            //调用银联支付
            $this->unionPay($record);
        }
        
    }

    /**
     * action edit
     * 
     * @param ERP\ErpManagementWallet\Domain\Model\Record
     * @ignorevalidation $record
     * @return void
     */
    public function editAction(\ERP\ErpManagementWallet\Domain\Model\Record $record)
    {
        $this->view->assign('record', $record);
    }

    /**
     * action update
     * 
     * @param ERP\ErpManagementWallet\Domain\Model\Record
     * @return void
     */
    public function updateAction(\ERP\ErpManagementWallet\Domain\Model\Record $record)
    {
        $this->addFlashMessage('物流信息编辑成功!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->recordRepository->update($record);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param ERP\ErpManagementWallet\Domain\Model\Record
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementWallet\Domain\Model\Record $record)
    {
        $this->addFlashMessage('物流信息删除成功!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->recordRepository->remove($record);
        $this->redirect('list');
    }

    /**
     * action callback
     * 
     * @return void
     */
    public function callbackAction()
    {
    }

    /**
     * action success
     * 
     * @return void
     */
    public function successAction()
    {
    }

    /**
     * action syslist
     * 
     * @return void
     */
    public function syslistAction()
    {
    }

    /*
     * 支付宝支付
     * @param $record
     */
    private function aliPay($record)
    {
        include_once ExtensionManagementUtility::extPath('erp_management_wallet') . 'Classes/Library/alipay/config.php';
        require_once ExtensionManagementUtility::extPath('erp_management_wallet') . 'Classes/Library/alipay/pagepay/service/AlipayTradeService.php';
        require_once ExtensionManagementUtility::extPath('erp_management_wallet') . 'Classes/Library/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php';

        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        //商品描述，可空
        $payRequestBuilder->setBody(trim($record->getRemark()));
        //订单名称，必填
        $payRequestBuilder->setSubject(trim('余额充值'));
        //付款金额，必填
        $payRequestBuilder->setTotalAmount(trim($record->getAmount()));
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $payRequestBuilder->setOutTradeNo(trim($record->getSerialNumber()));
        $aop = new \AlipayTradeService($config);
        dd($aop);

        /**
        * pagePay 电脑网站支付请求
        * @param $builder 业务参数，使用buildmodel中的对象生成。
        * @param $return_url 同步跳转地址，公网可以访问
        * @param $notify_url 异步通知地址，公网可以访问
        * @return $response 支付宝返回的信息
        */
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        //输出表单
        var_dump($response);

        //建立请求
        $alipaySubmit = new \NGOOS\Payment\Controller\AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter, "post", "确认");
        $this->view->assign('payHtml', $html_text);
    }

    /**
     * 对象存储刷新
     * 
     * @return [type] [description]
     */
    public function refresh_obj()
    {
        $persistenceManager = $this->objectManager->get(PersistenceManager::class);
        $persistenceManager->persistAll();
    }
}
