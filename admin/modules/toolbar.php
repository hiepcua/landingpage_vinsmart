<div id="wg-toolbar">
	<form id="frm_actions" method="post" action="">
		<input type="hidden" name="txtaction" id="txtaction"/>
		<input type="hidden" name="txtids" id="txtids" />
	</form>
	<?php if(isset($_GET['viewtype']) && $_GET['viewtype']!=='list'){ ?>
	<a class="save" href="javascript:void(0)" onclick="dosubmitAction('frm_action','save');" title="Lưu"></a>
	<a class="close" href="<?php echo ROOTHOST.COMS;?>" title="Đóng"></a>
	<?php } else{ ?>
	<a class="addnew" href="<?php echo ROOTHOST.COMS;?>/add" title="Thêm mới"></a>
	<a class="delete" href="javascript:void(0)" title="Xóa" onclick="javascript:if(confirm('Bạn có chắc chắn muốn xóa thông tin này không?')){dosubmitAction('frm_actions','delete'); }" title="Xóa"></a>
	<?php } ?>
</div>