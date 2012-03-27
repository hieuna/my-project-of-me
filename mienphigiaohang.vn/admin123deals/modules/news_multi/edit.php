<?
include("inc_security.php");
checkAddEdit("edit");

$fs_redirect 	= base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id 	= getValue("record_id");
  $db_edit   =    new db_query("SELECT * FROM tintuc WHERE MaTin=" . $record_id);
    $row       =    mysql_fetch_array($db_edit->result);



//Khai báo biến khi thêm mới
$fs_title			= "Edit Static";
$fs_action			= getURL();
$fs_errorMsg		= "";

$news_strdate		= getValue("news_strdate", "str", "POST", date("d/m/Y",$row["NgayDangTin"]));
$news_strtime		= getValue("news_strtime", "str", "POST", date("H:i:s",$row["NgayDangTin"]));
$NgayDangTin		= convertDateTime($news_strdate, $news_strtime);
 
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
	$myform->add("NgayDangTin", "NgayDangTin", 1, 1, 0, 0, "", 0, "");
	$myform->add("TieuDe", "TieuDe", 0, 0, " ", 1, "Bạn chưa nhập tiêu đề.", 0, "");
	//$myform->add("Anh", "Anh", 3, 0, 0, 1, "Thứ tự phải lớn hơn hoặc bằng 0.", 0, "");
	$myform->add("TrichDan", "TrichDan", 0, 0, "", 0, "", 0, "");
	$myform->add("NoiDung", "NoiDung", 0, 0, " ", 1, "Bạn chưa nhập nội dung.", 0, "");
	$myform->add("active", "active", 1, 0, 0, 1, "Bạn chưa kích hoạt", 0, "");
	$myform->add("nguon_tin", "nguon_tin", 0, 0, "", 1, "Bạn chưa nhập nguồn tin", 0, "");
	$myform->add("new_type","new_type",0,0,"",1,"Chọn loại tin tức",0,"");
	$myform->add("new_loca","new_loca",0,0,"",1,"Chọn loại tin bài",0,"");

	//Add table insert data
	$myform->addTable($fs_table);

//Get action variable for add new data
$action				= getValue("action", "str", "POST", "");
//Check $action for insert new data
if($action == "execute"){
		$upload		= new upload($fs_fieldupload, $fs_filepath, $fs_extension, $fs_filesize);
		$filename	= $upload->file_name;
		$fs_errorMsg = $myform->checkdata();	
			if($fs_errorMsg == ""){
				
				if($filename != "")
				{
					$fs_fieldupload = $filename;
					$myform->add("Anh", "fs_fieldupload", 0, 1, "", 1, "Bạn chưa nhập ảnh đại diện", 0, "");
	
					// resize
					$upload->resize_image($fs_filepath, $filename, $width_normal_image, $height_normal_image, "normal_");
					
				}//End if($filename != "")	
				else
					echo("Chưa nhập ảnh");
				$myform->addTable($fs_table);
				
				$myform->removeHTML(0);
				$db_ex = new db_execute($myform->generate_update_SQL($id_field,$record_id));
				//Redirect to:
				redirect("listing.php");	
		}//End if($fs_errorMsg == "")
		
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
	<?=$form->text("Tiêu đề", "TieuDe", "TieuDe", $TieuDe, "Tiêu đề", 1, 350, "", 355, "", "", "")?>
     
       <tr>
        <td class="form_name"><font class="form_asterisk"> * </font>Ảnh minh họa</td>
        <td align="left">
        <?php
            if($row['Anh']!='')?>
            <img width="104px" src="<?=$fs_filepath. 'normal_' . $row["Anh"]?>" />
               
        </td>
    </tr>
     <?=$form->getFile("Ảnh đại diện", $fs_fieldupload, $fs_fieldupload, "Ảnh minh họa", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">' . $fs_filesize . ' Kb</font>)');?> 
	<?=$form->text("Ngày đăng tin", "NgayDangTin" . $form->ec . "news_strtime", "news_strdate" . $form->ec . "news_strtime", $news_strdate . $form->ec . $news_strtime, "Ngày (dd/mm/yyyy)" . $form->ec . "Giờ (hh:mm:ss)", 0, 90 . $form->ec . 70, $form->ec, 10 . $form->ec . 10, " - ", $form->ec, "&nbsp; <i>(Ví dụ: dd/mm/yyyy - hh:mm:ss)</i>");?>
    
     <?=$form->checkbox("Kích hoạt", "active", "active",1, $active, "", 0)?>  
	 <?=$form->text("Nguồn tin", "nguon_tin", "nguon_tin", $nguon_tin, "Nguồn tin", 1, 250, "", 255, "", "", "")?>
     <?=$form->select("Loại tin bài","new_loca","new_loca",$arrayLoca,$new_loca,"Loại tin bài",1)?>
     <?=$form->select("Loại tin tức","new_type","new_type",$arrayLocation,$new_type,"Loại tin",1)?>
	<?=$form->close_table();?>
    <?=$form->wysiwyg("Trích dẫn", "TrichDan", $TrichDan, "../../resource/wysiwyg_editor/", "80%", 300)?>
	<?=$form->wysiwyg("Thông tin chi tiết", "NoiDung", $NoiDung, "../../resource/wysiwyg_editor/", "99%", 450)?>
	<?=$form->create_table();?>
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