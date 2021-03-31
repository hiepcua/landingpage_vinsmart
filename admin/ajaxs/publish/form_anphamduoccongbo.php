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
			<label>Ngày xuất bản</label>
			<input type="date" id="pdate" name="pdate" class="form-control" value="<?php echo $row['pdate']!=='' && $row['pdate']!==null ? date('Y-m-d', $row['pdate']) : '';?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<div class="form-check">
				<input class="form-check-input" type="checkbox" name="is_pre_publication" value="1" <?php echo (int)$row['is_pre_publication']==1 ? 'checked' : '';?> id="is_pre_publication">
				<label class="form-check-label" for="is_pre_publication">Có tiền ấn phẩm</label>
			</div>
		</div>
	</div>
</div>

<div class="form-group">
	<label>Danh sách tiền ấn phẩm</label>
	<div id="list_pre_publication">
		<?php
		$ar_pre_publication_ids = $row['pre_publication']!=='' ? json_decode($row['pre_publication']) : [];
		if(count($ar_pre_publication_ids)>0){
			$res_pre_publications = SysGetList('tbl_publish', [], 'AND isactive=1 ORDER BY `title` ASC');
			foreach ($res_pre_publications as $key => $value) {
				if(in_array($value['id'], $ar_pre_publication_ids)){
					echo '<span class="pre_publication_item" data-id="'.$value['id'].'">'.$value['title'].' <i class="fa fa-times" onclick="remove_pre_publication(this)" aria-hidden="true"></i><input type="hidden" name="pre_publication[]" value="'.$value['id'].'" /></span>';
				}
			}
		}
		?>
	</div>
	<div><span class="btn btn-primary" id="add_pre_publication"><i class="fa fa-plus-square" aria-hidden="true"></i> Danh sách tiền ấn phẩm</span></div>
</div>

<div class="form-group">
	<label>Tạp chí đăng</label>
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
            	formData.append('folder', 'contents/');
            	xhr.send(formData);
            },
        });

        $('#add_pre_publication').on('click', function(){
			var _url="<?php echo ROOTHOST;?>ajaxs/publish/list_pre_publication.php";
			var ids=[];
			if($('.pre_publication_item')){
				$('.pre_publication_item').each(function(){
					var id=$(this).attr('data-id');
					ids.push(id);
				});
			}

			$.post(_url, {'ids': ids}, function(req){
				$('#popup_modal .modal-dialog').addClass('modal-xl');
				$('#popup_modal .modal-title').text('Danh sách tiền ấn phẩm');
				$('#popup_modal .modal-body').html(req);
				$('#popup_modal').modal('show');
			});
		});
	});

	function append_pre_publication(data){
		var ids=[];
		var lg = data.length;
		var str='';

		if($('.pre_publication_item')){
			$('.pre_publication_item').each(function(){
				var id=$(this).attr('data-id');
				ids.push(id);
			});
		}

		if(lg>0){
			for(var i=0; i< lg; i++){
				var val = data[i];
				if(!ids.includes(val.id)){
					str+='<span class="pre_publication_item" data-id="'+val.id+'">'+val.name+' <i class="fa fa-times" onclick="remove_pre_publication(this)" aria-hidden="true"></i><input type="hidden" name="pre_publication[]" value="'+val.id+'" /></span>';
				}
			}
		}
		$('#list_pre_publication').append(str);
		close_model();
	}

	function close_model(){
		$('#popup_modal').modal('hide');
		$('#popup_modal .modal-dialog').removeClass('modal-xl');
	}

	function remove_pre_publication(e){
		e.parentElement.remove();
	}
</script>