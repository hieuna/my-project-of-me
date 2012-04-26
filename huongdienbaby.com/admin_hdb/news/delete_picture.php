<?
require_once("config_security.php");

$file				= getValue("field","str","GET","picture");
$url				= base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET",0);
//kiem tra quyen co duoc sua xoa hay ko
checkRowUser($fs_table,$field_id,$record_id,$url);

$field_delete	= "new_picture";
//Delete pictues with ID
switch($file){
	case "download":
		$field_delete="new_download";
	break;
}
delete_file($fs_table,"new_id",$record_id,$field_delete,$fs_filepath);
//Update new_picture field width NULL value
$db_delete = new db_execute("UPDATE " . $fs_table . " SET " . $field_delete . " = '' WHERE new_id = " . $record_id);
unset($db_delete);
redirect($url);
?>