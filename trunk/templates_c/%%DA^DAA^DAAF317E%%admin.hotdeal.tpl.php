<?php /* Smarty version 2.6.10, created on 2012-01-11 15:03:20
         compiled from D:%5CAppServ%5Cwww%5Cmobimart/templates/administrator/admin.hotdeal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'D:\\AppServ\\www\\mobimart/templates/administrator/admin.hotdeal.tpl', 28, false),)), $this); ?>
<?php if ($this->_tpl_vars['task'] == 'addnew' || $this->_tpl_vars['task'] == 'edit'): ?>
<form action="" method="post" name="frmAdmin">
<?php echo $this->_tpl_vars['error']; ?>

<table class="adminTable">
   <thead>
   	<tr>
   		<th colspan="2"><?php echo $this->_tpl_vars['page_title']; ?>
</th>
   	</tr>
   </thead>
   <tbody>
   	<tr>
   		<td width="20%">Nhóm sản phẩm</td>
   		<td width="80%">
   		<select name="category_id" class="adm_selectbox" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
   			<option value="">Lựa chọn theo nhóm</option>
   			<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['categorys']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
   			<option <?php if ($this->_tpl_vars['category_id'] == $this->_tpl_vars['categorys'][$this->_sections['loops']['index']]['category_id']): ?>selected="selected"<?php endif; ?> value="admin.hotdeal.php?task=<?php echo $this->_tpl_vars['task']; ?>
&category_id=<?php echo $this->_tpl_vars['categorys'][$this->_sections['loops']['index']]['category_id']; ?>
"><?php echo $this->_tpl_vars['categorys'][$this->_sections['loops']['index']]['name']; ?>
</option>
   			<?php endfor; endif; ?>
   		</select>
   		</td>
   	</tr>
   	<tr>
   		<td>Chọn sản phẩm</td>
   		<td>
   		<select name="product_id" class="adm_selectbox">
   			<option value="">Lựa chọn sản phẩm</option>
   			<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['products']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
   			<option value="<?php echo $this->_tpl_vars['products'][$this->_sections['loops']['index']]['product_id']; ?>
"><?php echo $this->_tpl_vars['products'][$this->_sections['loops']['index']]['name']; ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['products'][$this->_sections['loops']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 VNĐ</option>
   			<?php endfor; endif; ?>
   		</select>
   		</td>
   	</tr>
   	<tr>
   		<td>Giá khuyến mại</td>
   		<td><input type="text" name="price_hotdeal" class="adm_inputbox" value="" /></td>
   	</tr>
   	<tr>
   		<td>Mức giảm</td>
   		<td><input type="text" name="price_hotdeal" class="adm_inputbox" value="" disabled="disabled" /> (%)</td>
   	</tr>
   	<tr>
   		<td>Tiêu đề Hot Deal</td>
   		<td><input type="text" name="title" class="adm_inputbox" value="" /></td>
   	</tr>
   	<tr>
   		<td>Mô tả Hot Deal</td>
   		<td><textarea cols="30" rows="5" name="description"></textarea></td>
   	</tr>
   	<tr>
   		<td>Tên tính năng</td>
   		<td><input type="text" name="title_feauture" class="adm_inputbox" value="" /></td>
   	</tr>
   	<tr>
   		<td>Ảnh tính năng</td>
   		<td><input type="file" name="image" class="adm_inputbox" value="" /></td>
   	</tr>
   	<tr>
   		<td>Ngày bắt đầu</td>
   		<td><input type="text" name="start_date" id="start_date" class="adm_inputbox" value="" /></td>
   	</tr>
   	<tr>
   		<td>Ngày kết thúc</td>
   		<td><input type="text" name="end_date" id="end_date" class="adm_inputbox" value="" /></td>
   	</tr>
   	<tr>
   		<td>Trạng thái</td>
   		<td><input type="checkbox" name="published" class="adm_chk" value="1" /></td>
   	</tr>
   </tbody>
   <tfoot>
   	<tr>
   		<td></td>
   		<td>
   			<input type="submit" class="adm_button" value="<?php echo $this->_tpl_vars['submit']; ?>
" />
   			<input type="reset" class="adm_button" value="<?php echo $this->_tpl_vars['reset']; ?>
" />
   			<input type="hidden" name="do" value="save" />
   		</td>
   	</tr>
   </tfoot>
</table>
</form>
<?php else: ?>
<form name="adminForm" method="post" action="admin.hotdeal.php">
	<table style="margin-bottom:5px;">
		<tbody>
			<tr>
				<td width="100%">
					Bộ lọc:
					<input type="text" title="Lọc theo Email thành viên, Tên đăng nhập hoặc Họ tên thành viên" onchange="document.adminForm.submit();" class="text_area" size="40" value="<?php echo $this->_tpl_vars['search']; ?>
" id="search" name="search" />
					<button onclick="this.form.submit();">Go</button>
					<button onclick="document.getElementById('search').value='';document.getElementById('filter_user_id').value=0;document.getElementById('filter_bank_type').value=-1;document.getElementById('filter_status').value=3;document.getElementById('limit').value='50';document.adminForm.p.value=1;">Reset</button>
				</td>
				<td nowrap="nowrap">
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_user_id" name="filter_user_id">
						<option value="-1" <?php if ($this->_tpl_vars['filter_user_id'] == 0): ?> selected<?php endif; ?>>- Chủ thẻ -</option>
						<?php $_from = $this->_tpl_vars['listOfUsers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user_id'] => $this->_tpl_vars['user_fullname']):
?>
						<option value="<?php echo $this->_tpl_vars['user_id']; ?>
"<?php if ($this->_tpl_vars['user_id'] == $this->_tpl_vars['filter_user_id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['user_fullname']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>

					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_bank_type" name="filter_bank_type">
						<option value="-1" <?php if ($this->_tpl_vars['filter_bank_type'] == -1): ?> selected<?php endif; ?>>- Loại thẻ -</option>
						<?php $_from = $this->_tpl_vars['banks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['bank_id'] => $this->_tpl_vars['bank_name']):
?>
						<option value="<?php echo $this->_tpl_vars['bank_id']; ?>
"<?php if ($this->_tpl_vars['filter_bank_type'] == $this->_tpl_vars['bank_id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['bank_name']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_status" name="filter_status">
						<option <?php if ($this->_tpl_vars['filter_status'] == 3): ?>selected="selected"<?php endif; ?> value="3">- Trạng thái -</option>
						<option <?php if ($this->_tpl_vars['filter_status'] == 1): ?>selected="selected"<?php endif; ?> value="1">Đã kích hoạt</option>
						<option <?php if ($this->_tpl_vars['filter_status'] == 0): ?>selected="selected"<?php endif; ?> value="0">Chưa kích hoạt</option>
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
					<strong>Tên Hot Deal</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Sản phẩm</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Giá khuyến mãi</strong>
				</th>	
				<th class="title" nowrap="nowrap">
					<strong>Ngày hết hạn</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Sửa / xóa</strong>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['lsHotDeal']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<input type="checkbox" class="id_<?php echo $this->_tpl_vars['items'][$this->_sections['loops']['index']]['users_card_id']; ?>
" onclick="isChecked(this.checked);" value="<?php echo $this->_tpl_vars['items'][$this->_sections['loops']['index']]['users_card_id']; ?>
" name="cid[]" id="cb<?php echo $this->_sections['loops']['index']; ?>
">
				</td>
				<td>
					<b><?php echo $this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['title']; ?>
</b>
				</td>
				<td align="center">
					<?php echo $this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['users_card_number']; ?>

				</td>
				<td align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['price_hotdeal'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 VNĐ</td>
				<td align="left">
					<?php echo $this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['end_date']; ?>

				</td>

				<td align="center" id="user_product_button" class="item">

					<img alt="Sửa" title="Sửa" src="../images/icons/action_postcomment.gif" style="cursor:pointer" onclick="document.location='admin_users_card.php?task=edit&id=<?php echo $this->_tpl_vars['items'][$this->_sections['loops']['index']]['users_card_id']; ?>
'" />&nbsp;

					<img id="id_<?php echo $this->_tpl_vars['items'][$this->_sections['loops']['index']]['users_card_id']; ?>
" alt="Xóa" title="Xóa" src="../images/icons/action_delete2.gif" style="cursor:pointer" class="delete" />
				</td>
			</tr>
			<?php endfor; else: ?>
			<tr>
				<td colspan="11" align="center"><font color="red">Không tồn tại bản ghi nào thỏa mãn điều kiện tìm kiếm!</font></td>
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