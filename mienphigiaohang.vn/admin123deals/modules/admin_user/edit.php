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
$db_edit				= new db_query("SELECT * FROM " . $fs_table . " WHERE adm_isadmin = 0 AND " . $id_field . " = " . $record_id);
if(mysql_num_rows($db_edit->result) == 0){
	//Redirect if can not find data
	redirect($fs_error);
}
$edit					= mysql_fetch_array($db_edit->result);
unset($db_edit);

//Lấy dữ liệu đề giữ nguyên trạng thái khi submit error
$adm_password		= getValue("adm_password", "str", "POST", "");
$adm_confirm_password= getValue("adm_confirm_password", "str", "POST", "");
$adm_name			= getValue("adm_name", "str", "POST", $edit["adm_name"]);
$adm_email			= getValue("adm_email", "str", "POST", $edit["adm_email"]);
$adm_address		= getValue("adm_address", "str", "POST", $edit["adm_address"]);
$adm_phone			= getValue("adm_phone", "str", "POST", $edit["adm_phone"]);
$adm_mobile			= getValue("adm_mobile", "str", "POST", $edit["adm_mobile"]);

// Module truy cập
$adm_access_module		= $edit["adm_access_module"];
if(isset($_POST["action"])){
	$adm_access_module	= "";
	$mod_array				= getValue("mod_array", "arr", "POST", "");
	if(is_array($mod_array)){
		foreach($mod_array as $key => $value){
			$adm_access_module .= "[" . intval($value) . "]";
		}
	}
}

// Category truy cập
$adm_access_category		= $edit["adm_access_category"];
if(isset($_POST["action"])){
	$adm_access_category	= "";
	$cat_array				= getValue("cat_array", "arr", "POST", "");
	if(is_array($cat_array)){
		foreach($cat_array as $key => $value){
			$adm_access_category .= "[" . intval($value) . "]";
		}
	}
}

$adm_active			= getValue("adm_active", "int", "POST", 1);

