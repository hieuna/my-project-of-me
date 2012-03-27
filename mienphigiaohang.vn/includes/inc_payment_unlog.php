<?
$module     =   getValue("module","str","GET","");
$keyword    =   getValue("keyword","str","GET","");
$cat_id_search = getValue("cat_id_search");
if($keyword=="Từ khóa tìm kiếm"){
    $module = '';
}

switch($module){	
	case "login":        
		include("inc_login_payment.php");       
        break; 	
    default:
        include("inc_payment_register.php");
        break;
}
?>