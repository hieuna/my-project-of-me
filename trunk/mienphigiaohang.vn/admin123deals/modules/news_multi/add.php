<?
include("inc_security.php");
checkAddEdit("add");

//Khai báo biến khi thêm mới
$after_save_data	= getValue("after_save_data", "str", "POST", "add.php");
$add				= "add.php";
$listing			= "listing.php";
$fs_title			= "Add News";
$fs_action			= getURL();
$fs_redirect		= $after_save_data;
$fs_errorMsg		= "";

$news_strdate		= getValue("news_strdate", "str", "POST", date("d/m/Y"));
$news_strtime		= getValue("news_strtime", "str", "POST", date("H:i:s"));
$NgayDangTin		= convertDateTime($news_strdate	,$news_strtime);

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
$action	= getValue("action", "str", "POST", "");

//Check $action for insert new data
if($action == "execute"){

	//Check form data
$upload		= new upload($fs_fieldupload, $fs_filepath, $fs_extension, $fs_filesize);
		$filename	= $upload->file_name;
		
		//Check form data
		$fs_errorMsg .= $myform->checkdata();	
		if($fs_errorMsg == ""){
			
			if($filename != "")
			{
				$fs_fieldupload = $filename;
				$myform->add("Anh", "fs_fieldupload", 0, 1, "", 1, "Bạn chưa nhập ảnh tin bài", 0, "");

				// resize
				$upload->resize_image($fs_filepath, $filename, $width_normal_image, $height_normal_image, "normal_");
				
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<? 
//add form for javacheck
$myform->addFormname("add");
$myform->checkjavascript(); 
//chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
$myform->evaluate();
$fs_errorMsg .= $myform->strErrorField;
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
    
	
	<?=$form->text("Tiêu đề", "TieuDe", "TieuDe", $TieuDe, "Tiêu đề", 1, 250, "", 255, "", "", "")?>
      <?=$form->getFile("Ảnh đại diện", $fs_fieldupload, $fs_fieldupload, "Ảnh minh họa", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">' . $fs_filesize . ' Kb</font>)');?>
	<?=$form->text("Ngày đăng tin", "NgayDangTin" . $form->ec . "news_strtime", "news_strdate" . $form->ec . "news_strtime", $news_strdate . $form->ec . $news_strtime, "Ngày (dd/mm/yyyy)" . $form->ec . "Giờ (hh:mm:ss)", 0, 90 . $form->ec . 70, $form->ec, 10 . $form->ec . 10, " - ", $form->ec, "&nbsp; <i>(Ví dụ: dd/mm/yyyy - hh:mm:ss)</i>");?>
       <?=$form->checkbox("Kích hoạt", "active", "active", 1, 0, "")?>
	<?=$form->text("Nguồn tin", "nguon_tin", "nguon_tin", $nguon_tin, "Nguồn tin", 1, 250, "", 255, "", "", "")?>
   <tr>
        <td  align="right" nowrap class="form_name" width="200">Loại tin bài:</td>
        <td class="form_text">
            <div id="content_loader">
                <select title="Loại tin bài" id="new_loca" name="new_loca" class="form_control">
                    <option value="">--[Loại tin bài]--</option>
                    <option value="1">Tin tức</option>
                    <option value="2">Photos</option>
                    <option value="3">Videos</option>
                </select>
            </div>
        </td>
    </tr> 
  <tr>
        <td  align="right" nowrap class="form_name" width="200">Loại tin :</td>
        <td class="form_text">
            <div id="content_loader">
                <select title="Loại tin" id="new_type" name="new_type" class="form_control">
                    <option value="">--[Loại tin tức]--</option>
                    <option value="1">Tin Khuyến Mại</option>
                    <option value="2">Tin Thể thao</option>
                    <option value="3">Tin Giải Trí</option>
                    <option value="4">Tin Công Nghệ</option>                   
                    <option value="5">Ảnh Người đẹp</option>
                    <option value="6">Ảnh Ngôi sao sân cỏ</option>
                    <option value="7">Ảnh Vợ, bồ cầu thủ</option>
                    <option value="8">Ảnh Ô tô xe máy</option>
                    <option value="9">Videos Người đẹp</option>
                    <option value="10">Videos tổng hợp trận đấu</option>
 					<option value="11">Videos Hài</option>
                </select>
            </div>
        </td>
    </tr> 
	<?=$form->close_table();?>
   <?=$form->wysiwyg("Trích dẫn", "TrichDan", $TrichDan, "../../resource/wysiwyg_editor/", "80%", 300)?>
	<?=$form->wysiwyg("Thông tin chi tiết", "NoiDung", $NoiDung, "../../resource/wysiwyg_editor/", "80%", 300)?>
	<?=$form->create_table();?>
	<?=$form->radio("Sau khi lưu dữ liệu", "add_new" . $form->ec . "return_listing", "after_save_data", $add . $form->ec . $listing, $after_save_data, "Thêm mới" . $form->ec . "Quay về danh sách", 0, $form->ec, "");?>
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