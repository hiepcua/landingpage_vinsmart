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
	$res_contents = SysGetList('tbl_publish_history', [], "AND `id`=".$id." ORDER BY cdate DESC");
	if(count($res_contents)>0){
		$row = $res_contents[0];
		echo '<div class="table-responsive">
		<table class="table table-bordered">';
		
		foreach ($row as $key => $value) {
			if($value!=='' && $value!==null){
				if($key=='title'){
					echo '<tr>';
					echo '<td>Tiêu đề/ Tên tài liệu</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='title2'){
					echo '<tr>';
					echo '<td>Tên bài giảng/ Giáo trình</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='group_code'){
					echo '<tr>';
					echo '<td>Loại xuất bản</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='alias'){
					echo '<tr>';
					echo '<td>Url</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='file_path'){
					echo '<tr>';
					echo '<td>Link file</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='intro'){
					echo '<tr>';
					echo '<td>Mô tả</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='fulltext'){
					echo '<tr>';
					echo '<td>Nội dung</td>';
					echo '<td>'.mb_convert_encoding($value,'UTF-8', 'HTML-ENTITIES').'</td>';
					echo '</tr>';
				}
				if($key=='image'){
					echo '<tr>';
					echo '<td>Ảnh</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='is_pre_publication'){
					echo '<tr>';
					echo '<td>Có tiền ấn phẩm</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='pre_publication'){
					echo '<tr>';
					echo '<td>Ds tiền ấn phẩm</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='personnel'){
					echo '<tr>';
					echo '<td>Nhà khoa học</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='author'){
					echo '<tr>';
					echo '<td>Tác giả</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='author_pre_publication'){
					echo '<tr>';
					echo '<td>Tác giả tiền ấn phẩm</td>';
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