//Get action variable for add new data
$action				= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "update_profile"){

	//Lấy dữ liệu kiểu checkbox
	$adm_active		= getValue("adm_active", "int", "POST", 0);
	
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
	$myform->add("adm_name", "adm_name", 0, 1, " ", 1, "Bạn chưa nhập họ và tên.", 0, "");
	if($adm_email != $edit["adm_email"]){
		$myform->add("adm_email", "adm_email", 2, 1, " ", 1, "Địa chỉ email không hợp lệ.", 1, "Địa chỉ email này đã tồn tại trong Database.");
	}
	$myform->add("adm_address", "adm_address", 0, 1, " ", 0, "Bạn chưa nhập địa chỉ.", 0, "");
	$myform->add("adm_phone", "adm_phone", 0, 1, " ", 0, "Bạn chưa nhập số điện thoại.", 0, "");
	$myform->add("adm_mobile", "adm_mobile", 0, 1, "", 0, "", 0, "");
	$myform->add("adm_access_module", "adm_access_module", 0, 1, "", 0, "", 0, "");
	$myform->add("adm_access_category", "adm_access_category", 0, 1, "", 0, "", 0, "");
	$myform->add("adm_active", "adm_active", 1, 1, 0, 0, "", 0, "");

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

	$adm_password			= getValue("adm_password", "str", "POST", "");
	$adm_confirm_password= getValue("adm_confirm_password", "str", "POST", "");

	$myform = new generate_form();
	//Add table
	$myform->addTable($fs_table);
	$myform->add("adm_password", "adm_password", 4, 1, "    ", 1, "Mật khẩu phải từ 4 ký tự trở lên.", 0, "");
	
	if($adm_password != $adm_confirm_password){
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
<script language="javascript">
function check_all_module(type){
	for(i=1; i<=50; i++){
		ob = document.getElementById("mod_array_" + i);
		if(!ob) break;
		ob.checked = type;
	}
}
</script>
<?=$load_header?>
</head>
<body>
<?=template_top("Sửa người dùng")?>
<div align="center" class="content">

<div class="textBold">- Thông tin cá nhân -</div>
<?
// Danh sách module truy cập
$db_module = new db_query("SELECT mod_id, mod_name FROM modules ORDER BY mod_order ASC, mod_name ASC");

// Danh sách category truy cập
$classMenu	= new menu();
$listAll		= $classMenu->getAllChild("categories_multi", "cat_id", "cat_parent_id", 0, "lang_id = " . $lang_id, "cat_id,cat_name,cat_type,cat_has_child", "cat_type ASC,cat_order ASC,cat_name ASC", "cat_has_child", 0);
unset($classMenu);

// Create form
$form = new form();
$form->create_form("edit_profile", $fs_action, "post", "multipart/form-data", 'onSubmit="selectAll(\'cat_array\')"');
$form->create_table();
?>
<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<?=$form->errorMsg($fs_errorMsg)?>
<?=$form->create_control("Tên tài khoản", '<b>' . $edit["adm_loginname"] . '</b>')?>
<?=$form->text("Họ và tên", "adm_name", "adm_name", $adm_name, "Họ và tên", 1, 250, "", 255, "", "", "")?>
<?=$form->text("Email", "adm_email", "adm_email", $adm_email, "Email", 3, 250, "", 255, "", "", "")?>
<?=$form->text("Địa chỉ", "adm_address", "adm_address", $adm_address, "Địa chỉ", 0, 250, "", 255, "", "", "")?>
<?=$form->text("Điện thoại", "adm_phone", "adm_phone", $adm_phone, "Điện thoại", 0, 250, "", 255, "", "", "")?>
<?=$form->text("Di động", "adm_mobile", "adm_mobile", $adm_mobile, "Di động", 0, 250, "", 255, "", "", "")?>
<? $form->close_table();?>

<hr size="1" width="60%" style="border:1px #CCCCCC solid" />
<div class="textBold">- Module truy cập -</div>
<? $form->create_table();?>
<tr>
	<td align="center">
		<table cellpadding="4" cellspacing="0">
        <tr>
            <td class="textBold"><input type="checkbox" id="chech_all" value="1" onClick="check_all_module(this.checked)" /><label for="chech_all">Tất cả Module</label></td>
        </tr>
		<?
		$db_mod	= new db_query("SELECT mod_id, mod_name FROM modules ORDER BY mod_order ASC");
		$num_col	= 3;
		$go_next	= ($row = mysql_fetch_array($db_mod->result)) ? 1 : 0;
		$j			= 0;
		while($go_next == 1){
		?>
			<tr>
			<?
			for($i=0; $i<$num_col; $i++){
			?>
				<td valign="top" class="form_text">
				<?
				if($go_next == 1){
					$j++;
					$checked = (strpos($adm_access_module, "[" . $row["mod_id"] . "]") !== false) ? ' checked="checked"' : "";
				?>
					<input type="checkbox" id="mod_array_<?=$j?>" name="mod_array[]" value="<?=$row["mod_id"]?>"<?=$checked?> /><label for="mod_array_<?=$j?>"><?=$row["mod_name"]?></label>
				<?
				}
				$go_next	= ($row = mysql_fetch_array($db_mod->result)) ? 1 : 0;
				?>
				</td>
			<?
			}
			?>
			</tr>
		<?
		}
		unset($db_mod);
		?>
		</table>
	</td>
</tr>
<? $form->close_table();?>

<? $form->create_table();?>
<?=$form->checkbox("Kích hoạt", "adm_active", "adm_active", 1, $adm_active, "", 0, "", "")?>
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
<?=$form->password("Mật khẩu mới", "adm_password", "adm_password", "", "Mật khẩu mới", 1, 200, "", 255, "", "")?>
<?=$form->password("Xác nhận mật khẩu", "adm_confirm_password", "adm_confirm_password", "", "Xác nhận mật khẩu", 1, 200, "", 255, "", "")?>
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