<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');
if(isLogin()){
	$id = (int)antiData($_POST['id']);
	
	if($id !== 0){
		$objmysql = new CLS_MYSQL();
		$sql="UPDATE `tbl_team` SET `isactive` = if(`isactive`=1,0,1) WHERE `id` in ('$id')";
		$objmysql->Exec($sql);
		die('1');
	}else{
		die('0');
	}
}else{
	die("<h4>Please <a href='".ROOTHOST."'>login</a> to continue!</h4>");
}
?>