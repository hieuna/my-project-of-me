<?
$fs_table				= "groupprices";
$field_id				= "grp_id";
$fs_filepath			= "../../channel_category/";
$extension_list 		= "jpg,gif,png";
$limit_size				= 300000;
$module_id			 	= 22;
//check security...
require_once("../security/security.php");
checkloggedin();
if (checkaccess($module_id) != 1){
	redirect("../deny.htm");
	exit();
}
require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
require_once("../../functions/functions.php");
require_once("../../classes/upload.php");
require_once("../../classes/menu.php");
require_once("../../functions/file_functions.php");
?>