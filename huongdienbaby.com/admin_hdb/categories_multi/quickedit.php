<?
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("edit");

require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
require_once("../../classes/upload.php");
require_once("../../functions/file_functions.php");
//require_once("../../functions/resize_image.php");
require_once("../../functions/functions.php");
$returnurl = base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$field_id		= "cat_id";

//Khai bao Bien
$errorMsg = "";
$iQuick = getValue("iQuick","str","POST","");
if ($iQuick == 'update'){
	$record_id = getValue("record_id", "arr", "POST", "");
	if($record_id != ""){
		for($i=0; $i<count($record_id); $i++){
			//kiểm tra quyền sửa xóa của user xem có được quyền ko
			checkRowUser($fs_table,$field_id,$record_id[$i],$returnurl);
			$errorMsg="";
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
			$cat_name			= getValue("cat_name" . $record_id[$i],"str","POST","");
			$cat_cha			= getValue("cat_cha" . $record_id[$i],"int","POST",0);
			$cat_order			= getValue("cat_order" . $record_id[$i],"int","POST",0);
			//Insert to database
			$myform->add("cat_name","cat_name" . $record_id[$i],0,0,"",0,"",0,"");
			$myform->add("cat_order","cat_order" . $record_id[$i],1,0,0,0,"",0,"");
			//$myform->add("cat_code","cat_code" . $record_id[$i],1,0,0,0,"",0,"");
			$myform->add("cat_group","cat_group" . $record_id[$i],1,0,0,0,"",0,"");
			//Add table
			$myform->addTable($fs_table);
			$upload_pic = new upload("picture" . $record_id[$i], $fs_filepath, $extension_list, $limit_size);
			if ($upload_pic->file_name != ""){
				$picture = $upload_pic->file_name;
				//resize_image($fs_filepath,$upload_pic->file_name,100,100,75);
				$myform->add("cat_picture","picture",0,1,"",0,"",0,"");
			}
			if ($upload_pic->file_name != ""){
				//Delete file
				delete_file($fs_table,"cat_id",$record_id[$i],"cat_picture",$fs_filepath);
				//Permision file
			}
			//Check Error!
			$errorMsg .= $upload_pic->show_warning_error();
			$errorMsg .= $myform->checkdata();
			if($errorMsg == ""){
				$db_ex = new db_execute($myform->generate_update_SQL("cat_id",$record_id[$i]));
				//echo $myform->generate_update_SQL("cat_id",$record_id[$i]);
				//echo $errorMsg;
			}
		}
	}
	echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
	echo "Đang cập nhật dữ liệu !";
	redirect($returnurl);

}
?>