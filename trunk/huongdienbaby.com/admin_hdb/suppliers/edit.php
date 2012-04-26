<?
require_once("config_security.php");
//Khai bao Bien
$fs_redirect	= base64_decode(getValue("sup_type","str","GET",base64_encode("listing.php")));
//Call Class generate_form();
$myform = new generate_form();
//Loại bỏ chuc nang thay the Tag Html
$myform->removeHTML(0);
$record_id			= getValue("record_id","int","GET");
$db_edit =new db_query("SELECT * FROM " . $fs_table . " WHERE sup_id=" . $record_id);
$row=mysql_fetch_array($db_edit->result);
$myform->add("sup_description","sup_description",0,0,"",0,"",0,"");
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "insert"){
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex = new db_execute($myform->generate_update_SQL("sup_id", $record_id));
		redirectHTML($fs_redirect);
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
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td colspan="3">
		<? /*---------Header------------*/ ?>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td width="7" background="../css/temp_bg_8.jpg"><img src="../css/temp_7.jpg" border="0" width="7" height="24"></td>
				<td background="../css/temp_bg_title_8.jpg" class="textBoldColor" width="5%" nowrap="nowrap" style="padding-right:5px; padding-left:5px">Add new</td>
				<td width="3" background="../css/temp_bg_title_8.jpg"><img src="../css/temp_title_9.jpg" border="0" width="3" height="24"></td>
				<td background="../css/temp_bg_8.jpg">&nbsp;</td>
				<td width="3" align="right" background="../css/temp_bg_8.gif"><img src="../css/temp_9.jpg" border="0" width="3" height="24"></td>
			</tr>
		</table>
		<? /*---------Header------------*/ ?>
		</td>
	</tr>
	<tr>
		<td width="2" background="../css/temp_4.jpg"><img src="../css/temp_4.jpg" border="0" width="2" height="6"></td>
		<td background="../css/body_background.jpg"><img src="../css/body_background.jpg" border="0" width="31" height="15"></td>
		<td width="2" align="right" background="../css/temp_6.jpg"><img src="../css/temp_6.jpg" border="0" width="2" height="9"></td>
	</tr>
	<tr>
		<td width="2" background="../css/temp_4.jpg"><img src="../css/temp_4.jpg" border="0" width="2" height="6"></td>
		<td bgcolor="#FFFFFF">
		<? /*---------Body------------*/ ?>
		<table border="0" width="100%" cellpadding="4" cellspacing="1">
		<form ACTION="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING']?>" METHOD="POST" name="add_new" enctype="multipart/form-data">
			<tr>
				<td nowrap="nowrap" align="right" class="textBold">Description:</td>
				<td>
					<textarea name="sup_description" id="sup_description" class="form" cols="50" rows="10"><?=$row["sup_description"];?></textarea>				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="button" class="form" value="Edit data" style="cursor:hand; width:100px" onClick="validateForm();">&nbsp;
					<input type="reset" class="form" value="Clear all" style="cursor:hand; width:100px">
					<input type="hidden" name="active" value="1">
					<input type="hidden" name="action" value="insert">				</td>
			</tr>
		</form>
		</table>
		<? /*---------Body------------*/ ?>
		</td>
		<td width="2" align="right" background="../css/temp_6.jpg"><img src="../css/temp_6.jpg" border="0" width="2" height="9"></td>
	</tr>
	<tr>
		<td colspan="3">
		<? /*--------Footer-------*/ ?>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td background="../css/temp_2.jpg"><img src="../css/temp_1.jpg" border="0" width="4" height="3"></td>
				<td background="../css/temp_2.jpg"><img src="../css/temp_2.jpg" border="0" width="8" height="3"></td>
				<td background="../css/temp_2.jpg" align="right"><img src="../css/temp_3.jpg" border="0" width="3" height="3"></td>
			</tr>
		</table>
		<? /*--------Footer-------*/ ?>
		</td>
	</tr>
</table>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>