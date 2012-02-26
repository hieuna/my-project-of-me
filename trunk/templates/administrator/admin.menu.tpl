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
	   <div class="header menu">{$page_title}</div>
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
<form action="{$page}" method="post" name="adminForm" class="form-validate">
<table class="adminTable">
    <tbody>
   	<tr>
   		<td width="20%">Nhóm menu{$thisMenu->menutype}</td>
   		<td width="80%">
   		<select name="menutype" class="adm_selectbox">
   			<option value="">Lựa chọn theo nhóm</option>
   			{section name=loops loop=$lsMenuType}
   			<option {if $thisMenu->menutype==$lsMenuType[loops].menutype_id} selected="selected"{/if} value="{$lsMenuType[loops].menutype_id}">{$lsMenuType[loops].name}</option>
   			{/section}
   		</select>
   		</td>
   	</tr>
   	<tr>
   		<td width="20%">Trực thuộc nhóm</td>
   		<td width="80%">
   		<select name="parent_id" class="adm_selectbox">
   			<option value="">Lựa chọn theo nhóm</option>
   			{section name=loops loop=$lsMenu}
   			<option {if $thisMenu->parent_id==$lsMenu[loops].menu_id} selected="selected"{/if} value="{$lsMenu[loops].menu_id}">{$lsMenu[loops].name}</option>
   			{/section}
   		</select>
   		</td>
   	</tr>
   	<tr>
   		<td>Tên menu</td>
   		<td><input type="text" name="name" class="adm_inputbox required" value="{$thisMenu->name}" /></td>
   	</tr>
   	<tr>
   		<td>Bí danh</td>
   		<td><input type="text" name="alias" class="adm_inputbox" value="{$thisMenu->alias}" /></td>
   	</tr>
   	<tr>
   		<td>Kiểu link</td>
   		<td>
   			<select name="type" class="adm_selectbox">
   				<option value="">Lựa chọn kiểu link</option>
   				<option value="category">Link nhóm sản phẩm</option>
   				<option value="product">Link sản phẩm</option>
   				<option value="feauture">Link tính năng</option>
   				<option value="category.news">Link nhóm tin tức</option>
   				<option value="news">Link đến bài tin tức</option>
   			</select>
   		</td>
   	</tr>
   	<tr>
   		<td>Link đến</td>
   		<td><div id="process_link">{$thisMenu->link}</div></td>
   	</tr>
   	<tr>
   		<td>Thứ tự</td>
   		<td><input type="text" name="ordering" id="ordering" class="adm_inputbox small" value="{$thisMenu->ordering}" /></td>
   	</tr>
   	<tr>
   		<td>Trạng thái</td>
   		<td><input type="checkbox" name="status" class="adm_chk" {if $thisMenu->status == 1} checked="checked"{/if} value="1" /> Hiển thị</td>
   	</tr>
   </tbody>
   <tfoot>
   	<tr>
   		<td></td>
   		<td>
   			<input type="hidden" name="menu_id_value" value="{$menu_id}" />
   			<input type="hidden" name="task" value="save" />
   		</td>
   	</tr>
   </tfoot>
</table>			
</form>
{literal}
<<script type="text/javascript">
<!--
$(function(){
	$('select[name=type]').change(function(){
		var value = $('select[name=type]').val();
		$('#process_link').load("ajax.php?task=process_link&value="+value);
	});
});
//-->
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
			{section name=loops loop=$lsMenu}
			<tr class="row{if $smarty.section.loops.index%2==0}0{else}1{/if}">
				<td>{$smarty.section.loops.index+1}</td>
				<td align="center">
					<input type="checkbox" onclick="isChecked(this.checked);" value="{$lsMenu[loops].menu_id}" name="cid[]" id="cb{$lsMenu[loops].menu_id}">
				</td>
				<td>
					<a href="{$page}?task=edit&menu_id={$lsMenu[loops].menu_id}">{$lsMenu[loops].name}</a>
				</td>
				<td align="center">{$lsMenu[loops].alias}</td>
				<td align="center">{$lsMenu[loops].nametype}</td>
				<td align="center">{$lsMenu[loops].link}</td>
				<td align="center">
					{$lsMenu[loops].type}
				</td>
				<td align="center">
					{if $lsMenu[loops].parent_id == 0}
					<b>Nhóm chính</b>
					{else}
					<i>{$lsMenu[loops].nameparent}</i>
					{/if}
				</td>
				<td align="center">
					{if $lsMenu[loops].status == 1}
						<a onclick="return listItemTask('cb{$lsMenu[loops].menu_id}','unpublish')" title="Ẩn đi">
						<img src="../images/publish_g.png" width="16" style="cursor:pointer" alt="Ẩn đi" border="0" />
						</a>
					{else}
						<a onclick="return listItemTask('cb{$lsMenu[loops].menu_id}','publish')" title="Hiển thị">
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