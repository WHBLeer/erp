<?php
namespace ERP\ErpManagementOrder\Utility;
/**
 *  订单接口类
 *
 */
class OrderResource
{
	const PUBLICKEY = '0e67f628aaa315620497aa3edf0980a0';
	const SECRETKEY = '31d871a7bad5ccec03b71cfc60b4f684';
	const ORDER = 'http://148.70.223.113:8088/order/'; //订单信息接口
	var $stamp;
	var $basedata;

	function __construct() {
        $this->stamp = self::msectime();
        $this->basedata = array(
				'publicKey'	=>self::PUBLICKEY,
				'secretKey'	=>self::getSecretKey(),
				'timestamp' =>(string)self::stamp
        );
	}

	/**
	 * 获取订单列表
	 *
	 * @param [type] $params
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-08
	 */
	public static function getOrder($params)
	{
		$url = self::ORDER.'getOrdersList';
		$param = array(
			'pageNo' 	=> $datas['pageNo'],
			'pageSize'	=> $datas['pageSize'],
			'accountId'	=> $datas['accountId'],
		);
		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
		return $data;
	}

	/**
	 * 返回当前的毫秒时间戳
	 *
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-06
	 */
	public static function msectime() {
		list($msec, $sec) = explode(' ', microtime());
		return (float)sprintf('%.0f',(floatval($msec) + floatval($sec)) * 1000);
	}

	/**
	* [认证安全密钥,32位全小写字符]
	* @Author   wanghongbin
	* @Email    wanghongbin@ngoos.org
	* @DateTime 2018-11-27
	* @return   [type]                [description]
	*/
	public static function getSecretKey() {
		return strtolower(md5(self::SECRETKEY.$this->stamp));
	}

	/**
	* 远程数据请求，GET模式
	* 注意：
	* @param $url 指定URL完整路径地址
	* return 远程输出的数据
	*/
	public static function getHttpResponseGET(string $url) {
		$ch = curl_init();//初始化curl
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 500);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_URL, $url);//抓取指定网页
		$data = curl_exec($ch);//运行curl
		curl_close($ch);
		return $data;
	}

	/**
	* 远程数据请求，POST模式
	* 注意：
	* @param $url 指定URL完整路径地址
	* @param $datas 请求的数据
	* return 远程输出的数据
	*/
	public static function getHttpResponsePOST(string $url, array $datas){
		if (empty($url) || empty($datas)) return false;  
		// $jsonStr = json_encode($datas,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);      
		$jsonStr = json_encode($datas,JSON_UNESCAPED_UNICODE);      
		$jsonStrlen = strlen($jsonStr);      

		// exit;
		$curl = curl_init();//初始化
		curl_setopt($curl, CURLOPT_URL, $url);//抓取网页
		curl_setopt($curl, CURLOPT_POST, 1);//设置post
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($curl, CURLOPT_TIMEOUT,60);
		//post数据写入，全部数据使用HTTP协议中的"POST"操作来发送。要发送文件，在文件名前面加上@前缀并使用完整路径。这个参数可以通过urlencoded后的字符串类似'para1=val1&para2=val2&...'或使用一个以字段名为键值，字段数据为值的数组。如果value是一个数组，Content-Type头将会被设置成multipart/form-data。

		// curl_setopt($curl, CURLOPT_POSTFIELDS, substr($param,0,-1));
		// curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

		curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonStr);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			"Cache-Control: no-cache",
			"Content-Type: application/json",
            "Content-Length: $jsonStrlen"
		));

		$response = curl_exec($curl);
		curl_close($curl);

		if (curl_error($curl)) {
			return array(
				'code' => -1,
				'error' => "cURL Error #:" . curl_error($curl)
			);
		} else {
			return self::objectToArray(json_decode($response));
		}
	}

	/**
	* 生成永远唯一的密钥码
	* sha512(返回128位) sha384(返回96位) sha256(返回64位) md5(返回32位)
	* @param int $type 返回格式：0大小写混合  1全大写  2全小写
	* @param string $func 启用算法：                
	* @return string
	*/
	public static function create_secret($type=0, $func='sha512')
	{
		$uid = md5(uniqid(rand(),true).microtime());
		$hash = hash($func, $uid);
		$arr = str_split($hash);
		foreach($arr as $v){
			if($type==0){
				$newArr[]= empty(rand(0,1)) ? strtoupper($v) : $v;
			}
			if($type==1){
				$newArr[]= strtoupper($v);
			}
			if($type==2){
				$newArr[]= $v;
			}
		}
		return implode('', $newArr);
	}

    /**
     * 对象转换成数组
     * @param unknown $e
     * @return void|array
     */
    public static  function objectToArray($e)
	{
    	$e=(array)$e;
    	foreach($e as $k=>$v){
    		if( gettype($v)=='resource' ) return;
    		if( gettype($v)=='object' || gettype($v)=='array' )
    			$e[$k]=(array)self::objectToArray($v);
    	}
    	return $e;
    }
    
    /**
     * 获取加密后的api参数（数组形式）
     * @param unknown $post
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @return string
     */
    public static function getapiByarr($post=[], $accessKeyId, $accessKeySecret)
    {

    	// 基本请求数据
    	$apiParams["RegionId"] = 'cn-hangzhou';
    	$apiParams["AccessKeyId"] = $accessKeyId;
    	$apiParams["Format"] = 'JSON';
    	$apiParams["SignatureMethod"] = 'HMAC-SHA1';
    	$apiParams["SignatureVersion"] = '1.0';
    	$apiParams["SignatureNonce"] = uniqid();
    	date_default_timezone_set('PRC');
    	$apiParams["Timestamp"] = date('Y-m-d\TH:i:s\Z');
    	$apiParams = array_merge ( $apiParams, $post );
    	// 排序
    	ksort($apiParams);
    	$canonicalizedQueryString = '';
    	foreach($apiParams as $key => $value)
    	{
    		$canonicalizedQueryString .= '&' . self::percentEncode($key). '=' . self::percentEncode($value);
    	}
    	// 再加密
    	$requestUrl = 'POST&%2F&'.self::percentencode(substr($canonicalizedQueryString, 1));
    	// 生成token
    	$apiParams["Signature"] = base64_encode(hash_hmac('sha1', $requestUrl, $accessKeySecret.'&', true));
    	return $apiParams;
    }
    
    
    /**
     * 数据加密
     */
    public static function percentEncode($str)
    {
    	$res = urlencode($str);
    	$res = preg_replace('/\+/', '%20', $res);
    	$res = preg_replace('/\*/', '%2A', $res);
    	$res = preg_replace('/%7E/', '~', $res);
    	return $res;
    }
    
}
