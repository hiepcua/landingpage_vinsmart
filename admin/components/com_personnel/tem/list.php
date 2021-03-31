<?php
define('OBJ_PAGE','personnel');
// Init variables
$user=getInfo('username');
$isAdmin=getInfo('isadmin');
$strWhere="";

$get_s = isset($_GET['s']) ? antiData($_GET['s']) : '';
$get_q = isset($_GET['q']) ? antiData($_GET['q']) : '';
$get_cate = isset($_GET['cate']) ? (int)antiData($_GET['cate']) : 0;
$action = isset($_GET['cbo_action']) ? addslashes(trim($_GET['cbo_action'])) : '';

/*Gán strWhere*/
if($get_s!=''){
	$strWhere.=" AND status =".$get_s;
}
if($get_q!=''){
	$strWhere.=" AND name LIKE '%".$get_q."%'";
}
if($get_cate!=0){
	$strWhere.=" AND group_id LIKE '%\"".$get_cate."\"%'";
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

$total_rows=SysCount('tbl_personnel',$strWhere);
$max_rows = 15;

if($_SESSION['CUR_PAGE_'.OBJ_PAGE] > ceil($total_rows/$max_rows)){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = ceil($total_rows/$max_rows);
}
$cur_page=(int)$_SESSION['CUR_PAGE_'.OBJ_PAGE]>0 ? $_SESSION['CUR_PAGE_'.OBJ_PAGE] : 1;
/*End pagging*/
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Danh sách nhà khoa học</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS;?>">Danh sách nhà khoa học</a></li>
					<li class="breadcrumb-item active">Danh sách nhà khoa học</li>
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
						<input type='text' id='txt_title' name='q' value="<?php echo $get_q;?>" class='form-control' placeholder="Tên nhà khoa học..." />
						&nbsp&nbsp&nbsp
						<select class="form-control" name="cate" id="cbo_cate">
							<option value="">-- Chức vụ --</option>
							<?php getListComboboxCategories(0,0); ?>
						</select>
						<script type="text/javascript">
							$(document).ready(function(){
								cbo_Selected('cbo_cate', <?php echo $get_cate; ?>);
							});
						</script>
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
					<a href="<?php echo ROOTHOST.COMS;?>/add" class="btn btn-primary float-sm-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới</a>
				</div>
			</div>
		</div>

		<div class="card">
			<div class='table-responsive'>
				<table class="table table-bordered">
					<thead>                  
						<tr>
							<th style="width: 10px">#</th>
							<th>Xóa</th>
							<th>Nhà khoa học</th>
							<th class="text-center">Mã nhà khoa học</th>
							<th>Chức vụ tại viện</th>
							<th>Phòng làm việc</th>
							<th>Máy lẻ</th>
							<th class="order" class="text-center" width="80px">Sắp xếp</th>
							<th class="text-center" width="80px">Hiển thị</th>
							<th class="text-center" width="100px">Xem trước</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($total_rows>0){
							$star = ($cur_page - 1) * $max_rows;
							$strWhere.=" ORDER BY cdate DESC LIMIT $star,".$max_rows;
							$obj=SysGetList('tbl_personnel',array(), $strWhere, false);
							$stt=0;
							while($r=$obj->Fetch_Assoc()){
								$stt++;
								$ids = $r['id'];
								$thumbnail = getThumb('', 'thumbnail', '');
								$order = $r['order'];

								if($r['isactive'] == 1) 
									$icon_active    = "<i class='fas fa-toggle-on cgreen'></i>";
								else $icon_active   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';
								$link = ROOTHOST_WEB.'nhan-su/'.$r['alias'].'.html';
								?>
								<tr>
									<td width='30' align='center' class="td-actions"><span class="action" style="border:0px"><?php echo $stt + $star;?></span></td>

									<td align='center' width='10'><a href='<?php echo ROOTHOST.COMS."/delete/".$r['id'];?>' onclick='return confirm("Bạn có chắc muốn xóa?")'><i class='fa fa-trash cred' aria-hidden='true'></i></a></td>

									<td>
										<div class="widget-td-title">
											<div class="wg-avatar" data-src="<?php echo $r['avatar']!=='' ? 'https://viasm.edu.vn/'.$r['avatar'] : '';?>"><a href="<?php echo ROOTHOST.COMS.'/edit/'.$r['id'];?>"><?php echo $thumbnail;?></a></div>
											<div class="widget-title">
												<a href="<?php echo ROOTHOST.COMS.'/edit/'.$r['id'];?>"><?php echo Substring($r['name'], 0, 20);?></a>
												<div class="widget-list-info">
													<ul class="list-unstyle">
														<span class="td-public-time"><?php echo $r['phone'];?></span>
														<span class="td-public-time"><?php echo $r['email'];?></span>
													</ul>
												</div>
											</div>
										</div>
									</td>

									<td class="text-center"><?php echo $r['person_code'];?></td>
									<td><?php echo $r['position'];?></td>
									<td><?php echo $r['work_room'];?></td>
									<td><?php echo $r['mayle'];?></td>

									<td width='50' align='center'><input style='width: 50px;' type='number' min='0' name='txt_order' value="<?php echo $order;?>" size="4" class="order text-center" data-id='<?php echo $r['id'];?>'></td>
									
									<td class="text-center"><a href="<?php echo ROOTHOST.COMS.'/active/'.$r['id'];?>"><?php echo $icon_active;?></a></td>
									<td class='text-center'><a href='<?php echo $link;?>' target='_blank'><i class='fa fa-eye' aria-hidden='true'></i></a></td>
								</tr>
							<?php }
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
	function checkinput(){
		var strids=document.getElementById("txtids");
		if(strids.value==""){
			alert('Bạn chưa lựa chọn đối tượng nào.');
			return false;
		}
		return true;
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.order').on('change', function() {
			var val = parseInt(this.value);
			var id = parseInt($(this).attr('data-id'));
			var _data = {
				"id" : id,
				"val" : val,
			}
			$.post('<?php echo ROOTHOST;?>ajaxs/order/order_personnel.php', _data, function(res){
				if(parseInt(res)==1){
					$(this).val(parseInt(res));
				}else{
					$(this).val('error!');
				}
			});
		});
	})
</script>