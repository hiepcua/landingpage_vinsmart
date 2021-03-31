<?php
define('OBJ_PAGE','categories');
$flg_search = 0;
$strWhere=""; $limit='';
$get_q = isset($_GET['q']) ? antiData($_GET['q']) : '';
$action = isset($_GET['cbo_action']) ? addslashes(trim($_GET['cbo_action'])) : '';
$cbo_par = isset($_GET['cbo_par']) ? addslashes(trim($_GET['cbo_par'])) : '';
/*Check user permission*/
$isAdmin = getInfo('isadmin');
$userLogin = getInfo('username');
$res_Users = SysGetList('tbl_users', ['permission'], "AND username='".$userLogin."'");
$res_user = $res_Users[0];
$arr_permission = ($res_user['permission']!==null && $res_user['permission']!='[]' && $res_user['permission']!=='') ? json_decode($res_user['permission']) : [];

if(count(array_intersect($arr_permission, array_keys(PERMISSION_CATEGORY))) <= 0 && $isAdmin!=1){
	echo "Bạn không có quyền truy cập chức năng này.";
	exit();
}
/*End check user permission*/
/*Gán strWhere*/
if($get_q!=''){
	$flg_search = 1;
	$strWhere.=" AND title LIKE '%".$get_q."%'";
}
if($action !== '' && $action !== 'all' ){
	$strWhere.=" AND `isactive` = '$action'";
}
if($cbo_par !== '' && $cbo_par !== 'all' ){
	$flg_search = 1;
	$strWhere.=" AND `par_id` = '$cbo_par'";
}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Danh sách chuyên mục</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item active">Danh sách chuyên mục</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
	<div class='container-fluid'>
		<div class="row widget-frm-search form-group">
			<div class="col-md-10">
				<form id="frm_search" method="get" action="<?php echo ROOTHOST.COMS;?>">
					<div class="frm-search-box form-inline pull-left">
						<input type='text' id='txt_title' name='q' class='form-control' value="<?php echo $get_q?>" placeholder="Tên chuyên mục..." />
						&nbsp&nbsp&nbsp
						<select name="cbo_action" class="form-control" id="cbo_action">
							<option value="all">Tất cả</option>
							<option value="1">Hiển thị</option>
							<option value="0">Ẩn</option>
							<script language="javascript">
								$(document).ready(function(){
									cbo_Selected('cbo_action','<?php echo $action;?>');
								});
							</script>
						</select>
						&nbsp&nbsp&nbspDanh mục&nbsp
						<select name="cbo_par" class="form-control" id="cbo_par">
							<option value="all">Tất cả</option>
							<?php getListComboboxCategories();?>
							<script language="javascript">
								$(document).ready(function(){
									cbo_Selected('cbo_par','<?php echo $cbo_par;?>');
								});
							</script>
						</select>
						&nbsp&nbsp&nbsp
						<button type="submit" id="_btnSearch" class="btn btn-primary">Tìm kiếm</button>
					</div>
				</form>
			</div>
			<div class="col-md-2">
				<div class="pull-right">
					<?php if(in_array(2001, $arr_permission)){ ?>
					<a href="#" onclick="add()" class="btn btn-primary float-sm-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới</a>
					<?php } ?>
				</div>
			</div>
		</div>

		<div class="card">
			<div class='table-responsive'>
				<table class="table table-bordered">
					<thead>                  
						<tr>
							<th>Xóa</th>
							<th>Tên chuyên mục</th>
							<th>Chuyên mục cha</th>
							<th>Mô tả</th>
							<th class="order" width="80px">Sắp xếp</th>
							<th style="text-align: center;" width="80px">Hiển thị</th>
							<th style="text-align: center;" width="100px">Xem trước</th>
						</tr>
					</thead>
					<tbody id="data-table"></tbody>
				</table>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		getTable("<?php echo $strWhere;?>", "<?php echo $flg_search;?>", "<?php echo $limit;?>");
	});

	function add(){
		var _url="<?php echo ROOTHOST;?>ajaxs/categories/form_add.php";
		$.get(_url, function(req){
			$('#popup_modal .modal-dialog').addClass('modal-xl');
			$('#popup_modal .modal-title').text('Thêm mới chuyên mục bài viết');
			$('#popup_modal .modal-body').html(req);
			$('#popup_modal').modal('show');
		});
	}

	function getTable(strwhere, search, limit){
		var _url="<?php echo ROOTHOST;?>ajaxs/categories/get_table.php";
		var _data={
			"strwhere": strwhere,
			"search": search,
			"limit": limit,
		};

		$.get(_url, _data, function(req){
			$('#data-table').html(req);
		});
	}

	function edit(id){
		if(parseInt(id)!==0){
			var _url="<?php echo ROOTHOST;?>ajaxs/categories/form_edit.php";
			$.get(_url, {"id": id}, function(req){
				$('#popup_modal .modal-dialog').addClass('modal-xl');
				$('#popup_modal .modal-title').text('Cập nhật chuyên mục bài viết');
				$('#popup_modal .modal-body').html(req);
				$('#popup_modal').modal('show');
			});
		}
	}

	function active(e){
		var id = parseInt(e.getAttribute('data-id'));
		$.post('<?php echo ROOTHOST;?>ajaxs/categories/active.php', {"id": id}, function(res){
			if(parseInt(res)==1){
				window.location.reload();
			}else if(parseInt(res)==3){
				alert('Bạn không có quyền thực hiện chức năng này!');
			}else{
				alert('Lỗi!');
			}
		});
	}

	function order(e){
		var val = parseInt(e.value);
		var id = parseInt(e.getAttribute('data-id'));
		var _data = {
			"id" : id,
			"val" : val,
		}
		$.post('<?php echo ROOTHOST;?>ajaxs/categories/order.php', _data, function(res){
			if(parseInt(res)==1){
				window.location.reload();
			}else if(parseInt(res)==3){
				alert('Bạn không có quyền thực hiện chức năng này!');
			}else{
				alert('Lỗi!');
			}
		});
	}

	function delete1(e){
		var id = parseInt(e.getAttribute('data-id'));
		if(confirm('Bạn có chắc muốn xóa?')){
			$.post('<?php echo ROOTHOST;?>ajaxs/categories/delete.php', {"id": id}, function(res){
				if(parseInt(res)==1){
					window.location.reload();
				}else if(parseInt(res)==3){
					alert('Bạn không có quyền thực hiện chức năng này!');
				}else{
					alert('Lỗi!');
				}
			});
		}
	}
</script>