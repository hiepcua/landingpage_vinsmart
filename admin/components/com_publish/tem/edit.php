<?php
include 'modules/toolbar.php';
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
if($isAdmin!=1 && !in_array(10002, $arr_permission)){
	echo "Bạn không có quyền truy cập chức năng này.";
	exit();
}
/*End check user permission*/

$obj_upload = new CLS_UPLOAD();
$file=$strWhere='';
$GetID = isset($_GET['id']) ? (int)$_GET["id"] : 0;

function diff($from_text, $to_text){
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
}


if(isset($_POST['txtid']) && (int)$_POST['txtid']!==0) {
	$Images = isset($_POST['txt_thumb2']) ? addslashes($_POST['txt_thumb2']) : '';
	if(isset($_FILES['txt_thumb']) && $_FILES['txt_thumb']['size'] > 0){
		$save_path = MEDIA_HOST."/publish/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/publish/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}else{
		$file = $Images;
	}

	$arr=array();
	$arr['group_code'] = isset($_POST['group_code']) ? addslashes($_POST['group_code']) : null;
	$arr['title'] = isset($_POST['title']) ? addslashes($_POST['title']) : null;
	$arr['title2'] = isset($_POST['title2']) ? addslashes($_POST['title2']) : null;
	$arr['alias'] = isset($_POST['txt_url']) ? addslashes($_POST['txt_url']) : un_unicode($arr['title']);
	$arr['file'] = null;
	$arr['file_path'] = isset($_POST['file_path']) ? addslashes($_POST['file_path']) : null;
	$arr['intro'] = isset($_POST['intro']) ? addslashes($_POST['intro']) : null;
	$arr['fulltext'] = isset($_POST['fulltext']) ? addslashes($_POST['fulltext']) : null;
	$arr['image'] = $file;
	$arr['is_pre_publication'] = isset($_POST['is_pre_publication']) ? (int)$_POST['is_pre_publication'] : null;
	$arr['pre_publication'] = isset($_POST['pre_publication']) ? json_encode($_POST['pre_publication']) : null;
	$arr['personnel'] = isset($_POST['personnel']) ? json_encode($_POST['personnel']) : null;
	$arr['author'] = isset($_POST['author']) ? addslashes($_POST['author']) : null;
	$arr['author_pre_publication'] = isset($_POST['author_pre_publication']) ? addslashes($_POST['author_pre_publication']) : null;
	$arr['author_cms'] = getInfo('username');
	$arr['pdate'] = isset($_POST['pdate']) ? strtotime($_POST['pdate']) : null;
	$arr['year'] = isset($_POST['pdate']) ? date("Y", strtotime($_POST['pdate'])) : null;
	$arr['mdate'] = time();

	/* History */
	$arr_tmp = array();
	if(isset($_POST['group_code']) && strcasecmp($_SESSION['flash_current_publish'.$GetID]['group_code'], $_POST['group_code']) !== 0){
		$arr_tmp['title'] = diff($_SESSION['flash_current_publish'.$GetID]['title'], $_POST['title']);
	}
	if(isset($_POST['title']) && strcasecmp($_SESSION['flash_current_publish'.$GetID]['title'], $_POST['title']) !== 0){
		$arr_tmp['title'] = diff($_SESSION['flash_current_publish'.$GetID]['title'], $_POST['title']);
	}
	if(isset($_POST['title2']) && strcasecmp($_SESSION['flash_current_publish'.$GetID]['title2'], $_POST['title2']) !== 0){
		$arr_tmp['title2'] = diff($_SESSION['flash_current_publish'.$GetID]['title2'], $_POST['title2']);
	}
	if(strcasecmp($_SESSION['flash_current_publish'.$GetID]['alias'], $_POST['txt_url']) !== 0){
		$arr_tmp['alias'] = diff($_SESSION['flash_current_publish'.$GetID]['alias'], $arr['alias']);
	}
	if(isset($_POST['file_path']) && strcasecmp($_SESSION['flash_current_publish'.$GetID]['file_path'], $_POST['file_path']) !== 0){
		$arr_tmp['file_path'] = diff($_SESSION['flash_current_publish'.$GetID]['file_path'], $arr['file_path']);
	}
	if(isset($_POST['intro']) && strcasecmp($_SESSION['flash_current_publish'.$GetID]['intro'], $_POST['intro']) !== 0){
		$arr_tmp['intro'] = diff($_SESSION['flash_current_publish'.$GetID]['intro'], $_POST['intro']);
	}
	if(isset($_POST['txt_fulltext']) && strcasecmp($_SESSION['flash_current_publish'.$GetID]['fulltext'], $_POST['txt_fulltext']) !== 0){
		$arr_tmp['fulltext'] = diff($_SESSION['flash_current_publish'.$GetID]['fulltext'], $_POST['txt_fulltext']);
	}
	if(isset($_POST['is_pre_publication']) && strcasecmp($_SESSION['flash_current_publish'.$GetID]['is_pre_publication'], $_POST['is_pre_publication']) !== 0){
		$arr_tmp['is_pre_publication'] = diff($_SESSION['flash_current_publish'.$GetID]['is_pre_publication'], $_POST['is_pre_publication']);
	}
	if(strcasecmp($_SESSION['flash_current_publish'.$GetID]['image'], $file) !== 0){
		$arr_tmp['image'] = diff($_SESSION['flash_current_publish'.$GetID]['image'], $file);
	}

	if(isset($_POST['author']) && strcasecmp($_SESSION['flash_current_publish'.$GetID]['author'], $_POST['author']) !== 0){
		$arr_tmp['author'] = diff($_SESSION['flash_current_publish'.$GetID]['author'], $_POST['author']);
	}
	if(isset($_POST['author_pre_publication']) && strcasecmp($_SESSION['flash_current_publish'.$GetID]['author_pre_publication'], $_POST['author_pre_publication']) !== 0){
		$arr_tmp['author'] = diff($_SESSION['flash_current_publish'.$GetID]['author_pre_publication'], $_POST['author_pre_publication']);
	}

	$json_personnel_old = stripslashes($_SESSION['flash_current_publish'.$GetID]['personnel']);
	$json_personnel_new = isset($_POST['personnel']) ? json_encode($_POST['personnel']) : '';
	if(strcasecmp($json_personnel_old, $json_personnel_new) !== 0){
		$arr_tmp['personnel'] = diff(json_encode($_SESSION['flash_current_publish'.$GetID]['personnel']), json_encode($arr['personnel']));
	}

	$json_pre_publication_old = stripslashes($_SESSION['flash_current_publish'.$GetID]['pre_publication']);
	$json_pre_publication_new = isset($_POST['pre_publication']) ? json_encode($_POST['pre_publication']) : '';
	if(strcasecmp($json_pre_publication_old, $json_pre_publication_new) !== 0){
		$arr_tmp['pre_publication'] = diff(json_encode($_SESSION['flash_current_publish'.$GetID]['pre_publication']), json_encode($arr['pre_publication']));
	}

	$is_empty = true; //flag
	foreach ($arr_tmp as $key => $value) {
		if ($value != '')
			$is_empty = false;
	}

	if(!$is_empty){
		$arr_tmp['publish_id'] = $GetID;
		$arr_tmp['status'] = 'sửa';
		$arr_tmp['title'] = $arr['title'];
		$arr_tmp['cdate'] = time();
		$arr_tmp['author_cms'] = getInfo('username');
		$arr_tmp['author_cms_name'] = getInfo('fullname');
		SysAdd('tbl_publish_history', $arr_tmp);
	}
	/* /. History */

	$result = SysEdit('tbl_publish', $arr, " id=".$GetID);

	if($result) $_SESSION['flash'.'com_'.COMS] = 1;
	else $_SESSION['flash'.'com_'.COMS] = 0;
}

