<?
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("add");
//Khai bao Bien
$fs_redirect	= "listing.php";
$sql="1";
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
$active				= getValue("active","int","POST",1);
$sup_name			= getValue("sup_name","str","POST","");
$sup_cha				= getValue("sup_cha","int","POST",1);
$sup_order			= getValue("sup_order","int","POST",0);
if($sup_order==0) $sup_order	= getValue("sup_order","int","GET",0);
$sup_description	= getValue("sup_description","str","POST","");
$sup_parent_id		= getValue("sup_parent_id","int","POST",0);

//Insert to database
$myform->add("sup_name","sup_name",0,0,"",1,"Bạn chưa nhập tên nhóm tin !",0,"Bạn chưa nhập tên nhóm tin");
$myform->add("sup_description","sup_description",0,0,"",0,"",0,"");
$myform->add("sup_order","sup_order",1,0,0,0,"",0,"");
//Active data
$myform->add("sup_active","active",1,1,1,0,"",0,"");
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "insert"){
	//Check Error!
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex = new db_execute($myform->generate_insert_SQL());
		//echo $myform->generate_insert_SQL();
		//Return iCat onChange
		$iCat = 0;
		// Redirect to add new
		$fs_redirect = "add.php?save=1&iCat=" . $iCat;
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
		if (!confirm("Data has been added to the database ! Do you to add more category?")){
			window.location.href='listing.php';
		}
	</script>
<? } ?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<? template_top(translate_text("them_moi_hang_san_xuat"))?>
		<? /*---------Body------------*/ ?>
		<table border="0" width="100%" cellpadding="4" cellspacing="1">
		<form ACTION="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING']?>" METHOD="POST" name="add_new" enctype="multipart/form-data">
			<tr> 
				<td align="right" nowrap class="textBold"><?=translate_text("supplier_name")?>:</td>
				<td>
					<input type="text" name="sup_name" id="sup_name" value="<?=$sup_name?>" size="50" maxlength="50" class="form">
				</td>
			</tr>
			<tr> 
				<td align="right" nowrap class="textBold"><?=translate_text("order")?>:</td>
				<td>
					<input type="text" name="sup_order" id="sup_order" value="<?=$sup_order?>" size="20" maxlength="20" class="form">
				</td>
			</tr>
			<tr>
				<td nowrap="nowrap" align="right" class="textBold"><?=translate_text("description")?>:</td>
				<td>
					<textarea name="sup_description" id="sup_description" class="form" cols="50" rows="10"><?=$sup_description;?></textarea>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="button" class="form" value="Add new" style="cursor:hand; width:100px" onClick="validateForm();">&nbsp;
					<input type="reset" class="form" value="Clear all" style="cursor:hand; width:100px">
					<input type="hidden" name="active" value="1">
					<input type="hidden" name="action" value="insert">
				</td>
			</tr>
		</form>
		</table>
<? template_bottom() ?>
</body>
</html>