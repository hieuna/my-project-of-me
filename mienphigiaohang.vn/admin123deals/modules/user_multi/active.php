<?
include("inc_security.php");

$record_id	= getValue("record_id");
$redirect	= getValue("redirect", "str", "GET", base64_encode("listing.php"));
$redirect	= base64_decode($redirect);
$db_check	= new db_query("SELECT hide FROM " . $fs_table . " WHERE  " . $id_field . " = " . $record_id);
if($check	= mysql_fetch_array($db_check->result)){
	if($check["hide"] == 0) $query_str = "UPDATE " . $fs_table . " SET hide = 1 WHERE " . $id_field . " = " . $record_id;
	else $query_str = "UPDATE " . $fs_table . " SET hide = 0 WHERE " . $id_field . " = " . $record_id;
	$db_active = new db_execute($query_str);
	unset($db_active);
}
unset($db_check);
redirect($redirect);
?>