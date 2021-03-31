<?php
include 'modules/toolbar.php';
$msg = new \Plasticbrain\FlashMessages\FlashMessages();
if(!isset($_SESSION['flash'.'com_'.COMS])) $_SESSION['flash'.'com_'.COMS] = 2;
require_once('libs/cls.upload.php');
$obj_upload = new CLS_UPLOAD();
$file='';
$GetID = isset($_GET['id']) ? (int)$_GET["id"] : 0;
$GetEvent = isset($_GET['event']) ? (int)$_GET["event"] : 0;

/*Check user permission*/
$isAdmin = getInfo('isadmin');
$userLogin = getInfo('username');
$res_Users = SysGetList('tbl_users', ['permission'], "AND username='".$userLogin."'");
$res_user = $res_Users[0];
$arr_permission = ($res_user['permission']!==null && $res_user['permission']!='[]' && $res_user['permission']!=='') ? json_decode($res_user['permission']) : [];
if(!$isAdmin && !in_array(5002, $arr_permission)){
	echo "Bạn không có quyền truy cập chức năng này.";
	exit();
}
/*End check user permission*/

if(isset($_POST['cmdsave_tab1']) && $_POST['txt_name']!='') {
	$Url 			= isset($_POST['txt_url']) ? addslashes($_POST['txt_url']) : '';
	$Images 		= isset($_POST['txt_thumb2']) ? addslashes($_POST['txt_thumb2']) : '';
	// $seo_link 		= isset($_POST['txt_seo_link']) ? addslashes($_POST['txt_seo_link']) : '';

	if(isset($_FILES['txt_thumb']) && $_FILES['txt_thumb']['size'] > 0){
		$save_path 	= "../medias/event_detail/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/event_detail/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}else{
		$file = $Images;
	}
	
	$arr=array();
	$arr['title'] = isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$arr['alias'] = $Url=='' ? un_unicode($arr['title']) : $Url;
	$arr['fulltext'] = isset($_POST['txt_fulltext']) ? addslashes($_POST['txt_fulltext']) : '';
	$arr['event_id'] = isset($_POST['event_id']) ? (int)$_POST['event_id'] : null;
	$arr['register'] = isset($_POST['register']) ? (int)$_POST['register'] : 0;
	$arr['image'] = $file;

	$result = SysEdit('tbl_event_detail', $arr, " id=".$GetID);

	if($result) {
		// $arr2=array();
		// $arr2['title'] = $arr['title'];
		// $arr2['link'] = ROOTHOST_WEB.$arr['alias'];
		// $arr2['image'] = $file;
		// $arr2['meta_title'] = $Meta_title;
		// $arr2['meta_key'] = $Meta_title;
		// $arr2['meta_desc'] = $Meta_desc;

		// SysEdit('tbl_seo', $arr2, 'link="'.$seo_link.'"');
		$_SESSION['flash'.'com_'.COMS] = 1;
	}
	else $_SESSION['flash'.'com_'.COMS] = 0;
}

$res_Cate = SysGetList('tbl_event_detail', array(), ' AND id='. $GetID);
if(count($res_Cate) <= 0){
	echo 'Không có dữ liệu.'; 
	return;
}
$row = $res_Cate[0];

$res_events = SysGetList('tbl_event', [], "AND id=".$GetEvent);
if(count($res_events)>0){
	$res_event = $res_events[0];
}
$event_title = isset($res_event) && $res_event['title'] ? $res_event['title'] : '';

// $seo_link = ROOTHOST_WEB.$row['alias'];
// $res_seos = SysGetList('tbl_seo', [], "AND `link`='".$seo_link."'");
// $meta_title = $meta_key = $meta_desc = '';
// if(count($res_seos)){
// 	$res_seo = $res_seos[0];
// 	$meta_title = $res_seo['meta_title'];
// 	$meta_key = $res_seo['meta_key'];
// 	$meta_desc = $res_seo['meta_desc'];
// }
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Cập nhật chi tiết hoạt động</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<?php
					if($GetEvent==0){
						echo '<li class="breadcrumb-item"><a href="'.ROOTHOST.COMS.'">Danh sách tất cả chi tiết hoạt động</a></li>';
					}else{
						echo '<li class="breadcrumb-item"><a href="'.ROOTHOST.COMS.'/'.$GetEvent.'">DS chi tiết hoạt động của: '.$event_title.'</a></li>';
					}
					?>
					<li class="breadcrumb-item active">Cập nhật chi tiết hoạt động</li>
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
				$msg->success('Cập nhật thành công.');
				echo $msg->display();
			}else if($_SESSION['flash'.'com_'.COMS] == 0){
				$msg->error('Có lỗi trong quá trình cập nhật.');
				echo $msg->display();
			}
			unset($_SESSION['flash'.'com_'.COMS]);
		}
		?>
		<div id='action'>
			<div class="card">
				<form name="frm_action" id="frm_action" action="" method="post" enctype="multipart/form-data">
					<!-- <input type="hidden" name="txt_seo_link" value="<?php echo $seo_link;?>"> -->
					<div class="mess"></div>
					<div class="row">
						<div class="col-md-8 col-lg-9">
							<div class="form-group">
								<label>Tiêu đề<font color="red"><font color="red">*</font></font></label>
								<input type="text" id="txt_name" name="txt_name" class="form-control" value="<?php echo $row['title'];?>" placeholder="Tiêu đề">
							</div>

							<div class="form-group">
								<label>Url</label>
								<input type="text" id="txt_url" name="txt_url" value="<?php echo $row['alias'];?>" class="form-control">
							</div>

							<div class="form-group">
								<label>Hoạt động khoa học</label>
								<select id="event_id" name="event_id" class="form-control">
									<?php
									$res_events = SysGetList('tbl_event', [], 'AND isactive=1');
									foreach ($res_events as $key => $value) {
										if($value['id']==$GetEvent){
											echo '<option value="'.$value['id'].'" selected>'.$value['title'].'</<option>';
										}else{
											echo '<option value="'.$value['id'].'">'.$value['title'].'</<option>';
										}
									}
									?>
								</select>
							</div>

							<div class="form-group">
								<label>Nội dung chi tiết</label>
								<textarea class="form-control" id="txt_fulltext" name="txt_fulltext"><?php echo $row['fulltext'];?></textarea>
							</div>
						</div>
						<div class="col-md-4 col-lg-3">
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

							<div class="form-group">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="register" name="register" <?php echo (int)$row['register']==1 ? "checked" : ''?>>
									<label class="form-check-label" for="register">Register</label>
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

		$("#event_id").select2();

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
			height: 500,
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
		var par_id = parseInt($('#cbo_par').val());

		if(title==''){
			alert('Các mục đánh dấu * không được để trống');
			flag = false;
		}
		if(par_id == '<?php echo $GetID?>'){
			flag = false;
			$('.mess').html('Một đối tượng không thể được chọn làm con của chính nó');
		}
		return flag;
	}
</script>