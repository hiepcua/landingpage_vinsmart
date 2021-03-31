<?php
define('OBJ_PAGE','publish');
// Init variables
$user=getInfo('username');
$isAdmin=getInfo('isadmin');
$strWhere=" AND istrash=0 ";

/*Check user permission*/
$isAdmin = getInfo('isadmin');
$userLogin = getInfo('username');
$res_Users = SysGetList('tbl_users', ['permission'], "AND username='".$userLogin."'");
$res_user = $res_Users[0];
$arr_permission = ($res_user['permission']!==null && $res_user['permission']!='[]' && $res_user['permission']!=='') ? json_decode($res_user['permission']) : [];

if(count(array_intersect($arr_permission, array_keys(PERMISSION_PUBLISH))) <= 0 && $isAdmin!=1){
	echo "Bạn không có quyền truy cập chức năng này.";
	exit();
}
/*End check user permission*/

if($isAdmin==1){
	$strWhere.="";
}else{
	$strWhere.=" AND `author`='".$user."'";
}

$get_s = isset($_GET['s']) ? antiData($_GET['s']) : '';
$get_q = isset($_GET['q']) ? antiData($_GET['q']) : '';
$get_cate = isset($_GET['cate']) ? addslashes($_GET['cate']) : '';
$action = isset($_GET['cbo_action']) ? addslashes(trim($_GET['cbo_action'])) : '';
$stime = isset($_GET['year1']) ? (int)antiData($_GET['year1']) : 0;
$etime = isset($_GET['year2']) ? (int)antiData($_GET['year2']) : 0;

/*Gán strWhere*/
if($get_s!=''){
	$strWhere.=" AND status =".$get_s;
}
if($get_q!=''){
	$strWhere.=" AND title LIKE '%".$get_q."%'";
}
if($get_cate!=''){
	$strWhere.=" AND code='".$get_cate."'";
}
if($action !== '' && $action !== 'all' ){
	$strWhere.=" AND `isactive` = '$action'";
}
if($stime != 0){
	$strWhere.=" AND `year` >=".$stime;
}
if($etime != 0){
	$strWhere.=" AND `year` <=".$etime;
}

/*Begin pagging*/
if(!isset($_SESSION['CUR_PAGE_'.OBJ_PAGE])){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = 1;
}
if(isset($_POST['txtCurnpage'])){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = (int)$_POST['txtCurnpage'];
}

$total_rows=SysCount('tbl_publish',$strWhere);
$max_rows = 15;

