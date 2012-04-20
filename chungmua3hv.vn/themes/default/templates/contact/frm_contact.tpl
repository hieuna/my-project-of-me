<script>
var null_name = '{#null_name#}';
var null_email = '{#null_email#}';
var null_email = '{#null_title#}';
var null_security = '{#null_content#}';
var null_security = '{#null_security#}';
var invalide_email = '{#invalide_email#}';
var security_incorrect = '{#security_incorrect#}';
</script>
{literal}
<script language="javascript">	
	function validateForm( frm )
	{
		var RE_EMAIL = /^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/;

		if ( frm.fullname.value == '')
		{
			alert (null_name);
			frm.fullname.focus();
			return false;
		}
		if ( frm.email.value == '')
		{
			alert (null_email);
			frm.email.focus();
			return false;
		}
		if ( !RE_EMAIL.test(frm.email.value) )
		{
			alert (invalide_email);
			frm.email.focus();
			return false;
		}
		if ( frm.subject.value == '')
		{
			alert (null_title);
			frm.subject.focus();
			return false;
		}
		if ( frm.contactInput.value == '')
		{
			alert (null_content);
			frm.contactInput.focus();
			return false;
		}
		if ( frm.txt_captcha.value == '')
		{
			alert (null_security);
			frm.txt_captcha.focus();
			return false;
		}
		
		
	}
</script>
{/literal}

<div class="searchContent">
    <div class="searchTitle">
        <div class="searchTitleInside">{#lienhelocaldeal#}</div>     
    </div>
    <div class="mes_error">
     {if $msg !=''}
		{$msg}!
	 {/if}
    </div>
    <form method="post" action="{$smarty.const.SITE_URL}index.php?mod=contact" name="frm" onsubmit="return validateForm(this);">
    <ul class="contactForm">
        <li>
        <label for="Name">{#fullName#}</label>
        <input type="text" name="fullname" id="Name" class="contactInput">
        </li>
        <li>
        <label for="EMail">{#dcemail#}</label>
        <input type="text" name="email" id="EMail" class="contactInput" value="">
        </li>
        <li>
        <label for="Subject">{#titlelocal#}</label>
        <input type="text" name="subject" id="Subject" class="contactInput">
        </li>
        <li>
        <label for="Message">{#ctlocal#}</label>
        <textarea class="contactInput" style="height:80px;" name="contactInput" id="Message"></textarea></li>
        <li>
        <label for="Message">{#sercode#}</label>
        <img src="{$smarty.const.SITE_URL}lib/captcha/captcha.class.php" align="left" border="1"   id="imgCaptcha" >
        <img src="{$smarty.const.SITE_URL}themes/default/images/refresh.png" class="refresh_contact" onclick="refreshImage(imgCaptcha)">
        </li>
        <li>
        <label for="Message">{#sercodeconf#}</label>
        <input type="text" name="txt_captcha"  style="height:17px; width:100px;"/>
        </li>
        <li>
        <input type="submit" value="{#localsendmail#}" class="contactButton">
        </li>
    </ul>
    </form>
    <dl class="contactInfo">
                <dt class="name"><b style="color:#ecc508">{#dctaihn#}:</b></dt>
                <dt>{#localaddress#}:</dt>
                <dd>{#localdc1#}</dd>
                <dt>{#localphone#}: <span style="color:#B6B6B6;">{#numberlocalphone#}</span></dt>
                <dt>Fax: <span style="color:#B6B6B6;">04.35626145</span></dt>
                <dt>Email: <a style="color:#06F;" href="mailto:han@localdeal.vn">han@localdeal.vn</a></dt>
    </dl>
     <dl class="contactInfo">
                <dt class="name"><b style="color:#ecc508">{#dctaihcm#}:</b></dt>
                <dt>{#localaddress#}:</dt>
                <dd>{#localdc2#}</dd>
                <dt>Email: <a style="color:#06F;" href="mailto:hcm@localdeal.vn">hcm@localdeal.vn</a></dt>
    </dl>
    <div class="clr"></div>
</div>  
 
{literal}
 <script type="text/javascript">
	$("document").ready(function (){
		var url = '{/literal}{$smarty.const.SITE_URL}{literal}index.php/mod,contact/task,getcaptcha/ajax,true/';
		$.get(url, function (result){
			$("#hid_keycapcha").val(result);
		});
	});
	
	function refreshImage(obj){
		img_src = obj.src;
		obj.src = img_src + "?rand=1"+ Math.random();
		var url = '{/literal}{$smarty.const.SITE_URL}{literal}index.php/mod,contact/task,getcaptcha/ajax,true/';
		$.get(url, function (result){
			$("#hid_keycapcha").val(result);
		});
	}
</script> 
{/literal}                  
                    


  
