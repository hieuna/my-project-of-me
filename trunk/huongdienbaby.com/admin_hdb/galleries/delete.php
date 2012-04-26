<?
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("delete");

$url				=	base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET",0);
checkRowUser($fs_table,$field_id,$record_id,$url);
//Delete data with ID
delete_file($fs_table,"gal_id",$record_id,"gal_picture",$fs_filepath);
$db_del 			= new db_execute("DELETE FROM " . $fs_table . " WHERE gal_id =" . $record_id);
unset($db_del);
redirect($url);
?>