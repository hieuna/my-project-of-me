<?
require_once("inc_security.php");
//check quyền them sua xoa
checkAddEdit("delete");
$fs_redirect	= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET");

//kiểm tra quyền sửa xóa của user xem có được quyền ko
//checkRowUser($fs_table,$field_id,$record_id,$fs_redirect);

//Delete data with ID

//$db_del = new db_execute("DELETE FROM ". $fs_table ." WHERE Id =" . $record_id);
//unset($db_del);
//$db_del = new db_execute("DELETE FROM admin_user_category WHERE auc_category_id =" . $record_id);
//unset($db_del);


	$db_del = new db_execute("DELETE FROM ". $fs_table ." WHERE  ".$id_field." IN(" .$record_id. ");");
	
	if($db_del->total>0){
		echo "Có " . $db_del->total . " bản ghi đã được xóa !";
	}else
	{
		echo "Lệnh xóa không thành công";
	}
	unset($db_del);

redirect($fs_redirect);

?>