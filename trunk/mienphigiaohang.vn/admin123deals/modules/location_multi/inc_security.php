<?
require_once ("../../resource/security/security.php");

$module_id = 55;
$module_name = "Quản lý vùng";
//Check user login...
checkLogged ();
//Check access module...
if (checkAccessModule ( $module_id ) != 1)
	redirect ( $fs_denypath );

	//Declare prameter when insert data
$fs_table = "location_multi";
$id_field = "loca_id";
$name_field = "loca_title";
$break_page = "{---break---}";

?>