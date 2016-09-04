<?php
//这个文件由PP自动请求
error_reporting(E_ALL);
ini_set("display_errors","On");
require '../lib/ppipn.php';
require '../db_test.php';
$ppipn=new ppipn();
$db=new testipndb();
$ppipn->notify(array($db,"ok"),array($db,"fail"));

?>
