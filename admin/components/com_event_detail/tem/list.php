<?php
define('OBJ_PAGE','event_detail');
$get_q = isset($_GET['q']) ? antiData($_GET['q']) : '';
$action = isset($_GET['cbo_action']) ? addslashes(trim($_GET['cbo_action'])) : '';
$strWhere="";

/*Check user permission*/
$isAdmin = getInfo('isadmin');
$userLogin = getInfo('username');
$res_Users = SysGetList('tbl_users', ['permission'], "AND username='".$userLogin."'");
$res_user = $res_Users[0];
$arr_permission = ($res_user['permission']!==null && $res_user['permission']!='[]' && $res_user['permission']!=='') ? json_decode($res_user['permission']) : [];

if(count(array_intersect($arr_permission, array_keys(PERMISSION_EVENT_DETAIL))) <= 0 && $isAdmin!=1){
	echo "Bạn không có quyền truy cập chức năng này.";
	exit();
}
/*End check user permission*/

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

$total_rows=SysCount('tbl_event_detail',$strWhere);
$max_rows = 20;

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
				<h1 class="m-0 text-dark">DS chi tiết tất cả HĐKH</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item active">DS chi tiết tất cả HĐKH</li>
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
                <form id="frm_search" method="get" action="<?php echo ROOTHOST.COMS;?>">
                    <div class="frm-search-box form-inline pull-left">
                    	<input type='text' id='txt_title' name='q' class='form-control' value="<?php echo $get_q?>" placeholder="Tên..." />
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
                </div>
                <a href="<?php echo ROOTHOST.COMS.'/add';?>" class="btn btn-primary float-sm-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới</a>
            </div>
        </div>

		<div class="card">
			<div class='table-responsive'>
				<table class="table table-bordered">
					<thead>                  
						<tr>
							<th>#</th>
							<th>Xóa</th>
							<th>Tiêu đề</th>
							<th>Hoạt động khoa học</th>
							<th class="order" width="100px">Sắp xếp</th>
							<th class="text-center" width="80px">Nổi bật</th>
							<th class="text-center" width="80px">Hiển thị</th>
							<th class="text-center" width="100px">Xem trước</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($total_rows>0){
							$star = ($cur_page - 1) * $max_rows;
							$strWhere.=" ORDER BY `order` ASC LIMIT $star,".$max_rows;
							$res_event_details = SysGetList('tbl_event_detail', [], $strWhere);
							$stt=0;
							foreach ($res_event_details as $key => $rows) {
								$stt++;
								$ids=$rows['id'];
								$title=$rows['title'];
								$number = $stt + $star;
								$event_id = (int)$rows['event_id'];
								$res_events = SysGetList('tbl_event', [], "AND id=".$event_id);
								$event_title = isset($res_events) && isset($res_events[0]) && $res_events[0]['title']!=='' ? $res_events[0]['title'] : '<i>NAN</i>';

								if($rows['isactive'] == 1) 
									$icon_active    = "<i class='fas fa-toggle-on cgreen'></i>";
								else $icon_active   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';

								if($rows['ishot'] == 1) 
									$icon_ishot    = "<i class='fas fa-toggle-on cgreen'></i>";
								else $icon_ishot   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';

								$link = ROOTHOST_WEB.$res_events[0]['alias'].'-'.$res_events[0]['id'].'/chi-tiet/'.$rows['alias'].'-'.$rows['id'];

								echo "<tr>";

								echo '<td width="30" align="center"><span class="action mt-3" style="border:0px">'.$number.'</span></td>';

								echo "<td align='center' width='10'><a href='".ROOTHOST.COMS."/delete/".$ids."' onclick='return confirm(\"Bạn có chắc muốn xóa?\")'><i class='fa fa-trash cred' aria-hidden='true'></i></a></td>";

								echo "<td><a href='".ROOTHOST.COMS."/edit/".$ids."'>".$title."</a></td>";
								echo "<td>".$event_title."</td>";

								$order = $rows['order'];
								echo "<td width='50' align='center'><input style='width: 50px;' type='number' min='0' name='txt_order' value=\"$order\" size=\"4\" class=\"order text-center\" data-id='".$ids."'></td>";

								echo "<td align='center'><a href='".ROOTHOST.COMS."/ishot/".$ids."'>".$icon_ishot."</a></td>";
								echo "<td align='center'><a href='".ROOTHOST.COMS."/active/".$ids."'>".$icon_active."</a></td>";
								echo "<td class='text-center'><a href='".$link."' target='_blank'><i class='fa fa-eye' aria-hidden='true'></i></a></td>";

								echo "</tr>";
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
            $.post('<?php echo ROOTHOST;?>ajaxs/order/order_event_detail.php', _data, function(res){
                if(parseInt(res)==1){
                    $(this).val(parseInt(res));
                }else{
                    $(this).val('error!');
                }
            });
        });
    })
</script>