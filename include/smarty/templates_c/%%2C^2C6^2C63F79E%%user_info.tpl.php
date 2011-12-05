<?php /* Smarty version 2.6.26, created on 2011-12-05 23:52:03
         compiled from user_info.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'user_info.tpl', 42, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link type='text/css' href='templates/css/users.css' media="screen" rel='stylesheet' />
<link type='text/css' href='templates/css/general_user.css' media="screen" rel='stylesheet' />
<link type='text/css' href='templates/admin/css/icon.css' media="screen" rel='stylesheet' />

<div id="<?php echo $this->_tpl_vars['global_page']; ?>
" class="clearfix">
	
	<div class="fr" style="width: 100%;">
		<div style="margin-bottom: 10px;"><div id="toolbar-box">
			<div class="t"><div class="t"><div class="t"></div></div></div>
			<div class="m">
				
								<div class="clr"></div>
			</div>
			<div class="b"><div class="b"><div class="b"></div></div></div>
		</div>
		</div>
		
		<div id="element-box">
			<div class="t"><div class="t"><div class="t"></div></div></div>
			<div class="m">
				<?php if ($this->_tpl_vars['strError']): ?>
				<div style="border:1px solid #CCC; margin-bottom:5px; padding:5px" id="blockErr">
					<span style="color:#FF0000"><?php echo $this->_tpl_vars['strError']; ?>
</span>
				</div>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['task'] == 'view'): ?>
				<form action='user_info.php' method='POST' name='userEditInfo'>
					<table class="admintable" width="100%">
						<tr>
							<td class="key">Chủ tài khoản:</td>
							<td style="padding:5px"><input type='text' class="input-text wid1" name="fullname" id='fullname' value="<?php echo $this->_tpl_vars['user']->user_info['user_fullname']; ?>
"/> &nbsp;</td>
				        </tr>
				        <tr>
							<td class="key">Địa chỉ Email:</td>
							<td style="padding:5px"><?php echo $this->_tpl_vars['user']->user_info['user_email']; ?>
</td>
				        </tr>
				        <tr>
							<td class="key">Tài khoản:</td>
							<td style="padding:5px">
								<div class="user_gold"><b class="user_gold_value"><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->user_info['user_gold'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
₫ </b> &nbsp;&nbsp;[<a href="javascript:void(0);" onclick="shp.chargeGold.step_1();">Nạp tiền</a>]</div>
							</td>
				        </tr>
				        <tr>
							<td class="key">Số điện thoại:</td>
							<td style="padding:5px"><input type='text' class="input-text wid1" name="mobile" id='mobile' value="<?php echo $this->_tpl_vars['user']->user_info['user_mobile']; ?>
" onkeypress="return numberOnly(this, event);" /> &nbsp;</td>
				        </tr>
				        <tr>
							<td class="key">Địa chỉ nhận hàng:</td>
							<td style="padding:5px"><input type='text' class="input-text wid1" name="address" id='address' value="<?php echo $this->_tpl_vars['user']->user_info['user_address']; ?>
"/> &nbsp;</td>
				        </tr>
				        <tr>
							<td class="key">Đăng ký từ:</td>
							<td style="padding:5px"><?php echo $this->_tpl_vars['user']->user_info['user_signupdate_format']; ?>
</td>
				        </tr>
					</table>
					<input type='hidden' name='update' value='editUserInfo' />
					<input type='hidden' name='userId' value='<?php echo $this->_tpl_vars['user']->user_info['user_id']; ?>
' />
				</form>
				<?php elseif ($this->_tpl_vars['task'] == 'changePass'): ?>
					<form action='<?php echo $this->_tpl_vars['page']; ?>
' method='POST' name='userEditInfo'>
					<table class="admintable">
						<tbody><tr>
							<td class="key"><label for="user_password_old">Nhập mật khẩu cũ</label></td>
							<td><input type="password" class="input-text wid1" value="<?php echo $_POST['user_password_old']; ?>
" id="user_password_old" name="user_password_old"></td>
						</tr>
						<tr>
							<td class="key"><label for="user_password_new">Nhập mật khẩu mới</label></td>
							<td><input type="password" class="input-text wid1" value="<?php echo $_POST['user_password_new']; ?>
" id="user_password_new" name="user_password_new"></td>
						</tr>
						<tr>
							<td class="key"><label for="user_password_conf">Nhập lại mật khẩu mới</label></td>
							<td><input type="password" class="input-text wid1" value="<?php echo $_POST['user_password_conf']; ?>
" id="user_password_conf" name="user_password_conf"></td>
						</tr>
						</tbody>
					</table>
					<input type='hidden' name='task' value='<?php echo $this->_tpl_vars['task']; ?>
' />
					<input type='hidden' name='userId' value='<?php echo $this->_tpl_vars['userId']; ?>
' />
					</form>
				<?php endif; ?>
			</div>
			<div class="b"><div class="b"><div class="b"></div></div></div>
		</div>
		
	</div>
</div>
<?php if ($this->_tpl_vars['focus'] == 1): ?>
	<script type="text/javascript">
	<?php echo '
	$(document).ready(function (){
		$(\'#fullname\').focus();
	});
	'; ?>

	</script>	
<?php elseif ($this->_tpl_vars['focus'] == 2): ?>
	<script type="text/javascript">
	<?php echo '
	$(document).ready(function (){
		$(\'#mobile\').focus();
	});
	'; ?>

	</script>
<?php elseif ($this->_tpl_vars['focus'] == 3): ?>
	<script type="text/javascript">
	<?php echo '
	$(document).ready(function (){
		$(\'#address\').focus();
	});
	'; ?>

	</script>
<?php else: ?>
	<script type="text/javascript">
	<?php echo '
	$(document).ready(function (){
		$(\'#fullname\').focus();
	});
	'; ?>

	</script>
<?php endif; ?>

<script type="text/javascript">
<?php echo '
function numberOnly(myfield, e){
	var key,keychar;
	if (window.event){key = window.event.keyCode}
	else if (e){key = e.which}
	else{return true}
	keychar = String.fromCharCode(key);
	if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27)){return true}
	else if (("0123456789").indexOf(keychar) > -1){return true}
	return false;
}
'; ?>

</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>