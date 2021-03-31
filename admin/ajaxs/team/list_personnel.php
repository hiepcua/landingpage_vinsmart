<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');
$ids = isset($_POST['ids']) ? $_POST['ids'] : [];
?>
<br/>
<div class="wg-header">
	<div class="form-inline"><input type="text" id="model-ip-search" name="model-ip-search" class="form-control float-sm-right" placeholder="Ít nhất 2 ký tự"><button class="btn btn-primary" id="model-btn-search" style="margin-left: 10px;">Tìm kiếm</button></div>
</div><br/>
<div class='table-responsive form-group'>
	<table class="table table-bordered">
		<thead>                  
			<tr>
				<th style="width: 30px">#</th>
				<th>Họ và tên</th>
				<th>Chức vụ</th>
				<th>Cơ quan công tác</th>
			</tr>
			<tbody id="model-tbl-body">
				<?php
				$res_personnels = SysGetList('tbl_personnel', [], "ORDER BY `order` ASC, `name` ASC");
				if(count($res_personnels)>0){
					foreach ($res_personnels as $key => $value) {
						if(!in_array($value['id'], $ids)){
							echo '<tr>';
							echo '<td><div class="form-check">
							<input class="form-check-input ip_chk_personnel" data-id="'.$value['id'].'" data-name="'.$value['name'].'" name="ip_chk_personnel" type="checkbox">
							</div></td>';
							echo '<td>'.$value['name'].'</td>';
							echo '<td>'.$value['position'].'</td>';
							echo '<td>'.$value['work_place'].'</td>';
							echo '</tr>';
						}
					}
				}
				?>
			</tbody>
		</thead>
	</table>
</div>
<div class='form-group text-center' >
	<button class='btn btn-primary' id='ajx_add_personnel'><i class="fas fa-save"></i> Chọn nhà khoa học</button>
	<button class='btn btn-default pull-right' id='ajx_cancel_personnel'>Hủy <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-backspace-reverse-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M0 3a2 2 0 0 1 2-2h7.08a2 2 0 0 1 1.519.698l4.843 5.651a1 1 0 0 1 0 1.302L10.6 14.3a2 2 0 0 1-1.52.7H2a2 2 0 0 1-2-2V3zm9.854 2.854a.5.5 0 0 0-.708-.708L7 7.293 4.854 5.146a.5.5 0 1 0-.708.708L6.293 8l-2.147 2.146a.5.5 0 0 0 .708.708L7 8.707l2.146 2.147a.5.5 0 0 0 .708-.708L7.707 8l2.147-2.146z"/>
</svg></button>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#ajx_add_personnel').on('click', function(){
			var data=[];
			$('input:checkbox[name=ip_chk_personnel]:checked').each(function(){
				var id = $(this).attr('data-id');
				var name = $(this).attr('data-name');
				var obj_tmp = {};
				obj_tmp.id = id;
				obj_tmp.name = name;
				data.push(obj_tmp);
			});
			append_personnel(data);
		});

		$('#model-btn-search').on('click', (function(){
			var val = $('#model-ip-search').val();
			var lg_val = val.length;
			var ids = [];
			<?php foreach($ids as $key => $val){ ?>
				ids.push('<?php echo $val; ?>');
			<?php } ?>

			if(lg_val>2){
				var _url="<?php echo ROOTHOST;?>ajaxs/personnel/search_personnel.php";
				$.post(_url, {'key': val, 'ids': ids}, function(req){
					$('#model-tbl-body').html(req);
				});
			}else{
				var _url="<?php echo ROOTHOST;?>ajaxs/personnel/search_personnel.php";
				$.post(_url, {"ids": ids}, function(req){
					$('#model-tbl-body').html(req);
				});
			}
		}));

		$('#ajx_cancel_personnel').on('click', function(){
			close_model();
		});
	});
</script>