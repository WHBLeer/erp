<?php
/**
 * 微信支付成功异步回调页面
 */
header("Content-type:text/html;charset=utf-8");
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
define('TYPO3_MODE', true);
/*require_once("../../../../typo3/sysext/core/Classes/Utility/MathUtility.php");
require_once("../../../../typo3/sysext/core/Classes/Utility/GeneralUtility.php");
require_once("../../../../typo3/sysext/core/Classes/Html/HtmlParser.php");
require_once("../../../../typo3/sysext/core/Classes/Database/DatabaseConnection.php");*/

date_default_timezone_set('Asia/Shanghai');

//connect db
$configArray = include_once("../../../../typo3conf/LocalConfiguration.php");
/*$GLOBALS['TYPO3_DB'] = new TYPO3\CMS\Core\Database\DatabaseConnection;
$GLOBALS['TYPO3_DB']->setDatabaseHost($configArray['DB']['host']);
$GLOBALS['TYPO3_DB']->setDatabaseUsername($configArray['DB']['username']);
$GLOBALS['TYPO3_DB']->setDatabasePassword($configArray['DB']['password']);
$GLOBALS['TYPO3_DB']->setDatabaseName($configArray['DB']['database']);
$GLOBALS['TYPO3_DB']->connectDB();*/

$con = new mysqli($configArray['DB']['Connections']['Default']['host'],$configArray['DB']['Connections']['Default']['user'],$configArray['DB']['Connections']['Default']['password'],$configArray['DB']['Connections']['Default']['dbname']);
if(!$con){
    die("connect error:".mysqli_connect_error());
}

include_once("config.php");

require_once('../lib/wechat/WxPayPubHelper.php');

//使用通用通知接口
$notify = new \NGOOS\Payment\Weixin\Notify_pub();

//存储微信的回调
$xml = file_get_contents('php://input'); //$GLOBALS['HTTP_RAW_POST_DATA'];
$notify->saveData($xml);

//debug
$log = '../log/' . date('Y-m-d') . '.log';
//error_log(date('Y-m-d H:i:s') . ': ' . $xml . chr(10) . chr(10), 3, $log);

//验证签名，并回应微信。
//对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
//微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
//尽可能提高通知的成功率，但微信不保证通知最终能成功。
if ($notify->checkSign() == FALSE) {
    $notify->setReturnParameter("return_code", "FAIL");//返回状态码
    $notify->setReturnParameter("return_msg", "签名失败");//返回信息
} else {
    $notify->setReturnParameter("return_code", "SUCCESS");//设置返回码
}
$returnXml = $notify->returnXml();
echo $returnXml; //应答给微信

//==商户根据实际情况设置相应的处理流程，此处仅作举例=======

if ($notify->checkSign() == TRUE) {
    if ($notify->data["result_code"] == 'SUCCESS') {
        //此处应该更新一下订单状态，商户自行增删操作
        //商户自行增加处理流程,
        $out_trade_no = end(explode("-", $notify->data['out_trade_no'])); //商户订单号
        //更新系统数据
        /*$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_payment_domain_model_pay', 'uid=' . $out_trade_no, array(
            'hidden' => 0,
            'ordernumber' => $notify->data['transaction_id']
        ));*/
        $query = "update tx_payment_domain_model_pay set hidden=0,ordernumber=? WHERE uid = ? ";
		$stmt = $con->prepare($query);
		$stmt->bind_param('ss',$notify->data['transaction_id'],$out_trade_no);
		$rest = $stmt->execute();
    }
}
$con->close();
exit;
