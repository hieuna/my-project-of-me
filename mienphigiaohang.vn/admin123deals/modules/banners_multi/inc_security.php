<?
require_once("../../resource/security/security.php");

$module_id	= 48;
$module_name= "Quảng cáo";
//Check user login...
$adm_name = getValue("userlogin","str","SESSION","");
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table		= "banners_multi";
$id_field		= "ban_id";
$name_field		= "ban_title";
$fs_insert_logo  		= 0;
$fs_fieldupload  		= "ban_picture";
$fs_filepath   			= "../../../pictures/banners/";
$fs_extension   		= "gif,jpg,jpe,jpeg,png,swf";
$fs_filesize   			= 5000;
$width_small_image 		= 130;
$height_small_image 	= 100;
$width_normal_image 	= 200;
$height_normal_image	= 500;
    $arrayLocation = array(   0 =>"--[Chọn vị trí hiển thị]--",
                        1 =>"Banner Top trang chủ",
                        2 =>"Banner right trang chủ",
                        3 =>"Banner right category",
                        );						
?>