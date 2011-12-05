{include file='admin_header.tpl'}
<div style="display:none" id="blockErr">
	<fieldset class="adminform">
		<legend>Xảy ra lỗi sau</legend>
		<table class="admintable" width="100%">
			<tr><td><font color="Red"><span id="strErr">{$errorTxt}</span></font></td></tr>
		</table>
	</fieldset>
</div>
{if $task=="view"}
<form name="adminForm" method="post" action="{$page}.php">
	<table style="margin-bottom:5px;">
		<tbody>
			<tr>
				<td width="100%">
				</td>
				<td nowrap="nowrap">
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_siteid" name="filter_siteid">
						<option selected="selected" value="0">- Chọn Site -</option>
						{foreach from=$sites key=siteid item=sitename}
	            		<option value="{$siteid}"{if $siteid==$filter_siteid} selected{/if}>{$sitename}</option>
	            		{/foreach}
					</select>
					
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_group" name="filter_group">
						<option {if $actived==0}selected="selected"{/if} value="0">- Nhóm thành viên -</option>
						{foreach from=$arrGroup key=gId item=group}
	            		<option value="{$gId}"{if $gId==$filter_group} selected{/if}>{$group}</option>
	            		{/foreach}
					</select>
					
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_status" name="filter_status">
						<option {if $filter_status==0}selected="selected"{/if} value="0">- Trạng thái thành viên -</option>
						<option {if $filter_status==2}selected="selected"{/if} value="2">Đã kích hoạt</option>
						<option {if $filter_status==1}selected="selected"{/if} value="1">Chưa kích hoạt</option>
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
				<th class="title" nowrap="nowrap">
					Họ tên
				</th>
				<th class="title" nowrap="nowrap">
					Email
				</th>
				<th class="title" nowrap="nowrap">
					Tên đăng nhập
				</th>
				<th class="title" nowrap="nowrap">
					Kiểu thành viên
				</th>
				<th class="title">
					Quyền hạn
				</th>
				<th class="title" nowrap="nowrap">
					Website quản trị
				</th>
				<th class="title" nowrap="nowrap">
					Kích hoạt
				</th>
			</tr>
		</thead>
		<tbody>
			{section name=loops loop=$users}
			<tr class="row{if $smarty.section.loops.index%2==0}0{else}1{/if}">
				<td>{$smarty.section.loops.index+1}</td>
				<td align="center">
					<input type="checkbox" onclick="isChecked(this.checked);" value="{$users[loops].admin_id}" name="cid[]" id="cb{$smarty.section.loops.index}">
				</td>
				<td>{$users[loops].admin_name}</td>
				<td><a href="admin_users.php?task=edit&id={$users[loops].admin_id}" title="Click để sửa thông tin thành viên này">{$users[loops].admin_email}</a></td>
				<td>{$users[loops].admin_username}</td>
				<td align="center">{$users[loops].admin_group}</td>
				<td align="left">
				{foreach from=$users[loops].admin_access key=k item=access}
				{if $access}
					<u><b>{$k}</b></u><br>
					{$access}<br>
				{/if}
				{/foreach}
				</td>
				<td align="left">
				{foreach from=$users[loops].admin_site key=k item=site}
					{if $k>0}, {/if}{$site}
				{/foreach}
				</td>
				<td align="center">{if $users[loops].admin_enabled == 1}YES{else}NO{/if}</td>
			</tr>
			{sectionelse}
			<tr>
				<td colspan="12" align="center"><font color="red">Không tồn tại user nào thỏa mãn điều kiện tìm kiếm!</font></td>
			</tr>
			{/section}
		</tbody>
		<tfoot>
			<tr>
				<td colspan="12">
					{$datapage}
				</td>
			</tr>
		</tfoot>
	</table>
	
	<input type="hidden" value="{$task}" name="task">
	<input type="hidden" value="" name="boxchecked">
</form>


