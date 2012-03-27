<?
$module     =   getValue("module","str","GET","");
$keyword    =   getValue("keyword","str","GET","");
$cat_id_search = getValue("cat_id_search");
if($keyword=="Từ khóa tìm kiếm"){
    $module = '';
}

switch($module){
	case "product":        
		include("inc_detail_pro.php");       
        break;  
    default:
        include("inc_top_product.php");
        break;
}
?>