{include file='admin_header_global.tpl'}
{literal}
<script type="text/javascript">
var RecaptchaOptions = {
    theme : 'clean'
};
</script>
{/literal}
<table cellspacing='0' cellpadding='0' style='width: 100%; height: 100%;'>
<tr>
<td align='center'>
	<form action='admin_login.php' method='POST'>
	<div class='box'>
		{if $errorTxt}<div class='error'>{$errorTxt}</div>{/if}
		<table cellpadding='0' cellspacing='0'>
		<tr>
			<td class='login'>Tên đăng nhập: &nbsp;</td>
			<td class='login'><input type='text' class='text' name='username' id='username' maxlength='50'> &nbsp;</td>
			<td class='login'>Mật khẩu: &nbsp;</td>
			<td class='login' align="right"><input type='password' class='text' name='password' id='password' maxlength='50'> &nbsp;</td>
		</tr>
		{if $captcha!=false}
		<tr><td height="5"></td></tr>
		<tr>
			<td align="center" colspan="4">{$captcha}</td>
		</tr>
		{/if}
		<tr><td height="5"></td></tr>
		<tr>
			<td align="center" colspan="4" class='login'><input type='submit' class='button' value='Vào nào'></td>
		</tr>
		</table>
	        
	</div>
	<input type='hidden' name='task' value='dologin'>
	<NOSCRIPT><input type='hidden' name='javascript' value='no'></NOSCRIPT>
	</form>
</td>
</tr>
</table>

{literal}
<script type="text/javascript">
<!--
document.getElementById('username').focus();
//-->
</script>
<style type='text/css'>
html, body {
	height: 100% !important;
}
body {
	text-align: center;
	background-color: #EEEEEE;
	background-image: url(../templates/images/admin/admin_login.gif);
	background-repeat: no-repeat;
	background-position: center center;
}
div.box {
	border: 1px dashed #AAAAAA;
	padding: 15px;
	background: #FFFFFF;
	font-family: "Trebuchet MS", tahoma, verdana, serif;
	font-size: 12px;
        width: 470px;
}
td.login {
	font-family: "Trebuchet MS", tahoma, verdana, serif;
	font-size: 12px;
}
input.text {
	font-family: arial, tahoma, verdana, serif;
	font-size: 12px; 
}
div.error {
	text-align: center;
	padding-top: 3px;
	font-weight: bold;
}
input.button {
	font-family: arial, tahoma, verdana, serif;
	font-size: 12px;
	background: #DDDDDD;
	padding: 2px;
	font-weight: bold;
}
</style>
{/literal}

</body>
</html>