<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');
$key = isset($_POST['key']) ? trim($_POST['key']) : '';
$ids = isset($_POST['ids']) ? $_POST['ids'] : [];
$strGroup = '';
$group_code = isset($_POST['group_code']) ? $_POST['group_code'] : '';
if($group_code!==''){
	$strGroup = " AND `group_code`='".$group_code."'";
}

$res_pre_publications = SysGetList('tbl_publish', [], "AND `title` LIKE '%".$key."%' ".$strGroup." ORDER BY `order` ASC, `title` ASC");
if(count($res_pre_publications)>0){
	foreach ($res_pre_publications as $key => $value) {
		if(!in_array($value['id'], $ids)){
			echo '<tr>';
			echo '<td><div class="form-check">
			<input class="form-check-input ip_chk_publish" data-id="'.$value['id'].'" data-name="'.$value['title'].'" name="ip_chk_publish" type="checkbox">
			</div></td>';
			echo '<td>'.$value['title'].'</td>';
			echo '<td class="text-center">'.date('d-m-Y', $value['pdate']).'</td>';
			echo '<td class="text-center">'.$value['author'].'</td>';
			echo '</tr>';
		}
	}
}
?>