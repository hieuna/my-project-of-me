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
	case "grp_active":
		$filed="grp_active";
	break;
	case "grp_show":
		$filed="grp_show";
	break;
	default:
		$filed="grp_active";
		$value=0;
	break;
}
$url=base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$db_category	= new db_execute("UPDATE " . $fs_table . " SET " . $filed . " = " . $value . " WHERE lang_id = " . $_SESSION["lang_id"] . " AND grp_id=" . $record_id);
//echo "UPDATE " . $fs_table . " SET " . $filed . " = " . $value . " WHERE lang_id = " . $_SESSION["lang_id"] . " AND grp_id=" . $record_id;
unset($db_category);
redirect(remove_xss($url));
?>