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
		$save_path = MEDIA_HOST."/events/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/events/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}

	$arr=array();
	$arr['title'] = isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$arr['group_id'] = isset($_POST['cbo_cate']) ? (int)$_POST['cbo_cate'] : '';
	$arr['alias'] = isset($_POST['alias']) ? addslashes($_POST['alias']) : un_unicode($arr['title']);
	$arr['type'] = isset($_POST['type']) ? addslashes($_POST['type']) : null;
	$arr['cdate'] = time();
	$arr['images'] = $file;

	$result = SysAdd('tbl_event', $arr);
	
	/* Add history */
	$arr['status'] = 'khởi tạo';
	SysAdd('tbl_event_history', $arr);

	if($result){
		echo $result;
		die();
	}else{
		die('0');
	}
}
?>