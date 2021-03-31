<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');
$row = isset($_POST) ? json_decode($_POST['data'], true) : array();
?>
<div class="row">
	<div class="col-md-8 col-lg-9">
		<div class="form-group">
			<label>Tiêu đề<font color="red"><font color="red">*</font></font></label>
			<input type="text" onchange="change_name(this)" name="txt_name" class="form-control" value="<?php echo $row['title'];?>" placeholder="Tiêu đề">
		</div>

		<div class="form-group">
			<label>Url</label>
			<input type="text" id="txt_url" name="txt_url" class="form-control" value="<?php echo $row['alias'];?>">
		</div>

		<div class="form-group">
			<label>Địa điểm</label>
			<textarea class="form-control" name="address" placeholder="Địa điểm diễn ra..." rows="1"><?php echo $row['address'];?></textarea>
		</div>

		<div class="form-group">
			<label>Báo cáo viên</label>
			<textarea class="form-control" name="rapporter" placeholder="Báo cáo viên..." rows="1"><?php echo $row['rapporter'];?></textarea>
		</div>

		<div class="form-group">
			<label>Mô tả</label>
			<textarea class="form-control" name="txt_fulltext" id="txt_fulltext"><?php echo $row['fulltext'];?></textarea>
		</div>
	</div>

	<div class="col-md-4 col-lg-3">
		<div class="form-group">
			<label>Ngôn ngữ</label>
			<select class="form-control" name="language" id="language">
				<option value="vn">Tiếng Việt</option>
				<option value="en">Tiếng Anh</option>
			</select>
			<script type="text/javascript">
				$(document).ready(function(){
					cbo_Selected('language','<?php echo $row['language'];?>');
				});
			</script>
		</div>

		<div class="form-group">
			<label>Ngày xuất bản</label>
			<input type="date" id="pdate" name="pdate" class="form-control" value="<?php echo ($row['pdate']!==null && $row['pdate']!=='') ? date('d-m-Y', $row['pdate']) : '';?>">
		</div>

		<div class="form-group">
			<label>Tác giả</label>
			<input type="text" id="author" name="author" class="form-control" value="<?php echo $row['author'];?>">
		</div>

		<div class='form-group'>
			<div class="widget-fileupload fileupload fileupload-new" data-provides="fileupload">
				<label>Ảnh đại diện</label><small> (Dung lượng < 10MB)</small>
				<div class="widget-avatar mb-2">
					<div class="fileupload-new thumbnail">
						<?php
						if(strlen($row['images'])>0){
							echo '<img src="'.$row['images'].'" id="img_image_preview">';
						}else{
							echo '<img src="'.ROOTHOST.'global/img/no-photo.jpg" id="img_image_preview">';
						}
						?>
					</div>
					<div class="fileupload-preview fileupload-exists thumbnail" style="line-height: 20px;"></div>
					<input type="hidden" name="txt_thumb2" value="<?php echo $row['images'];?>">
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
		<p><a href="<?php echo ROOTHOST.'?com=event&viewtype=history&id='.$row['id'];?>" target="_blank">Lịch sử chỉnh sửa</a></p>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		tinymce.init({
			selector: '#txt_fulltext',
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
	});

	function change_name(e){
		var name = e.value;
		var _url = "<?php echo ROOTHOST;?>ajaxs/generate_alias.php";
		if(name.length > 0){
			$.post(_url, {"name": name}, function(req){
				if(req!=='0'){
					$('#txt_url').val(req);
				}
			})
		}
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
</script>