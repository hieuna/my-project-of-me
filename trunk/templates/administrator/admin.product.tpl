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
	   					{if $task == "add" || $task == "edit"}
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
	   					{else}
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
	   					{/if}
	   				</tr>
	   			</tbody>
	   		</table>
	   </div>
	   <div class="header product">{$page_title}</div>
	   <div class="clr"></div>
   </div>
   <div class="b">
   		<div class="b">
   			<div class="b"></div>
   		</div>
   </div>
   {if $mosmsg}<div class="message">{$mosmsg}</div>{/if}
</div>
{if $task == "add" || $task == "edit"}
<form action="{$page}" method="post" name="adminForm" enctype="multipart/form-data">
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
			   		<td width="20%">Nhóm sản phẩm</td>
			   		<td width="80%">
			   		<select name="category_id" class="adm_selectbox" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
			   			{if $task=="edit"}
			   			<option value="{$thisBanner->category_id}" selected="selected">{$name_category_banner}</option>
			   			{else}
			   			<option value="">Lựa chọn theo nhóm</option>
			   			{/if}
			   			{section name=loops loop=$categorys}
			   			<option {if $thisCategory->category_id==$categorys[loops].category_id || $category_id==$categorys[loops].category_id} selected="selected"{/if} value="admin.hotdeal.php?task={$task}&id={$thisCategory->id}&category_id={$categorys[loops].category_id}">{$categorys[loops].name}</option>
			   			{/section}
			   		</select>
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>Mã sản phẩm</td>
			   		<td><input type="text" name="code" class="adm_inputbox" value="{$thisCategory->code}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Model</td>
			   		<td><input type="text" name="model" class="adm_inputbox" value="{$thisCategory->model}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Giá bán</td>
			   		<td><input type="text" name="price" class="adm_inputbox" value="{$thisCategory->price}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Giá niêm yết</td>
			   		<td><input type="text" name="price_ny" class="adm_inputbox" value="{$thisCategory->price_ny}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Số lượng</td>
			   		<td><input type="text" name="amount" class="adm_inputbox" value="{$thisCategory->amount}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Trọng lượng</td>
			   		<td><input type="text" name="model" class="adm_inputbox" value="{$thisCategory->weight}" /> (g)</td>
			   	</tr>
			   	<tr>
			   		<td>Chiều dài</td>
			   		<td><input type="text" name="length" class="adm_inputbox" value="{$thisCategory->length}" /> (cm)</td>
			   	</tr>
			   	<tr>
			   		<td>Chiều rộng</td>
			   		<td><input type="text" name="width" class="adm_inputbox" value="{$thisCategory->width}" /> (cm)</td>
			   	</tr>
			   	<tr>
			   		<td>Chiều cao</td>
			   		<td><input type="text" name="height" class="adm_inputbox" value="{$thisCategory->height}" /> (cm)</td>
			   	</tr>
			   	<tr>
			   		<td>Ngày cập nhật</td>
			   		<td><input type="text" name="created" id="created" class="adm_inputbox" value="{$thisCategory->created}" /></td>
			   	</tr>
			   		<tr>
			   		<td>Thứ tự</td>
			   		<td><input type="text" name="ordering" id="ordering" class="adm_inputbox small" value="{$thisCategory->ordering}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Trạng thái</td>
			   		<td><input type="checkbox" name="status" class="adm_chk" {if $thisCategory->status == 1} checked="checked"{/if} value="1" /> Hiển thị</td>
			   	</tr>
			   </tbody>
			</table>
			</td>
			<td valign="top">
			<table class="adminTable adminBorder">
			   <tbody>
			   	<tr>
			   		<td colspan="2" class="title_box_tbl">Thông tin mô tả</td>
			   	</tr>
			   	<tr>
			   		<td>Tên sản phẩm</td>
			   		<td><input type="text" name="name" class="adm_inputbox" value="{$thisCategory->name}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Bí danh</td>
			   		<td><input type="text" name="alias" class="adm_inputbox" value="{$thisCategory->alias}" /></td>
			   	</tr>
			   	<tr>
			   		<td valign="top">Mô tả ngắn</td>
			   		<td><textarea cols="50" rows="5" name="introtext" id="wysiwyg">{$thisCategory->introtext}</textarea></td>
			   	</tr>
			   	<tr>
			   		<td valign="top">Mô tả chi tiết</td>
			   		<td>
			   			<textarea cols="30" rows="5" id="fulltext" name="fulltext">{$thisCategory->fulltext}</textarea>
			   			<a href="javascript:;" onclick="tinyMCE.get('elm1').show();return false;">[Show]</a>
						<a href="javascript:;" onclick="tinyMCE.get('elm1').hide();return false;">[Hide]</a>
			   		</td>
			   	</tr>
			   	<tr>
			   		<td valign="top">Từ khóa Meta</td>
			   		<td><textarea cols="50" rows="5" name="meta_keywords">{$thisCategory->meta_keywords}</textarea></td>
			   	</tr>
			   	<tr>
			   		<td valign="top">Từ khóa mô tả</td>
			   		<td><textarea cols="50" rows="5" name="meta_description">{$thisCategory->meta_description}</textarea></td>
			   	</tr>
			   	<tr>
			   		<td valign="top">Từ khóa tìm kiếm</td>
			   		<td><textarea cols="50" rows="5" name="search_words">{$thisCategory->search_words}</textarea></td>
			   	</tr>
			   	<tr>
			   		<td>Tiêu đề trang</td>
			   		<td><input type="text" name="alias" class="adm_inputbox" value="{$thisCategory->alias}" /></td>
			   	</tr>
			   </tbody>
			   <tfoot>
			   	<tr>
			   		<td></td>
			   		<td>
			   			<input type="hidden" name="category_id_value" value="{$category_id}" />
			   			<input type="hidden" name="category_id" value="{$thisCategory->category_id}" />
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
{else}
<form name="adminForm" method="post" action="{$page}">
	<table style="margin-bottom:5px;">
		<tbody>
			<tr>
				<td width="100%" align="left">
					Bộ lọc:
					<input type="text" title="Lọc theo tên hotdeal" onchange="document.adminForm.submit();" class="text_area" size="40" value="{$search}" id="search" name="search" />
					<button onclick="this.form.submit();">Go</button>
					<button onclick="document.getElementById('search').value='';document.getElementById('filter_status').value=3;document.getElementById('limit').value='50';document.adminForm.p.value=1;">Reset</button>
				</td>
				<td nowrap="nowrap">
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_status" name="filter_status">
						<option {if $filter_status==3}selected="selected"{/if} value="3">- Trạng thái -</option>
						<option {if $filter_status==1}selected="selected"{/if} value="1">Đang hoạt động</option>
						<option {if $filter_status==0}selected="selected"{/if} value="0">Không hoạt động</option>
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
					<strong>Bí danh</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Parent ID</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Số sản phẩm</strong>
				</th>	
				<th class="title" nowrap="nowrap">
					<strong>Người tạo</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Ngày tạo</strong>
				</th>
				<th width="15" nowrap="nowrap">
					<strong>Trạng thái</strong>
				</th>
			</tr>
		</thead>
		<tbody>
			{section name=loops loop=$lsCategory}
			<tr class="row{if $smarty.section.loops.index%2==0}0{else}1{/if}">
				<td>{$smarty.section.loops.index+1}</td>
				<td align="center">
					<input type="checkbox" onclick="isChecked(this.checked);" value="{$lsCategory[loops].category_id}" name="cid[]" id="cb{$lsCategory[loops].category_id}">
				</td>
				<td>
					<a href="{$page}?task=edit&category_id={$lsCategory[loops].category_id}">{$lsCategory[loops].name}</a>
				</td>
				<td align="center">{$lsCategory[loops].alias}</td>
				<td align="center">{$lsCategory[loops].parent_id}</td>
				<td align="center">{$lsCategory[loops].product_count}</td>
				<td align="center">
					{$lsCategory[loops].name_created}
				</td>
				<td align="center">
					{$lsCategory[loops].created}
				</td>
				<td align="center">
					{if $lsCategory[loops].status == 1}
						<a onclick="return listItemTask('cb{$lsCategory[loops].category_id}','unpublish')" title="Ẩn đi">
						<img src="../images/publish_g.png" width="16" style="cursor:pointer" alt="Ẩn đi" border="0" />
						</a>
					{else}
						<a onclick="return listItemTask('cb{$lsCategory[loops].category_id}','publish')" title="Hiển thị">
						<img src="../images/publish_x.png" width="16" style="cursor:pointer" alt="Hiển thị" border="0" />
						</a>
					{/if}
				</td>
			</tr>
			{sectionelse}
			<tr>
				<td colspan="9" align="center"><font color="red">Không tồn tại bản ghi nào thỏa mãn điều kiện tìm kiếm!</font></td>
			</tr>
			{/section}
		</tbody>
		<tfoot>
			<tr>
				<td colspan="9">
					{$datapage}
				</td>
			</tr>
		</tfoot>
	</table>
	
	<input type="hidden" value="{$task}" name="task">
	<input type="hidden" value="" name="boxchecked">
	<input type="hidden" value="{$total_record}" name="total_record" id="total_record" />
</form>
{/if}