<?php
define('OBJ_PAGE','partner');
// Init variables
$user=getInfo('username');
$isAdmin=getInfo('isadmin');
$strWhere="";

if($isAdmin==1){
	$strWhere.="";
}else{
	$strWhere.=" AND `author`='".$user."'";
}

$get_q = isset($_GET['q']) ? antiData($_GET['q']) : '';
$action = isset($_GET['cbo_action']) ? addslashes(trim($_GET['cbo_action'])) : '';

/*Gán strWhere*/
if($get_q!=''){
	$strWhere.=" AND name LIKE '%".$get_q."%'";
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

$total_rows=SysCount('tbl_partner',$strWhere);
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
				<h1 class="m-0 text-dark">Đối tác liên kết</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item active">Đối tác liên kết</li>
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
							<th class="text-center" width="50px">#</th>
							<th class="text-center" width="50px">Xóa</th>
							<th>Tên</th>
							<th>Mô tả</th>
							<th class="text-center" width="80px">Sắp xếp</th>
							<th class="text-center" width="80px">Hiển thị</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($total_rows>0){
							$star = ($cur_page - 1) * $max_rows;
							$strWhere.=" ORDER BY cdate DESC, `order` ASC LIMIT $star,".$max_rows;
							$obj=SysGetList('tbl_partner',array(), $strWhere, false);
							$stt=0;
							while($r=$obj->Fetch_Assoc()){
								$stt++;
								$ids = $r['id'];
								$intro = Substring($r['intro'], 0, 12);
								
								if($r['isactive'] == 1) 
									$icon_active    = "<i class='fas fa-toggle-on cgreen'></i>";
								else $icon_active   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';
								?>
								<tr>
									<td width='10' align='center'><span class="action mt-3" style="border:0px"><?php echo $stt + $star;?></span></td>

									<td class="text-center"><a class="action mt-3" href='<?php echo ROOTHOST.COMS."/delete/".$r['id'];?>' onclick='return confirm("Bạn có chắc muốn xóa?")'><i class='fa fa-trash cred' aria-hidden='true'></i></a></td>

									<td><a href="<?php echo ROOTHOST.COMS.'/edit/'.$r['id'];?>"><?php echo $r['name'];?></a></td>
									<td><?php echo $intro;?></td>

									<td width='50' class='text-center'><input style='width: 50px;' type='number' min='0' name='txt_order' value="<?php echo $r['order'];?>" size="4" class="order text-center" onchange='order(this)' data-id="<?php echo $r['id'];?>"></td>

									<td class="text-center td-actions"><a class="action mt-3" style="border:0px" href="<?php echo ROOTHOST.COMS.'/active/'.$r['id'];?>"><?php echo $icon_active;?></a></td>
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
			<?php paging($total_rows,$max_rows,$cur_page);?>
		</nav>
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
		$.post('<?php echo ROOTHOST;?>ajaxs/order/partner.php', _data, function(res){
			if(parseInt(res)==1){
				window.location.reload();
			}else{
				alert('Lỗi!');
			}
		});
	}
</script>