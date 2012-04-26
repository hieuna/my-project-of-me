<?
require_once("../security/security.php");

$title		= "Administrator Login";
$username	= getValue("username", "str", "POST", "", 1);
$password	= getValue("password", "str", "POST", "", 1);
$action		= getValue("action", "str", "POST", "");
if($action == "login"){
	$user_id	= 0;
	$user_id = checkLogin($username, $password);
	if($user_id != 0){
		$isAdmin		= 0;
		$db_isadmin	= new db_query("SELECT adm_isadmin, lang_id FROM admin_user WHERE adm_id = " . $user_id);
		$row			= mysql_fetch_array($db_isadmin->result);
		if($row["adm_isadmin"] != 0) $isAdmin = 1;
		//Set SESSION
		$_SESSION["logged"]		= 1;
		$_SESSION["user_id"]		= $user_id;
		$_SESSION["userlogin"]	= $username;
		$_SESSION["password"]	= md5($password);
		$_SESSION["isAdmin"]		= $isAdmin;
		$_SESSION["lang_id"]		= $row["lang_id"];
		$_SESSION["lang_id"] 	= get_curent_language();
		$_SESSION["lang_path"] 	= get_curent_path();
		unset($db_isadmin);
	}
}

//Check logged
$logged = getValue("logged", "int", "SESSION", 0);
if($logged == 1){
	redirect("../index.php");
}
?>
<html>
<head>
<title>FinalStyle - Admin Control Pannel</title>
<meta http-equiv="Page-Exit" content="blendTrans(Duration=0.4)" />
<meta http-equiv="Page-Enter" content="blendTrans(Duration=0.4)" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="style/login.css" rel="stylesheet" type="text/css">
</head>
<body>
<div style="margin-top:200px;" align="center">
<div style="width:400px;">
<? template_top($title,0)?>
<? /*----------..................... Start WEB CONTENT here ....................----------*/ ?>
<? /*-------------------------------------------------------------------------------------*/ ?>

<form name="login" action="login.php" method="post">
<table cellpadding="3" cellspacing="3">
	<tr>
		<td rowspan="2"><img src="style/icon.gif" border="0"></td>
		<td class="form_name" align="right">Username :</td>
		<td class="form_text"><input title="Username" id="usermane" name="username" type="text" class="form_control"></td>
	</tr>
	<tr>
		<td class="form_name" align="right">Password :</td>
		<td class="form_text"><input title="Password" id="password" name="password" type="password" class="form_control"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><input title="Login" name="Submit" type="image" src="style/button_login.gif"></td>
	</tr>
</table>
<input name="action" type="hidden" value="login">
</form>
<div align="center" class="form_text">Copyright &copy; 2006-<?=date("Y")?> <a class="finalstyle" href="http://www.finalstyle.com" target="_blank">FinalStyle</a>. All right reserved.</div>

<? /*-------------------------------------------------------------------------------------*/ ?>
<? /*----------...................... End WEB CONTENT here .....................----------*/ ?>
<? template_bottom() ?>
</div>
</div>
</body>
</html>