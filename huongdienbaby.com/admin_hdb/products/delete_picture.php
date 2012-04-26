<?
require_once("config_security.php");
require_once("../../classes/database.php");
require_once("../../functions/functions.php");
require_once("../../functions/file_functions.php");
$url=base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET",0);
//Delete pictues with ID
delete_file($fs_table,"pro_id",$record_id,"pro_picture",$fs_filepath);
//Update pro_picture field width NULL value
$db_delete = new db_execute("UPDATE " . $fs_table . " SET pro_picture = '' WHERE pro_id = " . $record_id);
unset($db_delete);
redirect($url);
?>