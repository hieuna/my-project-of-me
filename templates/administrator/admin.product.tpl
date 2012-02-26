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
<form action="{$page}" method="post" name="adminForm" class="form-validate" enctype="multipart/form-data">
<table class="adminTable">
	<tbody>
		<tr>
			<td width="45%" valign="top">
			<!-- BASIC -->
			<table class="adminTable adminBorder">
			   <tbody>
			   	<tr>
			   		<td colspan="2" class="title_box_tbl">Thông tin cơ bản</td>
			   	</tr>
			   	<tr>
			   		<td width="25%">Nhóm sản phẩm</td>
			   		<td>
			   		<select name="category_id" class="adm_selectbox">
			   			<option value="">Lựa chọn theo nhóm</option>
			   			{section name=loops loop=$lsCategory}
			   			<option {if $thisProduct->category_id==$lsCategory[loops].category_id} selected="selected"{/if} value="{$lsCategory[loops].category_id}">{$lsCategory[loops].name}</option>
			   			{/section}
			   		</select>
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>Mã sản phẩm</td>
			   		<td><input type="text" name="code" class="adm_inputbox required" value="{$thisProduct->code}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Model</td>
			   		<td><input type="text" name="model" class="adm_inputbox" value="{$thisProduct->model}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Số lượng</td>
			   		<td><input type="text" name="amount" onkeypress="return shp.numberOnly(this, event);" class="adm_inputbox" value="{$thisProduct->amount}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Trọng lượng</td>
			   		<td><input type="text" name="model" class="adm_inputbox" value="{$thisProduct->weight}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Chiều dài</td>
			   		<td><input type="text" name="length" class="adm_inputbox" value="{$thisProduct->length}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Chiều rộng</td>
			   		<td><input type="text" name="width" class="adm_inputbox" value="{$thisProduct->width}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Chiều cao</td>
			   		<td><input type="text" name="height" class="adm_inputbox" value="{$thisProduct->height}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Ngày cập nhật</td>
			   		<td><input type="text" name="created" id="date" class="adm_inputbox" value="{$thisProduct->created}" /></td>
			   	</tr>
			   		<tr>
			   		<td>Thứ tự</td>
			   		<td><input type="text" name="ordering" id="ordering" class="adm_inputbox small" value="{$thisProduct->ordering}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Trạng thái</td>
			   		<td><input type="checkbox" name="status" class="adm_chk" {if $thisProduct->status == 1} checked="checked"{/if} value="1" /> Hiển thị</td>
			   	</tr>
			   </tbody>
			</table>
			<!-- PRICE -->
			<table class="adminTable adminBorder">
			   <tbody>
			   	<tr>
			   		<td colspan="2" class="title_box_tbl">Thông tin về giá</td>
			   	</tr>
			   	<tr>
			   		<td>Giá niêm yết</td>
			   		<td><input type="text" name="price_ny" class="adm_inputbox required" onkeypress="return shp.numberOnly(this, event);" value="{$thisProduct->price_ny}" /></td>
			   	</tr>
			   	<tr>
			   		<td width="25%">Giá bán</td>
			   		<td><input type="text" name="price" class="adm_inputbox required" onkeypress="return shp.numberOnly(this, event);" value="{$thisProduct->price}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Giảm giá</td>
			   		<td><input type="text" name="discount" class="adm_inputbox" onkeypress="return shp.numberOnly(this, event);" value="{$thisProduct->discount}" /></td>
			   	</tr>
			   	<tr>
			   		<td>Giảm %</td>
			   		<td><input type="text" disabled="disabled" name="percent" class="adm_inputbox small" value="{$thisProduct->percent}" /> (%)</td>
			   	</tr>
			   </tbody>
			</table>
			<!-- COLOR -->
			<table class="adminTable adminBorder">
			   <tbody>
			   	<tr>
			   		<td colspan="2" class="title_box_tbl">Thông tin về màu sắc</td>
			   	</tr>
			   	<tr>
			   		<td width="15%">Số màu</td>
			   		<td>
			   			<select name="number_color" id="color" class="adm_selectbox">
							{section name=foo start=1 loop=11 step=1}
								<option value="{$smarty.section.foo.index}"{if $thisProduct->number_color==$smarty.section.foo.index} selected="selected"{/if}}>{$smarty.section.foo.index} màu sản phẩm</option>
							{/section}
			   			</select>
			   		</td>
			   	</tr>
			   	<tr>
			   		<td valign="top"></td>
			   		<td>
			   			<div id="show_color">
			   			{foreach from=$thisProduct->colors key=k item=color}
			   			<p style="margin:10px 0;">
							<label>Chọn màu: </label><input type="text" maxlength="6" name="colors_{$k}" size="6" class="colorpickerField adm_inputbox medium" value="{$color.value_color}" />
							<label>Giá: </label><input type="text" name="price_color_{$k}" class="adm_inputbox medium" onkeypress="return shp.numberOnly(this, event);" value="{$color.price_color}" />
						</p>
			   			{/foreach}
			   			</div>
			   		</td>
			   	</tr>
			   </tbody>
			</table>
			<!-- IMAGE -->
			<table class="adminTable adminBorder">
			   <tbody>
			   	<tr>
			   		<td colspan="3" class="title_box_tbl">Thông tin về hình ảnh</td>
			   	</tr>
			   	<tr>
			   		<td valign="top">
				   		<div class="image_box">
				   			{if $thisProduct->image1 !=""}
			   				<img src="{$http_root}{$thisProduct->image1}" width="100" border="0" />
			   				{/if}
			   			</div>
				   		<input type="file" name="img" size="10" class="adm_file" />
			   		</td>
			   		<td valign="top">
				   		<div class="image_box">
				   			{if $thisProduct->image2 !=""}
			   				<img src="{$http_root}{$thisProduct->image2}" width="100" border="0" />
			   				{/if}
			   			</div>
				   		<input type="file" name="img2" size="10" class="adm_file" />
			   		</td>
			   		<td valign="top">
				   		<div class="image_box">
				   			{if $thisProduct->image3 !=""}
			   				<img src="{$http_root}{$thisProduct->image3}" width="100" border="0" />
			   				{/if}
			   			</div>
				   		<input type="file" name="img3" size="10" class="adm_file" />
			   		</td>
			   	</tr>
			   	<tr>
			   		<td valign="top">
				   		<div class="image_box">
				   			{if $thisProduct->image4 !=""}
			   				<img src="{$http_root}{$thisProduct->image4}" width="100" border="0" />
			   				{/if}
			   			</div>
				   		<input type="file" name="img4" size="10" class="adm_file" />
			   		</td>
			   		<td valign="top">
				   		<div class="image_box">
				   			{if $thisProduct->image5 !=""}
			   				<img src="{$http_root}{$thisProduct->image5}" width="100" border="0" />
			   				{/if}
			   			</div>
				   		<input type="file" name="img5" size="10" class="adm_file" />
			   		</td>
			   		<td></td>
			   	</tr>
			   </tbody>
			</table>
			</td>
			<td valign="top">
			<!-- DESCIPTION -->
			<table class="adminTable adminBorder">
			   <tbody>
			   	<tr>
			   		<td class="title_box_tbl">Thông tin mô tả</td>
			   	</tr>
			   	<tr>
			   		<td>
			   			<b>Tên sản phẩm</b><br />
			   			<input type="text" name="name" class="adm_inputbox required" value="{$thisProduct->name}" />
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>
			   			<b>Bí danh</b><br />
			   			<input type="text" name="alias" class="adm_inputbox" value="{$thisProduct->alias}" />
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>
			   			<b>Mô tả ngắn</b><br />
			   			<textarea cols="65" rows="5" name="introtext" id="wysiwyg">{$thisProduct->introtext}</textarea>
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>
			   			<b>Mô tả chi tiết</b><br />
			   			<textarea cols="30" rows="5" id="fulltext" name="fulltext">{$thisProduct->fulltext}</textarea>
			   			<a href="javascript:;" onclick="tinyMCE.get('elm1').show();return false;">[Show]</a>
						<a href="javascript:;" onclick="tinyMCE.get('elm1').hide();return false;">[Hide]</a>
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>
			   			<b>Từ khóa Meta</b><br />
			   			<textarea cols="50" rows="5" id="meta_keywords" name="meta_keywords">{$thisProduct->meta_keywords}</textarea>
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>
			   			<b>Từ khóa mô tả</b><br />
			   			<textarea cols="50" rows="5" id="meta_description" name="meta_description">{$thisProduct->meta_description}</textarea>
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>
			   			<b>Từ khóa tìm kiếm</b><br />
			   			<textarea cols="50" rows="5" id="search_words" name="search_words">{$thisProduct->search_words}</textarea>
			   		</td>
			   	</tr>
			   	<tr>
			   		<td>
			   			<b>Tiêu đề trang</b><br />
			   			<input type="text" name="page_title" class="adm_inputbox" value="{$thisProduct->page_title}" />
			   		</td>
			   	</tr>
			   </tbody>
			   <tfoot>
			   	<tr>
			   		<td></td>
			   		<td>
			   			<input type="hidden" name="product_id_value" value="{$product_id}" />
			   			<input type="hidden" name="product_id" value="{$thisProduct->product_id}" />
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
{literal}
$(function(){
	$('#color').change(function(){
		var value = $('#color').val();
		$("#show_color").load("ajax.php?task=addcolor&number="+value);
	});
});
{/literal}
</script>
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
			{section name=loops loop=$lsProducts}
			<tr class="row{if $smarty.section.loops.index%2==0}0{else}1{/if}">
				<td>{$smarty.section.loops.index+1}</td>
				<td align="center">
					<input type="checkbox" onclick="isChecked(this.checked);" value="{$lsProducts[loops].product_id}" name="cid[]" id="cb{$lsProducts[loops].product_id}">
				</td>
				<td>
					<a href="{$page}?task=edit&product_id={$lsProducts[loops].product_id}">{$lsProducts[loops].name}</a>
				</td>
				<td align="center"><a href="{$page}?task=edit&product_id={$lsProducts[loops].product_id}">{$lsProducts[loops].code}</a></td>
				<td align="center"><a href="{$page}?task=edit&product_id={$lsProducts[loops].product_id}">{$lsProducts[loops].model}</a></td>
				<td align="center">{$lsProducts[loops].price_ny|number_format} VNĐ</td>
				<td align="center">{$lsProducts[loops].price|number_format} VNĐ</td>
				<td align="center">{$lsProducts[loops].amount}</td>
				<td align="center">{$lsProducts[loops].number_color}</td>
				<td align="center">{$lsProducts[loops].created}</td>
				<td align="center">{$lsProducts[loops].name_created}</td>
				<td align="center">{$lsProducts[loops].modified}</td>
				<td align="center">{$lsProducts[loops].admin_modified}</td>
				<td align="center">{$lsProducts[loops].name_category}</td>
				<td align="center">
					{if $lsProducts[loops].status == 1}
						<a onclick="return listItemTask('cb{$lsProducts[loops].product_id}','unpublish')" title="Ẩn đi">
						<img src="../images/publish_g.png" width="16" style="cursor:pointer" alt="Ẩn đi" border="0" />
						</a>
					{else}
						<a onclick="return listItemTask('cb{$lsProducts[loops].product_id}','publish')" title="Hiển thị">
						<img src="../images/publish_x.png" width="16" style="cursor:pointer" alt="Hiển thị" border="0" />
						</a>
					{/if}
				</td>
			</tr>
			{sectionelse}
			<tr>
				<td colspan="15" align="center"><font color="red">Không tồn tại bản ghi nào thỏa mãn điều kiện tìm kiếm!</font></td>
			</tr>
			{/section}
		</tbody>
		<tfoot>
			<tr>
				<td colspan="15">
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