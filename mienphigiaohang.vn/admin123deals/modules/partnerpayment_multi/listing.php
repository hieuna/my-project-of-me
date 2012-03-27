<?
	require_once("inc_security.php");
	                    
	//khoi tao object Datagird
	$list = new fsDataGird($id_field, $name_field,"Danh sách đối tác!");
	
	$list->add("mer_name","Tên đối tác","string",1,1);
	$list->add("mer_link","Liên kết tới đối tác","string",1,1);
	$list->add("mer_order","Thứ tự","int",1,1);
	$list->add("mer_active","Kích hoạt","int",1,1);
	
	$list->add("",translate_text("Copy"),"copy");
	$list->add("",translate_text("Edit"),"edit");
	$list->add("",translate_text("Delete"),"delete");
	
	$total			= new db_count("SELECT 	count(*) AS count 
									 FROM 	".$fs_table."
									 WHERE 	1 " . $list->sqlSearch() . "");

	$db_listing 	= new db_query("SELECT * 
									 FROM ".$fs_table."
									 WHERE 1 " . $list->sqlSearch() . " 
									 ORDER BY " . $list->sqlSort() . $id_field ." DESC
									 " . $list->limit($total->total));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
