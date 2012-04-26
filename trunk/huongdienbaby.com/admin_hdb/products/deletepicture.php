<? include("config_security.php");?>
<? require_once("../../classes/database.php");
require_once("../../functions/functions.php");
require_once("../../functions/file_functions.php");
$ff_imagepath     ="../../pictures/";
$iPipr = getValue("iPipr");
$iPro = getValue("iPro");
$action=getValue("action","str","GET");
delete_file("pictures_product","pipr_id",$iPipr,"pipr_name",$ff_imagepath);
$pictures_product = new db_query("DELETE FROM pictures_product WHERE pipr_id = " . $iPipr);
redirect("picturesproduct.php?temp=" . getValue("temp","str") . "&action=" . getValue("action","str"));
?>