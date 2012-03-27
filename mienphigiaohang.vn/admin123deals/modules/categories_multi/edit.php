<?
require_once("inc_security.php");
//check quyền them sua xoa
checkAddEdit("edit");

//Khai bao Bien
$fs_redirect	= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET");
$field_id		= "cat_id";


$cat_type=getValue("cat_type","str","GET","");
if($cat_type=="") $cat_type=getValue("cat_type","str","POST","");
$sql="1";
if($cat_type!="")  $sql="cat_type = '" . $cat_type . "'";
//Call Class generate_form();
$myform = new generate_form();
//Loại bỏ chuc nang thay the Tag Html
$myform->removeHTML(0);

$db_edit 			=	new db_query("SELECT * FROM categories_multi WHERE cat_id=" . $record_id);
$row					=	mysql_fetch_array($db_edit->result);
$sql					=	" cat_type='" . $row["cat_type"] . "'";
$menu 				= 	new menu();
$listAll 			= 	$menu->getAllChild("categories_multi","cat_id","cat_parent_id","0",$sql . " AND lang_id = " . $_SESSION["lang_id"] . $sqlcategory,"cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_order ASC, cat_name ASC","cat_has_child");
$myform->add("cat_name","cat_name",0,0,"",1,translate_text("Nhập tên danh mục"),0,"");
if($array_config["order"]==1) $myform->add("cat_order","cat_order",1,0,0,0,"",0,"");
if($array_config["description"]==1) $myform->add("cat_description","cat_description",0,0,"",0,"",0,"");
$myform->add("cat_tag","cat_tag",0,0,"",0,"",0,"");
$myform->add("cat_parent_id","cat_parent_id",0,0,"",0,"",0,"");

//Active data
$myform->add("cat_active","cat_active",1, 0, 0, 1,"",0,"");
$myform->add("cat_sea_active","cat_sea_active",1, 0, 0, 1,"",0,"");

//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "insert"){

	if($array_config["image"]==1){ 
		$upload_pic = new upload("cat_picture", $fs_filepath, $extension_list, $limit_size);
		if ($upload_pic->file_name != ""){
			$picture = $upload_pic->file_name;
			//resize_image($fs_filepath,$upload_pic->file_name,100,100,75);
			$myform->add("cat_picture","picture",0,1,"",0,"",0,"");
		}
		//Check Error!
		$errorMsg .= $upload_pic->show_warning_error();
	}

	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex = new db_execute($myform->generate_update_SQL("cat_id", $record_id));
		$cat_name = getValue("cat_name","str","POST","");

		redirect($fs_redirect);
		exit();
	}
}
//add form for javacheck
$myform->addFormname("add_new");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<?
$myform->checkjavascript();
?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<?=template_top(translate_text("Edit Category") . ": " . $row["cat_name"])?>
		<?
    $form = new form();
    $form->create_form("add",$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'], "post", "multipart/form-data");
    $form->create_table();
    $onChange = 'window.location.href=\'add.php?cat_type=\'+this.value';
?>

<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<?=$form->errorMsg($errorMsg)?>
<?=$form->select("Loại danh mục", "cat_type", "cat_type", $array_value,$row['cat_type'], "Loại danh mục", 1, "", 1, 0,'onChange="' . $onChange . '"', "")?>
<?=$form->text("Tên danh mục", "cat_name", "cat_name",$row['cat_name'], "Tên danh mục", 1, 250, "", 255, "", "", "")?>                
<?
if($array_config["description"]==1){?>
<?=$form->textarea("Mô tả danh mục","cat_description","cat_description",$row['cat_description'],"Mô tả danh mục",0,300,60);?>
<?}?>
<?
if($array_config["upper"]==1){
?>
   <tr>
        <td  align="right" nowrap class="form_name" width="200"><font class="form_asterisk"> * </font>Danh mục cấp trên :</td>
        <td class="form_text">
            <div id="content_loader">
                <select title="Danh mục cấp trên" id="cat_parent_id" name="cat_parent_id" class="form_control">
                    <option value="0">--[Danh mục cấp trên]--</option>
                    <?
                    for($i=0; $i<count($listAll); $i++){
                        $selected = ($cat_parent_id == $listAll[$i]["cat_id"]) ? ' selected="selected"' : '';
                        echo '<option title="' . htmlspecialbo($listAll[$i]["cat_name"]) . '" value="' . $listAll[$i]["cat_id"] . '"' . $selected . '>';
                        for($j=0; $j<$listAll[$i]["level"]; $j++) echo ' |--';
                        echo ' ' . cut_string($listAll[$i]["cat_name"], 55) . '</option>';
                    }
                    ?>
                </select>
            </div>
        </td>
    </tr>  
    <?
    }
    ?>
    <?php
if($array_config["image"]==1){
    ?>
    <?=$form->getFile("Link ảnh đại diện","cat_picture","cat_picture","Ảnh sản phẩm",1)?> 
    <?
}
?>  
<div><?php echo '<img src="'.$fs_filepath.''.$row["cat_picture"].'"/>';?></div>
<?=$form->textarea("Thẻ Tags","cat_tag","cat_tag",$row['cat_tag'],"Thẻ tags",0,300,60);?>
<?=$form->text("Thứ tự sắp xếp", "cat_order", "cat_order",$row['cat_order'], "Thứ tự sắp xếp",0, 50, "", 255, "", "", "")?>   
<?=$form->checkbox("Kích hoạt", "cat_active", "cat_active", 1,$row['cat_active'], "", 0, "", "")?>
<?=$form->checkbox("Kích hoạt Sea", "cat_sea_active", "cat_sea_active", 1,$row['cat_sea_active'], "", 0, "", "")?>


<?=$form->checkbox("Tiếp tục thêm","save","save",1,0,"")?>
<?=$form->hidden("action", "action", "insert", "");?>
<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
<?
$form->close_table();
$form->close_form();
unset($form);
?>
<?=template_bottom() ?>
</body>
</html>