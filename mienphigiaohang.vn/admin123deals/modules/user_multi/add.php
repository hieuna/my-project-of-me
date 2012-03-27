<?
include("inc_security.php");
checkAddEdit("add");
//Khai báo biến khi thêm mới
$after_save_data		= getValue("after_save_data", "str", "POST", "add.php");
$add					= "add.php";
$listing				= "listing.php";
$fs_title				= $module_name . " | Thêm mới";
$fs_action				= getURL();
$fs_redirect			= $after_save_data;
$fs_errorMsg			= "";

//Lấy dữ liệu đề giữ nguyên trạng thái khi submit error
$username			= getValue("username", "str", "POST", "");
$password			= getValue("password", "str", "POST", "");
$confirm_password   = getValue("confirm_password", "str", "POST", "");
$name				= getValue("name", "str", "POST", "");
$email				= getValue("email", "str", "POST", "");
$address			= getValue("address", "str", "POST", "");
$tel				= getValue("tel", "str", "POST", "");
$fax				= getValue("fax", "str", "POST", "");
$sex				= getValue("sex", "str", "POST", "");
$date				= date('Y-m-d H:i:s');
$hide				= getValue("hide", "int", "POST", 1);
//$group_user				= getValue("group_user", "int", "POST", 1);


//Get action variable for add new data
$action					= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "execute"){

	//Lấy dữ liệu kiểu checkbox
	$hide			= getValue("hide", "int", "POST", 0);
	
	/*
	Call class form:
	1). Ten truong
	2). Ten form
	3). Kieu du lieu , 0 : string , 1 : kieu int, 2 : kieu email, 3 : kieu double, 4 : kieu hash password
	4). Noi luu giu data  0 : post, 1 : variable
	5). Gia tri mac dinh, neu require thi phai lon hon hoac bang default
	6). Du lieu nay co can thiet hay khong
	7). Loi dua ra man hinh
	8). Chi co duy nhat trong database
	9). Loi dua ra man hinh neu co duplicate
	*/
	$myform = new generate_form();
	//Add table insert data
	$myform->addTable($fs_table);
	$myform->add("username", "username", 0, 1, "    ", 1, "Tên tài khoản phải từ 4 ký tự trở lên.", 1, "Tài khoản này đã tồn tại trong Database.");
	$myform->add("password", "password", 4, 1, "    ", 1, "Mật khẩu phải từ 4 ký tự trở lên.", 0, "");
	$myform->add("name", "name", 0, 1, " ", 1, "Bạn chưa nhập họ và tên.", 0, "");
	$myform->add("email", "email", 2, 1, " ", 1, "Địa chỉ email không hợp lệ.", 1, "Địa chỉ email này đã tồn tại trong Database.");
	$myform->add("address", "address", 0, 1, " ", 0, "Bạn chưa nhập địa chỉ.", 0, "");
	$myform->add("tel", "tel", 1, 1, " ", 0, "Bạn chưa nhập số điện thoại.", 0, "");
	$myform->add("fax", "fax", 0, 1, "", 0, "", 0, "");
	$myform->add("sex", "sex", 1, 1, 0, 0, "", 0, "");
	$myform->add("hide", "hide", 1, 1, 0, 0, "", 0, "");		
	//$myform->add("group_user", "group_user", 1, 1, 0, 0, "", 0, "");		
	$myform->add("date", "date", 0, 1, "", 0, "", 0, "");


	//Kiểm tra xem user xác nhận mật khẩu có đúng không
	if($password != $confirm_password){
		$fs_errorMsg .= "&bull; Bạn xác nhận sai mật khẩu.<br />";
	}
	
	//Check form data
	$fs_errorMsg .= $myform->checkdata();
	
	if($fs_errorMsg == ""){
		
		//Insert to database
		$myform->removeHTML(0);
        $sql_execute = $myform->generate_insert_SQL();
        
		$db_insert	= new db_execute($sql_execute);
		unset($db_insert);
		
		//Redirect after insert complate
		redirect($fs_redirect);
		
	}//End if($fs_errorMsg == "")
	unset($myform);
	
}//End if($action == "insert")
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?=$fs_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?=$load_header?>
</head>
<body>
<?=template_top("Thêm người dùng")?>
<div align="center" class="textBold" style="padding-top: 10px;">- Thông tin tài khoản -</div>
<div align="center" class="content">
<?
// Create form
$form = new form();
$form->create_form("add", $fs_action, "post", "multipart/form-data", 'onSubmit="selectAll(\'cat_array\')"');
$form->create_table();
?>
<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<?=$form->errorMsg($fs_errorMsg)?>
<?=$form->text("Tên tài khoản", "username", "username", $username, "Tên tài khoản", 1, 150, "", 100, "", "", "")?>
<?=$form->password("Mật khẩu", "password", "password", "", "Mật khẩu", 1, 150, "", 100, "", "")?>
<?=$form->password("Xác nhận mật khẩu", "confirm_password", "confirm_password", "", "Xác nhận mật khẩu", 1, 150, "", 100, "", "")?>
<?=$form->text("Họ và tên", "name", "name", $name, "Họ và tên", 1, 250, "", 255, "", "", "")?>
<?=$form->text("Email", "email", "email", $email, "Email", 3, 250, "", 255, "", "", "")?>
<?=$form->text("Địa chỉ", "address", "address", $address, "Địa chỉ", 0, 250, "", 255, "", "", "")?>
<?=$form->text("Điện thoại", "tel", "tel", $tel, "Điện thoại", 0, 250, "", 255, "", "", "")?>
<?=$form->text("Fax", "fax", "fax", $fax, "Fax", 0, 250, "", 255, "", "", "")?>
<?=$form->select("Giới tính","sex","sex",$array_sex,$sex,"Giới tính",1)?>
<?php /*?><?=$form->select("Nhóm thành viên","group_user","group_user",$arraygroup_user,$group_user,"Nhóm thành viên",1)?><?php */?>

<? $form->close_table();?>

<hr size="1" width="60%" style="border:1px #CCCCCC solid" />
<div align="center">

<? $form->create_table();?>
<?=$form->checkbox("Kích hoạt", "hide", "hide", 1, $hide, "", 0, "", "")?>
<?=$form->radio("Sau khi lưu dữ liệu", "add_new" . $form->ec . "return_listing", "after_save_data", $add . $form->ec . $listing, $after_save_data, "Thêm mới" . $form->ec . "Quay về danh sách", 0, $form->ec, "");?>
<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
<?=$form->hidden("action", "action", "execute", "");?>
<?
$form->close_table();
$form->close_form();
unset($form);
unset($db_module);
?>
</div>
</body>
</html>
<script language="javascript">ButtonLeftFrame();</script>