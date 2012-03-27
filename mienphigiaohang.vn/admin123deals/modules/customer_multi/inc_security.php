<?
require_once("../../resource/security/security.php");

$module_id	= 61;
$module_name= "Quản lý - Đối tác deals";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table	= "partner_multi";
$id_field	= "par_id";
$name_field		= "par_name";
$break_page		= "{---break---}";
$fs_insert_logo  		= 0;
$fs_fieldupload  		= "par_logo";
$fs_extension   		= "gif,jpg,jpe,jpeg,png";
$fs_img_upload       = "../../../pictures/partner/";
$fs_img_products     = "../../../pictures/partner/";
$limit_size          = 200000;
$width_small_image 		= 130;
$height_small_image 	= 100;
$width_normal_image 	= 110;
$height_normal_image	= 74;
?>