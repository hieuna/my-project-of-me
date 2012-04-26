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
	case "pro_active":
		$filed="pro_active";
	break;
	case "pro_new":
		$filed="pro_new";
	break;
	case "pro_hot":
		$filed="pro_hot";
	break;
	case "pro_promotion":
		$filed="pro_promotion";
	break;
	case "pro_sp_khuyenmai":
		$filed="pro_sp_khuyenmai";
	break;
	case "pro_khuyenmai":
		$filed="pro_khuyenmai";
	break;
	case "pro_stock":
		$filed="pro_stock";
	break;
	
	default:
		$filed="pro_active";
		$value=0;
	break;
}
$url=base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$db_category	= new db_execute("UPDATE " . $fs_table . " SET " . $filed . " = " . $value . " WHERE lang_id = " . $_SESSION["lang_id"] . " AND pro_id=" . $record_id);
//echo "UPDATE " . $fs_table . " SET " . $filed . " = " . $value . " WHERE lang_id = " . $_SESSION["lang_id"] . " AND pro_id=" . $record_id;
unset($db_category);
redirect($url);
?>