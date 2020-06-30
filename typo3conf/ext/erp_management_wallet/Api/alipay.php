<?php
/**
 * Author: it
 * 支付宝支付成功异步回调页面
 */
header("Content-type:text/html;charset=utf-8");
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
define('TYPO3_MODE', true);
/*require_once("../../../../typo3/sysext/core/Classes/Utility/MathUtility.php");
require_once("../../../../typo3/sysext/core/Classes/Utility/GeneralUtility.php");
require_once("../../../../typo3/sysext/core/Classes/Html/HtmlParser.php");
require_once("../../../../typo3/sysext/core/Classes/Database/DatabaseConnection.php");
require_once("../../../../vendor/doctrine/dbal/lib/Doctrine/DBAL/DriverManager.php");
require_once("../../../../vendor/doctrine/dbal/lib/Doctrine/DBAL/Configuration.php");
require_once("../../../../vendor/doctrine/common/lib/Doctrine/Common/EventManager.php");
require_once("../../../../vendor/doctrine/dbal/lib/Doctrine/DBAL/Driver/Mysqli/Driver.php");
require_once("../../../../vendor/doctrine/dbal/lib/Doctrine/DBAL/Driver/AbstractMySQLDriver.php");*/


date_default_timezone_set('Asia/Shanghai');

//connect db
$configArray = include_once("../../../../typo3conf/LocalConfiguration.php");

/*$GLOBALS['TYPO3_DB'] = new TYPO3\CMS\Core\Database\DatabaseConnection;
$GLOBALS['TYPO3_DB']->setDatabaseHost($configArray['DB']['Connections']['Default']['host']);
$GLOBALS['TYPO3_DB']->setDatabaseUsername($configArray['DB']['Connections']['Default']['user']);
$GLOBALS['TYPO3_DB']->setDatabasePassword($configArray['DB']['Connections']['Default']['password']);
$GLOBALS['TYPO3_DB']->setDatabaseName($configArray['DB']['Connections']['Default']['dbname']);
$GLOBALS['TYPO3_DB']->connectDB();
*/

$con = new mysqli($configArray['DB']['Connections']['Default']['host'],$configArray['DB']['Connections']['Default']['user'],$configArray['DB']['Connections']['Default']['password'],$configArray['DB']['Connections']['Default']['dbname']);
if(!$con){
    die("connect error:".mysqli_connect_error());
}

//debug
$log = '../log/' . date('Y-m-d') . '.log';
//error_log(date('Y-m-d H:i:s').': '.json_encode($_POST).chr(10).chr(10), 3, $log);

require_once('../lib/alipay/alipay_notify.class.php');

include_once("config.php");

$alipay_config['partner'] = $GLOBALS['ALIPAY_PARTNER']; //合作者身份
$alipay_config['key'] = $GLOBALS['ALIPAY_KEY']; //安全校验码
$alipay_config['sign_type'] = strtoupper('MD5');
$alipay_config['input_charset'] = strtolower('utf-8');
$alipay_config['cacert'] = str_replace("/api", "", dirname(__FILE__)).'/lib/alipay/cacert.pem';
$alipay_config['transport'] = 'http';

//计算得出通知验证结果
$alipayNotify = new \NGOOS\Payment\Controller\AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();
if ($verify_result) {
    //交易状态
    $trade_status = $_POST['trade_status'];
    if ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
        $out_trade_no = end(explode("-", $_POST['out_trade_no'])); //商户订单号
        

		$query = "update tx_payment_domain_model_pay set hidden=0,ordernumber=? WHERE uid = ? ";
		$stmt = $con->prepare($query);
		$stmt->bind_param('ss',$_POST['trade_no'],$out_trade_no);
		$rest = $stmt->execute();
        
        //更新系统数据
        /*$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_payment_domain_model_pay', 'uid='.$out_trade_no, array(
            'hidden' => 0,
            'ordernumber' => $_POST['trade_no']
            //'email' => $_POST['buyer_email'] //淘宝支付者邮箱
        ));*/
    }
    $con->close();
    echo "success";//请不要修改或删除
} else {
	$con->close();
    echo "fail";
}
exit;

