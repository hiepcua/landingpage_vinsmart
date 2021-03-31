<?php
$isAdmin=getInfo('isadmin');
?>
<style type="text/css">
	.nav-sidebar>.nav-item .nav-icon.fa, .nav-sidebar>.nav-item .nav-icon.fab, .nav-sidebar>.nav-item .nav-icon.far, .nav-sidebar>.nav-item .nav-icon.fas, .nav-sidebar>.nav-item .nav-icon.glyphicon, .nav-sidebar>.nav-item .nav-icon.ion{font-size: 1rem;}
	.nav-sidebar .nav-treeview>.nav-item>.nav-link>.nav-icon{font-size: 0.8em;}
	[class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link{font-size: 0.9em;}
</style>
<nav class="mt-2 pb-5">
	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		<?php if($isAdmin==1){ ?>
			<li class="nav-item">
				<a href="<?php echo ROOTHOST;?>registration" class="nav-link <?php activeMenu('registration', '', 'com');?> ">
					<i class="nav-icon fa fa-registered" aria-hidden="true"></i>
					<p>Đơn đăng ký</p>
				</a>
			</li>

			<li class="nav-item <?php menuOpen(array('setting', 'user', 'html_block', 'tag', 'menu', 'mnuitem', 'slider', 'module', 'partner'), 'com'); ?>">
				<a href="<?php echo ROOTHOST;?>setting" class="nav-link <?php activeMenus(array('setting', 'user', 'html_block', 'tag', 'menu', 'mnuitem', 'slider', 'module', 'partner'), 'com'); ?>">
					<i class="nav-icon fas fa-wrench" aria-hidden="true"></i>
					<p>Cấu hình<i class="right fas fa-angle-left"></i></p>
				</a>

				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="<?php echo ROOTHOST;?>user" class="nav-link <?php activeMenu('user', '', 'com');?>">
							<i class="nav-icon fas fa-user"></i>
							<p>Người dùng</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="<?php echo ROOTHOST;?>setting" class="nav-link <?php activeMenu('setting', '', 'com');?>">
							<i class="nav-icon fas fa-wrench" aria-hidden="true"></i>
							<p>Cấu hình website</p>
						</a>
					</li>
				</ul>
			</li>

		<?php }else{ ?>
			<li class="nav-item">
				<a href="<?php echo ROOTHOST;?>registration" class="nav-link <?php activeMenu('registration', '', 'com');?> ">
					<i class="nav-icon fa fa-registered" aria-hidden="true"></i>
					<p>Đơn đăng ký</p>
				</a>
			</li>
		<?php } ?>
	</ul>
</nav>
<script>
	$('.logout').click(function(){
		var _url="<?php echo ROOTHOST;?>ajaxs/user/logout.php";
		$.get(_url,function(){
			window.location.reload();
		})
	});

	function event_addnew(){
		var _url="<?php echo ROOTHOST;?>ajaxs/event/form_add.php";
		$.get(_url, function(req){
			$('#popup_modal .modal-dialog').addClass('modal-xl');
			$('#popup_modal .modal-title').html('Thêm mới hoạt động khoa học');
			$('#popup_modal .modal-body').html(req);
			$('#popup_modal').modal('show');
		});
	}
</script>