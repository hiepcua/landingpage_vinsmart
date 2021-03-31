<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');
$_link = isset($_POST['link']) ? addslashes($_POST['link']) : '#';
$selected_id = isset($_POST['selected_id']) ? (int)$_POST['selected_id'] : 0;
?>
<div class="form-group">
	<label>Html block</label>
	<select name="cbo_selected" class="form-control">
		<option value="0">-- Chọn một --</option>
		<?php
		$res_htmlblocks = SysGetList('tbl_html_block', [], "AND isactive=1");
		if(count($res_htmlblocks)>0){
			foreach ($res_htmlblocks as $key => $value) {
				if($value['id'] == $selected_id){
					echo '<option value="'.$value['id'].'" selected>'.$value['title'].'</option>';
				}else{
					echo '<option value="'.$value['id'].'">'.$value['title'].'</option>';
				}
			}
		}
		?>
	</select>
</div>
<div class="form-group">
	<label>Link html block<span id="err_link" class="mes-error"></span></label><small class="cred"> (*)</small>
	<input name="txtlink" type="text" id="txtlink" class="form-control" value="<?php echo $_link; ?>" placeholder="http://" required />
</div>