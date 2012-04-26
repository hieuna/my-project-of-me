<?
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("delete");

require_once("../../classes/database.php");
require_once("../../functions/functions.php");
require_once("../../functions/file_functions.php");
$url=base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET",0);
$field_id		= "pro_id";
//kiểm tra quyền sửa xóa của user xem có được quyền ko
checkRowUser($fs_table,$field_id,$record_id,$url);

//Delete data with ID
delete_file($fs_table,"pro_id",$record_id,"pro_picture",$fs_filepath);
$db_delete = new db_query("DELETE FROM " . $fs_table . " WHERE pro_id = " . $record_id);
delete_file("pictures_product","pipr_product",$record_id,"pipr_name",$fs_filepath);
$pictures_product = new db_query("DELETE FROM pictures_product WHERE pipr_product = " . $record_id);
unset($pictures_product);
$pictures_product = new db_query("DELETE FROM products_relate WHERE id_record = " . $record_id . " OR id_relate=" . $record_id);
redirect($url);
?>