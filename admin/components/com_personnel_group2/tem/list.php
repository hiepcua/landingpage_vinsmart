<?php
define('OBJ_PAGE','personnel_group2');
$strWhere=""; $limit='';
$get_q = isset($_GET['q']) ? antiData($_GET['q']) : '';
$action = isset($_GET['cbo_action']) ? addslashes(trim($_GET['cbo_action'])) : '';

/*Gán strWhere*/
if($get_q!=''){
	$strWhere.=" AND title LIKE '%".$get_q."%'";
}
if($action !== '' && $action !== 'all' ){
    $strWhere.=" AND `isactive` = '$action'";
}

/*Begin pagging*/
if(!isset($_SESSION['CUR_PAGE_'.OBJ_PAGE])){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = 1;
}
if(isset($_POST['txtCurnpage'])){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = (int)$_POST['txtCurnpage'];
}

$total_rows=SysCount('tbl_personnel_group2',$strWhere);
$max_rows = 20;

if($_SESSION['CUR_PAGE_'.OBJ_PAGE] > ceil($total_rows/$max_rows)){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = ceil($total_rows/$max_rows);
}
$cur_page=(int)$_SESSION['CUR_PAGE_'.OBJ_PAGE]>0 ? $_SESSION['CUR_PAGE_'.OBJ_PAGE] : 1;

if($total_rows>0){
	$star = ($cur_page - 1) * $max_rows;
	$limit="LIMIT $star,".$max_rows;
}
/*End pagging*/
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Danh sách nhóm nhân viên</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item active">Danh sách nhóm nhân viên</li>
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
                    	<input type='text' id='txt_title' name='q' class='form-control' value="<?php echo $get_q?>" placeholder="Tên nhóm nhân viên..." />
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
                        &nbsp&nbsp&nbsp
                        <button type="submit" id="_btnSearch" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2">
                <div class="pull-right">
                    <form id="frm_actions" method="post" action="">
                        <input type="hidden" name="txtaction" id="txtaction"/>
                        <input type="hidden" name="txtids" id="txtids" />
                    </form>
                    <a href="#" onclick="add()" class="btn btn-primary float-sm-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới</a>
                </div>
            </div>
        </div>

		<div class="card">
			<div class='table-responsive'>
				<table class="table table-bordered">
					<thead>                  
						<tr>
							<th>Xóa</th>
							<th>Tên nhóm nhân viên</th>
							<th class="text-center">Mã nhóm</th>
							<th>Mô tả</th>
							<th class="order">Sắp xếp</th>
							<th style="text-align: center;" width="80px">Hiển thị</th>
						</tr>
					</thead>
					<tbody id="data-table"></tbody>
				</table>
			</div>
		</div>
		<nav class="d-flex justify-content-center"><?php paging($total_rows,$max_rows,$cur_page);?></nav>
	</div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
		getTable("<?php echo $strWhere;?>", "<?php echo $limit;?>");
	});

	function getTable(strwhere, limit){
		var _url="<?php echo ROOTHOST;?>ajaxs/personnel_group2/get_table.php";
		var _data={
			"strwhere": strwhere,
			"limit": limit,
		};

		$.get(_url, _data, function(req){
			$('#data-table').html(req);
		});
	}

    function add(){
		var _url="<?php echo ROOTHOST;?>ajaxs/personnel_group2/form_add.php";
		$.get(_url, function(req){
			$('#popup_modal .modal-dialog').addClass('modal-xl');
			$('#popup_modal .modal-body').html(req);
			$('#popup_modal').modal('show');
		});
	}

	function edit(id){
		if(parseInt(id)!==0){
			var _url="<?php echo ROOTHOST;?>ajaxs/personnel_group2/form_edit.php";
			$.get(_url, {"id": id}, function(req){
				$('#popup_modal .modal-dialog').addClass('modal-xl');
				$('#popup_modal .modal-body').html(req);
				$('#popup_modal').modal('show');
			});
		}
	}

	function active(e){
		var id = parseInt(e.getAttribute('data-id'));
		$.post('<?php echo ROOTHOST;?>ajaxs/personnel_group2/active.php', {"id": id}, function(res){
			if(parseInt(res)==1){
				window.location.reload();
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
		$.post('<?php echo ROOTHOST;?>ajaxs/personnel_group2/order.php', _data, function(res){
			if(parseInt(res)==1){
				window.location.reload();
			}else{
				alert('Lỗi!');
			}
		});
	}

	function delete1(e){
		var id = parseInt(e.getAttribute('data-id'));
		if(confirm('Bạn có chắc muốn xóa?')){
			$.post('<?php echo ROOTHOST;?>ajaxs/personnel_group2/delete.php', {"id": id}, function(res){
				if(parseInt(res)==1){
					window.location.reload();
				}else{
					alert('Lỗi!');
				}
			});
		}
	}
</script>