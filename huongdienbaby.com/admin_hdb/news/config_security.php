<?
$module_id = 16;
//check security...
require_once("../security/security.php");
require_once("../../functions/functions.php");
require_once("../../classes/menu.php");
checkloggedin();
if (checkaccess($module_id) != 1){
	redirect("../deny.htm");
	exit();
}
//
$fs_table			= "news";
$fs_table_relate	= "relate_news";
$field_id			= "new_id";
$sqltype				=" AND (cat_type = 'news')";
$fs_filepath		= "../../pictures/";
$extension_list	= "jpg,gif,bmp";
$limit_size			= 	100000;
$numcolSize			=	3;
$small_width		= 	166;
$small_heght		=	111;
$small_quantity	=	100;

$medium_width		= 	250;
$medium_heght		=	250;
$medium_quantity	=	75;
//echo $access_channels;
$menu = new menu();
$listAll = $menu->getAllChild("categories_multi","cat_id","cat_parent_id","0"," lang_id = " . $_SESSION["lang_id"] . " AND cat_type='news'","cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_order ASC, cat_name ASC","cat_has_child");
require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
require_once("../../classes/upload.php");
require_once("../../functions/functions.php");
require_once("../../functions/file_functions.php");
require_once("../../functions/resize_image.php");
require_once("../../functions/date_function.php");
require_once("../wysiwyg_editor/fckeditor.php");
require_once("../../classes/generate_quicksearch.php");
$arrayCheck = array(1=>"Tin mới"
							,2=>"Tin nổi bật"
							,3=>"Tin đã duyệt"
							,4=>"Tin chưa duyệt"
							);
?>