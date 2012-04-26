<?
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("edit");

$returnurl = base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
//Khai bao Bien
$errorMsg = "";
$iQuick = getValue("iQuick","str","POST","");
if ($iQuick == 'update'){
	$record_id = getValue("record_id", "str", "POST", "",1,1);
	$com_description = getValue("com_description", "str", "POST", "",1,1);
	
	$db_ex = new db_execute("UPDATE comments SET com_description = '" . $com_description . "' WHERE com_name = '" . $record_id . "'");
	redirect($returnurl);

}
?>