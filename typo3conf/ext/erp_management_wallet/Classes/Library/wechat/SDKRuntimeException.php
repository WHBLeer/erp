<?php
namespace NGOOS\Payment\Weixin;

class  SDKRuntimeException extends \Exception {
	public function errorMessage()
	{
		return $this->getMessage();
	}

}

?>