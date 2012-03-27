<?
require_once ("../../resource/security/security.php");

$module_id = 65;
$module_name = "Comments";
//Check user login...
checkLogged ();
//Check access module...
/*if (checkAccessModule ( $module_id ) != 1)
	redirect ( $fs_denypath );*/

	//Declare prameter when insert data
$fs_table = "comment_nulti";
$id_field = "comment_id";
$name_field = "pro_id";
$break_page = "{---break---}";

?>