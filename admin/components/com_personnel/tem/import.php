<?php
require_once('libs/cls.upload_csv.php');
require_once('libs/PHPExcel/Classes/PHPExcel.php');
require_once('libs/PHPExcel/Classes/PHPExcel/IOFactory.php');
$obj_upload = new CLS_UPLOAD();
/*Check user permission*/
$isAdmin = getInfo('isadmin');
$userLogin = getInfo('username');
$res_Users = SysGetList('tbl_users', ['permission'], "AND username='".$userLogin."'");
$res_user = $res_Users[0];
$arr_permission = ($res_user['permission']!==null && $res_user['permission']!='[]' && $res_user['permission']!=='') ? json_decode($res_user['permission']) : [];
if($isAdmin!=1 && !in_array(6006, $arr_permission)){
	echo "Bạn không có quyền truy cập chức năng này.";
	exit();
}
function random_personnel_code() {
	$alphabet = "0123456789abcdefghijklmnopqrstuwxyz";
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < 5; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}
/*End check user permission*/
if (isset($_FILES['upload'])) {
	if(isset($_FILES['upload']) && $_FILES['upload']['size'] > 0){
		$save_path 	= "../files/";
		$obj_upload->setPath($save_path);
		$path = DOCUMENT_FILE.$obj_upload->UploadFile("upload", $save_path);
	}

	// $path=DOCUMENT_FILE.'sample_personnel.xlsx';

	$objPHPExcel = PHPExcel_IOFactory::load($path);
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		$worksheetTitle     = $worksheet->getTitle();
	    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
	    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
	    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
	    
	    for ($row = 2; $row <= $highestRow; ++ $row) {
	    	$value=array();
	    	for ($col = 0; $col < $highestColumnIndex; ++ $col) {
	    		$cell = $worksheet->getCellByColumnAndRow($col, $row);
	    		$value[] = $cell->getValue();
	    	}

	    	$arr=array();
	    	$arr['name'] 			= isset($value[0]) ? trim($value[0]) : '';
	    	$arr['name_en'] 		= isset($value[1]) ? trim($value[1]) : '';
	    	$arr['degree'] 			= isset($value[2]) ? trim($value[2]) : '';
	    	$arr['isacademy'] 		= isset($value[3]) ? (int)$value[3] : 0;
	    	$arr['alias'] 			= isset($value[4]) ? trim($value[4]) : un_unicode($arr['name']);
	    	$arr['avatar'] 			= isset($value[5]) ? addslashes($value[5]) : '';
	    	$arr['date_birth'] 		= isset($value[6]) ? strtotime($value[6]) : '';
	    	$arr['place_of_birth'] 	= isset($value[7]) ? addslashes($value[7]) : '';
	    	$arr['gender'] 			= isset($value[8]) ? addslashes(trim($value[8])) : 'Nam';
	    	$arr['job'] 			= isset($value[9]) ? addslashes($value[9]) : '';
	    	$arr['position_old'] 	= isset($value[10]) ? addslashes($value[10]) : '';
	    	$arr['position'] 		= isset($value[11]) ? addslashes($value[11]) : '';
	    	$arr['work_place'] 		= isset($value[12]) ? addslashes($value[12]) : '';
	    	$arr['work_room'] 		= isset($value[13]) ? addslashes(trim($value[13])) : '';
	    	$arr['phone'] 			= isset($value[14]) ? trim($value[14]) : '';
	    	$arr['mayle'] 			= isset($value[15]) ? addslashes(trim($value[15])) : '';
	    	$arr['email'] 			= isset($value[16]) ? trim($value[16]) : '';
	    	$arr['website'] 		= isset($value[17]) ? addslashes(trim($value[17])) : '';
	    	$arr['content'] 		= isset($value[18]) ? addslashes($value[18]) : '';
	    	$arr['order'] 			= isset($value[19]) ? (int)$value[19] : '';
	    	$arr['last_name'] 		= isset($value[20]) ? trim($value[20]) : '';
	    	$arr['person_code'] 	= random_personnel_code();

	    	$arr_work_history=array();
	    	if(isset($value[21]) && $value[21]!=''){
	    		$arr_fdate=[];
	    		$arr_tdate=[];
	    		$arr_content=[];

	    		$history1 = explode("|", $value[21]);
	    		if(count($history1)>0){
	    			foreach ($history1 as $k_history => $v_history) {
	    				$ar_item = explode(',', $v_history);
	    				$arr_fdate[] = isset($ar_item[0]) ? trim($ar_item[0]) : '';
	    				$arr_tdate[] = isset($ar_item[1]) ? trim($ar_item[1]) : '';
	    				$arr_content[] = isset($ar_item[2]) ? trim($ar_item[2]) : '';
	    			}
	    		}

	    		if(count($arr_fdate)>0){
	    			for ($i=0; $i < count($arr_fdate); $i++) { 
	    				if($arr_fdate[$i]!=''){
	    					$arr_work_history[$i]['fdate'] = $arr_fdate[$i];
	    					$arr_work_history[$i]['tdate'] = $arr_tdate[$i];
	    					$arr_work_history[$i]['content'] = $arr_content[$i];
	    				}
	    			}
	    		}
	    	}
	    	$arr['work_history'] 	= json_encode($arr_work_history, JSON_UNESCAPED_UNICODE);
	    	$result = SysAdd('tbl_personnel', $arr);
	    	if($result){
	    		$_SESSION['flash'.'com_'.COMS] = 1;
	    	}else{
		    	$_SESSION['flash'.'com_'.COMS] = 0;
		    }
	    }

	    // $group_code = isset($value[4]) ? trim($value[4]) : '';
	    // $group_code2 = isset($value[23]) ? trim($value[23]) : '';
	    // $team_code = isset($value[5]) ? trim($value[5]) : '';
	    // if($group_code!=''){
	    // 	$ar_group_code = explode(',', $group_code);
	    // 	$str_group_code = implode("','", $ar_group_code);
	    // 	$res_groups = SysGetList('tbl_personnel_group', [], "AND code IN('".$str_group_code."')");

	    // 	if($team_code!=''){
	    // 		$ar_team_code = explode(',', $team_code);
	    // 		$str_team_code = implode("','", $ar_team_code);
	    // 		$res_teams = SysGetList('tbl_team', [], "AND code IN('".$str_team_code."')");
	    // 	}

	    // 	if($group_code2!=''){
	    // 		$ar_group_code2 = explode(',', $group_code2);
	    // 		$str_group_code2 = implode("','", $ar_group_code2);
	    // 		$res_groups2 = SysGetList('tbl_personnel_group2', [], "AND code IN('".$str_group_code2."')");
	    // 	}


	    // 	if(count($res_groups) >0){
	    // 		$str_group = '';
	    // 		foreach ($res_groups as $key => $val) {
	    // 			$str_group.=$val['id'].',';
	    // 		}
	    // 		$str_group = substr($str_group, 0, strlen($str_group)-1);

	    // 		$str_team = array();
	    // 		if(count($res_teams) >0){
	    // 			foreach ($res_teams as $key => $val) {
	    // 				$str_team[] = $val['id'];
	    // 			}
	    // 		}

	    // 		$str_group2 = array();
	    // 		if(count($res_groups2) >0){
	    // 			$str_group2 = '';
	    // 			foreach ($res_groups2 as $key => $val) {
	    // 				$str_group2[] = $val['id'];
	    // 			}
	    // 		}

	    // 		$arr=array();
	    // 		$arr['name'] 			= isset($value[0]) ? trim($value[0]) : '';
	    // 		$arr['name_en'] 		= isset($value[1]) ? trim($value[1]) : '';
	    // 		$arr['last_name'] 		= isset($value[2]) ? trim($value[2]) : '';
	    // 		$arr['alias'] 			= isset($value[3]) ? trim($value[3]) : un_unicode($arr['name']);
	    // 		$arr['group_id'] 		= $str_group;
	    // 		$arr['team_id'] 		= json_encode($str_team);
	    // 		$arr['person_code'] 	= isset($value[6]) ? trim($value[6]) : '';
	    // 		$arr['email'] 			= isset($value[7]) ? trim($value[7]) : '';
	    // 		$arr['phone'] 			= isset($value[8]) ? trim($value[8]) : '';
	    // 		$arr['website'] 		= isset($value[9]) ? addslashes(trim($value[9])) : '';
	    // 		$arr['job'] 		= isset($value[10]) ? addslashes($value[10]) : '';
	    // 		$arr['position_old'] 		= isset($value[11]) ? addslashes($value[11]) : '';
	    // 		$arr['position'] 		= isset($value[12]) ? addslashes($value[12]) : '';
	    // 		$arr['work_place'] 		= isset($value[13]) ? addslashes($value[13]) : '';
	    // 		$arr['content'] 		= isset($value[14]) ? addslashes($value[14]) : '';


	    // 		$arr_work_history=array();
	    // 		if(isset($value[15]) && $value[15]!=''){
	    // 			$arr_fdate=[];
	    // 			$arr_tdate=[];
	    // 			$arr_content=[];

	    // 			$history1 = explode("|", $value[15]);
	    // 			if(count($history1)>0){
	    // 				foreach ($history1 as $k_history => $v_history) {
	    // 					$ar_item = explode(',', $v_history);
	    // 					$arr_fdate[] = isset($ar_item[0]) ? trim($ar_item[0]) : '';
	    // 					$arr_tdate[] = isset($ar_item[1]) ? trim($ar_item[1]) : '';
	    // 					$arr_content[] = isset($ar_item[2]) ? trim($ar_item[2]) : '';
	    // 				}
	    // 			}

	    // 			if(count($arr_fdate)>0){
	    // 				for ($i=0; $i < count($arr_fdate); $i++) { 
	    // 					if($arr_fdate[$i]!=''){
	    // 						$arr_work_history[$i]['fdate'] = $arr_fdate[$i];
	    // 						$arr_work_history[$i]['tdate'] = $arr_tdate[$i];
	    // 						$arr_work_history[$i]['content'] = $arr_content[$i];
	    // 					}
	    // 				}
	    // 			}
	    // 		}
	    // 		$arr['work_history'] 	= json_encode($arr_work_history, JSON_UNESCAPED_UNICODE);
	    // 		$arr['year_of_birth'] 	= isset($value[18]) ? addslashes($value[18]) : '';
	    // 		$arr['isacademy'] 		= isset($value[21]) ? (int)$value[21] : 0;
	    // 		$arr['cdate'] 			= time();

	    // 		$arr['group_id2'] 		= $res_groups2;

	    // 		$result = SysAdd('tbl_personnel', $arr);
	    // 		$_SESSION['flash'.'com_'.COMS] = 1;
	    // 	}else{
	    // 		$_SESSION['flash'.'com_'.COMS] = 0;
	    // 	}
	    // }else{
	    // 	$_SESSION['flash'.'com_'.COMS] = 0;
	    // }
	}
}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Thêm sản phẩm bằng file excel</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS;?>">Danh sách nhà khoa học</a></li>
					<li class="breadcrumb-item active">Thêm sản phẩm bằng file excel</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<style type="text/css">
	#cmdsave_tab1{
		border-radius: 0px;
	}
	.custom-file-label::after{
		color: #fff;
		background-color: #428bca;
		border-radius: 0;
		border-color: #428bca;
		outline: 0;
		box-shadow: none;
	}
	.well-intro{
		border: 1px solid #ddd;
		background-color: #f6f6f6;
		box-shadow: none;
		border-radius: 0px;
		padding: 19px;
		margin-bottom: 20px;
	}
	.btn-download{
		margin-left: 10px;
		margin-bottom: 10px;
	}
