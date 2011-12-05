{include file='header.tpl'}
<link type='text/css' href='templates/css/users.css' media="screen" rel='stylesheet' />
<div id="signup-page" class="clearfix">
	<div>
		{include file='signup-guide-step.tpl'}
		{if $is_error}
			<div align="center"><span style="color:#FF0000">{$is_error}</span></div>
		{/if}
		<form action='signup.php' method='POST'>
		<div id="payment-info">
			<h3 class="tit3">Nhóm đăng ký thành viên</h3>
			<div class="payment-box">
				<table cellpadding='0' cellspacing='0' width="100%">
					<tr>
						<td width="180" valign="top" align="right">Lựa chọn nhóm thành viên:</td>
						<td>
							<select name="user_type_change" id="user_type_change" class="input-select">
								<option value="signup.php"{if !$task} selected="selected"{/if}>Nhóm thành viên</option>
								<option value="signup.php?task=merchant"{if $task=='merchant'} selected="selected"{/if}>Nhóm nhà cung cấp</option>
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
							<input type='text' class="input-text" name='user_email' id='user_email' maxlength='50' value="{$input.user_email}"/>
							<span class="help">Địa chỉ Email này sẽ dùng để đăng nhập và nhận các thông tin tài khoản.</span>
						</td>
			        </tr>
			        <tr>
						<td valign="top" align="right"><font color='red'>*</font> Mật khẩu:</td>
						<td>
							<input type='password' class="input-text" name='user_password' id='user_password' value="{$input.user_password}" maxlength='250' /> 
							<span class="help">ít nhất 6 ký tự.</span>
						</td>
			        </tr>
			        <tr>
						<td valign="top" align="right"><font color='red'>*</font> Nhập lại mật khẩu:</td>
						<td>
							<input type='password' class="input-text" name='repassword' id='repassword' value="{$input.repassword}" maxlength='50' />
						</td>
			        </tr>
				</table>
			</div>
		</div>
		{if $task=='merchant'}
		<div id="payment-info">
			<h3 class="tit3">Thông tin doanh nghiệp</h3>
			<div class="payment-box">
				<table cellpadding='0' cellspacing='0' width="100%">
					<tr>
						<td width="180" valign="top" align="right"><font color='red'>*</font> Tên tổ chức, doanh nghiệp:</td>
						<td>
							<input type='text' class="input-text" name='site_name' id='site_name' value="{$input.site_name}" maxlength='100' />
							<span class="help">Tên đầy đủ của tổ chức, doanh nghiệp bạn đăng ký.</span>
						</td>
			        </tr>
			        <tr>
						<td valign="top" align="right"><font color='red'>*</font> Địa chỉ:</td>
						<td>
							<input type='text' class="input-text" name='user_address' id='user_address' value="{$input.user_address}" maxlength='250' />
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
							<input type='text' class="input-text" name='site_domain' id='site_domain' value="{$input.site_domain}" maxlength='100' />
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
							<input type='text' class="input-text" name='user_fullname' id='user_fullname' value="{$input.user_fullname}" maxlength='100' />
							<span class="help">Họ tên đầy đủ giống như trên CMT hoặc Hộ chiếu.</span>
						</td>
			        </tr>
			        <tr>
						<td valign="top" align="right"><font color='red'>*</font> Số điện thoại di động:</td>
						<td>
							<input type='text' class="input-text" name='user_mobile' id='user_mobile' value="{$input.user_mobile}" maxlength='20' onkeypress="return numberOnly(this, event);"/>
							<span class="help">Khi thực hiện giao dịch, MuachungPay sẽ gửi mã xác thực vào số điện thoại này.</span>
						</td>
			        </tr>
			        {if !empty($setting.setting_signup_code)}
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
			        {/if}
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
		{else}
		<div id="payment-info">
			<h3 class="tit3">Thông tin cá nhân</h3>
			<div class="payment-box">
				<table cellpadding='0' cellspacing='0' width="100%">
					<tr>
						<td width="180" valign="top" align="right"><font color='red'>*</font> Họ tên:</td>
						<td>
							<input type='text' class="input-text" name='user_fullname' id='user_fullname' value="{$input.user_fullname}" maxlength='100' />
							<span class="help">Họ tên đầy đủ giống như trên CMT hoặc Hộ chiếu.</span>
						</td>
			        </tr>
			        <tr>
						<td valign="top" align="right"><font color='red'>*</font> Số điện thoại di động:</td>
						<td>
							<input type='text' class="input-text" name='user_mobile' id='user_mobile' value="{$input.user_mobile}" maxlength='20' onkeypress="return numberOnly(this, event);"/>
							<span class="help">Khi thực hiện giao dịch, SohaPay sẽ gửi mã xác thực vào số điện thoại này.</span>
						</td>
			        </tr>
			        <tr>
						<td valign="top" align="right"><font color='red'>*</font> Địa chỉ:</td>
						<td>
							<input type='text' class="input-text" name='user_address' id='user_address' value="{$input.user_address}" maxlength='250' />
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
			        {if !empty($setting.setting_signup_code)}
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
			        {/if}
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
		{/if}
		{if $task=='merchant'}
		<input type='hidden' name='user_type' value='2' />
		{else}
		<input type='hidden' name='user_type' value='1' />
		{/if}
		<input type='hidden' name='task' value='doregister' />
		</form>
	</div>
