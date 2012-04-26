<?
//Created by: Mr Toan
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("add");

require_once("../../classes/database.php");
require_once("../../classes/menu.php");
require_once("../../classes/generate_form.php");
require_once("../../functions/functions.php");
require_once("../../classes/upload.php");

$position = getValue("position", "int", "GET", 1);
if(isset($_POST["mnu_position"])){
	$position = getValue("mnu_position", "int", "POST", 1);
}
if($position==0) $position=1;
$menu = new menu();
$listAll = $menu->getAllChild("menus_multi","mnu_id","mnu_parent_id","0","mnu_position = " . $position . " AND lang_id = " . $_SESSION["lang_id"],"mnu_id,mnu_name,mnu_link,mnu_target,mnu_order,mnu_position,mnu_parent_id,mnu_has_child","mnu_order ASC, mnu_name ASC","mnu_has_child");

$fs_redirect	= "listing.php";
//Khai bao Bien

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
$myform->add("mnu_link","mnu_link",0,1,"",0,"Bạn chưa nhập địa chỉ liên kết !",0,"Bạn chưa nhập địa chỉ liên kết");
$myform->add("mnu_parent_id","mnu_parent_id",1,0,0,0,"",0,"");
$myform->add("mnu_target","mnu_target",0,0,"",1,"",0,"");
$myform->add("mnu_check","mnu_check",0,0,"",0,"",0,"");
$myform->add("mnu_position","mnu_position",1,0,0,0,"",0,"");
$myform->add("mnu_space","mnu_space",1,0,0,0,"",0,"");
$myform->add("mnu_order","mnu_order",1,0,0,1,"",0,"");
$myform->add("admin_id","admin_id",1,1,0,0,"",0,"");
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "insert"){
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex = new db_execute($myform->generate_insert_SQL());
		//echo $myform->generate_insert_SQL();
		//Update mnu_has_child cua parent_id
		if($mnu_parent_id > 0){
			$db_ex = new db_execute("UPDATE menus_multi SET mnu_has_child = 1 WHERE mnu_id = " . $mnu_parent_id);
		}
		//Return iCat onChange
		$iParent = 0;
		if (isset($_POST["mnu_parent_id"])) $iParent = $_POST["mnu_parent_id"];
		// Redirect to add new
		$fs_redirect = "add.php?save=1&iParent=" . $iParent . "&position=" . $position;
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
		if (!confirm("Data has been added to the database ! Do you to add more menu?")){
			window.location.href='listing.php';
		}
	</script>
<? } ?>
<script language="javascript" src="../js/library.js"></script>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<? template_top(translate_text("them_moi_menu"))?>
		<? /*---------Body------------*/ ?>
		<table align="center" cellpadding="4" cellspacing="1" width="100%">
		<form name="add_new" action="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING']?>" method="post" enctype="multipart/form-data">
			<tr>
				<td colspan="2" align="center"><?=$errorMsg;?></td>
			</tr>
			<tr>
				<td align="right" nowrap="nowrap" class="textBold">Menu position:</td>
				<td>
					<select name="mnu_position" id="mnu_position" class="form" onChange="window.location.href='add.php?position='+this.value">
					<?
					$pos = getValue("position","int","GET",0);
					foreach($array_type as $value => $key){
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
				<td align="right" nowrap="nowrap" class="textBold">Menu name:</td>
				<td><input type="text" name="mnu_name" id="mnu_name" value="<?=$mnu_name;?>" size="50" maxlength="255" class="form"> </td>
			</tr>
			<tr> 
				<td align="right" nowrap="nowrap" class="textBold">Khoảng cách:</td>
				<td><input type="text" name="mnu_space" id="mnu_space" value="<?=$mnu_space;?>" size="30" maxlength="255" class="form"> </td>
			</tr>
			<tr>
				<td align="right" nowrap="nowrap" class="textBold">Link:</td>
				<td><input type="text" name="mnu_link" id="mnu_link" value="<?=$mnu_link;?>" size="70" class="form">&nbsp;<input class="form" type="button" onClick="creat_link('mnu_link')" value="Create link"></td>
			</tr>
			<tr> 
				<td align="right" nowrap="nowrap" class="textBold">Menu check link:</td>
				<td><input type="text" name="mnu_check" id="mnu_check" value="<?=$mnu_check?>" size="50" maxlength="255" class="form"> </td>
			</tr>
         <?
         /*
			?>
			<tr>
				<td align="right" class="textBold">Image link:</td>
				<td><input type="file" size="30" class="form" name="picture" id="picture"></td>
			</tr>
			<tr>
				<td align="right" class="textBold">Image hover:</td>
				<td><input type="file" size="30" class="form" name="picture_hover" id="picture_hover"></td>
			</tr>
			<?
			*/
			?>
			<tr>
				<td align="right" nowrap="nowrap" class="textBold">Upper menu:</td>
				<td> 
					<select name="mnu_parent_id" id="mnu_parent_id" class="form">
					<option value="0">--[No upper menu]--</option>
					<?
					$iParent = getValue("iParent","int","GET",0);
					for($i=0;$i<count($listAll);$i++){
						if($listAll[$i]["mnu_id"] == $iParent){
					?>
						<option value="<?=$listAll[$i]["mnu_id"]?>" selected="selected">
						<?
						for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
							echo "<font color='red'>+ </font>" . $listAll[$i]["mnu_name"];
						?>
						</option>
					<? }else{ ?>
						<option value="<?=$listAll[$i]["mnu_id"]?>">
						<?
						for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
							echo "<font color='red'>+ </font>" . $listAll[$i]["mnu_name"];
						?>
						</option>
					<?
						}
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right" nowrap="nowrap" class="textBold">Target:</td>
				<td>
					<select name="mnu_target" id="mnu_target" class="form">
					<?
					foreach($mnu_target_array as $key => $value){
					?>
						<option value=<?=$value?>><?=$key?></option>
					<? } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right" nowrap="nowrap" class="textBold">Set Order:</td>
				<td><input type="text" name="mnu_order" id="mnu_order" value="<?=$mnu_order;?>" size="5" maxlength="5" class="form">
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="button" class="form" value="Add new" style="cursor:hand; width:100px" onClick="validateForm();">&nbsp;
					<input type="reset" class="form" value="Clear all" style="cursor:hand; width:100px">
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