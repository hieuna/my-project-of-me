<?
//Created by: Mr Trieu
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("edit");

require_once("../../classes/database.php");
require_once("../../classes/menu.php");
require_once("../../classes/generate_form.php");
require_once("../../functions/functions.php");
require_once("../../classes/upload.php");
//Khai bao Bien
$fs_redirect	= base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET");
$field_id		= "mnu_id";
//kiểm tra quyền sửa xóa của user xem có được quyền ko
checkRowUser($fs_table,$field_id,$record_id,$fs_redirect);

//Call Class Menu
$menu = new menu();
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
$mnu_name		= getValue("mnu_name","str","POST","");
$mnu_link		= getValue("mnu_link","str","POST","");
$mnu_parent_id	= getValue("mnu_parent_id","int","POST",0);
$mnu_target		= getValue("mnu_target","str","POST","_self");
$mnu_position	= getValue("mnu_position","int","POST",1);
$mnu_order		= getValue("mnu_order","int","POST",0);
//Insert to database
$myform->add("mnu_name","mnu_name",0,0,"",1,"Bạn chưa nhập tên menu !",0,"Bạn chưa nhập tên menu");
$myform->add("mnu_link","mnu_link",0,0,"",0,"Bạn chưa nhập địa chỉ liên kết !",0,"Bạn chưa nhập địa chỉ liên kết");
$myform->add("mnu_parent_id","mnu_parent_id",1,0,0,0,"",0,"");
$myform->add("mnu_target","mnu_target",0,0,"",1,"",0,"");
$myform->add("mnu_check","mnu_check",0,0,"",0,"",0,"");
$myform->add("mnu_position","mnu_position",1,0,0,0,"",0,"");
$myform->add("mnu_space","mnu_space",1,0,0,0,"",0,"");
$myform->add("mnu_order","mnu_order",1,0,0,1,"",0,"");
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
		$db_ex = new db_execute($myform->generate_update_SQL("mnu_id", $record_id));
		//echo $myform->generate_update_SQL("new_id", $record_id);
		//Update mnu_has_child cua parent_id
		if($mnu_parent_id > 0){
			$db_ex = new db_execute("UPDATE menus_multi SET mnu_has_child = 1 WHERE mnu_id = " . $mnu_parent_id);
		}
		//Redirect to:
		redirect($fs_redirect);
		exit();
	}
}
//add form for javacheck
$myform->addFormname("add_new");
//add more javacode
$myform->addjavasrciptcode("
						    		");
$myform->checkjavascript();

//Select all menu width ID
$position = getValue("position", "int", "GET", 1);
if(isset($_POST["mnu_position"])){
	$position = getValue("mnu_position", "int", "POST", 1);
}
//Select All but none Submenu of there and don't update
$listAll = $menu->getAllChild("menus_multi","mnu_id","mnu_parent_id","0","mnu_id <> " . $record_id . " AND mnu_position = " . $position . " AND lang_id = " . $_SESSION["lang_id"],"mnu_id,mnu_name,mnu_link,mnu_target,mnu_order,mnu_position,mnu_parent_id,mnu_has_child","mnu_order ASC, mnu_name ASC","mnu_has_child",0);

$db_data = new db_query("SELECT *
						 FROM menus_multi
						 WHERE mnu_id = " . $record_id);
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
<title>Update</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
<script language="javascript" src="../js/library.js"></script>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<? template_top(translate_text("chinh_sua_menu"))?>
		<? /*---------Body------------*/ ?>
		<table align="center" cellpadding="4" cellspacing="1" width="100%">
		<form name="add_new" action="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING']?>" method="post" enctype="multipart/form-data">
			<tr>
				<td colspan="2" align="center"><?=$errorMsg;?></td>
			</tr>
			<tr> 
				<td align="right" nowrap="nowrap" class="textBold">Menu name:</td>
				<td><input type="text" name="mnu_name" id="mnu_name" value="<?=$row["mnu_name"];?>" size="50" maxlength="255" class="form"> </td>
			</tr>
			<tr> 
				<td align="right" nowrap="nowrap" class="textBold">Khoảng cách:</td>
				<td><input type="text" name="mnu_space" id="mnu_space" value="<?=$row["mnu_space"];?>" size="30" maxlength="255" class="form"> </td>
			</tr>
			<tr>
				<td align="right" nowrap="nowrap" class="textBold">Link:</td>
				<td><input type="text" name="mnu_link" id="mnu_link" value="<?=$row["mnu_link"];?>" size="70" class="form">&nbsp;<input class="form" type="button" onClick="creat_link('mnu_link')" value="Create link"></td>
			</tr>
			<tr> 
				<td align="right" nowrap="nowrap" class="textBold">check link menu:</td>
				<td><input type="text" name="mnu_check" id="mnu_check" value="<?=$row["mnu_check"];?>" size="50" maxlength="255" class="form"> </td>
			</tr>
			<tr>
				<td align="right" nowrap="nowrap" class="textBold">Upper menu:</td>
				<td> 
					<select name="mnu_parent_id" id="mnu_parent_id" class="form">
						<option value="0">--[No upper menu]--</option>
						<? for($i=0;$i<count($listAll);$i++){ ?>
						<option value="<?=$listAll[$i]["mnu_id"]?>" <? if($listAll[$i]["mnu_id"] == $row["mnu_parent_id"]) echo "selected='selected'";?>>
						<?
						for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
							echo "<font color='red'>+ </font>" . $listAll[$i]["mnu_name"];
						?>
						</option>
						<? } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right" nowrap="nowrap" class="textBold">Target:</td>
				<td>
					<select name="mnu_target" id="mnu_target" class="form">
					<?
					$mnu_target = array( "New window" => "_blank","Current window" => "_self");
					foreach($mnu_target as $key => $value){
					?>
						<option value=<?=$value?> <? if($value == $row["mnu_target"]) echo "selected='selected'";?>><?=$key?></option>
					<? } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right" nowrap="nowrap" class="textBold">Menu position:</td>
				<td>
					<? $arr = array("Top","Left","Right","Bottom"); ?>
					<select name="mnu_position" id="mnu_position" class="form">
					<?
					$i=0;
					foreach($arr as $value){
						$i++;
					?>
					<option value="<?=$i?>" <? if($i == $position) echo "selected='selected'";?>><?=$value?></option>
					<? } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right" nowrap="nowrap" class="textBold">Set Order:</td>
				<td><input type="text" name="mnu_order" id="mnu_order" value="<?=$row["mnu_order"];?>" size="5" maxlength="5" class="form">
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="button" class="form" value="Update" style="cursor:hand; width:100px" onClick="validateForm();">&nbsp;
					<input type="reset" class="form" value="Clear all" style="cursor:hand; width:100px">
					<input type="hidden" name="action" value="update">
				</td>
			</tr>
		</form>
		</table>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>