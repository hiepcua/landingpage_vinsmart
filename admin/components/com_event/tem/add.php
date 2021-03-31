<?php
$msg 		= new \Plasticbrain\FlashMessages\FlashMessages();
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
if(!$isAdmin || !in_array(3001, $arr_permission)){
	echo "Bạn không có quyền truy cập chức năng này.";
	exit();
}
/*End check user permission*/

if(isset($_POST['txt_name']) && $_POST['txt_name'] !== '') {
	$Url = isset($_POST['txt_url']) ? addslashes($_POST['txt_url']) : '';
	if(isset($_FILES['txt_thumb']) && $_FILES['txt_thumb']['size'] > 0){
		$save_path = MEDIA_HOST."/events/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/events/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}

	$arr=array();
	$arr['group_id'] 	= isset($_POST['cbo_cate']) ? (int)$_POST['cbo_cate'] : 0;
	$arr['title'] 		= isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$arr['alias'] 		= $Url=='' ? un_unicode($arr['title']) : $Url;
	$arr['sapo'] 		= isset($_POST['txt_sapo']) ? addslashes($_POST['txt_sapo']) : '';
	$arr['organizers'] 	= isset($_POST['organizers']) ? addslashes($_POST['organizers']) : '';
	$arr['scientific_ommittee'] = isset($_POST['scientific_ommittee']) ? addslashes($_POST['scientific_ommittee']) : '';
	$arr['purpose'] 	= isset($_POST['purpose']) ? addslashes($_POST['purpose']) : '';
	$arr['invited_guests'] = isset($_POST['invited_guests']) ? addslashes($_POST['invited_guests']) : '';
	$arr['fulltext'] 	= isset($_POST['txt_fulltext']) ? addslashes($_POST['txt_fulltext']) : '';
	$arr['address'] 	= isset($_POST['address']) ? addslashes($_POST['address']) : '';
	$arr['address2'] 	= isset($_POST['address2']) ? addslashes($_POST['address2']) : '';
	$arr['start_time'] 	= isset($_POST['start_time']) ? strtotime($_POST['start_time']) : '';
	$arr['end_time'] 	= isset($_POST['end_time']) ? strtotime($_POST['end_time']) : '';
	$arr['year'] 		= date("Y");
	$arr['baocaovien'] 	= isset($_POST['baocaovien']) ? addslashes($_POST['baocaovien']) : null;
	$arr['personnel'] 	= isset($_POST['personnel']) ? json_encode($_POST['personnel']) : null;
	$arr['research_team'] = isset($_POST['team']) ? json_encode($_POST['team']) : null;
	$arr['author'] 		= getInfo('username');
	$arr['pseudonym'] 	= getInfo('pseudonym');
	$arr['images'] 		= $file;
	$arr['cdate'] 		= time();
	$arr['place'] 		= isset($_POST['place']) ? addslashes($_POST['place']) : null;
	$arr['rapporter'] 	= isset($_POST['rapporter']) ? addslashes($_POST['rapporter']) : null;
	$arr['language'] 	= isset($_POST['language']) ? addslashes($_POST['language']) : null;
	$result = SysAdd('tbl_event', $arr);

	/* Add history */
	$arr['status'] = 'khởi tạo';
	SysAdd('tbl_event_history', $arr);

	if($result){
		if(isset($_POST['event_item_date'])){
			foreach ($_POST['event_item_date'] as $key => $value) {
				if($_POST['event_item_code'][$key]!==''){
					$tmp_arr = [];
					$tmp_arr['code'] = $_POST['event_item_code'][$key];
					$tmp_arr['title'] = $_POST['event_item_title'][$key];
					$tmp_arr['address'] = $_POST['event_item_address'][$key];
					$tmp_arr['date'] = strtotime($_POST['event_item_date'][$key]);
					$tmp_arr['stime'] = strtotime($_POST['event_item_stime'][$key]);
					$tmp_arr['etime'] = strtotime($_POST['event_item_etime'][$key]);
					$tmp_arr['type'] = 'event';
					$tmp_arr['event_id'] = $result;
					SysAdd('tbl_schedule', $tmp_arr);
				}
			}
		}
		$_SESSION['flash'.'com_'.COMS] = 1;
	}
	else $_SESSION['flash'.'com_'.COMS] = 0;
}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Thêm mới HĐKH</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS;?>">Danh sách HĐKH</a></li>
					<li class="breadcrumb-item active">Thêm mới HĐKH</li>
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
						<div class="col-md-9">
							<div class="form-group">
								<label>Tiêu đề<font color="red">*</font></label>
								<input type="text" id="txt_name" name="txt_name" class="form-control" placeholder="Tiêu đề HĐKH">
							</div>

							<div class="form-group">
								<label>Url</label>
								<input type="text" id="txt_url" name="txt_url" class="form-control">
							</div>

							<div class="row form-group">
								<div class="col-md-5">
									<label>Thời gian bắt đầu</label>
									<input type="date" id="start_time" name="start_time" class="form-control">
								</div>
								<div class="col-md-5">
									<label>Thời gian kết thúc</label>
									<input type="date" id="end_time" name="end_time" class="form-control">
								</div>
								<div class="col-md-2">
									<label>.</label>
									<button type="button" onclick="generateSchedule()" class="btn blue form-control"><i class="fa fa-calendar" aria-hidden="true"></i> Tạo lịch</button>
								</div>
							</div>

							<div class="form-group" id="wg-schedule">
								<label>Lịch trình chi tiết</label>
								<div class="table-responsive wr-tbl-schedule"></div>
							</div>

							<div class="form-group">
								<label>Ban tổ chức</label>
								<textarea class="form-control" id="organizers" name="organizers" placeholder="Ban tổ chức..." rows="3"></textarea>
							</div>

							<div class="form-group">
								<label>Hội đồng khoa học</label>
								<textarea class="form-control" id="scientific_ommittee" name="scientific_ommittee" placeholder="Hội đồng khoa học..." rows="3"></textarea>
							</div>

							<div class="form-group">
								<label>Mục đích</label>
								<textarea class="form-control" id="purpose" name="purpose" placeholder="Mục đích..." rows="3"></textarea>
							</div>

							<div class="form-group">
								<label>Báo cáo mời</label>
								<textarea class="form-control" id="invited_guests" name="invited_guests" placeholder="Báo cáo mời..." rows="3"></textarea>
							</div>

							<div class="form-group">
								<label>Tóm tắt nội dung</label>
								<textarea class="form-control" id="txt_sapo" name="txt_sapo" placeholder="Tóm tắt nội dung..." rows="3"></textarea>
							</div>
							
							<div class="form-group" id="type_text">
								<label>Tùy chọn</label>
								<textarea class="form-control" id="txt_fulltext" name="txt_fulltext"></textarea>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>Danh mục HĐKH<font color="red">*</font></label>
								<select class="form-control" name="cbo_cate" id="cbo_cate">
									<?php getListComboboxCategories(0, 0); ?>
								</select>
							</div>

							<div class="form-group">
								<label>Địa điểm diễn ra HĐKH</label>
								<textarea id="address" name="address" class="form-control" placeholder="Địa điểm diễn ra HĐKH" rows="1"></textarea>
							</div>

							<div class="form-group">
								<label>Địa điểm chi tiết</label>
								<textarea id="address2" name="address2" class="form-control" placeholder="Địa điểm chi tiết" rows="3"></textarea>
							</div>

							<div class="form-group">
								<label>Nhân sự</label>
								<div id="list_personnel"></div>
								<div><span class="btn btn-primary" onclick="add_personnel()"><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm nhân sự</span></div>
							</div>

							<div class="form-group">
								<label>Nhóm nghiên cứu viên</label>
								<div id="list_research_team"></div>
								<div><span class="btn btn-primary" onclick="add_research_team()"><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm nhóm nghiên cứu viên</span></div>
							</div>

							<div class="form-group">
								<label>Báo cáo viên ngoài viện</label><small>(Nếu nhiều người, mỗi người cách nhau một dấu <b class="cred">,</b> )</small>
								<textarea id="baocaovien" name="baocaovien" class="form-control" placeholder="Báo cáo viên ngoài viện" rows="1"></textarea>
							</div>

							<div class='form-group'>
								<div class="widget-fileupload fileupload fileupload-new" data-provides="fileupload">
									<label>Ảnh đại diện</label><small> (Dung lượng < 10MB)</small>
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
											<input type="file" id="file_image" name="txt_thumb" accept="image/jpg, image/jpeg/png">
										</span>
										<a href="javascript:void(0)" class="btn fileupload-exists" data-dismiss="fileupload" onclick="cancel_fileupload()">Hủy</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="toolbar">
						<div class="widget_control text-center">
							<button type="submit" class="border-radius0 btn blue" data-key="4">Lưu thông tin</button>
						</div>
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
		$('#body').addClass('sidebar-collapse');
		$('#frm_action').submit(function(){
			return validForm();
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
			selector: '#txt_fulltext, #txt_sapo',
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

			/*override default upload handler to simulate successful upload*/
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
				formData.append('folder', 'events/');
				xhr.send(formData);
			},
		});

		tinymce.init({
			selector: '#organizers, #scientific_ommittee, #purpose, #invited_guests',
			height: 200,
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

			/*override default upload handler to simulate successful upload*/
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
				formData.append('folder', 'events/');
				xhr.send(formData);
			},
		});
	});

	function generateSchedule(){
		if(confirm("Bạn có chắc muốn tạo mới lịch")){
			var stime = $('#start_time').val(),
			etime = $('#end_time').val(),
			int_stime = convertDateToInt(stime),
			int_etime = convertDateToInt(etime);

			if(stime=='' || etime =='') return;
			if(int_stime <= int_etime){
				$.post('<?php echo ROOTHOST;?>ajaxs/event/generate_schedule.php', {'stime': stime, 'etime': etime}, function(res){
					if(parseInt(res)!=''){
						$('.wr-tbl-schedule').html(res);
					}else{
						$('.wr-tbl-schedule').html(res);
					}
				});
			}else{
				alert('Thời gian bắt đầu phải nhỏ hơn hoặc bằng thời gian kết thúc');
			}
		}
	}

	function add_personnel(){
		var _url="<?php echo ROOTHOST;?>ajaxs/team/list_personnel.php";
		var ids=[];
		if($('.personnel_item')){
			$('.personnel_item').each(function(){
				var id=$(this).attr('data-id');
				ids.push(id);
			});
		}

		$.post(_url, {'ids': ids}, function(req){
			$('#popup_modal .modal-dialog').addClass('modal-xl');
			$('#popup_modal .modal-body').html(req);
			$('#popup_modal').modal('show');
		});
	}

	function add_research_team(){
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
			$('#popup_modal .modal-body').html(req);
			$('#popup_modal').modal('show');
		});
	}

	function append_personnel(data){
		var ids=[];
		var lg = data.length;
		var str='';

		if($('.personnel_item')){
			$('.personnel_item').each(function(){
				var id=$(this).attr('data-id');
				ids.push(id);
			});
		}

		if(lg>0){
			for(var i=0; i< lg; i++){
				var val = data[i];
				if(!ids.includes(val.id)){
					str+='<span class="personnel_item" data-id="'+val.id+'">'+val.name+' <i class="fa fa-times" onclick="remove_personnel(this)" aria-hidden="true"></i><input type="hidden" name="personnel[]" value="'+val.id+'" /></span>';
				}
			}
		}
		$('#list_personnel').append(str);
		close_model();
	}

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

	function close_model(){
		$('#popup_modal').modal('hide');
		$('#popup_modal .modal-dialog').removeClass('modal-xl');
	}

	function remove_personnel(e){
		e.parentElement.remove();
	}

	function remove_team(e){
		e.parentElement.remove();
	}

	function add_event_item(attr){
		var date = attr.getAttribute('data-date');
		var _url="<?php echo ROOTHOST;?>ajaxs/event/form_add_event_item.php";
		var _data = {
			"date": date,
		}
		$.post(_url, _data, function(req){
			$('#popup_modal .modal-dialog').addClass('modal-lg');
			$('#popup_modal .modal-body').html(req);
			$('#popup_modal').modal('show');
		});
	}

	function append_event_item(data){
		$('#wg-schedule .idate').each(function(){
			var _date = $(this).attr('data-date');
			var obj_data = JSON.parse(data);

			if(obj_data.hasOwnProperty(_date)){
				var str='<div class="event_item" onclick="edit_event_item(this)" data-id="'+obj_data[_date]['id']+'" data-sdate="'+obj_data[_date]['start_date']+'" data-edate="'+obj_data[_date]['end_date']+'" data-stime="'+obj_data[_date]['start_time']+'" data-etime="'+obj_data[_date]['end_time']+'" data-title="'+obj_data[_date]['title']+'" data-address="'+obj_data[_date]['address']+'">';
				str+='<div class="event_item_header">'+substringByWords(obj_data[_date]['title'])+'</div>';

				str+='<input type="hidden" name="event_item_date[]" value="'+obj_data[_date]['date']+'">';
				str+='<input type="hidden" name="event_item_title[]" value="'+obj_data[_date]['title']+'">';
				str+='<input type="hidden" name="event_item_code[]" value="'+obj_data[_date]['id']+'">';
				str+='<input type="hidden" name="event_item_address[]" value="'+obj_data[_date]['address']+'">';
				str+='<input type="hidden" name="event_item_stime[]" value="'+obj_data[_date]['start_time']+'">';
				str+='<input type="hidden" name="event_item_etime[]" value="'+obj_data[_date]['end_time']+'">';

				str+='</div>';
				$(this).find('.icontent').append(str);
				$('#popup_modal').modal('hide');
			}
		});
	}

	function edit_event_item(attr){
		var _data = {
			"id": attr.getAttribute('data-id'),
			"title": attr.getAttribute('data-title'),
			"address": attr.getAttribute('data-address'),
			"start_time": attr.getAttribute('data-stime'),
			"end_time": attr.getAttribute('data-etime'),
			"date": attr.getAttribute('data-date'),
		}

		var _url="<?php echo ROOTHOST;?>ajaxs/event/form_edit_event_item.php";

		$.post(_url, _data, function(req){
			$('#popup_modal .modal-dialog').addClass('modal-lg');
			$('#popup_modal .modal-body').html(req);
			$('#popup_modal').modal('show');
		});
	}

	function update_content_event_item(id, data){
		$('#wg-schedule .event_item').each(function(){
			var _id = $(this).attr('data-id');
			var obj_data = JSON.parse(data);
			var title = substringByWords(obj_data['title']);
			if(_id == id){
				$(this).attr('data-id', obj_data['id']);
				$(this).attr('data-title', obj_data['title']);
				$(this).attr('data-address', obj_data['address']);
				$(this).attr('data-date', obj_data['date']);
				$(this).attr('data-stime', obj_data['start_time']);
				$(this).attr('data-etime', obj_data['end_time']);
				$(this).find('.event_item_header').html(title);

				$(this).find('input[name="event_item_title[]"]').val(obj_data['title']);
				$(this).find('input[name="event_item_code[]"]').val(obj_data['id']);
				$(this).find('input[name="event_item_address[]"]').val(obj_data['address']);
				$(this).find('input[name="event_item_date[]"]').val(obj_data['date']);
				$(this).find('input[name="event_item_stime[]"]').val(obj_data['start_time']);
				$(this).find('input[name="event_item_etime[]"]').val(obj_data['end_time']);

				$('#popup_modal').modal('hide');
			}
		});
	}

	function delete_event_item(id){
		$('#wg-schedule .event_item').each(function(){
			var _id = $(this).attr('data-id');
			if(_id == id){
				$(this).remove();
				$('#popup_modal').modal('hide');
			}
		});
	}

	function substringByWords(str){
		return str.replace(/^(.{11}[^\s]*).*/, "$1"); 
	}

	function convertDateToInt(dateStr) {
		return new Date(dateStr).getTime();
	};

	/*
	 Ajax upload image
	 */
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

	function validForm(){
		var flag = true;
		var title = $('#txt_name').val();
		var cate = parseInt($('#cbo_cate').val());

		if(title=='' || cate==0){
			alert('Các mục đánh dấu * không được để trống');
			flag = false;
		}

		return flag;
	}
</script>