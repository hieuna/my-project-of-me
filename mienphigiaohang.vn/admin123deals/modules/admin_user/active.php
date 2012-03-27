<?
include("inc_security.php");

$record_id	= getValue("record_id");
$redirect	= getValue("redirect", "str", "GET", base64_encode("listing.php"));
$redirect	= base64_decode($redirect);
$db_check	= new db_query("SELECT adm_active FROM " . $fs_table . " WHERE adm_isadmin = 0 AND " . $id_field . " = " . $record_id);
if($check	= mysql_fetch_array($db_check->result)){
	if($check["adm_active"] == 0) $query_str = "UPDATE " . $fs_table . " SET adm_active = 1 WHERE " . $id_field . " = " . $record_id;
	else $query_str = "UPDATE " . $fs_table . " SET adm_active = 0 WHERE " . $id_field . " = " . $record_id;
	$db_active = new db_execute($query_str);
	unset($db_active);
}
unset($db_check);
redirect($redirect);
?>