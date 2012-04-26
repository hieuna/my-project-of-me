<?
//Created by: Mr Toan
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("add");

$fs_redirect	= "listing.php";
//Call Class generate_form();
$myform = new generate_form();
//Loại bỏ chuc nang thay the Tag Html
$myform->removeHTML(0);

//Insert to database
$myform->add("ban_name","ban_name",0,0,"",1,"Please enter banner name !",0,"Please enter banner name");
$myform->add("ban_channel","ban_channel",0,0,"",0,"",0,"");
$myform->add("ban_type","ban_type",1,0,0,1,"Chọn kiểu banner !",0,"Do not set position");
$myform->add("ban_url","ban_url",0,0,"",0,"Please enter URL !",0,"Please enter URL");
$myform->add("ban_target","ban_target",0,0,"",1,"Please choose a target !",0,"Please choose a target");
$myform->add("ban_order","ban_order",1,0,0,1,"Please set order",0,"Please set order");
$myform->add("ban_description","ban_description",0,0,"",0,"",0,"");
//Active data
$myform->add("ban_active","active",1,1,1,0,"",0,"");
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "insert"){
		/*
	upload function
	upload_name : Ten textbox upload vi du : gal_picture
	upload_path : duong dan save file upload
	extension_list : danh sach cac duoi mo rong duoc phep upload vi du : gif,jpg
	limt_size : dung luong gioi han (tinh bang byte) vi du : 20000 
	*/
	$upload_pic = new upload("picture", $fs_filepath, $extension_list, $limit_size);
	if ($upload_pic->file_name != ""){
		$picture = $upload_pic->file_name;
		//resize_image($fs_filepath,$upload_pic->file_name,100,100,75);
		$myform->add("ban_picture","picture",0,1,"",0,"",0,"");
	}
	//Check Error!
	$errorMsg .= $upload_pic->show_warning_error();
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ban_cat = new db_execute_return();
		$bsc_banner = $db_ban_cat->db_execute($myform->generate_insert_SQL());
		//echo $myform->generate_insert_SQL();
		//Return iCat onChange
		$pos = 0;
		if (isset($_POST["ban_type"])) $pos = $_POST["ban_type"];
		// Redirect to add new
		$fs_redirect = "add.php?save=1&pos=" . $pos;
		//Redirect to:
		redirect($fs_redirect);
		exit();
	}
}
//add form for javacheck
$myform->addFormname("add_new");
//add more javacode
$myform->evaluate();
$myform->checkjavascript();
?>
<html>
<head>
<title>Add New</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
<?
$save = getValue("save","int","GET",0);
//when data has been save to database
if ($save==1){
?>
	<script language="javascript">
		if (!confirm("Data has been added to the database ! Do you to add more banners?")){
			window.location.href='listing.php';
		}
	</script>
<? } ?>
<script language="javascript">
<!--
function creat_link(object){
	window.open("../link/selected.php?object=" + object, "","height=403,width=600,menubar=0,resizable=1,scrollbars=0,statusbar=0,titlebar=0,toolbar=0");
}
//-->
</script>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<? template_top("Thêm mới quảng cáo")?>
		<? /*---------Body------------*/ ?>
		<table border="0" width="100%" cellpadding="4" cellspacing="1">
		<form ACTION="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING']?>" METHOD="POST" name="add_new" enctype="multipart/form-data">
			<tr>
				<td align="right" nowrap class="textBold"><?=translate_text("banner_name")?>:</td>
				<td><input type="text" name="ban_name" id="ban_name" value="<?=$ban_name;?>" class="form" size="40"></td>
			</tr>
			<tr>
				<td align="right" nowrap class="textBold"><?=translate_text("banner_in_position")?>:</td>
				<td>
					<select name="ban_type" id="ban_type" class="form">
						<option value="">- <?=translate_text("select_position")?> -</option>
					<?
					$pos = getValue("pos","int","GET",0);
					foreach($array_type as $key => $value){
						if($key == $pos){
							echo "<option value='" . $key . "' selected>" . $value . "</option>";
						}
						else{
							echo "<option value='" . $key . "'>" . $value . "</option>";
						}
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right" nowrap class="textBold"><?=translate_text("link_to")?>:</td>
				<td>
					<input type="text" name="ban_url" id="ban_url" value="<?=$ban_url;?>" size="70" class="form">&nbsp;
					<input class="form" type="button" onClick="creat_link('ban_url')" value="Create link">
				</td>
			</tr>
			<tr>
				<td align="right" nowrap class="textBold"><?=translate_text("target")?>:</td>
				<td>
					<select name="ban_target" id="ban_target" class="form">
						<option value="">- Select target -</option>
					<?
					foreach($mnu_target as $key => $value){
					?>
						<option value=<?=$value?>><?=$key?></option>
					<? } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right" nowrap class="textBold"><?=translate_text("images")?>:</td>
				<td><input type="file" name="picture" id="picture" class="form" size="35"></td>
			</tr>
			<tr>
				<td align="right" nowrap class="textBold"><?=translate_text("set_order")?>:</td>
				<td><input type="text" name="ban_order" id="ban_order" value="<?=$ban_order;?>" class="form" size="5"></td>
			</tr>
			<tr>
				<td align="right" nowrap class="textBold"><?=translate_text("description")?>:</td>
				<td><textarea name="ban_description" id="ban_description" class="form" cols="70" rows="10"><?=$ban_description;?></textarea></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="button" class="form" value="<?=translate_text("add_new")?>" style="cursor:hand; width:100px" onClick="validateForm();">&nbsp;
					<input type="reset" class="form" value="<?=translate_text("clear_all")?>" style="cursor:hand; width:100px">
					<input type="hidden" name="active" value="1">
					<input type="hidden" name="action" value="insert">
				</td>
			</tr>
		</form>
		</table>
		<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>