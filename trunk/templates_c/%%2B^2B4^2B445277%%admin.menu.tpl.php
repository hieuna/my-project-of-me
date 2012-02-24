<?php /* Smarty version 2.6.10, created on 2012-02-24 16:30:58
         compiled from D:/AppServ/www/projects/templates/administrator/admin.menu.tpl */ ?>
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
	   							<span title="Hiển thị" class="icon-32-publish"></span>
	   							Hiển thị
	   						</a>
	   					</td>
	   					<td id="toolbar-uhpublished" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('unpublish');">
	   							<span title="Ẩn đi" class="icon-32-unpublish"></span>
	   							Ẩn đi
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
	   <div class="header menu"><?php echo $this->_tpl_vars['page_title']; ?>
</div>
	   <div class="clr"></div>
   </div>
   <div class="b">
   		<div class="b">
   			<div class="b"></div>
   		</div>
   </div>
   <?php if ($this->_tpl_vars['mosmsg']): ?><div class="message"><?php echo $this->_tpl_vars['mosmsg']; ?>
</div><?php endif; ?>
</div>
<?php if ($this->_tpl_vars['task'] == 'add' || $this->_tpl_vars['task'] == 'edit'): ?>
<form action="<?php echo $this->_tpl_vars['page']; ?>
" method="post" name="adminForm" class="form-validate">
<table class="adminTable">
    <tbody>
   	<tr>
   		<td width="20%">Nhóm menu</td>
   		<td width="80%">
   		<select name="menutype" class="adm_selectbox">
   			<?php if ($this->_tpl_vars['task'] == 'edit'): ?>
   			<option value="<?php echo $this->_tpl_vars['thisMenu']->menu_id; ?>
" <?php if ($this->_tpl_vars['thisMenu']->parent_id == $this->_tpl_vars['thisMenu']->menu_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['thisMenu']->name; ?>
</option>
   			<?php else: ?>
   			<option value="">Lựa chọn theo nhóm</option>
   			<?php endif; ?>
   			<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['lsMenu']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
   			<option <?php if ($this->_tpl_vars['thisMenu']->menu_id == $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['menu_id'] || $this->_tpl_vars['menu_id'] == $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['menu_id']): ?> selected="selected"<?php endif; ?> value="admin.hotdeal.php?task=<?php echo $this->_tpl_vars['task']; ?>
&id=<?php echo $this->_tpl_vars['thisMenu']->id; ?>
&menu_id=<?php echo $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['menu_id']; ?>
"><?php echo $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['name']; ?>
</option>
   			<?php endfor; endif; ?>
   		</select>
   		</td>
   	</tr>
   	<tr>
   		<td width="20%">Trực thuộc nhóm</td>
   		<td width="80%">
   		<select name="parent_id" class="adm_selectbox">
   			<?php if ($this->_tpl_vars['task'] == 'edit'): ?>
   			<option value="<?php echo $this->_tpl_vars['thisMenu']->menu_id; ?>
" <?php if ($this->_tpl_vars['thisMenu']->parent_id == $this->_tpl_vars['thisMenu']->menu_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['thisMenu']->name; ?>
</option>
   			<?php else: ?>
   			<option value="">Lựa chọn theo nhóm</option>
   			<?php endif; ?>
   			<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['lsMenu']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
   			<option <?php if ($this->_tpl_vars['thisMenu']->menu_id == $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['menu_id'] || $this->_tpl_vars['menu_id'] == $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['menu_id']): ?> selected="selected"<?php endif; ?> value="admin.hotdeal.php?task=<?php echo $this->_tpl_vars['task']; ?>
&id=<?php echo $this->_tpl_vars['thisMenu']->id; ?>
&menu_id=<?php echo $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['menu_id']; ?>
"><?php echo $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['name']; ?>
</option>
   			<?php endfor; endif; ?>
   		</select>
   		</td>
   	</tr>
   	<tr>
   		<td>Tên menu</td>
   		<td><input type="text" name="name" class="adm_inputbox required" value="<?php echo $this->_tpl_vars['thisMenu']->name; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Bí danh</td>
   		<td><input type="text" name="alias" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisMenu']->alias; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Link đến</td>
   		<td><input type="text" name="link" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisMenu']->link; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Kiểu menu</td>
   		<td><input type="text" name="type" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisMenu']->type; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Thứ tự</td>
   		<td><input type="text" name="ordering" id="ordering" class="adm_inputbox small" value="<?php echo $this->_tpl_vars['thisMenu']->ordering; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Trạng thái</td>
   		<td><input type="checkbox" name="status" class="adm_chk" <?php if ($this->_tpl_vars['thisMenu']->status == 1): ?> checked="checked"<?php endif; ?> value="1" /> Hiển thị</td>
   	</tr>
   </tbody>
   <tfoot>
   	<tr>
   		<td></td>
   		<td>
   			<input type="hidden" name="menu_id_value" value="<?php echo $this->_tpl_vars['menu_id']; ?>
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
					<input type="text" title="Lọc theo tên hotdeal" onchange="document.adminForm.submit();" class="text_area" size="40" value="<?php echo $this->_tpl_vars['search']; ?>
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
					<strong>Tên menu</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Bí danh</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Nhóm menu</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Link</strong>
				</th>	
				<th class="title" nowrap="nowrap">
					<strong>Kiểu menu</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Menu trực thuộc</strong>
				</th>
				<th width="15" nowrap="nowrap">
					<strong>Trạng thái</strong>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['lsMenu']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<input type="checkbox" onclick="isChecked(this.checked);" value="<?php echo $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['menu_id']; ?>
" name="cid[]" id="cb<?php echo $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['menu_id']; ?>
">
				</td>
				<td>
					<a href="<?php echo $this->_tpl_vars['page']; ?>
?task=edit&menu_id=<?php echo $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['menu_id']; ?>
"><?php echo $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['name']; ?>
</a>
				</td>
				<td align="center"><?php echo $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['alias']; ?>
</td>
				<td align="center"><?php echo $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['name_parent']; ?>
</td>
				<td align="center"><?php echo $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['product_count']; ?>
</td>
				<td align="center">
					<?php echo $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['name_created']; ?>

				</td>
				<td align="center">
					<?php echo $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['created']; ?>

				</td>
				<td align="center">
					<?php if ($this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['status'] == 1): ?>
						<a onclick="return listItemTask('cb<?php echo $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['menu_id']; ?>
','unpublish')" title="Ẩn đi">
						<img src="../images/publish_g.png" width="16" style="cursor:pointer" alt="Ẩn đi" border="0" />
						</a>
					<?php else: ?>
						<a onclick="return listItemTask('cb<?php echo $this->_tpl_vars['lsMenu'][$this->_sections['loops']['index']]['menu_id']; ?>
','publish')" title="Hiển thị">
						<img src="../images/publish_x.png" width="16" style="cursor:pointer" alt="Hiển thị" border="0" />
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
				<td colspan="9">
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