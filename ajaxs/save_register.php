<?php
session_start();
define('incl_path','../global/libs/');
define('libs_path','../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(libs_path.'cls.mysql.php');
// require_once(libs_path.'PHPMailer/mail.php');
$phone = antiData($_POST['phone']);
$email = antiData($_POST['email']);
$loai_canho = isset($_POST['form_item1737']) ? json_encode($_POST['form_item1737']) : '';
$_LOAI_CANHO = array(
    'CH1' => 'Căn hộ STUDIO: 28-33 m2 giá từ 1,2 - 1,5 tỷ',
    'CH2' => 'Căn hộ 1PN+1: 43 m2 giá từ 1,6 tỷ - 1,8 tỷ',
    'CH3' => 'Căn hộ 2PN, 1 WC: 55 m2 giá từ 1,6 tỷ',
    'CH4' => 'Căn hộ 2PN +1, 2 WC: 64 m2 giá từ 1,6 tỷ',
    'CH5' => 'Căn hộ 3PN, 2 WC : 75-94 m2 giá từ 2,7 tỷ',
    'CH6' => 'Mat_bang_layout_chi_tiet_Sapphire.pdf',
    'CH7' => 'Chinh_sach_new_11_3_2021.pdf',
    'CH8' => 'Bang_gia_full_Vat_update_3_2021.xlsx',
    'CH9' => 'Tieu_chuan_ban_giao_Sapphire.pdf',
    'CH10' => 'Tai_lieu_ban_hang_tong_hop.pdf',
);

// $subject = 'Đăng ký tư vấn';
// $content = 'Số điện thoại: '.$phone;
// if(count($_POST['form_item1737'])>0){
// 	$content.='<div>Loại hình căn hộ quan tâm:</div>';
// 	foreach ($_POST['form_item1737'] as $key => $value) {
// 		$content.='<div>'.$_LOAI_CANHO[$value].'</div>';
// 	}
// }

// if($email != ''){
// 	sendMail($subject, $content, $email);
// }

if($phone !== ''){
	SysAdd('tbl_registration', array('phone' => $phone, 'email' => $email, 'loai_canho' => $loai_canho, 'cdate'=>time()));
	die('success');
}else{
	die('error');
}
?>