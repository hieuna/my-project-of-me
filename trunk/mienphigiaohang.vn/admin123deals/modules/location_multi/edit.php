<?
include("inc_security.php");
checkAddEdit("edit");

$fs_redirect 	= base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id 	= getValue("record_id");
  $db_edit   =    new db_query("SELECT * FROM location_multi WHERE loca_id =" . $record_id);
    $row       =    mysql_fetch_array($db_edit->result);

//Call class menu
//Call class menu


//Khai báo biến khi thêm mới
$fs_title			= "Edit Vùng";
$fs_action			= getURL();
$fs_errorMsg		= "";

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
	$myform->add("loca_ord", "loca_ord", 0, 0, " ", 1, "Bạn chưa nhập Mã vùng.", 0, "");	
	$myform->add("loca_title", "loca_title", 0, 0, " ", 1, "Bạn chưa nhập Tên vùng.", 0, "");

	//Add table insert data
	$myform->addTable($fs_table);

//Get action variable for add new data
$submitform = getValue("action", "str", "POST", "");
	if($submitform == "execute"){
		
				$myform->addTable($fs_table);
				
				$myform->removeHTML(0);
				$db_ex = new db_execute($myform->generate_update_SQL($id_field,$record_id));
				//Redirect to:
				redirect("listing.php");	
		
	}//End if($action == "insert")		
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<? 
$myform->checkjavascript(); 
//chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
$myform->evaluate();
//add form for javacheck
$myform->addFormname("add");

$fs_errorMsg .= $myform->strErrorField;

//lay du lieu cua record can sua doi
$db_data 	= new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);
if($row 		= mysql_fetch_assoc($db_data->result)){
	foreach($row as $key=>$value){
		if($key!='lang_id' && $key!='admin_id') $$key = $value;
	}
}else{
		exit();
}

?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top($fs_title)?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
	<p align="center" style="padding-left:10px;">
	<?
	$form = new form();
	$form->create_form("add", $fs_action, "post", "multipart/form-data",'onsubmit="validateForm(); return false;"');
	$form->create_table();
	?>
	<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
	<?=$form->errorMsg($fs_errorMsg)?>
	<?=$form->text("Mã vùng", "loca_ord", "loca_ord", $loca_ord, "Mã vùng", 1, 250, "", 255, "", "", "")?>         
	<?=$form->text("Tên vùng", "loca_title", "loca_title", $loca_title, "Tên vùng", 1, 250, "", 255, "", "", "")?>     
	<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
	<?=$form->hidden("action", "action", "execute", "");?>
	<?
	$form->close_table();
	$form->close_form();
	unset($form);
	?>
	</p>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>