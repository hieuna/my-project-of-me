<div class="t_top"><div><?=translate_display_text("Dang_ky_nhan_ban_tin")?></div></div>
<div class="t_center">
<table cellpadding="5" cellspacing="0" align="center">
	<form action="<?=$lang_path?>addnewsletter.php" name="form_newsletter" method="post" onsubmit="checknewsletter(); return false">
	<tr>
		<td nowrap="nowrap"><?=translate_display_text("Ho_va_ten")?></td>
		<td><input type="text" name="newsletter_name" id="newsletter_name" class="form"  style="width:100px;"/></td>
	</tr>
	<tr>
		<td nowrap="nowrap"><?=translate_display_text("Email_cua_ban")?></td>
		<td><input type="text" name="newsletter_email" id="newsletter_email" class="form"   style="width:100px;"/></td>
	</tr>
	<tr>
		<td align="center" colspan="2"><input type="submit" class="buttom"  value="<?=translate_display_text("Gui_thong_tin")?>" width="92" height="21"  /></td>
	</tr>
	<input type="hidden" name="url" value="<?=$_SERVER['REQUEST_URI']?>" />
	</form>
</table>	
</div>
<div class="t_bottom"><div>&nbsp;</div></div>

<script language="javascript">
function checknewsletter(){
	if(document.getElementById("newsletter_name").value == ''){
		alert("<?=htmlspecialchars(translate_display_text("please_enter_your_name"))?>");
		document.getElementById("newsletter_name").focus();
		return;
	}
	if(document.getElementById("newsletter_email").value == '' || !isemail(document.getElementById("newsletter_email").value)){
		alert("<?=htmlspecialchars(translate_display_text("please_enter_your_email"))?>");
		document.getElementById("newsletter_email").focus();
		return;
	}
	document.form_newsletter.submit();

}
function isemail(email) {
	var re = /^(\w|[^_]\.[^_]|[\-])+(([^_])(\@){1}([^_]))(([a-z]|[\d]|[_]|[\-])+|([^_]\.[^_])*)+\.[a-z]{2,3}$/i
	return re.test(email);
}
</script>
