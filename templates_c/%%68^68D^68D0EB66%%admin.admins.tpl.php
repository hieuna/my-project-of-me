<?php /* Smarty version 2.6.10, created on 2012-02-22 23:30:07
         compiled from D:/AppServ/www/projects/templates/administrator/admin.admins.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'D:/AppServ/www/projects/templates/administrator/admin.admins.tpl', 266, false),)), $this); ?>
<div id="toolbar-box">
   <div class="t">
   	<div class="t">
   		<div class="t"></div>
   	</div>
   </div>
   <div class="m">
	   <div id="toolbar" class="toolbar">
	   		<?php echo '
	   		<script language="javascript" type="text/javascript">
			function submitbutton(pressbutton) {
				if (pressbutton == \'remove\') {
					if (document.adminForm.boxchecked.value == 0) {
						alert("Không có bản ghi nào được lựa chọn !");
					} else if ( confirm("Bạn có chắc rằng muốn xóa bản ghi này không?")) {
						submitform(\'remove\');
					}
				} else {
					submitform(pressbutton);
				}
			}
			</script>
			'; ?>

	   		<table class="toolbar toolbar_small">
	   			<tbody>
	   				<tr>
	   					<?php if ($this->_tpl_vars['task'] == 'add' || $this->_tpl_vars['task'] == 'edit'): ?>
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
	   					<?php else: ?>
	   					<td id="toolbar-save" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('add');">
	   							<span title="Thêm mới" class="icon-32-new"></span>
	   							Thêm mới
	   						</a>
	   					</td>
	   					<td id="toolbar-published" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('publish');">
	   							<span title="Mở khóa" class="icon-32-publish"></span>
	   							Mở khóa
	   						</a>
	   					</td>
	   					<td id="toolbar-uhpublished" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('unpublish');">
	   							<span title="Khóa lại" class="icon-32-unpublish"></span>
	   							Khóa lại
	   						</a>
	   					</td>
	   					<td id="toolbar-delete" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('remove');">
	   							<span title="Xóa" class="icon-32-delete"></span>
	   							Xóa
	   						</a>
	   					</td>
	   					<?php endif; ?>
	   				</tr>
	   			</tbody>
	   		</table>
	   </div>
	   <div class="header admins"><?php echo $this->_tpl_vars['page_title']; ?>
</div>
	   <div class="clr"></div>
   </div>
   <div class="b">
   		<div class="b">
   			<div class="b"></div>
   		</div>
   </div>
   <?php if ($this->_tpl_vars['is_message']): ?><div class="message"><?php echo $this->_tpl_vars['is_message']; ?>
</div><?php endif; ?>
</div>
<?php if ($this->_tpl_vars['task'] == 'add' || $this->_tpl_vars['task'] == 'edit'): ?>
<form action="<?php echo $this->_tpl_vars['page']; ?>
" method="post" name="adminForm" enctype="multipart/form-data">
<table class="adminTable" width="100%">
	<tr>
		<td class="key"><label for="name">Họ tên <font color="Red">*</font></label></td>
		<td><input type="text" name="admin_name" id="admin_name" value="<?php echo $this->_tpl_vars['thisAdmin']->admin_name; ?>
" class="adm_inputbox" maxlength="150"></td>
	</tr>
	<?php if ($this->_tpl_vars['admin_of_id'] == 0): ?>
	<tr>
		<td class="key"><label for="name">Email <font color="Red">*</font></label></td>
		<td><input type="text" name="admin_email" id="admin_email" value="<?php echo $this->_tpl_vars['thisAdmin']->admin_email; ?>
" class="adm_inputbox" maxlength="100"></td>
	</tr>
	<tr>
		<td class="key"><label for="name">Tên đăng nhập <font color="Red">*</font></label></td>
		<td><input type="text" name="admin_username" id="admin_username" value="<?php echo $this->_tpl_vars['thisAdmin']->admin_username; ?>
" class="adm_inputbox" maxlength="100"></td>
	</tr>
	<?php else: ?>
	<tr>
		<td class="key"><label for="name">Email</label></td>
		<td style="color:#666;"><?php echo $this->_tpl_vars['thisAdmin']->admin_email; ?>
</td>
	</tr>
	<tr>
		<td class="key"><label for="name">Tên đăng nhập</label></td>
		<td style="color:#666;"><?php echo $this->_tpl_vars['thisAdmin']->admin_username; ?>
</td>
	</tr>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['admin_of_id'] == 0): ?>
	<tr>
		<td class="key"><label for="name">Mật khẩu<font color="Red">*</font></label></td>
		<td><input type="password" name="admin_password" id="admin_password" value="" class="adm_inputbox" maxlength="100"></td>
	</tr>
	<?php else: ?>
	<tr>
		<td class="key"><label for="name">Mật khẩu cũ <font color="Red">*</font></label></td>
		<td><input type="password" name="admin_password" id="admin_password" value="" class="adm_inputbox" maxlength="100"></td>
	</tr>
	<tr>
		<td class="key"><label for="name">Mật khẩu mới<font color="Red">*</font></label></td>
		<td><input type="password" name="admin_password_new" id="admin_password_new" value="" class="adm_inputbox" maxlength="100"></td>
	</tr>
	<tr>
		<td class="key"><label for="name">Nhắc lại mật khẩu mới<font color="Red">*</font></label></td>
		<td><input type="password" name="admin_password_conf" id="admin_password_conf" value="" class="adm_inputbox" maxlength="100"></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td class="key"><label for="name">Nhóm thành viên <font color="Red">*</font></label></td>
		<td>
			<select onchange="objUser.onchangeGroup()" size="1" class="adm_selectbox" id="cbo_group" name="cbo_group" style="width:190px">
					<option <?php if ($this->_tpl_vars['actived'] == 0): ?>selected="selected"<?php endif; ?> value="0">- Nhóm thành viên -</option>
					<?php $_from = $this->_tpl_vars['arrGroup']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['gId'] => $this->_tpl_vars['group']):
?>
					<?php if ($this->_tpl_vars['gId'] > $this->_tpl_vars['userInfo']['admin_group'] || $this->_tpl_vars['userInfo']['admin_group'] == 1): ?>
            			<option value="<?php echo $this->_tpl_vars['gId']; ?>
"<?php if ($this->_tpl_vars['gId'] == $this->_tpl_vars['thisAdmin']->admin_group): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['group']; ?>
</option>
            		<?php endif; ?>
            		<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
		</tr>
		<?php if ($this->_tpl_vars['sites']): ?>
		<tr id="rSite" style="display:none">
		<td class="key"><label for="name">Quản trị website</label></td>
		<td>
			<select name="cbo_site[]" id="cbo_site" class="adm_selectbox" multiple>
					<?php $_from = $this->_tpl_vars['sites']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['siteid'] => $this->_tpl_vars['sitename']):
?>
            			<option value="<?php echo $this->_tpl_vars['siteid']; ?>
"><?php echo $this->_tpl_vars['sitename']; ?>
</option>
            		<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
		</tr>
		<?php endif; ?>
		<tr id="rAccess" style="display:none">
		<td class="key"><label for="name">Quyền truy cập</label></td>
		<td>
			<?php $_from = $this->_tpl_vars['aryPages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['kp'] => $this->_tpl_vars['pages']):
?>
				<b><?php echo $this->_tpl_vars['kp']; ?>
</b><br>
				<?php $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['kp1'] => $this->_tpl_vars['access']):
?>
					<label for="<?php echo $this->_tpl_vars['kp']; ?>
_<?php echo $this->_tpl_vars['kp1']; ?>
">
					<?php if ($this->_tpl_vars['userInfo']['admin_group'] > 1): ?>
						<?php $_from = $this->_tpl_vars['adminAccess']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['kp2'] => $this->_tpl_vars['access2']):
?>
						<?php if ($this->_tpl_vars['kp'] == $this->_tpl_vars['kp2']): ?>
							<?php $_from = $this->_tpl_vars['access2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['kp3'] => $this->_tpl_vars['access3']):
?>
							<?php if ($this->_tpl_vars['access3'] == $this->_tpl_vars['kp1']): ?><input type="checkbox" value="<?php echo $this->_tpl_vars['kp1']; ?>
" name="<?php echo $this->_tpl_vars['kp']; ?>
[]" id="<?php echo $this->_tpl_vars['kp']; ?>
_<?php echo $this->_tpl_vars['kp1']; ?>
"><?php echo $this->_tpl_vars['access'];  endif; ?>
							<?php endforeach; endif; unset($_from); ?>
						<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					<?php else: ?><input type="checkbox" value="<?php echo $this->_tpl_vars['kp1']; ?>
" name="<?php echo $this->_tpl_vars['kp']; ?>
[]" id="<?php echo $this->_tpl_vars['kp']; ?>
_<?php echo $this->_tpl_vars['kp1']; ?>
"><?php echo $this->_tpl_vars['access']; ?>

					<?php endif; ?>
					</label> &nbsp;
				<?php endforeach; endif; unset($_from); ?>
			<br><br>
			<?php endforeach; endif; unset($_from); ?>
		</td>
	</tr>
	<tfoot>
   	<tr>
   		<td></td>
   		<td>
   			<input type="hidden" name="admin_id" value="<?php echo $this->_tpl_vars['thisAdmin']->admin_id; ?>
" />
   			<input type="hidden" name="task" value="save" />
   		</td>
   	</tr>
   </tfoot>
</table>
</form>
<?php else: ?>
<form name="adminForm" method="post" action="<?php echo $this->_tpl_vars['page']; ?>
">
	<table style="margin-bottom:5px;">
		<tbody>
			<tr>
				<td width="100%" align="left">
					Bộ lọc:
					<input type="text" title="Lọc theo tên quản trị viên" onchange="document.adminForm.submit();" class="text_area" size="40" value="<?php echo $this->_tpl_vars['search']; ?>
" id="search" name="search" />
					<button onclick="this.form.submit();">Go</button>
					<button onclick="document.getElementById('search').value='';document.getElementById('filter_status').value=3;document.getElementById('limit').value='50';document.adminForm.p.value=1;">Reset</button>
				</td>
				<td nowrap="nowrap">
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_status" name="filter_status">
						<option <?php if ($this->_tpl_vars['filter_status'] == 3): ?>selected="selected"<?php endif; ?> value="3">- Trạng thái -</option>
						<option <?php if ($this->_tpl_vars['filter_status'] == 1): ?>selected="selected"<?php endif; ?> value="1">Đang hoạt động</option>
						<option <?php if ($this->_tpl_vars['filter_status'] == 0): ?>selected="selected"<?php endif; ?> value="0">Không hoạt động</option>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
	<table cellspacing="1" class="adminlist">
		<thead>
			<tr>
				<th width="5">#</th>
				<th width="5">
					<input type="checkbox" onclick="checkAll(50);" value="" name="toggle">
				</th>
				<th class="title" nowrap="nowrap" style="text-align: left; padding-left: 5px;">
					<strong>Tên quản trị</strong>
				</th>
				<th class="title" nowrap="nowrap" style="text-align: left; padding-left: 5px;">
					<strong>Email</strong>
				</th>
				<th class="title" nowrap="nowrap" style="text-align: left; padding-left: 5px;">
					<strong>Tên đăng nhập</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Quyền truy cập</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Ngày tạo</strong>
				</th>	
				<th class="title" nowrap="nowrap">
					<strong>Đăng nhập lần cuối</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Người tạo</strong>
				</th>
				<th width="15" nowrap="nowrap">
					<strong>Trạng thái</strong>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['lsAdmin']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loops']['show'] = true;
$this->_sections['loops']['max'] = $this->_sections['loops']['loop'];
$this->_sections['loops']['step'] = 1;
$this->_sections['loops']['start'] = $this->_sections['loops']['step'] > 0 ? 0 : $this->_sections['loops']['loop']-1;
if ($this->_sections['loops']['show']) {
    $this->_sections['loops']['total'] = $this->_sections['loops']['loop'];
    if ($this->_sections['loops']['total'] == 0)
        $this->_sections['loops']['show'] = false;
} else
    $this->_sections['loops']['total'] = 0;
if ($this->_sections['loops']['show']):

            for ($this->_sections['loops']['index'] = $this->_sections['loops']['start'], $this->_sections['loops']['iteration'] = 1;
                 $this->_sections['loops']['iteration'] <= $this->_sections['loops']['total'];
                 $this->_sections['loops']['index'] += $this->_sections['loops']['step'], $this->_sections['loops']['iteration']++):
$this->_sections['loops']['rownum'] = $this->_sections['loops']['iteration'];
$this->_sections['loops']['index_prev'] = $this->_sections['loops']['index'] - $this->_sections['loops']['step'];
$this->_sections['loops']['index_next'] = $this->_sections['loops']['index'] + $this->_sections['loops']['step'];
$this->_sections['loops']['first']      = ($this->_sections['loops']['iteration'] == 1);
$this->_sections['loops']['last']       = ($this->_sections['loops']['iteration'] == $this->_sections['loops']['total']);
?>
			<tr class="row<?php if ($this->_sections['loops']['index']%2 == 0): ?>0<?php else: ?>1<?php endif; ?>">
				<td><?php echo $this->_sections['loops']['index']+1; ?>
</td>
				<td align="center">
					<input type="checkbox" onclick="isChecked(this.checked);" value="<?php echo $this->_tpl_vars['lsAdmin'][$this->_sections['loops']['index']]['admin_id']; ?>
" name="cid[]" id="cb<?php echo $this->_tpl_vars['lsAdmin'][$this->_sections['loops']['index']]['admin_id']; ?>
">
				</td>
				<td>
					<a href="<?php echo $this->_tpl_vars['page']; ?>
?task=edit&admin_id=<?php echo $this->_tpl_vars['lsAdmin'][$this->_sections['loops']['index']]['admin_id']; ?>
"><?php echo $this->_tpl_vars['lsAdmin'][$this->_sections['loops']['index']]['admin_name']; ?>
</a>
				</td>
				<td>
					<a href="<?php echo $this->_tpl_vars['page']; ?>
?task=edit&admin_id=<?php echo $this->_tpl_vars['lsAdmin'][$this->_sections['loops']['index']]['admin_id']; ?>
"><?php echo $this->_tpl_vars['lsAdmin'][$this->_sections['loops']['index']]['admin_email']; ?>
</a>
				</td>
				<td><?php echo $this->_tpl_vars['lsAdmin'][$this->_sections['loops']['index']]['admin_username']; ?>
</td>
				<td>
				<?php $_from = $this->_tpl_vars['lsAdmin'][$this->_sections['loops']['index']]['admin_access']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['access']):
?>
				<?php if ($this->_tpl_vars['access']): ?>
					<u><b><?php echo $this->_tpl_vars['k']; ?>
</b></u><br />
					<?php echo $this->_tpl_vars['access']; ?>
<br />
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
				</td>
				<td align="center"><?php if ($this->_tpl_vars['lsAdmin'][$this->_sections['loops']['index']]['admin_registerDate'] == '0000-00-00 00:00:00'): ?>Không xác định<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['lsAdmin'][$this->_sections['loops']['index']]['admin_registerDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y %H:%M:%S") : smarty_modifier_date_format($_tmp, "%d/%m/%Y %H:%M:%S"));  endif; ?></td>
				<td align="center">
					<?php if ($this->_tpl_vars['lsAdmin'][$this->_sections['loops']['index']]['admin_lastvisitDate'] == '0000-00-00 00:00:00'): ?>Không xác định<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['lsAdmin'][$this->_sections['loops']['index']]['admin_lastvisitDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y %H:%M:%S") : smarty_modifier_date_format($_tmp, "%d/%m/%Y %H:%M:%S"));  endif; ?>
				</td>
				<td align="center">
					<?php echo $this->_tpl_vars['lsAdmin'][$this->_sections['loops']['index']]['name_created']; ?>

				</td>
				<td align="center">
					<?php if ($this->_tpl_vars['lsAdmin'][$this->_sections['loops']['index']]['admin_enabled'] == 1): ?>
						<a onclick="return listItemTask('cb<?php echo $this->_tpl_vars['lsAdmin'][$this->_sections['loops']['index']]['admin_id']; ?>
','unpublish')" title="Khóa lại">
						<img src="../images/publish_g.png" width="16" style="cursor:pointer" alt="Khóa lại" border="0" />
						</a>
					<?php else: ?>
						<a onclick="return listItemTask('cb<?php echo $this->_tpl_vars['lsAdmin'][$this->_sections['loops']['index']]['admin_id']; ?>
','publish')" title="Mở khóa">
						<img src="../images/publish_x.png" width="16" style="cursor:pointer" alt="Mở khóa" border="0" />
						</a>
					<?php endif; ?>
				</td>
			</tr>
			<?php endfor; else: ?>
			<tr>
				<td colspan="9" align="center"><font color="red">Không tồn tại bản ghi nào thỏa mãn điều kiện tìm kiếm!</font></td>
			</tr>
			<?php endif; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="11">
					<?php echo $this->_tpl_vars['datapage']; ?>

				</td>
			</tr>
		</tfoot>
	</table>
	
	<input type="hidden" value="<?php echo $this->_tpl_vars['task']; ?>
" name="task">
	<input type="hidden" value="" name="boxchecked">
	<input type="hidden" value="<?php echo $this->_tpl_vars['total_record']; ?>
" name="total_record" id="total_record" />
</form>
<?php endif; ?>

<?php echo '
<script language="javascript">
if (typeof objUser == \'undefined\') {
	objUser = {
		onchangeGroup: function() {
			var group = parseInt($("#cbo_group option:selected").val());
			if (group > 1) {
				$("#rSite").css("display", "");
				$("#rAccess").css("display", "");
			}
			else {
				$("#rSite").css("display", "none");
				$("#rAccess").css("display", "none");
			}
		}
	}
}

$(document).ready(function(){
	objUser.onchangeGroup();
});
</script>
'; ?>