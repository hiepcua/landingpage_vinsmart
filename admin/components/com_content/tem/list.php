<?php
define('OBJ_PAGE','CONTENT');
// Init variables
$user=getInfo('username');
$strWhere=" AND istrash=0 ";

/*Check user permission*/
$isAdmin = getInfo('isadmin');
$userLogin = getInfo('username');
$res_Users = SysGetList('tbl_users', ['permission'], "AND username='".$userLogin."'");
$res_user = $res_Users[0];
$arr_permission = ($res_user['permission']!==null && $res_user['permission']!='[]' && $res_user['permission']!=='') ? json_decode($res_user['permission']) : [];

if(count(array_intersect($arr_permission, array_keys(PERMISSION_CONTENT))) <= 0 && $isAdmin!=1){
	echo "Bạn không có quyền truy cập chức năng này.";
	exit();
}
/*End check user permission*/

if(isset($_POST["txtaction"]) && $_POST["txtaction"]!=""){
	$ids=trim($_POST["txtids"]);
	if($ids!='')
		$ids = substr($ids,0,strlen($ids)-1);
	$ids=str_replace(",","','",$ids);

	if($_POST["txtaction"] == "delete"){
		$res_cons = SysGetList('tbl_content', [], "AND id in ('".$ids."')");

		foreach ($res_cons as $key => $value) {
			$seo_link = ROOTHOST_WEB.$value['alias'].'-'.$value['id'].'.html';
			$Cres_seos = SysCount('tbl_seo', "AND `link`='".$seo_link."'");
			SysDel('tbl_content', "id in ('".$ids."')");
		}
	}
	echo "<script language=\"javascript\">window.location='".ROOTHOST.COMS."'</script>";
}

if($isAdmin==1){
	$strWhere.="";
}else{
	$strWhere.=" AND `author`='".$user."'";
}

$get_s = isset($_GET['s']) ? antiData($_GET['s']) : '';
$get_q = isset($_GET['q']) ? antiData($_GET['q']) : '';
$get_cate = isset($_GET['cate']) ? (int)antiData($_GET['cate']) : 0;
$action = isset($_GET['cbo_action']) ? addslashes(trim($_GET['cbo_action'])) : '';

/*Gán strWhere*/
if($get_s!=''){
	$strWhere.=" AND isactive =".$get_s;
}
if($get_q!=''){
	$strWhere.=" AND title LIKE '%".$get_q."%'";
}
if($get_cate!=0){
	$strWhere.=" AND cat_id=".$get_cate;
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

$total_rows=SysCount('tbl_content',$strWhere);
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
				<h1 class="m-0 text-dark">Danh sách tin tức</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item active">Danh sách tin tức</li>
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
            <div class="col-md-9">
                <form id="frm_search" method="get" action="<?php echo ROOTHOST.COMS;?>">
                	<input type='hidden' id='txt_status' name='s' value=''/>
                    <div class="frm-search-box form-inline pull-left">
                    	<input type='text' id='txt_title' name='q' value="<?php echo $get_q;?>" class='form-control' placeholder="Tiêu đề..." />
                        &nbsp&nbsp&nbsp
                        <div class='form-group'>
							<select class="form-control" name="cate" id="cbo_cate">
								<option value="">-- Chuyên mục --</option>
								<?php getListComboboxCategories(0,0); ?>
							</select>
							<script type="text/javascript">
								$(document).ready(function(){
									cbo_Selected('cbo_cate', <?php echo $get_cate; ?>);
								});
							</script>
						</div>
                        &nbsp&nbsp&nbsp
                        <div class='form-group'>
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
						</div>&nbsp&nbsp&nbsp
                        <button type="submit" id="_btnSearch" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>

		<div class="card">
			<div class='table-responsive'>
				<table class="table table-bordered">
					<thead>                  
						<tr>
							<th width="30" class="text-center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);"/></th>
							<th class="text-center">Xóa</th>
							<th>Tiêu đề</th>
							<th class="text-center" width="50px">Hot</th>
							<th class="text-center" width="80px">Hiển thị</th>
							<th class="text-center" width="100">Xem trước</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($total_rows>0){
							$star = ($cur_page - 1) * $max_rows;
							$strWhere.=" ORDER BY cdate DESC LIMIT $star,".$max_rows;
							$obj=SysGetList('tbl_content',array(), $strWhere, false);
							$stt=0;
							while($r=$obj->Fetch_Assoc()){
								$stt++;
								$ids = $r['id'];
								$cates = SysGetList('tbl_categories', array('title','alias'), ' AND id='.$r['cat_id']);
								$cate = count($cates)>0 ? $cates[0] : [];
								$cate_title = isset($cate['title']) ? $cate['title'] : '<i>N/A</i>';

								if(count($cates)){
									$link = ROOTHOST_WEB.$cate['alias'].'/'.$r['alias'].'-'.$r['id'].'.html';
								}else{
									$link = '';
								}

								if($r['isactive'] == 1) 
									$icon_active    = "<i class='fas fa-toggle-on cgreen'></i>";
								else $icon_active   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';

								if($r['ishot'] == 1) 
									$icon_ishot    = "<i class='fas fa-toggle-on cgreen'></i>";
								else $icon_ishot   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';

								$thumbnail = getThumb($r['images'], 'thumbnail', '');
								?>
								<tr>
									<td width='30' align='center' class="td-actions">
										<label class="action mt-3" style="border:0px"><input type='checkbox' name='chk' id='chk' onclick="docheckonce('chk');" value='<?php echo $ids;?>'/></label>
									</td>

									<td width='30' align='center'><a class="action" href='<?php echo ROOTHOST.COMS."/delete/".$r['id'];?>' onclick='return confirm("Bạn có chắc muốn xóa?")'><i class='fa fa-trash cred mt-3' aria-hidden='true'></i></a></td>

									<td>
										<div class="widget-td-title">
											<div class="widget-thumbnail"><a class="action mt-3" href="<?php echo ROOTHOST.COMS.'/edit/'.$r['id'];?>"><?php echo $thumbnail;?></a></div>
											<div class="widget-title">
												<a class="action mt-3" href="<?php echo ROOTHOST.COMS.'/edit/'.$r['id'];?>"><?php echo Substring($r['title'], 0, 20);?></a>
												<div class="widget-list-info">
													<ul class="list-unstyle">
														<li><a href="#"><?php echo $r['author'];?></a></li>
														<li><a href="" target="_blank"><?php echo $cate_title;?></a></li>
														<span class="td-public-time"><?php echo date('H:i | d-m-Y', $r['cdate']);?></span>
													</ul>
												</div>
											</div>
										</div>
									</td>
									<td class="text-center td-actions"><a class="action mt-3" style="border:0px" href="<?php echo ROOTHOST.COMS.'/ishot/'.$r['id'];?>"><?php echo $icon_ishot;?></a></td>
									<td class="text-center td-actions"><a class="action mt-3" style="border:0px" href="<?php echo ROOTHOST.COMS.'/active/'.$r['id'];?>"><?php echo $icon_active;?></a></td>
									<td class="text-center">
										<a class="action" href="<?php echo $link;?>" target="_blank"><i class="fa fa-eye mt-3" aria-hidden="true"></i></a>
									</td>
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