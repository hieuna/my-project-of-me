<?
$module_id = 10;
//check security...
require_once("../security/security.php");
require_once("../../classes/menu.php");
checkloggedin();
if (checkaccess($module_id) != 1){
	header("location: ../deny.htm");
	exit();
}
$fs_table		= "menus_multi";
$fs_filepath	= "../../pictures/";
$extension_list = "jpg,gif";
$limit_size		= 10000;
$array_type = array("Menu Top"=>1,"Menu bottom"=>4);
$mnu_target_array = array("Current window" => "_self", "New window" => "_blank");
?>