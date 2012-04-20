<div class="search-box" style="color:#fff; padding-right:10px; margin-top:20px; font-size:11px;">
<form name="frmLogin" method="POST" action="{$formAction}">
<table cellpadding="0" cellspacing="5" border="0">
	<tr>
		<td align="right">{#username#}:</td>
		<td><input type="text" name="tex_username" value="" style="font-size:11px; width:100px;" tabindex="1"></td>		
		<td><input type="submit" value="Login" name="btlogin" class="button" style="border:none; float:none;" tabindex="3"></td>
	</tr>
	<tr>
		<td align="right">{#password#}:</td>
		<td><input type="password" name="tex_password" value="" style="font-size:11px; width:100px;" tabindex="2"></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="{$smarty.const.SITE_URL}{"index.php?mod=user&task=register"}" class="colorwhite">{#register#}</a></td>
	</tr>
</table>
</form>
</div>