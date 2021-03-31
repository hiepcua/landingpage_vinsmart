<?php
$GetID = isset($_GET['id']) ? (int)$_GET["id"] : 0;
$res_Publish = SysGetList('tbl_publish', array(), 'AND id='.$GetID);
$res_Cons = SysGetList('tbl_publish_history', array(), 'AND publish_id='.$GetID.' ORDER BY cdate DESC');
if(count($res_Cons) <= 0){
	echo 'Không có dữ liệu.'; 
	return;
}
$row = $res_Cons[0];
?>
<style type="text/css">
	.sapo p, .content p{
		margin-bottom: 10px;
	}
	.btn-view-history-detail{
		background-color: #007bff;
		color: #fff;
		padding: 3px 10px;
	}
	.btn-view-history-detail:hover {
	    color: #fff;
	}
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-12">
				<ol class="breadcrumb float-sm-left">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS;?>">Danh sách xuất bản</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.COMS.'/edit/'.$GetID;?>"><?php echo $res_Publish[0]['title'];?></a></li>
					<li class="breadcrumb-item active">Lịch sử xuất bản</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div id='action'>
			<div class='table-responsive'>
				<table class="table table-bordered">
					<thead>                  
						<tr>
							<th>Người sửa</th>
							<th>Tiêu đề xuất bản (hiện tại)</th>
							<th>Hành động</th>
							<th>Thời gian</th>
							<th>Công cụ</th>
						</tr>
					</thead>
					<tbody id="data-table">
						<?php
						$str_tr='';
						foreach ($res_Cons as $key => $value) {
							$str_tr.='<tr>';
							$str_tr.='<td><span class="label">'.$value['author_cms_name'].'</span></td>';
							$str_tr.='<td>'.$value['title'].'</td>';
							$str_tr.='<td class="text-center">'.$value['status'].'</td>';
							$str_tr.='<td>'.date('d-m-Y H:i:s', $value['cdate']).'</td>';
							$str_tr.='<td><a href="#" onclick="view_history(this)" data-id="'.$value['id'].'" class="btn-view-history-detail"><i class="fa fa-sign-in" aria-hidden="true"></i> Xem chi tiết</a></td>';
							$str_tr.='</tr>';
						}
						echo $str_tr;
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
<!-- /.row -->
<script type="text/javascript">
	function view_history(e){
		var _id = e.getAttribute('data-id');
		var _url="<?php echo ROOTHOST;?>ajaxs/publish/view_history.php";
		var _data = {
			"id": _id,
		}
		$.post(_url, _data, function(res){
			$('#popup_modal .modal-dialog').addClass('modal-lg');
			$('#popup_modal .modal-title').html('Lịch sử xuất bản');
			$('#popup_modal .modal-body').html(res);
			$('#popup_modal').modal('show');
		});
	}
</script>