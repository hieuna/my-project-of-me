<?
include("inc_security.php");

//Khai báo biến khi thêm mới
$redirect			= getValue("redirect", "str", "GET", base64_encode("listing.php"));
$after_save_data	= getValue("after_save_data", "str", "POST", $redirect);
$add					= base64_encode("add.php");
$listing				= $redirect;
$fs_title			= $module_name . " | Sửa đổi";
$fs_action			= getURL();
$fs_redirect		= $after_save_data;
$fs_redirect		= base64_decode($fs_redirect);
$fs_errorMsg		= "";

//Get data edit
$record_id			= getValue("record_id");
$record_id			= getValue("record_id", "int", "POST", $record_id);
$db_edit				= new db_query("SELECT * FROM " . $fs_table . " WHERE  " . $id_field . " = " . $record_id);
if(mysql_num_rows($db_edit->result) == 0){
	//Redirect if can not find data
	redirect($fs_error);
}
$edit					= mysql_fetch_array($db_edit->result);
unset($db_edit);

//Lấy dữ liệu đề giữ nguyên trạng thái khi submit error
$par_pass		= getValue("par_pass", "str", "POST", "");
$confirm_par_pass= getValue("confirm_par_pass", "str", "POST", "");
$par_name			= getValue("par_name", "str", "POST", $edit["par_name"]);
$par_email			= getValue("par_email", "str", "POST", $edit["par_email"]);
$par_add		= getValue("par_add", "str", "POST", $edit["par_add"]);
$par_tel			= getValue("par_tel", "str", "POST", $edit["par_tel"]);
$par_fax			= getValue("par_fax", "str", "POST", $edit["par_fax"]);
$par_website			= getValue("par_website", "str", "POST", $edit["par_website"]);


$par_active			= getValue("par_active", "int", "POST", $edit["par_active"]);

//Get action variable for add new data
$action				= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "update_profile"){

	//Lấy dữ liệu kiểu checkbox
	$par_active		= getValue("par_active", "int", "POST", 0);
	
	$myform = new generate_form();
	//Add table insert data
	$myform->addTable($fs_table);
	$myform->add("par_name", "par_name", 0, 1, " ", 1, "Bạn chưa nhập Tên đối tác.", 0, "");
	if($par_email != $edit["par_email"]){
		$myform->add("par_email", "par_email", 2, 1, " ", 1, "Địa chỉ email không hợp lệ.", 1, "Địa chỉ email này đã tồn tại trong Database.");
	}
	$myform->add("par_add", "par_add", 0, 1, " ", 0, "Bạn chưa nhập địa chỉ.", 0, "");
	$myform->add("par_tel", "par_tel", 0, 1, " ", 0, "Bạn chưa nhập số điện thoại.", 0, "");
	$myform->add("par_fax", "par_fax", 0, 1, "", 0, "", 0, "");	
	$myform->add("par_active", "par_active", 1, 1, 0, 0, "", 0, "");
	$myform->add("par_website", "par_website", 0, 1, " ", 0, "Bạn chưa nhập giới tính.", 0, "");



	//Check form data
	$fs_errorMsg .= $myform->checkdata();
	
	if($fs_errorMsg == ""){
		$upload		= new upload($fs_fieldupload, $fs_img_upload, $fs_extension, $limit_size);
		$filename	= $upload->file_name;
		if($filename != "")
				{
					$fs_fieldupload = $filename;
					$myform->add("par_logo", "fs_fieldupload", 0, 1, "", 1, "Bạn chưa nhập ảnh đại diện", 0, "");
	
					// resize
					$upload->resize_image($fs_img_upload, $filename, $width_normal_image, $height_normal_image, "normal_");
					
				}//End if($filename != "")	
		//Update to database
		$myform->removeHTML(0);
		$db_update = new db_execute($myform->generate_update_SQL($id_field, $record_id));
		unset($db_update);

		//Redirect after update complate
		redirect($fs_redirect);
		
	}//End if($fs_errorMsg == "")
	unset($myform);
	
}//End if($action == "update")

//Lấy các biến khi update par_pass
$fs_errorMsgPass		= "";

