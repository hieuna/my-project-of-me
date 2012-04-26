<?
$con_module_id = 26;
//check security...
require_once("../security/security.php");
checkloggedin();
if (checkaccess($con_module_id) != 1){
	header("location: ../deny.htm");
	exit();
}
$arrayStatus = array(1=>translate_text("chua_xem")
					 ,2=>translate_text("da_xem")
					 ,3=>translate_text("dang_cho_thanh_toan")
					 ,4=>translate_text("da_thanh_toan")
					 );
?>