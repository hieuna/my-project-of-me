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
$password		= getValue("password", "str", "POST", "");
$confirm_password= getValue("confirm_password", "str", "POST", "");
$name			= getValue("name", "str", "POST", $edit["name"]);
$email			= getValue("email", "str", "POST", $edit["email"]);
$address		= getValue("address", "str", "POST", $edit["address"]);
$tel			= getValue("tel", "str", "POST", $edit["tel"]);
$fax			= getValue("fax", "str", "POST", $edit["fax"]);
$sex			= getValue("sex", "str", "POST", $edit["sex"]);
$company			= getValue("company", "str", "POST", $edit["company"]);
//$group_user			= getValue("group_user", "str", "POST", $edit["group_user"]);


$hide			= getValue("hide", "int", "POST", $edit["hide"]);

//Get action variable for add new data
$action				= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "update_profile"){

	//Lấy dữ liệu kiểu checkbox
	$hide		= getValue("hide", "int", "POST", 0);
	
	$myform = new generate_form();
	//Add table insert data
	$myform->addTable($fs_table);
	$myform->add("name", "name", 0, 1, " ", 1, "Bạn chưa nhập họ và tên.", 0, "");
	if($email != $edit["email"]){
		$myform->add("email", "email", 2, 1, " ", 1, "Địa chỉ email không hợp lệ.", 1, "Địa chỉ email này đã tồn tại trong Database.");
	}
	$myform->add("address", "address", 0, 1, " ", 0, "Bạn chưa nhập địa chỉ.", 0, "");
	$myform->add("tel", "tel", 0, 1, " ", 0, "Bạn chưa nhập số điện thoại.", 0, "");
	$myform->add("fax", "fax", 0, 1, "", 0, "", 0, "");	
	$myform->add("hide", "hide", 1, 1, 0, 0, "", 0, "");
	$myform->add("sex", "sex", 0, 1, " ", 0, "Bạn chưa nhập giới tính.", 0, "");
	$myform->add("company", "company", 0, 1, " ", 0, "Bạn chưa nhập công ty.", 0, "");
	//$myform->add("group_user", "group_user", 0, 1, " ", 0, "Bạn chưa nhập nhóm user.", 0, "");



	//Check form data
	$fs_errorMsg .= $myform->checkdata();
	
	if($fs_errorMsg == ""){
		
		//Update to database
		$myform->removeHTML(0);
		$db_update = new db_execute($myform->generate_update_SQL($id_field, $record_id));
		unset($db_update);

		//Redirect after update complate
		redirect($fs_redirect);
		
	}//End if($fs_errorMsg == "")
	unset($myform);
	
}//End if($action == "update")

//Lấy các biến khi update password
$fs_errorMsgPass		= "";

//Update Password
if($action == "update_password"){

	$password			= getValue("password", "str", "POST", "");
	$confirm_password= getValue("confirm_password", "str", "POST", "");

	$myform = new generate_form();
	//Add table
	$myform->addTable($fs_table);
	$myform->add("password", "password", 4, 1, "    ", 1, "Mật khẩu phải từ 4 ký tự trở lên.", 0, "");
	
	if($password != $confirm_password){
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
<style type="text/css" media="all">@import "../css/FSportal.css";</style>
<script language="javascript" src="../js/library.js"></script>
<script language="javascript" src="../js/multiselect.js"></script>

<?=$load_header?>
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
<?=$form->create_control("Tên tài khoản", '<b>' . $edit["username"] . '</b>')?>
<?=$form->create_control("Mã tài khoản", '<b>' . $edit["id"] . '</b>')?>
<?=$form->text("Họ và tên", "name", "name", $name, "Họ và tên", 1, 250, "", 255, "", "", "")?>
<?=$form->text("Email", "email", "email", $email, "Email", 3, 250, "", 255, "", "", "")?>
<?=$form->textarea("Địa chỉ", "address", "address", $address, "Địa chỉ", 0, 250, "", 255, "", "", "")?>
<?=$form->text("Điện thoại", "tel", "tel", $tel, "Điện thoại", 0, 250, "", 255, "", "", "")?>
<?=$form->text("Fax", "fax", "fax", $fax, "Fax", 0, 250, "", 255, "", "", "")?>
<?=$form->text("Công ty", "company", "company", $company, "Công ty", 0, 250, "", 255, "", "", "")?>

<?=$form->select("Giới tính","sex","sex",$array_sex,$sex,"Giới tính",1)?>
<?php /*?><?=$form->select("Nhóm thành viên","group_user","group_user",$arraygroup_user,$group_user,"Nhóm thành viên",1)?>
<?php */?><? $form->close_table();?>

<hr size="1" width="60%" style="border:1px #CCCCCC solid" />

<? $form->create_table();?>
<?=$form->checkbox("Kích hoạt", "hide", "hide", 1, $hide, "", 0, "", "")?>
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
//Change password
$form = new form();
$form->create_form("edit_password", $fs_action, "post", "multipart/form-data");
$form->create_table();
?>
<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<?=$form->errorMsg($fs_errorMsgPass)?>
<?=$form->password("Mật khẩu mới", "password", "password", "", "Mật khẩu mới", 1, 200, "", 255, "", "")?>
<?=$form->password("Xác nhận mật khẩu", "confirm_password", "confirm_password", "", "Xác nhận mật khẩu", 1, 200, "", 255, "", "")?>
<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
<?=$form->hidden("action", "action", "update_password", "")?>
<?
$form->close_table();
$form->close_form();
unset($form);
?>

</div>
</body>
</html>
<script language="javascript">ButtonLeftFrame();</script>