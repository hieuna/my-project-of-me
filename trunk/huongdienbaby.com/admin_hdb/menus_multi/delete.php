<?
require_once("config_security.php");
require_once("../../classes/database.php");
require_once("../../functions/functions.php");
require_once("../../functions/file_functions.php");
$url=base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET",0);
//Delete data with ID
delete_file($fs_table,"mnu_id",$record_id,"mnu_picture",$fs_filepath);
delete_file($fs_table,"mnu_id",$record_id,"mnu_picture_hover",$fs_filepath);
$db_delete = new db_query("DELETE FROM " . $fs_table . " WHERE mnu_id = " . $record_id);
redirect($url);
?>