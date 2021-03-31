<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$id=''; $event_id='';
	if(isset($_GET['id']))
		$id=(int)$_GET['id'];

	/*Check user permission*/
	$isAdmin = getInfo('isadmin');
	$userLogin = getInfo('username');
	$res_Users = SysGetList('tbl_users', ['permission'], "AND username='".$userLogin."'");
	$res_user = $res_Users[0];
	$arr_permission = ($res_user['permission']!==null && $res_user['permission']!='[]' && $res_user['permission']!=='') ? json_decode($res_user['permission']) : [];
	if($isAdmin!=1 && !in_array(5003, $arr_permission)){
		echo "Bạn không có quyền truy cập chức năng này.";
		exit();
	}
	/*End check user permission*/

	if(isset($_GET['event'])){
		$event_id = (int)$_GET['event'];
	}
	SysDel('tbl_event_detail', "id=". $id);

	if(isset($_GET['event'])){
		echo "<script language=\"javascript\">window.location='".ROOTHOST.COMS.'/'.$event_id."'</script>";
	}else{
		echo "<script language=\"javascript\">window.location='".ROOTHOST.COMS."'</script>";
	}
?>