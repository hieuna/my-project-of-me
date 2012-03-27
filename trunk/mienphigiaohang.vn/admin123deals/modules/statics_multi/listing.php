<?
require_once("inc_security.php");

	//gọi class DataGird
	$list = new fsDataGird($id_field, $name_field,"Danh sách trang tĩnh");
	
	$sta_category_id	= array();
	$class_menu			= new menu();
	$listAll			= $class_menu->getAllChild("categories_multi", "cat_id", "cat_parent_id", 0, "cat_type='static' AND cat_id IN (" . $fs_category . ") AND lang_id = " . $lang_id, "cat_id,cat_name,cat_type", "cat_order ASC,cat_name ASC", "cat_has_child", 0);
	unset($class_menu);
	if($listAll != '') foreach($listAll as $key=>$row) $sta_category_id[$row["cat_id"]] = $row["cat_name"];
		
	$list->add($name_field,translate_text("Title"),"string",1,1);
	$list->add("sta_category_id","Danh mục","array",0,1);
	$list->add("sta_order","Thứ tự","number",1,1);
	$list->add("sta_date","Ngày tạo","date",1,1);
	
	$list->add("",translate_text("Copy"),"copy");
	$list->add("",translate_text("Edit"),"edit");
	$list->add("",translate_text("Delete"),"delete");
	
	$list->ajaxedit($fs_table);
	
	
	$total			= new db_count("SELECT count(*) AS count 
											 FROM " . $fs_table . "
											 WHERE 1 " . $list->sqlSearch());
	$db_listing = new db_query("SELECT * 
										 FROM " . $fs_table . "
										 WHERE 1 " . $list->sqlSearch() . "
										 ORDER BY " . $list->sqlSort() . $id_field ." DESC
										 " . $list->limit($total->total));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<?=$list->headerScript()?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*---------Body------------*/ ?>
<div id="listing">
  <?=$list->showTable($db_listing,$total)?>
</div>
<? /*---------Body------------*/ ?>
</body>
</html>