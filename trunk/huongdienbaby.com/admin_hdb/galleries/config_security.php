<?
$module_id = 20;
//check security...
require_once("../security/security.php");
checkloggedin();
if (checkaccess($module_id) != 1){
	header("location: ../deny.htm");
	exit();
}

require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
require_once("../../functions/functions.php");
require_once("../wysiwyg_editor/fckeditor.php");
require_once("../../functions/file_functions.php");
require_once("../../functions/resize_image.php");
require_once("../../functions/pagebreak.php");
require_once("../../classes/upload.php");
require_once("../../classes/menu.php");

$fs_table		= "galleries";
$field_id		= "gal_id";
$sqlcategory	.= " AND cat_type = 'gallery'";
$fs_filepath		= "../../gallery/";
$extension_list	= "jpg,gif,bmp";
$limit_size			= 	1000000;
$numcolSize			=	3;
$small_width		= 	170;
$small_heght		=	115;

$medium_width		= 	450;

$small_quantity	=	100;

$medium_heght		=	intval(($medium_width*$small_heght)/$small_width);
$medium_quantity	=	75;
$menu 				= new menu();
$listAll 			= $menu->getAllChild("categories_multi","cat_id","cat_parent_id","0"," lang_id = " . $_SESSION["lang_id"] . $sqlcategory,"cat_id,cat_name","cat_order ASC, cat_name ASC","cat_has_child");
$arrayType			= array();
?>