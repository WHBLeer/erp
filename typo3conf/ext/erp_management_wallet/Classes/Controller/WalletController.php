<?php
namespace ERP\ErpManagementWallet\Controller;

use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Cache\CacheManager;

/***
 *
 * This file is part of the "钱包模块管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>, 三里林
 *
 ***/
/**
 * WalletController
 */
class WalletController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

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
    protected $page = 0;
    public function initializeAction()
    {
        if ($_GET['tx_erpmanagementwallet_pi1']['@widget_0']['currentPage']) {
            $this->page = $_GET['tx_erpmanagementwallet_pi1']['@widget_0']['currentPage'];
        } else {
            $this->page = 1;
        }
    }

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $wallets = $this->walletRepository->findAll();
        $this->view->assign('wallets', $wallets);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementWallet\Domain\Model\Wallet $wallet
     * @return void
     */
    public function showAction(\ERP\ErpManagementWallet\Domain\Model\Wallet $wallet)
    {
        $this->view->assign('wallet', $wallet);
    }

    /**
     * action index
     * 
     * @return void
     */
    public function indexAction()
    {
        $userid = $GLOBALS['TSFE']->fe_user->user["uid"];
        $wallet = $this->walletRepository->findByUser($userid);
        if (!$wallet) {
            $erpUser = $this->erpUserRepository->findByUid($userid);
            $wallet = new \ERP\ErpManagementWallet\Domain\Model\Wallet();

            // 钱包识别码，32位随机字符串
            $wallet->setWalletNumber(md5(uniqid(microtime(true), true)));
            $wallet->setErpuser($erpUser);
            $this->walletRepository->add($wallet);
            $this->refresh_obj();
        }

        // 更新提现信息
        if ($this->request->hasArgument('txdata')) {
            $wallet->setName($this->request->getArgument('name'));
            $wallet->setPassword(md5($this->request->getArgument('password')));
            $this->walletRepository->update($wallet);
            $this->refresh_obj();
            $this->addFlashMessage('信息更新成功!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        }
        $this->view->assign('wallet', $wallet);
        $this->view->assign('page', $this->page);
    }

    /**
     * action topup
     * 
     * @return void
     */
    public function topupAction()
    {
        $userid = $GLOBALS['TSFE']->fe_user->user["uid"];
        $wallet = $this->walletRepository->findByUser($userid);
        $this->view->assign('wallet', $wallet);
    }

    /**
     * action 成功
     * 
     * @return void
     */
    public function successAction()
    {
        $paymentObject = $this->payRepository->findByUid($this->request->getArgument('data'));

        //证书申请
        /** @var \NGOOS\SiteConfig\Controller\ConfigController $certManager */
        $certManager = $this->objectManager->get(\NGOOS\SiteConfig\Controller\ConfigController::class);
        $cert_number = strtoupper($GLOBALS['TYPO3_CONF_VARS']['CERTIFICATE']['prefix'] . '-' . date('Ymd', time()) . '-' . sprintf("%05d", $paymentObject->getUid()));
        $certManager->generateCertificate($paymentObject->getName(), $paymentObject->getMoney(), $cert_number);
        $paymentObject->setCertnumber($cert_number);
        $this->payRepository->update($paymentObject);

        // then persist everything get last sql insert id
        $persistenceManager = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager::class);
        $persistenceManager->persistAll();
        if (is_file('uploads/certificate/' . $cert_number . '.jpg') && $paymentObject->getEmail() && GeneralUtility::validEmail($paymentObject->getEmail())) {

            //send email to user.
            if ($GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress'] != '') {
                $mail = $this->objectManager->get(\TYPO3\CMS\Core\Mail\MailMessage::class);
                $mail->setFrom(array($GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress'] => $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromName']));
                $mail->setTo(array($paymentObject->getEmail() => $paymentObject->getName()));
                $mail->setSubject($this->settings['mailsubject']);
                $mail->setBody(nl2br($this->settings['mailbody']), 'text/html', 'utf-8');
                $mail->attach(\Swift_Attachment::fromPath(PATH_site . 'uploads/certificate/' . $cert_number . '.jpg')->setFilename($cert_number . '.jpg'));
                $mail->send();
            }
        }
        $this->view->assignMultiple(
        array(
        'paymentObject' => $paymentObject, 
        'contentObject' => $this->configurationManager->getContentObject()->data, 
        'baseURL' => GeneralUtility::getIndpEnv('TYPO3_SITE_URL')
        )
        );
        $this->addFlashMessage($this->view->render());
        header('Location: ' . $paymentObject->getUrl());
        exit;
    }

    /**
     * 支付异步通知
     * 
     * @return void
     */
    public function callbackAction()
    {
        include_once ExtensionManagementUtility::extPath('erp_management_wallet') . 'Classes/Library/alipay/config.php';
        require_once ExtensionManagementUtility::extPath('erp_management_wallet') . 'Classes/Library/alipay/pagepay/service/AlipayTradeService.php';

        $arr=$_POST;
        $alipaySevice = new \AlipayTradeService($config); 
        $alipaySevice->writeLog(var_export($_POST,true));
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        //支付宝验证成功
        if($result) {
            
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代

            
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            
            //商户订单号

            $out_trade_no = $_POST['out_trade_no'];

            //支付宝交易号

            $trade_no = $_POST['trade_no'];

            //交易状态
            $trade_status = $_POST['trade_status'];


            if($_POST['trade_status'] == 'TRADE_FINISHED') {

                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                    //如果有做过处理，不执行商户的业务程序
                        
                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
            }
            else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                    //如果有做过处理，不执行商户的业务程序			
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            echo "success";	//请不要修改或删除
        }else {
            //验证失败
            echo "fail";
        }
        exit;
    }

    /*
     * 支付宝支付
     */
    /**
     * @param $newPay
     */
    private function aliPay($newPay)
    {
        require_once ExtensionManagementUtility::extPath('erp_management_wallet') . 'Classes/Library/alipay/alipay_submit.class.php';

        //↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
        $alipay_config['partner'] = $GLOBALS['ALIPAY_PARTNER'];

        //合作身份者id，以2088开头的16位纯数字
        $alipay_config['key'] = $GLOBALS['ALIPAY_KEY'];

        //安全检验码，以数字和字母组成的32位字符
        $alipay_config['sign_type'] = strtoupper('MD5');

        //签名方式 不需修改
        $alipay_config['input_charset'] = strtolower('utf-8');

        //字符编码格式 目前支持 gbk 或 utf-8
        $alipay_config['cacert'] = ExtensionManagementUtility::extPath('payment') . 'lib/alipay/cacert.pem';

        //ca证书路径地址，用于curl中ssl校验 请保证cacert.pem文件在当前文件夹目录中
        $alipay_config['transport'] = 'http';

        //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        //↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓请求参数↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓/
        $payment_type = "1";

        //支付类型 必填，不能修改
        $notify_url = GeneralUtility::locationHeaderUrl('typo3conf/ext/payment/api/alipay.php');

        //服务器异步通知页面路径
        $return_url = $this->uriBuilder->reset()->setCreateAbsoluteUri(true)->setArguments($this->getArray)->uriFor('success', array('data' => $newPay->getUid()));

        //页面跳转同步通知页面路径
        $seller_email = $GLOBALS['ALIPAY_ACCOUNT'];

        //卖家支付宝帐户
        $out_trade_no = 'DD-' . date('Ymd', time()) . '-' . $newPay->getUid();

        //商户网站订单系统中唯一订单号
        $subject = $newPay->getTitle();

        //订单名称
        $total_fee = $newPay->getMoney();

        //付款金额
        $body = '捐款人: ' . $newPay->getName();

        //订单描述
        $show_url = GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL');

        //商品展示地址
        $anti_phishing_key = "";
        $exter_invoke_ip = "";

        //↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓构造要请求的参数数组↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓/
        $parameter = array(
        "service" => $GLOBALS['TYPO3_CONF_VARS']['ALIPAY']['service'], 
        "partner" => trim($alipay_config['partner']), 
        "payment_type" => $payment_type, 
        "notify_url" => $notify_url, 
        "return_url" => $return_url, 
        "seller_email" => $seller_email, 
        "out_trade_no" => $out_trade_no, 
        "subject" => $subject, 
        "total_fee" => $total_fee, 
        "body" => $body, 
        "show_url" => $show_url, 
        "anti_phishing_key" => $anti_phishing_key, 
        "exter_invoke_ip" => $exter_invoke_ip, 
        "_input_charset" => trim(strtolower($alipay_config['input_charset']))
        );

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
