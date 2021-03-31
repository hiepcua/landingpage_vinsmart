<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');
$id = isset($_POST['id']) ? trim($_POST['id']) : 0;
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$address = isset($_POST['address']) ? trim($_POST['address']) : '';
$start_time = isset($_POST['start_time']) ? trim($_POST['start_time']) : '';
$end_time = isset($_POST['end_time']) ? trim($_POST['end_time']) : '';
$cur_date = isset($_POST['date']) ? trim($_POST['date']) : '';
?>
<br/>
<h3 class='text-center'>Cập nhật sự kiện</h3>
<hr>
<div class='ajx_mess' style='color:#f00;'></div>
<div class="form-group">
	<label>Ngày</label>
	<input type="date" id="ajx_curdate" name="ajx_curdate" value="<?php echo date('Y-m-d', strtotime($cur_date));?>" class="form-control" readonly>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Thời gian bắt đầu</label><small class="cred"> (*)</small>
			<input type="time" id="ajx_starttime" name="ajx_starttime" value="<?php echo date('H:i', strtotime($start_time));?>" class="form-control required">
			<input type="hidden" id="ajx_id" name="ajx_id" value="<?php echo $id;?>" class="form-control">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Thời gian kết thúc</label><small class="cred"> (*)</small>
			<input type="time" id="ajx_endtime" name="ajx_endtime" value="<?php echo date('H:i', strtotime($end_time));?>" class="form-control required">
		</div>
	</div>
</div>

<div class="form-group">
	<label>Tiêu đề sự kiện</label><small class="cred"> (*)</small>
	<textarea class="form-control required" name="ajx_title" id="ajx_title" rows="2"><?php echo $title;?></textarea>
</div>
<div class="form-group">
	<label>Địa điểm diễn ra sự kiện</label><small class="cred"> (*)</small>
	<textarea class="form-control required" name="ajx_address" id="ajx_address" rows="2"><?php echo $address;?></textarea>
</div>

<div class='form-group text-center' >
	<button class='btn btn-primary' id='ajx_btn_update_event'><i class="fas fa-save"></i> Lưu thay đổi</button>
	<button class='btn btn-danger' id='ajx_btn_delete_event'><i class="fas fa-save"></i> Xóa sự kiện</button>
</div>
<script type="text/javascript">
	$('#ajx_btn_update_event').click(function(){
		var ajx_id = $('#ajx_id').val();
		var data = {
			"id": ajx_id,
			"title": $('#ajx_title').val(),
			"address": $('#ajx_address').val(),
			"start_time": $('#ajx_starttime').val(),
			"end_time": $('#ajx_endtime').val(),
			"date": $('#ajx_curdate').val(),
		}

		var json_data = JSON.stringify(data);
		if(ajx_validForm()){
			update_content_event_item(ajx_id ,json_data);
		}else{
			return '0';
		}
	});

	$('#ajx_btn_delete_event').click(function(){
		var ajx_id = $('#ajx_id').val();
		var result = confirm("Bạn có chắc muốn xóa sự kiện này?"); 
		if (result == true) { 
			delete_event_item(ajx_id);
		} else { 
			return '0';
		}
	});

	function ajx_validForm(){
		var ajx_starttime = $('#ajx_starttime').val();
		var ajx_endtime = $('#ajx_endtime').val();
		var time1 = Date.parse(ajx_starttime);
		var time2 = Date.parse(ajx_endtime);
		var flag = true;

        $('#popup_modal .required').each(function(){
	        var val = $(this).val();
	        if(!val || val=='' || val=='0') {
                $(this).parents('.form-group').addClass('error');
                flag = false;
            }

            if(flag==false) {
	            $('.ajx_mess').html('Vui lòng nhập đủ những thông tin bắt buộc.');
	        }
	    });

		if(time1>time2){
			$('.ajx_mess').html('Thiết lập thời gian lỗi.');
			flag = false;
		}
		return flag;
	}
</script>