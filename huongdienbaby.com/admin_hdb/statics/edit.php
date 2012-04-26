<?
//Created by: Mr Toan
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("edit");

require_once("../../classes/database.php");
require_once("../../functions/functions.php");
require_once("../../classes/generate_form.php");
require_once("../wysiwyg_editor/fckeditor.php");

$record_id	 = getValue("record_id","int","GET",0);
//Khai bao Bien
$fs_redirect	= base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
//kiểm tra quyền sửa xóa của user xem có được quyền ko
checkRowUser($fs_table,$field_id,$record_id,$fs_redirect);
//Call Class generate_form();
$myform = new generate_form();
//Loại bỏ chuc nang thay the Tag Html
$myform->removeHTML(0);
/*
1. data_field : Ten truong
2. data_value : Ten form
3. data_type : Kieu du lieu , 0 : string , 1 : kieu int, 2 : kieu email, 3 : kieu double
4. data_store : Noi luu giu data  0 : post, 1 : variable
5. data_default_value : gia tri mac dinh, neu require thi` phai lon hon hoac bang default
6. data_require : du lieu nay co can thiet hay khong
7. data_error_message : Loi dua ra man hinh
8. data_unique : Chỉ có duy nhất trong database
9. data_error_message2 : Loi dua ra man hinh neu co duplicate
*/
$sta_description= getValue("sta_description","str","POST","");
//Insert to database
$myform->add("sta_description","sta_description",0,0,"",0,"",0,"");
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "update"){
	$record_id = getValue("record_id", "int", "POST", 0);
	//Check Error!
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex = new db_execute($myform->generate_update_SQL("sta_id", $record_id));
		//echo $myform->generate_update_SQL("sta_id", $record_id);
		//Redirect to:
		redirect($fs_redirect);
		exit();
	}
}
//add form for javacheck
$myform->addFormname("edit_data");
//add more javacode
$myform->addjavasrciptcode("
						    		");
$myform->checkjavascript();
//Select data
$db_data = new db_query("SELECT *
						 FROM categories_multi, statics
						 WHERE cat_id = sta_category AND sta_id = " . $record_id);
if (mysql_num_rows($db_data->result) > 0)
{
	$row = mysql_fetch_array($db_data->result);
	$db_data->close();
	unset($db_data);
}
else{
	echo "Cannot find data";
	exit();
}
?>
<html>
<head>
<title>Add New</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<? template_top(translate_text("chinh_sua_noi_dung"))?>
		<? /*---------Body------------*/ ?>
		<table border="0" cellpadding="3" cellspacing="2" width="70%" align="center">
		<form ACTION="<?=getURL()?>" METHOD="POST" name="edit_data">
			<tr>
				<td colspan="2" align="center">
					<?=$errorMsg?>
				</td>
			</tr>
			<tr>
				<td class="textBold" nowrap="nowrap" align="center">
					<?=translate_text("description")?>
				</td>
			</tr>
			<tr>
				<td class="textBold" nowrap="nowrap" align="center">
						<?
						$sBasePath	= $_SERVER['PHP_SELF'] ;
						$sBasePath	= "../wysiwyg_editor/" ;						
						$oFCKeditor = new FCKeditor('sta_description') ;
						$oFCKeditor->BasePath	= $sBasePath ;
						$oFCKeditor->Value		= $row["sta_description"];
						$oFCKeditor->Width = 650;
						$oFCKeditor->Height = 450;
						$oFCKeditor->Create() ;
						?>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="button" class="form" value="<?=translate_text("save_change")?>" style="cursor:hand; width:100px" onClick="validateForm();">&nbsp;
					<input type="reset" class="form" value="<?=translate_text("clear_all")?>" style="cursor:hand; width:100px">
					<input type="hidden" name="record_id" value="<?=$record_id;?>">
					<input type="hidden" name="action" value="update">
				</td>
			</tr>
		</form>
		</table>
		<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>