<?php
defined('ISHOME') or die("Can't access this page!");
define('COMS','content');
$viewtype='list';
$objmysql = new CLS_MYSQL();
include 'modules/toolbar.php';

if(isset($_GET['viewtype'])){
	$viewtype=addslashes($_GET['viewtype']);
}

function getListComboboxCategories($parid=0, $level=0){
	$sql="SELECT * FROM tbl_categories WHERE `par_id`='$parid' AND `isactive`='1' ";
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

if($isAdmin || count(array_intersect($arr_permission, array_keys(PERMISSION_CONTENT))) > 0){
	include_once('tem/'.$viewtype.'.php');	
	unset($viewtype); unset($obj);
}else{
	echo "<h3 class='text-center'>You haven't permission</h3>";
}
?>