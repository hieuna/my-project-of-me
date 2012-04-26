<?
require_once("config_security.php");
//check quyền them sua xoa
require_once("../../classes/database.php");
require_once("../../functions/functions.php");
require_once("../../functions/file_functions.php");
$url=base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET",0);
//Delete data with ID
echo "DELETE FROM " . $fs_table . " WHERE mail_id =" . $record_id;
$db_del = new db_execute("DELETE FROM " . $fs_table . " WHERE mail_id =" . $record_id);
unset($db_del);
redirect($url);
?>