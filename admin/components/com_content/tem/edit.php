<?php
$msg = new \Plasticbrain\FlashMessages\FlashMessages();
if(!isset($_SESSION['flash'.'com_'.COMS])) $_SESSION['flash'.'com_'.COMS] = 2;
require_once('libs/cls.upload.php');
require_once(PLUGINS_HOST.'finediff/finediff.php');

/*Check user permission*/
$isAdmin = getInfo('isadmin');
$userLogin = getInfo('username');
$res_Users = SysGetList('tbl_users', ['permission'], "AND username='".$userLogin."'");
$res_user = $res_Users[0];
$arr_permission = ($res_user['permission']!==null && $res_user['permission']!='[]' && $res_user['permission']!=='') ? json_decode($res_user['permission']) : [];
if($isAdmin!=1 && !in_array(1002, $arr_permission)){
	echo "Bạn không có quyền truy cập chức năng này.";
	exit();
}
/*End check user permission*/

$obj_upload = new CLS_UPLOAD();
$file=$strWhere='';
$GetID = isset($_GET['id']) ? (int)$_GET["id"] : 0;

function diff($from_text, $to_text)
{
	$granularity = 2;
	$from_text = mb_convert_encoding($from_text, 'HTML-ENTITIES', 'UTF-8');
	$to_text = mb_convert_encoding($to_text, 'HTML-ENTITIES', 'UTF-8');

	$granularityStacks = array(
		FineDiff::$paragraphGranularity,
		FineDiff::$sentenceGranularity,
		FineDiff::$wordGranularity,
		FineDiff::$characterGranularity
	);

	$diff_opcodes = FineDiff::getDiffOpcodes($from_text, $to_text, $granularityStacks[$granularity]);
	$rendered_diff = FineDiff::renderDiffToHTMLFromOpcodes($from_text, $diff_opcodes);
	return $rendered_diff;

    // $diff = new FineDiff($to_text, $to_text, FineDiff::$paragraphGranularity);
    // $html = $diff->renderDiffToHTML();
    // $html = mb_convert_encoding($html, 'UTF-8', 'HTML-ENTITIES');
    // $html = html_entity_decode($html);
    // $html = nl2br($html);
    // return $html;
}

/*Check user permission*/
$user 		= getInfo('username');
$isAdmin 	= getInfo('isadmin');

$test='';
if($isAdmin) $strWhere.=' AND id='. $GetID;
else $strWhere.=' AND `author`="'.$user.'" AND id='. $GetID;