</div>
{if $focus==4}
	<script type="text/javascript">
	{literal}
	$(document).ready(function (){
		$('#user_fullname').focus();
	});
	{/literal}
	</script>	
{elseif $focus==5}
	<script type="text/javascript">
	{literal}
	$(document).ready(function (){
		$('#user_mobile').focus();
	});
	{/literal}
	</script>
{elseif $focus==6}
	<script type="text/javascript">
	{literal}
	$(document).ready(function (){
		$('#user_address').focus();
	});
	{/literal}
	</script>
{elseif $focus==7}
	<script type="text/javascript">
	{literal}
	$(document).ready(function (){
		$('#user_district').focus();
	});
	{/literal}
	</script>
{elseif $focus==8}
	<script type="text/javascript">
	{literal}
	$(document).ready(function (){
		$('#user_city').focus();
	});
	{/literal}
	</script>
{elseif $focus==2}
	<script type="text/javascript">
	{literal}
	$(document).ready(function (){
		$('#user_password').focus();
	});
	{/literal}
	</script>
{elseif $focus==3}
	<script type="text/javascript">
	{literal}
	$(document).ready(function (){
		$('#repassword').focus();
	});
	{/literal}
	</script>	
{else}
	<script type="text/javascript">
	{literal}
	$(document).ready(function (){
		$('#user_email').focus();
	});
	{/literal}
	</script>
{/if}

<script type="text/javascript">
var aCity = {$jsonCity};
var aDistrict = {$jsonDistrict};
var crCity = parseInt('{$input.user_city}');
var crDistrict = parseInt('{$input.user_district}');

{literal}
$(document).ready(function (){
    var city = '<select class="input-select" name="user_city" id="user_city" onchange="signupLoadDistrictDropdown(this.value, \'user_district\');">';
    city += '<option value="0"> Chọn tỉnh thành phố </option>';
    for(var i in aCity){
        if (i==crCity) city += '<option selected="selected" value="'+aCity[i].id+'">'+aCity[i].title+'</option>';
        else city += '<option value="'+aCity[i].id+'">'+aCity[i].title+'</option>';
    }
    city += '</select>';
    $('#signupCity').html(city);
    signupLoadDistrictDropdown(crCity, 'user_district');
    
    //$('#user_email').focus();
 	// bind change event to select
    $('#user_type_change').bind('change', function () {
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
    $('#'+objId).html('');
    if (aDistrict[val]==null) return;
    var tDistrict = '';
    for (var i in aDistrict[val]){
        if (i==crDistrict) tDistrict += '<option selected="selected" value="'+i+'">'+aDistrict[val][i]+'</option>';
        else tDistrict += '<option value="'+i+'">'+aDistrict[val][i]+'</option>';
    }
    $('#'+objId).html(tDistrict);
}

{/literal}
</script>

{include file='footer.tpl'}