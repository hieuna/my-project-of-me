<?
$module_id = 5;
//check security...
require_once("../security/security.php");
checkloggedin();
if (checkaccess($module_id) != 1){
	header("location: ../deny.htm");
	exit();
}
require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
require_once("../../classes/upload.php");
require_once("../../functions/functions.php");
require_once("../../functions/file_functions.php");

$fs_table		= "banners";
$field_id		= "ban_id";

$fs_filepath	= "../../banners/";
$extension_list = "jpg,gif,swf";
$limit_size		= 1300000;
$array_type = array(3=>"Left",4=>"Home banner 1",10=>"Home banner 2",11=>"Home banner 3",5=>"Type banner 1",12=>"Type banner 2",13=>"Type banner 3",14=>"Banner khuyến mại",15=>"Banner bottom");

$mnu_target = array("Current window" => "_self", "New window" => "_blank");
?>