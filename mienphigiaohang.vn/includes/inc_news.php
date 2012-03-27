<?
$module     =   getValue("module","str","GET","");
$keyword    =   getValue("keyword","str","GET","");
$cat_id_search = getValue("cat_id_search");
if($keyword=="Từ khóa tìm kiếm"){
    $module = '';
}

switch($module){
	case "thongtin":        
		include("inc_static_news.php");       
        break;  
    default:
        include("inc_top_product.php");
        break;
}
?>