<?
$con_module_id = 15;
//check security...
require_once("../security/security.php");
checkloggedin();
if (checkaccess($con_module_id) != 1){
	header("location: ../deny.htm");
	exit();
}
?>