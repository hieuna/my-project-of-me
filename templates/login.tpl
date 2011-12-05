{include file='header.tpl'}
<link type='text/css' href='templates/css/users.css' media="screen" rel='stylesheet'></script>
{if $task=='lostPassword'}
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
							{if $is_error_email}
					       <center><span style="color:#FF0000">{$is_error_email}</span></center><br />
					        {/if}
							Nhập địa chỉ Email của bạn và chúng tôi sẽ gửi cho bạn mật khẩu mới tạm thời.
							<p><label>Địa chỉ Email : </label><input type="text" class="box" id="forgotpass_email" name="forgotpass_email" value="{$forgotpass_email}" />&nbsp;&nbsp;&nbsp;						 			
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
{literal}
<script language="JavaScript">
$('#forgotpass_email').focus();
</script>
{/literal}
{else}
<div id="login-page" class="clearfix">
	<div class="fl wid5">
		<form action='login.php' method='POST' name='login'>
		<div id="payment-info" class="box2 mb2 radius">
			<h3 class="tit4">Thông tin đăng nhập</h3>
			<div class="payment-box">
				{if $is_error}
					<ul class="list1"><li><span style="color:#FF0000">{$is_error}</span></li></ul>
				{/if}
				<table cellpadding='0' cellspacing='0' width="100%">
					<tr>
						<td width="160" align="right">Email hoặc Tên đăng nhập:</td>
						<td><input type='text' class="box" name='email' id='email' maxlength='50' value="{$email}"/> &nbsp;</td>
			        </tr>
			        <tr>
						<td align="right">Mật khẩu:</td>
						<td><input type='password' class="box" name='password' id='password' value="{$password}" maxlength='50' /> &nbsp;</td>
			        </tr>
			        {if !empty($setting.setting_login_code) || (!empty($setting.setting_login_code_failedcount) && $failed_login_count>=$setting.setting_login_code_failedcount)}
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
			        {/if}
			        {*
			        <tr>
						<td align="right"><label for="persistent">Nhớ mật khẩu</label></td>
						<td><input type='checkbox' name='persistent' id='persistent' value="1"/></td>
			        </tr>
			        *}
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
		<input type='hidden' name='return_url' value='{$return_url}' />
		<NOSCRIPT><input type='hidden' name='javascript' value='no' /></NOSCRIPT>
		</form>
	</div>
	<div class="fr wid4" align="right">
		<img src="./images/login_shoppingonline.jpg" />
	</div>
</div>
{literal}
<script language="JavaScript">
if($('#email').val() == "") {
  $('#email').focus();
} else {
  $('#password').focus();
}
</script>
{/literal}
{/if}
{include file='footer.tpl'}