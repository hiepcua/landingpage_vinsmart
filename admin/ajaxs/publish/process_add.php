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
		$save_path = MEDIA_HOST."/publish/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/publish/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}

	$arr=array();
	$arr['title'] = isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$arr['alias'] = isset($_POST['txt_url']) ? addslashes($_POST['txt_url']) : un_unicode($arr['title']);
	$arr['group_code'] = isset($_POST['group_code']) ? addslashes($_POST['group_code']) : null;
	$arr['cdate'] = time();
	$arr['image'] = $file;

	$result = SysAdd('tbl_publish', $arr);

	/* Add history */
	$arr['status'] = 'khởi tạo';
	SysAdd('tbl_publish_history', $arr);

	if($result){
		echo (int)$result;
	}else{
		die('0');
	}
}
?>