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

$res_personnel_groups = SysGetList('tbl_personnel', [], "AND `name` LIKE '%".$key."%' ORDER BY `order` ASC, `name` ASC");
if(count($res_personnel_groups)>0){
	foreach ($res_personnel_groups as $key => $value) {
		if(!in_array($value['id'], $ids)){
			echo '<tr>';
			echo '<td><div class="form-check">
			<input class="form-check-input ip_chk_personnel" data-id="'.$value['id'].'" data-name="'.$value['name'].'" name="ip_chk_personnel" type="checkbox">
			</div></td>';
			echo '<td>'.$value['name'].'</td>';
			echo '<td>'.$value['position'].'</td>';
			echo '<td>'.$value['work_place'].'</td>';
			echo '</tr>';
		}
	}
}
?>