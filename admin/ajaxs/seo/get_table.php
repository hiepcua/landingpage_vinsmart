<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');

$strwhere = isset($_GET['strwhere'])? trim($_GET['strwhere']): '';
$limit = isset($_GET['limit'])? trim($_GET['limit']): '';

function listTable($strwhere="", $limit){
	$res=SysGetList('tbl_seo', [], $strwhere." ORDER BY `title` ASC ".$limit);
	if(count($res)>0){
		foreach ($res as $key => $rows) {
			$ids        = $rows['id'];
			$title      = Substring(stripslashes($rows['title']),0,10);
			$link       = stripslashes($rows['link']);

			if($rows['isactive'] == 1) 
				$icon_active    = "<i class='fas fa-toggle-on cgreen'></i>";
			else $icon_active   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';

			echo "<tr>";
			echo "<td width='30' class='text-center'><label>";
			echo "<input type='checkbox' name='chk' id='chk' onclick=\"docheckonce('chk');\" value='$ids'/>";
			echo "</label></td>";
			echo "<td class='text-center' width='10'><a href='#' onclick='delete1(this)' data-id='".$rows['id']."'><i class='fa fa-trash cred' aria-hidden='true'></i></a></td>";
			echo "<td>".$title."</td>";
			echo "<td>".$link."</td>";
			echo "<td class='text-center'><a href='#' onclick='active(this)' data-id='".$rows['id']."'>".$icon_active."</a></td>";
			echo "<td class='text-center'><a href='#' onclick='edit(".$rows['id'].")'><i class='fa fa-edit' aria-hidden='true'></i></a></td>";
			echo "</tr>";
		}
	}
}
listTable($strwhere, $limit);
?>
