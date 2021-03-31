<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');
$GetID = isset($_GET['id']) ? (int)$_GET["id"] : 0;

$res_Cate = SysGetList('tbl_seo', array(), ' AND id='. $GetID);
if(count($res_Cate) <= 0){
	echo 'Không có dữ liệu.'; 
	return;
}
$row = $res_Cate[0];
?>
<br/>
<div class='ajx_mess' style='color:#f00;'></div>
<form name="frm_action" id="frm_action" action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>">
	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
				<label>Tiêu đề<font color="red"><font color="red">*</font></font></label>
				<input type="text" id="txt_name" name="txt_name" class="form-control" value="<?php echo $row['title'];?>" placeholder="Tiêu đề meta seo">
			</div>

			<div class="form-group">
				<label>Link </label><font color="red">*</font>
				<input type="text" id="link" name="link" class="form-control" value="<?php echo $row['link'];?>" placeholder="Link">
			</div>

			<div class="form-group">
				<label>Meta title</label>
				<textarea class="form-control" id="meta_title" name="meta_title" rows="1"><?php echo $row['meta_title'];?></textarea>
			</div>

			<div class="form-group">
				<label>Meta key</label>
				<textarea class="form-control" id="meta_key" name="meta_key" rows="1"><?php echo $row['meta_key'];?></textarea>
			</div>

			<div class="form-group">
				<label>Meta description</label>
				<textarea class="form-control" id="meta_desc" name="meta_desc" rows="3"><?php echo $row['meta_desc'];?></textarea>
			</div>
		</div>

		<div class="col-md-4">
			<div class='form-group'>
				<div class="widget-fileupload fileupload fileupload-new" data-provides="fileupload">
					<label>Ảnh đại diện</label><small> (Dung lượng < 10MB)</small>
					<div class="widget-avatar mb-2">
						<div class="fileupload-new thumbnail">
							<?php
							if(strlen($row['image'])>0){
								echo '<img src="'.$row['image'].'" id="img_image_preview">';
							}else{
								echo '<img src="'.ROOTHOST.'global/img/no-photo.jpg" id="img_image_preview">';
							}
							?>
						</div>
						<div class="fileupload-preview fileupload-exists thumbnail" style="line-height: 20px;"></div>
						<input type="hidden" name="txt_thumb2" value="<?php echo $row['image'];?>">
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

				var _url="<?php echo ROOTHOST;?>ajaxs/seo/process_edit.php";
				$.ajax({
					url: _url,
					type: 'POST',
					data: formData,
					success: function (data) {
						if(parseInt(data) == 1){
							window.location.reload();
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
		var title = $('#txt_name').val();
		var link = $('#link').val();

		if(title=='' && link!==''){
			alert('Các mục đánh dấu * không được để trống');
			flag = false;
		}
		return flag;
	}
</script>