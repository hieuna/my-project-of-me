<?
require_once("config_security.php");

$returnurl 		= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
	$record_id = getValue("record_id", "int", "GET");
//check quyền them sua xoa
checkAddEdit("edit");
$db_del = new db_execute("DELETE FROM ". $fs_table ." WHERE rev_id = " . $record_id . "");
unset($db_del);
redirect($returnurl);

?>