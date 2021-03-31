<?php
define('OBJ_PAGE','ALBUM');
$strWhere="";
$GetID = isset($_GET['id']) ? (int)$_GET["id"] : 0;
$get_q = isset($_GET['q']) ? antiData($_GET['q']) : '';

/*Gán strWhere*/
if($get_q!=''){
	$flg_search = 1;
	$strWhere.=" AND title LIKE '%".$get_q."%'";
}

/*Begin pagging*/
if(!isset($_SESSION['CUR_PAGE_'.OBJ_PAGE])){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = 1;
}
if(isset($_POST['txtCurnpage'])){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = (int)$_POST['txtCurnpage'];
}

$total_rows=SysCount('tbl_album',$strWhere);
$max_rows = 20;

if($_SESSION['CUR_PAGE_'.OBJ_PAGE] > ceil($total_rows/$max_rows)){
	$_SESSION['CUR_PAGE_'.OBJ_PAGE] = ceil($total_rows/$max_rows);
}
$cur_page=(int)$_SESSION['CUR_PAGE_'.OBJ_PAGE]>0 ? $_SESSION['CUR_PAGE_'.OBJ_PAGE] : 1;
/*End pagging*/

$res_albums = SysGetList('tbl_album', array(), ' AND id='. $GetID);
if(count($res_albums) <= 0){
	echo 'Không có dữ liệu.'; 
	return;
}
$row = $res_albums[0];
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark"><?php echo $row['title'];?></h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST;?>">Bảng điều khiển</a></li>
					<li class="breadcrumb-item"><a href="<?php echo ROOTHOST.'album';?>">Danh sách album</a></li>
					<li class="breadcrumb-item active">Danh sách ảnh <?php echo $row['title'];?></li>
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
						<input type='text' id='txt_title' name='q' value="<?php echo $get_q;?>" class='form-control' placeholder="Tên..." />
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
					
					<span class="btn btn-upload_images btn-primary float-sm-right">
						<i class="fa fa-upload" aria-hidden="true"></i> Upload ảnh
						<input type="file" id="upload_images" name="upload_images" multiple accept="image/x-png,image/gif,image/jpeg">
					</span>

					<button type="button" id="media_library" class="btn btn-primary float-sm-right" style="margin-right: 10px;">
						<i class="fa fa-folder-open" aria-hidden="true"></i> Media library
					</button>
				</div>
			</div>
		</div>

		<div class="card">
			<!-- <div class="gallery-images">
				<div class="grid">
					<div class="w-14">
						<div class="wr-item">
							<div class="wrap-img">
								<img src="http://localhost/newhome/medias/albums/222.jpg" class="img">
							</div>
							<div class="wr-tool">
								<span class="bt bt-select"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
								<span class="bt bt-edit"><i class="fas fa-edit"></i></span>
								<span class="bt bt-dropdown"><i class="fa fa-times" aria-hidden="true"></i></span>
							</div>
						</div>
					</div>
					<div class="w-14">
						<div class="wr-item">
							<div class="wrap-img">
								<img src="http://localhost/newhome/medias/albums/222.jpg" class="img">
							</div>
							<div class="wr-tool">
								<span class="bt bt-select"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
								<span class="bt bt-edit"><i class="fas fa-edit"></i></span>
								<span class="bt bt-dropdown"><i class="fa fa-times" aria-hidden="true"></i></span>
							</div>
						</div>
					</div>
					<div class="w-14">
						<div class="wr-item">
							<div class="wrap-img">
								<img src="http://localhost/newhome/medias/albums/222.jpg" class="img">
							</div>
							<div class="wr-tool">
								<span class="bt bt-select"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
								<span class="bt bt-edit"><i class="fas fa-edit"></i></span>
								<span class="bt bt-dropdown"><i class="fa fa-times" aria-hidden="true"></i></span>
							</div>
						</div>
					</div>
					<div class="w-14">
						<div class="wr-item">
							<div class="wrap-img">
								<img src="http://localhost/newhome/medias/albums/222.jpg" class="img">
							</div>
							<div class="wr-tool">
								<span class="bt bt-select"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
								<span class="bt bt-edit"><i class="fas fa-edit"></i></span>
								<span class="bt bt-dropdown"><i class="fa fa-times" aria-hidden="true"></i></span>
							</div>
						</div>
					</div>
					<div class="w-14">
						<div class="wr-item">
							<div class="wrap-img">
								<img src="http://localhost/newhome/medias/albums/222.jpg" class="img">
							</div>
							<div class="wr-tool">
								<span class="bt bt-select"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
								<span class="bt bt-edit"><i class="fas fa-edit"></i></span>
								<span class="bt bt-dropdown"><i class="fa fa-times" aria-hidden="true"></i></span>
							</div>
						</div>
					</div>
					<div class="w-14">
						<div class="wr-item">
							<div class="wrap-img">
								<img src="http://localhost/newhome/medias/albums/222.jpg" class="img">
							</div>
							<div class="wr-tool">
								<span class="bt bt-select"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
								<span class="bt bt-edit"><i class="fas fa-edit"></i></span>
								<span class="bt bt-dropdown"><i class="fa fa-times" aria-hidden="true"></i></span>
							</div>
						</div>
					</div>
					<div class="w-14">
						<div class="wr-item">
							<div class="wrap-img">
								<img src="http://localhost/newhome/medias/albums/222.jpg" class="img">
							</div>
							<div class="wr-tool">
								<span class="bt bt-select"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
								<span class="bt bt-edit"><i class="fas fa-edit"></i></span>
								<span class="bt bt-dropdown"><i class="fa fa-times" aria-hidden="true"></i></span>
							</div>
						</div>
					</div>
					<div class="w-14">
						<div class="wr-item">
							<div class="wrap-img">
								<img src="http://localhost/newhome/medias/albums/222.jpg" class="img">
							</div>
							<div class="wr-tool">
								<span class="bt bt-select"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
								<span class="bt bt-edit"><i class="fas fa-edit"></i></span>
								<span class="bt bt-dropdown"><i class="fa fa-times" aria-hidden="true"></i></span>
							</div>
						</div>
					</div>
					<div class="w-14">
						<div class="wr-item">
							<div class="wrap-img">
								<img src="http://localhost/newhome/medias/albums/222.jpg" class="img">
							</div>
							<div class="wr-tool">
								<span class="bt bt-select"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
								<span class="bt bt-edit"><i class="fas fa-edit"></i></span>
								<span class="bt bt-dropdown"><i class="fa fa-times" aria-hidden="true"></i></span>
							</div>
						</div>
					</div>
					<div class="w-14">
						<div class="wr-item">
							<div class="wrap-img">
								<img src="http://localhost/newhome/medias/albums/222.jpg" class="img">
							</div>
							<div class="wr-tool">
								<span class="bt bt-select"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
								<span class="bt bt-edit"><i class="fas fa-edit"></i></span>
								<span class="bt bt-dropdown"><i class="fa fa-times" aria-hidden="true"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div> -->
			<div class='table-responsive'>
				<table class="table table-bordered">
					<thead>                  
						<tr>
							<th style="width: 10px">#</th>
							<th>Xóa</th>
							<th>Tiêu đề</th>
							<th>Mô tả</th>
							<th class="order">Sắp xếp</th>
							<th style="text-align: center;" width="80px">Hiển thị</th>
							<th style="text-align: center;" width="80px">Sửa</th>
						</tr>
					</thead>
					<tbody>
						<!-- <tr>
							<td width='30' align='center' class="td-actions"><span class="action mt-3" style="border:0px">1</span></td>

							<td align='center' width='10'><a href=''><i class='fa fa-trash cred' aria-hidden='true'></i></a></td>

							<td>
								<div class="widget-td-title">
									<div class="wrap-thumb avatar" data-src="http://localhost/newhome/medias/contents/222_xox.jpg">
										<a href="http://localhost/newhome/viet-kieu-nguyen-nga-voi-du-an-bao-ton-cau-long-bien-88.html" title="Việt kiều Nguyễn Nga với Dự án bảo tồn cầu Long Biên"><img src="http://localhost/newhome/global/img/no-photo.jpg"></a>
									</div>
									<div class="widget-title">Ảnh Mini-course on optimal stopping of diffusions and Lévy processes</div>
								</div>
							</td>

							<td>Ảnh Mini-course on optimal stopping of diffusions and Lévy processes</td>

							<td width='50' align='center'><input style='width: 50px;' type='number' min='0' name='txt_order' value="" size="4" class="order text-center"></td>

							<td class="text-center"><a href=""></a></td>
							<td class="text-center"></td>
						</tr> -->
						<?php
						if($total_rows>0){
							$star = ($cur_page - 1) * $max_rows;
							$strWhere.=" ORDER BY cdate DESC LIMIT $star,".$max_rows;
							$obj=SysGetList('tbl_gallery',array(), $strWhere, false);
							$stt=0;
							while($r=$obj->Fetch_Assoc()){
								$stt++;
								$ids = $r['id'];
								$intro = Substring($row['intro'], 0, 12);
								$thumbnail = getThumb('', 'thumbnail', '');
								$order = $r['order'];

								if($r['isactive'] == 1) 
									$icon_active    = "<i class='fas fa-toggle-on cgreen'></i>";
								else $icon_active   = '<i class="fa fa-toggle-off cgray" aria-hidden="true"></i>';
								?>
								<tr>
									<td width='30' align='center' class="td-actions"><span class="action mt-3" style="border:0px"><?php echo $stt + $star;?></span></td>

									<td align='center' width='10'><a href='<?php echo ROOTHOST.COMS."/delete/".$r['id'];?>' onclick='return confirm("Bạn có chắc muốn xóa?")'><i class='fa fa-trash cred' aria-hidden='true'></i></a></td>

									<td>
										<div class="widget-td-title">
											<div class="wg-avatar" data-src="<?php echo $r['avatar'];?>"><?php echo $thumbnail;?></div>
											<div class="widget-title">
												<?php echo Substring($r['name'], 0, 20);?>
											</div>
										</div>
									</td>

									<td><?php echo $intro;?></td>

									<td width='50' align='center'><input style='width: 50px;' type='number' min='0' name='txt_order' value="<?php echo $order;?>" size="4" class="order text-center" data-id='<?php echo $r['id'];?>'></td>
									
									<td class="text-center"><a href="<?php echo ROOTHOST.COMS.'/active/'.$r['id'];?>"><?php echo $icon_active;?></a></td>
									<td class="text-center">
										<a href="<?php echo ROOTHOST.COMS.'/edit/'.$r['id'];?>"><i class="fas fa-edit cblue"></i></a>
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
		<nav class="d-flex justify-content-center"><?php paging($total_rows,$max_rows,$cur_page);?></nav>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		// Hidden left sidebar
		$('#body').addClass('sidebar-collapse');

		$('.gallery-images .bt').on('click', function(){
			
		});
	})
</script>