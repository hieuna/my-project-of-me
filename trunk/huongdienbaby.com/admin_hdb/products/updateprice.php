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

$returnurl = getValue("returnurl","str","POST","lprice.php");

$field_id		= "pro_id";
$record_id = getValue("record_id","arr","POST","");
//Warning Error!
$errorMsg = "";
//Get Action.
$iQuick = getValue("iQuick","str","POST","");
if ($iQuick == "update"){
	if(isset($record_id[0])){
		for($i=0;$i<count($record_id);$i++){
			//kiểm tra quyền sửa xóa của user xem có được quyền ko
			checkRowUser($fs_table,$field_id,$record_id[$i],$returnurl);

			$errorMsg='';
			//Call Class generate_form();
			$myform = new generate_form();
			//Loại bỏ chuc nang thay the Tag Html
			//$myform->removeHTML(0);
			$myform->add("pro_price","pro_price_" . $record_id[$i],3,0,0,0,"",0,"");
			//$myform->add("pro_price_market","pro_price_market_" . $record_id[$i],3,0,0,0,"",0,"");
			$myform->add("pro_khuyenmai","pro_khuyenmai_" . $record_id[$i],0,0,0,0,"",0,"");
			$myform->add("pro_stock","pro_stock_" . $record_id[$i],1,0,0,0,"",0,"");
			//Add table
			$myform->addTable($fs_table);
			$errorMsg .= $myform->checkdata();
			if($errorMsg == ""){
				$db_ex = new db_execute($myform->generate_update_SQL("pro_id", $record_id[$i]));
				//echo $myform->generate_update_SQL("pro_id", $record_id[$i]);
				unset($db_ex);
				//Hien thi loi
			}
			unset($errorMsg);
			unset($myform);
		}//end for
	}
	redirect($returnurl);
}
?>