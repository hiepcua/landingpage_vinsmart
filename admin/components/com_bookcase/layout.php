<?php
defined('ISHOME') or die("Can't access this page!");
define('COMS','bookcase');
$viewtype='list';
$objmysql = new CLS_MYSQL();
$isAdmin=getInfo('isadmin');
include 'modules/toolbar.php';
if(isset($_GET['viewtype'])){
	$viewtype=addslashes($_GET['viewtype']);
}

if($isAdmin==1 || count(array_intersect($arr_permission, array_keys(PERMISSION_BOOKCASE))) > 0){
	if(is_file(COM_PATH.'com_'.COMS.'/tem/'.$viewtype.'.php'))
		include_once('tem/'.$viewtype.'.php');	
	unset($viewtype); unset($obj);
}else{
	echo "<h3 class='text-center'>Bạn không có quyền thực hiện chức năng này</h3>";
}

?>