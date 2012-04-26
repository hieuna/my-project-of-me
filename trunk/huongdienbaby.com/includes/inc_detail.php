<div>
<?
require_once("../functions/functions.php");
$type=strtolower(getValue("module","str","GET"));
switch($type){
	case "product":
		include("inc_detail_product.php");
	break;
	case "static":
		include("inc_detail_static.php");
	break;
	case "news":
	case "baiviet":
		include("inc_detail_news.php");
	break;
	default:
		include("inc_detail_product.php");
	break;}
?>
</div>