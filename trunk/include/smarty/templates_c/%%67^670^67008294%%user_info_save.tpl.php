<?php /* Smarty version 2.6.26, created on 2011-12-05 23:52:03
         compiled from user_info_save.tpl */ ?>
<div id="toolbar" class="toolbar">
	<table class="toolbar"><tbody><tr>
		<td id="toolbar-save" class="button">
		<?php if ($this->_tpl_vars['task'] == 'view'): ?>
			<a class="toolbar" onclick="document.userEditInfo.submit();" href="javascript:void(0)">
				<span title="Lưu" class="icon-32-save"></span> Cập nhật
			</a>
		<?php elseif ($this->_tpl_vars['task'] == 'changePass'): ?>
			<a class="toolbar" onclick="document.userEditInfo.submit();" href="javascript:void(0)">
				<span title="Lưu" class="icon-32-save"></span> Cập nhật
			</a>
		<?php endif; ?>
		</td>
	</tr></tbody>
	</table>
</div>