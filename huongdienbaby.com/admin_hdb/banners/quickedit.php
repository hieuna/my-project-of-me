<?
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("edit");

$url=base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
//Khai bao Bien
//Call Class generate_form();
$myform = new generate_form();
//Loại bỏ chuc nang thay the Tag Html
$myform->removeHTML(0);
/*
1. data_field : Ten truong
2. data_value : Ten form
3. data_type : Kieu du lieu , 0 : string , 1 : kieu int, 2 : kieu email, 3 : kieu double
4. data_store : Noi luu giu data  0 : post, 1 : variable
5. data_default_value : gia tri mac dinh, neu require thi` phai lon hon hoac bang default
6. data_require : du lieu nay co can thiet hay khong
7. data_error_message : Loi dua ra man hinh
8. data_unique : Chỉ có duy nhất trong database
9. data_error_message2 : Loi dua ra man hinh neu co duplicate
*/
$ban_name			= getValue("ban_name","str","POST","");
$ban_channel		= getValue("ban_channel","str","POST","");
$ban_type			= getValue("ban_type","int","POST",0);
$ban_url				= getValue("ban_url","str","POST","");
$ban_target			= getValue("ban_target","str","POST","");
$ban_order			= getValue("ban_order","int","POST",0);
$ban_description	= getValue("ban_description","str","POST","");
//Insert to database
$myform->add("ban_name","ban_name",0,0,"",1,"Please enter banner name !",0,"Please enter banner name");
$myform->add("ban_channel","ban_channel",0,0,"",0,"",0,"");
$myform->add("ban_type","ban_type",1,0,0,1,"Do not set position !",0,"Do not set position");
$myform->add("ban_url","ban_url",0,0,"",0,"Please enter URL !",0,"Please enter URL");
$myform->add("ban_target","ban_target",0,0,"",1,"Please choose a target !",0,"Please choose a target");
$myform->add("ban_order","ban_order",1,0,0,1,"Please set order",0,"Please set order");
$myform->add("ban_description","ban_description",0,0,"",0,"",0,"");
$cat_list = "";
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$iQuick = getValue("iQuick","str","POST","");
if ($iQuick == 'update'){
	$record_id = getValue("record_id", "int", "POST", 0);
	
	checkRowUser($fs_table,$field_id,$record_id,$url);
	/*
	upload function
	upload_name : Ten textbox upload vi du : ban_picture
	upload_path : duong dan save file upload
	extension_list : danh sach cac duoi mo rong duoc phep upload vi du : gif,jpg
	limt_size : dung luong gioi han (tinh bang byte) vi du : 20000 
	*/
	$upload_pic = new upload("picture", $fs_filepath, $extension_list, $limit_size);
	if ($upload_pic->file_name != ""){
		$picture = $upload_pic->file_name;
		//resize_image($fs_filepath,$upload_pic->file_name,100,100,75);
		$myform->add("ban_picture","picture",0,1,"",0,"",0,"");
	}
	//Delete picture
	if ($upload_pic->file_name != ""){
		//Delete file
		delete_file($fs_table,"ban_id",$record_id,"ban_picture",$fs_filepath);
	}
	//Check Error!
	$errorMsg .= $upload_pic->show_warning_error();
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$query_delete = "DELETE FROM banners_categories WHERE bcs_banner = " . $record_id;
		//echo $query_delete;
		$db_del_data = new db_execute($query_delete);
		$db_ex = new db_execute($myform->generate_update_SQL("ban_id", $record_id));
		//Hien thi loi
		redirect($url);
		exit();
	}else{
			echo $errorMsg;

	}
	
}
?>