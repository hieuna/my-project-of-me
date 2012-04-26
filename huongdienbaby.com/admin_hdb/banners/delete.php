<?
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("delete");

$url=base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET",0);

//kiểm tra quyền sửa xóa của user xem có được quyền ko
checkRowUser($fs_table,$field_id,$record_id,$url);

//Delete data with ID
delete_file($fs_table,"ban_id",$record_id,"ban_picture",$fs_filepath);
$db_delete = new db_query("DELETE FROM " . $fs_table . " WHERE ban_id = " . $record_id);
unset($db_delete);
$db_banner_category = new db_query("DELETE FROM banners_categories WHERE bcs_banner = " . $record_id);
unset($db_banner_category);
redirect($url);
?>