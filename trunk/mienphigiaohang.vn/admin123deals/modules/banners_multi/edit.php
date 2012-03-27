<?
	require_once("inc_security.php");
	
	$record_id 			= getValue("record_id", "int", "GET", "");
	$fs_title			= "Edit Banner";
	$fs_action			= getURL();
	// get category
	$sql            = "cat_type = 'product'";          
    $menu           = new menu(); 
    $listAll        = $menu->getAllChild("categories_multi","cat_id","cat_parent_id","0",$sql . " AND lang_id = " . $lang_id . $sqlcategory,"cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_order ASC, cat_name ASC","cat_has_child"); 
	//get data edit  
	$db_edit   =    new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);
    $row       =    mysql_fetch_array($db_edit->result);   
	 	
	$myform = new generate_form();
	$myform->add("ban_admin", "ban_admin", 0, 0, "", 1, "Bạn chưa nhập tiêu đề quảng cáo", 0, "");
	$myform->add("ban_title", "ban_title", 0, 0, "", 1, "Bạn chưa nhập tiêu đề quảng cáo", 0, "");
	$myform->add("ban_des", "ban_des", 0, 0, "", 1, "Bạn chưa nhập nội dung quảng cáo", 0, "");	
	$myform->add("ban_link", "ban_link", 0, 0, "", 1, "Bạn chưa nhập liên kết của banner", 0, "");
	$myform->add("ban_order", "ban_order", 1, 0, 0, 1, "Bạn chưa nhập thứ tự", 0, "");
	$myform->add("ban_active", "ban_active", 1, 0, 0, 1, "Bạn chưa kích hoạt", 0, "");
	$myform->add("ban_location","ban_location",0,1,"",1,"Chọn vị trí hiển thị","",0,"");
	$myform->add("ban_cat","ban_cat",0,1,"",1,"Chọn một Category","",0,"");
	//$myform->add("ban_des","ban_des",0,1,"",1,"Nội dung banner","",0,"");

	$myform->addTable($fs_table);
	
	//Get gia tri submit form co duoc gan vao ko?
	$submitform = getValue("action", "str", "POST", "");
	$ban_cat    = getValue("ban_cat","int","POST",$row['ban_cat']);
	$ban_location    = getValue("ban_location","int","POST",$row['ban_location']);
	$ban_admin    = getValue("ban_admin","str","POST",$row['ban_admin']);
	$ban_admin    = getValue("ban_des","str","POST",$row['ban_des']);

	
	if($submitform == "execute"){
		$upload		= new upload($fs_fieldupload, $fs_filepath, $fs_extension, $fs_filesize);
		$filename	= $upload->file_name;
		$fs_errorMsg = $myform->checkdata();	
			if($fs_errorMsg == ""){
				
				if($filename != "")
				{
					$fs_fieldupload = $filename;
					$myform->add("ban_picture", "fs_fieldupload", 0, 1, "", 1, "Bạn chưa nhập ảnh đại diện", 0, "");
	
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?=$load_header?>
<? 

//chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
$myform->evaluate();
//add form for javacheck
$myform->addFormname("add");

$errorMsg = $myform->strErrorField;

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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top("Edit Banner")?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
	<?
    	$form = new form();
		$form->create_form("add", $fs_action, "post", "multipart/form-data",'onsubmit="validateForm(); return false;"');
		$form->create_table();
	?>
     <tr>
     	<td>
        	<input id="ban_admin" name="ban_admin" type="hidden" value="<?=$adm_name?>"  />
        </td>
     </tr>
        <?=$form->text("Tiêu đề quảng cáo","ban_title","ban_title",$ban_title,"Tiêu đề quảng cáo",1,250,"",250,"","","")?>
        <?=$form->text("Liến kết của banner","ban_link","ban_link",$ban_link,"Liên kết tới đối tác",1,250,"",250,"","","")?>
        <?=$form->text("Nội dung quảng cáo","ban_des","ban_des",$ban_des,"Nội dung quản cáo",1,250,"",250,"","","")?>
		<?=$form->getFile("Ảnh đại diện", $fs_fieldupload, $fs_fieldupload, "Ảnh đại diện", 0, 32, "", '<br />(Dung lượng tối đa <font color="#FF0000">' . $fs_filesize . ' Kb</font>)');?>
         <tr>
        <td class="form_name"><font class="form_asterisk"> * </font>Ảnh minh họa</td>
        <td align="left">
        <?php
            if($row['ban_picture']!='')?>
            <img src="<?=$fs_filepath. '' . $row["ban_picture"]?>" />
               
        </td>
    </tr>
        <?=$form->select("Vị trí hiển thị","ban_location","ban_location",$arrayLocation,$ban_location,"Vị trí hiển thị",1)?>
 <tr>
        <td  align="right" nowrap class="form_name" width="200"><font class="form_asterisk"> * </font>Danh mục Category:</td>
        <td class="form_text">
            <div id="content_loader">
                <select title="Danh mục cấp trên" id="ban_cat" name="ban_cat" class="form_control">
                    <option value="0">--[Chọn một danh mục hiển thị]--</option>
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
        <?=$form->text("Thứ tự", "ban_order", "ban_order", $ban_order, "Thứ tự", 0, 50, "", 250, "", "", "")?>
        <?=$form->checkbox("Kích hoạt", "ban_active", "ban_active",1, $ban_active, "", 0)?>  
        <?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
        <?=$form->hidden("action", "action", "execute", "");?>
        <?
			$form->close_table();
			$form->close_form();
			unset($form);
		?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>