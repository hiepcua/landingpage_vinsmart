<?php
$msg 		= new \Plasticbrain\FlashMessages\FlashMessages();
if(!isset($_SESSION['flash'.'com_'.COMS])) $_SESSION['flash'.'com_'.COMS] = 2;
require_once('libs/cls.upload.php');
$obj_upload = new CLS_UPLOAD();
$file='';

if(isset($_POST['txt_name']) && $_POST['txt_name'] !== '') {
	$Title 			= isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$Url 			= isset($_POST['txt_url']) ? addslashes($_POST['txt_url']) : '';
	$Sapo 			= isset($_POST['txt_sapo']) ? addslashes($_POST['txt_sapo']) : '';
	$Cate 			= isset($_POST['cbo_cate']) ? (int)$_POST['cbo_cate'] : 0;
	$Images 		= isset($_POST['txt_thumb2']) ? addslashes($_POST['txt_thumb2']) : '';
	$Address 		= isset($_POST['address']) ? addslashes($_POST['address']) : '';
	$Topic_manager 		= isset($_POST['topic_manager']) ? addslashes($_POST['topic_manager']) : '';
	$Baocaovien 		= isset($_POST['baocaovien']) ? addslashes($_POST['baocaovien']) : '';
	$Status 		= isset($_POST['txt_status']) ? (int)$_POST['txt_status'] : 0;
	$Stime 			= isset($_POST['start_time']) ? strtotime($_POST['start_time']) : '';
	$Endtime 		= isset($_POST['end_time']) ? strtotime($_POST['end_time']) : '';
	$Fulltext 		= isset($_POST['txt_fulltext']) ? addslashes($_POST['txt_fulltext']) : '';
	$Meta_title 	= isset($_POST['meta_title']) ? addslashes($_POST['meta_title']) : '';
	$Meta_desc 		= isset($_POST['meta_desc']) ? addslashes($_POST['meta_desc']) : '';
	$Schedule 		= isset($_POST['schedule_datas']) ? addslashes($_POST['schedule_datas']) : null;

	if(isset($_FILES['txt_thumb']) && $_FILES['txt_thumb']['size'] > 0){
		$save_path 	= "../medias/events/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/events/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}

	$arr=array();
	$arr['group_id'] = $Cate;
	$arr['title'] = $Title;
	$arr['alias'] = $Url=='' ? un_unicode($Title) : $Url;
	$arr['sapo'] = $Sapo;
	$arr['fulltext'] = $Fulltext;
	$arr['address'] = $Address;
	$arr['start_time'] = $Stime;
	$arr['end_time'] = $Endtime;
	$arr['year'] 	= date("Y");
	$arr['topic_manager'] 	= $Topic_manager;
	$arr['baocaovien'] 	= $Baocaovien;
	$arr['author'] = getInfo('username');
	$arr['pseudonym'] = getInfo('pseudonym');
	$arr['images'] = $file;
	$arr['cdate'] = time();
	$arr['status'] = $Status;
	$arr['schedule'] = $Schedule;

	$result = SysAdd('tbl_event', $arr);

	if($result){
		$arr2=array();
		$arr2['title'] = $arr['title'];
		$arr2['link'] = ROOTHOST_WEB.'hdkh/'.$arr['alias'].'-'.$result;
		$arr2['image'] = $file;
		$arr2['meta_title'] = $Meta_title;
		$arr2['meta_key'] = $Meta_title;
		$arr2['meta_desc'] = $Meta_desc;
		SysAdd('tbl_seo', $arr2);

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
				<h1 class="m-0 text-dark">Thêm mới xuất bản</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS;?>">Danh sách xuất bản</a></li>
					<li class="breadcrumb-item active">Thêm mới xuất bản</li>
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
					<input type="hidden" id="txt_status" name="txt_status" value="">
					<div class="row">
						<div class="col-md-9">
							<div  class="form-group">
								<label>Tiêu đề<font color="red">*</font></label>
								<input type="text" id="txt_name" name="txt_name" class="form-control" placeholder="Tên">
							</div>

							<div class="form-group">
								<label>Url</label>
								<input type="text" id="txt_url" name="txt_url" class="form-control">
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

							<div class="form-group">
								<label>Mô tả</label>
								<textarea class="form-control" id="txt_sapo" name="txt_sapo" placeholder="Mô tả..." rows="3"></textarea>
							</div>
							
							<div class="form-group" id="type_text">
								<label>Nội dung</label>
								<textarea class="form-control" id="txt_fulltext" name="txt_fulltext" placeholder="Nội dung chính..." rows="5"></textarea>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>Nhóm xuất bản<font color="red">*</font></label>
								<select class="form-control" name="cbo_cate" id="cbo_cate">
									<?php getListComboboxCategories(0, 0); ?>
								</select>
							</div>

							<div class="form-group">
								<label>Chủ nhiệm đề tài</label> <small>(Nếu nhiều người, mỗi người cách nhau một dấu <b class="cred">|</b> )</small>
								<input type="text" id="topic_manager" name="topic_manager" class="form-control" placeholder="Chủ nhiệm đề tài">
							</div>

							<div class="form-group">
								<label>Tác giả</label> <small>(Nếu nhiều người, mỗi người cách nhau một dấu <b class="cred">,</b> )</small>
								<input type="text" id="author" name="author" class="form-control" placeholder="Tác giả">
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
							<button type="submit" class="border-radius0 btn blue" data-key="4">Lưu xuất bản</button>
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
		// Hidden left sidebar
		$('#body').addClass('sidebar-collapse');
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
					/*console.log(req);*/
					if(req!=='0'){
						$('#txt_url').val(req);
					}
				})
			}
		});

		tinymce.init({
			selector: '#txt_fulltext',
			height: 600,
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
	});

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