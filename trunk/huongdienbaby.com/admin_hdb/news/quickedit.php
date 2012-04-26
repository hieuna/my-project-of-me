<?
//Created by: Mr Toan
require_once("config_security.php");

$url					=	base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id 			= getValue("record_id", "int", "POST", 0);
//kiem tra quyen co duoc sua xoa hay ko
checkRowUser($fs_table,$field_id,$record_id,$url);
//Khai bao Bien
//Call Class generate_form();
$myform = new generate_form();
//Checkdate
$new_date 			= convertDateTime($new_date,"0:0:0");
//Insert to database
$myform->add("new_category","new_category",1,0,"",1,"Bạn chưa chọn category ///r",0,"Bạn chưa nhập chọn nhóm chuyên mục");
$myform->add("new_title","new_title",0,0,"",1,"Tiêu đề tin không được để rỗng //r",0,"Bạn chưa nhập tiêu đề bài viết");
$myform->add("new_date","new_date",1,1,0,0,"",0,"Bạn chưa nhập ngày đăng tin");
$myform->add("new_location","new_location",0,0,"",0,"",0,"");
$myform->add("new_image_note","new_image_note",0,0,"",0,"",0,"");
$myform->add("new_teaser","new_teaser",0,0,"",0,"",0,"Bạn chưa có phần tóm tắt cho bài viết");

//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$iQuick = getValue("iQuick","str","POST","");
if ($iQuick == 'update'){
	$record_id = getValue("record_id", "int", "POST", 0);
	/*
	upload function
	upload_name : Ten textbox upload vi du : new_picture
	upload_path : duong dan save file upload
	extension_list : danh sach cac duoi mo rong duoc phep upload vi du : gif,jpg
	limt_size : dung luong gioi han (tinh bang byte) vi du : 20000 
	*/
	$upload_pic = new upload("picture", $fs_filepath, $extension_list, $limit_size);
	if ($upload_pic->file_name != ""){
		$picture = $upload_pic->file_name;
		resize_image($fs_filepath,$upload_pic->file_name,$small_width,$small_heght,$small_quantity);
		resize_image($fs_filepath,$upload_pic->file_name,$medium_width,$medium_heght,$medium_quantity,"medium_");
		$myform->add("new_picture","picture",0,1,"",0,"",0,"");
	}
	//Delete picture
	if ($upload_pic->file_name != ""){
		//Delete file
		delete_file($fs_table,"new_id",$record_id,"new_picture",$fs_filepath);
		//Permision file
	}
	//Check Error!
	$errorMsg .= $upload_pic->show_warning_error();
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex = new db_execute($myform->generate_update_SQL("new_id", $record_id));
		//echo $myform->generate_update_SQL("new_id", $record_id);
		//Hien thi loi
		redirect($url);
		exit();
	}else{
		echo '<script>alert("' . $errorMsg . '")</script>';
		redirect($url);
		exit();
	}
}
?>