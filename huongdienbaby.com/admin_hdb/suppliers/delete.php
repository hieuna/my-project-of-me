<?
require_once("config_security.php");
$returnurl = base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET",0);
//Delete data with ID
delete_file($fs_table,"sup_id",$record_id,"sup_picture",$fs_filepath);
$db_del = new db_execute("DELETE FROM ". $fs_table ." WHERE sup_id =" . $record_id);
unset($db_del);
redirect($returnurl);

?>