$res_Cons = SysGetList('tbl_publish', array(), "AND id=".$GetID);
if(count($res_Cons) <= 0){
	echo 'Không có dữ liệu.'; 
	return;
}
$row = $res_Cons[0];
if(count($row)>0){
	$_SESSION['flash_current_publish'.$GetID] = $row;
}

if(isset($_POST["txt_type"])){
    $viewtype = $_POST["txt_type"];
}else{
    $viewtype = $row["group_code"];
}
$thumbnail = getThumb($row['image'], 'thumbnail', '');
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Cập nhật xuất bản</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS;?>">Danh sách xuất bản</a></li>
					<li class="breadcrumb-item active">Cập nhật xuất bản</li>
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
				<form id="frm_type" name="frm_type" method="post" action="" style="display:none;">
					<input type="text" name="txt_type" id="txt_type" />
				</form>
				<div>Chú ý: Lựa chọn loại xuất bản trước khi điền các thông tin chi tiết.</div>
				<form name="frm_action" id="frm_action" action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="txtid" value="<?php echo $GetID;?>">
					<div class="form-group">
						<label>Loại xuất bản </label><font color="red">*</font>
						<select class="form-control" id="group_code" name="group_code" onchange="select_publish_group();" required>
							<option>-- Chọn một --</option>
							<?php getListComboboxCategories(0,0,[]);?>
						</select>
						<script type="text/javascript">
							$(document).ready(function(){
								cbo_Selected('group_code','<?php echo $viewtype;?>');
							});
						</script>
					</div>

					<div class="form-group">
						<label>Tiêu đề/ tên tài liệu </label><font color="red">*</font>
						<input type="text" id="title" name="title" class="form-control" value="<?php echo $row['title'];?>">
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Url</label>
								<input type="text" id="txt_url" name="txt_url" class="form-control" value="<?php echo $row['alias'];?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Ảnh đại diện</label>
								<input type="file" id="txt_thumb" name="txt_thumb" class="form-control">
								<input type="hidden" id="txt_thumb2" name="txt_thumb2" class="form-control" value="<?php echo $row['image'];?>">
								<div id="show-img" class="widget-thumbnail wrap_thumb80 mt-2">
									<?php echo $thumbnail;?>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div id="frm_body"></div>
					<a href="<?php echo ROOTHOST.'?com='.COMS.'&viewtype=history&id='.$row['id'];?>" target="_blank" class="a-history">Lịch sử chỉnh sửa</a>
					<div class="toolbar">
						<div class="widget_control text-center"><input type="submit" name="cmdsave_tab1" id="cmdsave" class="border-radius0 btn btn-success" value="Cập nhật thông tin" class="border-radius0 btn btn-primary"></div>
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

		loadView('<?php echo $viewtype;?>', <?php echo json_encode($row);?>);

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

		$("input#txt_thumb").change(function(e) {
			for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
				var file = e.originalEvent.srcElement.files[i];
				var img = document.createElement("img");
				img.className = 'thumb80';
				var reader = new FileReader();
				reader.onloadend = function() {
					img.src = reader.result;
				}
				reader.readAsDataURL(file);
				$('#show-img').addClass('show-img');
				$('#show-img').html(img);
			}
		});

		tinymce.init({
			selector: '#fulltext',
			height: 300,
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

	function loadView(type, data){
		var jsonString = JSON.stringify(data);
		$.ajax({
	        type: "POST",
	        url: "<?php echo ROOTHOST;?>ajaxs/publish/form_"+type+".php",
	        data: {
	        	'data': jsonString
	        }, 
	        cache: false,

	        success: function(req){
	            $('#frm_body').html(req);
	        }
	    });
	}

	function select_publish_group(){
        var txt_viewtype=document.getElementById("txt_type");
        var cbo_viewtype=document.getElementById("group_code");
        for(i=0;i<cbo_viewtype.length;i++){
            if(cbo_viewtype[i].selected==true)
                txt_viewtype.value=cbo_viewtype[i].value;
        }
        document.frm_type.submit();
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