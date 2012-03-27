<?
require_once("../../resource/security/security.php");

$module_id	= 63;
$module_name= "Ảnh slide sản phẩm";
//Check user login...
$adm_name = getValue("userlogin","str","SESSION","");
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);
//Declare prameter when insert data
$fs_table		= "pic_pro";
$id_field		= "pic_id";
$name_field		= "pic_pro_id";
$fs_insert_logo  		= 0;
$fs_fieldupload  		= "pic_link";
$fs_filepath   			= "../../../pictures/slide_pro/";
$fs_extension   		= "gif,jpg,jpe,jpeg,png,swf";
$fs_filesize   			= 10000;
$width_small_image 		= 450;
$height_small_image 	= 300;
$width_normal_image 	= 470;
$height_normal_image	= 310;  					
?>