<?php
define('OBJ_PAGE','MNUITEM');
$flg_search = 0;
$strWhere=""; $limit='';

$get_mnuid = isset($_GET['mnuid']) ? antiData($_GET['mnuid']) : 0;
$get_q = isset($_GET['q']) ? antiData($_GET['q']) : '';
$action = isset($_GET['cbo_action']) ? addslashes(trim($_GET['cbo_action'])) : '';
$strWhere=" AND menu_id=$get_mnuid ";

/*Gán strWhere*/
if($get_q!=''){
	$flg_search = 1;
	$strWhere.=" AND name LIKE '%".$get_q."%'";
}
if($action !== '' && $action !== 'all' ){
	$strWhere.=" AND `isactive` = '$action'";
}

function listTable($strwhere="", $search=0, $limit){
	if($search == 0){
		$strsql="AND par_id=0 $strwhere ORDER BY `order` ASC $limit";
	}else{
		$strsql="$strwhere ORDER BY `order` ASC $limit";
	}

	$res=SysGetList('tbl_mnuitems', [], $strsql);
	if(count($res)>0){
		foreach ($res as $key => $rows) {
			$ids=$rows['id'];
			$mnuid=$rows['menu_id'];
			$title=Substring(stripslashes($rows['name']),0,10);
			$order = $rows['order'];

			if($rows['isactive'] == 1) 
				$icon_active    = "<i class='fas fa-toggle-on cgreen'></i>";
			else $icon_active   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';

			$order = $rows['order'];
			echo "<tr name='trow'>";

			echo "<td align='center' width='10'><a href='".ROOTHOST.COMS.'/'.$mnuid."/delete/".$ids."' onclick='return confirm(\"Bạn có chắc muốn xóa?\")'><i class='fa fa-trash cred' aria-hidden='true'></i></a></td>";

			echo "<td><a href='".ROOTHOST.COMS.'/'.$mnuid."/edit/".$ids."'>".$title."</a></td>";
			echo "<td></td>";

			echo "<td width='50' align='center'><input style='width: 50px;' type='number' min='0' name='txt_order' value='".$order."' size='4' class='order text-center' onchange='order(this)' data-id='".$rows['id']."'></td>";
			echo "<td align='center'><a href='".ROOTHOST.COMS.'/'.$mnuid."/active/".$ids."'>".$icon_active."</a></td>";

			echo "</tr>";

			$res_childrent = SysGetList('tbl_mnuitems', [], $strwhere." AND path LIKE '".$rows['path']."_%' ORDER BY `order` ASC");
			if(count($res_childrent)>0){
				foreach ($res_childrent as $key => $value) {
					if($value['isactive'] == 1) 
						$icon_active2    = "<i class='fas fa-toggle-on cgreen'></i>";
					else $icon_active2   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';

					$par_name = SysGetList('tbl_mnuitems', array('name'), "AND id=".$value['par_id']);
					$par_name = isset($par_name[0]['name']) ? $par_name[0]['name'] : '';

					$str_space="";
					$ar_space = explode('_', $value['path']);
					for ($i=0; $i < count($ar_space)-1; $i++) { 
						$str_space.="|-----";
					}

					echo "<tr name='trow'>";

					echo "<td align='center' width='10'><a href='".ROOTHOST.COMS.'/'.$value['menu_id']."/delete/".$value['id']."' onclick='return confirm(\"Bạn có chắc muốn xóa?\")'><i class='fa fa-trash cred' aria-hidden='true'></i></a></td>";

					echo "<td><a href='".ROOTHOST.COMS.'/'.$value['menu_id']."/edit/".$value['id']."'>".$str_space.$value['name']."</a></td>";
					echo "<td>".$par_name."</td>";

					echo "<td width='50' align='center'><input style='width: 50px;' type='number' min='0' name='txt_order' value='".$value['order']."' size='4' class='order text-center' data-id='".$rows['id']."'></td>";
					echo "<td align='center'><a href='".ROOTHOST.COMS.'/'.$value['menu_id']."/active/".$value['id']."'>".$icon_active2."</a></td>";

					echo "</tr>";
				}
			}
		}
	}
}

$total_rows=SysCount('tbl_mnuitems',$strWhere);
$res_menus = SysGetList('tbl_menus', array(), ' AND id='. $get_mnuid);
if(count($res_menus) <= 0){
	echo 'Không có dữ liệu.'; 
	return;
}
$row = $res_menus[0];
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark"><?php echo $row['name'];?></h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>menu">Quản lý menu</a></li>
					<li class="breadcrumb-item active"><?php echo $row['name'];?></li>
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
			<div class="col-md-6">
				<form id="frm_search" method="get" action="<?php echo ROOTHOST.COMS.'/'.$get_mnuid;?>">
					<div class="frm-search-box form-inline pull-left">
						<input type='text' id='txt_title' name='q' value="<?php echo $get_q;?>" class='form-control' placeholder="Tiêu đề menu item..." />
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
			<div class="col-md-6">
				<div class="pull-right">
					<form id="frm_actions" method="post" action="">
						<input type="hidden" name="txtaction" id="txtaction"/>
						<input type="hidden" name="txtids" id="txtids" />
					</form>
					<a href="<?php echo ROOTHOST.COMS.'/'.$get_mnuid;?>/add" class="btn btn-primary float-sm-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới</a>
				</div>
			</div>
		</div>

		<div class="card">
			<div class='table-responsive'>
				<table class="table table-bordered">
					<thead>                  
						<tr>
							<th>Xóa</th>
							<th>Tên</th>
							<th>Menu item cha</th>
							<th class="order" width="80px">Sắp xếp</th>
							<th class="text-center" width="80px">Hiển thị</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($total_rows>0){
							listTable($strWhere,$flg_search,'');
						}else{
							?>
							<tr>
								<td colspan='5' class='text-center'>Dữ liệu trống!</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	function order(e){
		var val = parseInt(e.value);
		var id = parseInt(e.getAttribute('data-id'));
		var _data = {
			"id" : id,
			"val" : val,
		}
		$.post('<?php echo ROOTHOST;?>ajaxs/menuitem/order.php', _data, function(res){
			if(parseInt(res)==1){
				window.location.reload();
			}else if(parseInt(res)==3){
				alert('Bạn không có quyền thực hiện chức năng này!');
			}else{
				alert('Lỗi!');
			}
		});
	}
</script>