<?php
define('OBJ_PAGE','tcommon_knowledge');
$strWhere="";
$get_q = isset($_GET['q']) ? antiData($_GET['q']) : '';
$get_site = isset($_GET['s']) ? antiData($_GET['s']) : '';

/*Gán strWhere*/
if($get_q!=''){
	$strWhere.=" AND title LIKE '%".$get_q."%'";
}

/*Begin pagging*/
if(!isset($_SESSION['CUR_PAGE_'.OBJ_PAGE])){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = 1;
}
if(isset($_POST['txtCurnpage'])){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = (int)$_POST['txtCurnpage'];
}

$total_rows=SysCount('tbl_common_knowledge',$strWhere);
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
				<h1 class="m-0 text-dark">Phổ biến kiến thức</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item active">Phổ biến kiến thức</li>
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
                    	<input type='text' id='txt_title' name='q' class='form-control' value="<?php echo $get_q?>" placeholder="Tiêu đề..." />
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
                    <a href="<?php echo ROOTHOST.COMS;?>/add" class="btn btn-primary float-sm-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới</a>
                </div>
            </div>
        </div>

		<div class="card">
			<div class='table-responsive'>
				<table class="table table-bordered">
					<thead>                  
						<tr>
							<th>Xóa</th>
							<th>Tiêu đề</th>
							<th>Địa điểm</th>
							<th class="order">Sắp xếp</th>
							<th class="text-center" width="80px">Hiển thị</th>
							<th class="text-center" width="100px">Xem trước</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($total_rows>0){
							$star = ($cur_page - 1) * $max_rows;
							$strWhere.=" LIMIT $star,".$max_rows;
							$res_common_knowledges = SysGetList('tbl_common_knowledge', [], $strWhere);

							if(count($res_common_knowledges)>0){
								foreach ($res_common_knowledges as $key => $rows) {
									$ids=$rows['id'];
									if($rows['isactive'] == 1) 
										$icon_active    = "<i class='fas fa-toggle-on cgreen'></i>";
									else $icon_active   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';

									echo "<tr>";

									echo "<td align='center' width='10'><a href='".ROOTHOST.COMS."/delete/".$ids."' onclick='return confirm(\"Bạn có chắc muốn xóa?\")'><i class='fa fa-trash cred' aria-hidden='true'></i></a></td>";

									echo "<td><a href='".ROOTHOST.COMS."/edit/".$ids."'>".$rows['title']."</a></td>";
									echo "<td>".$rows['place']."</td>";

									$order = $rows['order'];
									echo "<td width='50' align='center'><input style='width: 50px;' type='number' min='0' name='txt_order' value=\"$order\" size=\"4\" class=\"order text-center\" data-id='".$ids."'></td>";

									echo "<td align='center'><a href='".ROOTHOST.COMS."/active/".$ids."'>".$icon_active."</a></td>";
									echo "<td class='text-center'><a href='#' target='_blank'><i class='fa fa-eye' aria-hidden='true'></i></a></td>";
									
									echo "</tr>";
								}
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
            $.post('<?php echo ROOTHOST;?>ajaxs/order/order_common_knowledge.php', _data, function(res){
                if(parseInt(res)==1){
                    $(this).val(parseInt(res));
                }else{
                    $(this).val('error!');
                }
            });
        });
    })
</script>