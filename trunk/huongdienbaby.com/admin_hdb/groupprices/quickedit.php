<?
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("edit");

$returnurl = base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
//Khai bao Bien
$errorMsg = "";
$iQuick = getValue("iQuick","str","POST","");
if ($iQuick == 'update'){
	$record_id = getValue("record_id", "arr", "POST", "");
	if($record_id != ""){
		for($i=0; $i<count($record_id); $i++){
			checkRowUser($fs_table,$field_id,$record_id[$i],$returnurl);
			$errorMsg="";
			//Call Class generate_form();
			$myform = new generate_form();
			//Loại bỏ chuc nang thay the Tag Html
			$myform->removeHTML(0);
			//Insert to database
			$myform->add("grp_name","grp_name_" . $record_id[$i],0,0,"",0,"",0,"");
			$myform->add("grp_order","grp_order_" . $record_id[$i],1,0,0,0,"",0,"");
			//Add table
			$myform->addTable($fs_table);
			$errorMsg .= $myform->checkdata();
			if($errorMsg == ""){
				$db_ex = new db_execute($myform->generate_update_SQL("grp_id",$record_id[$i]));
				//echo $myform->generate_update_SQL("grp_id",$record_id[$i]);
				echo $errorMsg;
				echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
				echo "Đang cập nhật dữ liệu !";
			}
		}
	}
	redirect($returnurl);

}
?>