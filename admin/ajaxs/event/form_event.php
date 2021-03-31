<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
$date = isset($_POST['date']) ? trim($_POST['date']) : '';
?>
<br/>
<h3 class='text-center'>Tạo sự kiện</h3>
<div class='ajx_mess' style='color:#f00;'></div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Ngày bắt đầu</label><small class="cred"> (*)</small>
			<input type="date" id="ajx_startdate" name="ajx_startdate" value="<?php echo date('Y-m-d', strtotime($date));?>" class="form-control required" readonly>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Ngày kết thúc</label><small class="cred"> (*)</small>
			<input type="date" id="ajx_enddate" name="ajx_enddate" value="<?php echo date('Y-m-d', strtotime($date));?>" class="form-control required">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Thời gian bắt đầu</label><small class="cred"> (*)</small>
			<input type="time" id="ajx_starttime" name="ajx_starttime" value="" class="form-control required">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Thời gian kết thúc</label><small class="cred"> (*)</small>
			<input type="time" id="ajx_endtime" name="ajx_endtime" value="" class="form-control required">
		</div>
	</div>
</div>

<div class="form-group">
	<label>Tiêu đề sự kiện</label><small class="cred"> (*)</small>
	<textarea class="form-control required" name="ajx_title" id="ajx_title" rows="2"></textarea>
</div>

<div class="form-group">
	<label>Địa điểm diễn ra sự kiện</label><small class="cred"> (*)</small>
	<textarea class="form-control required" name="ajx_address" id="ajx_address" rows="2"></textarea>
</div>

<div class='form-group text-center' >
	<button class='btn btn-primary' id='ajx_btn_create_event'><i class="fas fa-save"></i> Lưu sự kiện</button>
</div>
<script type="text/javascript">
	$('#ajx_btn_create_event').click(function(){
		var data = {},
		ajx_startdate = $('#ajx_startdate').val(),
		ajx_enddate = $('#ajx_enddate').val();

		var start = new Date(ajx_startdate);
		var end = new Date(ajx_enddate);
		var loop = new Date(start);
		while(loop <= end){
			tmp_date = JSON.stringify(loop).slice(1,11);
			tmp_date1 = tmp_date.replaceAll('-','');
			var tmp={},
			inttime = new Date().getTime(),
			tmp_id = tmp_date1+'_'+inttime;
			
			tmp = {
				"id": tmp_id,
				"title": $('#ajx_title').val(),
				"address": $('#ajx_address').val(),
				"start_time": $('#ajx_starttime').val(),
				"end_time": $('#ajx_endtime').val(),
				"date": tmp_date,
			}
			data[tmp_date1] = tmp;

			var newDate = loop.setDate(loop.getDate() + 1);
			loop = new Date(newDate);
		}
		var json_data = JSON.stringify(data);
		
		if(ajx_validForm()){
			append_event_item(json_data);
		}else{
			return '0';
		}
	});

	function ajx_validForm(){
		var ajx_starttime = $('#ajx_starttime').val();
		var ajx_endtime = $('#ajx_endtime').val();
		var time1 = Date.parse(ajx_starttime);
		var time2 = Date.parse(ajx_endtime);

		var ajx_startdate = $('#ajx_startdate').val();
		var ajx_enddate = $('#ajx_enddate').val();
		var date1 = Date.parse(ajx_starttime);
		var date2 = Date.parse(ajx_endtime);

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

		if(time1>time2 || date1>date2){
			$('.ajx_mess').html('Thiết lập thời gian lỗi.');
			flag = false;
		}
		return flag;
	}
</script>