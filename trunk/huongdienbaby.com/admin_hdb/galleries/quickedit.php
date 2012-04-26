<?
//Created by: Mr Toản
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("edit");

$fs_redirect 			= base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id 				= getValue("record_id");

checkRowUser($fs_table,$field_id,$record_id,$fs_redirect);
//Call Class generate_form();
$myform 					= new generate_form();
//Loại bỏ chuc nang thay the Tag Html
$myform->removeHTML(0);

//update to database
$myform->add("gal_name","gal_name",0,0,"",0,"",0,"Bạn chưa nhập tiêu đề bài viết");
$myform->add("gal_description","gal_description",0,0,"",0,"",0,"");
$myform->add("gal_order","gal_order",1,0,0,0,"",0,"");
$myform->add("gal_type","gal_type",1,0,0,0,"",0,"");
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg 				= "";
//Get Action.
$iQuick 					= getValue("iQuick","str","POST","");
if ($iQuick == 'update'){
	$record_id 			= getValue("record_id", "int", "POST", 0);
	$upload_pic = new upload("picture", $fs_filepath, $extension_list, $limit_size);
	if ($upload_pic->file_name != ""){
		$picture = $upload_pic->file_name;
		//delete_file($fs_table,"gal_id",$record_id,"gal_picture",$fs_filepath);
		resize_image($fs_filepath,$upload_pic->file_name,$small_width,$small_heght,$small_quantity);
		resize_image($fs_filepath,$upload_pic->file_name,$medium_width,$medium_heght,$medium_quantity,"medium_");
		$myform->add("gal_picture","picture",0,1,"",0,"",0,"");
	}
	//Check Error!
	$errorMsg .= $upload_pic->show_warning_error();
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex = new db_execute($myform->generate_update_SQL("gal_id", $record_id));
		
		//Hien thi loi
		redirect($fs_redirect);
		exit();
	}else{
				echo $errorMsg;
	}
}
?>