//Update par_pass
if($action == "update_par_pass"){

	$par_pass			= getValue("par_pass", "str", "POST", "");
	$confirm_par_pass= getValue("confirm_par_pass", "str", "POST", "");

	$myform = new generate_form();
	//Add table
	$myform->addTable($fs_table);
	$myform->add("par_pass", "par_pass", 4, 1, "    ", 1, "Mật khẩu phải từ 4 ký tự trở lên.", 0, "");
	
	if($par_pass != $confirm_par_pass){
		$fs_errorMsgPass .= "&bull; Bạn xác nhận sai mật khẩu.<br />";
	}
	
	$fs_errorMsgPass .= $myform->checkdata();
	if($fs_errorMsgPass == ""){
		
		//Update to database
		$myform->removeHTML(0);
		$db_update = new db_execute($myform->generate_update_SQL($id_field, $record_id));
		unset($db_update);
		
		//Redirect after Update complate
		echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
		echo '<script language="javascript">alert("Mật khẩu đã được thay đổi thành công."); window.location.href="' . $fs_redirect . '"</script>';
		exit();
		
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?=$fs_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script language="javascript" src="../js/library.js"></script>
<script language="javascript" src="../js/multiselect.js"></script>

<?=$load_header?>
<?php 

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
</head>
<body>
<?=template_top("Sửa người dùng")?>
<div align="center" class="content">

<div class="textBold">- Thông tin cá nhân -</div>
<?

// Create form
$form = new form();
$form->create_form("edit_profile", $fs_action, "post", "multipart/form-data", 'onSubmit="selectAll(\'cat_array\')"');
$form->create_table();
?>
<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<?=$form->errorMsg($fs_errorMsg)?>
<?=$form->create_control("Tên tài khoản", '<b>' . $edit["par_namelogin"] . '</b>')?>
<?=$form->create_control("Mã tài khoản", '<b>' . $edit["par_id"] . '</b>')?>
<?=$form->create_control("Link quản trị", '<b>http://www.mienphigiaohang.vn/' . $edit["par_link"] . '</b>')?>

<?=$form->text("Tên đối tác", "par_name", "par_name", $par_name, "Tên đối tác", 1, 250, "", 255, "", "", "")?>
<?=$form->text("Email", "par_email", "par_email", $par_email, "par_email", 3, 250, "", 255, "", "", "")?>
<?=$form->textarea("Địa chỉ", "par_add", "par_add", $par_add, "Địa chỉ", 0, 250, "", 255, "", "", "")?>
<?=$form->text("Điện thoại", "par_tel", "par_tel", $par_tel, "Điện thoại", 0, 250, "", 255, "", "", "")?>
<?=$form->text("Fax", "par_fax", "par_fax", $par_fax, "Fax", 0, 250, "", 255, "", "", "")?>
<?=$form->textarea("Website", "par_website", "par_website", $par_website, "Website", 0, 250, "", 255, "", "", "")?>
 <?=$form->getFile("Ảnh đại diện", $fs_fieldupload, $fs_fieldupload, "Ảnh đại diện", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">2 Mb</font>)');?>
        <tr align="center"><td colspan="2"><img src="../../../pictures/partner/<?=$row["par_logo"]?>" border="0" style="max-width:100px; max-height:100px" /> </td></tr>
<? $form->close_table();?>

<hr size="1" width="60%" style="border:1px #CCCCCC solid" />

<? $form->create_table();?>
<?=$form->checkbox("Kích hoạt", "par_active", "par_active", 1, $par_active, "", 0, "", "")?>
<?=$form->radio("Sau khi lưu dữ liệu", "add_new" . $form->ec . "return_listing", "after_save_data", $add . $form->ec . $listing, $after_save_data, "Thêm mới" . $form->ec . "Quay về danh sách", 0, $form->ec, "");?>
<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
<?=$form->hidden("action", "action", "update_profile", "");?>
<?
$form->close_table();
$form->close_form();
unset($form);
unset($db_module);
?>

<hr size="1" width="50%" style="border:1px #CCCCCC solid" />
<div class="text_link_bold">- Thay đổi mật khẩu -</div>
<?
//Change par_pass
$form = new form();
$form->create_form("edit_par_pass", $fs_action, "post", "multipart/form-data");
$form->create_table();
?>
<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<?=$form->errorMsg($fs_errorMsgPass)?>
<?=$form->password("Mật khẩu mới", "par_pass", "par_pass", "", "Mật khẩu mới", 1, 200, "", 255, "", "")?>
<?=$form->password("Xác nhận mật khẩu", "confirm_par_pass", "confirm_par_pass", "", "Xác nhận mật khẩu", 1, 200, "", 255, "", "")?>
<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
<?=$form->hidden("action", "action", "update_par_pass", "")?>
<?
$form->close_table();
$form->close_form();
unset($form);
?>

</div>
</body>
</html>
<script language="javascript">ButtonLeftFrame();</script>