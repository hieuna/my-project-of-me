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
	   <div class="header hotdeal">{$page_title}</div>
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
   		<td width="20%">Nhóm sản phẩm</td>
   		<td width="80%">
   		<select name="category_id" class="adm_selectbox" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
   			{if $task=="edit"}
   			<option value="{$thisBanner->category_id}" selected="selected">{$name_category_banner}</option>
   			{else}
   			<option value="">Lựa chọn theo nhóm</option>
   			{/if}
   			{section name=loops loop=$categorys}
   			<option {if $thisHotDeal->category_id==$categorys[loops].category_id || $category_id==$categorys[loops].category_id} selected="selected"{/if} value="admin.hotdeal.php?task={$task}&id={$thisHotDeal->id}&category_id={$categorys[loops].category_id}">{$categorys[loops].name}</option>
   			{/section}
   		</select>
   		</td>
   	</tr>
   	<tr>
   		<td valign="top">Chọn sản phẩm</td>
   		<td>
   		<select name="product_id" class="adm_selectbox">
   			<option value="">Lựa chọn sản phẩm</option>
   			{section name=loops loop=$products}
   			<option {if $thisHotDeal->product_id==$products[loops].product_id}selected="selected"{/if} value="{$products[loops].product_id}">{$products[loops].name} - {$products[loops].price|number_format} VNĐ</option>
   			{/section}
   		</select>
   		<div id="feauture_product" style="margin:10px 0; padding:10px;">
   			<select name="feauture[]" multiple="multiple" style="width:250px; height:200px;">
   			{foreach from=$thisHotDeal->feauture item=foo}
			    <option value="{$foo}">{$foo}</option>
			{/foreach}
   			</select>
   		</div>
   		{if $thisHotDeal->feauture}
   		<input type="checkbox" value="{$thisHotDeal->product_id}" name="chkFT" /> Chọn tính năng khác
   		{/if}
   		</td>
   	</tr>
   	<tr>
   		<td>Giá niêm yết</td>
   		<td><input type="text" name="price_ny" class="adm_inputbox" value="{$thisHotDeal->price_ny}" /></td>
   	</tr>
   	<tr>
   		<td>Giá khuyến mại</td>
   		<td><input type="text" name="price_hotdeal" class="adm_inputbox" value="{$thisHotDeal->price_hotdeal}" /></td>
   	</tr>
   	<tr>
   		<td>Mức giảm</td>
   		<td><input type="text" name="discount" class="adm_inputbox" value="{$thisHotDeal->discount}" disabled="disabled" /> (%)</td>
   	</tr>
   	<tr>
   		<td>Tiêu đề Hot Deal</td>
   		<td><input type="text" name="title" class="adm_inputbox" value="{$thisHotDeal->title}" /></td>
   	</tr>
   	<tr>
   		<td>Mô tả Hot Deal</td>
   		<td><textarea cols="30" rows="5" name="description">{$thisHotDeal->description}</textarea></td>
   	</tr>
   	<tr>
   		<td>Số lượng sản phẩm</td>
   		<td><input type="text" name="count" class="adm_inputbox" value="{$thisHotDeal->count}" /></td>
   	</tr>
   	<tr>
   		<td>Tên tính năng</td>
   		<td><input type="text" name="title_feauture" class="adm_inputbox" value="{$thisHotDeal->title_feauture}" /></td>
   	</tr>
   	<tr>
   		<td valign="top">Ảnh tính năng</td>
   		<td valign="top">
   			<div style="widtd:100%; margin: 10px 0;">
   				<img src="{$http_root}{$thisHotDeal->image}" width="150" border="0" />
   			</div>
   			<input type="file" name="img" size="25" class="adm_inputbox" value="" />
   		</td>
   	</tr>
   	<tr>
   		<td>Ngày cập nhật</td>
   		<td><input type="text" name="start_date" id="start_date" class="adm_inputbox" value="{$thisHotDeal->start_date}" /></td>
   	</tr>
   	<tr>
   		<td>Ngày kết thúc</td>
   		<td><input type="text" name="end_date" id="end_date" class="adm_inputbox" value="{$thisHotDeal->end_date}" /></td>
   	</tr>
   	<tr>
   		<td>Tên người liên hệ</td>
   		<td><input type="text" name="ct_name" class="adm_inputbox" value="{$thisHotDeal->ct_name}" /></td>
   	</tr>
   	<tr>
   		<td>Điện thoại liên hệ</td>
   		<td><input type="text" name="ct_phone" class="adm_inputbox" value="{$thisHotDeal->ct_phone}" /></td>
   	</tr>
   	<tr>
   		<td>Yahoo liên hệ</td>
   		<td><input type="text" name="ct_yahoo" class="adm_inputbox" value="{$thisHotDeal->ct_yahoo}" /></td>
   	</tr>
   	<tr>
   		<td>Skype liên hệ</td>
   		<td><input type="text" name="ct_skype" class="adm_inputbox" value="{$thisHotDeal->ct_skype}" /></td>
   	</tr>
   	<tr>
   		<td>Trạng thái</td>
   		<td><input type="checkbox" name="published" class="adm_chk" {if $thisHotDeal->published == 1} checked="checked"{/if} value="1" /> Hiển thị</td>
   	</tr>
   </tbody>
   <tfoot>
   	<tr>
   		<td></td>
   		<td>
   			<input type="hidden" name="category_id_value" value="{$category_id}" />
   			<input type="hidden" name="id" value="{$thisHotDeal->id}" />
   			<input type="hidden" name="task" value="save" />
   		</td>
   	</tr>
   </tfoot>
