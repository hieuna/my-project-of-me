<?
	require_once("inc_security.php");
	
	$record_id 			= getValue("record_id", "int", "GET", "");
	$fs_title			= "Edit Discount";
	$fs_action			= getURL();
	
	$myform = new generate_form();
	$myform->add("mer_name", "mer_name", 0, 0, "", 1, "Bạn chưa nhập tên đối tác", 0, "");
	$myform->add("mer_link", "mer_link", 0, 0, "", 1, "Bạn chưa nhập liên kết tới đối tác", 0, "");
	$myform->add("mer_order", "mer_order", 1, 0, 0, 1, "Bạn chưa nhập thứ tự", 0, "");
	$myform->add("mer_active", "mer_active", 1, 0, 0, 1, "Bạn chưa kích hoạt", 0, "");
	
	$myform->addTable($fs_table);
	
	//Get gia tri submit form co duoc gan vao ko?
	$submitform = getValue("action", "str", "POST", "");
	if($submitform == "execute"){
		$upload		= new upload($fs_fieldupload, $fs_img_upload, $fs_extension, $limit_size);
		$filename	= $upload->file_name;
		$fs_errorMsg = $myform->checkdata();	
			if($fs_errorMsg == ""){
				
				if($filename != "")
				{
					$fs_fieldupload = $filename;
					$myform->add("mer_logo", "fs_fieldupload", 0, 1, "", 1, "Bạn chưa nhập ảnh đại diện", 0, "");
	
					// resize
					$upload->resize_image($fs_img_upload, $filename, $width_normal_image, $height_normal_image, "normal_");
					
				}//End if($filename != "")	
				
				$myform->addTable($fs_table);
				
				$myform->removeHTML(0);
				$db_ex = new db_execute($myform->generate_update_SQL($id_field,$record_id));
				//Redirect to:
				redirect("listing.php");	
		}//End if($fs_errorMsg == "")
		
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
<?=template_top("Edit Merchant")?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
	<?
    	$form = new form();
		$form->create_form("Edit", "", "post", "multipart/form-data", "");
		$form->create_table();
	?>
        <?=$form->text("Tên đối tác","mer_name","mer_name",$mer_name,"Tên đối tác",1,250,"",250,"","","")?>
        <?=$form->text("Liến kết tới đối tác","mer_link","mer_link",$mer_link,"Liên kết tới đối tác",1,250,"",250,"","","")?>
        <?=$form->getFile("Ảnh đại diện", $fs_fieldupload, $fs_fieldupload, "Ảnh đại diện", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">2 Mb</font>)');?>
        <tr align="center"><td colspan="2"><img src="../../../pictures/banks/<?=$row["mer_logo"]?>" border="0" style="max-width:100px; max-height:100px" /> </td></tr>
        <?=$form->text("Thứ tự", "mer_order", "mer_order", $mer_order, "Thứ tự", 0, 50, "", 250, "", "", "")?>
        <?=$form->checkbox("Kích hoạt", "mer_active", "mer_active",1, $mer_active, "", 0)?>
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