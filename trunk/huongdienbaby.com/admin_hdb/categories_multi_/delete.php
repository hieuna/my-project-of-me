<?
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("delete");

require_once("../../classes/database.php");
require_once("../../functions/file_functions.php");
require_once("../../functions/functions.php");
$fs_redirect	= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET");
$field_id		= "cat_id";
//kiểm tra quyền sửa xóa của user xem có được quyền ko
checkRowUser($fs_table,$field_id,$record_id,$fs_redirect);
//Delete data with ID
delete_file($fs_table,"cat_id",$record_id,"cat_picture",$fs_filepath);
$db_del = new db_execute("DELETE FROM ". $fs_table ." WHERE cat_id =" . $record_id);
unset($db_del);
$db_del = new db_execute("DELETE FROM admin_user_category WHERE auc_category_id =" . $record_id);
unset($db_del);
$db_del = new db_execute("DELETE FROM products WHERE pro_category =" . $record_id);
unset($db_del);
redirect($fs_redirect);

?>