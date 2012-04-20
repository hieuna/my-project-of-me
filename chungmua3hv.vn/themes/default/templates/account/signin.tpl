<div class="pageTitle">ĐĂNG NHẬP</div>
<div class="signinBox" style="text-align:center">
	<div class="err_signin">
    	{if $logerror}
        	{$logerror}
        {/if}
    </div>
    <form name="frmLogin" method="post" onsubmit="return checkLogin(this)">
    <input type="hidden" name="url" value="{$smarty.get.url}" />
        <label class="formLabel" for="Email">Email<span class="formRequest">*</span></label>
        <input class="formInput" id="Email" name="email" title="" type="text" value="{$smarty.request.email}"><br>
        <label class="formLabel" for="Pass">Mật khẩu<span class="formRequest">*</span></label>
        <input id="Pass" class="formInput" name="password" type="password"><br>
       <div style="text-align:left; margin:auto; width:270px;" ><label><input id="Pass" class="remeberPass" align="left" type="checkbox"> Ghi nhớ mật khẩu</label>  |  <a title="Click vào đây nếu bạn quên mật khẩu" href="quen-mat-khau.html" style="text-decoration:underline;">Bạn quên mật khẩu?</a></div>
        <p>
        <label class="formLabel"></label>
        <input class="formBtn" value="Đăng nhập" type="submit"><span class="forrmDesc">
          &nbsp; &nbsp; hoặc <a href="dang-ky-thanh-vien.html" style="text-decoration:underline;">Đăng ký tài khoản</a> ngay bây giờ.
        </span>

    </p>
    </form>
</div>

{literal}
<script>
function checkLogin(frm){
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	if(frm.email.value==''){
		alert('Xin vui lòng nhập email đăng nhập.');
		frm.email.focus();
		return false;
	}
     if (document.frmLogin.email.value.search(emailRegEx) == -1) {
          alert("Bạn nhập sai địa chỉ email.");
			frm.email.focus();
		  return false;
	 }
	if(frm.password.value==''){
		alert('Xin vui lòng nhập mật khẩu.');
		frm.password.focus();
		return false;
	}
	 
	
}
</script>
{/literal}
            