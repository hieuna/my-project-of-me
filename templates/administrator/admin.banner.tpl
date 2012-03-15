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
	   <div class="header banner">{$page_title}</div>
	   <div class="clr"></div>
   </div>
   <div class="b">
   		<div class="b">
   			<div class="b"></div>
   		</div>
   </div>
   {if $is_message}<div class="message">{$is_message}</div>{/if}
</div>
{if $task == "add" || $task == "edit"}
<form action="{$page}" method="post" name="adminForm" enctype="multipart/form-data" id="frmValidate" class="form-validate">
{$error}
<table class="adminTable">
   <tbody>
   	<tr>
   		<td width="20%">Chọn website</td>
   		<td width="80%">
   		<select name="banner_web" class="adm_selectbox">
   			<option value="1"{if $thisBanner->banner_web==1} selected="selected"{/if}>Website Xtech.vn</option>
   			<option value="2"{if $thisBanner->banner_web==2} selected="selected"{/if}>Topup</option>
   		</select>
   		</td>
   	</tr>
   	<tr>
   		<td>Nhóm sản phẩm</td>
   		<td>
   		<select name="category_id" class="adm_selectbox" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
   			{if $task=="edit"}
   			<option value="{$thisBanner->category_id}" selected="selected">{$name_category_banner}</option>
   			{else}
   			<option value="">Lựa chọn theo nhóm</option>
   			{/if}
   			{section name=loops loop=$categorys}
   			<option {if $category_id==$categorys[loops].category_id} selected="selected"{/if} value="admin.banner.php?task={$task}&banner_id={$banner_id}&category_id={$categorys[loops].category_id}">{$categorys[loops].name}</option>
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
   			<option {if $thisBanner->product_id==$products[loops].product_id || $product_id==$products[loops].product_id}selected="selected"{/if} value="{$products[loops].product_id}">{$products[loops].name} - {$products[loops].price|number_format} VNĐ</option>
   			{/section}
   		</select>
   		</td>
   	</tr>
   	<tr id="topup_row">
   		<td valign="top">Ảnh topup</td>
   		<td valign="top">
   			{if $thisBanner->banner_topup!=""}
   			<div style="widtd:100%; margin: 10px 0;">
   				<img src="{$http_root}{$thisBanner->banner_topup}" width="500" border="0" />
   			</div>
   			{/if}
   			<input type="file" name="topup" size="25" class="adm_inputbox" value="" />
   		</td>
   	</tr>
   	<tr>
   		<td valign="top">Ảnh hiển thị</td>
   		<td valign="top">
   			{if $thisBanner->banner_image!=""}
   			<div style="widtd:100%; margin: 10px 0;">
   				<img src="{$http_root}{$thisBanner->banner_image}" width="760" border="0" />
   			</div>
   			{/if}
   			<input type="file" name="image" size="25" class="adm_inputbox" value="" />
   		</td>
   	</tr>
   	<tr>
   		<td>Ngày cập nhật</td>
   		<td><input type="text" name="banner_create" id="start_date" class="adm_inputbox" value="{$thisBanner->banner_create}" /></td>
   	</tr>
   	<tr>
   		<td>Link liên kết</td>
   		<td><input type="text" name="banner_url" class="adm_inputbox" value="{$thisBanner->banner_url}" /></td>
   	</tr>
   	<tr>
   		<td>Trang hiển thị</td>
   		<td><input type="text" name="banner_page" class="adm_inputbox" value="{$thisBanner->banner_page}" /></td>
   	</tr>
   	<tr>
   		<td>Vị trí</td>
   		<td><input type="text" name="banner_position" class="adm_inputbox" value="{$thisBanner->banner_position}" /></td>
   	</tr>
   	<tr>
   		<td>Tiêu đề</td>
   		<td><input type="text" name="banner_title" class="adm_inputbox required" value="{$thisBanner->banner_title}" /></td>
   	</tr>
   	<tr>
   		<td valign="top">Mô tả </td>
   		<td><textarea cols="50" rows="5" name="banner_description">{$thisBanner->banner_description}</textarea></td>
   	</tr>
   	<tr>
   		<td>Trạng thái</td>
   		<td><input type="checkbox" name="banner_status" class="adm_chk" {if $thisBanner->banner_status == 1} checked="checked"{/if} value="1" /> Hiển thị</td>
   	</tr>
   </tbody>
   <tfoot>
   	<tr>
   		<td></td>
   		<td>
   			<input type="hidden" name="category_id_value" value="{$category_id}" />
   			<input type="hidden" name="banner_id" value="{$thisBanner->banner_id}" />
   			<input type="hidden" name="task" value="save" />
   		</td>
   	</tr>
   </tfoot>
</table>
</form>
{literal}
<script>
$(function(){
	$('form#frmValidate').validate();
	{/literal}
	{if $thisBanner->banner_web == 2}
		{literal}
		$('#topup_row').show();
		{/literal}
	{else}
		{literal}
		$('#topup_row').hide();
		{/literal}
	{/if}
	{literal}	
	$('select[name=banner_web]').change(function(){
		var value = $('select[name=banner_web]').val();
		if (value == 2) $('#topup_row').show();
		else $('#topup_row').hide();
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
					<input type="text" title="Lọc theo tiêu đề banner" onchange="document.adminForm.submit();" class="text_area" size="40" value="{$search}" id="search" name="search" />
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
					<strong>Tên Banner</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Website</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Trang hiển thị</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Vị trí</strong>
				</th>	
				<th class="title" nowrap="nowrap">
					<strong>Ngày tạo</strong>
				</th>
				<th width="15" nowrap="nowrap">
					<strong>Số click</strong>
				</th>
				<th width="15" nowrap="nowrap">
					<strong>Trạng thái</strong>
				</th>
			</tr>
		</thead>
		<tbody>
			{section name=loops loop=$lsBanner}
			<tr class="row{if $smarty.section.loops.index%2==0}0{else}1{/if}">
				<td>{$smarty.section.loops.index+1}</td>
				<td align="center">
					<input type="checkbox" onclick="isChecked(this.checked);" value="{$lsBanner[loops].banner_id}" name="cid[]" id="cb{$lsBanner[loops].banner_id}">
				</td>
				<td>
					<a href="{$page}?task=edit&banner_id={$lsBanner[loops].banner_id}">{$lsBanner[loops].banner_title}</a>
				</td>
				<td align="center">
					{$lsBanner[loops].banner_web}
				</td>
				<td align="center">{$lsBanner[loops].banner_page}</td>
				<td align="center">{$lsBanner[loops].banner_position}</td>
				<td align="center">
					{$lsBanner[loops].banner_create}
				</td>
				<td align="center">
					{$lsBanner[loops].banner_click}
				</td>
				<td align="center">
					{if $lsBanner[loops].banner_status == 1}
						<a onclick="return listItemTask('cb{$lsBanner[loops].banner_id}','unpublish')" title="Ẩn đi">
						<img src="../images/publish_g.png" width="16" style="cursor:pointer" alt="Ẩn đi" border="0" />
						</a>
					{else}
						<a onclick="return listItemTask('cb{$lsBanner[loops].banner_id}','publish')" title="Hiển thị">
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
				<td colspan="11">
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