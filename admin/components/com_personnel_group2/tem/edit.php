<?php
$msg 		= new \Plasticbrain\FlashMessages\FlashMessages();
if(!isset($_SESSION['flash'.'com_'.COMS])) $_SESSION['flash'.'com_'.COMS] = 2;
require_once('libs/cls.upload.php');
$obj_upload = new CLS_UPLOAD();
$file='';
$GetID = isset($_GET['id']) ? (int)$_GET["id"] : 0;

if(isset($_POST['cmdsave_tab1']) && $_POST['txt_name']!='') {
	$Title 			= isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$Url 			= isset($_POST['txt_url']) ? addslashes($_POST['txt_url']) : '';
	$Intro 			= isset($_POST['txt_intro']) ? addslashes($_POST['txt_intro']) : '';
	$Meta_title 	= isset($_POST['meta_title']) ? addslashes($_POST['meta_title']) : '';
	$Meta_desc 		= isset($_POST['meta_desc']) ? addslashes($_POST['meta_desc']) : '';
	$Par_id 		= isset($_POST['cbo_par']) ? (int)$_POST['cbo_par'] : 0;
	$Images 		= isset($_POST['txt_thumb2']) ? addslashes($_POST['txt_thumb2']) : '';
	$seo_link 		= isset($_POST['txt_seo_link']) ? addslashes($_POST['txt_seo_link']) : '';
	$GPerson_code 	= isset($_POST['gpersonnel_code']) ? addslashes($_POST['gpersonnel_code']) : '';

	if(isset($_FILES['txt_thumb']) && $_FILES['txt_thumb']['size'] > 0){
		$save_path 	= "../medias/personnel_group/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/personnel_group/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}else{
		$file = $Images;
	}
	
	$arr=array();
	$rs_parent = SysGetList('tbl_personnel_group2', array("path"), " AND id=".$Par_id);
	if(count($rs_parent)>0){
		$rs_parent = $rs_parent[0];
		$arr['path'] = $rs_parent['path'].'_'.$GetID;
	}else{
		$arr['path'] = $GetID;
	}

	$arr['title'] = $Title;
	$arr['par_id'] = $Par_id;
	$arr['alias'] = $Url=='' ? un_unicode($Title) : $Url;
	$arr['intro'] = $Intro;
	$arr['image'] = $file;
	$arr['code'] = $GPerson_code;

	$result = SysEdit('tbl_personnel_group2', $arr, " id=".$GetID);

	if($result) {
		// $arr2=array();
		// $arr2['title'] = $arr['title'];
		// $arr2['link'] = ROOTHOST_WEB.'nhan-su/'.$arr['alias'];
		// $arr2['image'] = $file;
		// $arr2['meta_title'] = $Meta_title;
		// $arr2['meta_key'] = $Meta_title;
		// $arr2['meta_desc'] = $Meta_desc;

		// SysEdit('tbl_seo', $arr2, 'link="'.$seo_link.'"');
		$_SESSION['flash'.'com_'.COMS] = 1;
	}
	else $_SESSION['flash'.'com_'.COMS] = 0;
}

$res_Cate = SysGetList('tbl_personnel_group2', array(), ' AND id='. $GetID);
if(count($res_Cate) <= 0){
	echo 'Không có dữ liệu.'; 
	return;
}
$row = $res_Cate[0];

$arr_childs = array();
$res_children = SysGetList('tbl_personnel_group2', array('id'), " AND `path` LIKE '".$row['path']."%'");
if(count($res_children) >0){
	foreach ($res_children as $key => $value) {
		$arr_childs[] = $value['id'];
	}
}

$seo_link = ROOTHOST_WEB.'nhan-su/'.$row['alias'];
$res_seos = SysGetList('tbl_seo', [], "AND `link`='".$seo_link."'");
$meta_title = $meta_key = $meta_desc = '';
if(count($res_seos)){
	$res_seo = $res_seos[0];
	$meta_title = $res_seo['meta_title'];
	$meta_key = $res_seo['meta_key'];
	$meta_desc = $res_seo['meta_desc'];
}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Cập nhật nhóm nhân sự</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS;?>">Danh sách nhóm nhân sự</a></li>
					<li class="breadcrumb-item active">Cập nhật nhóm nhân sự</li>
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
					<input type="hidden" name="txt_seo_link" value="<?php echo $seo_link;?>">
					<div class="mess"></div>
					<div class="row">
						<div class="col-md-8 col-lg-9">
							<div class="form-group">
								<label>Tên nhóm nhân sự<font color="red"><font color="red">*</font></font></label>
								<input type="text" id="txt_name" name="txt_name" class="form-control" value="<?php echo $row['title'];?>" placeholder="Tên nhóm nhân sự">
							</div>

							<div class="form-group">
								<label>Url</label>
								<input type="text" id="txt_url" name="txt_url" value="<?php echo $row['alias'];?>" class="form-control">
							</div>

							<div class="form-group">
								<label>Mô tả</label>
								<textarea class="form-control" name="txt_intro" placeholder="Mô tả về nhóm nhân sự..." rows="2"><?php echo $row['intro'];?></textarea>
							</div>

							<div class="form-group">
								<label>Meta title</label>
								<textarea class="form-control" name="meta_title" placeholder="Meta title..." rows="2"><?php echo $meta_title;?></textarea>
							</div>

							<div class="form-group">
								<label>Meta description</label>
								<textarea class="form-control" name="meta_desc" placeholder="Meta description..." rows="3"><?php echo $meta_desc;?></textarea>
							</div>
						</div>

						<div class="col-md-4 col-lg-3">
							<div class="form-group">
								<label>Mã nhóm nhân sự</label><font color="red">*</font>
								<div class="input-group mb-3">
									<input type="text" id="gpersonnel_code" name="gpersonnel_code" value="<?php echo $row['code'];?>" class="form-control" required>
									<div class="input-group-append">
										<span id="auto_gpersonnel_code" class="input-group-text"><i class="fa fa-random" aria-hidden="true"></i></span>
									</div>
								</div>
							</div>

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

		$('#auto_gpersonnel_code').on('click', function(){
			$.get('<?php echo ROOTHOST;?>ajaxs/random_persionnel_code.php', function(res){
				if(parseInt(res)!=0){
					$('#gpersonnel_code').val(res);
				}else{
					$('#gpersonnel_code').val('error!');
				}
			});
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
		var code = $('#gpersonnel_code').val();

		if(title==''){
			alert('Các mục đánh dấu * không được để trống');
			flag = false;
		}
		if(code==''){
			alert('Mã nhóm nhân sự không được để trống');
			flag = false;
		}
		return flag;
	}
</script>