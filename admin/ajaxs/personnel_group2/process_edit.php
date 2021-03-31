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

if(isset($_POST['id']) && $_POST['id']!=0) {
	$Images = isset($_POST['txt_thumb2']) ? addslashes($_POST['txt_thumb2']) : '';
	if(isset($_FILES['txt_thumb']) && $_FILES['txt_thumb']['size'] > 0){
		$save_path 	= MEDIA_HOST."/personnel_group/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/personnel_group/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}else{
		$file = $Images;
	}

	$arr=array();
	$arr['title'] = isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$arr['alias'] = un_unicode($arr['title']);
	$arr['code'] = isset($_POST['gpersonnel_code']) ? addslashes($_POST['gpersonnel_code']) : '';
	$arr['intro'] = isset($_POST['intro']) ? addslashes($_POST['intro']) : '';
	$arr['image'] = $file;
	$result = SysEdit('tbl_personnel_group2', $arr, "id=".$_POST['id']);
	if($result){
		die('1');
	}else{
		die('0');
	}
}
?>