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
$adm_loginname			= getValue("adm_loginname", "str", "POST", "");
$adm_password			= getValue("adm_password", "str", "POST", "");
$adm_confirm_password   = getValue("adm_confirm_password", "str", "POST", "");
$adm_name				= getValue("adm_name", "str", "POST", "");
$adm_email				= getValue("adm_email", "str", "POST", "");
$adm_address			= getValue("adm_address", "str", "POST", "");
$adm_phone				= getValue("adm_phone", "str", "POST", "");
$adm_mobile				= getValue("adm_mobile", "str", "POST", "");

// Module truy cập
$adm_access_module	= "";
$mod_array				= getValue("mod_array", "arr", "POST", "");
if(is_array($mod_array)){
	foreach($mod_array as $key => $value){
		$adm_access_module .= "[" . intval($value) . "]";
	}
}

// Category truy cập
$adm_access_category	= "";
$cat_array				= getValue("cat_array", "arr", "POST", "");
if(is_array($cat_array)){
	foreach($cat_array as $key => $value){
		$adm_access_category .= "[" . intval($value) . "]";
	}
}

$adm_date				= time();
$adm_active				= getValue("adm_active", "int", "POST", 1);

//Get action variable for add new data
$action					= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "execute"){

	//Lấy dữ liệu kiểu checkbox
	$adm_active			= getValue("adm_active", "int", "POST", 0);
	
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
	$myform->add("adm_loginname", "adm_loginname", 0, 1, "    ", 1, "Tên tài khoản phải từ 4 ký tự trở lên.", 1, "Tài khoản này đã tồn tại trong Database.");
	$myform->add("adm_password", "adm_password", 4, 1, "    ", 1, "Mật khẩu phải từ 4 ký tự trở lên.", 0, "");
	$myform->add("adm_name", "adm_name", 0, 1, " ", 1, "Bạn chưa nhập họ và tên.", 0, "");
	$myform->add("adm_email", "adm_email", 2, 1, " ", 1, "Địa chỉ email không hợp lệ.", 1, "Địa chỉ email này đã tồn tại trong Database.");
	$myform->add("adm_address", "adm_address", 0, 1, " ", 0, "Bạn chưa nhập địa chỉ.", 0, "");
	$myform->add("adm_phone", "adm_phone", 0, 1, " ", 0, "Bạn chưa nhập số điện thoại.", 0, "");
	$myform->add("adm_mobile", "adm_mobile", 0, 1, "", 0, "", 0, "");
	$myform->add("adm_access_module", "adm_access_module", 0, 1, "", 0, "", 0, "");
	$myform->add("adm_access_category", "adm_access_category", 0, 1, "", 0, "", 0, "");
	$myform->add("adm_date", "adm_date", 1, 1, 0, 0, "", 0, "");
	$myform->add("adm_active", "adm_active", 1, 1, 0, 0, "", 0, "");
	
	//Kiểm tra xem user xác nhận mật khẩu có đúng không
	if($adm_password != $adm_confirm_password){
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
<?=template_top("Thêm người dùng")?>
<div align="center" class="textBold" style="padding-top: 10px;">- Thông tin tài khoản -</div>
<div align="center" class="content">
<?
// Danh sách module truy cập
$db_module = new db_query("SELECT mod_id, mod_name FROM modules ORDER BY mod_order ASC, mod_name ASC");

// Create form
$form = new form();
$form->create_form("add", $fs_action, "post", "multipart/form-data", 'onSubmit="selectAll(\'cat_array\')"');
$form->create_table();
?>
<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<?=$form->errorMsg($fs_errorMsg)?>
<?=$form->text("Tên tài khoản", "adm_loginname", "adm_loginname", $adm_loginname, "Tên tài khoản", 1, 150, "", 100, "", "", "")?>
<?=$form->password("Mật khẩu", "adm_password", "adm_password", "", "Mật khẩu", 1, 150, "", 100, "", "")?>
<?=$form->password("Xác nhận mật khẩu", "adm_confirm_password", "adm_confirm_password", "", "Xác nhận mật khẩu", 1, 150, "", 100, "", "")?>
<?=$form->text("Họ và tên", "adm_name", "adm_name", $adm_name, "Họ và tên", 1, 250, "", 255, "", "", "")?>
<?=$form->text("Email", "adm_email", "adm_email", $adm_email, "Email", 3, 250, "", 255, "", "", "")?>
<?=$form->text("Địa chỉ", "adm_address", "adm_address", $adm_address, "Địa chỉ", 0, 250, "", 255, "", "", "")?>
<?=$form->text("Điện thoại", "adm_phone", "adm_phone", $adm_phone, "Điện thoại", 0, 250, "", 255, "", "", "")?>
<?=$form->text("Di động", "adm_mobile", "adm_mobile", $adm_mobile, "Di động", 0, 250, "", 255, "", "", "")?>
<? $form->close_table();?>

<hr size="1" width="60%" style="border:1px #CCCCCC solid" />
<div class="textBold">- Module truy cập -</div>
<div align="center">
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