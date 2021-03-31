<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');
?>
<br/>
<div class='ajx_mess' style='color:#f00;'></div>
<form name="frm_action" id="frm_action" action="" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
				<label>Tên </label><font color="red">*</font>
				<input type="text" id="txt_name" name="txt_name" class="form-control" value="" placeholder="Tên nhóm nghiên cứu viên" required>
			</div>

			<div class="form-group">
				<label>Mã nhóm nghiên cứu viên</label><font color="red">*</font>
				<div class="input-group mb-3">
					<input type="text" id="team_code" name="team_code" class="form-control" required>
					<div class="input-group-append">
						<span id="auto_team_code" class="input-group-text"><i class="fa fa-random" aria-hidden="true"></i></span>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Ngày bắt đầu</label><font color="red">*</font>
						<input type="date" id="start_date" name="start_date" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Ngày kết thúc</label><font color="red">*</font>
						<input type="date" id="end_date" name="end_date" class="form-control">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label>Css class</label>
				<input type="text" id="cssclass" name="cssclass" class="form-control">
			</div>

			<div class="form-group">
				<div id="list_personnel"></div>
				<div><span class="btn btn-primary" id="add_personnel"><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm nhà khoa học</span></div>
			</div>
		</div>

		<div class="col-md-4">
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
							<input type="file" id="file_image" name="txt_thumb" accept="image/jpg, image/jpeg">
						</span>
						<a href="javascript:void(0)" class="btn fileupload-exists" data-dismiss="fileupload" onclick="cancel_fileupload()">Hủy</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="text-center toolbar">
		<input type="submit" name="cmdsave_tab" id="cmdsave_tab" class="save btn btn-success" value="Lưu thông tin" class="btn btn-primary">
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$("form#frm_action").submit(function(e) {
			if(validForm()){
				e.preventDefault();    
				var formData = new FormData(this);

				var _url="<?php echo ROOTHOST;?>ajaxs/team/process_add.php";
				$.ajax({
					url: _url,
					type: 'POST',
					data: formData,
					success: function (data) {
						if(parseInt(data) == 1){
							window.location.reload();
						}else if(parseInt(res)==3){
							alert('Bạn không có quyền thực hiện chức năng này!');
						}else{
							alert('Lỗi!');
						}
					},
					cache: false,
					contentType: false,
					processData: false
				});
			}else{
				e.preventDefault();
			}
		});

		$('#auto_team_code').on('click', function(){
			$.get('<?php echo ROOTHOST;?>ajaxs/random_persionnel_code.php', function(res){
				if(parseInt(res)!=0){
					$('#team_code').val(res);
				}else{
					$('#team_code').val('error!');
				}
			});
		});

		$('#add_personnel').on('click', function(){
			var _url="<?php echo ROOTHOST;?>ajaxs/team/list_personnel.php";

			$.post(_url, function(req){
				$('#popup_modal2 .modal-dialog').addClass('modal-xl');
				$('#popup_modal2 .modal-title').html('Danh sách nhà khoa học');
				$('#popup_modal2 .modal-body').html(req);
				$('#popup_modal2').modal('show');
			});
		});
	});

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
					str+='<span class="personnel_item" data-id="'+val.id+'">'+val.name+' <i class="fa fa-times" onclick="remove_personnel(this)" aria-hidden="true"></i><input type="hidden" name="personnel[]" value="'+val.id+'"/></span>';
				}
			}
		}
		$('#list_personnel').append(str);
		close_model();
	}

	function close_model(){
		$('#popup_modal2').modal('hide');
		$('#popup_modal2 .modal-dialog').removeClass('modal-xl');
	}

	function remove_personnel(e){
		e.parentElement.remove();
	}

	/* Js upload image */

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

	function convertDateToInt(dateStr) {
		return new Date(dateStr).getTime();
	};

	function validForm(){
		var flag = true;
		var title = $('#txt_name').val();
		var stime = $('#start_date').val();
		var etime = $('#end_date').val();
		var int_stime = convertDateToInt(stime);
		var int_etime = convertDateToInt(etime);
		var code = $('#team_code').val();

		if(title=='' || stime=='' || etime=='' || code==''){
			alert('Các mục đánh dấu * không được để trống');
			flag = false;
		}

		if(parseInt(int_stime) > parseInt(int_etime)){
			alert('Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc');
			flag = false;
		}

		return flag;
	}
</script>