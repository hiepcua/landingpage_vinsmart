<?php
defined('ISHOME') or die("Can't access this page!");
define('COMS','menu');
$COM='menu';
$viewtype='list';
$isAdmin=getInfo('isadmin');

if(isset($_GET['viewtype'])){
	$viewtype=addslashes($_GET['viewtype']);
}

if($isAdmin){
	if(is_file(COM_PATH.'com_'.$COM.'/tem/'.$viewtype.'.php'))
		include_once('tem/'.$viewtype.'.php');	
	unset($viewtype); unset($obj); unset($COM);
}else{
	echo "<h3 class='text-center'>You haven't permission</h3>";
}
?>