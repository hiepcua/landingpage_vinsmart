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
	$res_contents = SysGetList('tbl_event_history', [], "AND `id`=".$id." ORDER BY cdate DESC");
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
				if($key=='group_id'){
					echo '<tr>';
					echo '<td>Danh mục HĐKH</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='alias'){
					echo '<tr>';
					echo '<td>Url</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='type'){
					echo '<tr>';
					echo '<td>Loại HĐKH</td>';
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
				if($key=='address'){
					echo '<tr>';
					echo '<td>Địa điểm</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='address2'){
					echo '<tr>';
					echo '<td>Địa điểm chi tiết</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='rapporter'){
					echo '<tr>';
					echo '<td>Báo cáo viên</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='language'){
					echo '<tr>';
					echo '<td>Ngôn ngữ</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='start_time'){
					echo '<tr>';
					echo '<td>Ngày bắt đầu</td>';
					echo '<td>'.date('d-m-Y', $value).'</td>';
					echo '</tr>';
				}
				if($key=='end_time'){
					echo '<tr>';
					echo '<td>Ngày kết thúc</td>';
					echo '<td>'.date('d-m-Y', $value).'</td>';
					echo '</tr>';
				}
				if($key=='baocaovien'){
					echo '<tr>';
					echo '<td>Báo cáo viên ngoài viện</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='baocaovien'){
					echo '<tr>';
					echo '<td>Báo cáo viên ngoài viện</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='personnel'){
					echo '<tr>';
					echo '<td>Nhà khoa học</td>';
					echo '<td>'.$value.'</td>';
					echo '</tr>';
				}
				if($key=='research_team'){
					echo '<tr>';
					echo '<td>Nhóm nghiên cứu viên</td>';
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