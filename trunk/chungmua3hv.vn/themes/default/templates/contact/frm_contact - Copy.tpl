<script>
var null_name = '{#null_name#}';
var null_email = '{#null_email#}';
var null_security = '{#null_security#}';
var invalide_email = '{#invalide_email#}';
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
		if ( frm.txt_captcha.value == '')
		{
			alert (null_security);
			frm.txt_captcha.focus();
			return false;
		}
		if ( frm.txt_captcha.value != frm.hid_keycapcha.value )
		{
			alert (security_incorrect);
			frm.txt_captcha.focus();
			return false;
		}
		
	}
</script>
{/literal}
<!-- Contact -->
<div class="col_center">
        	
        	<div class="boxCenter">
            	<h2 class="caption">{#HOME#} &raquo; {#CONTACT#}</h2>
                <div class="content">
<form name="frm_contact" id="frm_contact" method="post" action="" onsubmit="return validateForm(this);">		
								<table cellpadding="3" cellspacing="3">
									<tr>					
										<td colspan="2" align="left">
											{$aContact.content}
										</td>
									</tr>
									<tr>					
										<td colspan="2" align="left"><br>
											<b style="font-size:14px;font-family:Verdana; text-transform:uppercase;" class="colorBrown">{#contact_form#}</b>
										</td>
									</tr>					
									{if $msg !=''}
									<tr>
										<th colspan="2" align="center" style="font-size:11px; color:#FF0000;">{$msg}</th>
									</tr>
									{/if}
									<tr>
										<th>{#name#}:</th>
										<td><input type="text" name="txt_name" style="width:300px"/></td>
									</tr>		
									<tr>
										<th>{#email#}:</th>
										<td><input type="text" name="txt_email" style="width:300px;"/></td>
									</tr>
									<tr>
										<th>{#content#}:</th>
										<td><textarea name="txt_content" style="width:300px; height:100px;overflow:auto;"></textarea></td>
									</tr>
									<tr>
										<th>{#security#}:</th>
										<td>	<img src="{$smarty.const.SITE_URL}lib/captcha/showkey.jpg" align="left" border="1"   id="imgCaptcha" style="cursor:pointer" onclick="refreshImage(this)">
                                            <input type="hidden" name="hid_keycapcha" id="hid_keycapcha" value="">
											<input type="text" name="txt_captcha"  style="height:17px; width:100px; margin-left:10px;"/></td>
									</tr>
									<tr>
										<th>&nbsp;</th>
										<th align="center" style="margin-top:10px;">
											<input type="submit" name="bt_contact" value="{#send#}" class="buttonPoll"/>
											<input type="reset" name="bt_reset" value="{#reset#}" class="buttonPoll"/>
										</th>
									</tr>
								</table>
							</form>                </div>
            
            </div>
        	
        </div>
{literal}
<script>	
	function refreshImage(obj){
		var img_src = '{/literal}{$smarty.const.SITE_URL}{literal}lib/captcha/captcha.class.php';
		var img =  new Image();
		img.src = img_src + "?rand=1"+ Math.random();
		$(img).load(function(){
			obj.src = img.src;
			var url = '{/literal}{$smarty.const.SITE_URL}{literal}contact?task=getcaptcha&ajax=true';
			$.get(url, function (result){				
				$("#hid_keycapcha").val(result);
			});	
		});		
	}
	
</script>
{/literal}

	
	