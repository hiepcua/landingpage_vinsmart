<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');
$id = isset($_POST['id']) ? trim($_POST['id']) : '';
if($id!==''){
	$res_contents = SysGetList('tbl_content_history', [], "AND `id`=".$id);
	if(count($res_contents)>0){
		$row = $res_contents[0];
		echo '<div class="table-responsive">
		<table class="table table-bordered">';
		
		foreach ($row as $key => $value) {
			if($value!=='' && $value!==null){
				if($key=='title'){
					echo '<tr>';
					echo '<td>Tiêu đề</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='cat_id'){
					echo '<tr>';
					echo '<td>Chuyên mục</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='alias'){
					echo '<tr>';
					echo '<td>Url</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='sapo'){
					echo '<tr>';
					echo '<td>sapo</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='fulltext'){
					echo '<tr>';
					echo '<td>Nội dung</td>';
					echo '<td>'.mb_convert_encoding($value,'UTF-8', 'HTML-ENTITIES').'</td>';
					echo '</tr>';
				}
				if($key=='images'){
					echo '<tr>';
					echo '<td>Ảnh</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='related_articles'){
					echo '<tr>';
					echo '<td>Tin liên quan</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='tag_ids'){
					echo '<tr>';
					echo '<td>Tag id</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
			}
		}
		echo '</table>
		</div>';
	}else{
		echo "No data!";
	}
}
?>