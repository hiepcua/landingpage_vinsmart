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
	$res=SysGetList('tbl_team', [], $strwhere." ORDER BY `order` ASC, `title` ASC ".$limit);
	if(count($res)>0){
		$num=0;
		foreach ($res as $key => $rows) { $num++;
			if($rows['isactive'] == 1) 
				$icon_active    = "<i class='fas fa-toggle-on cgreen'></i>";
			else $icon_active   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';

			echo "<tr>";
			echo "<td width='10' class='text-center'><span class='action mt-3'>".$num."</span></td>";
			echo "<td class='text-center' width='10'><a href='#' onclick='delete1(this)' data-id='".$rows['id']."'><i class='fa fa-trash cred' aria-hidden='true'></i></a></td>";
			echo "<td><a href='#' onclick='edit(".$rows['id'].")'>".$rows['title']."</a></td>";
			echo "<td class='text-center'>".$rows['code']."</td>";
			echo "<td>".date('d-m-Y', $rows['start_date'])."</td>";
			echo "<td>".date('d-m-Y', $rows['end_date'])."</td>";
			echo "<td width='50' class='text-center'><input style='width: 50px;' type='number' min='0' name='txt_order' value='".$rows['order']."' size='4' class='order text-center' onchange='order(this)' data-id='".$rows['id']."'></td>";
			echo "<td class='text-center'><a href='#' onclick='active(this)' data-id='".$rows['id']."'>".$icon_active."</a></td>";
			echo "<td class='text-center'><a href='#' target='_blank'><i class='fa fa-eye' aria-hidden='true'></i></a></td>";
			echo "</tr>";
			echo "</tr>";
		}
	}
}
listTable($strwhere, $limit);
?>
