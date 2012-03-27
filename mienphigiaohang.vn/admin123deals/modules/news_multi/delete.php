<?
include("inc_security.php");

$record_id	= getValue("record_id");
$redirect	= getValue("redirect", "str", "GET", base64_encode("listing.php"));
$db_delete	= new db_execute("DELETE FROM " . $fs_table . " WHERE  " . $id_field . " = " . $record_id);
unset($db_delete);
redirect(base64_decode($redirect));
?>