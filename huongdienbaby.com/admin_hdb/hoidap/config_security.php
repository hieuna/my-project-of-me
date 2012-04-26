<?
$module_id = 25;
//check security...
require_once("../security/security.php");
checkloggedin();
if (checkaccess($module_id) != 1){
	header("location: ../deny.htm");
	exit();
}
$fs_table		= "faqs";
$field_id		= "faq_id";
?>