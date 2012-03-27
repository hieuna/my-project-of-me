<?
require_once("../../resource/security/security.php");

$module_id	= 59;
$module_name= "Đối tác";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);
//Declare prameter when insert data
$fs_table		= "paymentpartner_multi";
$id_field		= "mer_id";
$name_field		= "mer_name";
$break_page		= "{---break---}";
$fs_insert_logo  		= 0;
$fs_fieldupload  		= "mec_logo";
$fs_extension   		= "gif,jpg,jpe,jpeg,png";
$fs_img_upload       = "../../../pictures/banks/";
$fs_img_products     = "../../../pictures/banks/";
$limit_size          = 200000;
$width_small_image 		= 130;
$height_small_image 	= 100;
$width_normal_image 	= 110;
$height_normal_image	= 74;

?>