</style>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<?php
		if (isset($_SESSION['flash'.'com_'.COMS])) {
			if($_SESSION['flash'.'com_'.COMS] == 1){
				echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Import dữ liệu thành công.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>';
			}else if($_SESSION['flash'.'com_'.COMS] == 0){
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<strong>Error!</strong> Import dữ liệu lỗi.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>';
			}
			unset($_SESSION['flash'.'com_'.COMS]);
		}
		// Mã nhóm nghiên cứu viên(*), Lịch sử làm việc(*), Mã nhóm nhà khoa học(*))</strong> và bạn phải tuân thủ theo quy tắc này. Vui lòng đảm bảo rằng tệp csv được mã hóa UTF-8 và không được lưu bằng dấu thứ tự byte (BOM)</p><br>
		?>
		<div id='action'>
			<div class="card">
				<div class="well-intro">
					<a href="#" id="btn-download" class="pull-right btn btn-primary border0 btn-download"><i class="fa fa-download" aria-hidden="true"></i> Tải file mẫu</a>
					<p>Dòng đầu tiên trong tệp csv đã tải xuống sẽ được giữ nguyên. Vui lòng không thay đổi thứ tự của các cột.
						Thứ tự cột chính xác là <strong>(Tên đầy đủ, Tên tiếng anh, Trình độ, Là nhà khoa học của viện, Url, Đường dẫn ảnh avatar, Ngày sinh, Nơi sinh, Giới tính, Chức vụ tại viện, Chức vụ cũ tại viện, Chức vụ tại hội đồng khoa học, Nơi đang công tác, Phòng làm việc, Điện thoại, Máy lẻ, Email, Website, Thông tin cá nhân, Thứ tự, LastName 
						<!-- <div class="note">
							<ul>
								<li><strong>Mã chức vụ</strong>: Cần chính xác theo như thiết lập ở cấu hình nhóm nhà khoa học và không được bỏ trống, có thể một hoặc nhiều mã, mỗi mã cách nhau 1 dấu phảy</li>
								<li><strong>Mã nhóm nghiên cứu viên</strong>: Cần chính xác theo như thiết lập ở cấu hình nhóm nghiên cứu viên, có thể một hoặc nhiều mã, mỗi mã cách nhau 1 dấu phảy</li>
								<li><strong>Là nhà khoa học của viện</strong>: Điền 1 nếu là nhà khoa học của viện, 0 nếu không phải nhà khoa học của viện</li>
								<li><strong>Lịch sử làm việc</strong>: Tuân thủ quy tắc <strong>Thời gian bắt đầu 1, Thời gian kết thúc 1, Chi tiết 1| Thời gian bắt đầu 2, Thời gian kết thúc 2, Chi tiết 2| ... </strong></li>
							</ul>
						</div> -->
					</div>
					<form name="frm_action" id="frm_action" action="" method="post" enctype="multipart/form-data">
						<label>Upload file *</label>
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="upload" id="ip-uploadexcel" required>
								<label class="custom-file-label" for="ip-uploadexcel">Choose file</label>
							</div>
						</div>

						<div class="text-center toolbar">
							<input type="submit" name="cmdsave_tab1" id="cmdsave_tab1" class="save btn btn-primary" value="Thực hiện" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- /.row -->
	<!-- /.content-header -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('#frm_action').submit(function(){
				return validForm();
			});

			$('#btn-download').on('click', function(){
				var popout = window.open("<?php echo ROOTHOST;?>ajaxs/download_filecsv.php");
				window.setTimeout(function(){
					popout.close();
				}, 1000);
			});
		});

		function validForm(){
			var flag = true;
			var file = document.getElementById("ip-uploadexcel").files.length;

			if(file===0){
				alert('Các mục đánh dấu * không được để trống');
				flag = false;
			}
			return flag;
		}
	</script>