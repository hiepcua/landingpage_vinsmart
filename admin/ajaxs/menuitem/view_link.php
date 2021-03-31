<?php
$_link = isset($_POST['link']) ? addslashes($_POST['link']) : '#';
?>
<div class="form-group">
	<label>Link<span id="err_link" class="mes-error"></span></label><small class="cred"> (*)</small>
	<input name="txtlink" type="text" id="txtlink" class="form-control" value="<?php echo $_link; ?>" placeholder="http://" required />
</div>