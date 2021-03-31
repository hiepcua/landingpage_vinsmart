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
		$save_path 	= MEDIA_HOST."/team/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/team/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}else{
		$file = $Images;
	}

	$arr=array();
	$arr['title'] = isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$arr['alias'] = un_unicode($arr['title']);
	$arr['start_date'] = isset($_POST['start_date']) ? strtotime($_POST['start_date']) : '';
	$arr['end_date'] = isset($_POST['end_date']) ? strtotime($_POST['end_date']) : '';
	$arr['cssclass'] = isset($_POST['cssclass']) ? addslashes($_POST['cssclass']) : '';
	$arr['personnel'] 	= isset($_POST['personnel']) ? addslashes($_POST['personnel']) : null;
	$arr['code'] 	= isset($_POST['team_code']) ? addslashes($_POST['team_code']) : '';
	$arr['image'] = $file;

	$result = SysEdit('tbl_team', $arr, "id=".$_POST['id']);
	if($result){
		die('1');
	}else{
		die('0');
	}
}
?>