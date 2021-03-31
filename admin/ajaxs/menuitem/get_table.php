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
$search = isset($_GET['search'])? trim($_GET['search']): 0;

function listTable($strwhere="", $search=0, $limit){
	if($search == 0){
		$strsql="AND par_id=0 $strwhere ORDER BY `order` ASC $limit";
	}else{
		$strsql="$strwhere ORDER BY `order` ASC $limit";
	}

	$res=SysGetList('tbl_mnuitems', [], $strsql);
	if(count($res)>0){
		foreach ($res as $key => $rows) {
			$ids=$rows['id'];
			$mnuid=$rows['menu_id'];
			$title=Substring(stripslashes($rows['name']),0,10);
			$order = $rows['order'];

			if($rows['isactive'] == 1) 
				$icon_active    = "<i class='fas fa-toggle-on cgreen'></i>";
			else $icon_active   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';

			$order = $rows['order'];
			echo "<tr name='trow'>";

			echo "<td class='text-center' width='10'><a href='#' onclick='delete1(this)' data-mnuid='".$mnuid."' data-id='".$rows['id']."'><i class='fa fa-trash cred' aria-hidden='true'></i></a></td>";

			echo "<td><a href='#' onclick='edit(".$rows['id'].",".$mnuid.")'>".$title."</a></td>";
			echo "<td></td>";

			echo "<td width='50' class='text-center'><input style='width: 50px;' type='number' min='0' name='txt_order' value='".$order."' size='4' class='order text-center' onchange='order(this)' data-id='".$rows['id']."'></td>";
			echo "<td class='text-center'><a href='#' onclick='active(this)' data-mnuid='".$mnuid."' data-id='".$rows['id']."'>".$icon_active."</a></td>";

			echo "</tr>";

			$res_childrent = SysGetList('tbl_mnuitems', [], $strwhere." AND path LIKE '".$rows['path']."_%' ORDER BY `order` ASC");
			if(count($res_childrent)>0){
				foreach ($res_childrent as $key => $value) {
					if($value['isactive'] == 1) 
						$icon_active2    = "<i class='fas fa-toggle-on cgreen'></i>";
					else $icon_active2   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';

					$par_name = SysGetList('tbl_mnuitems', array('name'), "AND id=".$value['par_id']);
					$par_name = isset($par_name[0]['name']) ? $par_name[0]['name'] : '';

					$str_space="";
					$ar_space = explode('_', $value['path']);
					for ($i=0; $i < count($ar_space)-1; $i++) { 
						$str_space.="|-----";
					}

					echo "<tr name='trow'>";

					echo "<td class='text-center' width='10'><a href='#' onclick='delete1(this)' data-mnuid='".$value['menu_id']."' data-id='".$value['id']."'><i class='fa fa-trash cred' aria-hidden='true'></i></a></td>";

					echo "<td><a href='#' onclick='edit(".$value['id'].",".$value['menu_id'].")'>".$str_space.$value['name']."</a></td>";
					echo "<td>".$par_name."</td>";

					echo "<td width='50' class='text-center'><input style='width: 50px;' type='number' min='0' name='txt_order' value='".$value['order']."' size='4' class='order text-center' onchange='order(this)' data-id='".$value['id']."'></td>";
					echo "<td class='text-center'><a href='#' onclick='active(this)' data-mnuid='".$value['menu_id']."' data-id='".$value['id']."'>".$icon_active2."</a></td>";

					echo "</tr>";
				}
			}
		}
	}
}
listTable($strwhere, $search, $limit);
?>
