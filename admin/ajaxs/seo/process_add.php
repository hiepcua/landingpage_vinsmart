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
if(isset($_POST['txt_name']) && $_POST['txt_name']!='') {
	if(isset($_FILES['txt_thumb']) && $_FILES['txt_thumb']['size'] > 0){
		$save_path = MEDIA_HOST."/seo/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/seo/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}

	$arr=array();
	$arr['title'] = isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$arr['link'] = isset($_POST['link']) ? addslashes($_POST['link']) : '';
	$arr['meta_title'] = isset($_POST['meta_title']) ? addslashes($_POST['meta_title']) : '';
	$arr['meta_key'] = isset($_POST['meta_key']) ? addslashes($_POST['meta_key']) : '';
	$arr['meta_desc'] = isset($_POST['meta_desc']) ? addslashes($_POST['meta_desc']) : '';
	$arr['image'] = $file;

	$result = SysAdd('tbl_seo', $arr);
	if($result){
		die('1');
	}else{
		die('0');
	}
}
?>