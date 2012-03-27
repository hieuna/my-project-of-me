<?
	require_once("inc_security.php");
	
	$record_id 			= getValue("record_id", "int", "GET", "");
	$fs_title			= "Edit tag";
	$fs_action			= getURL();
	
	$myform = new generate_form();
	$myform->add("tag_name", "tag_name", 0, 0, "", 1, "Bạn chưa nhập tiêu đề tag", 0, "");
	$myform->add("tag_link", "tag_link", 0, 0, "", 1, "Bạn chưa nhập link tag", 0, "");
	$myform->add("tag_active", "tag_active", 1, 0, 0, 1, "Bạn chưa kích hoạt", 0, "");
	
	$myform->addTable($fs_table);
	
	$action	= getValue("action", "str", "POST", "");

	if($action == "execute")
{
		$myform->addTable($fs_table);
		
		//Insert to database
		$myform->removeHTML(0);
		$db_ex = new db_execute($myform->generate_update_SQL($id_field,$record_id));
		redirect("listing.php");
	}//End if($action == "insert")
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?=$load_header?>
<? 

//chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
$myform->evaluate();
//add form for javacheck
$myform->addFormname("add");

$errorMsg = $myform->strErrorField;

//lay du lieu cua record can sua doi
$db_data 	= new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);

	if($row 	= mysql_fetch_assoc($db_data->result))
	{
		foreach($row as $key=>$value)
		{
			if($key!='lang_id' && $key!='admin_id') $$key = $value;
		}
	}else
	{
		exit();
	}
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top("Edit Discount")?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
	<?
    	$form = new form();
		$form->create_form("Edit", "", "post", "multipart/form-data", "");
		$form->create_table();
	?>
        <?=$form->text("Tiêu đề tag","tag_name","tag_name", $tag_name,"Thẻ tag",1,250,"",250,"","","")?>  
		<?=$form->text("Link tag","tag_link","tag_link", $tag_link,"Link tag",1,250,"",250,"","","")?>
        <?=$form->checkbox("Kích hoạt", "tag_active", "tag_active", 1, $tag_active, "",0)?>
        <?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
        <?=$form->hidden("action", "action", "execute", "");?>
        <?
			$form->close_table();
			$form->close_form();
			unset($form);
		?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>