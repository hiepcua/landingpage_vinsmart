<?php
defined('ISHOME') or die("Can't access this page!");
define('COMS','partner');
$viewtype='list';
$objmysql = new CLS_MYSQL();
$isAdmin=getInfo('isadmin');

if(isset($_GET['viewtype'])){
	$viewtype=addslashes($_GET['viewtype']);
}

if($isAdmin){
	if(is_file(COM_PATH.'com_'.COMS.'/tem/'.$viewtype.'.php'))
		include_once('tem/'.$viewtype.'.php');	
	unset($viewtype); unset($obj);
}else{
	echo "404 not found!";
	exit();
}

?>