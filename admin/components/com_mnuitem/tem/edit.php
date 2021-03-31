<?php
$msg = new \Plasticbrain\FlashMessages\FlashMessages();
if(!isset($_SESSION['flash'.'com_'.COMS])) $_SESSION['flash'.'com_'.COMS] = 2;
$get_mnuid = isset($_GET['mnuid']) ? (int)$_GET['mnuid'] : 0;
$GetID = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if(isset($_POST['cmdsave_tab1']) && (int)$_POST['txtid']!=0) {
	$arr=array();
	$arr['par_id'] = isset($_POST['cbo_parid']) ? (int)$_POST['cbo_parid'] : 0;
	$arr['menu_id'] = $get_mnuid;
	$arr['name'] = isset($_POST['txtname']) ? addslashes($_POST['txtname']) : '';
	$arr['code'] = un_unicode($arr['name']);
	$arr['link'] = isset($_POST['txtlink']) ? addslashes($_POST['txtlink']) : '';
	$arr['icon'] = isset($_POST['txticon']) ? addslashes($_POST['txticon']) : '';
	$arr['class'] = isset($_POST['txtclass']) ? addslashes($_POST['txtclass']) : '';
	$arr['isactive'] = isset($_POST['optactive']) ? (int)$_POST['optactive'] : 0;
	$arr['view_type'] = isset($_POST['cbo_viewtype']) ? addslashes($_POST['cbo_viewtype']) : null;
	$arr['selected_id'] = isset($_POST['cbo_selected']) ? (int)$_POST['cbo_selected'] : null;

	$result = SysEdit('tbl_mnuitems', $arr, "id=".$GetID);
	if($result){
		$rs_parent = SysGetList('tbl_mnuitems', array("path"), " AND id=".$arr['par_id']);
		if(count($rs_parent)>0){
			$rs_parent = $rs_parent[0];
			$path = $rs_parent['path'].'_'.$GetID;
		}else{
			$path = $GetID;
		}

		SysEdit('tbl_mnuitems', array('path' => $path), " id=".$GetID);
		$_SESSION['flash'.'com_'.COMS] = 1;
	}else{
		$_SESSION['flash'.'com_'.COMS] = 0;
	}
}

$res_Mnuitems = SysGetList('tbl_mnuitems', array(), ' AND id='. $GetID);
if(count($res_Mnuitems) <= 0){
	echo 'Không có dữ liệu.'; 
	return;
}
$row = $res_Mnuitems[0];

$arr_childs = array();
$res_children = SysGetList('tbl_mnuitems', array('id'), " AND `path` LIKE '".$row['path']."%'");
if(count($res_children) >0){
	foreach ($res_children as $key => $value) {
		$arr_childs[] = $value['id'];
	}
}

