<?php
defined('ISHOME') or die("Can't access this page!");
define('COMS','personnel_group2');
$viewtype='list';
// Init variables
$isAdmin=getInfo('isadmin');

if(isset($_GET['viewtype'])){
	$viewtype=addslashes($_GET['viewtype']);
}
if($isAdmin==1){
	if(is_file(COM_PATH.'com_'.COMS.'/tem/'.$viewtype.'.php'))
		include_once('tem/'.$viewtype.'.php');	
	unset($viewtype); unset($obj);
}else{
	echo "<h3 class='text-center'>You haven't permission</h3>";
}
?>