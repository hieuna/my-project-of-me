<?php /* Smarty version 2.6.26, created on 2011-12-05 23:50:22
         compiled from login.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link type='text/css' href='templates/css/users.css' media="screen" rel='stylesheet'></script>
<?php if ($this->_tpl_vars['task'] == 'lostPassword'): ?>
<div id="login-page" class="clearfix">
	<div class="fl wid5">
		<div id="payment-info" class="box2 mb2 radius">
			<h3 class="tit4">Quên mật khẩu</h3>
			<div class="payment-box">
				<table cellspacing='0' cellpadding='0' style='width: 100%; height: 100%;'>
				<tr>
				<td align="center">
					<div class='box'>
						<form action="login.php?task=lostPassword" method="post" name="frmForgotpass">
							<?php if ($this->_tpl_vars['is_error_email']): ?>
					       <center><span style="color:#FF0000"><?php echo $this->_tpl_vars['is_error_email']; ?>
</span></center><br />
					        <?php endif; ?>
							Nhập địa chỉ Email của bạn và chúng tôi sẽ gửi cho bạn mật khẩu mới tạm thời.
							<p><label>Địa chỉ Email : </label><input type="text" class="box" id="forgotpass_email" name="forgotpass_email" value="<?php echo $this->_tpl_vars['forgotpass_email']; ?>
" />&nbsp;&nbsp;&nbsp;						 			
							<input type="submit" value="Gửi mật khẩu" name="forgot" class="button" /></p>
							<input type='hidden' name='task' value='lostPassword' />
						</form>
					</div>
				</td>
				</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="fr wid4" align="right">
		<img src="./images/login_shoppingonline.jpg" />
	</div>
</div>
<?php echo '
<script language="JavaScript">
$(\'#forgotpass_email\').focus();
</script>
'; ?>

<?php else: ?>
<div id="login-page" class="clearfix">
	<div class="fl wid5">
		<form action='login.php' method='POST' name='login'>
		<div id="payment-info" class="box2 mb2 radius">
			<h3 class="tit4">Thông tin đăng nhập</h3>
			<div class="payment-box">
				<?php if ($this->_tpl_vars['is_error']): ?>
					<ul class="list1"><li><span style="color:#FF0000"><?php echo $this->_tpl_vars['is_error']; ?>
</span></li></ul>
				<?php endif; ?>
				<table cellpadding='0' cellspacing='0' width="100%">
					<tr>
						<td width="160" align="right">Email hoặc Tên đăng nhập:</td>
						<td><input type='text' class="box" name='email' id='email' maxlength='50' value="<?php echo $this->_tpl_vars['email']; ?>
"/> &nbsp;</td>
			        </tr>
			        <tr>
						<td align="right">Mật khẩu:</td>
						<td><input type='password' class="box" name='password' id='password' value="<?php echo $this->_tpl_vars['password']; ?>
" maxlength='50' /> &nbsp;</td>
			        </tr>
			        <?php if (! empty ( $this->_tpl_vars['setting']['setting_login_code'] ) || ( ! empty ( $this->_tpl_vars['setting']['setting_login_code_failedcount'] ) && $this->_tpl_vars['failed_login_count'] >= $this->_tpl_vars['setting']['setting_login_code_failedcount'] )): ?>
			        <tr>
						<td valign="top" align="right">Mã xác nhận:</td>
						<td>
							<div id="captcha_img" style="background: url('images/secure.php') no-repeat right center; padding-right: 80px; width:60px; float: left;">
								<input type='text' name='login_secure' class='text' size='6' maxlength='6' />
							</div>
							<div class="fl ml1 mt1"><a title="Đổi mã xác nhận khác" href="javascript:void(0);" onClick="$('#captcha_img').css('background-image', 'url(images/secure.php?' + (new Date()).getTime() + ')')"><img src="./images/icons/refresh.jpg" /></a></div>
							<div class="clearfix"></div>
							<span class="help">Nhập chính xác 6 ký tự bạn nhìn thấy trong hình trên</span>
						</td>
			        </tr>
			        <?php endif; ?>
			        			        <tr>
						<td colspan="2">
							<div style="margin-left:175px;">
							<input type='submit' class='button' value='Đăng nhập'/>
							&nbsp;<a href="login.php?task=lostPassword" style=""><i>Quên mật khẩu?</i></a>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="right">
							<p>Nếu bạn chưa có tài khoản, hãy <a href="signup.php">đăng ký tại đây</a></p>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<input type='hidden' name='task' value='dologin' />
		<input type='hidden' name='return_url' value='<?php echo $this->_tpl_vars['return_url']; ?>
' />
		<NOSCRIPT><input type='hidden' name='javascript' value='no' /></NOSCRIPT>
		</form>
	</div>
	<div class="fr wid4" align="right">
		<img src="./images/login_shoppingonline.jpg" />
	</div>
</div>
<?php echo '
<script language="JavaScript">
if($(\'#email\').val() == "") {
  $(\'#email\').focus();
} else {
  $(\'#password\').focus();
}
</script>
'; ?>

<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>