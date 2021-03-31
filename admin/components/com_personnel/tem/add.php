<?php
$msg = new \Plasticbrain\FlashMessages\FlashMessages();
if(!isset($_SESSION['flash'.'com_'.COMS])) $_SESSION['flash'.'com_'.COMS] = 2;
require_once('libs/cls.upload.php');
$obj_upload = new CLS_UPLOAD();
$file='';

/*Check user permission*/
$isAdmin = getInfo('isadmin');
$userLogin = getInfo('username');
$res_Users = SysGetList('tbl_users', ['permission'], "AND username='".$userLogin."'");
$res_user = $res_Users[0];
$arr_permission = ($res_user['permission']!==null && $res_user['permission']!='[]' && $res_user['permission']!=='') ? json_decode($res_user['permission']) : [];
if($isAdmin!=1 && !in_array(6001, $arr_permission)){
	echo "Bạn không có quyền truy cập chức năng này.";
	exit();
}
/*End check user permission*/

if(isset($_POST['cmdsave_tab1']) && $_POST['txt_name']!='') {
	$Url = isset($_POST['txt_url']) ? addslashes($_POST['txt_url']) : '';
	$fdate = isset($_POST['i-fdate']) ? $_POST['i-fdate'] : [];
	$tdate = isset($_POST['i-tdate']) ? $_POST['i-tdate'] : [];
	$icontent = isset($_POST['i-content']) ? $_POST['i-content'] : [];

	$arr_work_history=array();
	if(count($fdate)>0){
		for ($i=0; $i < count($fdate); $i++) { 
			if($fdate[$i]!=''){
				$arr_work_history[$i]['from_date'] = strtotime($fdate[$i]);
				$arr_work_history[$i]['to_date'] = isset($tdate[$i]) && $tdate[$i]!='' ? strtotime($tdate[$i]) : '';
				$arr_work_history[$i]['from_year'] = date('Y', $arr_work_history[$i]['from_date']);
				$arr_work_history[$i]['to_year'] = $arr_work_history[$i]['to_date']!='' ? date('Y', $arr_work_history[$i]['to_date']) : '';
				$arr_work_history[$i]['content'] = $icontent[$i];
			}
		}
	}

	if(isset($_FILES['txt_thumb']) && $_FILES['txt_thumb']['size'] > 0){
		$save_path 	= MEDIA_HOST."/personnel/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/personnel/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}

	$arr=array();
	$arr['name'] 			= isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$arr['name_en'] 		= isset($_POST['name_en']) ? addslashes($_POST['name_en']) : '';
	$arr['last_name'] 		= isset($_POST['last_name']) ? addslashes($_POST['last_name']) : '';
	$arr['person_code'] 	= isset($_POST['personnel_code']) ? addslashes($_POST['personnel_code']) : '';
	$arr['alias'] 			= $Url=='' ? un_unicode($arr['name']) : $Url;
	$arr['email'] 			= isset($_POST['email']) ? addslashes($_POST['email']) : '';
	$arr['phone'] 			= isset($_POST['phone']) ? addslashes($_POST['phone']) : '';
	$arr['website'] 		= isset($_POST['website']) ? addslashes($_POST['website']) : '';
	$arr['group_id'] 		= isset($_POST['group_id']) ? json_encode($_POST['group_id']) : null;
	$arr['group_id2'] 		= isset($_POST['group_id2']) ? json_encode($_POST['group_id2']) : null;
	$arr['team_id'] 		= isset($_POST['team']) ? json_encode($_POST['team']) : null;
	$arr['job'] 			= isset($_POST['job']) ? addslashes($_POST['job']) : '';
	$arr['position_old'] 	= isset($_POST['position_old']) ? addslashes($_POST['position_old']) : '';
	$arr['position'] 		= isset($_POST['position']) ? addslashes($_POST['position']) : '';
	$arr['content'] 		= isset($_POST['content']) ? addslashes($_POST['content']) : '';
	// $arr['work_history'] 	= json_encode($arr_work_history, JSON_UNESCAPED_UNICODE);
	$arr['work_room'] 		= isset($_POST['work_room']) ? addslashes($_POST['work_room']) : '';
	$arr['avatar'] 			= $file;
	$arr['date_birth'] 		= isset($_POST['date_birth']) ? strtotime($_POST['date_birth']) : '';
	$arr['place_of_birth'] 	= isset($_POST['place_of_birth']) ? addslashes($_POST['place_of_birth']) : '';
	$arr['cdate'] 			= time();
	$arr['degree'] 			= isset($_POST['degree']) ? addslashes($_POST['degree']) : '';
	$arr['mayle'] 			= isset($_POST['mayle']) ? addslashes($_POST['mayle']) : '';
	$arr['gender'] 			= isset($_POST['gioitinh']) ? addslashes($_POST['gioitinh']) : 'Nam';
	$arr['author'] 			= getInfo('username');
	$arr['isacademy'] 		= isset($_POST['isacademy']) ? (int)$_POST['isacademy'] : 1;
	$arr['iswork'] 			= isset($_POST['iswork']) ? (int)$_POST['iswork'] : 1;
	$arr['work_place'] 		= isset($_POST['work_place']) ? addslashes($_POST['work_place']) : '';

	$result = SysAdd('tbl_personnel', $arr);
	if($result){
		if(count($arr_work_history)>0){
			foreach ($arr_work_history as $key => $value) {
				$value['personnel_id'] = $result;
				SysAdd('tbl_personnel_work_history', $value);
			}
		}
		$_SESSION['flash'.'com_'.COMS] = 1;
	}else{
		$_SESSION['flash'.'com_'.COMS] = 0;
	}
}
?>
<style type="text/css">
	#work_history .item{
		padding: 10px;
		background-color: #e8e8e8;
		margin-bottom: 15px;
	}
	#work_history .form-control{
		border-radius: 0px;
	}
	#generateItemWorkHistory{
		cursor: pointer;
	}
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Thêm mới nhà khoa học</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS;?>">Danh sách nhà khoa học</a></li>
					<li class="breadcrumb-item active">Thêm mới nhà khoa học</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<?php
		if (isset($_SESSION['flash'.'com_'.COMS])) {
			if($_SESSION['flash'.'com_'.COMS] == 1){
				$msg->success('Thêm mới thành công.');
				echo $msg->display();
			}else if($_SESSION['flash'.'com_'.COMS] == 0){
				$msg->error('Có lỗi trong quá trình thêm mới.');
				echo $msg->display();
			}
			unset($_SESSION['flash'.'com_'.COMS]);
		}
		?>
		<div id='action'>
			<div class="card">
				<form name="frm_action" id="frm_action" action="" method="post" enctype="multipart/form-data">
					<div class="mess"></div>
					<div class="row">
						<div class="col-md-8 col-lg-9">
							<div class="form-group">
								<label>Tên<font color="red">*</font></label>
								<input type="text" id="txt_name" name="txt_name" class="form-control" value="" placeholder="Tên nhà khoa học" required>
							</div>

							<div class="form-group">
								<label>Url</label>
								<input type="text" id="txt_url" name="txt_url" class="form-control">
							</div>

							<div class="form-group">
								<label>Tên tiếng anh<font color="red">*</font></label>
								<input type="text" id="name_en" name="name_en" class="form-control" value="" placeholder="Tên tiếng anh" required>
							</div>

							<div class="form-group">
								<label>LastName</label>
								<input type="text" id="last_name" name="last_name" class="form-control" value="">
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Năm sinh</label>
										<input type="text" class="form-control" name="date_birth" id="date_birth" placeholder="Năm sinh">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Nơi sinh</label>
										<input type="text" class="form-control" name="place_of_birth" id="place_of_birth" placeholder="Nơi sinh">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label>Website</label>
								<input type="text" class="form-control" name="website" id="website" placeholder="Đường dẫn website">
							</div>

							<div class="form-group">
								<label>Nơi công tác</label>
								<input type="text" name="work_place" id="work_place" class="form-control">
							</div>

							<div class="form-group">
								<label>Chức vụ tại viện</label><small>(Nếu nhiều chức vụ, mỗi chức vụ cách nhau một dấu phảy<b class="cred">,</b>)</small>
								<input type="text" name="job" id="job" class="form-control">
							</div>

							<div class="form-group">
								<label>Chức vụ cũ tại viện</label><small>(Nếu nhiều chức vụ, mỗi chức vụ cách nhau một dấu phảy<b class="cred">,</b>)</small>
								<input type="text" name="position_old" id="position_old" class="form-control">
							</div>

							<div class="form-group">
								<label>Chức vụ cũ tại hội đồng khoa học</label><small>(Nếu nhiều chức vụ, mỗi chức vụ cách nhau một dấu phảy<b class="cred">,</b>)</small>
								<input type="text" name="position" id="position" class="form-control">
							</div>

							<div class="form-group">
								<label>Lịch sử làm việc</label> <span id="generateItemWorkHistory" class="cblue"><i class="fa fa-plus-square" aria-hidden="true"></i></span>
								<div id="work_history">
									<div class="item">
										<button type="button" class="close" onclick="remove_item_history(this)">
											<span aria-hidden="true">×</span>
										</button>
										<div class="row form-group">
											<div class="col-md-6 fdate">
												<input type="date" name="i-fdate[]" class="form-control" placeholder="Từ thời gian">
											</div>
											<div class="col-md-6 tdate">
												<input type="date" name="i-tdate[]" class="form-control" placeholder="Đến thời gian">
											</div>
										</div>
										<textarea name="i-content[]" rows="1" class="form-control" placeholder="Hướng nghiên cứu"></textarea>
									</div>
									<div class="item">
										<button type="button" class="close" onclick="remove_item_history(this)">
											<span aria-hidden="true">×</span>
										</button>
										<div class="row form-group">
											<div class="col-md-6 fdate">
												<input type="date" name="i-fdate[]" class="form-control" placeholder="Từ thời gian">
											</div>
											<div class="col-md-6 tdate">
												<input type="date" name="i-tdate[]" class="form-control" placeholder="Đến thời gian">
											</div>
										</div>
										<textarea name="i-content[]" rows="1" class="form-control" placeholder="Hướng nghiên cứu"></textarea>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label>Thông tin cá nhân</label>
								<textarea class="form-control" name="content" id="content" placeholder="Thông tin chi tiết về nhà khoa học"></textarea>
							</div>
						</div>

						<div class="col-md-4 col-lg-3">
							<div class='form-group'>
								<div class="widget-fileupload fileupload fileupload-new" data-provides="fileupload">
									<label>Ảnh</label><small> (Dung lượng < 10MB)</small>
									<div class="widget-avatar mb-2">
										<div class="fileupload-new thumbnail">
											<img src="<?php echo ROOTHOST;?>global/img/no-photo.jpg" id="img_image_preview">
										</div>
										<div class="fileupload-preview fileupload-exists thumbnail" style="line-height: 20px;"></div>
									</div>
									<div class="control">
										<span class="btn btn-file">
											<span class="fileupload-new">Tải lên</span>
											<span class="fileupload-exists">Thay đổi</span>
											<input type="file" id="file_image" name="txt_thumb" accept="image/jpg, image/jpeg">
										</span>
										<a href="javascript:void(0)" class="btn fileupload-exists" data-dismiss="fileupload" onclick="cancel_fileupload()">Hủy</a>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label>Mã nhà khoa học</label><font color="red">*</font>
								<div class="input-group mb-3">
									<input type="text" id="personnel_code" name="personnel_code" class="form-control" required>
									<div class="input-group-append">
										<span id="auto_personnel_code" class="input-group-text"><i class="fa fa-random" aria-hidden="true"></i></span>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label>Nhà khoa học của viện</label>
								<select id="isacademy" class="form-control" name="isacademy">
									<option value="1">Nhà khoa học của viện</option>
									<option value="0">Không phải nhà khoa học của viện</option>
								</select>
							</div>

							<div class="form-group">
								<label>Chức vụ của nhà khoa học</label>
								<div id="list_group_nv"></div>
								<div><span class="btn btn-primary" id="add_group_nv"><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm chức vụ</span></div>
							</div>

							<div class="form-group">
								<label>Nhóm nghiên cứu viên</label>
								<div id="list_research_team"></div>
								<div><span class="btn btn-primary" id="add_research_team"><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm nhóm nghiên cứu viên</span></div>
							</div>

							<div class="form-group">
								<label>Email</label>
								<input type="text" name="email" class="form-control" placeholder="Email">
							</div>

							<div class="form-group">
								<label>Phone</label>
								<input type="text" name="phone" class="form-control" placeholder="Phone">
							</div>

							<div class="form-group">
								<label>Phòng làm việc</label>
								<input type="text" class="form-control" name="work_room" id="work_room" placeholder="Phòng làm việc">
							</div>

							<div class="form-group">
								<label>Học vị</label>
								<input type="text" class="form-control" name="degree" id="degree" placeholder="Học vị">
							</div>

							<div class="form-group">
								<label>Số máy lẻ</label>
								<input type="text" class="form-control" name="mayle" id="mayle" placeholder="Số máy lẻ">
							</div>

							<div class="form-group">
								<label>Giới tính</label>
								<div>
									<label class="radio-inline"><input type="radio" name="gioitinh" value="Nam" checked> Nam</label>&nbsp&nbsp&nbsp
									<label class="radio-inline"><input type="radio" name="gioitinh" value="Nữ"> Nữ</label>
								</div>
							</div>

							<div class="form-group">
								<div>
									<label class="radio-inline"><input type="radio" name="iswork" value="1" checked> Đang làm việc</label>&nbsp&nbsp&nbsp
									<label class="radio-inline"><input type="radio" name="iswork" value="0"> Đã nghỉ</label>
								</div>
							</div>
						</div>
					</div>
					
					<div class="text-center toolbar">
						<input type="submit" name="cmdsave_tab1" id="cmdsave" class="save btn btn-success" value="Lưu thông tin" class="btn btn-primary">
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
			return checkinput();
		});

		$('#auto_personnel_code').on('click', function(){
			$.get('<?php echo ROOTHOST;?>ajaxs/random_persionnel_code.php', function(res){
				console.log(res);
				if(parseInt(res)!=0){
					$('#personnel_code').val(res);
				}else{
					$('#personnel_code').val('error!');
				}
			});
		});

		$('#generateItemWorkHistory').on('click', function(){
			generateItemWorkHistory();
		});

		$('#txt_name').on('change', function(){
			var name = $(this).val();
			var _url = "<?php echo ROOTHOST;?>ajaxs/generate_alias.php";
			if(name.length > 0){
				$.post(_url, {"name": name}, function(req){
					if(req!=='0'){
						$('#txt_url').val(req);
					}
				})
			}
		});

		tinymce.init({
			selector: '#content',
			height: 350,
			plugins: [
			'link image imagetools table lists autolink fullscreen media hr code'
			],
			image_title: true,
			automatic_uploads: true,
			toolbar: 'bold italic underline | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify |  numlist bullist | removeformat | insertfile image media link anchor codesample | outdent indent fullscreen',
			contextmenu: 'link image imagetools table spellchecker lists',
			content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
			image_caption: true,
			images_reuse_filename: true,
			images_upload_credentials: true,
			relative_urls : false,
			remove_script_host : false,
			convert_urls : true,

            // override default upload handler to simulate successful upload
            images_upload_handler: function (blobInfo, success, failure) {
            	var xhr, formData;

            	xhr = new XMLHttpRequest();
            	xhr.withCredentials = false;
            	xhr.open('POST', '<?php echo ROOTHOST;?>ajaxs/upload.php');

            	xhr.onload = function() {
            		console.log(xhr.responseText);
            		var json;

            		if (xhr.status != 200) {
            			failure('HTTP Error: ' + xhr.status);
            			return;
            		}

            		json = JSON.parse(xhr.responseText);

            		if (!json || typeof json.location != 'string') {
            			failure('Invalid JSON: ' + xhr.responseText);
            			return;
            		}

            		success(json.location);
            	};

            	formData = new FormData();
            	formData.append('file', blobInfo.blob(), blobInfo.filename());
            	formData.append('folder', 'images/');
            	xhr.send(formData);
            },
        });

		$('#add_research_team').on('click', function(){
			var _url="<?php echo ROOTHOST;?>ajaxs/team/list_team.php";
			var ids=[];
			if($('.team_item')){
				$('.team_item').each(function(){
					var id=$(this).attr('data-id');
					ids.push(id);
				});
			}

			$.post(_url, {'ids': ids}, function(req){
				$('#popup_modal .modal-dialog').addClass('modal-xl');
				$('#popup_modal .modal-title').text('Danh sách nhóm nghiên cứu viên');
				$('#popup_modal .modal-body').html(req);
				$('#popup_modal').modal('show');
			});
		});

		$('#add_group_nv').on('click', function(){
			var _url="<?php echo ROOTHOST;?>ajaxs/personnel/list_personnel_group.php";
			var ids=[];
			if($('.personnel_group_item')){
				$('.personnel_group_item').each(function(){
					var id=$(this).attr('data-id');
					ids.push(id);
				});
			}

			$.post(_url, {'ids': ids}, function(req){
				$('#popup_modal .modal-dialog').addClass('modal-xl');
				$('#popup_modal .modal-title').text('Chức vụ của nhà khoa học');
				$('#popup_modal .modal-body').html(req);
				$('#popup_modal').modal('show');
			});
		});

		$('#add_group_nv2').on('click', function(){
			var _url="<?php echo ROOTHOST;?>ajaxs/personnel/list_personnel_group2.php";
			var ids=[];
			if($('.personnel_group2_item')){
				$('.personnel_group2_item').each(function(){
					var id=$(this).attr('data-id');
					ids.push(id);
				});
			}

			$.post(_url, {'ids': ids}, function(req){
				$('#popup_modal .modal-dialog').addClass('modal-xl');
				$('#popup_modal .modal-body').html(req);
				$('#popup_modal').modal('show');
			});
		});
	});

