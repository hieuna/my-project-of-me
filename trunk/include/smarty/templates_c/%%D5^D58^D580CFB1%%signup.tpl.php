<?php /* Smarty version 2.6.26, created on 2011-12-05 23:50:33
         compiled from signup.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link type='text/css' href='templates/css/users.css' media="screen" rel='stylesheet' />
<div id="signup-page" class="clearfix">
	<div>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'signup-guide-step.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php if ($this->_tpl_vars['is_error']): ?>
			<div align="center"><span style="color:#FF0000"><?php echo $this->_tpl_vars['is_error']; ?>
</span></div>
		<?php endif; ?>
		<form action='signup.php' method='POST'>
		<div id="payment-info">
			<h3 class="tit3">Nhóm đăng ký thành viên</h3>
			<div class="payment-box">
				<table cellpadding='0' cellspacing='0' width="100%">
					<tr>
						<td width="180" valign="top" align="right">Lựa chọn nhóm thành viên:</td>
						<td>
							<select name="user_type_change" id="user_type_change" class="input-select">
								<option value="signup.php"<?php if (! $this->_tpl_vars['task']): ?> selected="selected"<?php endif; ?>>Nhóm thành viên</option>
								<option value="signup.php?task=merchant"<?php if ($this->_tpl_vars['task'] == 'merchant'): ?> selected="selected"<?php endif; ?>>Nhóm nhà cung cấp</option>
							</select>
							<span class="help">Nếu bạn là nhà cung cấp sản phẩm thì chọn <b>Nhóm nhà cung cấp</b>.</span>
						</td>
			        </tr>
				</table>
			</div>
			<h3 class="tit3">Thông tin đăng nhập</h3>
			<div class="payment-box">
				<table cellpadding='0' cellspacing='0' width="100%">
					<tr>
						<td width="180" valign="top" align="right"><font color='red'>*</font> Địa chỉ Email:</td>
						<td>
							<input type='text' class="input-text" name='user_email' id='user_email' maxlength='50' value="<?php echo $this->_tpl_vars['input']['user_email']; ?>
"/>
							<span class="help">Địa chỉ Email này sẽ dùng để đăng nhập và nhận các thông tin tài khoản.</span>
						</td>
			        </tr>
			        <tr>
						<td valign="top" align="right"><font color='red'>*</font> Mật khẩu:</td>
						<td>
							<input type='password' class="input-text" name='user_password' id='user_password' value="<?php echo $this->_tpl_vars['input']['user_password']; ?>
" maxlength='250' /> 
							<span class="help">ít nhất 6 ký tự.</span>
						</td>
			        </tr>
			        <tr>
						<td valign="top" align="right"><font color='red'>*</font> Nhập lại mật khẩu:</td>
						<td>
							<input type='password' class="input-text" name='repassword' id='repassword' value="<?php echo $this->_tpl_vars['input']['repassword']; ?>
" maxlength='50' />
						</td>
			        </tr>
				</table>
			</div>
		</div>
		<?php if ($this->_tpl_vars['task'] == 'merchant'): ?>
		<div id="payment-info">
			<h3 class="tit3">Thông tin doanh nghiệp</h3>
			<div class="payment-box">
				<table cellpadding='0' cellspacing='0' width="100%">
					<tr>
						<td width="180" valign="top" align="right"><font color='red'>*</font> Tên tổ chức, doanh nghiệp:</td>
						<td>
							<input type='text' class="input-text" name='site_name' id='site_name' value="<?php echo $this->_tpl_vars['input']['site_name']; ?>
" maxlength='100' />
							<span class="help">Tên đầy đủ của tổ chức, doanh nghiệp bạn đăng ký.</span>
						</td>
			        </tr>
			        <tr>
						<td valign="top" align="right"><font color='red'>*</font> Địa chỉ:</td>
						<td>
							<input type='text' class="input-text" name='user_address' id='user_address' value="<?php echo $this->_tpl_vars['input']['user_address']; ?>
" maxlength='250' />
							<span class="help">Nhập chính xác địa chỉ hiện tại của bạn.</span>
						</td>
			        </tr>
                    <tr>
						<td valign="top" align="right"><font color='red'>*</font> Tỉnh/Thành phố:</td>
						<td>
							<div id="signupCity"></div>
							<span class="help">Chọn chính xác tỉnh/thành phố hiện tại của bạn.</span>
						</td>
			        </tr>
                    <tr>
						<td valign="top" align="right"><font color='red'>*</font> Quận/Huyện/Thị xã:</td>
						<td>
							<select class="input-select" name="user_district" id="user_district"></select>
							<span class="help">Chọn chính xác quận/huyện/thị xã hiện tại của bạn.</span>
						</td>
			        </tr>
			        <tr>
						<td width="180" valign="top" align="right"> Địa chỉ website:</td>
						<td>
							<input type='text' class="input-text" name='site_domain' id='site_domain' value="<?php echo $this->_tpl_vars['input']['site_domain']; ?>
" maxlength='100' />
							<span class="help">Ghi rõ địa chỉ website của doanh nghiệp bạn đăng ký.</span>
						</td>
			        </tr>
			     </table>
			</div>
			<h3 class="tit3">Thông tin người đại diện</h3>
			<div class="payment-box">   
			     <table cellpadding='0' cellspacing='0' width="100%">  
					<tr>
						<td width="180" valign="top" align="right"><font color='red'>*</font> Họ tên:</td>
						<td>
							<input type='text' class="input-text" name='user_fullname' id='user_fullname' value="<?php echo $this->_tpl_vars['input']['user_fullname']; ?>
" maxlength='100' />
							<span class="help">Họ tên đầy đủ giống như trên CMT hoặc Hộ chiếu.</span>
						</td>
			        </tr>
			        <tr>
						<td valign="top" align="right"><font color='red'>*</font> Số điện thoại di động:</td>
						<td>
							<input type='text' class="input-text" name='user_mobile' id='user_mobile' value="<?php echo $this->_tpl_vars['input']['user_mobile']; ?>
" maxlength='20' onkeypress="return numberOnly(this, event);"/>
							<span class="help">Khi thực hiện giao dịch, MuachungPay sẽ gửi mã xác thực vào số điện thoại này.</span>
						</td>
			        </tr>
			        <?php if (! empty ( $this->_tpl_vars['setting']['setting_signup_code'] )): ?>
			        <tr>
						<td valign="top" align="right"><font color='red'>*</font> Mã xác nhận:</td>
						<td>
							<div id="captcha_img" style="background: url('images/secure.php') no-repeat right center; padding-right: 80px; width:60px; float: left;">
								<input type='text' class="input-text" name='captcha' class='text' style="width:50px;" size='6' maxlength='6' />
							</div>
							<div class="fl ml1 mt1"><a title="Đổi mã xác nhận khác" href="javascript:void(0);" onClick="$('#captcha_img').css('background-image', 'url(images/secure.php?' + (new Date()).getTime() + ')')"><img src="./images/icons/refresh.jpg" /></a></div>
							<div class="clearfix"></div>
							<span class="help">Nhập chính xác 6 chứ số bạn nhìn thấy trong hình trên</span>
						</td>
			        </tr>
			        <?php endif; ?>
					<tr>
						<td colspan="2" align="center">
							<label for="confirm">Với việc bấm vào nút bên dưới, tôi đồng ý với <a href="./info/help/quy-dinh-chinh-sach/dieu-khoan-su-dung.html" target="_blank">các điều khoản và điều kiện</a> được nêu.</a></label>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<span style="border:none; padding: 0;" class='payment'><input type='submit' class="ui-button-text" style="width: 150px;cursor: pointer;padding: 2px;" id="btnRegister" value='Đồng ý và đăng ký'/></span>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<?php else: ?>
		<div id="payment-info">
			<h3 class="tit3">Thông tin cá nhân</h3>
			<div class="payment-box">
				<table cellpadding='0' cellspacing='0' width="100%">
					<tr>
						<td width="180" valign="top" align="right"><font color='red'>*</font> Họ tên:</td>
						<td>
							<input type='text' class="input-text" name='user_fullname' id='user_fullname' value="<?php echo $this->_tpl_vars['input']['user_fullname']; ?>
" maxlength='100' />
							<span class="help">Họ tên đầy đủ giống như trên CMT hoặc Hộ chiếu.</span>
						</td>
			        </tr>
			        <tr>
						<td valign="top" align="right"><font color='red'>*</font> Số điện thoại di động:</td>
						<td>
							<input type='text' class="input-text" name='user_mobile' id='user_mobile' value="<?php echo $this->_tpl_vars['input']['user_mobile']; ?>
" maxlength='20' onkeypress="return numberOnly(this, event);"/>
							<span class="help">Khi thực hiện giao dịch, SohaPay sẽ gửi mã xác thực vào số điện thoại này.</span>
						</td>
			        </tr>
			        <tr>
						<td valign="top" align="right"><font color='red'>*</font> Địa chỉ:</td>
						<td>
							<input type='text' class="input-text" name='user_address' id='user_address' value="<?php echo $this->_tpl_vars['input']['user_address']; ?>
" maxlength='250' />
							<span class="help">Nhập chính xác địa chỉ hiện tại của bạn.</span>
						</td>
			        </tr>
                    <tr>
						<td valign="top" align="right"><font color='red'>*</font> Tỉnh/Thành phố:</td>
						<td>
							<div id="signupCity"></div>
							<span class="help">Chọn chính xác tỉnh/thành phố hiện tại của bạn.</span>
						</td>
			        </tr>
                    <tr>
						<td valign="top" align="right"><font color='red'>*</font> Quận/Huyện/Thị xã:</td>
						<td>
							<select class="input-select" name="user_district" id="user_district"></select>
							<span class="help">Chọn chính xác quận/huyện/thị xã hiện tại của bạn.</span>
						</td>
			        </tr>
			        <?php if (! empty ( $this->_tpl_vars['setting']['setting_signup_code'] )): ?>
			        <tr>
						<td valign="top" align="right"><font color='red'>*</font> Mã xác nhận:</td>
						<td>
							<div id="captcha_img" style="background: url('images/secure.php') no-repeat right center; padding-right: 80px; width:60px; float: left;">
								<input type='text' class="input-text" name='captcha' class='text' style="width:50px;" size='6' maxlength='6' />
							</div>
							<div class="fl ml1 mt1"><a title="Đổi mã xác nhận khác" href="javascript:void(0);" onClick="$('#captcha_img').css('background-image', 'url(images/secure.php?' + (new Date()).getTime() + ')')"><img src="./images/icons/refresh.jpg" /></a></div>
							<div class="clearfix"></div>
							<span class="help">Nhập chính xác 6 chứ số bạn nhìn thấy trong hình trên</span>
						</td>
			        </tr>
			        <?php endif; ?>
					<tr>
						<td colspan="2" align="center">
							<label for="confirm">Với việc bấm vào nút bên dưới, tôi đồng ý với <a href="./info/help/quy-dinh-chinh-sach/dieu-khoan-su-dung.html" target="_blank">các điều khoản và điều kiện</a> được nêu.</a></label>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<span style="border:none; padding: 0;" class='payment'><input type='submit' class="ui-button-text" style="width: 150px;cursor: pointer;padding: 2px;" id="btnRegister" value='Đồng ý và đăng ký'/></span>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['task'] == 'merchant'): ?>
		<input type='hidden' name='user_type' value='2' />
		<?php else: ?>
		<input type='hidden' name='user_type' value='1' />
		<?php endif; ?>
		<input type='hidden' name='task' value='doregister' />
		</form>
	</div>
</div>
<?php if ($this->_tpl_vars['focus'] == 4): ?>
	<script type="text/javascript">
	<?php echo '
	$(document).ready(function (){
		$(\'#user_fullname\').focus();
	});
	'; ?>

	</script>	
<?php elseif ($this->_tpl_vars['focus'] == 5): ?>
	<script type="text/javascript">
	<?php echo '
	$(document).ready(function (){
		$(\'#user_mobile\').focus();
	});
	'; ?>

	</script>
<?php elseif ($this->_tpl_vars['focus'] == 6): ?>
	<script type="text/javascript">
	<?php echo '
	$(document).ready(function (){
		$(\'#user_address\').focus();
	});
	'; ?>

	</script>
<?php elseif ($this->_tpl_vars['focus'] == 7): ?>
	<script type="text/javascript">
	<?php echo '
	$(document).ready(function (){
		$(\'#user_district\').focus();
	});
	'; ?>

	</script>
<?php elseif ($this->_tpl_vars['focus'] == 8): ?>
	<script type="text/javascript">
	<?php echo '
	$(document).ready(function (){
		$(\'#user_city\').focus();
	});
	'; ?>

	</script>
<?php elseif ($this->_tpl_vars['focus'] == 2): ?>
	<script type="text/javascript">
	<?php echo '
	$(document).ready(function (){
		$(\'#user_password\').focus();
	});
	'; ?>

	</script>
<?php elseif ($this->_tpl_vars['focus'] == 3): ?>
	<script type="text/javascript">
	<?php echo '
	$(document).ready(function (){
		$(\'#repassword\').focus();
	});
	'; ?>

	</script>	
<?php else: ?>
	<script type="text/javascript">
	<?php echo '
	$(document).ready(function (){
		$(\'#user_email\').focus();
	});
	'; ?>

	</script>
<?php endif; ?>

<script type="text/javascript">
var aCity = <?php echo $this->_tpl_vars['jsonCity']; ?>
;
var aDistrict = <?php echo $this->_tpl_vars['jsonDistrict']; ?>
;
var crCity = parseInt('<?php echo $this->_tpl_vars['input']['user_city']; ?>
');
var crDistrict = parseInt('<?php echo $this->_tpl_vars['input']['user_district']; ?>
');

<?php echo '
$(document).ready(function (){
    var city = \'<select class="input-select" name="user_city" id="user_city" onchange="signupLoadDistrictDropdown(this.value, \\\'user_district\\\');">\';
    city += \'<option value="0"> Chọn tỉnh thành phố </option>\';
    for(var i in aCity){
        if (i==crCity) city += \'<option selected="selected" value="\'+aCity[i].id+\'">\'+aCity[i].title+\'</option>\';
        else city += \'<option value="\'+aCity[i].id+\'">\'+aCity[i].title+\'</option>\';
    }
    city += \'</select>\';
    $(\'#signupCity\').html(city);
    signupLoadDistrictDropdown(crCity, \'user_district\');
    
    //$(\'#user_email\').focus();
 	// bind change event to select
    $(\'#user_type_change\').bind(\'change\', function () {
        var url = $(this).val(); // get selected value
        if (url) { // require a URL
            window.location = url; // redirect
        }
        return false;
    });
});

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

function signupLoadDistrictDropdown(val, objId){
    $(\'#\'+objId).html(\'\');
    if (aDistrict[val]==null) return;
    var tDistrict = \'\';
    for (var i in aDistrict[val]){
        if (i==crDistrict) tDistrict += \'<option selected="selected" value="\'+i+\'">\'+aDistrict[val][i]+\'</option>\';
        else tDistrict += \'<option value="\'+i+\'">\'+aDistrict[val][i]+\'</option>\';
    }
    $(\'#\'+objId).html(tDistrict);
}

'; ?>

</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>