<?
	include("inc_security.php");
	//check quyền them sua xoa
	checkAddEdit("delete");
	$returnurl 		= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
	$record_id		= getValue("record_id","int","GET");
	
	//Delete data with ID
    $db_del = new db_execute("DELETE FROM pic_pro WHERE pic_id =" . $record_id);
    
	
	if($db_del->total > 0){
		echo "Có " . $db_del->total . " bản ghi đã được xóa !";
	}else
	{
		echo "Lệnh xóa không thành công";
	}
	unset($db_del);
    redirect($returnurl);
?>