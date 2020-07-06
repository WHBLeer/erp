<?php
namespace ERP\Api\Logistics;

class LogisticsCommon
{
    const APIKEY     = 'C03237';
	const APISECRET  = 'Df/IW+axsTU=';
	const HOSTSERVER = 'http://oms.api.yunexpress.com/api'; 
    
	function __construct() {
        // $this->apitoken =  $this->getSecretToken();
    }
    
	/**
	* [认证安全密钥,64位全小写字符]
	* @Author   wanghongbin
	* @Email    wanghongbin@ngoos.org
	* @DateTime 2018-11-27
	* @return   [type]                [description]
	*/
	public function getSecretToken() {
        return base64_encode(self::APIKEY.'&'.self::APISECRET);
	}

	/**
	* 远程数据请求，GET模式
	* 注意：
	* @param $url 指定URL完整路径地址
	* @param $datas 请求的数据
	* return 远程输出的数据
	*/
	public function getHttpResponseGET(string $url,$data=[]) {
		$token = self::getSecretToken();  
		if (!empty($data)) {
			$params = http_build_query($data);
			$url = $url.'?'.$params;
		}
			 
		$ch = curl_init();//初始化curl
		curl_setopt($ch, CURLOPT_URL, $url);//抓取指定网页
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Cache-Control: no-cache",
            "Content-Type: application/json",
            "charset: UTF-8",
            "Authorization: Basic $token"
		));
		$response = curl_exec($ch);
		$reserror = curl_error($ch);
		curl_close($ch);
		if ($reserror) {
			return array(
				'code' => -1,
				'error' => "cURL Error #: $reserror"
			);
		} else {
			return json_decode($response,true);
		}
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
		$token = $this->getSecretToken(); 
		$ch = curl_init();//初始化
		curl_setopt($ch, CURLOPT_URL, $url);//抓取网页
		curl_setopt($ch, CURLOPT_POST, 1);//设置post
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($ch, CURLOPT_TIMEOUT,60);
		//post数据写入，全部数据使用HTTP协议中的"POST"操作来发送。要发送文件，在文件名前面加上@前缀并使用完整路径。这个参数可以通过urlencoded后的字符串类似'para1=val1&para2=val2&...'或使用一个以字段名为键值，字段数据为值的数组。如果value是一个数组，Content-Type头将会被设置成multipart/form-data。

		// curl_setopt($ch, CURLOPT_POSTFIELDS, substr($param,0,-1));
		// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

		curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($datas));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Basic $token",
            "Content-Type: application/json",
			"Cache-Control: no-cache",
            "charset: UTF-8",
		));

		$response = curl_exec($ch);
		$reserror = curl_error($ch);
		curl_close($ch);

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
}

/**
 * 云途物流接口
 */
class LogisticsYunTuApi extends LogisticsCommon {
	
	/**
	 * 用户注册
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
	static public function Register($datas=[])
	{
		$url = self::HOSTSERVER.'/Common/Register';
		$param = array(
			'UserName'	=> $data['UserName'],//用户名
			'PassWord'	=> $data['PassWord'],//密码
			'Contact'	=> $data['Contact'],//	联系人
			'Mobile'	=> $data['Mobile'],//	联系人电话
			'Telephone'	=> $data['Telephone'],//	联系人电话
			'Name'		=> $data['Name'],//客户名称/公司名称
			'Email'		=> $data['Email'],//邮箱
			'Address'	=> $data['Address'],//详细地址
			'PlatForm'	=> $data['Address'],//平台 ID(通途平台—2)
		);
		$data = self::getHttpResponseGET($url,$param);
		return $data;
	}
	
    /**
     *  查询国家简码
     */
  	static public function GetCountry($datas=[])
  	{
  		$url = self::HOSTSERVER.'/Common/GetCountry';
		$data = self::getHttpResponseGET($url);
  		return $data;
  	}

