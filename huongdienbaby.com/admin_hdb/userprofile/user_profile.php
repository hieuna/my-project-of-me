<?
//Created by: Mr Trieu
require_once("config_security.php");
require_once("../../classes/database.php");
require_once("../../functions/functions.php");
require_once("../../classes/generate_form.php");
//Khai bao Bien
$fs_table		= "admin_user";
$fs_redirect	= "user_profile.php";

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
//Warning Error!
$errorMsgEmail = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "update_email"){
	$faq_question	= getValue("adm_email","str","POST","");
	//Insert to database
	$myform->add("adm_email","adm_email",0,0,"",1,"Email của bạn là gì?",0,"Email của bạn không hợp lệ.");
	//Add table
	$myform->addTable($fs_table);
	//Check Error!
	$errorMsgEmail .= $myform->checkdata();
	if($errorMsgEmail == ""){
		$db_ex = new db_execute($myform->generate_update_SQL("adm_id", $admin_id));
		//echo $myform->generate_update_SQL("adm_id", $admin_id);
		echo "<script language='javascript'>alert('Email của bạn đã được cập nhật !');</script>";
		//Redirect to:
		redirect($fs_redirect);
		exit();
	}
}
//add form for javacheck
$myform->addFormname("change_email");
//add more javacode
$myform->addjavasrciptcode("
						    		");
$myform->checkjavascript();

//Change your password ---------------------------------------->
//Get $Errormessage
$Errormessage = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "update_password"){
	$adm_password_old	= getValue("adm_password_old","str","POST","",1);
	$adm_password 		= getValue("adm_password","str","POST","",1);
	//update to database
	$myform->add("adm_password","adm_password",4,0,"     ",1,"Bạn chưa nhập mật khẩu mới !",0,"Bạn chưa nhập mật khẩu mới.");
	//Add table
	$myform->addTable($fs_table);
	//Kiem tra do dai cua mat khau
	$allow_update = 1;
	//check current password
	if (md5($adm_password_old) != $_SESSION["password"]){
		$allow_update = 0;
		$Errormessage .= "Old password is not correct ! <br>";
	}
	if (strlen($adm_password) < 6){
		$allow_update = 0;
		$Errormessage .= "Password must be atleast 6 characters ! <br>";
	}
	//Check Error!
	if($allow_update = 1){
		$db_ex = new db_execute($myform->generate_update_SQL("adm_id", $admin_id));
		//echo $myform->generate_update_SQL("adm_id", $admin_id);
		$_SESSION["password"] = md5($adm_password);
		echo "<script language='javascript'>alert('Mật khẩu mới của bạn đã được cập nhật !');</script>";
		redirect($returnurl);
		exit();
	}
}
//Select data
$db_data = new db_query("SELECT * FROM admin_user WHERE adm_id = " . $admin_id);
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
<script language="javascript">
function check_form_change_password(){
	if (change_password.adm_password_old.value==''){
		alert('Please enter Old password');
		return;
	}
	if (change_password.adm_password.value==''){
		alert('Please enter New password');
		return;
	}
	if (change_password.adm_password.value.length < 6 ){
		alert('New password must be at least 6 characters');
		return;
	}
	if (change_password.adm_password_con.value==''){
		alert('Please enter confirm password');
		return;
	}
	if (change_password.adm_password_con.value!=change_password.adm_password.value){
		alert('New password and confirm password is not correct !');
		return;
	}
	change_password.submit();
}
</script>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? template_top(translate_text("sua_doi_thong_tin_admin"),0)?>
<table border="0" cellpadding="4" cellspacing="2" width="100%">
		<tr>
			<td valign="top" width="50%" align="center">
				<? template_top(translate_text("Change_your_Email"),0)?>
				<table border="0" cellpadding="3" cellspacing="2" width="70%" align="center" height="120">
					<form ACTION="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'];?>" METHOD="POST" name="change_email">
						 <tr>
							  <td colspan="2" align="center">
									<?=$errorMsgEmail?>
							  </td>
						 </tr>
						 <tr>
							  <td class="textBold" nowrap="nowrap" align="right" width="20%">User login:</td>
							  <td><?=$row["adm_loginname"]?></td>
						 </tr>
						 <tr>
							  <td class="textBold" nowrap="nowrap" align="right">Your Email:</td>
							  <td><input type="text" name="adm_email" id="adm_email" value="<?=$row["adm_email"]?>" class="form" size="50" maxlength="100"></td>
						 </tr>
						 <tr>
							  <td></td>
							  <td>
									<input type="button" class="form" value="Change email" style="cursor:hand; width:100px" onClick="validateForm();">&nbsp;
									<input type="reset" class="form" value="Reset all" style="cursor:hand; width:100px">
									<input type="hidden" name="action" value="update_email">
							  </td>
						 </tr>
					</form>
					</table>
					<? template_bottom() ?>
			  </td>
			  <td width="10%">&nbsp;</td>
			  <td valign="top" width="50%" align="center">
						<? template_top(translate_text("Change_your_password"),0)?>
						<table border="0" cellpadding="3" cellspacing="2" width="70%" align="center">
						 <form ACTION="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'];?>" METHOD="POST" name="change_password">
							  <tr>
									<td colspan="2" align="center">
										 <?=$Errormessage;?>
									</td>
							  </tr>
							  <tr>
									<td class="textBold" nowrap="nowrap" align="right" width="20%">Old password:</td>
									<td><input type="password" name="adm_password_old" id="adm_password_old" class="form" size="20" maxlength="20"></td>
							  </tr>
							  <tr>
									<td class="textBold" nowrap="nowrap" align="right">New password:</td>
									<td><input type="password" name="adm_password" id="adm_password" class="form" size="20" maxlength="20"></td>
							  </tr>
							  <tr>
									<td class="textBold" nowrap="nowrap" align="right">Confirm new password:</td>
									<td><input type="password" name="adm_password_con" id="adm_password_con" class="form" size="20" maxlength="20"></td>
							  </tr>
							  <tr>
									<td colspan="2" align="center">
										 <input type="button" class="form" value="Change password" style="cursor:hand; width:100px" onClick="check_form_change_password();">&nbsp;
										 <input type="reset" class="form" value="Reset all" style="cursor:hand; width:100px">
										 <input type="hidden" name="action" value="update_password">
									</td>
							  </tr>
						 </form>
						 </table>
						<? template_bottom() ?>
			  </td>
		 </tr>
	</table>
<? template_bottom() ?>
</body>
</html>