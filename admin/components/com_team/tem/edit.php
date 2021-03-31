<?php
$msg 		= new \Plasticbrain\FlashMessages\FlashMessages();
if(!isset($_SESSION['flash'.'com_'.COMS])) $_SESSION['flash'.'com_'.COMS] = 2;
require_once('libs/cls.upload.php');
$obj_upload = new CLS_UPLOAD();
$file='';
$GetID = isset($_GET['id']) ? (int)$_GET["id"] : 0;

if(isset($_POST['cmdsave_tab1']) && $_POST['txt_name']!='') {
	$Url 			= isset($_POST['txt_url']) ? addslashes($_POST['txt_url']) : '';
	$seo_link 		= isset($_POST['txt_seo_link']) ? addslashes($_POST['txt_seo_link']) : '';
	$Images 		= isset($_POST['txt_thumb2']) ? addslashes($_POST['txt_thumb2']) : '';

	if(isset($_FILES['txt_thumb']) && $_FILES['txt_thumb']['size'] > 0){
		$save_path 	= "../medias/personnel_group/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/personnel_group/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}else{
		$file = $Images;
	}
	
	$arr=array();
	$arr['title'] = isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$arr['alias'] = $Url=='' ? un_unicode($arr['title']) : $Url;
	$arr['start_date'] = isset($_POST['start_date']) ? strtotime($_POST['start_date']) : '';
	$arr['end_date'] = isset($_POST['start_date']) ? strtotime($_POST['start_date']) : '';
	$arr['image'] = $file;
	$arr['cssclass'] = isset($_POST['cssclass']) ? addslashes($_POST['cssclass']) : '';
	$arr['personnel'] 	= isset($_POST['personnel']) ? addslashes($_POST['personnel']) : '';
	$arr['code'] 	= isset($_POST['team_code']) ? addslashes($_POST['team_code']) : '';

	$result = SysEdit('tbl_team', $arr, " id=".$GetID);

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

$res_Cate = SysGetList('tbl_team', array(), ' AND id='. $GetID);
if(count($res_Cate) <= 0){
	echo 'Không có dữ liệu.'; 
	return;
}
$row = $res_Cate[0];

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
				<h1 class="m-0 text-dark">Cập nhật nhóm nghiên cứu viên</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS;?>">Danh sách nhóm nghiên cứu viên</a></li>
					<li class="breadcrumb-item active">Cập nhật nhóm nghiên cứu viên</li>
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
								<label>Tên nhóm nghiên cứu viên<font color="red"><font color="red">*</font></font></label>
								<input type="text" id="txt_name" name="txt_name" class="form-control" value="<?php echo $row['title'];?>" placeholder="Tên nhóm nghiên cứu viên">
							</div>

							<div class="form-group">
								<label>Url</label>
								<input type="text" id="txt_url" name="txt_url" value="<?php echo $row['alias'];?>" class="form-control">
							</div>

							<div class="form-group">
								<label>Ngày bắt đầu</label>
								<input type="date" id="start_date" name="start_date" value="<?php echo date('Y-m-d', $row['start_date']);?>" class="form-control">
							</div>

							<div class="form-group">
								<label>Ngày kết thúc</label>
								<input type="date" id="end_date" name="end_date" value="<?php echo date('Y-m-d', $row['start_date']);?>" class="form-control">
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
								<label>Mã nhóm NCV</label><font color="red">*</font>
								<div class="input-group mb-3">
									<input type="text" id="team_code" name="team_code" value="<?php echo $row['code'];?>" class="form-control" required>
									<div class="input-group-append">
										<span id="auto_team_code" class="input-group-text"><i class="fa fa-random" aria-hidden="true"></i></span>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label>Nhân sự</label>
								<textarea id="personnel" name="personnel" style="display: none;"><?php echo $row['personnel'];?></textarea>
								<div id="list_personnel">
									<?php
									$ar_personnel_ids = explode(',', $row['personnel']);
									$res_personnels = SysGetList('tbl_personnel', [], 'AND isactive=1 ORDER BY `name` ASC');
									foreach ($res_personnels as $key => $value) {
										if(in_array($value['id'], $ar_personnel_ids)){
											echo '<span class="personnel_item" data-id="'.$value['id'].'">'.$value['name'].' <i class="fa fa-times" onclick="remove_personnel(this)" aria-hidden="true"></i></span>';
										}
									}
									?>
								</div>
								<div><span class="btn btn-primary" id="add_personnel"><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm nhân sự</span></div>
							</div>

							<div class="form-group">
								<label>Css class</label>
								<input type="text" id="cssclass" name="cssclass" value="<?php echo $row['cssclass'];?>" class="form-control">
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

		$('#auto_team_code').on('click', function(){
			$.get('<?php echo ROOTHOST;?>ajaxs/random_persionnel_code.php', function(res){
				if(parseInt(res)!=0){
					$('#team_code').val(res);
				}else{
					$('#team_code').val('error!');
				}
			});
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

		$('#add_personnel').on('click', function(){
			var _url="<?php echo ROOTHOST;?>ajaxs/team/list_personnel.php";
			var ids=[];
			if($('.personnel_item')){
				$('.personnel_item').each(function(){
					var id=$(this).attr('data-id');
					ids.push(id);
				});
			}

			$.post(_url, {'ids': ids}, function(req){
				$('#popup_modal .modal-dialog').addClass('modal-xl');
				$('#popup_modal .modal-body').html(req);
				$('#popup_modal').modal('show');
			});
		});
	});

	function append_personnel(data){
		var ids=[];
		var lg = data.length;
		var str='';

		if($('.personnel_item')){
			$('.personnel_item').each(function(){
				var id=$(this).attr('data-id');
				ids.push(id);
			});
		}

		if(lg>0){
			for(var i=0; i< lg; i++){
				var val = data[i];
				if(!ids.includes(val.id)){
					str+='<span class="personnel_item" data-id="'+val.id+'">'+val.name+' <i class="fa fa-times" onclick="remove_personnel(this)" aria-hidden="true"></i></span>';
				}
			}
		}
		$('#list_personnel').append(str);
		close_model();
	}

	function close_model(){
		$('#popup_modal').modal('hide');
		$('#popup_modal .modal-dialog').removeClass('modal-xl');
	}

	function remove_personnel(e){
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

	function validForm(){
		var flag = true;
		var title = $('#txt_name').val();
		var code = $('#team_code').val();

		if(title=='' || code==''){
			alert('Các mục đánh dấu * không được để trống');
			flag = false;
		}

		var ids=[];
		if($('.personnel_item')){
			$('.personnel_item').each(function(){
				var id=$(this).attr('data-id');
				ids.push(id);
			});

			$('#personnel').val(ids);
		}

		return flag;
	}
</script>