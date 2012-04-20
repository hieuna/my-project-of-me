<link type="text/css" rel="stylesheet" href="/lib/form/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></link>
<script type="text/javascript" src="/lib/form/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<script language = "javascript">var pathToImages = "/lib/form/calendar/images/"; </script>

<script>
var null_name = '{#null_name#}';
var null_email = '{#null_email#}';
var null_address = '{#null_address#}';
var null_phone = '{#null_phone#}';
var null_security = '{#null_security#}';
var invalide_email = '{#invalid_email#}';
var security_incorrect = '{#security_incorrect#}';
</script>
{literal}
<script language="javascript">	
	function validateForm( frm )
	{
		var RE_EMAIL = /^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/;

		if ( frm.txt_name.value == '')
		{
			alert (null_name);
			frm.txt_name.focus();
			return false;
		}
		if ( frm.txt_email.value == '')
		{
			alert (null_email);
			frm.txt_email.focus();
			return false;
		}
		if ( !RE_EMAIL.test(frm.txt_email.value) )
		{
			alert (invalide_email);
			frm.txt_email.focus();
			return false;
		}
		if ( frm.txt_address.value == '')
		{
			alert (null_address);
			frm.txt_address.focus();
			return false;
		}
		if ( frm.txt_phone.value == '')
		{
			alert (null_phone);
			frm.txt_phone.focus();
			return false;
		}
	}
</script>
{/literal}
<!-- Contact -->
<div class="Module">
	<div class="tabBlue">					
		<b>{#cart#}</b>
	</div>
	
	<div class="borderModule">		
		<form name="frm_booking" method="post" action="" enctype="multipart/form-data" onsubmit="return validateForm(this);">			
		<table width="450" border="0" cellpadding="5" cellspacing="0" style="margin:10px 0 0 50px;">
			<tr>
				<td>{#name#} <label class="colorOrange">(*)</label></td>
				<td><input type="text" name="txt_name" style="width:300px" value="{$user.fullname}"/></td>
			</tr>
			<tr>
				<td>{#address#} <label class="colorOrange">(*)</label></td>
				<td><input type="text" name="txt_address" style="width:300px" value="{$user.address}"/></td>
			</tr>
			<tr>
				<td>{#email#} <label class="colorOrange">(*)</label></td>
				<td><input type="text" name="txt_email" style="width:300px" value="{$user.email}"/></td>
			</tr>
			<tr>
				<td>{#phone#} <label class="colorOrange">(*)</label></td>
				<td><input type="text" name="txt_phone" style="width:300px" value="{$user.phone}"/></td>
			</tr>
			<tr>
				<td valign="top">{#other_infor#}</td>
				<td><textarea name="txt_addition_request" style="width:300px; height:100px;"></textarea></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" class="ButtonCart" style="border:none;" name="bt_contact" value="Thanh toán" />
				<input type="button"  class="ButtonCart" onclick="window.history.go(-1);" style="border:none;" name="bt_reset" value="Làm lại" /></td>
			</tr>
		</table>				
		</form>
	</div>
</div>
<div class="clr"></div>

{literal}
<script type="text/javascript">
	$("document").ready(function (){
		var url = {/literal}'{$smarty.const.SITE_URL}'{literal}+'index.php/mod,contact/task,getcaptcha/ajax,true/';
		$.get(url, function (result){
			$("#hid_keycapcha").val(result);
		});
	});
	
	function refreshImage(obj){
		img_src = obj.src;
		obj.src = img_src + "?rand=1"+ Math.random();
		var url = {/literal}'{$smarty.const.SITE_URL}'{literal}+'index.php/mod,contact/task,getcaptcha/ajax,true/';
		$.get(url, function (result){
			$("#hid_keycapcha").val(result);
		});
	}
</script>
{/literal}