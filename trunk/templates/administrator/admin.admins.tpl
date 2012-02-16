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
	   							<span title="Mở khóa" class="icon-32-publish"></span>
	   							Mở khóa
	   						</a>
	   					</td>
	   					<td id="toolbar-uhpublished" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('unpublish');">
	   							<span title="Khóa lại" class="icon-32-unpublish"></span>
	   							Khóa lại
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
	   <div class="header admins">{$page_title}</div>
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
<form action="{$page}" method="post" name="adminForm" enctype="multipart/form-data">
<table class="adminTable" width="100%">
	<tr>
		<td class="key"><label for="name">Họ tên <font color="Red">*</font></label></td>
		<td><input type="text" name="admin_name" id="admin_name" value="{$thisAdmin->admin_name}" class="adm_inputbox" maxlength="150"></td>
	</tr>
	{if $admin_of_id == 0}
	<tr>
		<td class="key"><label for="name">Email <font color="Red">*</font></label></td>
		<td><input type="text" name="admin_email" id="admin_email" value="{$thisAdmin->admin_email}" class="adm_inputbox" maxlength="100"></td>
	</tr>
	<tr>
		<td class="key"><label for="name">Tên đăng nhập <font color="Red">*</font></label></td>
		<td><input type="text" name="admin_username" id="admin_username" value="{$thisAdmin->admin_username}" class="adm_inputbox" maxlength="100"></td>
	</tr>
	{else}
	<tr>
		<td class="key"><label for="name">Email</label></td>
		<td style="color:#666;">{$thisAdmin->admin_email}</td>
	</tr>
	<tr>
		<td class="key"><label for="name">Tên đăng nhập</label></td>
		<td style="color:#666;">{$thisAdmin->admin_username}</td>
	</tr>
	{/if}
	{if $admin_of_id == 0}
	<tr>
		<td class="key"><label for="name">Mật khẩu<font color="Red">*</font></label></td>
		<td><input type="password" name="admin_password" id="admin_password" value="" class="adm_inputbox" maxlength="100"></td>
	</tr>
	{else}
	<tr>
		<td class="key"><label for="name">Mật khẩu cũ <font color="Red">*</font></label></td>
		<td><input type="password" name="admin_password" id="admin_password" value="" class="adm_inputbox" maxlength="100"></td>
	</tr>
	<tr>
		<td class="key"><label for="name">Mật khẩu mới<font color="Red">*</font></label></td>
		<td><input type="password" name="admin_password_new" id="admin_password_new" value="" class="adm_inputbox" maxlength="100"></td>
	</tr>
	<tr>
		<td class="key"><label for="name">Nhắc lại mật khẩu mới<font color="Red">*</font></label></td>
		<td><input type="password" name="admin_password_conf" id="admin_password_conf" value="" class="adm_inputbox" maxlength="100"></td>
	</tr>
	{/if}
	<tr>
		<td class="key"><label for="name">Nhóm thành viên <font color="Red">*</font></label></td>
		<td>
			<select onchange="objUser.onchangeGroup()" size="1" class="adm_selectbox" id="cbo_group" name="cbo_group" style="width:190px">
					<option {if $actived==0}selected="selected"{/if} value="0">- Nhóm thành viên -</option>
					{foreach from=$arrGroup key=gId item=group}
					{if $gId > $userInfo.admin_group || $userInfo.admin_group==1}
            			<option value="{$gId}"{if $gId==$thisAdmin->admin_group} selected{/if}>{$group}</option>
            		{/if}
            		{/foreach}
				</select>
			</td>
		</tr>
		{if $sites}
		<tr id="rSite" style="display:none">
		<td class="key"><label for="name">Quản trị website</label></td>
		<td>
			<select name="cbo_site[]" id="cbo_site" class="adm_selectbox" multiple>
					{foreach from=$sites key=siteid item=sitename}
            			<option value="{$siteid}">{$sitename}</option>
            		{/foreach}
				</select>
			</td>
		</tr>
		{/if}
		<tr id="rAccess" style="display:none">
		<td class="key"><label for="name">Quyền truy cập</label></td>
		<td>
			{foreach from=$aryPages key=kp item=pages}
				<b>{$kp}</b><br>
				{foreach from=$pages key=kp1 item=access}
					<label for="{$kp}_{$kp1}">
					{if $userInfo.admin_group>1}
						{foreach from=$adminAccess key=kp2 item=access2}
						{if $kp==$kp2}
							{foreach from=$access2 key=kp3 item=access3}
							{if $access3==$kp1}<input type="checkbox" value="{$kp1}" name="{$kp}[]" id="{$kp}_{$kp1}">{$access}{/if}
							{/foreach}
						{/if}
						{/foreach}
					{else}<input type="checkbox" value="{$kp1}" name="{$kp}[]" id="{$kp}_{$kp1}">{$access}
					{/if}
					</label> &nbsp;
				{/foreach}
			<br><br>
			{/foreach}
		</td>
	</tr>
	<tfoot>
   	<tr>
   		<td></td>
   		<td>
   			<input type="hidden" name="admin_id" value="{$thisAdmin->admin_id}" />
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
					<input type="text" title="Lọc theo tên quản trị viên" onchange="document.adminForm.submit();" class="text_area" size="40" value="{$search}" id="search" name="search" />
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
					<strong>Tên quản trị</strong>
				</th>
				<th class="title" nowrap="nowrap" style="text-align: left; padding-left: 5px;">
					<strong>Email</strong>
				</th>
				<th class="title" nowrap="nowrap" style="text-align: left; padding-left: 5px;">
					<strong>Tên đăng nhập</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Quyền truy cập</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Ngày tạo</strong>
				</th>	
				<th class="title" nowrap="nowrap">
					<strong>Đăng nhập lần cuối</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Người tạo</strong>
				</th>
				<th width="15" nowrap="nowrap">
					<strong>Trạng thái</strong>
				</th>
			</tr>
		</thead>
		<tbody>
			{section name=loops loop=$lsAdmin}
			<tr class="row{if $smarty.section.loops.index%2==0}0{else}1{/if}">
				<td>{$smarty.section.loops.index+1}</td>
				<td align="center">
					<input type="checkbox" onclick="isChecked(this.checked);" value="{$lsAdmin[loops].admin_id}" name="cid[]" id="cb{$lsAdmin[loops].admin_id}">
				</td>
				<td>
					<a href="{$page}?task=edit&admin_id={$lsAdmin[loops].admin_id}">{$lsAdmin[loops].admin_name}</a>
				</td>
				<td>
					<a href="{$page}?task=edit&admin_id={$lsAdmin[loops].admin_id}">{$lsAdmin[loops].admin_email}</a>
				</td>
				<td>{$lsAdmin[loops].admin_username}</td>
				<td>{$lsAdmin[loops].admin_username}</td>
				<td align="center">{if $lsAdmin[loops].admin_registerDate=='0000-00-00 00:00:00'}Không xác định{else}{$lsAdmin[loops].admin_registerDate|date_format:"%d/%m/%Y %H:%M:%S"}{/if}</td>
				<td align="center">
					{if $lsAdmin[loops].admin_lastvisitDate=='0000-00-00 00:00:00'}Không xác định{else}{$lsAdmin[loops].admin_lastvisitDate|date_format:"%d/%m/%Y %H:%M:%S"}{/if}
				</td>
				<td align="center">
					{$lsAdmin[loops].name_created}
				</td>
				<td align="center">
					{if $lsAdmin[loops].admin_enabled == 1}
						<a onclick="return listItemTask('cb{$lsAdmin[loops].admin_id}','unpublish')" title="Khóa lại">
						<img src="../images/publish_g.png" width="16" style="cursor:pointer" alt="Khóa lại" border="0" />
						</a>
					{else}
						<a onclick="return listItemTask('cb{$lsAdmin[loops].admin_id}','publish')" title="Mở khóa">
						<img src="../images/publish_x.png" width="16" style="cursor:pointer" alt="Mở khóa" border="0" />
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

{literal}
<script language="javascript">
if (typeof objUser == 'undefined') {
	objUser = {
		onchangeGroup: function() {
			var group = parseInt($("#cbo_group option:selected").val());
			if (group > 1) {
				$("#rSite").css("display", "");
				$("#rAccess").css("display", "");
			}
			else {
				$("#rSite").css("display", "none");
				$("#rAccess").css("display", "none");
			}
		}
	}
}

$(document).ready(function(){
	objUser.onchangeGroup();
});
</script>
{/literal}