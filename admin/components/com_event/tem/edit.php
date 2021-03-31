<?php
include 'modules/toolbar.php';
$msg = new \Plasticbrain\FlashMessages\FlashMessages();
if(!isset($_SESSION['flash'.'com_'.COMS])) $_SESSION['flash'.'com_'.COMS] = 2;
require_once('libs/cls.upload.php');
require_once(PLUGINS_HOST.'finediff/finediff.php');
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

/*Check user permission*/
$isAdmin = getInfo('isadmin');
$userLogin = getInfo('username');
$res_Users = SysGetList('tbl_users', ['permission'], "AND username='".$userLogin."'");
$res_user = $res_Users[0];
$arr_permission = ($res_user['permission']!==null && $res_user['permission']!='[]' && $res_user['permission']!=='') ? json_decode($res_user['permission']) : [];
if(!$isAdmin && !in_array(3002, $arr_permission)){
	echo "Bạn không có quyền truy cập chức năng này.";
	exit();
}

if($isAdmin) $strWhere.=' AND id='. $GetID;
else $strWhere.=' AND `author`="'.$userLogin.'" AND id='. $GetID;
/*End check user permission*/

if(isset($_POST['txt_name']) && $_POST['txt_name']!=='') {
	$Url = isset($_POST['txt_url']) ? addslashes($_POST['txt_url']) : '';
	$Images = isset($_POST['txt_thumb2']) ? addslashes($_POST['txt_thumb2']) : '';

	if(isset($_FILES['txt_thumb']) && $_FILES['txt_thumb']['size'] > 0){
		$save_path = MEDIA_HOST."/events/";
		$obj_upload->setPath($save_path);
		$file = ROOTHOST_WEB.'medias/events/'.$obj_upload->UploadFile("txt_thumb", $save_path);
	}else{
		$file = $Images;
	}

	$arr=array();
	$arr['type'] 		= isset($_POST['cbo_type']) ? addslashes($_POST['cbo_type']) : null;
	$arr['group_id'] 	= isset($_POST['cbo_cate']) ? (int)$_POST['cbo_cate'] : 0;
	$arr['title'] 		= isset($_POST['txt_name']) ? addslashes($_POST['txt_name']) : '';
	$arr['alias'] 		= $Url=='' ? un_unicode($arr['title']) : $Url;
	$arr['sapo'] 		= isset($_POST['txt_sapo']) ? $_POST['txt_sapo'] : '';
	// $arr['organizers'] 	= isset($_POST['organizers']) ? addslashes($_POST['organizers']) : '';
	// $arr['scientific_ommittee'] = isset($_POST['scientific_ommittee']) ? addslashes($_POST['scientific_ommittee']) : '';
	// $arr['purpose'] 	= isset($_POST['purpose']) ? addslashes($_POST['purpose']) : '';
	// $arr['invited_guests'] = isset($_POST['invited_guests']) ? addslashes($_POST['invited_guests']) : '';
	$arr['fulltext'] 	= isset($_POST['txt_fulltext']) ? addslashes($_POST['txt_fulltext']) : '';
	$arr['address'] 	= isset($_POST['address']) ? addslashes($_POST['address']) : '';
	$arr['address2'] 	= isset($_POST['address2']) ? addslashes($_POST['address2']) : '';
	$arr['start_time'] 	= isset($_POST['start_time']) && $_POST['start_time']!='' ? strtotime($_POST['start_time']) : '';
	$arr['end_time'] 	= isset($_POST['end_time']) && $_POST['end_time']!='' ? strtotime($_POST['end_time']) : '';
	$arr['year'] 		= date("Y");
	$arr['baocaovien'] 	= isset($_POST['baocaovien']) ? addslashes($_POST['baocaovien']) : null;
	$arr['personnel'] 	= isset($_POST['personnel']) ? json_encode($_POST['personnel']) : null;
	$arr['research_team'] = isset($_POST['team']) ? json_encode($_POST['team']) : null;
	$arr['author'] 		= isset($_POST['author']) ? addslashes($_POST['author']) : getInfo('username');
	$arr['pdate'] 		= isset($_POST['pdate']) ? strtotime($_POST['pdate']) : null;
	$arr['pseudonym'] 	= getInfo('pseudonym');
	$arr['images'] 		= $file;
	$arr['cdate'] 		= time();

	$arr['rapporter'] 	= isset($_POST['rapporter']) ? addslashes($_POST['rapporter']) : null;
	$arr['language'] 	= isset($_POST['language']) ? addslashes($_POST['language']) : null;

	/* History */
	$arr_tmp = array();
	if(isset($_POST['cbo_type']) && strcasecmp($_SESSION['flash_current_event'.$GetID]['type'], $_POST['cbo_type']) !== 0){
		$arr_tmp['type'] = diff($_SESSION['flash_current_event'.$GetID]['type'], $arr['type']);
	}
	if(isset($_POST['cbo_cate']) && strcasecmp($_SESSION['flash_current_event'.$GetID]['group_id'], $arr['cbo_cate']) !== 0){
		$arr_tmp['group_id'] = diff($_SESSION['flash_current_event'.$GetID]['group_id'], $arr['group_id']);
	}
	if(isset($_POST['txt_name']) && strcasecmp($_SESSION['flash_current_event'.$GetID]['title'], $_POST['txt_name']) !== 0){
		$arr_tmp['title'] = diff($_SESSION['flash_current_event'.$GetID]['title'], $arr['title']);
	}
	if(strcasecmp($_SESSION['flash_current_event'.$GetID]['alias'], $_POST['txt_url']) !== 0){
		$arr_tmp['alias'] = diff($_SESSION['flash_current_event'.$GetID]['alias'], $arr['alias']);
	}
	if(isset($_POST['txt_sapo']) && strcasecmp($_SESSION['flash_current_event'.$GetID]['sapo'], $_POST['txt_sapo']) !== 0){
		$arr_tmp['sapo'] = diff($_SESSION['flash_current_event'.$GetID]['sapo'], $arr['sapo']);
	}
	if(isset($_POST['txt_fulltext']) && strcasecmp($_SESSION['flash_current_event'.$GetID]['fulltext'], $_POST['txt_fulltext']) !== 0){
		$arr_tmp['fulltext'] = diff($_SESSION['flash_current_event'.$GetID]['fulltext'], $_POST['txt_fulltext']);
	}
	if(isset($_POST['address']) && strcasecmp($_SESSION['flash_current_event'.$GetID]['address'], $_POST['address']) !== 0){
		$arr_tmp['address'] = diff($_SESSION['flash_current_event'.$GetID]['address'], $_POST['address']);
	}
	if(isset($_POST['address2']) && strcasecmp($_SESSION['flash_current_event'.$GetID]['address2'], $_POST['address2']) !== 0){
		$arr_tmp['address2'] = diff($_SESSION['flash_current_event'.$GetID]['address2'], $_POST['address2']);
	}
	if(isset($_POST['start_time']) && strcasecmp($_SESSION['flash_current_event'.$GetID]['start_time'], $arr['start_time']) !== 0){
		$arr_tmp['start_time'] = diff($_SESSION['flash_current_event'.$GetID]['start_time'], $arr['start_time']);
	}
	if(isset($_POST['end_time']) && strcasecmp($_SESSION['flash_current_event'.$GetID]['end_time'], $arr['end_time']) !== 0){
		$arr_tmp['end_time'] = diff($_SESSION['flash_current_event'.$GetID]['end_time'], $arr['end_time']);
	}
	if(isset($_POST['baocaovien']) && strcasecmp($_SESSION['flash_current_event'.$GetID]['baocaovien'], $_POST['baocaovien']) !== 0){
		$arr_tmp['baocaovien'] = diff($_SESSION['flash_current_event'.$GetID]['baocaovien'], $arr['baocaovien']);
	}
	if(isset($_POST['rapporter']) && strcasecmp($_SESSION['flash_current_event'.$GetID]['rapporter'], $_POST['rapporter']) !== 0){
		$arr_tmp['rapporter'] = diff($_SESSION['flash_current_event'.$GetID]['rapporter'], $arr['rapporter']);
	}
	if(isset($_POST['language']) && strcasecmp($_SESSION['flash_current_event'.$GetID]['language'], $_POST['language']) !== 0){
		$arr_tmp['language'] = diff($_SESSION['flash_current_event'.$GetID]['language'], $arr['language']);
	}

	$json_personnel_old = stripslashes($_SESSION['flash_current_event'.$GetID]['personnel']);
	$json_personnel_new = isset($_POST['personnel']) ? json_encode($_POST['personnel']) : '';
	if(strcasecmp($json_personnel_old, $json_personnel_new) !== 0){
		$arr_tmp['personnel'] = diff(json_encode($_SESSION['flash_current_event'.$GetID]['personnel']), json_encode($arr['personnel']));
	}

	$json_research_team_old = stripslashes($_SESSION['flash_current_event'.$GetID]['research_team']);
	$json_research_team_new = isset($_POST['team']) ? json_encode($_POST['team']) : '';
	if(strcasecmp($json_research_team_old, $json_research_team_new) !== 0){
		$arr_tmp['research_team'] = diff(json_encode($_SESSION['flash_current_event'.$GetID]['research_team']), json_encode($arr['research_team']));
	}

	if(strcasecmp($_SESSION['flash_current_event'.$GetID]['images'], $file) !== 0){
		$arr_tmp['images'] = diff($_SESSION['flash_current_event'.$GetID]['images'], $file);
	}

	$is_empty = true; //flag
	foreach ($arr_tmp as $key => $value) {
		if ($value != '')
			$is_empty = false;
	}

	if(!$is_empty){
		$arr_tmp['event_id'] = $GetID;
		$arr_tmp['status'] = 'sửa';
		$arr_tmp['title'] = $arr['title'];
		$arr_tmp['cdate'] = time();
		$arr_tmp['author'] = getInfo('username');
		$arr_tmp['author_name'] = getInfo('fullname');
		SysAdd('tbl_event_history', $arr_tmp);
	}
	/* /. History */

	$result = SysEdit('tbl_event', $arr, " id=".$GetID);

	if($result){
		if(isset($_POST['event_item_date'])){
			$res_schedules = SysGetList('tbl_schedule', [], "AND event_id=".$GetID);
			if(count($res_schedules)>0){
				foreach ($res_schedules as $key => $value) {
					SysDel('tbl_schedule', "code='".$value['code']."'");
				}
			}

			foreach ($_POST['event_item_date'] as $key => $value) {
				if($_POST['event_item_code'][$key]!==''){
					$tmp_arr = [];
					$tmp_arr['code'] = $_POST['event_item_code'][$key];
					$tmp_arr['title'] = $_POST['event_item_title'][$key];
					$tmp_arr['address'] = $_POST['event_item_address'][$key];
					$tmp_arr['date'] = strtotime($_POST['event_item_date'][$key]);
					$tmp_arr['stime'] = strtotime($_POST['event_item_stime'][$key]);
					$tmp_arr['etime'] = strtotime($_POST['event_item_etime'][$key]);
					$tmp_arr['type'] = 'event';
					$tmp_arr['event_id'] = $GetID;

					SysAdd('tbl_schedule', $tmp_arr);
				}
			}
		}
		$_SESSION['flash'.'com_'.COMS] = 1;
	} 
	else $_SESSION['flash'.'com_'.COMS] = 0;
}

