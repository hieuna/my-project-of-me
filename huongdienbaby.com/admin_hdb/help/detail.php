<? 
require_once("config_security.php");
require_once("../wysiwyg_editor/fckeditor.php");
require_once("../../classes/generate_form.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
<title>Hướng dẫn sử dụng</title>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<?
$iMod 		 = getValue("iMod");
$url			 = base64_decode(getValue("url","str","GET","#"));
$action 		 = getValue("action","str","POST","");
$fs_redirect = getURL();
if($action == "update"){
	$myform = new generate_form();
	//Loại bỏ chuc nang thay the Tag Html
	$myform->removeHTML(0);
	//Insert to database
	$myform->add("mod_help","sta_description",0,0,"",0,"",0,"");
	$myform->addTable("modules");
	$db_ex = new db_execute($myform->generate_update_SQL("mod_id", $iMod));
	//echo $myform->generate_update_SQL("mod_id", $iMod);
	//Redirect to:
	redirect($fs_redirect);
	exit();
}
$db_help = new db_query("SELECT * FROM modules WHERE mod_id = " . $iMod);
$row=mysql_fetch_array($db_help->result)
?>
<? template_top(translate_text("quay_tro_lai") . '=> <a href="' . $url . '">' . translate_text($row["mod_name"]),0)?></a>
		<div style="padding:5px;" align="justify"><?=$row["mod_help"]?></div>
		<? if($updatehelp == 1){?>
			<form action="<?=getURL()?>" method="post">
				<input type="hidden" name="action" value="update" />
				<hr />
				<div class="textBold" align="center" style="padding:7px;">Viết sửa hướng dẫn ở dưới</div>
				
				<div>
					<?
					$sBasePath	= $_SERVER['PHP_SELF'] ;
					$sBasePath	= "../wysiwyg_editor/" ;						
					$oFCKeditor = new FCKeditor('sta_description') ;
					$oFCKeditor->BasePath	= $sBasePath ;
					$oFCKeditor->Value		= $row["mod_help"];
					$oFCKeditor->Width = 800;
					$oFCKeditor->Height = 600;
					$oFCKeditor->Create() ;
					?>
				</div>
				<div align="center" style="padding:5px;">
					<input type="submit" value="<?=translate_text("save_change")?>" class="form" />
				</div>
			</form>
		<? }?>
<? template_bottom() ?>
</body>
</html>