	/**
	 * 查询运输方式
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
  	static public function GetShippingMethods($datas=[])
  	{
		$url = self::HOSTSERVER.'/Common/GetShippingMethods';
  		$param = array(
  			'CountryCode'	=>$datas['CountryCode']
  		);
  		$data = self::getHttpResponseGET($url,$param);
  		return $data;
  	}

	/**
	 * 查询货品类型
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
  	static public function GetGoodsType($datas=[])
  	{
		$url = self::HOSTSERVER.'/Common/GetGoodsType';
  		$data = self::getHttpResponseGET($url);
  		return $data;
  	}

  	/**
	 * 查询价格
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
  	static public function GetPriceTrial($datas=[])
  	{
		$url = self::HOSTSERVER.'/Freight/GetPriceTrial';
		$param = array(
			'CountryCode'=>$datas['CountryCode'],//国家简码必填
			'Weight'	 =>$datas['Weight'], 	//包裹重量，单位 kg,支持 3 位小数必填
			'Length'	 =>$datas['Length'], 	//包裹长度,单位 cm, 不带小数,不填写默认 1非必填
			'Width'	 	 =>$datas['Width'], 		//包裹宽度,单位 cm,不带小数，不填写默认 1非必填
			'Height'	 =>$datas['Height'], 	//包裹高度,单位 cm,不带小数，不填写默认 1非必填
			'PackageType'=>$datas['PackageType'],//包裹类型，1-包裹，2-文件，3-防水袋，默认 1必填
		);
		$data = self::getHttpResponseGET($url,$param);
		return $data;
  	}
	
	/**
     * 查询跟踪号
     */
  	static public function GetTrackingNumber($datas=[])
  	{
  		$url = self::HOSTSERVER.'/Waybill/GetTrackingNumber';
  		$param = array(
  			'CustomerOrderNumber' => (string)$datas['CustomerOrderNumber'],
		  );
		
  		$data = self::getHttpResponseGET($url,$param);
  		return $data;
	}

	/**
     * 查询发件人信息
     */
  	static public function GetSender($datas=[])
  	{
  		$url = self::HOSTSERVER.'/WayBill/GetSender';
  		$param = array(
  			'OrderNumber' => $datas['OrderNumber'], //查询号码，可输入运单号、订单号、跟踪号
  		);
		$data = self::getHttpResponseGET($url,$param);
		return $data;
	}
	  
	/**
    * 运单申请
    */
	static public function CreateOrder($datas=[])
	{
		$url = self::HOSTSERVER.'/WayBill/CreateOrder';
		$param = array(
			'CustomerOrderNumber' => $data['CustomerOrderNumber'], //必填	客户订单号,不能重复
			'ShippingMethodCode' => $data['ShippingMethodCode'], //必填	运输方式代码
			'TrackingNumber' => $data['TrackingNumber'], //非必填	包裹跟踪号，可以不填写
			'TransactionNumber' => $data['TransactionNumber'], //非必填	平台交易号（wish 邮）
			'Length' => $data['Length'], //非必填	预估包裹单边长，单位 cm，非必填，默认
			'Width' => $data['Width'], //非必填	预估包裹单边宽，单位 cm，非必填，默认1
			'Height' => $data['Height'], //非必填	预估包裹单边高，单位 cm，非必填，默认1
			'PackageCount' => $data['PackageCount'], //必填	运单包裹的件数，必须大于 0 的整数
			'Weight' => $data['Weight'], //必填	预估包裹总重量，单位 kg,最多 3 位小数
			'Receiver' => array(
				'TaxId' => $data['receiver']['TaxId'],//非必填	收件人企业税号，欧盟可以填 EORI，巴西可以填 CPF 等，非必填
				'CountryCode' => $data['receiver']['CountryCode'],//必填	收件人所在国家，填写2位简码
				'FirstName' => $data['receiver']['FirstName'],//必填	收件人姓
				'LastName' => $data['receiver']['LastName'],//非必填	收件人名字
				'Company' => $data['receiver']['Company'],//非必填	收件人公司名称
				'Street' => $data['receiver']['Street'],//必填	收件人详细地址
				'StreetAddress1' => $data['receiver']['StreetAddress1'],//非必填	收件人详细地址 1
				'StreetAddress2' => $data['receiver']['StreetAddress2'],//非必填	收件人详细地址 2
				'City' => $data['receiver']['City'],//必填	收件人所在城市
				'State' => $data['receiver']['State'],//非必填	收件人省/州
				'Zip' => $data['receiver']['Zip'],//非必填	收件人邮编
				'Phone' => $data['receiver']['Phone'],//非必填	收件人电话
				'HouseNumber' => $data['receiver']['HouseNumber'],//非必填	门牌号

			), //必填	收件人信息
			'Sender' => array(
				'CountryCode' => $data['sender']['CountryCode'], //非必填	收件人所在国家，填写2位简码
				'FirstName' => $data['sender']['FirstName'], //非必填	发件人姓
				'LastName' => $data['sender']['LastName'], //非必填	发件人名
				'Company' => $data['sender']['Company'], //非必填	发件人公司名称
				'Street' => $data['sender']['Street'], //非必填	发件人详细地址
				'City' => $data['sender']['City'], //非必填	发件人所在城市
				'State' => $data['sender']['State'], //非必填	发件人省/州
				'Zip' => $data['sender']['Zip'], //非必填	发件人邮编
				'Phone' => $data['sender']['Phone'], //非必填	发件人电话

			), //非必填	发件人信息
			'ApplicationType' => $data['ApplicationType'], //非必填	申 报 类 型  ,  用 于 打 印  CN22  ，1-Gift,2-Sameple,3-Documents,4-Others,  默认 4-Other
			'ReturnOption' => $data['ReturnOption'], //非必填	是否退回,包裹无人签收时是否退回，1-退回，0-不退回，默认 0
			'TariffPrepay' => $data['TariffPrepay'], //非必填	关税预付服务费，1-参加关税预付，0-不参加关税预付，默认 0 (渠道需开通关税预付服务)
			'InsuranceOption' => $data['InsuranceOption'], //非必填	包裹投保类型，0-不参保，1-按件，2-按比例，默认 0，表示不参加运输保险，具体参考包裹运输	
			'Coverage' => $data['Coverage'], //非必填	保险的最高额度，单位 RMB
			'SensitiveTypeID' => $data['SensitiveTypeID'], //非必填	包裹中特殊货品类型，可调用货品类型查询服务查询，可以不填写，表示普通货品
			'Parcels' => $data['Parcels'], // 数组 申报信息
			'SourceCode' => $data['SourceCode'], //非必填	订单来源代码
			'ChildOrders' => $data['ChildOrders'], //数组 箱子明细信息，FBA 订单必填
		);
		$data = self::getHttpResponsePOST($url,$param);
		return $data;
	}
	
