<?
require_once ("../../resource/security/security.php");

$module_id = 54;
$module_name = "Trang tĩnh";
//Check user login...
checkLogged ();
//Check access module...
if (checkAccessModule ( $module_id ) != 1)
	redirect ( $fs_denypath );

	//Declare prameter when insert data
$fs_table = "statics_multi";
$id_field = "sta_id";
$name_field = "sta_title";
$break_page = "{---break---}";
?>