<?
session_start();
require_once("../security/functions.php");
require_once("../../functions/functions.php");
require_once("../../functions/translate.php");
require_once("../../classes/database.php");
require_once("functions.php");
require_once("template.php");
require_once("../0/lang.php");
?>
<?
$lang_id			= getValue("lang_id", "int", "SESSION", 1);

//Set other config variable:
$fs_stype_css	= "../css/FSPortal.css";
$fs_imagepath	= "../images/";
$fs_error_image= "../images/error_image.gif";
$fs_no_image	= "../images/no_image.gif";
$fs_library_js	= "../js/library.js";
$fs_error		= "../error.php";
$fs_denypath	= "../deny.html";
$bordercolor	= "#80C65A";
$bgcolor			= "#DDF8CC";
$updatehelp 	= 1;
//check category 
$sqlcategory	= '';
$admin_id		= 0;
if(isset($_SESSION["user_id"])){
 $admin_id       = $_SESSION["user_id"];
 //check category 
 $sqlcategory	= checkCategory($admin_id);
}
$fs_today		= getdate();
$fs_change_bg	= 'onMouseOver="this.style.background=\'#DDF8CC\'" onMouseOut="this.style.background=\'#FEFEFE\'"';

// Get config variable from database
$db_config = new db_query("SELECT con_currency, con_root_path, con_mod_rewrite,con_extenstion,con_list_sosanh 
									FROM configuration WHERE con_lang_id = " . $lang_id);
if($row = mysql_fetch_array($db_config->result)){
	while(list($data_field, $data_value) = each($row)){
		if(!is_int($data_field)){
			$$data_field = $data_value;
		}
	}
}
$db_config->close();
unset($db_config);
$lang_path = '/1/';
?>