<?php
session_start();
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_user.php');
require_once(libs_path.'cls.mysql.php');
$keywork = isset($_POST['keywork']) ? trim($_POST['keywork']) : '';

$res_contents = SysGetList('tbl_content', [], "AND `title` LIKE '%".$keywork."%' ORDER BY `order` ASC, `title` ASC LIMIT 0,10");
if(count($res_contents)>0){
	foreach ($res_contents as $key => $value) {
		echo '<a href="javascript:void(0)" class="article_item" onclick="select_related_article(this)" data-id="'.$value['id'].'" data-img="'.$value['images'].'" data-title="'.$value['title'].'">'.$value['title'].'</a>';
	}
}else{
	echo "No data!";
}
?>