<? 
	include "inc_security.php";	
	//Kiem tra quyen them sua xoa
	checkAddEdit("add");

	$myform = new generate_form();
	$fs_action	= getURL();
	$fs_errorMsg = "";
	$fs_redirect = "";
		
	// lấy category
	$sql                =   " cat_type = 'product'";  
      
    $menu                   = new menu(); 
    $listAll                = $menu->getAllChild("categories_multi","cat_id","cat_parent_id","0",$sql . " AND lang_id = " . $lang_id . $sqlcategory,"cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_order ASC, cat_name ASC","cat_has_child");
					   
	//Doan ma nay se thuc thi sau khi nhan nut submit
    $ban_admin = getValue("ban_admin","str","POST","");
    $ban_title = getValue("ban_title","str","POST","");
	$ban_des  = getValue("ban_des","str","POST","");
    $ban_link  = getValue("ban_link","str","POST","");
    $ban_location = getValue("ban_location","int","POST",0);
    $ban_cat  = getValue("ban_cat","int","POST");
	
    
	$myform = new generate_form();
	$myform->add("ban_title", "ban_title", 0, 1, "", 1, "Bạn chưa nhập tiêu đề quảng cáo", 0, "");
	$myform->add("ban_des", "ban_des", 0, 1, "", 1, "Bạn chưa nhập nội dung quảng cáo", 0, "");
	$myform->add("ban_link", "ban_link", 0, 1, "", 1, "Bạn chưa nhập link cho banner", 0, "");
	$myform->add("ban_order", "ban_order", 1, 0, 0, 1, "Bạn chưa nhập thứ tự", 0, "");
	$myform->add("ban_active", "ban_active", 1, 0, 0, 1, "Bạn chưa kích hoạt", 0, "");
    $myform->add("ban_location", "ban_location", 1, 1,0, 1, "Bạn chưa chọn vị trí hiển thị", 0, "");
    $myform->add("ban_cat","ban_cat",0,1,"",1,"Chọn vùng Category hiển thị","",0,"");                                     
	$myform->add("ban_admin", "ban_admin", 0, 1, "", 1, "Bạn chưa nhập tiêu đề quảng cáo", 0, "");
                                   
	    	
	//Get gia tri submit form co duoc gan vao ko?
	$submitform = getValue("action", "str", "POST", "");
	if($submitform == "execute"){
        if($ban_location == 0) $fs_errorMsg .= "Bạn chưa chọn vị trí hiển thị";
        
		
		if($fs_errorMsg == ""){
			$upload		= new upload($fs_fieldupload, $fs_filepath, $fs_extension, $fs_filesize);
    		$filename	= $upload->file_name;
		    
    		//Check form data
    		$fs_errorMsg .= $myform->checkdata();
            	
			if($filename != "" && $fs_errorMsg == ""){
			     
				$fs_fieldupload = $filename;
				$myform->add("ban_picture", "fs_fieldupload", 0, 1, "", 1, "Bạn chưa nhập ảnh banner", 0, "");
                
                // resize
                //if($ban_location != 1 && $ban_location != 3) $upload->resize_image($fs_filepath, $filename, $width_normal_image, $height_normal_image, "normal_");
				
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
    <?
   
	?>

 <tr><td><input id="ban_admin" name="ban_admin" type="hidden" value="<?=$adm_name?>"  /></td></tr>
    <?=$form->text("Tiêu đề quảng cáo","ban_title","ban_title",$ban_title,"Tiêu đề quảng cáo",1,250,"",250,"","","")?>
   <?=$form->text("Nội dung quảng cáo","ban_des","ban_des",$ban_des,"Nội dung quảng cáo",1,250,"",250,"","","")?>
    <?=$form->text("Liên kết tới Banner","ban_link","ban_link",$ban_link,"Liên kết tới Banner",1,250,"",250,"","","")?>
    <?=$form->getFile("Ảnh đại diện", $fs_fieldupload, $fs_fieldupload, "Ảnh minh họa", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">' . $fs_filesize . ' Kb</font>)');?>
    <?=$form->select("Vị trí hiển thị","ban_location","ban_location",$arrayLocation,$ban_location,"Vị trí hiển thị",1)?>
    <tr>
        <td  align="right" nowrap class="form_name" width="200"><font class="form_asterisk"> * </font>Danh mục Category hiển thị:</td>
        <td class="form_text">
            <div id="content_loader">
                <select title="Danh mục cấp trên" id="ban_cat" name="ban_cat" class="form_control">
                    <option value="0">--[Chọn một danh mục]--</option>
                    <?
                    for($i=0; $i<count($listAll); $i++){
                        $selected = ($ban_cat == $listAll[$i]["cat_id"]) ? ' selected="selected"' : '';
                        echo '<option title="' . htmlspecialbo($listAll[$i]["cat_name"]) . '" value="' . $listAll[$i]["cat_id"] . '"' . $selected . '>';
                        for($j=0; $j<$listAll[$i]["level"]; $j++) echo ' |--';
                        echo ' ' . cut_string($listAll[$i]["cat_name"], 55) . '</option>';
                    }
                    ?>
                </select>
            </div>
        </td>
    </tr>
    <?=$form->text("Thứ tự", "ban_order", "ban_order", 0, "Thứ tự", 0, 50, "", 250, "", "", "")?>
    <?=$form->checkbox("Kích hoạt", "ban_active", "ban_active", 1, 0, "")?>
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