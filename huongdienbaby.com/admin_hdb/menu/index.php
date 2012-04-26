<? require_once("../menu/config_security.php"); ?>
<? require_once("../security/menu_admin.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" bgcolor="#DDF8CC"  id="leftCP">
<div style="height:1000px;">
<div style="background:#FFFFFF;">
<? 
$db_module=new db_query("SELECT * FROM modules ORDER BY mod_order DESC");
while($row=mysql_fetch_array($db_module->result)){
	if((checkaccess($row["mod_id"]))==1 && file_exists("../" . $row["mod_path"] . "/config_security.php")===true){
		menu_admin(translate_text($row["mod_name"]),translate_text($row["mod_new"]),"" . $row["mod_path"] . "/" . $row["mod_link_new"],translate_text($row["mod_edit"]),"" . $row["mod_path"] . "/" . $row["mod_link_edit"],$row["mod_path"],$row["mod_them"],"" . $row["mod_path"] . "/" . $row["mod_link_them"]);
	}  
}
?>
</div>
</div>
</body>