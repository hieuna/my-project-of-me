<?php /* Smarty version 2.6.19, created on 2011-09-19 13:15:26
         compiled from form_pass_new.tpl */ ?>
<div class="pageTitle">Lấy lại mật khẩu</div>
<div class="signinBox" style="text-align:center">
	<?php if ($this->_tpl_vars['logerror']): ?>
    <div class="err_signin">
        <p style="font-size:20px;"><?php echo $this->_tpl_vars['logerror']; ?>
</p>
    </div>
    <div style="text-align:left;margin-left:20px;">
    	<p><b>Mọi thắc mắc xin vui lòng liên hệ <?php echo $this->_config[0]['vars']['company_name']; ?>
</b></p>
        <p><b>Địa chỉ:</b> <?php echo $this->_config[0]['vars']['company_address']; ?>
</p>
        <p><b>Số điện thoại:</b> <?php echo $this->_config[0]['vars']['company_phone']; ?>
</p>
        <p><b>Email:</b> <a href="mailto:<?php echo $this->_config[0]['vars']['company_email']; ?>
"><?php echo $this->_config[0]['vars']['company_email']; ?>
</a></p>    
    </div>
    <?php else: ?>
    <form name="frmLogin" action="" method="post" onsubmit="return checkLogin(this)">
        <label class="formLabel" style="width:125px;" for="Email">Nhập mật khẩu mới<span class="formRequest">*</span></label>
        <input class="formInput" id="Email" name="chpass" title="" type="password" value="<?php echo $_REQUEST['pass']; ?>
"><br>
        <label class="formLabel" style="width:125px;" for="Email">Mật khẩu xác nhận<span class="formRequest">*</span></label>
        <input class="formInput" id="Email" name="passconf" title="" type="password" value=""><br>
        <p>
        <label class="formLabel"></label>
        <input class="formBtn" value="Đổi mật khẩu" type="submit"></p>

    </p>
    </form>
    <?php endif; ?>
</div>

<?php echo '
<script>
function checkLogin(frm){
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\\.[A-Z]{2,4}$/i;
	if(frm.pass.value==\'\'){
		alert(\'Xin vui lòng nhập mật khẩu.\');
		frm.pass.focus();
		return false;
	}
	if(frm.passconf.value==\'\'){
		alert(\'Xin vui lòng nhập mật khẩu xác nhận.\');
		frm.passconf.focus();
		return false;
	}
	if(frm.passconf.value!=frm.pass.value){
		alert(\'Mật khẩu xác nhận không chính xác.\');
		frm.passconf.focus();
		return false;
	}
     
	 
	
}
</script>
'; ?>

            