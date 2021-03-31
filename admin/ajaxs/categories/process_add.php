<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');
require_once(libs_path.'cls.upload.php');
$obj_upload = new CLS_UPLOAD();
$file='';
/*Check user permission*/
$isAdmin = getInfo('isadmin');
$userLogin = getInfo('username');
$res_Users = SysGetList('tbl_users', ['permission'], "AND username='".$userLogin."'");
$res_user = $res_Users[0];
$arr_permission = ($res_user['permission']!==null && $res_user['permission']!='[]' && $res_user['permission']!=='') ? json_decode($res_user['permission']) : [];
if($isAdmin!=1 && !in_array(2001, $arr_permission)){
	die('3');
}
/*End check user permission*/
if(isset($_POST['txt_name']) && $_POST['txt_name']!='') {
	if(isset($_FILES['txt_thumb']) && $_FILES['txt_thumb']['size'] > 0){
		$save_path = MEDIA_HOST."/categories/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/categories/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}

	$arr=array();
	$arr['title'] = isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$arr['par_id'] = isset($_POST['cbo_par']) ? (int)$_POST['cbo_par'] : 0;
	$arr['alias'] = un_unicode($arr['title']);
	$arr['intro'] = isset($_POST['txt_intro']) ? addslashes($_POST['txt_intro']) : '';
	$arr['image'] = $file;

	$result = SysAdd('tbl_categories', $arr);
	if($result){
		$rs_parent = SysGetList('tbl_categories', array("path"), " AND id=".$arr['par_id']);
		if(count($rs_parent)>0){
			$rs_parent = $rs_parent[0];
			$path = $rs_parent['path'].'_'.$result;
		}else{
			$path = $result;
		}
		SysEdit('tbl_categories', array('path' => $path), " id=".$result);
		die('1');
	}else{
		die('0');
	}
}
?>