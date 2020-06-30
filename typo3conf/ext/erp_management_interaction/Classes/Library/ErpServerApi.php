<?php
namespace ERP\Api\ErpServer;
/**
 * @Date:   2018-11-27 17:04:44
 * @Author: Wang HongBin | <whb199330@163.com>
 * @Last Modified by: mikey.zhaopeng
 * @Last Modified time: 2020-06-07 00:30:45
 */

/**
 * 所有接口的基类
 */
class ErpServerCommon {
	const PUBLICKEY = '0e67f628aaa315620497aa3edf0980a0';
	const SECRETKEY = '31d871a7bad5ccec03b71cfc60b4f684';
	const ERPUSER = 'http://148.70.223.113:8088/user/'; //用户信息接口
	const PRODUCT = 'http://148.70.223.113:8088/product/'; //产品信息接口
	const ORDER = 'http://148.70.223.113:8088/order/'; //订单信息接口
	const LOGISTICS = 'http://148.70.223.113:8088/logistics/'; //物流信息接口
	var $stamp;
	var $basedata;

	function __construct() {
        $this->stamp = $this->msectime();
        $this->basedata = array(
				'publicKey'	=>self::PUBLICKEY,
				'secretKey'	=>$this->getSecretKey(),
				'timestamp' =>(string)$this->stamp
        );
	}

	/**
	* 公共调用入口
	* @Author   wanghongbin
	* @Email    wanghongbin@ngoos.org
	* @DateTime 2018-11-27
	* @param    string                $action  [description]
	* @param    array                 $datas [description]
	* @return   [type]                       [description]
	*/
	public function commonfunc($func,$datas=[])
	{
		return $this->$func($datas);
	}

