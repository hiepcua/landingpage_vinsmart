<?php
$msg 		= new \Plasticbrain\FlashMessages\FlashMessages();
if(!isset($_SESSION['flash'.'com_'.COMS])) $_SESSION['flash'.'com_'.COMS] = 2;
require_once('libs/cls.upload.php');
$obj_upload = new CLS_UPLOAD();
$file='';

if(isset($_POST['cmdsave_tab1']) && $_POST['txt_name']!='') {
	$Url = isset($_POST['txt_url']) ? addslashes($_POST['txt_url']) : '';
	if(isset($_FILES['txt_thumb']) && $_FILES['txt_thumb']['size'] > 0){
		$save_path 	= "../medias/team/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/team/'.$obj_upload->UploadFile("txt_thumb", $save_path);
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

	$result = SysAdd('tbl_team', $arr);
	if($result){
		// $arr2=array();
		// $arr2['title'] = $arr['title'];
		// $arr2['link'] = ROOTHOST_WEB.'nhan-su/'.$arr['alias'];
		// $arr2['image'] = $file;
		// $arr2['meta_title'] = isset($_POST['meta_title']) ? addslashes($_POST['meta_title']) : $arr['title'];
		// $arr2['meta_key'] = isset($_POST['meta_title']) ? addslashes($_POST['meta_title']) : $arr['title'];
		// $arr2['meta_desc'] = isset($_POST['meta_desc']) ? addslashes($_POST['meta_desc']) : $arr['title'];

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
				<h1 class="m-0 text-dark">Thêm mới nhóm nghiên cứu viên</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS;?>">Danh sách nhóm nghiên cứu viên</a></li>
					<li class="breadcrumb-item active">Thêm mới nhóm nghiên cứu viên</li>
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
								<label>Tên<font color="red"><font color="red">*</font></font></label>
								<input type="text" id="txt_name" name="txt_name" class="form-control" value="" placeholder="Tên nhóm nghiên cứu viên">
							</div>

							<div class="form-group">
								<label>Url</label>
								<input type="text" id="txt_url" name="txt_url" class="form-control">
							</div>

							<div class="form-group">
								<label>Ngày bắt đầu</label>
								<input type="date" id="start_date" name="start_date" class="form-control">
							</div>

							<div class="form-group">
								<label>Ngày kết thúc</label>
								<input type="date" id="end_date" name="end_date" class="form-control">
							</div>

							<div class="form-group">
								<label>Meta title</label>
								<textarea class="form-control" name="meta_title" placeholder="Meta title..." rows="2"></textarea>
							</div>

							<div class="form-group">
								<label>Meta description</label>
								<textarea class="form-control" name="meta_desc" placeholder="Meta description..." rows="3"></textarea>
							</div>
						</div>

						<div class="col-md-4 col-lg-3">
							<div class="form-group">
								<label>Mã nhóm NCV</label><font color="red">*</font>
								<div class="input-group mb-3">
									<input type="text" id="team_code" name="team_code" class="form-control" required>
									<div class="input-group-append">
										<span id="auto_team_code" class="input-group-text"><i class="fa fa-random" aria-hidden="true"></i></span>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label>Nhân sự</label>
								<textarea id="personnel" name="personnel" style="display: none;"></textarea>
								<div id="list_personnel"></div>
								<div><span class="btn btn-primary" id="add_personnel"><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm nhân sự</span></div>
							</div>

							<div class="form-group">
								<label>Css class</label>
								<input type="text" id="cssclass" name="cssclass" class="form-control">
							</div>

							<div class='form-group'>
								<div class="widget-fileupload fileupload fileupload-new" data-provides="fileupload">
									<label>Ảnh</label><small> (Dung lượng < 10MB)</small>
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

		$('#auto_team_code').on('click', function(){
			$.get('<?php echo ROOTHOST;?>ajaxs/random_persionnel_code.php', function(res){
				if(parseInt(res)!=0){
					$('#team_code').val(res);
				}else{
					$('#team_code').val('error!');
				}
			});
		});

		$('#add_personnel').on('click', function(){
			var _url="<?php echo ROOTHOST;?>ajaxs/team/list_personnel.php";

			$.post(_url, function(req){
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

	function convertDateToInt(dateStr) {
		return new Date(dateStr).getTime();
	};

	function validForm(){
		var flag = true;
		var title = $('#txt_name').val();
		var stime = $('#start_date').val();
		var etime = $('#end_date').val();
		var int_stime = convertDateToInt(stime);
		var int_etime = convertDateToInt(etime);
		var code = $('#team_code').val();

		if(title=='' || stime=='' || etime=='' || code==''){
			alert('Các mục đánh dấu * không được để trống');
			flag = false;
		}

		if(parseInt(int_stime) > parseInt(int_etime)){
			alert('Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc');
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