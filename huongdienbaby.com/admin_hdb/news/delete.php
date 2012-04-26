<?
require_once("config_security.php");

$url				=	base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET",0);

//kiem tra quyen co duoc sua xoa hay ko
checkRowUser($fs_table,$field_id,$record_id,$url);

//Delete data with ID
delete_file($fs_table,$field_id,$record_id,"new_picture",$fs_filepath);
$db_delete = new db_query("DELETE FROM " . $fs_table . " WHERE new_id = " . $record_id);
$db_delete = new db_query("DELETE FROM " . $fs_table_relate . " WHERE rel_id = " . $record_id);
redirect($url);
?>