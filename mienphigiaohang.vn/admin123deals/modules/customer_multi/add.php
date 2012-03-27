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
$par_name			= getValue("par_name", "str", "POST", "");
$par_pass			= getValue("par_pass", "str", "POST", "");
$confirm_par_pass   = getValue("confirm_par_pass", "str", "POST", "");
$par_namelogin				= getValue("par_namelogin", "str", "POST", "");
$par_email				= getValue("par_email", "str", "POST", "");
$par_add			= getValue("par_add", "str", "POST", "");
$par_tel				= getValue("par_tel", "str", "POST", "");
$par_fax				= getValue("par_fax", "str", "POST", "");
$par_website				= getValue("par_website", "str", "POST", "");
$par_date				= time();
$par_active				= getValue("par_active", "int", "POST", 1);
$par_link				= $par_namelogin;


//Get action variable for add new data
$action					= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "execute"){

	//Lấy dữ liệu kiểu checkbox
	$par_active			= getValue("par_active", "int", "POST", 0);
	
	/*
	Call class form:
	1). Ten truong
	2). Ten form
	3). Kieu du lieu , 0 : string , 1 : kieu int, 2 : kieu par_email, 3 : kieu double, 4 : kieu hash par_pass
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
	$myform->add("par_name", "par_name", 0, 1, " ", 1, "Bạn chưa nhập tên đối tác.", 0, "");
	$myform->add("par_namelogin", "par_namelogin", 0, 1, "    ", 1, "Tên đối tác phải từ 4 ký tự trở lên.", 1, "Tài khoản này đã tồn tại trong Database.");
	$myform->add("par_pass", "par_pass", 4, 1, "    ", 1, "Mật khẩu phải từ 4 ký tự trở lên.", 0, "");
	$myform->add("par_email", "par_email", 2, 1, " ", 1, "Địa chỉ par_email không hợp lệ.", 1, "Địa chỉ par_email này đã tồn tại trong Database.");
	$myform->add("par_add", "par_add", 0, 1, " ", 0, "Bạn chưa nhập địa chỉ.", 0, "");
	$myform->add("par_tel", "par_tel", 1, 1, " ", 0, "Bạn chưa nhập số điện thoại.", 0, "");
	$myform->add("par_fax", "par_fax", 0, 1, "", 0, "", 0, "");
	$myform->add("par_website", "par_website", 0, 1, "", 0, "Bạn chưa nhập địa chỉ website đối tác.", 0, "");
	$myform->add("par_active", "par_active", 1, 1, 0, 0, "", 0, "");		
	$myform->add("par_link", "par_link", 0, 1, "", 0, "", 0, "");		
	$myform->add("par_date", "par_date", 0, 1, "", 0, "", 0, "");


	//Kiểm tra xem user xác nhận mật khẩu có đúng không
	if($par_pass != $confirm_par_pass){
		$fs_errorMsg .= "&bull; Bạn xác nhận sai mật khẩu.<br />";
	}
	
	//Check form data
	$fs_errorMsg .= $myform->checkdata();
	
	if($fs_errorMsg == ""){
		
		//upload Image
			if($fs_errorMsg == ""){      
				$errorimg = "Bạn chưa nhập ảnh đối tác!";
				$upload_pic = new upload("par_logo",$fs_img_upload, $fs_extension, $limit_size);
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
				$myform->add("par_logo","picture",0,1,"",1,$errorimg);    
			}	
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
<?=template_top("Thêm tài khoản đối tác")?>
<div align="center" class="textBold" style="padding-top: 10px;">- Thông tin tài khoản đối tác -</div>
<div align="center" class="content">
<?
// Create form
$form = new form();
$form->create_form("add", $fs_action, "post", "multipart/form-data", 'onSubmit="selectAll(\'cat_array\')"');
$form->create_table();
?>
<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<?=$form->errorMsg($fs_errorMsg)?>
<?=$form->text("Tên truy cập", "par_namelogin", "par_namelogin", $par_namelogin, "Tên truy cập", 1, 150, "", 100, "", "", "")?>
<?=$form->text("Tên đối tác", "par_name", "par_name", $par_name, "Tên đối tác", 1, 250, "", 255, "", "", "")?>
<?=$form->password("Mật khẩu", "par_pass", "par_pass", "", "Mật khẩu", 1, 150, "", 100, "", "")?>
<?=$form->password("Xác nhận mật khẩu", "confirm_par_pass", "confirm_par_pass", "", "Xác nhận mật khẩu", 1, 150, "", 100, "", "")?>
<?=$form->text("Email", "par_email", "par_email", $par_email, "Email", 3, 250, "", 255, "", "", "")?>
<?=$form->text("Địa chỉ", "par_add", "par_add", $par_add, "Địa chỉ", 0, 250, "", 255, "", "", "")?>
<?=$form->text("Điện thoại", "par_tel", "par_tel", $par_tel, "Điện thoại", 0, 250, "", 255, "", "", "")?>
<?=$form->text("Fax", "par_fax", "par_fax", $par_fax, "Fax", 0, 250, "", 255, "", "", "")?>
<?=$form->text("Website", "par_website", "par_website", $par_website, "Website", 0, 250, "", 255, "", "", "")?>
 <?=$form->getFile("Ảnh đại diện", "par_logo", "par_logo", "Ảnh minh họa", 1, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">' . $limit_size . ' Kb</font>)');?>
<? $form->close_table();?>

<hr size="1" width="60%" style="border:1px #CCCCCC solid" />
<div align="center">

<? $form->create_table();?>
<?=$form->checkbox("Kích hoạt", "par_active", "par_active", 1, $par_active, "", 0, "", "")?>
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