<?
//Created by: Mr Toan
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("edit");

require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
require_once("../../classes/upload.php");
require_once("../../functions/functions.php");
require_once("../../functions/file_functions.php");
require_once("../../functions/resize_image.php");
require_once("../../functions/date_function.php");

$url				= base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id 		= getValue("record_id", "int", "POST", 0);
$fs_redirect	= $url;
$field_id		= "pro_id";
//kiểm tra quyền sửa xóa của user xem có được quyền ko
checkRowUser($fs_table,$field_id,$record_id,$fs_redirect);
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
$pro_category	= getValue("pro_category","int","POST",0);
$pro_name		= getValue("pro_name","str","POST","");
$pro_date		= getValue("pro_date","str","POST","");
//Checkdate
$pro_date = convertDateTime($pro_date,"0:0:0");
//Insert to database
$myform->add("pro_category","pro_category",1,0,0,0,"",0,"Bạn chưa nhập chọn nhóm chuyên mục");
$myform->add("pro_name","pro_name",0,0,"",0,"",0,"Bạn chưa nhập tiêu đề bài viết");
$myform->add("pro_teaser","pro_teaser",0,0,"",0,"",0,"");
$myform->add("pro_date","pro_date",0,1,0,0,"",0,"Bạn chưa nhập ngày đăng tin");
$myform->add("pro_price","pro_price",3,0,0,0,"",0,"");
$myform->add("pro_weight","pro_weight",1,0,0,0,"",0,"");
$myform->add("pro_stock","pro_stock",1,0,0,0,"",0,"");
$myform->add("pro_warranty","pro_warranty",0,0,"",0,"",0,"");
$myform->add("pro_khuyenmai","pro_khuyenmai",0,0,"",0,"",0,"");
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$iQuick = getValue("iQuick","str","POST","");
if ($iQuick == 'update'){
	$record_id = getValue("record_id", "int", "POST", 0);
	// du lieu cho truong tim kien
	$textsearch	= '';
	$db_catname=new db_query("SELECT cat_name,pro_description FROM categories_multi," . $fs_table . " WHERE cat_id = pro_category AND pro_id=" . $record_id);
	if($rowcat=mysql_fetch_array($db_catname->result)){
		$textsearch		.= $rowcat["cat_name"] . ' ';
		$textsearch		.= $rowcat["pro_description"];
	}
	$db_catname->close();
	unset($db_catname);
	//array này gồm key là nội dung ; value 1 là lấy từ biến, 0 là lấy từ post
	$myform->add_Field_Seach("pro_search",array("pro_name"=>0,"pro_teaser"=>0,"textsearch"=>1,"pro_code"=>0));
	/*
	upload function
	upload_name : Ten textbox upload vi du : pro_picture
	upload_path : duong dan save file upload
	extension_list : danh sach cac duoi mo rong duoc phep upload vi du : gif,jpg
	limt_size : dung luong gioi han (tinh bang byte) vi du : 20000 
	*/
	$upload_pic = new upload("picture", $fs_filepath, $extension_list, $limit_size);
	if ($upload_pic->file_name != ""){
		$picture = $upload_pic->file_name;
		//resize images
		resize_image($fs_filepath,$upload_pic->file_name,$medium_width,$medium_heght,$medium_quantity,"medium_");
		resize_image($fs_filepath,$upload_pic->file_name,$small_width,$small_heght,$small_quantity,"small_");
		$myform->add("pro_picture","picture",0,1,"",0,"",0,"");
		//chmod images
		@chmod($fs_filepath . $picture,0644);
		@chmod($fs_filepath . 'small_' . $picture,0644);
		@chmod($fs_filepath . 'medium_' . $picture,0644);
	}
	//Delete picture
	if ($upload_pic->file_name != ""){
		//Delete file
		delete_file($fs_table,"pro_id",$record_id,"pro_picture",$fs_filepath);
		/*echo "<script>alert('\$record_id = " . $record_id . "')</script>";*/
	}
	//Check Error!
	$errorMsg .= $upload_pic->show_warning_error();
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex = new db_execute($myform->generate_update_SQL("pro_id", $record_id));
		//echo $myform->generate_update_SQL("pro_id", $record_id);
		//Hien thi loi
		echo $errorMsg;
		redirect($url);
		exit();
	}
}
?>