<?php
define('OBJ_PAGE','MNUITEM');
$flg_search = 0;

$get_mnuid = isset($_GET['mnuid']) ? antiData($_GET['mnuid']) : 0;
$get_q = isset($_GET['q']) ? antiData($_GET['q']) : '';
$get_site = isset($_GET['s']) ? antiData($_GET['s']) : '';
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

function listTable($strwhere="",$parid=0,$level=0,$rowcount, $search=0){
	if($search == 0){
		$sql="SELECT * FROM tbl_mnuitems WHERE 1=1 AND par_id=$parid $strwhere";
	}else{
		$sql="SELECT * FROM tbl_mnuitems WHERE 1=1 $strwhere";
	}
	
	$objdata=new CLS_MYSQL();
	$objdata->Query($sql);
	$str_space="";
	if($level!=0){  
		for($i=0;$i<$level;$i++)
			$str_space.="|----- ";
	}
	while($rows=$objdata->Fetch_Assoc()){
		$ids=$rows['id'];
		$mnuid=$rows['menu_id'];
		$title=Substring(stripslashes($rows['name']),0,10);
		$order = $rows['order'];

		if($rows['isactive'] == 1) 
			$icon_active    = "<i class='fas fa-toggle-on cgreen'></i>";
		else $icon_active   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';

		$par_name = SysGetList('tbl_mnuitems', array('name'), "AND id=".$rows['par_id']);
		$par_name = isset($par_name[0]['name']) ? $par_name[0]['name'] : '';

		echo "<tr name='trow'>";
		
		echo "<td align='center' width='10'><a href='".ROOTHOST.COMS.'/'.$mnuid."/delete/".$ids."' onclick='return confirm(\"Bạn có chắc muốn xóa?\")'><i class='fa fa-trash cred' aria-hidden='true'></i></a></td>";

		echo "<td><a href='".ROOTHOST.COMS.'/'.$mnuid."/edit/".$ids."'>".$str_space.$title."</a></td>";
		echo "<td>".$par_name."</td>";
		echo "<td>".$rows['viewtype']."</td>";

		echo "<td width='50' align='center'><input style='width: 50px;' type='number' min='0' name='txt_order' value='".$order."' size='4' class='order text-center' data-id='".$rows['id']."'></td>";
		echo "<td align='center'><a href='".ROOTHOST.COMS.'/'.$mnuid."/active/".$ids."'>".$icon_active."</a></td>";

		echo "</tr>";
		$nextlevel=$level+1;
		listTable($strwhere,$ids,$nextlevel,$rowcount);
	}
}

/*Begin pagging*/
if(!isset($_SESSION['CUR_PAGE_'.OBJ_PAGE])){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = 1;
}
if(isset($_POST['txtCurnpage'])){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = (int)$_POST['txtCurnpage'];
}

$total_rows=SysCount('tbl_mnuitems',$strWhere);
$max_rows = 20;

if($_SESSION['CUR_PAGE_'.OBJ_PAGE] > ceil($total_rows/$max_rows)){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = ceil($total_rows/$max_rows);
}
$cur_page=(int)$_SESSION['CUR_PAGE_'.OBJ_PAGE]>0 ? $_SESSION['CUR_PAGE_'.OBJ_PAGE] : 1;
/*End pagging*/

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
							<th>Kiểu hiển thị</th>
							<th class="order" width="80px">Sắp xếp</th>
							<th class="text-center" width="80px">Hiển thị</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($total_rows>0){
							$star = ($cur_page - 1) * $max_rows;
							$strWhere.="ORDER BY `order` ASC LIMIT $star,".$max_rows;

							if($flg_search !== 0){
								listTable($strWhere,0,0,0, 1);
							}else{
								listTable($strWhere,0,0,0);
							}
						}else{
							?>
							<tr>
								<td colspan='6' class='text-center'>Dữ liệu trống!</td>
							</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
		<nav class="d-flex justify-content-center">
			<?php 
			paging($total_rows,$max_rows,$cur_page);
			?>
		</nav>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		$('.order').on('change', function() {
			var val = parseInt(this.value);
			var id = parseInt($(this).attr('data-id'));
			var _data = {
				"id" : id,
				"val" : val,
			}
			$.post('<?php echo ROOTHOST;?>ajaxs/order/order_menuitems.php', _data, function(res){
				if(parseInt(res)==1){
					$(this).val(parseInt(res));
				}else{
					$(this).val('error!');
				}
			});
		});
	})
</script>