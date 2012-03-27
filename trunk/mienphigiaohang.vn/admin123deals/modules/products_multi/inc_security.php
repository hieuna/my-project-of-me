<?php
$module_id = 62;

$fs_table = "products_multi";
$field_id = "pro_id";
$field_name = "pro_name";
$fs_img_upload = "../../../pictures/thumbnail/";
$fs_img_products = "../../../pictures/products/";
$extension_list = "jpg,gif,png,jpeg";
$limit_size = 300000;

//check security...
require_once ("../../resource/security/security.php");
//Check user login...
checkLogged ();
//Check access module...
if (checkAccessModule ( $module_id ) != 1)
	redirect ( $fs_denypath );
$adm_name = getValue("userlogin","str","SESSION","");

$array_config = array ("image" => 1, "upper" => 1, "order" => 1, "description" => 1 );
$arrayLocation = array(   1 =>"Hà nội",
                        	2 =>"TP.Hồ Chí Minh",                      
                        );	
?>