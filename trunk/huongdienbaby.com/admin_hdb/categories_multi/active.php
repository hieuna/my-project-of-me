<? 
include ("config_security.php"); 
//check quyền them sua xoa
checkAddEdit("edit");

?>
<? require_once("../../classes/database.php"); ?>
<? require_once("../../functions/functions.php"); ?>
<?
$record_id=getValue("record_id");
$sql="";
$type=getValue("type","str","GET","",1);
$value=getValue("value");
$filed="";
switch($type){
	case "cat_active":
		$filed="cat_active";
	break;
	case "cat_show":
		$filed="cat_show";
	break;
	case "cat_left":
		$filed="cat_left";
	break;
	default:
		$filed="cat_active";
		$value=0;
	break;
}
$url=base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$db_category	= new db_execute("UPDATE " . $fs_table . " SET " . $filed . " = " . $value . " WHERE lang_id = " . $_SESSION["lang_id"] . " AND cat_id=" . $record_id);
//echo "UPDATE " . $fs_table . " SET " . $filed . " = " . $value . " WHERE lang_id = " . $_SESSION["lang_id"] . " AND cat_id=" . $record_id;
unset($db_category);
redirect($url);
?>