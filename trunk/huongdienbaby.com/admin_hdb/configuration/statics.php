<?
require_once("config_security.php");
require_once("configcombobox.php");
require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
require_once("../../functions/functions.php");
$type = getValue("type","int","GET",1);
//set title and data for static page
$static_con_title	= array('Chân trang'
									,'Liên hệ'
									,'Thông tin khuyến mại'
									,'Bảng giá vận chuyển'
									
									);
$static_con_value	= array("con_static_footer"
									,"con_static_contact"
									,"con_static_popup"
									,"con_static_payment"
									
									);
//Khai bao Bien
$fs_redirect	= "statics.php?type=" . $type;
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
//Get all input name
foreach($static_con_value as $key=>$value){
	$$value = getValue("$value","int","POST",0);
}
//Insert to database
foreach($static_con_value as $key=>$value){
	$myform->add("$value","$value",1,0,1,0,"",0,"");
}
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "update"){
	//Check Error!
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex = new db_execute($myform->generate_update_SQL("con_lang_id",$_SESSION["lang_id"]));
		//echo $myform->generate_update_SQL("con_id",1);
		//Redirect to:
		redirect($fs_redirect);
		exit();
	}
}
//add form for javacheck
$myform->addFormname("setting");
//add more javacode
$myform->addjavasrciptcode("
						    		");
$myform->checkjavascript();
//Select data
$db_data = new db_query("SELECT * FROM configuration WHERE con_lang_id = " . $_SESSION["lang_id"]);
if (mysql_num_rows($db_data->result) > 0)
{
	$row = mysql_fetch_array($db_data->result);
	foreach($static_con_value as $key=>$value){
		$$value = $row["$value"];
	}
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
<title>Portal Configuration</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? template_top(translate_text("cau_hinh_website"))?>
<div><h1><?=$errorMsg?></h1></div>
<form action="<?=getURL()?>" method="post" name="setting">
<table border="0" cellpadding="5" cellspacing="0" width="100%">
	<?
	//config static module
	$db_static = new db_query("SELECT sta_id,sta_title FROM statics,categories_multi WHERE sta_category=cat_id AND  statics.lang_id = " . $_SESSION["lang_id"]  . $sqlcategory );
	if (mysql_num_rows($db_static->result) > 0) mysql_data_seek($db_static->result,0);
	//loop all static config
	for ($i=0;$i<count($static_con_value);$i++){
	?>
	<tr <? if($i % 2 == 0){ echo "bgcolor='#EEF2F7'"; }else{ echo "bgcolor='#EFE6EA'"; } ?>>
		<td width="30%" nowrap="nowrap">&nbsp;-&nbsp;<b><?=$static_con_title[$i];?></b></td>
		<td>
			<?=get_config_combo($db_static->result,$static_con_value[$i],$$static_con_value[$i]);?>
		</td>
	</tr>
	<?
	}
	$db_static->close();
	unset($db_static);
	?>
	<tr>
		<td>&nbsp;</td>
		<td height="30">
			<input type="button" class="form" value="<?=translate_text("save_change")?>" style="cursor:hand; width:100px" onClick="validateForm();">&nbsp;
			<input type="reset" class="form" value="<?=translate_text("clear_all")?>" style="cursor:hand; width:100px">
			<input type="hidden" name="action" value="update">
		</td>
	</tr>
<? /*---------------------------------*/ ?>
</form>
</table>
<? template_bottom() ?>
</body>
</html>