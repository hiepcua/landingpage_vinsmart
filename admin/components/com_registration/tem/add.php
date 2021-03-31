<?php
if(isset($_POST['txt_phone']) && $_POST['txt_phone'] !== '') {
	$arr=array();
	$arr['phone'] 			= isset($_POST['txt_phone']) ? addslashes($_POST['txt_phone']) : '';
	$arr['email'] 			= isset($_POST['txt_email']) ? addslashes($_POST['txt_email']) : '';
	$arr['loai_canho'] 		= isset($_POST['txt_name']) ? json_encode($_POST['loai_canho']) : null;
	$arr['cdate'] 			= time();

	$result = SysAdd('tbl_registration', $arr);
	if($result){
		$_SESSION['flash'.'com_registration_add'] = 1;
		echo "<script language=\"javascript\">window.location.href='".ROOTHOST."registration'</script>";
	}else{
		echo '<script>$(document).ready(function(){$.notify("Lỗi!", "error");})</script>';
	}
}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Thêm đơn đăng ký</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS;?>">Đăng ký</a></li>
					<li class="breadcrumb-item active">Thêm mới đăng ký</li>
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
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Số điện thoại</label><font color="red">*</font>
								<input type="text" id="txt_phone" name="txt_phone" class="form-control" placeholder="Số điện thoại">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Email</label>
								<input type="text" id="txt_email" name="txt_email" class="form-control" placeholder="Email liên hệ">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label>Loại căn hộ</label>
								<div>
									<?php
									foreach ($_LOAI_CANHO as $key => $value) {
										echo '<div class="form-check">
										<input class="form-check-input" type="checkbox" name="loai_canho[]" value="'.$key.'">
										<label class="form-check-label">'.$value.'</label>
										</div>';
									}
									?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="toolbar">
						<div class="widget_control text-center">
							<button type="submit" class="border-radius0 btn blue">Lưu thông tin</button>
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