<?php
define('incl_path','../global/libs/');
require_once(incl_path.'gffunc.php');

function random_personnel_code() {
	$alphabet = "0123456789abcdefghijklmnopqrstuwxyz";
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < 5; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}
$number = random_personnel_code();
die($number);
?>