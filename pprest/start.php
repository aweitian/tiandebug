<?php
/**
 * @Author: awei.tian
 * @Date: 2016年9月10日
 * @Desc: 
 * 依赖:
 */
error_reporting(E_ALL);
ini_set("display_errors","On");

define('SITE_URL', 'http://debug.tiananwei.com/pprest'); //网站url自行定义
spl_autoload_register(function ($class) {
	$path = str_replace('\\','/',$class);
	require_once '' . $path . '.php';
});
//创建支付对象实例
$paypal = new \PayPal\Rest\ApiContext(
		new \PayPal\Auth\OAuthTokenCredential(
				'ASKxWmfE1VmGLHHokY0AK3ps_9bDi8hLE_MgdcIPh6VpqoLBz11NRbeq1Rks6zcCBkVf51An78e-7mVQ',
				'EGdY7ogf3dwgbviX3JlCeLAMQPChQ_3IfkV9k0XfiQ87VHMlByfrM_mW6FDeLhRAS_zKr4N8iamjyukT'
		)
);
