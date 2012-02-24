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
	   <div class="header menutype">{$page_title}</div>
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
   		<td>Tên nhóm menu</td>
   		<td><input type="text" name="name" class="adm_inputbox required" value="{$thisMenuType->name}" /></td>
   	</tr>
   	<tr>
   		<td>Trạng thái</td>
   		<td><input type="checkbox" name="status" class="adm_chk" {if $thisMenuType->status == 1} checked="checked"{/if} value="1" /> Hiển thị</td>
   	</tr>
   </tbody>
   <tfoot>
   	<tr>
   		<td></td>
   		<td>
   			<input type="hidden" name="menutype_id" value="{$menutype_id}" />
   			<input type="hidden" name="task" value="save" />
   		</td>
   	</tr>
   </tfoot>
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
					<strong>Tên nhóm menu</strong>
				</th>
				<th width="15" nowrap="nowrap">
					<strong>Trạng thái</strong>
				</th>
			</tr>
		</thead>
		<tbody>
			{section name=loops loop=$lsMenuType}
			<tr class="row{if $smarty.section.loops.index%2==0}0{else}1{/if}">
				<td>{$smarty.section.loops.index+1}</td>
				<td align="center">
					<input type="checkbox" onclick="isChecked(this.checked);" value="{$lsMenuType[loops].menutype_id}" name="cid[]" id="cb{$lsMenuType[loops].menutype_id}">
				</td>
				<td>
					<a href="{$page}?task=edit&menutype_id={$lsMenuType[loops].menutype_id}">{$lsMenuType[loops].name}</a>
				</td>
				<td align="center">
					{if $lsMenuType[loops].status == 1}
						<a onclick="return listItemTask('cb{$lsMenuType[loops].menutype_id}','unpublish')" title="Ẩn đi">
						<img src="../images/publish_g.png" width="16" style="cursor:pointer" alt="Ẩn đi" border="0" />
						</a>
					{else}
						<a onclick="return listItemTask('cb{$lsMenuType[loops].menutype_id}','publish')" title="Hiển thị">
						<img src="../images/publish_x.png" width="16" style="cursor:pointer" alt="Hiển thị" border="0" />
						</a>
					{/if}
				</td>
			</tr>
			{sectionelse}
			<tr>
				<td colspan="4" align="center"><font color="red">Không tồn tại bản ghi nào thỏa mãn điều kiện tìm kiếm!</font></td>
			</tr>
			{/section}
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4">
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