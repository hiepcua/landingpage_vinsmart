<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');

function getListComboboxMnuitems($parid=0, $level=0, $menu_id='', $childs=array()){
	if($menu_id!=''){
		$sql="SELECT * FROM tbl_mnuitems WHERE `par_id`='$parid' AND menu_id=$menu_id AND `isactive`='1'";
	}else{
		$sql="SELECT * FROM tbl_mnuitems WHERE `par_id`='$parid' AND `isactive`='1'";
	}

	$objdata=new CLS_MYSQL();
	$objdata->Query($sql);
	$char="";
	if($level!=0){
		for($i=0;$i<$level;$i++)
			$char.="|-----";
	}
	if($objdata->Num_rows()<=0) return;
	while($rows=$objdata->Fetch_Assoc()){
		$id=$rows['id'];
		$parid=$rows['par_id'];
		$title=$rows['name'];
		if(in_array($id, $childs)){
			echo "<option value='$id' disabled='true' class='disabled'>$char $title</option>";
		}else{
			echo "<option value='$id'>$char $title</option>";
		}
		$nextlevel=$level+1;
		getListComboboxMnuitems($id, $nextlevel, $menu_id, $childs);
	}
}
?>
<script type="text/javascript">
	function select_type(e){
		var val = e.value;
		var _url="<?php echo ROOTHOST;?>ajaxs/menuitem/view_"+val+".php";
		$.ajax({
			url: _url,
			type: 'POST',
			success: function (data) {
				$('#box_cbo_viewtype').html(data);
			},
			cache: false,
			contentType: false,
			processData: false
		});
	}
</script>
<br/>
<div class='ajx_mess' style='color:#f00;'></div>
<form name="frm_action" id="frm_action" action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Loại menu item</label><font color="red">*</font>
		<select name="cbo_viewtype" id="cbo_viewtype" onchange="select_type(this)" class="form-control" style="width: 100%;" required>
			<option value="0">-- Tùy chọn --</option>
			<option value="event_group">Danh mục HĐKH</option>
			<option value="categories">Chuyên mục tin tức</option>
			<option value="personnel_group">Chức vụ nhà khoa học</option>
			<option value="publish_group">Danh mục loại xuất bản</option>
			<option value="event">Hoạt động khoa học</option>
			<option value="content">Tin tức</option>
			<option value="publish">Xuất bản</option>
			<option value="personnel">Nhà khoa học</option>
			<option value="bookcase">Tủ sách</option>
			<option value="album">Album</option>
		</select>
	</div>

	<div class="form-group">
		<label>Danh mục cha</label>
		<select name="cbo_parid" id="cbo_parid" class="form-control" style="width: 100%;">
			<option value="0">-- Top --</option>
			<?php echo getListComboboxMnuitems(0,0, $get_mnuid); ?>
		</select>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#cbo_parid").select2();
			});
		</script>
	</div>

	<div class="form-group">
		<label>Tên </label><font color="red">*</font>
		<input type="text" id="txt_name" name="txt_name" class="form-control" value="" placeholder="Tên menu" required>
	</div>

	<div id="box_cbo_viewtype">
		<div class="form-group">
			<label>Link<span id="err_link" class="mes-error"></span></label><small class="cred"> (*)</small>
			<input name="txtlink" type="text" id="txtlink" class="form-control" value="" placeholder="http://" required />
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Biểu tượng (Icon)</label>
				<input type="text" name="txticon" id="txticon" class="form-control"/>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Class</label>
				<input type="text" name="txtclass" id="txtclass" class="form-control"/>
			</div>
		</div>
	</div>
	<div class="text-center toolbar">
		<input type="submit" name="cmdsave_tab" id="cmdsave_tab" class="save btn btn-success" value="Lưu thông tin" class="btn btn-primary">
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$("form#frm_action").submit(function(e) {
			if(validForm()){
				e.preventDefault();    
				var formData = new FormData(this);

				var _url="<?php echo ROOTHOST;?>ajaxs/menu/process_add.php";
				$.ajax({
					url: _url,
					type: 'POST',
					data: formData,
					success: function (data) {
						if(parseInt(data) == 1){
							window.location.reload();
						}else{
							alert('Lỗi!')
						}
					},
					cache: false,
					contentType: false,
					processData: false
				});
			}else{
				e.preventDefault();
			}
		});
	});

	function validForm(){
		var flag = true;
		var title = $('#txt_name').val();

		if(title==''){
			alert('Các mục đánh dấu * không được để trống');
			flag = false;
		}
		return flag;
	}
</script>