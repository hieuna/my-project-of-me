{include file='admin_header.tpl'}

	{if $errorTxt}
		<fieldset class="adminform">
			<legend>
			{if $errFlag} Xảy ra lỗi sau {else} Thông báo{/if}</legend>
			<table class="admintable" width="100%">
				<tr>
					<td><font color="Red">{$errorTxt}</font></td>
				</tr>
			</table>
		</fieldset>
	{/if}
	<form name="adminForm" method="post" action="{$page}.php">
		<div class="col width-50">
			<fieldset class="adminform">
				<legend>Sửa thông tin cá nhân</legend>
				<table class="admintable">
					<tr>
						<td class="key"><label for="name">Họ tên</label></td>
						<td><input type="text" name="admin_name" id="admin_name" value="{$users.admin_name|escape:'html'}" class="wid1"></td>
					</tr>
					<tr>
						<td class="key"><label for="name">Email</label></td>
						<td><input type="text" name="admin_email" id="admin_email" value="{$users.admin_email|escape:'html'}" class="wid1"></td>
					</tr>
					<tr>
						<td class="key"><label for="name">Tên đăng nhập</label></td>
						<td>{$users.admin_username|escape:'html'}</td>
					</tr>
					<tr>
						<td class="key"><label for="name">Nhóm</label></td>
						<td>{$users.admin_group|escape:'html'}</td>
					</tr>
					{if $users.admin_group > 1}
					<tr>
						<td class="key"><label for="name">Quyền hạn</label></td>
						<td>{$users.admin_access}</td>
					</tr>
					{/if}
					<tr>
						<td class="key"><label for="name">Ngày đăng ký</label></td>
						<td>{$users.admin_registerDate}</td>
					</tr>
					<tr>
						<td class="key"><label for="name">Lần truy cập cuối</label></td>
						<td>{$users.admin_lastvisitDate}</td>
					</tr>
					<input type="hidden" name="admin_group" value="{$users.admin_group}">
					<input type="hidden" name="admin_username" value="{$users.admin_username}">
					<input type="hidden" name="admin_registerDate" value="{$users.admin_registerDate}">
					<input type="hidden" name="admin_lastvisitDate" value="{$users.admin_lastvisitDate}">
				</table>
			</fieldset>
		</div>
		<div class="col width-50">
			<fieldset class="adminform">
				<legend>Thay đổi mật khẩu</legend>
				<table class="admintable">
					<tr>
						<td class="key"><label for="name">Nhập mật khẩu cũ</label></td>
						<td><input type="password" name="admin_password_old" id="admin_password_old" value="{$users.admin_password_old}" class="wid1"></td>
					</tr>
					<tr>
						<td class="key"><label for="name">Nhập mật khẩu mới</label></td>
						<td><input type="password" name="admin_password_new" id="admin_password_new" value="{$users.admin_password_new}" class="wid1"></td>
					</tr>
					<tr>
						<td class="key"><label for="name">Nhập lại mật khẩu mới</label></td>
						<td><input type="password" name="admin_password_conf" id="admin_password_conf" value="{$users.admin_password_conf}" class="wid1"></td>
					</tr>
				</table>
			</fieldset>
		</div>
		<div class="clr"></div>
		<input type="hidden" value="{$task}" name="task">
		<input type="hidden" value="{$adminId}" name="adminId" id="adminId">
	</form>

{include file='admin_footer.tpl'}