	/**
	 * 返回当前的毫秒时间戳
	 *
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-06
	 */
	public function msectime() {
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
	public function getSecretKey() {
		return strtolower(md5(self::SECRETKEY.$this->stamp));
	}

	/**
	* 远程数据请求，GET模式
	* 注意：
	* @param $url 指定URL完整路径地址
	* return 远程输出的数据
	*/
	public function getHttpResponseGET(string $url) {
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
	public function getHttpResponsePOST(string $url, array $datas){
		if (empty($url) || empty($datas)) return false;     
		$jsonStr = $this->getJson($datas);      
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
		$reserror = curl_error($curl);
		curl_close($curl);

		if ($reserror) {
			return array(
				'code' => -1,
				'error' => "cURL Error #: $reserror"
			);
		} else {
			return json_decode($response,true);
		}
	}

	/**
	 * 转json
	 *
	 * @param array $data
	 * @param integer $int 是否保留int数据
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-08
	 */
	public function getJson($data=array(),$int=0)
	{
		if ($int==1) {
			return json_encode($data,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
		} else {
			return json_encode($data,JSON_UNESCAPED_UNICODE);  
		}
	}

	/**
	* 生成永远唯一的密钥码
	* sha512(返回128位) sha384(返回96位) sha256(返回64位) md5(返回32位)
	* @param int $type 返回格式：0大小写混合  1全大写  2全小写
	* @param string $func 启用算法：                
	* @return string
	*/
	public function create_secret($type=0, $func='sha512')
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

}

/**
 * 用户相关接口
 */
class ErpUserApi extends ErpServerCommon {
    /**
     * 注册
     */
  	public function register($datas=[])
  	{
  		$url = self::ERPUSER.'register';
  		$param = array(
			'telephone' =>$datas['telephone'],
			'username'  =>$datas['username'],
			'password'  =>$datas['password'],
			'email'  	=>$datas['email'],
			'name'  	=>$datas['name'],
			'company'  	=>$datas['company'],
			'isAdmin'  	=>$datas['isAdmin']
  		);
		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
  		return $data;
  	}

	/**
	 * 修改用户联系电话和邮箱
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
  	public function editUserInfo($datas=[])
  	{
		$url = self::ERPUSER.'editUserInfo';
  		$param = array(
  			'isAdmin'	=>$datas['isAdmin'],
  			'telephone'	=>$datas['telephone'],
			'email'		=>$datas['email'],
			'password'	=>$datas['password']
  		);
  		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
  		return $data;
  	}

	/**
	 * 使用手机号码修改用户密码 需要原密码
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
  	public function modifyPasswordByTelephone($datas=[])
  	{
		$url = self::ERPUSER.'modifyPasswordByTelephone';
  		$param = array(
			'userId'		=>$datas['userId'],
  			'telephone'		=>$datas['telephone'],
			'oldMd5pass'	=>strtolower($datas['oldpassword']),
  			'password'		=>$datas['password']
  		);
  		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
  		return $data;
  	}

  	/**
	 * 使用邮箱修改用户密码 需要原密码
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
  	public function modifyPasswordByEmail($datas=[])
  	{
		$url = self::ERPUSER.'modifyPasswordByEmail';
		$param = array(
			'userId'		=>$datas['userId'],
  			'email'			=>$datas['email'],
			'oldMd5pass'	=>strtolower($datas['oldpassword']),
			'password'		=>$datas['password']
		);
		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
		return $data;
  	}
	
	/**
     * 添加系统操作人员授权
     */
  	public function addUserAuthorized($datas=[])
  	{
  		$url = self::ERPUSER.'userAuthorized';
  		$param = array(
  			'accountId'			=> (string)$datas['accountId'],
  			'sellerId'			=> (string)$datas['sellerId'],
  			'sellerToken'		=> (string)$datas['sellerToken'],
  			'developerId'		=> (string)$datas['developerId'],
  			'amazonAccountId'	=> (string)$datas['amazonAccountId'],
  			'marketplaceId'		=> (string)$datas['marketplaceId'],
  			'operator'			=> (string)$datas['operator'],
		  );
		
  		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
		if ($data['rspCode']==0) {
			$data['authCode'] = $this->create_secret();
		}
  		return $data;
	}

	/**
     * 取消系统操作人员授权
     */
  	public function delUserAuthorized($datas=[])
  	{
  		$url = self::ERPUSER.'delUserAuthorized';
  		$param = array(
  			'accountId'	=>$datas['accountId'],
  			'operator'	=>$datas['operator'],
  		);
		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
		return $data;
	}
	  
	/**
		* 添加商户授权
		*/
	public function addErpUserOauth($datas=[])
	{
		$url = self::ERPUSER.'addErpUserOauth';
		$param = array(
			'userId'=>$datas['userId'],
			'username'=>$datas['username'],
			'awsid'=>$datas['awsid'],
			'awstoken'=>$datas['awstoken'],
			'awsaccount'=>$datas['awsaccount'],
			'market'=>$datas['market']
		);
		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
		return $data;
	}
	
	/**
	 * 取消商户授权
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
	public function delErpUserOauth($datas=[])
	{
		$url = self::ERPUSER.'delErpUserOauth';
		$param = array(
			'userId'=>$datas['userId'],
			'username'=>$datas['username'],
			'authcode'=>$datas['awsid'],
			'operator'=>$datas['operator'],
		);
		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
		return $data;
	}
}

/**
 * 产品相关接口
 */
class ErpProductApi extends ErpServerCommon {
	
	/**
	 * 获取产品上架状态
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
    public function getProductShelfStatus($datas=[])
    {
		$url = self::PRODUCT.'getProductShelfStatus';
		$param = array(
			'productid' => $datas['productid']
		);
		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
		return $data;
	}

	/**
	 * 获取产品审核状态
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
    public function getProductCheckStatus($datas=[])
    {
		$url = self::PRODUCT.'getProductCheckStatus';
		$param = array(
			'productid' => $datas['productid']
		);
		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
		return $data;
	}
	
    /**
	 * 产品上传
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
    public function productOnTheShelf($datas=[])
    {
		$url = self::PRODUCT.'uploadProd';
		$param = array(
			'accountId' => $datas['accountId'],
			'product' => $datas['productinfo'] //产品的所有信息数组
		);
		// dump($this->basedata+$param);
		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
		return $data;
    }

    /**
	 * 产品下架
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
    public function productOffTheShelf($datas=[])
    {
        $url = self::PRODUCT.'productOffTheShelf';
        $param = array(
            'productId' =>$datas['productId']
        );
        $data = self::getHttpResponsePOST($url,$this->basedata+$param);
        return $data;
    }

	/**
	 * 产品跟卖
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
    public function productFollowUp($datas=[])
    {
        $url = self::PRODUCT.'productFollowUp';
        $param = array(
			'productId' =>$datas['productId'],
        );
        $data = self::getHttpResponsePOST($url,$this->basedata+$param);
        return $data;
    }

    /**
	 * 产品热卖
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
    public function productHotSeal($datas=[])
    {
        $url = self::PRODUCT.'productHotSeal';
        $param = array(
			'productId' =>$datas['productId'],
        );
        $data = self::getHttpResponsePOST($url,$this->basedata+$param);
        return $data;
    }

    /**
	 * 自营产品
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
    public function productsProprietary($datas=[])
    {
        $url = self::PRODUCT.'productsProprietary';
        $param = array(
			'productId' =>$datas['productId'],
        );
        $data = self::getHttpResponsePOST($url,$this->basedata+$param);
        return $data;
    }

	/**
	* 图片上传
	*
	* @param array $datas
	* @return void
	* @author wanghongbin
	* tstamp: 2020-06-03
	*/
	public function uploadSingleImages($datas=[])
	{
		$url = self::PRODUCT.'uploadSingleImages';
		$param = array(
			'fileId' 	=>$datas['fileId'],
			'fileName'  =>$datas['fileName']
		);
		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
		return $data;
	}

	/**
	* 多图片上传
	*
	* @param array $datas
	* @return void
	* @author wanghongbin
	* tstamp: 2020-06-03
	*/
	public function uploadMultiImages($datas=[])
	{
		$url = self::PRODUCT.'uploadMultiImages';
		$param = array(
			'files' 	=> json_encode($datas['files']),
		);
		/* [
			'fileId' 	=>1,
			'fileName'  =>'image1.jpg'
		],
		[
			'fileId' 	=>2,
			'fileName'  =>'image2.jpg'
		] */
		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
		return $data;
	}
}

/**
 * 订单相关接口
 */
class ErpOrderApi extends ErpServerCommon{
  
	/**
	* 获取全部订单
	*
	* @param array $datas
	* @return void
	* @author wanghongbin
	* tstamp: 2020-06-03
	*/
	public function getOrdersList($datas=[])
	{
		$url = self::ORDER.'getOrdersList';
		$param = array(
			'pageNo' 	=> $datas['pageNo'],
			'pageSize'	=> $datas['pageSize'],
			'accountId'	=> $datas['accountId'],
		);
		dump($url);
		dump($this->basedata+$param);
		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
		return $data;
	}

	/**
	 * 根据订单ID更新订单
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
	public function updateOrderById($datas=[])
	{
		$url = self::ORDER.'updateOrderById';
		$param = array(
			'pageNo' 	=> $datas['pageNo'],
			'pageSize'	=> $datas['pageSize'],
			'accountId'	=> '11cac887243b45f1aee986ac7e04c171',
		);
		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
		return $data;
	}
}

/**
 * 物流相关接口
 */
class ErpLogisticsApi extends ErpServerCommon{
  
	/**
	* 获取全部物流信息
	*
	* @param array $datas
	* @return void
	* @author wanghongbin
	* tstamp: 2020-06-03
	*/
	public function getAllLogistics($datas=[])
	{
		$url = self::ERPUSER.'getAllOrder';
		$param = array(
			'userId' =>$datas['userId']
		);
		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
		return $data;
	}

	/**
	 * 根据订单ID更新订单
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
	public function updateLogisticsById($datas=[])
	{
		$url = self::ERPUSER.'updateLogisticsById';
		$param = array(
			'userId' 	=>$datas['userId'],
			'logisticsId'	=>$datas['logisticsId']
		);
		$data = self::getHttpResponsePOST($url,$this->basedata+$param);
		return $data;
	}
}
?>