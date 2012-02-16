<?php /* Smarty version 2.6.10, created on 2012-02-16 14:57:34
         compiled from D:/AppServ/www/projects/templates/administrator/admin.customer_hotdeal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'D:/AppServ/www/projects/templates/administrator/admin.customer_hotdeal.tpl', 226, false),)), $this); ?>
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
	   					<td id="toolbar-export" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('export');">
	   							<span title="Xuất file excel" class="icon-32-export"></span>
	   							Export
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
	   <div class="header customer"><?php echo $this->_tpl_vars['page_title']; ?>
</div>
	   <div class="clr"></div>
   </div>
   <div class="b">
   		<div class="b">
   			<div class="b"></div>
   		</div>
   </div>
</div>
<?php if ($this->_tpl_vars['task'] == 'add' || $this->_tpl_vars['task'] == 'edit'): ?>
<form action="admin.customer_hotdeal.php" method="post" name="adminForm">
<?php echo $this->_tpl_vars['error']; ?>

<table class="adminTable">
   <tbody>
   	<tr>
   		<td>Lựa chọn Hot Deal</td>
   		<td>
   		<select name="hotdeal_id" class="adm_selectbox">
   			<option value="">Lựa chọn hot deal</option>
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
   			<option <?php if ($this->_tpl_vars['thisCus']->hotdeal_id == $this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['title']; ?>
</option>
   			<?php endfor; endif; ?>
   		</select>
   		</td>
   	</tr>
   	<tr>
   		<td>Tên khách hàng: </td>
   		<td><input type="text" name="name" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisCus']->name; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Địa chỉ Email: </td>
   		<td><input type="text" name="email" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisCus']->email; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Số điện thoại: </td>
   		<td><input type="text" name="phone" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisCus']->phone; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Địa chỉ: </td>
   		<td><input type="text" name="address" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisCus']->address; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Ngày mua: </td>
   		<td><input type="text" name="date" id="date" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisCus']->date; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Số tiền đã mua: </td>
   		<td><input type="text" name="price" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisCus']->price; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Mua giá khuyến mãi</td>
   		<td><input type="checkbox" name="is_promotion" class="adm_chk" <?php if ($this->_tpl_vars['thisCus']->is_promotion == 1): ?> checked="checked"<?php endif; ?> value="1" /> Có</td>
   	</tr>
   </tbody>
   <tfoot>
   	<tr>
   		<td></td>
   		<td>
   			<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['thisCus']->id; ?>
" />
   			<input type="hidden" name="task" value="save" />
   		</td>
   	</tr>
   </tfoot>
</table>
</form>
<?php else: ?>
<form name="adminForm" method="post" action="admin.customer_hotdeal.php">
	<table style="margin-bottom:5px;">
		<tbody>
			<tr>
				<td width="100%" align="left">
					Bộ lọc:
					<input type="text" title="Lọc theo họ tên khách hàng, email khách hàng hoặc tên sản phẩm khách mua" onchange="document.adminForm.submit();" class="text_area" size="40" value="<?php echo $this->_tpl_vars['search']; ?>
" id="search" name="search" />
					<button onclick="this.form.submit();">Go</button>
					<button onclick="document.getElementById('search').value='';document.getElementById('filter_status').value=3;document.getElementById('limit').value='50';document.adminForm.p.value=1;">Reset</button>
				</td>
				<td nowrap="nowrap">
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_hotdeal" name="filter_hotdeal">
						<option value="">Lựa chọn theo Hotdeal</option>
						<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['lsHotdeals']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<option <?php if ($this->_tpl_vars['lsHotdeals'][$this->_sections['loops']['index']]['id'] == $this->_tpl_vars['filter_hotdeal']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['lsHotdeals'][$this->_sections['loops']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['lsHotdeals'][$this->_sections['loops']['index']]['title']; ?>
</option>
						<?php endfor; endif; ?>
					</select>
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_product" name="filter_product">
						<option value="">Lựa chọn theo sản phẩm</option>
						<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['lsProducts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<option <?php if ($this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['product_id'] == $this->_tpl_vars['filter_product']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['product_id']; ?>
"><?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['name']; ?>
</option>
						<?php endfor; endif; ?>
					</select>
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_status" name="filter_status">
						<option <?php if ($this->_tpl_vars['filter_status'] == 3): ?>selected="selected"<?php endif; ?> value="3">- Lọc theo giá mua -</option>
						<option <?php if ($this->_tpl_vars['filter_status'] == 1): ?>selected="selected"<?php endif; ?> value="1">Mua giá khuyến mãi</option>
						<option <?php if ($this->_tpl_vars['filter_status'] == 0): ?>selected="selected"<?php endif; ?> value="0">Mua giá thường</option>
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
					<strong>Tên khách hàng</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Email</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Số điện thoại</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Địa chỉ</strong>
				</th>	
				<th class="title" nowrap="nowrap">
					<strong>Ngày mua</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Giá tiền</strong>
				</th>
				<th width="15" nowrap="nowrap">
					<strong>Thứ tự mua</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Tên chương trình</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Sản phẩm</strong>
				</th>
				<th width="10" nowrap="nowrap">
					<strong>Giá khuyến mãi</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Hình thức</strong>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['lsCus']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<input type="checkbox" onclick="isChecked(this.checked);" value="<?php echo $this->_tpl_vars['lsCus'][$this->_sections['loops']['index']]['id']; ?>
" name="cid[]" id="cb<?php echo $this->_tpl_vars['lsCus'][$this->_sections['loops']['index']]['id']; ?>
">
				</td>
				<td>
					<a href="admin.customer_hotdeal.php?task=edit&id=<?php echo $this->_tpl_vars['lsCus'][$this->_sections['loops']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['lsCus'][$this->_sections['loops']['index']]['name']; ?>
</a>
				</td>
				<td align="center">
					<?php echo $this->_tpl_vars['lsCus'][$this->_sections['loops']['index']]['email']; ?>

				</td>
				<td align="center"><?php echo $this->_tpl_vars['lsCus'][$this->_sections['loops']['index']]['phone']; ?>
</td>
				<td align="center"><?php echo $this->_tpl_vars['lsCus'][$this->_sections['loops']['index']]['address']; ?>
</td>
				<td align="left"><?php echo $this->_tpl_vars['lsCus'][$this->_sections['loops']['index']]['date']; ?>
</td>
				<td align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['lsCus'][$this->_sections['loops']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 VNĐ</td>
				<td align="center"><?php echo $this->_tpl_vars['lsCus'][$this->_sections['loops']['index']]['order_product']; ?>
</td>
				<td align="center"><?php echo $this->_tpl_vars['lsCus'][$this->_sections['loops']['index']]['hotdeal_name']; ?>
</td>
				<td align="center"><?php echo $this->_tpl_vars['lsCus'][$this->_sections['loops']['index']]['name_product']; ?>
</td>
				<td align="center"><?php if ($this->_tpl_vars['lsCus'][$this->_sections['loops']['index']]['is_promotion'] == 1): ?> <b style="color:#85B21D;">Có</b> <?php else: ?> <b style="color:red;">Không</b> <?php endif; ?></td>
				<td align="center">
					<?php if ($this->_tpl_vars['lsCus'][$this->_sections['loops']['index']]['payment'] == 'cod'): ?>
					Giao hàng tận nhà
					<?php elseif ($this->_tpl_vars['lsCus'][$this->_sections['loops']['index']]['payment'] == 'store'): ?>
					Trực tiếp đến cửa hàng
					<?php endif; ?>
				</td>
			</tr>
			<?php endfor; else: ?>
			<tr>
				<td colspan="13" align="center"><font color="red">Không tồn tại bản ghi nào thỏa mãn điều kiện tìm kiếm!</font></td>
			</tr>
			<?php endif; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="13">
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