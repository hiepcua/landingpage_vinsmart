<?php
$msg 		= new \Plasticbrain\FlashMessages\FlashMessages();
if(!isset($_SESSION['flash'.'com_'.COMS])) $_SESSION['flash'.'com_'.COMS] = 2;
require_once('libs/cls.upload.php');
$obj_upload = new CLS_UPLOAD();
$file='';

if(isset($_POST['cmdsave_tab1']) && $_POST['txt_name']!='') {
	$Title 			= 
	$Url 			= isset($_POST['txt_url']) ? addslashes($_POST['txt_url']) : '';
	$Intro 			= isset($_POST['txt_intro']) ? addslashes($_POST['txt_intro']) : '';
	$Meta_title 	= isset($_POST['meta_title']) ? addslashes($_POST['meta_title']) : '';
	$Meta_desc 		= isset($_POST['meta_desc']) ? addslashes($_POST['meta_desc']) : '';
	$Par_id 		= isset($_POST['cbo_par']) ? (int)$_POST['cbo_par'] : 0;
	$Site_id 		= isset($_POST['cbo_site']) ? (int)$_POST['cbo_site'] : 0;

	if(isset($_FILES['txt_thumb']) && $_FILES['txt_thumb']['size'] > 0){
		$save_path 	= "../medias/common_knowledge/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/common_knowledge/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}

	$arr=array();
	$arr['title'] = isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$arr['alias'] = $Url=='' ? un_unicode($Title) : $Url;
	$arr['place'] = isset($_POST['place']) ? addslashes($_POST['place']) : '';
	$arr['rapporteur'] = isset($_POST['rapporteur']) ? addslashes($_POST['rapporteur']) : '';
	$arr['language'] = isset($_POST['language']) ? addslashes($_POST['language']) : 'vn';
	$arr['intro'] = isset($_POST['intro']) ? addslashes($_POST['intro']) : '';
	$arr['image'] = $file;

	$result = SysAdd('tbl_common_knowledge', $arr);
	if($result){
		// $arr2=array();
		// $arr2['title'] = $arr['title'];
		// $arr2['link'] = ROOTHOST_WEB.$arr['alias'];
		// $arr2['image'] = $file;
		// $arr2['meta_title'] = isset($_POST['meta_title']) ? addslashes($_POST['meta_title']) : '';
		// $arr2['meta_key'] = isset($_POST['meta_title']) ? addslashes($_POST['meta_title']) : '';
		// $arr2['meta_desc'] = isset($_POST['meta_desc']) ? addslashes($_POST['meta_desc']) : '';
		// SysAdd('tbl_seo', $arr2);

		$_SESSION['flash'.'com_'.COMS] = 1;
	}else{
		$_SESSION['flash'.'com_'.COMS] = 0;
	}
}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Thêm mới phổ biến kiến thức</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS;?>">Danh sách phổ biến kiến thức</a></li>
					<li class="breadcrumb-item active">Thêm mới phổ biến kiến thức</li>
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
								<label>Tiêu đề<font color="red"><font color="red">*</font></font></label>
								<input type="text" id="txt_name" name="txt_name" class="form-control" value="" placeholder="Tiêu đề">
							</div>

							<div class="form-group">
								<label>Url</label>
								<input type="text" id="txt_url" name="txt_url" class="form-control">
							</div>

							<div class="form-group">
								<label>Địa điểm</label>
								<textarea class="form-control" name="place" placeholder="Địa điểm diễn ra..." rows="1"></textarea>
							</div>

							<div class="form-group">
								<label>Báo cáo viên</label>
								<textarea class="form-control" name="rapporteur" placeholder="Báo cáo viên..." rows="1"></textarea>
							</div>

							<div class="form-group">
								<label>Mô tả</label>
								<textarea class="form-control" name="intro" id="intro"></textarea>
							</div>

							<div class="wg-tabseo">
								<span id="display_tabseo" class="cblue">+ Tùy chỉnh SEO</span>
								<div id="tabseo" class="tabseo">
									<div class="form-group">
										<label>Meta title</label>
										<textarea class="form-control" name="meta_title" placeholder="Meta title..." rows="2"></textarea>
									</div>

									<div class="form-group">
										<label>Meta description</label>
										<textarea class="form-control" name="meta_desc" placeholder="Meta description..." rows="3"></textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-lg-3">
							<div class="form-group">
								<label>Ngôn ngữ</label>
								<select class="form-control" name="language" id="language">
									<option value="vn">Tiếng Việt</option>
									<option value="en">Tiếng Anh</option>
								</select>
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
											<input type="file" id="file_image" name="txt_thumb" accept="image/jpg, image/jpeg">
										</span>
										<a href="javascript:void(0)" class="btn fileupload-exists" data-dismiss="fileupload" onclick="cancel_fileupload()">Hủy</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="text-center toolbar">
						<input type="submit" name="cmdsave_tab1" id="cmdsave_tab1" class="save btn btn-success" value="Lưu thông tin" class="btn btn-primary">
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

		$('#display_tabseo').on('click', function(){
			$('#tabseo').toggleClass('show');
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
			selector: '#intro',
			height: 400,
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
            	formData.append('folder', 'contents/');
            	xhr.send(formData);
            },
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

		if(title==''){
			alert('Các mục đánh dấu * không được để trống');
			flag = false;
		}
		return flag;
	}
</script>