<?
require_once("config_security.php");

$returnurl 		= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET",0);
//check quyền them sua xoa
checkAddEdit("edit");
checkRowUser($fs_table,$field_id,$record_id,$returnurl);
//Delete data with ID
$db_del = new db_execute("DELETE FROM ". $fs_table ." WHERE grp_id =" . $record_id);
unset($db_del);
redirect($returnurl);

?>