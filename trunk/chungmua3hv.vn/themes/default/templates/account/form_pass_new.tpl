<div class="pageTitle">Lấy lại mật khẩu</div>
<div class="signinBox" style="text-align:center">
	{if $logerror}
    <div class="err_signin">
        <p style="font-size:20px;">{$logerror}</p>
    </div>
    <div style="text-align:left;margin-left:20px;">
    	<p><b>Mọi thắc mắc xin vui lòng liên hệ {#company_name#}</b></p>
        <p><b>Địa chỉ:</b> {#company_address#}</p>
        <p><b>Số điện thoại:</b> {#company_phone#}</p>
        <p><b>Email:</b> <a href="mailto:{#company_email#}">{#company_email#}</a></p>    
    </div>
    {else}
    <form name="frmLogin" action="" method="post" onsubmit="return checkLogin(this)">
        <label class="formLabel" style="width:125px;" for="Email">Nhập mật khẩu mới<span class="formRequest">*</span></label>
        <input class="formInput" id="Email" name="chpass" title="" type="password" value="{$smarty.request.pass}"><br>
        <label class="formLabel" style="width:125px;" for="Email">Mật khẩu xác nhận<span class="formRequest">*</span></label>
        <input class="formInput" id="Email" name="passconf" title="" type="password" value=""><br>
        <p>
        <label class="formLabel"></label>
        <input class="formBtn" value="Đổi mật khẩu" type="submit"></p>

    </p>
    </form>
    {/if}
</div>

{literal}
<script>
function checkLogin(frm){
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	if(frm.pass.value==''){
		alert('Xin vui lòng nhập mật khẩu.');
		frm.pass.focus();
		return false;
	}
	if(frm.passconf.value==''){
		alert('Xin vui lòng nhập mật khẩu xác nhận.');
		frm.passconf.focus();
		return false;
	}
	if(frm.passconf.value!=frm.pass.value){
		alert('Mật khẩu xác nhận không chính xác.');
		frm.passconf.focus();
		return false;
	}
     
	 
	
}
</script>
{/literal}
            