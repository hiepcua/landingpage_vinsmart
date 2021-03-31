<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$id='';
	if(isset($_GET['id']))
		$id=(int)$_GET['id'];

	$res_cons = SysGetList('tbl_registration', [], "AND id=". $id);
	SysDel('tbl_registration', "id=". $id);
	
	echo "<script language=\"javascript\">window.location='".ROOTHOST.COMS."'</script>";
?>