<?
$module     =   getValue("module","str","GET","");
$keyword    =   getValue("keyword","str","GET","");
$cat_id_search = getValue("cat_id_search");
if($keyword=="Từ khóa tìm kiếm"){
    $module = '';
}

switch($module){
	case "suathongtin":        
		include("inc_user_profile.php");       
        break;  
	case "doipass":        
		include("inc_user_changepass.php");       
        break; 
	case "donhang":        
		include("inc_user_donhang.php");       
        break; 
    default:
        include("inc_top_product.php");
        break;
}
?>