</table>
</form>
{literal}
<script type="text/javascript">
$(function(){
	$('select[name=product_id]').change(function(){
		var val = $(this).val();
		$("#feauture_product").load("ajax.php?task=feauture_product&product_id="+val);
	});
	$('input[name=chkFT]').click(function(){
		var val = $(this).val();
		$("#feauture_product").load("ajax.php?task=feauture_product&product_id="+val);
	});
});
</script>
{/literal}
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
			{section name=loops loop=$lsHotDeal}
			<tr class="row{if $smarty.section.loops.index%2==0}0{else}1{/if}">
				<td>{$smarty.section.loops.index+1}</td>
				<td align="center">
					<input type="checkbox" onclick="isChecked(this.checked);" value="{$lsHotDeal[loops].id}" name="cid[]" id="cb{$lsHotDeal[loops].id}">
				</td>
				<td>
					<a href="{$page}?task=edit&id={$lsHotDeal[loops].id}">{$lsHotDeal[loops].title}</a>
				</td>
				<td align="center">
					{$lsHotDeal[loops].name}
				</td>
				<td align="center">{$lsHotDeal[loops].price_ny|number_format} VNĐ</td>
				<td align="center">{$lsHotDeal[loops].price_hotdeal|number_format} VNĐ</td>
				<td align="left">
					{$lsHotDeal[loops].end_date}
				</td>
				<td align="center">
					{$lsHotDeal[loops].count}
				</td>
				<td align="center">
					{if $lsHotDeal[loops].published == 1}
						<a onclick="return listItemTask('cb{$lsHotDeal[loops].id}','unpublish')" title="Ẩn đi">
						<img src="../images/publish_g.png" width="16" style="cursor:pointer" alt="Ẩn đi" border="0" />
						</a>
					{else}
						<a onclick="return listItemTask('cb{$lsHotDeal[loops].id}','publish')" title="Hiển thị">
						<img src="../images/publish_x.png" width="16" style="cursor:pointer" alt="Hiển thị" border="0" />
						</a>
						<a href="{$page}?task=refresh&id={$lsHotDeal[loops].id}" title="Làm mới">
						<img src="../images/Refresh-icon.png" width="16" style="cursor:pointer" alt="Làm mới" border="0" />
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