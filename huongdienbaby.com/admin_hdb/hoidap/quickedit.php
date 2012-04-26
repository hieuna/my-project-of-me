<?
//Created by: Mr Toản
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("edit");

require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
require_once("../../functions/functions.php");

$fs_redirect = base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$field_id		= "faq_id";
$record_id 		= getValue("record_id");

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
$faq_category	= getValue("faq_category","int","POST",0);
$faq_name		= getValue("faq_name","str","POST","");
//Insert to database
$myform->add("faq_category","faq_category",1,0,"",0,"",0,"Bạn chưa nhập chọn nhóm chuyên mục");
$myform->add("faq_name","faq_name",0,0,"",0,"",0,"Bạn chưa nhập tiêu đề bài viết");
$myform->add("faq_email","faq_email",0,0,"",0,"",0,"Bạn chưa nhập tiêu đề bài viết");
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$iQuick = getValue("iQuick","str","POST","");
if ($iQuick == 'update'){
	$record_id = getValue("record_id", "int", "POST", 0);
	//Check Error!
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex = new db_execute($myform->generate_update_SQL("faq_id", $record_id));
		//echo $myform->generate_update_SQL("faq_id", $record_id);
		//Hien thi loi
		echo $errorMsg;
		redirect($fs_redirect);
		exit();
	}
}
?>