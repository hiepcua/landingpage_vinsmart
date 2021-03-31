<?php
defined('ISHOME') or die("Can't access this page!");
define('COMS','module');
$user = getInfo('username');
$isAdmin = getInfo('isadmin');
$msg = new \Plasticbrain\FlashMessages\FlashMessages();
if(!isset($_SESSION['flash'.'com_'.COMS])) $_SESSION['flash'.'com_'.COMS] = 2;
$viewtype = isset($_GET['viewtype']) ? addslashes($_GET['viewtype']) : 'list';

if($isAdmin==1){
	function getListComboboxCategories($parid=0, $level=0, $childs=array()){
		$sql="SELECT * FROM tbl_categories WHERE `par_id`='$parid' AND `isactive`='1'";
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
			if(in_array($id, $childs)){
				echo "<option value='$id' disabled='true' class='disabled'>$char $title</option>";
			}else{
				echo "<option value='$id'>$char $title</option>";
			}
			$nextlevel=$level+1;
			getListComboboxCategories($id,$nextlevel, $childs, $siteid);
		}
	}

	function getListComboboxPersonnelGroup($parid=0, $level=0, $childs=array()){
		$sql="SELECT * FROM tbl_personnel_group WHERE `par_id`='$parid' AND `isactive`='1'";
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
			if(in_array($id, $childs)){
				echo "<option value='$id' disabled='true' class='disabled'>$char $title</option>";
			}else{
				echo "<option value='$id'>$char $title</option>";
			}
			$nextlevel=$level+1;
			getListComboboxPersonnelGroup($id,$nextlevel, $childs, $siteid);
		}
	}

	function getListComboboxEventGroup($parid=0, $level=0, $childs=array()){
		$sql="SELECT * FROM tbl_event_group WHERE `par_id`='$parid' AND `isactive`='1'";
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
			if(in_array($id, $childs)){
				echo "<option value='$id' disabled='true' class='disabled'>$char $title</option>";
			}else{
				echo "<option value='$id'>$char $title</option>";
			}
			$nextlevel=$level+1;
			getListComboboxEventGroup($id,$nextlevel, $childs, $siteid);
		}
	}
	
	function getListComboboxPublishGroup($parid=0, $level=0, $childs=array()){
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
			$parid=$rows['par_id'];
			$title=$rows['title'];
			if(in_array($id, $childs)){
				echo "<option value='$id' disabled='true' class='disabled'>$char $title</option>";
			}else{
				echo "<option value='$id'>$char $title</option>";
			}
			$nextlevel=$level+1;
			getListComboboxPublishGroup($id,$nextlevel, $childs, $siteid);
		}
	}
	
	if(is_file(COM_PATH.'com_'.COMS.'/tem/'.$viewtype.'.php')){
		include_once('tem/'.$viewtype.'.php');
	}
}else{
	echo "<h3 class='text-center'>You haven't permission</h3>";
}
unset($viewtype); unset($obj);
?>