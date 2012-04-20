<?php /* Smarty version 2.6.19, created on 2011-09-19 02:37:29
         compiled from form_forgot_password.tpl */ ?>
<div class="pageTitle">QUÊN MẬT KHẨU?</div>
<div class="signinBox" style="text-align:center">
	<div class="err_signin">
    	<?php if ($this->_tpl_vars['logerror']): ?>
        	<?php echo $this->_tpl_vars['logerror']; ?>

        <?php endif; ?>
    </div>
    <form name="frmLogin" action="quen-mat-khau.html" method="post" onsubmit="return checkLogin(this)">
        <label class="formLabel" for="Email">Email<span class="formRequest">*</span></label>
        <input class="formInput" id="Email" name="email" title="" type="text" value="<?php echo $_REQUEST['email']; ?>
"><br>
        <p>
        <label class="formLabel"></label>
        <input class="formBtn" value="Gửi mật khẩu cho tôi" type="submit"><span class="forrmDesc">
          &nbsp; &nbsp;  <a href="dang-nhap.html" style="text-decoration:underline;">Đăng nhập</a>
        </span></p>

    </p>
    </form>
</div>

<?php echo '
<script>
function checkLogin(frm){
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\\.[A-Z]{2,4}$/i;
	if(frm.email.value==\'\'){
		alert(\'Xin vui lòng nhập email đăng nhập.\');
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
'; ?>

            