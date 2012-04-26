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
$faq_question= getValue("faq_question","str","POST","");
//Insert to database
$myform->add("faq_question","faq_question",0,0,"",0,"",0,"");
$myform->add("faq_answer","faq_answer",0,0,"",0,"",0,"");
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
		$db_ex = new db_execute($myform->generate_update_SQL("faq_id", $record_id));
		//echo $myform->generate_update_SQL("faq_id", $record_id);
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
						 FROM  " . $fs_table . "
						 WHERE  faq_id = " . $record_id);
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
				<td class="textBold"><?=translate_text("question")?></td>
				<td class="textBold" nowrap="nowrap">
					<textarea name="faq_question" id="faq_question" class="form" cols="60" rows="10"><?=$row["faq_question"];?></textarea>
				</td>
			</tr>
			<tr>
				<td class="textBold"><?=translate_text("answer")?></td>
				<td class="textBold" nowrap="nowrap">
					<textarea name="faq_answer" id="faq_answer" class="form" cols="60" rows="10"><?=$row["faq_answer"];?></textarea>
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