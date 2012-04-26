<? include ("config_security.php"); ?>
<? require_once("../../classes/database.php"); ?>
<? require_once("../../functions/functions.php"); ?>
<?
$record_id=getValue("record_id");
$sql="";
$type=getValue("type","str","GET","",1);
$value=getValue("value");
$filed="";
switch($type){
	case "new_active":
		$filed="new_active";
	break;
	case "new_new":
		$filed="new_new";
	break;
	case "new_hot":
		$filed="new_hot";
	break;
	case "new_approve":
		$filed="new_approve";
	break;
	case "new_baiviet":
		$filed="new_baiviet";
	break;
	default:
		$filed="new_active";
		$value=0;
	break;
}
$url=base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$db_category	= new db_execute("UPDATE " . $fs_table . " SET " . $filed . " = " . $value . " WHERE lang_id = " . $_SESSION["lang_id"] . " AND new_id=" . $record_id);
//echo "UPDATE " . $fs_table . " SET " . $filed . " = " . $value . " WHERE lang_id = " . $_SESSION["lang_id"] . " AND new_id=" . $record_id;
unset($db_category);
redirect($url);
?>