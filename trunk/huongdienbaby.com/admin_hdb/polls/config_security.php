<?
$module_id = 24;
//check security...
require_once("../security/security.php");
checkloggedin();
if (checkaccess($module_id) != 1){
	header("location: ../deny.htm");
	exit();
}
$fs_table 	= "polls";
require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
?>