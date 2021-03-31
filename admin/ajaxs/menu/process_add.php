<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');

if(isset($_POST['txt_name']) && $_POST['txt_name']!='') {
	$arr=array();
	$arr['name'] = isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$arr['code'] = un_unicode($arr['name']);
	$arr['desc'] = isset($_POST['desc']) ? addslashes($_POST['desc']) : '';

	$result = SysAdd('tbl_menus', $arr);
	if($result){
		die('1');
	}else{
		die('0');
	}
}
?>