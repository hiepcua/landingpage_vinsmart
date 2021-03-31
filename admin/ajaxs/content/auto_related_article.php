<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');
$cate_id = isset($_POST['cate_id']) ? (int)$_POST['cate_id'] : 0;

$res_contents = SysGetList('tbl_content', [], "AND `cat_id`=".$cate_id." ORDER BY `title` ASC LIMIT 0,4");
if(count($res_contents)>0){
	foreach ($res_contents as $key => $value) {
		$images = $value['images']!='' ? $value['images'] : IMAGE_DEFAULT;
		echo '<div class="article_item w-25">';
		echo '<a href="javascript:void(0)" class="remove_article" onclick="remove_article(this)"><i class="fa fa-window-close" aria-hidden="true"></i></a>';
		echo '<input type="hidden" name="related_articles[]" value="'.$value['id'].'">';
		echo '<a class="title" href="javascript:void(0)">';
		echo '<div class="wrap-thumb" data-src="'.$images.'" style="background-image: url(\''.$images.'\');">';
		echo '<img src="'.ROOTHOST.'global/img/no-photo.jpg" class="" style="display: none;">';
		echo '</div>';
		echo '<div class="name">'.$value['title'].'</div>';
		echo '</a>';
		echo '</div>';
	}
}else{
	echo "No data!";
}
?>