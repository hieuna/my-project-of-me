<? 
	include "inc_security.php";	
	//Kiem tra quyen them sua xoa
	checkAddEdit("add");
	
	$tag_name   =  getValue("tag_name","str","POST","");
    $tag_link   = getValue("tag_link","str","POST","");
	
    
	$fs_action	= getURL();
	$fs_errorMsg = "";
	$fs_redirect = "";
						   
                           
	$submitform = getValue("action", "str", "POST", "");
    
	if($submitform == "execute"){
	   $que_lastest = time();
	    //Doan ma nay se thuc thi sau khi nhan nut submit
    	$myform = new generate_form();
    	$myform->add("tag_name", "tag_name", 0, 0, "", 1, "Bạn chưa nhập tiêu đề của tag", 0, "");
    	$myform->add("tag_link", "tag_link", 0, 0, "", 1, "Bạn chưa nhập link tag", 0, "");
    	$myform->add("tag_active", "tag_active", 1, 0, 0, 1, "Bạn chưa kích hoạt", 0, "");
    	$myform->addTable($fs_table);
    	//Get gia tri submit form co duoc gan vao ko?
    	
		//Check form data
		$fs_errorMsg .= $myform->checkdata();	
		if($fs_errorMsg == ""){
			
			//Insert to database
			$myform->removeHTML(0);
           //echo $myform->generate_insert_SQL(); die();
			$db_insert = new db_execute($myform->generate_insert_SQL());
			
			$save = getValue("save", "int", "POST", 0);
			$fs_redirect = "add.php?save=1";
			if($save == 0)	
				$fs_redirect = "listing.php";

			//Redirect after insert complate
			redirect($fs_redirect);
			
		}//End if($fs_errorMsg == "")
		$myform->evaluate();
		$myform->addFormname("add");
		echo $myform->strErrorField;
	}//End if($action == "insert")
		
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script language="javascript" src="../../resource/js/md5.js">	
</script>
<?=$load_header?>

</head>

<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<?=template_top("Thêm tag")?>
<p align="center" style="padding-left:10px;">
	
    <?
    	$form = new form();
		$form->create_form("add",$fs_action,"post","multipart/form-data",'onsubmit="validateForm();return false;"');
		$form->create_table();		
	?>
    <?=$form->text_note('Những ô dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
    <? //Khai bao thong bao loi ?>
    <?=$form->errorMsg($fs_errorMsg)?>
    <?=$form->text("Tag", "tag_name", "tag_name", $tag_name, "Tag", 1, 250, "", 250, "", "", "")?>
    <?=$form->text("Link tag", "tag_link", "tag_link", $tag_link, "Link tag", 1, 250, "", 250, "", "", "")?>
    
   
    <?=$form->checkbox("Kích hoạt", "tag_active", "tag_active", 1, 0, "")?>
    <?=$form->checkbox("Tiếp tục thêm", "save", "save", 1, 0, "")?>
    <?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
	<?=$form->hidden("action", "action", "execute", "");?>
    <?
    $form->close_table();
	$form->close_form();
	unset($form);
	?>
    </p>
<?=template_bottom() ?>

</body>
</html>