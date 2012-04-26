<?
$module_id 	= 1;

$fs_table			= "categories_multi";
$fs_filepath		= "../../channel_category/";
$extension_list 	= "jpg,gif,png,swf";
$limit_size			= 300000;

//check security...
require_once("../security/security.php");
checkloggedin();
if (checkaccess($module_id) != 1){
	header("location: ../deny.htm");
	exit();
}
$array_value 		= array("static"=>translate_text("static")
									,"news"=>translate_text("tin_tuc_su_kien")
									,"gallery"=>translate_text("gallery_album")
									,"product"=>translate_text("san_pham")
									,"faq"=>translate_text("hoi_dap")
								);
$array_type = array("Menu Top"=>1,"Menu bottom"=>4);
$db_group = new db_query("SELECT * FROM groupprices");			
while($row=mysql_fetch_array($db_group->result)) $arrayGroup[$row["grp_id"]] = $row["grp_name"];			
?>