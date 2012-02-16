<?php /* Smarty version 2.6.10, created on 2012-02-13 15:45:23
         compiled from D:/AppServ/www/mobimart/templates/administrator/admin.hotdeal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'D:/AppServ/www/mobimart/templates/administrator/admin.hotdeal.tpl', 111, false),)), $this); ?>
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
	   <div class="header hotdeal"><?php echo $this->_tpl_vars['page_title']; ?>
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
<form action="admin.hotdeal.php" method="post" name="adminForm" enctype="multipart/form-data">
<table class="adminTable">
   <tbody>
   	<tr>
   		<td width="20%">Nhóm sản phẩm</td>
   		<td width="80%">
   		<select name="category_id" class="adm_selectbox" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
   			<?php if ($this->_tpl_vars['task'] == 'edit'): ?>
   			<option value="<?php echo $this->_tpl_vars['thisBanner']->category_id; ?>
" selected="selected"><?php echo $this->_tpl_vars['name_category_banner']; ?>
</option>
   			<?php else: ?>
   			<option value="">Lựa chọn theo nhóm</option>
   			<?php endif; ?>
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
   			<option <?php if ($this->_tpl_vars['thisHotDeal']->category_id == $this->_tpl_vars['categorys'][$this->_sections['loops']['index']]['category_id'] || $this->_tpl_vars['category_id'] == $this->_tpl_vars['categorys'][$this->_sections['loops']['index']]['category_id']): ?> selected="selected"<?php endif; ?> value="admin.hotdeal.php?task=<?php echo $this->_tpl_vars['task']; ?>
&id=<?php echo $this->_tpl_vars['thisHotDeal']->id; ?>
&category_id=<?php echo $this->_tpl_vars['categorys'][$this->_sections['loops']['index']]['category_id']; ?>
"><?php echo $this->_tpl_vars['categorys'][$this->_sections['loops']['index']]['name']; ?>
</option>
   			<?php endfor; endif; ?>
   		</select>
   		</td>
   	</tr>
   	<tr>
   		<td valign="top">Chọn sản phẩm</td>
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
   			<option <?php if ($this->_tpl_vars['thisHotDeal']->product_id == $this->_tpl_vars['products'][$this->_sections['loops']['index']]['product_id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['products'][$this->_sections['loops']['index']]['product_id']; ?>
"><?php echo $this->_tpl_vars['products'][$this->_sections['loops']['index']]['name']; ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['products'][$this->_sections['loops']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 VNĐ</option>
   			<?php endfor; endif; ?>
   		</select>
   		<div id="feauture_product" style="margin:10px 0; padding:10px;">
   			<select name="feauture[]" multiple="multiple" style="width:250px; height:200px;">
   			<?php $_from = $this->_tpl_vars['thisHotDeal']->feauture; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['foo']):
?>
			    <option value="<?php echo $this->_tpl_vars['foo']; ?>
"><?php echo $this->_tpl_vars['foo']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
   			</select>
   		</div>
   		<?php if ($this->_tpl_vars['thisHotDeal']->feauture): ?>
   		<input type="checkbox" value="<?php echo $this->_tpl_vars['thisHotDeal']->product_id; ?>
" name="chkFT" /> Chọn tính năng khác
   		<?php endif; ?>
   		</td>
   	</tr>
   	<tr>
   		<td>Giá niêm yết</td>
   		<td><input type="text" name="price_ny" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisHotDeal']->price_ny; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Giá khuyến mại</td>
   		<td><input type="text" name="price_hotdeal" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisHotDeal']->price_hotdeal; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Mức giảm</td>
   		<td><input type="text" name="discount" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisHotDeal']->discount; ?>
" disabled="disabled" /> (%)</td>
   	</tr>
   	<tr>
   		<td>Tiêu đề Hot Deal</td>
   		<td><input type="text" name="title" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisHotDeal']->title; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Mô tả Hot Deal</td>
   		<td><textarea cols="30" rows="5" name="description"><?php echo $this->_tpl_vars['thisHotDeal']->description; ?>
</textarea></td>
   	</tr>
   	<tr>
   		<td>Số lượng sản phẩm</td>
   		<td><input type="text" name="count" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisHotDeal']->count; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Tên tính năng</td>
   		<td><input type="text" name="title_feauture" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisHotDeal']->title_feauture; ?>
" /></td>
   	</tr>
   	<tr>
   		<td valign="top">Ảnh tính năng</td>
   		<td valign="top">
   			<div style="widtd:100%; margin: 10px 0;">
   				<img src="<?php echo $this->_tpl_vars['http_root'];  echo $this->_tpl_vars['thisHotDeal']->image; ?>
" width="150" border="0" />
   			</div>
   			<input type="file" name="img" size="25" class="adm_inputbox" value="" />
   		</td>
   	</tr>
   	<tr>
   		<td>Ngày cập nhật</td>
   		<td><input type="text" name="start_date" id="start_date" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisHotDeal']->start_date; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Ngày kết thúc</td>
   		<td><input type="text" name="end_date" id="end_date" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisHotDeal']->end_date; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Tên người liên hệ</td>
   		<td><input type="text" name="ct_name" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisHotDeal']->ct_name; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Điện thoại liên hệ</td>
   		<td><input type="text" name="ct_phone" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisHotDeal']->ct_phone; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Yahoo liên hệ</td>
   		<td><input type="text" name="ct_yahoo" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisHotDeal']->ct_yahoo; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Skype liên hệ</td>
   		<td><input type="text" name="ct_skype" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisHotDeal']->ct_skype; ?>
" /></td>
   	</tr>
   	<tr>
   		<td>Trạng thái</td>
   		<td><input type="checkbox" name="published" class="adm_chk" <?php if ($this->_tpl_vars['thisHotDeal']->published == 1): ?> checked="checked"<?php endif; ?> value="1" /> Hiển thị</td>
   	</tr>
   </tbody>
   <tfoot>
   	<tr>
   		<td></td>
   		<td>
   			<input type="hidden" name="category_id_value" value="<?php echo $this->_tpl_vars['category_id']; ?>
" />
   			<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['thisHotDeal']->id; ?>
" />
   			<input type="hidden" name="task" value="save" />
   		</td>
   	</tr>
   </tfoot>
</table>
</form>
<?php echo '
<script type="text/javascript">
$(function(){
	$(\'select[name=product_id]\').change(function(){
		var val = $(this).val();
		$("#feauture_product").load("ajax.php?task=feauture_product&product_id="+val);
	});
	$(\'input[name=chkFT]\').click(function(){
		var val = $(this).val();
		$("#feauture_product").load("ajax.php?task=feauture_product&product_id="+val);
	});
});
</script>
'; ?>

<?php else: ?>
<form name="adminForm" method="post" action="admin.hotdeal.php">
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
					<strong>Tên Hot Deal</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Sản phẩm</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Giá niêm yết</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Giá khuyến mãi</strong>
				</th>	
				<th class="title" nowrap="nowrap">
					<strong>Ngày hết hạn</strong>
				</th>
				<th width="15" nowrap="nowrap">
					<strong>Số lượng</strong>
				</th>
				<th width="15" nowrap="nowrap">
					<strong>Trạng thái</strong>
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
					<input type="checkbox" onclick="isChecked(this.checked);" value="<?php echo $this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['id']; ?>
" name="cid[]" id="cb<?php echo $this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['id']; ?>
">
				</td>
				<td>
					<a href="admin.hotdeal.php?task=edit&id=<?php echo $this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['title']; ?>
</a>
				</td>
				<td align="center">
					<?php echo $this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['name']; ?>

				</td>
				<td align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['price_ny'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 VNĐ</td>
				<td align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['price_hotdeal'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 VNĐ</td>
				<td align="left">
					<?php echo $this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['end_date']; ?>

				</td>
				<td align="center">
					<?php echo $this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['count']; ?>

				</td>
				<td align="center">
					<?php if ($this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['published'] == 1): ?>
						<a onclick="return listItemTask('cb<?php echo $this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['id']; ?>
','unpublish')" title="Ẩn đi">
						<img src="../images/publish_g.png" width="16" style="cursor:pointer" alt="Ẩn đi" border="0" />
						</a>
					<?php else: ?>
						<a onclick="return listItemTask('cb<?php echo $this->_tpl_vars['lsHotDeal'][$this->_sections['loops']['index']]['id']; ?>
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