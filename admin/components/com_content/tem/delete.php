<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$id='';
if(isset($_GET['id']))
	$id=(int)$_GET['id'];

/*Check user permission*/
$isAdmin = getInfo('isadmin');
$userLogin = getInfo('username');
$res_Users = SysGetList('tbl_users', ['permission'], "AND username='".$userLogin."'");
$res_user = $res_Users[0];
$arr_permission = ($res_user['permission']!==null && $res_user['permission']!='[]' && $res_user['permission']!=='') ? json_decode($res_user['permission']) : [];
if($isAdmin!=1 && !in_array(1003, $arr_permission)){
	echo "Bạn không có quyền truy cập chức năng này.";
	exit();
}
/*End check user permission*/
/* Add history */
$arr = new array();
$arr['id'] = $id;
$arr['status'] = 'xóa';
$arr['author'] = getInfo('username');
$arr['author_name'] = getInfo('fullname');
$arr['pseudonym'] = getInfo('pseudonym');
$arr['cdate'] = time();
SysAdd('tbl_content_history', $arr);
SysEdit('tbl_content', ['istrash'=>1], "id=". $id);
echo "<script language=\"javascript\">window.location='".ROOTHOST.COMS."'</script>";
?>