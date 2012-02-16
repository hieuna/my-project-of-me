<div id="toolbar-box">
   <div class="t">
   	<div class="t">
   		<div class="t"></div>
   	</div>
   </div>
   <div class="m">
	   <div id="toolbar" class="toolbar">
	   		{literal}
	   		<script language="javascript" type="text/javascript">
			function submitbutton(pressbutton) {
				if (pressbutton == 'remove') {
					if (document.adminForm.boxchecked.value == 0) {
						alert("Không có bản ghi nào được lựa chọn !");
					} else if ( confirm("Bạn có chắc rằng muốn xóa bản ghi này không?")) {
						submitform('remove');
					}
				} else {
					submitform(pressbutton);
				}
			}
			</script>
			{/literal}
	   		<table class="toolbar toolbar_small">
	   			<tbody>
	   				<tr>
	   					<td id="toolbar-save" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('save');">
	   							<span title="Lưu lại" class="icon-32-save"></span>
	   							Lưu lại
	   						</a>
	   					</td>
	   					<td id="toolbar-cancel" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('cancel');">
	   							<span title="Hủy bỏ" class="icon-32-cancel"></span>
	   							Hủy bỏ
	   						</a>
	   					</td>
	   					<td id="toolbar-help" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('help');">
	   							<span title="Trợ giúp" class="icon-32-help"></span>
	   							Trợ giúp
	   						</a>
	   					</td>
	   				</tr>
	   			</tbody>
	   		</table>
	   </div>
	   <div class="header account">{$page_title}</div>
	   <div class="clr"></div>
   </div>
   <div class="b">
   		<div class="b">
   			<div class="b"></div>
   		</div>
   </div>
   {if $errorTxt}<div class="message">{if $errFlag} Xảy ra lỗi sau {else} Thông báo{/if}: {$errorTxt}</div>{/if}
</div>
<form name="adminForm" method="post" action="{$page}.php">
	<div class="col width-50">
		<fieldset class="adminform">
			<legend>Sửa thông tin cá nhân</legend>
			<table class="adminTable">
				<tr>
					<td class="key"><label for="name">Họ tên</label></td>
					<td><input type="text" name="admin_name" id="admin_name" value="{$users.admin_name|escape:'html'}" class="adm_inputbox"></td>
				</tr>
				<tr>
					<td class="key"><label for="name">Email</label></td>
					<td><input type="text" name="admin_email" id="admin_email" value="{$users.admin_email|escape:'html'}" class="adm_inputbox"></td>
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
			<table class="adminTable">
				<tr>
					<td class="key_big"><label for="name">Nhập mật khẩu cũ</label></td>
					<td><input type="password" name="admin_password_old" id="admin_password_old" value="{$users.admin_password_old}" class="adm_inputbox"></td>
				</tr>
				<tr>
					<td class="key_big"><label for="name">Nhập mật khẩu mới</label></td>
					<td><input type="password" name="admin_password_new" id="admin_password_new" value="{$users.admin_password_new}" class="adm_inputbox"></td>
				</tr>
				<tr>
					<td class="key_big"><label for="name">Nhập lại mật khẩu mới</label></td>
					<td><input type="password" name="admin_password_conf" id="admin_password_conf" value="{$users.admin_password_conf}" class="adm_inputbox"></td>
				</tr>
			</table>
		</fieldset>
	</div>
	<div class="clr"></div>
	<input type="hidden" value="{$task}" name="task">
	<input type="hidden" value="{$adminId}" name="adminId" id="adminId">
</form>