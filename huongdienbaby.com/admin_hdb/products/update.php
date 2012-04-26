<? include("config_security.php");
require_once("../../functions/functions.php");
$db_picture	= new db_execute("UPDATE pictures_product SET pipr_order = " . getValue("pipr_order") . ", pipr_note = '" . getValue("pipr_note","str","GET","",1,1) . "' WHERE pipr_id=" . getValue("id_pipr"));
unset($db_picture);
redirectHTML("picturesproduct.php?temp=" . getValue("temp","str") . "&action=" . getValue("action","str"));
?>