	/**
	 * 查询运单
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
	static public function GetOrder($datas=[])
	{
		$url = self::HOSTSERVER.'/WayBill/GetOrder';
		$param = array(
			'OrderNumber'=>$datas['OrderNumber'],
		);
		$data = self::getHttpResponseGET($url,$param);
		return $data;
    }
    
	/**
	 * 修改订单预报重量
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
	static public function UpdateWeight($datas=[])
	{
		$url = self::HOSTSERVER.'/WayBill/UpdateWeight';
		$param = array(
			'OrderNumber'=>$datas['OrderNumber'],
			'Weight'=>$datas['Weight'],
		);
		$data = self::getHttpResponsePOST($url,$param);
		return $data;
    }
    
	/**
	 * 订单删除
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
	static public function DeleteOrder($datas=[])
	{
		$url = self::HOSTSERVER.'/WayBill/Delete';
		$param = array(
			'OrderType'=>$datas['OrderType'],
			'OrderNumber'=>$datas['OrderNumber'],
		);
		$data = self::getHttpResponsePOST($url,$param);
		return $data;
    }
    
	/**
	 * 订单拦截
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
	static public function InterceptOrder($datas=[])
	{
		$url = self::HOSTSERVER.'/WayBill/Intercept';
		$param = array(
			'OrderType'=>$datas['OrderType'],
			'OrderNumber'=>$datas['OrderNumber'],
			'Remark'=>$datas['Remark'],
		);
		$data = self::getHttpResponsePOST($url,$param);
		return $data;
    }
    
	/**
	 * 标签打印
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
	static public function Print($datas=[])
	{
		$url = self::HOSTSERVER.'/Label/Print';
		$param = array(
			'OrderNumbers'=>$datas['OrderNumbers'],
		);
		$data = self::getHttpResponsePOST($url,$param);
		return $data;
    }
    
	/**
	 * 查询物流运费明细
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
	static public function GetShippingFeeDetail($datas=[])
	{
		$url = self::HOSTSERVER.'/Freight/GetShippingFeeDetail';
		$param = array(
			'WayBillNumber'=>$datas['WayBillNumber'],
		);
		$data = self::getHttpResponseGET($url,$param);
		return $data;
    }
    
	/**
	 * 查询物流轨迹信息
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
	static public function GetTrackInfo($datas=[])
	{
		$url = self::HOSTSERVER.'/Tracking/GetTrackInfo';
		$param = array(
			'OrderNumber'=>$datas['OrderNumber'],
		);
		$data = self::getHttpResponseGET($url,$param);
		return $data;
	}
	
	
	/**
	 * 查询物流轨迹信息
	 *
	 * @param array $datas
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-03
	 */
	static public function GetCarrier($datas=[])
	{
		$url = self::HOSTSERVER.'/Waybill/GetCarrier';
		$param = array(
			'OrderNumbers'=>$datas['OrderNumbers'],
		);
		$data = self::getHttpResponsePOST($url,$param);
		return $data;
    }
}
