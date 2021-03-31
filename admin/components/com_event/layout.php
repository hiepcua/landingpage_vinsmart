<?php
defined('ISHOME') or die("Can't access this page!");
define('COMS','event');
$viewtype='list';
$objmysql = new CLS_MYSQL();
$isAdmin=getInfo('isadmin');
if(isset($_GET['viewtype'])){
	$viewtype=addslashes($_GET['viewtype']);
}

function getListComboboxCategories($parid=0, $level=0){
	$sql="SELECT * FROM tbl_event_group WHERE `par_id`='$parid' AND `isactive`='1' ";
	$objdata=new CLS_MYSQL();
	$objdata->Query($sql);
	$char="";
	if($level!=0){
		for($i=0;$i<$level;$i++)
			$char.="|-----";
	}
	if($objdata->Num_rows()<=0) return;
	while($rows=$objdata->Fetch_Assoc()){
		$id=$rows['id'];
		$parid=$rows['par_id'];
		$title=$rows['title'];
		echo "<option value='$id'>$char $title</option>";
		$nextlevel=$level+1;
		getListComboboxCategories($id,$nextlevel);
	}
}

if($isAdmin==1 || count(array_intersect($arr_permission, array_keys(PERMISSION_EVENT))) > 0){
	if(is_file(COM_PATH.'com_'.COMS.'/tem/'.$viewtype.'.php'))
		include_once('tem/'.$viewtype.'.php');	
	unset($viewtype); unset($obj);
}else{
	echo "<h3 class='text-center'>Bạn không có quyền thực hiện chức năng này</h3>";
}
?>