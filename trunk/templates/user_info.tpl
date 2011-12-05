{include file='header.tpl'}
<link type='text/css' href='templates/css/users.css' media="screen" rel='stylesheet' />
<link type='text/css' href='templates/css/general_user.css' media="screen" rel='stylesheet' />
<link type='text/css' href='templates/admin/css/icon.css' media="screen" rel='stylesheet' />

<div id="{$global_page}" class="clearfix">
	
	<div class="fr" style="width: 100%;">
		<div style="margin-bottom: 10px;"><div id="toolbar-box">
			<div class="t"><div class="t"><div class="t"></div></div></div>
			<div class="m">
				
				{*<div id="lb" class="header icon-48-addedit">{$page_title}</div>*}
				<div class="clr"></div>
			</div>
			<div class="b"><div class="b"><div class="b"></div></div></div>
		</div>
		</div>
		
		<div id="element-box">
			<div class="t"><div class="t"><div class="t"></div></div></div>
			<div class="m">
				{if $strError}
				<div style="border:1px solid #CCC; margin-bottom:5px; padding:5px" id="blockErr">
					<span style="color:#FF0000">{$strError}</span>
				</div>
				{/if}
				{if $task=='view'}
				<form action='user_info.php' method='POST' name='userEditInfo'>
					<table class="admintable" width="100%">
						<tr>
							<td class="key">Chủ tài khoản:</td>
							<td style="padding:5px"><input type='text' class="input-text wid1" name="fullname" id='fullname' value="{$user->user_info.user_fullname}"/> &nbsp;</td>
				        </tr>
				        <tr>
							<td class="key">Địa chỉ Email:</td>
							<td style="padding:5px">{$user->user_info.user_email}</td>
				        </tr>
				        <tr>
							<td class="key">Tài khoản:</td>
							<td style="padding:5px">
								<div class="user_gold"><b class="user_gold_value">{$user->user_info.user_gold|number_format}₫ </b> &nbsp;&nbsp;[<a href="javascript:void(0);" onclick="shp.chargeGold.step_1();">Nạp tiền</a>]</div>
							</td>
				        </tr>
				        <tr>
							<td class="key">Số điện thoại:</td>
							<td style="padding:5px"><input type='text' class="input-text wid1" name="mobile" id='mobile' value="{$user->user_info.user_mobile}" onkeypress="return numberOnly(this, event);" /> &nbsp;</td>
				        </tr>
				        <tr>
							<td class="key">Địa chỉ nhận hàng:</td>
							<td style="padding:5px"><input type='text' class="input-text wid1" name="address" id='address' value="{$user->user_info.user_address}"/> &nbsp;</td>
				        </tr>
				        <tr>
							<td class="key">Đăng ký từ:</td>
							<td style="padding:5px">{$user->user_info.user_signupdate_format}</td>
				        </tr>
					</table>
					<input type='hidden' name='update' value='editUserInfo' />
					<input type='hidden' name='userId' value='{$user->user_info.user_id}' />
				</form>
				{elseif $task=='changePass'}
					<form action='{$page}' method='POST' name='userEditInfo'>
					<table class="admintable">
						<tbody><tr>
							<td class="key"><label for="user_password_old">Nhập mật khẩu cũ</label></td>
							<td><input type="password" class="input-text wid1" value="{$smarty.post.user_password_old}" id="user_password_old" name="user_password_old"></td>
						</tr>
						<tr>
							<td class="key"><label for="user_password_new">Nhập mật khẩu mới</label></td>
							<td><input type="password" class="input-text wid1" value="{$smarty.post.user_password_new}" id="user_password_new" name="user_password_new"></td>
						</tr>
						<tr>
							<td class="key"><label for="user_password_conf">Nhập lại mật khẩu mới</label></td>
							<td><input type="password" class="input-text wid1" value="{$smarty.post.user_password_conf}" id="user_password_conf" name="user_password_conf"></td>
						</tr>
						</tbody>
					</table>
					<input type='hidden' name='task' value='{$task}' />
					<input type='hidden' name='userId' value='{$userId}' />
					</form>
				{/if}
			</div>
			<div class="b"><div class="b"><div class="b"></div></div></div>
		</div>
		
	</div>
</div>
{if $focus==1}
	<script type="text/javascript">
	{literal}
	$(document).ready(function (){
		$('#fullname').focus();
	});
	{/literal}
	</script>	
{elseif $focus==2}
	<script type="text/javascript">
	{literal}
	$(document).ready(function (){
		$('#mobile').focus();
	});
	{/literal}
	</script>
{elseif $focus==3}
	<script type="text/javascript">
	{literal}
	$(document).ready(function (){
		$('#address').focus();
	});
	{/literal}
	</script>
{else}
	<script type="text/javascript">
	{literal}
	$(document).ready(function (){
		$('#fullname').focus();
	});
	{/literal}
	</script>
{/if}

<script type="text/javascript">
{literal}
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
{/literal}
</script>

{include file='footer.tpl'}