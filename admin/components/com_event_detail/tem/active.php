<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$id=''; $event_id='';
if(isset($_GET['id'])){
	$id=(int)$_GET['id'];
}
if(isset($_GET['event'])){
	$event_id = (int)$_GET['event'];
}

/*Check user permission*/
$isAdmin = getInfo('isadmin');
$userLogin = getInfo('username');
$res_Users = SysGetList('tbl_users', ['permission'], "AND username='".$userLogin."'");
$res_user = $res_Users[0];
$arr_permission = ($res_user['permission']!==null && $res_user['permission']!='[]' && $res_user['permission']!=='') ? json_decode($res_user['permission']) : [];
if($isAdmin!=1 && !in_array(5005, $arr_permission)){
	echo "Bạn không có quyền truy cập chức năng này.";
	exit();
}
/*End check user permission*/

$objmysql = new CLS_MYSQL();
$sql="UPDATE `tbl_event_detail` SET `isactive` = if(`isactive`=1,0,1) WHERE `id` in ('$id')";
$objmysql->Exec($sql);
if(isset($_GET['event'])){
	echo "<script language=\"javascript\">window.location='".ROOTHOST.COMS.'/'.$event_id."'</script>";
}else{
	echo "<script language=\"javascript\">window.location='".ROOTHOST.COMS."'</script>";
}
?>