{elseif $task=="new"}
	<form name="adminForm" id="adminForm" method="post" action="{$page}.php">
		<fieldset class="adminform">
			<legend>Nhập thông tin vào các mục</legend>
			<table class="admintable" width="100%">
				<tr>
					<td class="key"><label for="name">Họ tên <font color="Red">*</font></label></td>
					<td><input type="text" name="admin_name" id="admin_name" value="" class="wid1" maxlength="150"></td>
				</tr>
				<tr>
					<td class="key"><label for="name">Email <font color="Red">*</font></label></td>
					<td><input type="text" name="admin_email" id="admin_email" value="" class="wid1" maxlength="100"></td>
				</tr>
				
				<tr>
					<td class="key"><label for="name">Tên đăng nhập <font color="Red">*</font></label></td>
					<td><input type="text" name="admin_username" id="admin_username" value="" class="wid1" maxlength="100"></td>
				</tr>
				<tr>
					<td class="key"><label for="name">Mật khẩu <font color="Red">*</font></label></td>
					<td><input type="password" name="admin_password" id="admin_password" value="" class="wid1" maxlength="100"></td>
				</tr>
				<tr>
					<td class="key"><label for="name">Nhóm thành viên <font color="Red">*</font></label></td>
					<td>
						<select onchange="objUser.onchangeGroup()" size="1" class="inputbox" id="cbo_group" name="cbo_group" style="width:190px">
							<option {if $actived==0}selected="selected"{/if} value="0">- Nhóm thành viên -</option>
							{foreach from=$arrGroup key=gId item=group}
							{if $gId > $userInfo.admin_group || $userInfo.admin_group==1}
		            			<option value="{$gId}"{if $gId==$filter_group} selected{/if}>{$group}</option>
		            		{/if}
		            		{/foreach}
						</select>
					</td>
				</tr>
				{if $sites}
				<tr id="rSite" style="display:none">
					<td class="key"><label for="name">Quản trị website</label></td>
					<td>
						<select name="cbo_site[]" id="cbo_site" multiple style="width:190px">
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
			</table>
			<input type="hidden" value="{$task}" name="task">
			<input type="hidden" value="new" name="action">
		</fieldset>
	</form>
{elseif $task=="edit"}
	<form name="adminForm" id="adminForm" method="post" action="{$page}.php">
		<fieldset class="adminform">
			<legend>Nhập thông tin vào các mục</legend>
			<table class="admintable" width="100%">
				<tr>
					<td class="key"><label for="name">Họ tên <font color="Red">*</font></label></td>
					<td><input type="text" name="admin_name" id="admin_name" value="{$users.admin_name}" class="wid1" maxlength="150"></td>
				</tr>
				<tr>
					<td class="key"><label for="name">Email <font color="Red">*</font></label></td>
					<td><input type="text" name="admin_email" id="admin_email" value="{$users.admin_email}" class="wid1" maxlength="100"></td>
				</tr>
				
				<tr>
					<td class="key"><label for="name">Tên đăng nhập <font color="Red">*</font></label></td>
					<td><input type="text" name="admin_username" id="admin_username" value="{$users.admin_username}" class="wid1" readonly='true' maxlength="100"></td>
				</tr>
				<tr>
					<td class="key"><label for="name">Đổi mật khẩu</label></td>
					<td><input type="password" name="admin_password" id="admin_password" value="" class="wid1" maxlength="100"></td>
				</tr>
				<tr>
					<td class="key"><label for="name">Nhóm thành viên <font color="Red">*</font></label></td>
					<td>
						<select onchange="objUser.onchangeGroup()" size="1" class="inputbox" id="cbo_group" name="cbo_group" style="width:190px">
							<option {if $users.admin_group==0}selected="selected"{/if} value="0">- Nhóm thành viên -</option>
							{foreach from=$arrGroup key=gId item=group}
							{if $gId >= $users.admin_group || $users.admin_group==1}
		            			<option value="{$gId}" {if $gId==$users.admin_group} selected="selected"{/if}>{$group}</option>
		            		{/if}
		            		{/foreach}
						</select>
					</td>
				</tr>
				<tr id="rSite" style="display:none">
					<td class="key"><label for="name">Quản trị website</label></td>
					<td>
						<select name="cbo_site[]" id="cbo_site" multiple style="width:190px">
							{foreach from=$sites key=siteid item=sitename}
		            			<option value="{$siteid}"
								{foreach from=$arySiteId key=id2 item=siteId2}
								{if $siteId2 == $siteid}selected='selected'{/if}
								{/foreach}
								>{$sitename}</option>
		            		{/foreach}
						</select>
					</td>
				</tr>
				<tr id="rAccess" style="display:none">
					<td class="key"><label for="name">Quyền truy cập</label></td>
					<td>
						{foreach from=$aryPages key=kp item=pages}
							<b>{$kp}</b><br>
							{foreach from=$pages key=kp1 item=access}
								<label for="{$kp}_{$kp1}">
								
								<!--<input type="checkbox" value="{$kp1}" name="{$kp}[]" id="{$kp}_{$kp1}"
									{foreach from=$aryAccess.$kp key=kp2 item=access2}									
										{if $access2 == $kp1}checked{/if}
									{/foreach}
								> {$access}-->
								
								{if $userInfo.admin_group>1}
									{foreach from=$adminAccess key=kp2 item=access2}
									{if $kp==$kp2}
										{foreach from=$access2 key=kp3 item=access3}
										{if $access3==$kp1}<input type="checkbox" value="{$kp1}" name="{$kp}[]" id="{$kp}_{$kp1}"
											{foreach from=$aryAccess.$kp key=kp2 item=access2}									
												{if $access2 == $kp1}checked{/if}
											{/foreach}
										>{$access}{/if}
										{/foreach}
									{/if}
									{/foreach}
								{else}
									<input type="checkbox" value="{$kp1}" name="{$kp}[]" id="{$kp}_{$kp1}"
										{foreach from=$aryAccess.$kp key=kp2 item=access2}									
											{if $access2 == $kp1}checked{/if}
										{/foreach}
									>{$access}
								{/if}
								
								</label> &nbsp;
							{/foreach}
						<br><br>
						{/foreach}
					</td>
				</tr>
				<tr>
					<td class="key"><label for="name">Trạng thái</label></td>
					<td>
						<select name="admin_enabled" id="admin_enabled" style="width:190px">
							<option value="0" {if $users.admin_enabled == 0}selected='selected'{/if}>Không được phép hoạt động</option>
							<option value="1" {if $users.admin_enabled == 1}selected='selected'{/if}>Được phép hoạt động</option>
						</select>
					</td>
				</tr>
			</table>
			<input type="hidden" value="{$task}" name="task">
			<input type="hidden" value="edit" name="action">
			<input type="hidden" value="{$adminId}" name="id">
		</fieldset>
	</form>
{/if}

{literal}
<script language="javascript">

function submitform(pressbutton){
	var action = document.adminForm.action.value;
	
	if (pressbutton == 'save') {
		if (action == 'new') {
			objUser.processAction("admin_users.php?task=new&ajax=1");
		}
		else if (action == 'edit') {
			objUser.processAction("admin_users.php?task=edit&ajax=1");
		}
	}
	else {
		if (pressbutton) {
			document.adminForm.task.value=pressbutton;
		}
		document.adminForm.submit();
	}
}

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
		},
		
		processAction: function(sUrl) {
			$.ajax({
				type: "POST",
				url: sUrl,
				data: $("#adminForm").serialize(),
				dataType: "json",
				success: function(xmlhttp){
					var objData = xmlhttp;
					if (parseInt(objData.intOK) > 0) {
						document.location = "admin_users.php";
					} else {
						$("#strErr").attr("innerHTML", objData.strError);
						$("#blockErr").css("display", "block");
					}
				}
			});
			return false;
		}
	}
}

$(document).ready(function(){
	objUser.onchangeGroup();
});
</script>
{/literal}
{include file='admin_footer.tpl'}