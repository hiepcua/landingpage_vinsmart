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
if($isAdmin!=1 && !in_array(1001, $arr_permission)){
	echo "Bạn không có quyền truy cập chức năng này.";
	exit();
}
/*End check user permission*/

if(isset($_POST['txt_name']) && $_POST['txt_name'] !== '') {
	if(isset($_FILES['txt_thumb']) && $_FILES['txt_thumb']['size'] > 0){
		$save_path 	= MEDIA_HOST."/contents/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/contents/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}

	$arr=array();
	$arr['title'] = isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$arr['alias'] = $_POST['txt_url'] =='' ? un_unicode($arr['title']) : addslashes($_POST['txt_url']);
	$arr['sapo'] = isset($_POST['txt_sapo']) ? addslashes($_POST['txt_sapo']) : '';
	$arr['fulltext'] = isset($_POST['txt_fulltext']) ? addslashes($_POST['txt_fulltext']) : '';
	$arr['cat_id'] = isset($_POST['cbo_cate']) ? (int)$_POST['cbo_cate'] : 0;
	$arr['images'] = $file;
	$arr['pdate'] = isset($_POST['pdate']) ? strtotime($_POST['pdate']) : null;
	$arr['author'] = isset($_POST['author']) && $_POST['author'] != '' ? addslashes($_POST['author']) : getInfo('username');
	$arr['pseudonym'] = getInfo('pseudonym');
	$arr['related_articles'] = isset($_POST['related_articles']) ? json_encode($_POST['related_articles']) : null;
	$arr['tag_ids'] = isset($_POST['tag_ids']) ? json_encode($_POST['tag_ids']) : null;
	$arr['cdate'] = time();
	$result = SysAdd('tbl_content', $arr);

	/* Add history */
	$arr['status'] = 'khởi tạo';
	SysAdd('tbl_content_history', $arr);

	if($result){
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
				<h1 class="m-0 text-dark">Thêm mới tin tức</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS;?>">Danh sách tin tức</a></li>
					<li class="breadcrumb-item active">Thêm mới tin tức</li>
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
							<div class="form-group">
								<label>Tiêu đề<font color="red"><font color="red">*</font></font></label>
								<input type="text" id="txt_name" name="txt_name" class="form-control" value="" placeholder="Tiêu đề tin tức">
							</div>

							<div class="form-group">
								<label>Url</label>
								<input type="text" id="txt_url" name="txt_url" class="form-control">
							</div>

							<div class="form-group">
								<label>Sapo</label>
								<textarea class="form-control" id="txt_sapo" name="txt_sapo" placeholder="Sapo..." rows="3"></textarea>
							</div>
							
							<div class="form-group" id="type_text">
								<label>Nội dung</label>
								<textarea class="form-control" id="txt_fulltext" name="txt_fulltext" placeholder="Nội dung chính..." rows="5"></textarea>
							</div>

							<div class="form-group" id="wg-related_articles">
								<div class="header">
									<div class="d-inline" style="color: #fff;">Tin tức liên quan</div>
									<div class="form-inline pull-right">
										<input type="text" id="ip_search_related_article" class="form-control border-radius0" placeholder="Tên bài viết">&nbsp
										<button type="button" class="btn btn-primary border-radius0" id="btn_search_related_article">Tìm kiếm</button>
									</div>
								</div>
								<div class="wg-body">
									<div class="list-response"></div>
									<div id="wr-related_articles">
										<div>
											<strong class="wg-title">Tin tức liên quan</strong>
											<a href="javascript:void(0)" id="btn_auto_related">Auto</a>
										</div>
										<div id="list_related_articles" class="grid"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Chuyên mục<font color="red">*</font></label>
								<select class="form-control" name="cbo_cate" id="cbo_cate">
									<option value="0">-- Chọn một --</option>
									<?php getListComboboxCategories(0, 0); ?>
								</select>
							</div>

							<div class="form-group">
								<label>Tags</label>
								<select class="form-control" name="tag_ids" id="tag_ids" multiple>
									<?php
									$res_tags = SysGetList('tbl_tag', [], "AND isactive=1");
									if(count($res_tags)>0){
										foreach ($res_tags as $key => $value) {
											echo '<option value="'.$value['id'].'">'.$value['title'].'</option>';
										}
									}
									?>
								</select>
							</div>

							<div class='form-group'>
								<div class="form-group">
									<label>Ngày xuất bản</label>
									<input type="date" id="pdate" name="pdate" class="form-control" value="">
								</div>

								<div class="form-group">
									<label>Tác giả</label>
									<input type="text" id="author" name="author" class="form-control" value="">
								</div>

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
							<button type="submit" id="cmdsave" class="border-radius0 btn blue" data-key="4">Lưu thông tin</button>
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
			return checkinput();
		});

		$('#tag_ids').select2();

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
			selector: '#txt_sapo',
			height: 150,
			plugins: [
			'link lists autolink hr code textcolor'
			],
			toolbar: 'bold italic underline | fontselect fontsizeselect formatselect forecolor backcolor | alignleft aligncenter alignright alignjustify |  numlist bullist | removeformat | insertfile image media link anchor codesample | outdent indent fullscreen',
			contextmenu: 'link image imagetools table spellchecker lists',
			content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
			image_caption: true,
			images_reuse_filename: true,
			images_upload_credentials: true,
			relative_urls : false,
			remove_script_host : false,
			convert_urls : true,
		});
		
		tinymce.init({
			selector: '#txt_fulltext',
			height: 500,
			plugins: [
			'link image imagetools table lists autolink fullscreen media hr code textcolor'
			],
			image_title: true,
			automatic_uploads: true,
			toolbar: 'bold italic underline | fontselect fontsizeselect formatselect forecolor backcolor  | alignleft aligncenter alignright alignjustify |  numlist bullist | removeformat | insertfile image media link anchor codesample | outdent indent fullscreen',
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

		$('#btn_search_related_article').on('click', function(e){
			e.preventDefault();
			var keywork = $('#ip_search_related_article').val();
			if(keywork.length > 2){
				var _url="<?php echo ROOTHOST;?>ajaxs/content/search_content.php";

				$.post(_url, {'keywork': keywork}, function(res){
					$('#wg-related_articles .list-response').html(res);
				});
			}
		});

		$('#btn_auto_related').on('click', function(){
			var cate_id = $('#cbo_cate').val();
			if(parseInt(cate_id)!= '0'){
				var _url="<?php echo ROOTHOST;?>ajaxs/content/auto_related_article.php";

				$.post(_url, {'cate_id': cate_id}, function(res){
					$('#list_related_articles').html(res);
				});
			}else{
				alert('Bạn chưa chuyên mục nào');
			}
		});
	});

	function select_related_article(e){
		var id = e.getAttribute('data-id'),
		title = e.getAttribute('data-title'),
		url_img = e.getAttribute('data-img');

		var str='<div class="article_item w-25">';
		str+='<a href="javascript:void(0)" class="remove_article" onclick="remove_article(this)"><i class="fa fa-window-close" aria-hidden="true"></i></a>';
		str+='<input type="hidden" name="related_articles[]" value="'+id+'">';
		str+='<a class="title" href="javascript:void(0)">';
		str+='<div class="wrap-thumb" data-src="'+url_img+'" style="background-image: url(\''+url_img+'\');">';
		str+='<img src="<?php echo ROOTHOST_WEB;?>global/img/no-photo.jpg" class="" style="display: none;">';
		str+='</div>';
		str+='<div class="name">'+title+'</div>';
		str+='</a>';
		str+='</div>';

		$('#list_related_articles').append(str);
	}

	function remove_article(e){
		e.parentElement.remove();
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
		var cate = parseInt($('#cbo_cate').val());

		if(title=='' || cate==0){
			alert('Các mục đánh dấu * không được để trống');
			flag = false;
		}
		return flag;
	}
</script>