<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
require 'lib/ppipn.php';
require 'db_test.php';
$title = "test ipn title"; // 可以POST过来
$price = 12.34; // 可以POST过来
$orderno = 152;
$ppipn = new ppipn ( "awei.tian-facilitator@qq.com", "http://" . $_SERVER ["HTTP_HOST"] . "/return/success.php", "http://" . $_SERVER ["HTTP_HOST"] . "/return/error.php", "http://" . $_SERVER ["HTTP_HOST"] . "/return/ipn.php", ppipn::TEST );
$ppipn->title = $title; // 商品标题
$ppipn->price = $price; // 价格
$ppipn->ordercode = $orderno;
$db = new testipndb ();
$item_number = $db->insertNewItem ( $title, $price ); // 向数据库插入一条记录，然后返回这个记录ID，记名叫订单号
$ppipn->ordercode =  $item_number ; // 把订单号提交给PP
echo $ppipn->showForm ();
?>