<?
$module_id = 6;
//check security...
require_once("../security/security.php");
checkloggedin();
if (checkaccess($module_id) != 1){
	header("location: ../deny.htm");
	exit();
}
$fs_table		= "statics";
$field_id		= "sta_id";
?>