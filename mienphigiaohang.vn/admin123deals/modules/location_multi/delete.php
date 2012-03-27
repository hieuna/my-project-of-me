<?
	include("inc_security.php");
	//check quyền them sua xoa
	checkAddEdit("delete");
	$returnurl 		= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
	$record_id		= getValue("record_id","str","POST","0");
	//Delete data with ID
	$db_del = new db_execute("DELETE FROM ". $fs_table ." WHERE " . $id_field . " IN(" . $record_id . ")");
	
	if($db_del->total>0){
		echo "Có " . $db_del->total . " bản ghi đã được xóa !";
	}else
	{
		echo "Lệnh xóa không thành công";
	}
	unset($db_del);
?>