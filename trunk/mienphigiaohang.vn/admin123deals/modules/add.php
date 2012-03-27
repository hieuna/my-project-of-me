<? 
	include "inc_security.php";	
	//Kiem tra quyen them sua xoa
	checkAddEdit("add");

	$myform = new generate_form();
	$fs_action	= getURL();
	$fs_errorMsg = "";
	$fs_redirect = "";
	//$_SESSION["pro_id"] = $_GET["pro_id"];
	$pro_id = $_SESSION["pro_id"];
					   
	//Doan ma nay se thuc thi sau khi nhan nut submit
    $pic_user = getValue("pic_user","str","POST","");
    $pic_pro_id = getValue("pic_pro_id","int","POST","");
	$pic_date = time();
    
	$myform = new generate_form();
	
	$myform->add("pic_order", "pic_order", 1, 0, 0, 1, "Bạn chưa nhập thứ tự", 0, "");
	$myform->add("pic_active", "pic_active", 1, 0, 0, 1, "Bạn chưa kích hoạt", 0, "");                                       
	$myform->add("pic_user", "pic_user", 0, 1, "", 1, "Bạn chưa nhập user", 0, "");
	$myform->add("pic_pro_id", "pic_pro_id", 1,0, 0, 1, "Bạn chưa nhập product id", 0, "");
    $myform->add("pic_date", "pic_date", 0, 1, "", 0, "", 0, "");
                               
	    	
	//Get gia tri submit form co duoc gan vao ko?
	$submitform = getValue("action", "str", "POST", "");
	if($submitform == "execute"){       
		
		if($fs_errorMsg == ""){
			$upload		= new upload($fs_fieldupload, $fs_filepath, $fs_extension, $fs_filesize);
    		$filename	= $upload->file_name;
		    
    		//Check form data
    		$fs_errorMsg .= $myform->checkdata();
            	
			if($filename != "" && $fs_errorMsg == ""){
			     
				$fs_fieldupload = $filename;
				$myform->add("pic_link", "fs_fieldupload", 0, 1, "", 1, "Bạn chưa nhập ảnh SP", 0, "");
                
                // resize
                //$upload->resize_image($fs_filepath, $filename, $width_normal_image, $height_normal_image, "normal_");
				
			}//End if($filename != "")	
			else
				echo("Chưa nhập ảnh");
			$myform->addTable($fs_table);	
			
			//Insert to database
			$myform->removeHTML(0);
			$db_insert = new db_execute($myform->generate_insert_SQL());
			
			$save = getValue("save", "int", "POST", 0);
			$fs_redirect = "add.php?save=1";
			if($save == 0)	
				$fs_redirect = "listing.php";

			//Redirect after insert complate
			redirect($fs_redirect);
			
		}//End if($fs_errorMsg == "")
		
	}//End if($action == "insert")
		$myform->evaluate();
		$myform->addFormname("Add Banner");
		echo $myform->strErrorField;
	/*1). $data_field			: Ten truong
	2). $data_value			: Ten form
	3). $data_type				: Kieu du lieu , 0 : string , 1 : kieu int, 2 : kieu email, 3 : kieu double, 4 : kieu hash password
	4). $data_store			: Noi luu giu data  0 : post, 1 : variable
	5). $data_default_value	: Gia tri mac dinh, neu require thi phai lon hon hoac bang default
	6). $data_require			: Du lieu nay co can thiet hay khong
	7). $data_error_message	: Loi dua ra man hinh
	8). $data_unique			: Chi co duy nhat trong database
	9). $data_error_message2: Loi dua ra man hinh neu co duplicate
	10). $type_form: kiểu form : 1 text ; 2 textarea; 3 kiểu checkbook*/
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
<?=template_top(translate_text("Add merchant"))?>
<p align="center" style="padding-left:10px;">
	
    <?
    	$form = new form();
		$form->create_form("add",$fs_action,"post","multipart/form-data",'onsubmit="validateForm();return false;"');
		$form->create_table();		
	?>
    <?=$form->text_note('Những ô dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
    <? //Khai bao thong bao loi ?>
    <?=$form->errorMsg($fs_errorMsg)?>
     <?=$form->text("Thứ tự", "pic_order", "pic_order", 0, "Thứ tự", 0, 50, "", 250, "", "", "")?>
    <?=$form->text("Ngày đăng","pic_date","pic_date",$pic_date,"Ngày đăng",1,100,"",100,"","","")?>
     <tr>
  
   	 <td><input id="pic_user" name="pic_user" type="hidden" value="<?=$adm_name?>"  /></td>
    </tr>
    <tr>
    <td class="form_name">Mã sản phẩm:</td>
   	 <td><input readonly="readonly" id="pic_pro_id" name="pic_pro_id" type="text" value="<?=$pro_id?>"  /></td>
    </tr>
  
   
    <?=$form->getFile("Ảnh đại diện", $fs_fieldupload, $fs_fieldupload, "Ảnh minh họa", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">' . $fs_filesize . ' Kb</font>)');?>
    
    <?=$form->checkbox("Kích hoạt", "pic_active", "pic_active", 1, 0, "")?>
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