function append_team(data){
	var ids=[];
	var lg = data.length;
	var str='';

	if($('.team_item')){
		$('.team_item').each(function(){
			var id=$(this).attr('data-id');
			ids.push(id);
		});
	}

	if(lg>0){
		for(var i=0; i< lg; i++){
			var val = data[i];
			if(!ids.includes(val.id)){
				str+='<span class="team_item" data-id="'+val.id+'">'+val.name+' <i class="fa fa-times" onclick="remove_team(this)" aria-hidden="true"></i><input type="hidden" name="team[]" value="'+val.id+'" /></span>';
			}
		}
	}
	$('#list_research_team').append(str);
	close_model();
}

function append_personnel_group(data){
	var ids=[];
	var lg = data.length;
	var str='';

	if($('.personnel_group_item')){
		$('.personnel_group_item').each(function(){
			var id=$(this).attr('data-id');
			ids.push(id);
		});
	}

	if(lg>0){
		for(var i=0; i< lg; i++){
			var val = data[i];
			if(!ids.includes(val.id)){
				str+='<span class="personnel_group_item" data-id="'+val.id+'">'+val.name+' <i class="fa fa-times" onclick="remove_team(this)" aria-hidden="true"></i><input type="hidden" name="group_id[]" value="'+val.id+'"/></span>';
			}
		}
	}
	$('#list_group_nv').append(str);
	close_model();
}

