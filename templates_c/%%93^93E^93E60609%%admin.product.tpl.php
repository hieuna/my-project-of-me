<?php /* Smarty version 2.6.10, created on 2012-02-23 18:23:00
         compiled from D:/AppServ/www/projects/templates/administrator/admin.product.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'D:/AppServ/www/projects/templates/administrator/admin.product.tpl', 370, false),)), $this); ?>
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
	   <div class="header product"><?php echo $this->_tpl_vars['page_title']; ?>
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
" method="post" name="adminForm" enctype="multipart/form-data">
<table class="adminTable">
	<tbody>
		<tr>
			<td width="45%" valign="top">
			<table class="adminTable adminBorder">
			   <tbody>
			   	<tr>
			   		<td colspan="2" class="title_box_tbl">Thông tin cơ bản</td>
			   	</tr>
			   	<tr>
			   		<td width="25%">Nhóm sản phẩm</td>
			   		<td>
			   		<select name="category_id" class="adm_selectbox">
			   			<?php if ($this->_tpl_vars['task'] == 'edit'): ?>
			   			<option value="<?php echo $this->_tpl_vars['thisBanner']->category_id; ?>
" selected="selected"><?php echo $this->_tpl_vars['name_category_banner']; ?>
</option>
			   			<?php else: ?>
			   			<option value="">Lựa chọn theo nhóm</option>
			   			<?php endif; ?>
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
			   			<option <?php if ($this->_tpl_vars['thisCategory']->category_id == $this->_tpl_vars['categorys'][$this->_sections['loops']['index']]['category_id'] || $this->_tpl_vars['category_id'] == $this->_tpl_vars['categorys'][$this->_sections['loops']['index']]['category_id']): ?> selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['category_id']; ?>
"><?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['name']; ?>
</option>
			   			<?php endfor; endif; ?>
			   		</select>
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>Mã sản phẩm</td>
			   		<td><input type="text" name="code" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisProduct']->code; ?>
" /></td>
			   	</tr>
			   	<tr>
			   		<td>Model</td>
			   		<td><input type="text" name="model" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisProduct']->model; ?>
" /></td>
			   	</tr>
			   	<tr>
			   		<td>Số lượng</td>
			   		<td><input type="text" name="amount" onkeypress="return shp.numberOnly(this, event);" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisProduct']->amount; ?>
" /></td>
			   	</tr>
			   	<tr>
			   		<td>Ảnh mô tả</td>
			   		<td><input type="file" name="img" size="28" class="adm_file" /></td>
			   	</tr>
			   	<tr>
			   		<td>Trọng lượng</td>
			   		<td><input type="text" name="model" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisProduct']->weight; ?>
" /></td>
			   	</tr>
			   	<tr>
			   		<td>Chiều dài</td>
			   		<td><input type="text" name="length" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisProduct']->length; ?>
" /></td>
			   	</tr>
			   	<tr>
			   		<td>Chiều rộng</td>
			   		<td><input type="text" name="width" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisProduct']->width; ?>
" /></td>
			   	</tr>
			   	<tr>
			   		<td>Chiều cao</td>
			   		<td><input type="text" name="height" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisProduct']->height; ?>
" /></td>
			   	</tr>
			   	<tr>
			   		<td>Ngày cập nhật</td>
			   		<td><input type="text" name="created" id="date" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisProduct']->created; ?>
" /></td>
			   	</tr>
			   		<tr>
			   		<td>Thứ tự</td>
			   		<td><input type="text" name="ordering" id="ordering" class="adm_inputbox small" value="<?php echo $this->_tpl_vars['thisProduct']->ordering; ?>
" /></td>
			   	</tr>
			   	<tr>
			   		<td>Trạng thái</td>
			   		<td><input type="checkbox" name="status" class="adm_chk" <?php if ($this->_tpl_vars['thisProduct']->status == 1): ?> checked="checked"<?php endif; ?> value="1" /> Hiển thị</td>
			   	</tr>
			   </tbody>
			</table>
			<table class="adminTable adminBorder">
			   <tbody>
			   	<tr>
			   		<td colspan="2" class="title_box_tbl">Thông tin về giá</td>
			   	</tr>
			   	<tr>
			   		<td>Giá niêm yết</td>
			   		<td><input type="text" name="price_ny" class="adm_inputbox" onkeypress="return shp.numberOnly(this, event);" value="<?php echo $this->_tpl_vars['thisProduct']->price_ny; ?>
" /></td>
			   	</tr>
			   	<tr>
			   		<td width="25%">Giá bán</td>
			   		<td><input type="text" name="price" class="adm_inputbox" onkeypress="return shp.numberOnly(this, event);" value="<?php echo $this->_tpl_vars['thisProduct']->price; ?>
" /></td>
			   	</tr>
			   	<tr>
			   		<td>Giảm giá</td>
			   		<td><input type="text" name="discount" class="adm_inputbox" onkeypress="return shp.numberOnly(this, event);" value="<?php echo $this->_tpl_vars['thisProduct']->discount; ?>
" /></td>
			   	</tr>
			   	<tr>
			   		<td>Giảm %</td>
			   		<td><input type="text" disabled="disabled" name="percent" class="adm_inputbox small" value="<?php echo $this->_tpl_vars['thisProduct']->percent; ?>
" /> (%)</td>
			   	</tr>
			   </tbody>
			</table>
			<table class="adminTable adminBorder">
			   <tbody>
			   	<tr>
			   		<td colspan="2" class="title_box_tbl">Thông tin về màu sắc</td>
			   	</tr>
			   	<tr>
			   		<td width="15%">Số màu</td>
			   		<td>
			   			<select name="number_color" id="color" class="adm_selectbox">
							<?php unset($this->_sections['foo']);
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['start'] = (int)1;
$this->_sections['foo']['loop'] = is_array($_loop=11) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foo']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['foo']['show'] = true;
$this->_sections['foo']['max'] = $this->_sections['foo']['loop'];
if ($this->_sections['foo']['start'] < 0)
    $this->_sections['foo']['start'] = max($this->_sections['foo']['step'] > 0 ? 0 : -1, $this->_sections['foo']['loop'] + $this->_sections['foo']['start']);
else
    $this->_sections['foo']['start'] = min($this->_sections['foo']['start'], $this->_sections['foo']['step'] > 0 ? $this->_sections['foo']['loop'] : $this->_sections['foo']['loop']-1);
if ($this->_sections['foo']['show']) {
    $this->_sections['foo']['total'] = min(ceil(($this->_sections['foo']['step'] > 0 ? $this->_sections['foo']['loop'] - $this->_sections['foo']['start'] : $this->_sections['foo']['start']+1)/abs($this->_sections['foo']['step'])), $this->_sections['foo']['max']);
    if ($this->_sections['foo']['total'] == 0)
        $this->_sections['foo']['show'] = false;
} else
    $this->_sections['foo']['total'] = 0;
if ($this->_sections['foo']['show']):

            for ($this->_sections['foo']['index'] = $this->_sections['foo']['start'], $this->_sections['foo']['iteration'] = 1;
                 $this->_sections['foo']['iteration'] <= $this->_sections['foo']['total'];
                 $this->_sections['foo']['index'] += $this->_sections['foo']['step'], $this->_sections['foo']['iteration']++):
$this->_sections['foo']['rownum'] = $this->_sections['foo']['iteration'];
$this->_sections['foo']['index_prev'] = $this->_sections['foo']['index'] - $this->_sections['foo']['step'];
$this->_sections['foo']['index_next'] = $this->_sections['foo']['index'] + $this->_sections['foo']['step'];
$this->_sections['foo']['first']      = ($this->_sections['foo']['iteration'] == 1);
$this->_sections['foo']['last']       = ($this->_sections['foo']['iteration'] == $this->_sections['foo']['total']);
?>
								<option value="<?php echo $this->_sections['foo']['index']; ?>
"><?php echo $this->_sections['foo']['index']; ?>
 màu sản phẩm</option>
							<?php endfor; endif; ?>
			   			</select>
			   		</td>
			   	</tr>
			   	<tr>
			   		<td valign="top"></td>
			   		<td>
			   			<div id="show_color">
			   			</div>
			   		</td>
			   	</tr>
			   </tbody>
			</table>
			</td>
			<td valign="top">
			<table class="adminTable adminBorder">
			   <tbody>
			   	<tr>
			   		<td class="title_box_tbl">Thông tin mô tả</td>
			   	</tr>
			   	<tr>
			   		<td>
			   			<b>Tên sản phẩm</b><br />
			   			<input type="text" name="name" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisProduct']->name; ?>
" />
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>
			   			<b>Bí danh</b><br />
			   			<input type="text" name="alias" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisProduct']->alias; ?>
" />
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>
			   			<b>Mô tả ngắn</b><br />
			   			<textarea cols="65" rows="5" name="introtext" id="wysiwyg"><?php echo $this->_tpl_vars['thisProduct']->introtext; ?>
</textarea>
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>
			   			<b>Mô tả chi tiết</b><br />
			   			<textarea cols="30" rows="5" id="fulltext" name="fulltext"><?php echo $this->_tpl_vars['thisProduct']->fulltext; ?>
</textarea>
			   			<a href="javascript:;" onclick="tinyMCE.get('elm1').show();return false;">[Show]</a>
						<a href="javascript:;" onclick="tinyMCE.get('elm1').hide();return false;">[Hide]</a>
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>
			   			<b>Từ khóa Meta</b><br />
			   			<textarea cols="50" rows="5" id="meta_keywords" name="meta_keywords"><?php echo $this->_tpl_vars['thisProduct']->meta_keywords; ?>
</textarea>
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>
			   			<b>Từ khóa mô tả</b><br />
			   			<textarea cols="50" rows="5" id="meta_description" name="meta_description"><?php echo $this->_tpl_vars['thisProduct']->meta_description; ?>
</textarea>
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>
			   			<b>Từ khóa tìm kiếm</b><br />
			   			<textarea cols="50" rows="5" id="search_words" name="search_words"><?php echo $this->_tpl_vars['thisProduct']->search_words; ?>
</textarea>
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>
			   			<b>Tiêu đề trang</b><br />
			   			<input type="text" name="page_title" class="adm_inputbox" value="<?php echo $this->_tpl_vars['thisProduct']->page_title; ?>
" />
			   		</td>
			   	</tr>
			   </tbody>
			   <tfoot>
			   	<tr>
			   		<td></td>
			   		<td>
			   			<input type="hidden" name="product_id_value" value="<?php echo $this->_tpl_vars['product_id']; ?>
" />
			   			<input type="hidden" name="product_id" value="<?php echo $this->_tpl_vars['thisProduct']->product_id; ?>
" />
			   			<input type="hidden" name="task" value="save" />
			   		</td>
			   	</tr>
			   </tfoot>
			</table>
			</td>
		</tr>
	</tbody>
</table>
</form>
<script>
<?php echo '
$(function(){
	$(\'#color\').change(function(){
		var value = $(\'#color\').val();
		$("#show_color").load("ajax.php?task=addcolor&number="+value);
	});
});
'; ?>

</script>
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
					<strong>Tên sản phẩm</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Mã</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Model</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Giá niêm yết</strong>
				</th>	
				<th class="title" nowrap="nowrap">
					<strong>Giá bán</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Số lượng</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Số màu</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Ngày tạo</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Người tạo</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Ngày cập nhật</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Người cập nhật</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Nhóm sản phẩm</strong>
				</th>
				<th width="15" nowrap="nowrap">
					<strong>Trạng thái</strong>
				</th>
			</tr>
		</thead>
		<tbody>
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
			<tr class="row<?php if ($this->_sections['loops']['index']%2 == 0): ?>0<?php else: ?>1<?php endif; ?>">
				<td><?php echo $this->_sections['loops']['index']+1; ?>
</td>
				<td align="center">
					<input type="checkbox" onclick="isChecked(this.checked);" value="<?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['product_id']; ?>
" name="cid[]" id="cb<?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['product_id']; ?>
">
				</td>
				<td>
					<a href="<?php echo $this->_tpl_vars['page']; ?>
?task=edit&product_id=<?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['product_id']; ?>
"><?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['name']; ?>
</a>
				</td>
				<td align="center"><?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['code']; ?>
</td>
				<td align="center"><?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['model']; ?>
</td>
				<td align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['price_ny'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 VNĐ</td>
				<td align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 VNĐ</td>
				<td align="center"><?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['amount']; ?>
</td>
				<td align="center"><?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['number_color']; ?>
</td>
				<td align="center"><?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['created']; ?>
</td>
				<td align="center"><?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['name_created']; ?>
</td>
				<td align="center"><?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['modified']; ?>
</td>
				<td align="center"><?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['admin_modified']; ?>
</td>
				<td align="center"><?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['name_category']; ?>
</td>
				<td align="center">
					<?php if ($this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['status'] == 1): ?>
						<a onclick="return listItemTask('cb<?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['product_id']; ?>
','unpublish')" title="Ẩn đi">
						<img src="../images/publish_g.png" width="16" style="cursor:pointer" alt="Ẩn đi" border="0" />
						</a>
					<?php else: ?>
						<a onclick="return listItemTask('cb<?php echo $this->_tpl_vars['lsProducts'][$this->_sections['loops']['index']]['product_id']; ?>
','publish')" title="Hiển thị">
						<img src="../images/publish_x.png" width="16" style="cursor:pointer" alt="Hiển thị" border="0" />
						</a>
					<?php endif; ?>
				</td>
			</tr>
			<?php endfor; else: ?>
			<tr>
				<td colspan="15" align="center"><font color="red">Không tồn tại bản ghi nào thỏa mãn điều kiện tìm kiếm!</font></td>
			</tr>
			<?php endif; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="15">
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