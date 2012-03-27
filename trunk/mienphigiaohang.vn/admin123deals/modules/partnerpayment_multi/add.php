<? 
	include "inc_security.php";	
	//Kiem tra quyen them sua xoa
	checkAddEdit("add");

	$myform = new generate_form();
	$fs_action	= getURL();
	$errorMsg = "";
	$fs_redirect = "";
    
    	   
	//Doan ma nay se thuc thi sau khi nhan nut submit
	$myform = new generate_form();
	$myform->add("mer_name", "mer_name", 0, 0, "", 1, "Bạn chưa nhập tên đối tác", 0, "");
	$myform->add("mer_link", "mer_link", 0, 0, "", 1, "Bạn chưa nhập link cho đối tác", 0, "");
	$myform->add("mer_order", "mer_order", 1, 0, 0, 1, "Bạn chưa nhập thứ tự", 0, "");
	$myform->add("mer_active", "mer_active", 1, 0, 0, 1, "Bạn chưa kích hoạt", 0, "");
    
	//Get gia tri submit form co duoc gan vao ko?
	$submitform = getValue("action", "str", "POST", "");
	
	if($submitform == "execute"){
		
		if($errorMsg == ""){
			
			//upload Image
			if($errorMsg == ""){      
				$errorimg = "Bạn chưa nhập ảnh sản phẩm!";
				$upload_pic = new upload("mer_logo",$fs_img_upload, $fs_extension, $limit_size);
				if ($upload_pic->file_name != ""){
					$picture = $upload_pic->file_name;
					$size = getimagesize($fs_img_upload . $picture );
					if($size[0] < 110){
						 $errorimg = "Ảnh logo rộng tối thiểu là 110px! <br />";
						 $picture = '';
					}
					if($picture!=''){
						$upload_pic->resize_image($fs_img_upload,$picture,$width_normal_image,$height_normal_image,"normal_",$fs_img_products);
					}
				}   
				$myform->add("mer_logo","picture",0,1,"",1,$errorimg);    
			}	
			
			$myform->addTable($fs_table);  
			$errorMsg .= $myform->checkdata(); 
			$myform->removeHTML(0);
			$db_insert = new db_execute($myform->generate_insert_SQL());
			
			$save = getValue("save", "int", "POST", 0);
			$fs_redirect = "add.php?save=1";
			if($save == 0)	
				$fs_redirect = "listing.php";

			//Redirect after insert complate
			redirect($fs_redirect);
			
		}//End if($errorMsg == "")
		
	}//End if($action == "insert")
		$myform->evaluate();
		$myform->addFormname("Add Discount");
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
    <?=$form->errorMsg($errorMsg)?>
    <?
    /*<tr>
      <td class="form_name"><font class="form_asterisk">* </font>URL MD5 :</td>
      <td class="form_text"><input type="text" disabled="disabled" maxlength="250" style="width: 255px;" value="" name="foc_url_md5" id="foc_url_md5" title="MD5" class="form_control"></td>
    </tr>*/
	?>
    <?
    /**
	--- Create select control ---
	1. $titleControl	: Tiêu đề của control				(Exp: "City")
	2. $id				: ID của control						(Exp: "city_id")
	3. $name				: Tên của control						(Exp: "city")
	4. $array_option	: Mảng giá trị của control			(Exp: "$arrayCity = array("--[Select]--" => 0, "London" => 1, Manchester => 2,)")
	5. $currentValue	: Giá trị hiện tại của control	(Exp: "1")
	6. $title			: Title của control					(Exp: "Select city")
	7. $require			: Dữ liệu bắt buộc nhập				(Exp: "1" -> require; "0" -> not require)
	8. $width			: Chiều rộng của combobox			(Exp: "200" px)
	9. $size				: Chiều cao của combobox			(Exp: "10" rows)
	10.$multiple		: Chọn nhiều dữ liệu một lúc		(Exp: "1" -> multiple; "0" -> not multiple)
	11.$add_html		: Code HTML thêm vào					(Exp: "onChange=\"alert('Hello world !')\"")
	12.$add_text		: Chuỗi text thêm vào sau control(Exp: "(dd/mm/yyyy)")*/
	?>
    <?=$form->text("Tên đối tác","mer_name","mer_name","","Tên đối tác",1,250,"",250,"","","")?>
    <?=$form->text("Liên kết tới đối tác","mer_link","mer_link","","Liên kết tới đối tác",1,250,"",250,"","","")?>
    <?=$form->getFile("Ảnh đại diện", "mer_logo", "mer_logo", "Ảnh minh họa", 1, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">' . $limit_size . ' Kb</font>)');?>
    <?=$form->text("Thứ tự", "mer_order", "mer_order", 0, "Thứ tự", 0, 50, "", 250, "", "", "")?>
    <?=$form->checkbox("Kích hoạt", "mer_active", "mer_active", 1, 0, "")?>
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