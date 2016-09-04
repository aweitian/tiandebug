<?php
/**
 * @author awei.tian
 * date: 2013-10-12
 * 说明:paypal ipn支付接口
 */
// https://www.sandbox.paypal.com/signin/?country.x=CN&locale.x=zh_CN
// pp ipn debug info
// https://www.sandbox.paypal.com/cgi-bin/webscr
// uxll_1320225880_per@qq.com
// 320225867
// uxll_1320225966_biz@qq.com
// 320225944

class ppipn{
	const TEST    = 0;
	const PRODUCT = 1;
	private $_env;
	private $_env_test_url         = "https://www.sandbox.paypal.com/cgi-bin/webscr";
	private $_env_prod_url         = "https://www.paypal.com/cgi-bin/webscr";
	private $_business;
	private $pp_post_url;
	private $_pp_entrypoint_return;	//paypal回调入口目录
	private $_pp_entrypoint_cancel; //paypal回调入口目录
	private $_pp_entrypoint_ipn;    //paypal回调入口目录
	public $title                = "test";
	public $price                = 0;
	private $_extra                = array();
	public $ordercode            =  1;
	private $_submit_btn_text      = "Check out";
	private static $_callback_ok   = null;
	private static $_callback_fail = null;
	public function __construct($business,$return_url,$cancal_rul,$notify_url,$envir=self::TEST){
		$this->_business = $business;
		$this->_pp_entrypoint_return = $return_url;
		$this->_pp_entrypoint_cancel = $cancal_rul;
		$this->_pp_entrypoint_ipn    = $notify_url;
		if($envir == self::PRODUCT){
			$this->_env = self::PRODUCT;
		}
		$this->pp_post_url = $this->_env == self::TEST ? $this->_env_test_url : $this->_env_prod_url;
	}
	public function showForm(){
		include dirname(__FILE__)."/tpl/form.tpl.php";
	}
	public function notify($ok_callback,$fail_callback){
		$data = tian::$context->getMessage()->getPostData();
		$postdata = "";
		$bak = array();
		foreach($data as $i => $v){
			$postdata .= $i . "=" . urlencode($v) . "&";
			$bak[$i] = $v;
		}
		$postdata .= "cmd=_notify-validate";
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($ch,CURLOPT_URL,$this->pp_post_url);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$postdata);
		ob_start();
		curl_exec($ch);
		$info = ob_get_contents();
		curl_close($ch);
		ob_end_clean();
		if(preg_match("/VERIFIED/",$info))	{
			return call_user_func_array($ok_callback,array($data,$info));
		}else{
			return call_user_func_array($fail_callback,array($data,$info));
		}
	}
}