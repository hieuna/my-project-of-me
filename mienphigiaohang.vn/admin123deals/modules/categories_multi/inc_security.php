<?
$module_id = 1;

$fs_table = "categories_multi";
$field_id = "cat_id";
$field_name = "cat_name";

$fs_filepath = "../../../pictures/category/";
$extension_list = "jpg,gif,png";
$limit_size = 5000;

//check security...
require_once ("../../resource/security/security.php");
//Check user login...
checkLogged ();
//Check access module...
if (checkAccessModule ( $module_id ) != 1)
	redirect ( $fs_denypath );

$array_value = array ("static" => "Trang tĩnh", "product" => "Danh mục sản phẩm" );
$array_config = array ("image" => 1, "upper" => 1, "order" => 1, "description" => 1 );

?>