if(isset($_POST['txt_name']) && $_POST['txt_name']!=='') {
	$Images = isset($_POST['txt_thumb2']) ? addslashes($_POST['txt_thumb2']) : '';
	if(isset($_FILES['txt_thumb']) && $_FILES['txt_thumb']['size'] > 0){
		$save_path 	= MEDIA_HOST."/contents/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/contents/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}else{
		$file = $Images;
	}

	$arr = array();
	$arr['title'] = isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$arr['alias'] = isset($_POST['txt_url']) && $_POST['txt_url'] =='' ? un_unicode($arr['title']) : addslashes($_POST['txt_url']);
	$arr['sapo'] = isset($_POST['txt_sapo']) ? addslashes($_POST['txt_sapo']) : '';
	$arr['fulltext'] = isset($_POST['txt_fulltext']) ? addslashes($_POST['txt_fulltext']) : '';
	$arr['cat_id'] = isset($_POST['cbo_cate']) ? (int)$_POST['cbo_cate'] : 0;
	$arr['related_articles'] = isset($_POST['related_articles']) ? json_encode($_POST['related_articles']) : null;
	$arr['tag_ids'] = isset($_POST['tag_ids']) ? json_encode($_POST['tag_ids']) : null;
	$arr['images'] = $file;
	$arr['mdate'] = time();
	$arr['pdate'] = isset($_POST['pdate']) ? strtotime($_POST['pdate']) : null;
	$arr['author'] = isset($_POST['author']) && $_POST['author'] != '' ? addslashes($_POST['author']) : getInfo('username');
	/* History */
	$arr_tmp = array();
	if(strcasecmp($_SESSION['flash_current_content'.$GetID]['title'], $_POST['txt_name']) !== 0){
		$arr_tmp['title'] = diff($_SESSION['flash_current_content'.$GetID]['title'], $arr['title']);
	}
	if(strcasecmp($_SESSION['flash_current_content'.$GetID]['alias'], $_POST['txt_url']) !== 0){
		$arr_tmp['alias'] = diff($_SESSION['flash_current_content'.$GetID]['alias'], $arr['alias']);
	}
	if(strcasecmp($_SESSION['flash_current_content'.$GetID]['sapo'], $_POST['txt_sapo']) !== 0){
		$arr_tmp['sapo'] = diff($_SESSION['flash_current_content'.$GetID]['sapo'], $arr['sapo']);
	}
	if(strcasecmp($_SESSION['flash_current_content'.$GetID]['fulltext'], $_POST['txt_fulltext']) !== 0){
		$arr_tmp['fulltext'] = diff($_SESSION['flash_current_content'.$GetID]['fulltext'], $_POST['txt_fulltext']);
	}
	if(strcasecmp($_SESSION['flash_current_content'.$GetID]['cat_id'], $_POST['cbo_cate']) !== 0){
		$arr_tmp['cat_id'] = diff($_SESSION['flash_current_content'.$GetID]['cat_id'], $arr['cat_id']);
	}

	$json_related_articles_old = stripslashes($_SESSION['flash_current_content'.$GetID]['related_articles']);
	$json_related_articles_new = isset($_POST['related_articles']) ? json_encode($_POST['related_articles']) : null;
	if(strcasecmp($json_related_articles_old, $json_related_articles_new) !== 0){
		$arr_tmp['related_articles'] = diff(json_encode($_SESSION['flash_current_content'.$GetID]['related_articles']), json_encode($arr['related_articles']));
	}

	$json_tag_ids_old = stripslashes($_SESSION['flash_current_content'.$GetID]['tag_ids']);
	$json_tag_ids_new = isset($_POST['tag_ids']) ? json_encode($_POST['tag_ids']) : null;
	if(strcasecmp($json_tag_ids_old, $json_tag_ids_new) !== 0){
		$arr_tmp['tag_ids'] = diff(json_encode($_SESSION['flash_current_content'.$GetID]['tag_ids']), json_encode($arr['tag_ids']));
	}
	if(strcasecmp($_SESSION['flash_current_content'.$GetID]['images'], $file) !== 0){
		$arr_tmp['images'] = diff($_SESSION['flash_current_content'.$GetID]['images'], $file);
	}

	$is_empty = true; //flag
	foreach ($arr_tmp as $key => $value) {
		if ($value != '')
			$is_empty = false;
	}

	if(!$is_empty){
		$arr_tmp['con_id'] = $GetID;
		$arr_tmp['status'] = 'sửa';
		$arr_tmp['title'] = $arr['title'];
		$arr_tmp['cdate'] = time();
		$arr_tmp['author'] = getInfo('username');
		$arr_tmp['author_name'] = getInfo('fullname');
		SysAdd('tbl_content_history', $arr_tmp);
	}
	/* /. History */

	$result = SysEdit('tbl_content', $arr, " id=".$GetID);
	if($result) $_SESSION['flash'.'com_'.COMS] = 1;
	else $_SESSION['flash'.'com_'.COMS] = 0;
}

