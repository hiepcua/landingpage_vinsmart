<?php
$user=getInfo('username');
$isAdmin=getInfo('isadmin');
// Init variables
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Bảng điều khiển </h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<?php 
		$numberRegistered=SysCount('tbl_registration',"AND isactive=1");
		?>
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-danger">
					<div class="inner">
						<h3><?php echo number_format($numberRegistered);?></h3>
						<p>Đơn đăng ký</p>
					</div>
					<div class="icon">
						<i class="fa fa-registered"></i>
					</div>
					<a href="<?php echo ROOTHOST;?>registration" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
		</div>
		<!-- /.row -->
		
		<!-- Main row -->
		<div class="card">

		</div>
	</div>
	<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->