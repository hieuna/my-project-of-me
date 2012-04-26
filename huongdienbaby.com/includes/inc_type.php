<?
$module = getValue("module","str","GET","");
switch($module){
	case "product":
		include("inc_type_banner2.php");
		include("inc_type_product.php");
	break;
	case "news":
		include("inc_type_news.php");	
	break;
	case "gallery":
		include("inc_type_gallery.php");	
	break;
	case "faq":
		include("inc_type_faq.php");	
		include("inc_faq_post.php");	
	break;
}
?>