$res_Cons = SysGetList('tbl_content', array(), $strWhere);
if(count($res_Cons) <= 0){
	echo 'Không có dữ liệu.'; 
	return;
}
$row = $res_Cons[0];
if(count($row)>0){
	$_SESSION['flash_current_content'.$GetID] = $row;
}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Cập nhật tin tức</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS;?>">Danh sách tin tức</a></li>
					<li class="breadcrumb-item active">Cập nhật tin tức</li>
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
					<input type="hidden" name="txtid" value="<?php echo $GetID;?>">
					<div class="row">
						<div class="col-md-9">
							<div  class="form-group">
								<label>Tiêu đề<font color="red"><font color="red">*</font></font></label>
								<input type="text" id="txt_name" name="txt_name" class="form-control" value="<?php echo $row['title']; ?>" placeholder="Tiêu đề tin tức">
							</div>

							<div class="form-group">
								<label>Url</label>
								<input type="text" id="txt_url" name="txt_url" value="<?php echo $row['alias']; ?>" class="form-control">
							</div>

							<div class="form-group">
								<label>Sapo</label>
								<textarea class="form-control" id="txt_sapo" name="txt_sapo" placeholder="Sapo..." rows="3"><?php echo $row['sapo']; ?></textarea>
							</div>
							
							<div class="form-group" id="type_text">
								<label>Nội dung</label>
								<textarea class="form-control" id="txt_fulltext" name="txt_fulltext" placeholder="Nội dung chính..." rows="5"><?php echo $row['fulltext']; ?></textarea>
							</div>

							<div class="form-group" id="wg-related_articles">
								<div class="header">
									<div class="d-inline" style="color: #fff;">Tin tức liên quan</div>
									<div class="form-inline pull-right">
										<input type="text" id="ip_search_related_article" class="form-control border-radius0" placeholder="Tên tin tức">&nbsp
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
										<div id="list_related_articles" class="grid">
											<?php
											$ar_related_articles= $row['related_articles']!==null && $row['related_articles']!=='' ? json_decode($row['related_articles']) : [];
											$str_related_article_id = implode(',', $ar_related_articles);
											$res_related_articles = SysGetList('tbl_content', [], "AND id IN(".$str_related_article_id.")");
											if(count($res_related_articles)>0){
												foreach ($res_related_articles as $key => $value) {
													$images = $value['images']!='' ? $value['images'] : IMAGE_DEFAULT;
													echo '<div class="article_item w-25">';
													echo '<a href="javascript:void(0)" class="remove_article" onclick="remove_article(this)"><i class="fa fa-window-close" aria-hidden="true"></i></a>';
													echo '<input type="hidden" name="related_articles[]" value="'.$value['id'].'">';
													echo '<a class="title" href="javascript:void(0)">';
													echo '<div class="wrap-thumb" data-src="'.$images.'" style="background-image: url(\''.$images.'\');">';
													echo '<img src="'.ROOTHOST.'global/img/no-photo.jpg" class="" style="display: none;">';
													echo '</div>';
													echo '<div class="name">'.$value['title'].'</div>';
													echo '</a>';
													echo '</div>';
												}
											}
											?>
										</div>
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
								<script type="text/javascript">
									$(document).ready(function(){
										cbo_Selected('cbo_cate', <?php echo $row['cat_id']; ?>);
									});
								</script>
							</div>

							<div class="form-group">
								<label>Tags</label>
								<select class="form-control" name="tag_ids[]" id="tag_ids" multiple>
									<?php
									$ar_tag = $row['tag_ids']!== null ? json_decode($row['tag_ids']) : [];
									$res_tags = SysGetList('tbl_tag', [], "AND isactive=1");
									if(count($res_tags)>0){
										foreach ($res_tags as $key => $value) {
											if(in_array($value['id'], $ar_tag)){
												echo '<option value="'.$value['id'].'" selected>'.$value['title'].'</option>';
											}else{
												echo '<option value="'.$value['id'].'">'.$value['title'].'</option>';
											}
										}
									}
									?>
								</select>
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

							<a href="<?php echo ROOTHOST.'?com='.COMS.'&viewtype=history&id='.$row['id'];?>" class="a-history">Lịch sử</a>
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
			height: 350,
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