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
	/*Check user permission*/
	$isAdmin = getInfo('isadmin');
	$userLogin = getInfo('username');
	$res_Users = SysGetList('tbl_users', ['permission'], "AND username='".$userLogin."'");
	$res_user = $res_Users[0];
	$arr_permission = ($res_user['permission']!==null && $res_user['permission']!='[]' && $res_user['permission']!=='') ? json_decode($res_user['permission']) : [];
	if($isAdmin!=1 && !in_array(4003, $arr_permission)){
		die('3');
	}
	/*End check user permission*/
	if($id !== 0){
		SysDel('tbl_event_group', "id=". $id);
		die('1');
	}else{
		die('0');
	}
}else{
	die("<h4>Please <a href='".ROOTHOST."'>login</a> to continue!</h4>");
}
?>