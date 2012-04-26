<? include ("config_security.php"); ?>
<? require_once("../../classes/database.php"); ?>
<? require_once("../../functions/functions.php"); ?>
<?
$record_id				=	getValue("record_id");
$sql						=	"";
$type						=	getValue("type","str","GET","",1);
$value					=	getValue("value");
$filed					=	"";
switch($type){
	case "faq_approve":
		$filed			=	"faq_approve";
	break;
	default:
		$filed			=	"faq_approve";
		$value			=	0;
	break;
}
$url						=	base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$db_category			= new db_execute("UPDATE " . $fs_table . " SET " . $filed . " = " . $value . " WHERE  faq_id=" . $record_id);
unset($db_category);
redirect($url);
?>