<?
require_once ("../../resource/security/security.php");

$module_id = 56;
$module_name = "Quản lý tags cloud";
//Check user login...
checkLogged ();
//Check access module...
if (checkAccessModule ( $module_id ) != 1)
	redirect ( $fs_denypath );

	//Declare prameter when insert data
$fs_table = "tag_multi";
$id_field = "tag_id";
$name_field = "tag_name";
?>