if($_SESSION['CUR_PAGE_'.OBJ_PAGE] > ceil($total_rows/$max_rows)){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = ceil($total_rows/$max_rows);
}
$cur_page=(int)$_SESSION['CUR_PAGE_'.OBJ_PAGE]>0 ? $_SESSION['CUR_PAGE_'.OBJ_PAGE] : 1;
/*End pagging*/
?>
<style type="text/css">
	.widget-frm-search, .widget-frm-search input, .widget-frm-search select, .widget-frm-search button{
		font-size: 12px;
	}
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Danh sách xuất bản</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item active">Danh sách xuất bản</li>
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
					<input type='hidden' id='txt_status' name='s' value=''/>
					<div class="frm-search-box form-inline pull-left">
						<input type='text' id='txtkeyword' name='q' value="<?php echo $get_q;?>" class='form-control' placeholder="Từ khóa..." />
						&nbsp&nbsp&nbsp
						<select class="form-control" name="cate" id="cbo_cate">
							<option value="">-- Loại xuất bản --</option>
							<?php getListComboboxCategories(0,0); ?>
						</select>
						<script type="text/javascript">
							$(document).ready(function(){
								cbo_Selected('cbo_cate', '<?php echo $get_cate; ?>');
							});
						</script>
						&nbsp&nbsp&nbsp Từ năm
						<select class="form-control" name="stime" id="stime">
							<option value="">-- Tất cả --</option>
							<option value="2010">2010</option>
							<option value="2011">2011</option>
							<option value="2012">2012</option>
							<option value="2013">2013</option>
							<option value="2014">2014</option>
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021">2021</option>
						</select>
						<script type="text/javascript">
							$(document).ready(function(){
								cbo_Selected('stime', <?php echo $stime; ?>);
							});
						</script>
						&nbsp&nbsp&nbsp Đến năm
						<select class="form-control" name="etime" id="etime">
							<option value="">-- Tất cả --</option>
							<option value="2010">2010</option>
							<option value="2011">2011</option>
							<option value="2012">2012</option>
							<option value="2013">2013</option>
							<option value="2014">2014</option>
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021">2021</option>
						</select>
						<script type="text/javascript">
							$(document).ready(function(){
								cbo_Selected('etime', <?php echo $etime; ?>);
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
					<?php if(in_array('10001', $arr_permission)){ ?>
						<a href="javascript:void(0)" class="btn btn-primary float-sm-right" onclick="addnew()"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới</a>
					<?php } ?>
				</div>
			</div>
		</div>

		<div class="card">
			<div class='table-responsive'>
				<table class="table table-bordered">
					<thead>                  
						<tr>
							<th class="text-center">#</th>
							<th class="text-center" width="50px">Xóa</th>
							<th>Tên</th>
							<th>Tác giả</th>
							<th class="text-center">Năm xuất bản</th>
							<th class="text-center" width="80px">Hiển thị</th>
							<th class="text-center" width="100px">Xem trước</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($total_rows>0){
							$star = ($cur_page - 1) * $max_rows;
							$strWhere.=" ORDER BY cdate DESC LIMIT $star,".$max_rows;
							$obj=SysGetList('tbl_publish',array(), $strWhere, false);
							$stt=0;
							while($r=$obj->Fetch_Assoc()){
								$stt++;
								$ids = $r['id'];
								$cates = SysGetList('tbl_publish_group', array('title', 'alias'), ' AND code="'.$r['group_code'].'"');
								$cate = count($cates)>0 ? $cates[0] : [];
								$cate_title = isset($cate['title']) ? $cate['title'] : '<i>N/A</i>';

								$link='';
								if(count($cates)>0){
									$link = ROOTHOST_WEB.'xuat-ban/'.$cate['alias'].'/'.$r['alias'].'-'.$r['id'];
								}

								if($r['isactive'] == 1) 
									$icon_active    = "<i class='fas fa-toggle-on cgreen'></i>";
								else $icon_active   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';
								?>
								<tr>
									<td width='10' align='center' class="td-actions"><span class="action" style="border:0px"><?php echo $stt + $star;?></span></td>

									<td class="text-center"><a class="action mt-3" href='<?php echo ROOTHOST.COMS."/delete/".$r['id'];?>' onclick='return confirm("Bạn có chắc muốn xóa?")'><i class='fa fa-trash cred' aria-hidden='true'></i></a></td>

									<td>
										<div class="widget-td-title">
											<div class="widget-title">
												<a href="<?php echo ROOTHOST.COMS.'/edit/'.$r['id'];?>"><?php echo $r['title'];?></a>
												<div class="widget-list-info">
													<ul class="list-unstyle">
														<li><a href="" target="_blank"><?php echo $cate_title;?></a></li>
														<span class="td-public-time"><?php echo date('H:i | d-m-Y', $r['cdate']);?></span>
													</ul>
												</div>
											</div>
										</div>
									</td>

									<td><?php echo $r['author'];?></td>
									<td class="text-center"><?php echo $r['year'];?></td>

									<td class="text-center td-actions"><a class="action" style="border:0px" href="<?php echo ROOTHOST.COMS.'/active/'.$r['id'];?>"><?php echo $icon_active;?></a></td>

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
	function addnew(){
		var _url="<?php echo ROOTHOST;?>ajaxs/publish/form_add.php";
		$.get(_url, function(req){
			$('#popup_modal .modal-dialog').addClass('modal-xl');
			$('#popup_modal .modal-title').text('Thêm mới xuất bản');
			$('#popup_modal .modal-body').html(req);
			$('#popup_modal').modal('show');
		});
	}
</script>