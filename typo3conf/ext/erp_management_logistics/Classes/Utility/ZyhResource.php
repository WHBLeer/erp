<?php
namespace TaoJiang\MfwcZyh\Utility;

/**
 *  志愿汇调用接口类
 *
 */
class ZyhResource
{
	/**
	 * 获取服务器数据数据
	 */
	public static function  getData($apiFun, $apiParam)
	{
		//$apiUrl =  "访问地址";
		//$accessKeyId = '接口协议id';
		//$accessKeySecret = '接口协议秘钥';

		//测试地址
		//$apiUrl="http://47.99.112.147:8080/VMSAPI/api/syn/";
		//$accessKeyId='c8c2d572f7594056ba7eca61b0313f39';
		//$accessKeySecret='503387097bda47b5aa6b9305b5d4cceb';

		$apiUrl="http://third.api.zyh365.com/api/syn/";
		$accessKeyId='34e092bcd6a5411894f6a46ccac534d3';
		$accessKeySecret='d78d5d48e09348d0938cd0be12b27b94';
		
		$client_url = $apiUrl.$apiFun.'.do';
		$data = self::getapiByarr($apiParam,$accessKeyId, $accessKeySecret);
		$html = self::curl( $client_url, 'POST',  $data );
	
		$client_content = $html->getBody();
		$result = self::objectToArray(json_decode($client_content));
		return $result;
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
    
    // 请求时间相关参数
    public static $connectTimeout = 30000;//30 second
    public static $readTimeout = 80000;//80 second
    /**
     * 发送请求
     */
    public static function curl($url, $httpMethod = "GET", $postFields = null,$headers = null)
    {
    	defined('ENABLE_HTTP_PROXY') or define('ENABLE_HTTP_PROXY', false);
    	defined('HTTP_PROXY_IP') or define('HTTP_PROXY_IP', '127.0.0.1');
    	defined('HTTP_PROXY_PORT') or define('HTTP_PROXY_PORT', 8888);
    	// define('HTTP_PROXY_PORT', 0);
    
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $httpMethod);
    	if(ENABLE_HTTP_PROXY) {
    		curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
    		curl_setopt($ch, CURLOPT_PROXY, HTTP_PROXY_IP);
    		curl_setopt($ch, CURLOPT_PROXYPORT, HTTP_PROXY_PORT);
    		curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
    	}
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_FAILONERROR, false);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($postFields) ? self::getPostHttpBody($postFields) : $postFields);
    
    	if (self::$readTimeout) {
    		curl_setopt($ch, CURLOPT_TIMEOUT, self::$readTimeout);
    	}
    	if (self::$connectTimeout) {
    		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::$connectTimeout);
    	}
    	//https request
    	if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
    		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    	}
    	if (is_array($headers) && 0 < count($headers))
    	{
    		$httpHeaders =self::getHttpHearders($headers);
    		curl_setopt($ch,CURLOPT_HTTPHEADER,$httpHeaders);
    	}
    	$httpResponse = new HttpResponse();
    	$httpResponse->setBody(curl_exec($ch));
    	$httpResponse->setStatus(curl_getinfo($ch, CURLINFO_HTTP_CODE));
    	if (curl_errno($ch))
    	{
    		// throw new ClientException("Speicified endpoint or uri is not valid.", "SDK.ServerUnreachable");
    	}
    	curl_close($ch);
    	return $httpResponse;
    }
    /**
     * 插入post数据
     */
    static function getPostHttpBody($postFildes){
    	$content = "";
    	foreach ($postFildes as $apiParamKey => $apiParamValue)
    	{
    		$content .= "$apiParamKey=" . urlencode($apiParamValue) . "&";
    	}
    	return substr($content, 0, -1);
    }
    
    /**
     *请求头？
     */
    static function getHttpHearders($headers)
    {
    	$httpHeader = array();
    	foreach ($headers as $key => $value)
    	{
    		array_push($httpHeader, $key.":".$value);
    	}
    	return $httpHeader;
    }
    
}

/**
 * http类
 *
 */
class HttpResponse
{
	private $body;
	private $status;

	public function getBody()
	{
		return $this->body;
	}

	public function setBody($body)
	{
		$this->body = $body;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function setStatus($status)
	{
		$this->status  = $status;
	}

	public function isSuccess()
	{
		if(200 <= $this->status && 300 > $this->status)
		{
			return true;
		}
		return false;
	}
}