$res_Cons = SysGetList('tbl_event', array(), $strWhere);
if(count($res_Cons) <= 0){
	echo 'Không có dữ liệu.'; 
	return;
}
$row = $res_Cons[0];
if(count($row)>0){
	$_SESSION['flash_current_event'.$GetID] = $row;
}
if(isset($_POST["txt_type"])){
	$viewtype = $_POST["txt_type"];
}else{
	$viewtype = $row["type"];
}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Cập nhật HĐKH</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS;?>">Danh sách HĐKH</a></li>
					<li class="breadcrumb-item active">Cập nhật HĐKH</li>
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
				<div>Chú ý: Lựa chọn loại hoạt động khoa học trước khi điền các thông tin chi tiết.</div>
				<form name="frm_action" id="frm_action" action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="txtid" value="<?php echo $GetID;?>">
					<div class="form-group">
						<label>Loại hoạt động khoa học</label><font color="red">*</font>
						<select class="form-control required" id="cbo_type" name="cbo_type" onchange="select_cbo_type();" required>
							<option value="">-- Chọn một loại --</option>
							<option value="hdkh">Hoạt động khoa học</option>
							<option value="phobienkienthuc">Phổ biến kiến thức</option>
						</select>
						<script type="text/javascript">
							$(document).ready(function(){
								cbo_Selected('cbo_type','<?php echo $viewtype;?>');
							});
						</script>
					</div>
					<div id="frm_body"></div>
				</div>

				<div class="toolbar">
					<div class="widget_control text-center">
						<input type="submit" name="cmdsave_tab1" id="cmdsave" class="border-radius0 btn btn-success" value="Lưu thay đổi" class="border-radius0 btn btn-primary">
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
		// Hidden left sidebar
		$('#body').addClass('sidebar-collapse');
		loadView('<?php echo $viewtype;?>', <?php echo json_encode($row);?>);

		$('#frm_action').submit(function(){
			return checkinput();
		});

		function loadView(type, data){
			var jsonString = JSON.stringify(data);
			$.ajax({
				type: "POST",
				url: "<?php echo ROOTHOST;?>ajaxs/event/form_"+type+".php",
				data: {
					'data': jsonString
				}, 
				cache: false,

				success: function(req){
					$('#frm_body').html(req);
				}
			});
		}
	});

	function checkinput(e){
		var flag = true;
		var title = $('#txt_name').val();
		var cate = parseInt($('#cbo_cate').val());

		if(title=='' || cate==0){
			alert('Các mục đánh dấu * không được để trống');
			flag = false;
		}
		return flag;
	}

	function select_cbo_type(){
		var txt_viewtype=document.getElementById("txt_type");
        var cbo_viewtype=document.getElementById("cbo_type");
        for(i=0;i<cbo_viewtype.length;i++){
            if(cbo_viewtype[i].selected==true)
                txt_viewtype.value=cbo_viewtype[i].value;
        }
        document.frm_type.submit();
	}
</script>