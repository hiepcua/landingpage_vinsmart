<?php
$msg 		= new \Plasticbrain\FlashMessages\FlashMessages();
if(!isset($_SESSION['flash'.'com_'.COMS])) $_SESSION['flash'.'com_'.COMS] = 2;
require_once('libs/cls.upload.php');
$obj_upload = new CLS_UPLOAD();
$file=$strWhere='';
$GetID = isset($_GET['id']) ? (int)$_GET["id"] : 0;

/*Check user permission*/
$isAdmin = getInfo('isadmin');
if($isAdmin) $strWhere.=' AND id='. $GetID;
else $strWhere.=' AND `author_cms`="'.$user.'" AND id='. $GetID;

if(isset($_POST['txt_phone']) && $_POST['txt_phone']!=='') {
	$arr=array();
	$arr['phone'] 			= isset($_POST['txt_phone']) ? addslashes($_POST['txt_phone']) : '';
	$arr['email'] 			= isset($_POST['txt_email']) ? addslashes($_POST['txt_email']) : '';
	$arr['loai_canho'] 		= isset($_POST['loai_canho']) ? json_encode($_POST['loai_canho']) : null;
	$arr['cdate'] 			= time();

	$result = SysEdit('tbl_registration', $arr, "id=".$GetID);
	if($result){
		$_SESSION['flash'.'com_registration_add'] = 2;
		echo "<script language=\"javascript\">window.location.href='".ROOTHOST."registration'</script>";
	}else{
		echo '<script>$(document).ready(function(){$.notify("Lỗi!", "error");})</script>';
	}
}

$res_Cons = SysGetList('tbl_registration', array(), $strWhere);
if(count($res_Cons) <= 0){
	echo 'Không có dữ liệu.'; 
	return;
}
$row = $res_Cons[0];
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Cập nhật đơn đăng ký</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS;?>">Đăng ký</a></li>
					<li class="breadcrumb-item active">Cập nhật đăng ký</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div> 
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div id='action'>
			<div class="card">
				<form name="frm_action" id="frm_action" action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="txtid" value="<?php echo $GetID;?>">
					<input type="hidden" id="txt_status" name="txt_status" value="">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Số điện thoại</label><font color="red">*</font>
								<input type="text" id="txt_phone" name="txt_phone" class="form-control" value="<?php echo $row['phone'];?>" placeholder="Số điện thoại">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Email</label>
								<input type="text" id="txt_email" name="txt_email" class="form-control" value="<?php echo $row['email'];?>" placeholder="Email liên hệ">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label>Loại căn hộ</label>
								<div>
									<?php
									$arr_loai_canho = isset($row['loai_canho']) && is_array(json_decode($row['loai_canho'])) ? json_decode($row['loai_canho']) : array();

									if(count($arr_loai_canho)>0){
										foreach ($_LOAI_CANHO as $key => $value) {
											$select='';
											if(in_array($key, $arr_loai_canho)) $select='checked';
											echo '<div class="form-check">
											<input class="form-check-input" type="checkbox" name="loai_canho[]" value="'.$key.'" '.$select.'>
											<label class="form-check-label">'.$value.'</label>
											</div>';
										}
									}else{
										foreach ($_LOAI_CANHO as $key => $value) {
											echo '<div class="form-check">
											<input class="form-check-input" type="checkbox" name="loai_canho[]" value="'.$key.'">
											<label class="form-check-label">'.$value.'</label>
											</div>';
										}
									}
									?>
								</div>
							</div>
						</div>
					</div>

					<div class="toolbar">
						<div class="widget_control text-center">
							<input type="submit" name="cmdsave_tab1" id="cmdsave_tab1" class="border-radius0 btn btn-success" value="Lưu thay đổi" class="border-radius0 btn btn-primary">&nbsp&nbsp&nbsp
							<a href="<?php echo ROOTHOST.COMS;?>" title="" class="border-radius0 btn btn-default">Quay lại</a>
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
		$('#frm_action').submit(function(){
			return validForm();
		});
	});

	function validForm(){
		var flag = true;
		var phone = $('#txt_phone').val();

		if(phone==''){
			alert('Các mục đánh dấu * không được để trống');
			flag = false;
		}
		return flag;
	}
</script>