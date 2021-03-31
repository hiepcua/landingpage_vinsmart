<?php
session_start();
define('incl_path','../global/libs/');
define('libs_path','../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gffunc.php');
require_once(libs_path.'cls.mysql.php');

$name = isset($_POST['name']) ? antiData($_POST['name']) : '';
if($name !== ''){
	$alias = un_unicode($name);
	echo $alias;
}else{
	die("0");
}
?>