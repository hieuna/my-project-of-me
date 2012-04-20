<div class="pageTitle">QUÊN MẬT KHẨU?</div>
<div class="signinBox" style="text-align:center">
	<div class="err_signin">
    	{if $logerror}
        	{$logerror}
        {/if}
    </div>
    <form name="frmLogin" action="quen-mat-khau.html" method="post" onsubmit="return checkLogin(this)">
        <label class="formLabel" for="Email">Email<span class="formRequest">*</span></label>
        <input class="formInput" id="Email" name="email" title="" type="text" value="{$smarty.request.email}"><br>
        <p>
        <label class="formLabel"></label>
        <input class="formBtn" value="Gửi mật khẩu cho tôi" type="submit"><span class="forrmDesc">
          &nbsp; &nbsp;  <a href="dang-nhap.html" style="text-decoration:underline;">Đăng nhập</a>
        </span></p>

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
	 
	
}
</script>
{/literal}
            