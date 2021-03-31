<?php
defined('ISHOME') or die("Can't access this page!");
define('COMS','publish');
$viewtype='list';
$objmysql = new CLS_MYSQL();
$isAdmin=getInfo('isadmin');

if(isset($_GET['viewtype'])){
	$viewtype=addslashes($_GET['viewtype']);
}

function getListComboboxCategories($parid=0, $level=0, $childs=array()){
	$sql="SELECT * FROM tbl_publish_group WHERE `par_id`='$parid' AND `isactive`='1'";
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
		$code=$rows['code'];
		$title=$rows['title'];
		if(in_array($id, $childs)){
			echo "<option value='$code' disabled='true' class='disabled'>$char $title</option>";
		}else{
			echo "<option value='$code'>$char $title</option>";
		}
		$nextlevel=$level+1;
		getListComboboxCategories($id,$nextlevel, $childs);
	}
}

if($isAdmin==1 || count(array_intersect($arr_permission, array_keys(PERMISSION_PUBLISH))) > 0){
	if(is_file(COM_PATH.'com_'.COMS.'/tem/'.$viewtype.'.php'))
		include_once('tem/'.$viewtype.'.php');	
	unset($viewtype); unset($obj);
}else{
	echo "<h3 class='text-center'>Bạn không có quyền thực hiện chức năng này</h3>";
	exit();
}

?>