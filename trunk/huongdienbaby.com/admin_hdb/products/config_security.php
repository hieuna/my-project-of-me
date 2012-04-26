<?
$module_id = 7;
//check security...
require_once("../security/security.php");
require_once("../../functions/functions.php");
checkloggedin();
if (checkaccess($module_id) != 1){
	redirect("../deny.htm");
	exit();
}
require_once("../../classes/menu.php");
require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
require_once("../../classes/upload.php");
require_once("../../classes/generate_quicksearch.php");
require_once("../../functions/functions.php");
require_once("../../functions/file_functions.php");
require_once("../../functions/resize_image.php");
require_once("../../functions/date_function.php");
require_once("../../functions/functions_form.php");
require_once("../wysiwyg_editor/fckeditor.php");
require_once("../../functions/pagebreak.php");
$fs_table			= "products";
$fs_filepath		= "../../pictures_products/";
$extension_list		= "jpg,gif";
$limit_size			= 	100000;
$numcolSize			=	3;
$small_width		= 	160;
$small_heght		=	115;
$small_quantity		=	100;

$medium_width		= 	270;
$medium_heght		=	$medium_width*$small_heght/$small_width;
$medium_quantity	=	75;


$cat_type			= " AND cat_type='PRODUCT'";
$arrayCheck			= array("Sản phẩm mới"=>1
									,"Sản phẩm nổi bật"=>2
									,"Sản phẩm đã duyệt"=>3
									,"Sản phẩm chưa duyệt"=>4
									,"Sản phẩm còn kho"=>5
									,"Sản phẩm hết hàng"=>6
									,"Sản phẩm khuyến mại"=>7
							);
$arraySearchIn		= array("pro_search"=>"Tất cả"
									,"pro_name"=>"Tên sản phẩm"
									);															
$menu = new menu();
$listAll = $menu->getAllChild("categories_multi","cat_id","cat_parent_id","0"," lang_id = " . $_SESSION["lang_id"] . $cat_type . $sqlcategory,"cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child,cat_active","cat_order ASC, cat_name ASC","cat_has_child");
$db_supplier = new db_query("SELECT sup_id,sup_name FROM supplier ORDER BY sup_name");
$arraySupplier = array();							
while($row=mysql_fetch_array($db_supplier->result)){
	$arraySupplier[$row["sup_id"]]=$row["sup_name"];
}

?>