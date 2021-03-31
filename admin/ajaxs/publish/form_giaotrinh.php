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
	<div class="col-md-6">
		<div class="form-group">
			<label>Tên bài giảng/ giáo trình</label>
			<input type="text" id="title2" name="title2" class="form-control" value="<?php echo $row['title2'];?>" placeholder="Tên bài giảng/ giáo trình">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>File</label> <small>(Chọn một file)</small>
			<input type="file" id="file" name="file" class="form-control" value="">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Ngày xuất bản</label>
			<input type="date" id="pdate" name="pdate" class="form-control" value="<?php echo $row['pdate']!=='' && $row['pdate']!==null ? date('Y-m-d', $row['pdate']) : '';?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Tác giả</label>
			<input type="text" id="author" name="author" class="form-control" value="<?php echo $row['author'];?>">
		</div>
	</div>
</div>

<div class="form-group">
	<label>Tóm tắt</label>
	<textarea id="intro" name="intro" class="form-control"><?php echo $row['intro'];?></textarea>
</div>

<div class="form-group">
	<label>Nội dung</label>
	<textarea id="fulltext" name="fulltext" class="form-control"><?php echo $row['fulltext'];?></textarea>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		tinymce.init({
			selector: '#fulltext, #intro',
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
            	formData.append('folder', 'publish/');
            	xhr.send(formData);
            },
        });
	})
</script>