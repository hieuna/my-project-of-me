<? include ("config_security.php"); ?>
<?
$record_id=getValue("record_id");
$sql="";
$type=getValue("type","str","GET","",1);
$value=getValue("value");
$filed="";
switch($type){
	case "gal_new":
		$filed="gal_new";
	break;
	case "gal_hot":
		$filed="gal_hot";
	break;
	default:
		$filed="gal_active";
		$value=0;
	break;
}
$url				= base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$db_category	= new db_execute("UPDATE " . $fs_table . " SET " . $filed . " = " . $value . " WHERE lang_id = " . $_SESSION["lang_id"] . " AND gal_id=" . $record_id);
unset($db_category);
redirect($url);
?>