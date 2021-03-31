<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');

function getListComboboxCategories($parid=0, $level=0){
	$sql="SELECT * FROM tbl_event_group WHERE `par_id`='$parid' AND `isactive`='1' ";
	$objdata=new CLS_MYSQL();
	$objdata->Query($sql);
	$char="";
	if($level!=0){
		for($i=0;$i<$level;$i++)
			$char.="|-----";
	}
	if($objdata->Num_rows()<=0) return;
	while($rows=$objdata->Fetch_Assoc()){
		$id=$rows['id'];
		$parid=$rows['par_id'];
		$title=$rows['title'];
		echo "<option value='$id'>$char $title</option>";
		$nextlevel=$level+1;
		getListComboboxCategories($id,$nextlevel);
	}
}
?>
<br/>
<div class='ajx_mess' style='color:#f00;'></div>
<form name="frm_action" id="frm_action" action="" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
				<label>Tiêu đề </label><font color="red">*</font>
				<input type="text" id="txt_name" name="txt_name" class="form-control required" value="" placeholder="Tiêu đề ...">
			</div>

			<div class="form-group">
				<label>Url</label>
				<input type="text" id="alias" name="alias" class="form-control">
			</div>

			<div class="form-group">
				<label>Loại hoạt động khoa học</label><font color="red">*</font>
				<select class="form-control required" id="type" name="type">
					<option value="hdkh">Hoạt động khoa học</option>
					<option value="phobienkienthuc">Phổ biến kiến thức</option>
				</select>
			</div>

			<div class="form-group">
				<label>Danh mục HĐKH<font color="red">*</font></label>
				<select class="form-control" name="cbo_cate" id="cbo_cate">
					<?php getListComboboxCategories(0, 0); ?>
				</select>
			</div>

			<div class="text-center toolbar">
				<button type="submit" id="cmdsave_tab" class="save btn btn-success">Thêm mới</button>
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
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$('#txt_name').on('change', function(){
			var name = $(this).val();
			var _url = "<?php echo ROOTHOST;?>ajaxs/generate_alias.php";
			if(name.length > 0){
				$.post(_url, {"name": name}, function(req){
					if(req!=='0'){
						$('#alias').val(req);
					}
				})
			}
		});

		$("form#frm_action").submit(function(e) {
			if(validForm()){
				e.preventDefault();
				var formData = new FormData(this);

				var _url="<?php echo ROOTHOST;?>ajaxs/event/process_add.php";
				$.ajax({
					url: _url,
					type: 'POST',
					data: formData,
					success: function (data) {
						if(parseInt(data) !== '0'){
							window.location.href = "<?php echo ROOTHOST.'event/?viewtype=edit&id=';?>"+parseInt(data);
						}else{
							alert('Lỗi!')
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
	});

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
		$('#popup_modal .required').each(function(){
			var val = $(this).val();
			if(!val || val=='' || val=='0') {
				$(this).parents('.form-group').addClass('error');
				flag = false;
			}

			if(flag==false) {
				$('.ajx_mess').html('Vui lòng nhập đủ những thông tin bắt buộc.');
			}
		});
		return flag;
	}
</script>