function append_personnel_group2(data){
	var ids=[];
	var lg = data.length;
	var str='';

	if($('.personnel_group2_item')){
		$('.personnel_group2_item').each(function(){
			var id=$(this).attr('data-id');
			ids.push(id);
		});
	}

	if(lg>0){
		for(var i=0; i< lg; i++){
			var val = data[i];
			if(!ids.includes(val.id)){
				str+='<span class="personnel_group2_item" data-id="'+val.id+'">'+val.name+' <i class="fa fa-times" onclick="remove_team(this)" aria-hidden="true"></i><input type="hidden" name="group_id2[]" value="'+val.id+'"/></span>';
			}
		}
	}
	$('#list_group_nv2').append(str);
	close_model();
}

function close_model(){
	$('#popup_modal').modal('hide');
	$('#popup_modal .modal-dialog').removeClass('modal-xl');
}

function remove_team(e){
	e.parentElement.remove();
}

function remove_item_history(e){
	e.parentElement.remove();
}

function generateItemWorkHistory() {
	$.get('<?php echo ROOTHOST;?>ajaxs/generate_item_history.php', function(res){
		if(res!=''){
			$('#work_history').append(res);
		}
	});
}

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) {
			var img = document.createElement("img");
			img.src = e.target.result;
				// Hidden fileupload new
				$('.fileupload').removeClass('fileupload-new');
				$('.fileupload').addClass('fileupload-exists');
				$('.fileupload-preview').html(img);
			}

			reader.readAsDataURL(input.files[0]); // convert to base64 string
		}
	}

	$("#file_image").on('change', function(){
		readURL(this);
	});

	function cancel_fileupload(){
		$('.fileupload').removeClass('fileupload-exists');
		$('.fileupload').addClass('fileupload-new');
		$('.fileupload-preview').empty();
		$("#file_image").val('');
	}

	function checkinput(){
		var flag = true;
		var title = $('#txt_name').val();
		var code = $('#personnel_code').val();

		if(title==''){
			alert('Các mục đánh dấu * không được để trống');
			flag = false;
		}
		if(code==''){
			alert('Mã nhà khoa học không được để trống');
			flag = false;
		}
		return flag;
	}
</script>