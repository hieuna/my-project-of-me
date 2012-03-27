<?
require_once("inc_security.php");
//check quyền them sua xoa
checkAddEdit("edit");
$returnurl      = base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$field_id		= "mer_id";
$action_all        = getValue("action_all","str","POST");  

//Khai bao Bien
$errorMsg = "";
$iQuick = getValue("iQuick","str","POST","");


if ($iQuick == 'update'){
    $record_id = getValue("record_id", "arr", "POST", "");   
	if($record_id != ""){
		for($i=0; $i<count($record_id); $i++){
            
			$errorMsg="";                        
			$myform = new generate_form();       
			$myform->removeHTML(0);
            //Insert to database
			$myform->add("mer_name","mer_name" . $record_id[$i],0,0,"",1,"Tên merchant không được trống",0,"");
            
			
			
            $myform->addTable($fs_table);
			$errorMsg .= $myform->checkdata();
            $alertmsg = removeHTML($errorMsg);
            $alertmsg = str_replace('&bull;','',$alertmsg);
			if($alertmsg!=''){
                echo '<script type="text/javascript" language="javascript">alert("'.$alertmsg.'");</script>';  
            }
			if($errorMsg == ""){
				$db_ex = new db_execute($myform->generate_update_SQL("mer_id",$record_id[$i]));
			}
		}
	}
	echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
	echo "Đang cập nhật dữ liệu !";
	redirect($returnurl);

}
?>