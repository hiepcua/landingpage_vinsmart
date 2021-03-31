<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');
$row = isset($_POST) ? json_decode($_POST['data'], true) : array();
?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Tác giả</label>
			<input type="text" id="author" name="author" class="form-control" value="<?php echo $row['author'];?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Tác giả tiền ấn phẩm</label>
			<input type="text" id="author_pre_publication" name="author_pre_publication" class="form-control" value="<?php echo $row['author_pre_publication'];?>">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Ngày xuất bản</label>
			<input type="date" id="pdate" name="pdate" class="form-control" value="<?php echo $row['pdate']!=='' && $row['pdate']!==null ? date('Y-m-d', $row['pdate']) : '';?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>File</label> <small>(Chọn một file)</small>
			<input type="file" id="file" name="file" class="form-control" value="">
		</div>
	</div>
</div>

<div class="form-group">
	<label>Đường dẫn file</label>
	<input type="text" id="file_path" name="file_path" class="form-control" value="<?php echo $row['file_path'];?>">
</div>

<div class="form-group">
	<label>Nhà khoa học</label>
	<div id="list_personnel">
		<?php
		$ar_personnel_ids = $row['personnel'] !== '' ? json_decode($row['personnel']) : [];
		if(count($ar_personnel_ids)>0){
			$res_personnels = SysGetList('tbl_personnel', [], 'AND isactive=1 ORDER BY `name` ASC');
			foreach ($res_personnels as $key => $value) {
				if(in_array($value['id'], $ar_personnel_ids)){
					echo '<span class="personnel_item" data-id="'.$value['id'].'">'.$value['name'].' <i class="fa fa-times" onclick="remove_personnel(this)" aria-hidden="true"></i><input type="hidden" name="personnel[]" value="'.$value['id'].'" /></span>';
				}
			}
		}
		?>
	</div>
	<div><span class="btn btn-primary" id="add_personnel"><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm nhà khoa học</span></div>
</div>

<div class="form-group">
	<label>Tóm tắt</label>
	<textarea id="fulltext" name="fulltext" class="form-control"><?php echo $row['fulltext'];?></textarea>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		tinymce.init({
			selector: '#fulltext',
			height: 300,
			plugins: [
			'link image imagetools table lists autolink fullscreen media hr code'
			],
			image_title: true,
			automatic_uploads: true,
			toolbar: 'bold italic underline | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify |  numlist bullist | removeformat | insertfile image media link anchor codesample | outdent indent fullscreen',
			contextmenu: 'link image imagetools table spellchecker lists',
			content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
			image_caption: true,
			images_reuse_filename: true,
			images_upload_credentials: true,
			relative_urls : false,
			remove_script_host : false,
			convert_urls : true,

            // override default upload handler to simulate successful upload
            images_upload_handler: function (blobInfo, success, failure) {
            	var xhr, formData;

            	xhr = new XMLHttpRequest();
            	xhr.withCredentials = false;
            	xhr.open('POST', '<?php echo ROOTHOST;?>ajaxs/upload.php');

            	xhr.onload = function() {
            		console.log(xhr.responseText);
            		var json;

            		if (xhr.status != 200) {
            			failure('HTTP Error: ' + xhr.status);
            			return;
            		}

            		json = JSON.parse(xhr.responseText);

            		if (!json || typeof json.location != 'string') {
            			failure('Invalid JSON: ' + xhr.responseText);
            			return;
            		}

            		success(json.location);
            	};

            	formData = new FormData();
            	formData.append('file', blobInfo.blob(), blobInfo.filename());
            	formData.append('folder', 'publish/');
            	xhr.send(formData);
            },
        });

		$('#add_personnel').on('click', function(){
			var _url="<?php echo ROOTHOST;?>ajaxs/team/list_personnel.php";
			var ids=[];
			if($('.personnel_item')){
				$('.personnel_item').each(function(){
					var id=$(this).attr('data-id');
					ids.push(id);
				});
			}

			$.post(_url, {'ids': ids}, function(req){
				$('#popup_modal .modal-dialog').addClass('modal-xl');
				$('#popup_modal .modal-title').text('Danh sách nhà khoa học');
				$('#popup_modal .modal-body').html(req);
				$('#popup_modal').modal('show');
			});
		});
	});

	function append_personnel(data){
		var ids=[];
		var lg = data.length;
		var str='';

		if($('.personnel_item')){
			$('.personnel_item').each(function(){
				var id=$(this).attr('data-id');
				ids.push(id);
			});
		}

		if(lg>0){
			for(var i=0; i< lg; i++){
				var val = data[i];
				if(!ids.includes(val.id)){
					str+='<span class="personnel_item" data-id="'+val.id+'">'+val.name+' <i class="fa fa-times" onclick="remove_personnel(this)" aria-hidden="true"></i><input type="hidden" name="personnel[]" value="'+val.id+'"/></span>';
				}
			}
		}
		$('#list_personnel').append(str);
		close_model();
	}

	function close_model(){
		$('#popup_modal').modal('hide');
		$('#popup_modal .modal-dialog').removeClass('modal-xl');
	}

	function remove_personnel(e){
		e.parentElement.remove();
	}
</script>