$res_menus = SysGetList('tbl_menus', array(), ' AND id='. $row['menu_id']);
$res_menu = $res_menus[0];
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Cập nhật menu item</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS.'/'.$res_menu['id'];?>"><?php echo $res_menu['name'];?></a></li>
					<li class="breadcrumb-item active">Cập nhật menu item</li>
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
		<form id="frm_action" class="" name="frm_action" method="post" action="">
			<p>Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.</p>
			<input type="hidden" name="txtid" value="<?php echo $GetID;?>">
			<div class="row">
				<div class="col-md-9">
					<div class="form-group">
						<label>Loại menu item</label>
						<select name="cbo_viewtype" id="cbo_viewtype" onchange="select_type(this)" class="form-control" style="width: 100%;">
							<option value="0">-- Tùy chọn --</option>
							<option value="link">Link</option>
							<option value="event_group">Danh mục HĐKH</option>
							<option value="categories">Chuyên mục tin tức</option>
							<option value="personnel_group">Chức vụ nhà khoa học</option>
							<option value="publish_group">Danh mục loại xuất bản</option>
							<option value="event">Hoạt động khoa học</option>
							<option value="content">Tin tức</option>
							<option value="publish">Xuất bản</option>
							<option value="personnel">Nhà khoa học</option>
							<option value="bookcase">Tủ sách</option>
							<option value="htmlblock">Html block</option>
							<option value="album">Album</option>
						</select>
						<script type="text/javascript">
							$(document).ready(function() {
								cbo_Selected('cbo_viewtype', '<?php echo $row['view_type'];?>');
								$("#cbo_viewtype").select2();
							});
						</script>
					</div>

					<div class="form-group">
						<label>Danh mục cha</label>
						<select name="cbo_parid" id="cbo_parid" class="form-control" style="width: 100%;">
							<option value="0">Top</option>
							<?php echo getListComboboxMnuitems(0,0, $get_mnuid, $arr_childs); ?>
						</select>
						<script type="text/javascript">
							$(document).ready(function() {
								cbo_Selected('cbo_parid', <?php echo $row['par_id'];?>);
								$("#cbo_parid").select2();
								
							});
						</script>
					</div>

					<div class="form-group">
						<label>Tên<small class="cred"> (*)</small><span id="err_name" class="mes-error"></span></label>
						<input name="txtname" type="text" id="txtname" class="form-control" value="<?php echo $row['name'];?>" placeholder="Tên menu item">
					</div>

					<div id="box_cbo_viewtype">
						<div class="form-group">
							<label>Link album<span id="err_link" class="mes-error"></span></label><small class="cred"> (*)</small>
							<input name="txtlink" type="text" id="txtlink" class="form-control" value="<?php echo $row['link'];?>" placeholder="http://" required />
						</div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label>Biểu tượng (Icon)</label>
						<input type="text" name="txticon" id="txticon" value="<?php echo $row['icon'];?>" class="form-control"/>
					</div>

					<div class="form-group">
						<label>Class</label>
						<input type="text" name="txtclass" id="txtclass" class="form-control" value="<?php echo $row['class'];?>" />
					</div>

					<div class="form-group">
						<label>Hiển thị</label>
						<div>
							<label class="radio-inline"><input type="radio" value="1" name="optactive" <?php if($row['isactive'] == '1') echo 'checked';?>>Có</label>
							<label class="radio-inline"><input type="radio" value="0" name="optactive" <?php if($row['isactive'] == '0') echo 'checked';?>>Không</label>
						</div>
					</div>
				</div>
			</div>

			<div class="text-center toolbar">
				<input type="submit" name="cmdsave_tab1" id="cmdsave" class="save btn btn-success" value="Lưu thông tin" class="btn btn-primary">
			</div>
		</form>
	</div>
</section>
<!-- /.row -->
<!-- /.content-header -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#frm_action').submit(function(){
			return checkinput();
		});

		loadView('<?php echo $row['view_type'];?>', '<?php echo $row['link'];?>', '<?php echo $row['selected_id'];?>');
		function loadView(type, link, selected_id){
			if(type!=='0' && type.length>0){
				var _url="<?php echo ROOTHOST;?>ajaxs/menuitem/view_"+type+".php";
				$.post(_url, {'link': link, 'selected_id': selected_id}, function(res){
					$('#box_cbo_viewtype').html(res);
				});
			}else{
				$('#box_cbo_viewtype').html('<div class="form-group"><label>Link<span id="err_link" class="mes-error"></span></label><small class="cred"> (*)</small><input name="txtlink" type="text" id="txtlink" class="form-control" value="<?php echo $row['link'];?>" placeholder="http://" required /></div>');
			}
		}
	});

	function checkinput(){
		var flag = true;
		var name = $("#txtname").val();
		var link = $("#txtlink").val();

		if(name==""){
			$("#err_name").fadeTo(200,0.1,function(){ 
				$(this).html('Vui lòng nhập tên').fadeTo(900,1);
			});
			return false;
		}

		if(link=="" || link=="http://" ) {
			$("#err_link").fadeTo(200,0.1,function(){ 
				$(this).html('Vui lòng nhập đường dẫn').fadeTo(900,1);
			});
			$("#txtlink").focus();
			return false;
		}
		return true;
	}

	function select_type(e){
		var val = e.value;
		if(val !=='' && val !== '0'){
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
		}else{
			$('#box_cbo_viewtype').html('<div class="form-group"><label>Link<span id="err_link" class="mes-error"></span></label><small class="cred"> (*)</small><input name="txtlink" type="text" id="txtlink" class="form-control" value="" placeholder="http://" required /></div>');
		}
	}
</script>