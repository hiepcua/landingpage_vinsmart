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
		$strsql="AND par_id=0 $strwhere ORDER BY `order` ASC, `title` ASC $limit";
	}else{
		$strsql="$strwhere ORDER BY `order` ASC, `title` ASC $limit";
	}

	$res=SysGetList('tbl_publish_group', [], $strsql);
	if(count($res)>0){
		foreach ($res as $key => $rows) {
			if($rows['isactive'] == 1) 
				$icon_active    = "<i class='fas fa-toggle-on cgreen'></i>";
			else $icon_active   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';

			$par_name = SysGetList('tbl_publish_group', array('title'), "AND id=".$rows['par_id']);
			$par_name = isset($par_name[0]['title']) ? $par_name[0]['title'] : '';
			$link = ROOTHOST_WEB.'xuat-ban/'.$rows['alias'];

			echo "<tr name='trow'>";
			
			echo "<td class='text-center' width='10'><a href='#' onclick='delete1(this)' data-id='".$rows['id']."'><i class='fa fa-trash cred' aria-hidden='true'></i></a></td>";

			echo "<td><a href='#' onclick='edit(".$rows['id'].")'>".$rows['title']."</a></td>";
			echo "<td>".$par_name."</td>";
			echo "<td>".Substring($rows['intro'], 0, 10)."</td>";

			$order = $rows['order'];
			echo "<td width='50' class='text-center'><input style='width: 50px;' type='number' min='0' name='txt_order' value=\"$order\" size=\"4\" class=\"order text-center\" onchange='order(this)' data-id='".$rows['id']."'></td>";

			echo "<td class='text-center'><a href='#' onclick='active(this)' data-id='".$rows['id']."'>".$icon_active."</a></td>";
			
			echo "<td class='text-center'><a href='".$link."' target='_blank'><i class='fa fa-eye' aria-hidden='true'></i></a></td>";

			echo "</tr>";
			if($search !== 0){
				$res_childrent = SysGetList('tbl_publish_group', [], $strwhere." AND path LIKE '".$rows['path']."_%' ORDER BY `order` ASC");
				if(count($res_childrent)>0){
					foreach ($res_childrent as $key => $value) {
						if($value['isactive'] == 1) 
							$icon_active2    = "<i class='fas fa-toggle-on cgreen'></i>";
						else $icon_active2   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';

						$par_name2 = SysGetList('tbl_publish_group', array('title'), "AND id=".$value['par_id']);
						$par_name2 = isset($par_name2[0]['title']) ? $par_name2[0]['title'] : '';

						$str_space="";
						$ar_space = explode('_', $value['path']);
						for ($i=0; $i < count($ar_space)-1; $i++) { 
							$str_space.="|-----";
						}
						$link2 = ROOTHOST_WEB.'xuat-ban/'.$value['alias'];

						echo "<tr name='trow'>";

						echo "<td class='text-center' width='10'><a href='#' onclick='delete1(this)' data-id='".$value['id']."'><i class='fa fa-trash cred' aria-hidden='true'></i></a></td>";

						echo "<td><a href='#' onclick='edit(".$value['id'].")'>".$str_space.$value['title']."</a></td>";
						echo "<td>".$par_name2."</td>";
						echo "<td>".Substring($value['intro'], 0, 10)."</td>";

						echo "<td class='text-center'><a href='".$link2."' target='_blank'><i class='fa fa-eye' aria-hidden='true'></i></a></td>";

						echo "</tr>";
					}
				}
			}
		}
	}
}
listTable($strwhere, $search, $limit);
?>
