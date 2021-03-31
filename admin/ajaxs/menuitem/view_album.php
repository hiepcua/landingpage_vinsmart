<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');
$plink = isset($_POST['link']) ? trim($_POST['link']) : '';
$_link = isset($_POST['link']) ? addslashes($_POST['link']) : '#';
$selected_id = isset($_POST['selected_id']) ? (int)$_POST['selected_id'] : 0;
?>
<div class="form-group">
	<label>Album</label>
	<select onchange="change_album(this)" name="cbo_selected" class="form-control">
		<option value="0">-- Chọn một --</option>
		<?php
		$res_albums = SysGetList('tbl_album', [], "AND isactive=1");
		if(count($res_albums)>0){
			foreach ($res_albums as $key => $value) {
				$link = ROOTHOST_WEB.'album/'.$value['code'].'-'.$value['id'];
				if($value['id'] == $selected_id){
					echo '<option value="'.$value['id'].'" data-link="'.$link.'" selected>'.$value['title'].'</option>';
				}else{
					echo '<option value="'.$value['id'].'" data-link="'.$link.'">'.$value['title'].'</option>';
				}
			}
		}
		?>
	</select>
</div>
<div class="form-group">
	<label>Link album<span id="err_link" class="mes-error"></span></label><small class="cred"> (*)</small>
	<input name="txtlink" type="text" id="txtlink" class="form-control" value="<?php echo $_link; ?>" placeholder="http://" required />
</div>
<script type="text/javascript">
	function change_album(e){
		var link = e.options[e.selectedIndex].getAttribute('data-link');
		$('#txtlink').val(link);
	}
</script>