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
?>
<div class="form-group">
	<label>Link nhà khoa học<span id="err_link" class="mes-error"></span></label><small class="cred"> (*)</small>
	<input name="txtlink" type="text" id="txtlink" class="form-control" value="<?php echo $_link; ?>" placeholder="http://" required />
</div>