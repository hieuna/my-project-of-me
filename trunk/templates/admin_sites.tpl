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
					<select onchange="document.adminForm.submit( );" size="1" class="inputbox" id="site_publish" name="site_publish">
						<option {if $site_publish==-1}selected="selected"{/if} value="-1">- Trạng thái -</option>
						<option {if $site_publish==0}selected="selected"{/if} value="0">Ẩn</option>
						<option {if $site_publish==1}selected="selected"{/if} value="1">Hiển thị</option>
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
				<th class="title" nowrap="nowrap">Mã site</th>
				<th class="title" nowrap="nowrap">Mã bảo mật</th>
				<th class="title" nowrap="nowrap">Tên site</th>
				<th class="title" nowrap="nowrap">Domain</th>
				<th class="title" nowrap="nowrap">Email</th>
				<th class="title" nowrap="nowrap">Tên phí (QT)</th>
				<th class="title" nowrap="nowrap">Phí thanh toán (QT)</th>
				<th class="title" nowrap="nowrap">Phí cố định (QT)</th>
				<th class="title" nowrap="nowrap">Tên phí (NĐ)</th>
				<th class="title" nowrap="nowrap">Phí thanh toán (NĐ)</th>
				<th class="title" nowrap="nowrap">Phí cố định (NĐ)</th>
			</tr>
		</thead>
		<tbody>
			{section name=loops loop=$arySite}
			<tr class="row{if $smarty.section.loops.index%2==0}0{else}1{/if}">
				<td>{$smarty.section.loops.index+1}</td>
				<td align="center">
					<input type="checkbox" onclick="isChecked(this.checked);" value="{$arySite[loops].site_id}" name="cid[]" id="cb{$smarty.section.loops.index}">
				</td>
				<td>{$arySite[loops].site_code}</td>
				<td>{$arySite[loops].site_secure_secret}</td>
				<td><a href="admin_sites.php?task=edit&id={$arySite[loops].site_id}" title="Click để sửa thông tin site này">{$arySite[loops].site_name}</a></td>
				<td>{$arySite[loops].site_domain}</td>
				<td>{$arySite[loops].site_emails}</td>
				<td>{$arySite[loops].site_qt_feename}</td>
				<td>{$arySite[loops].site_qt_feeper}</td>
				<td>{$arySite[loops].site_qt_feefix}</td>
				<td>{$arySite[loops].site_nd_feename}</td>
				<td>{$arySite[loops].site_nd_feeper}</td>
				<td>{$arySite[loops].site_nd_feefix}</td>
			</tr>
			{sectionelse}
			<tr>
				<td colspan="13" align="center"><font color="red">Không tồn tại site nào thỏa mãn điều kiện tìm kiếm!</font></td>
			</tr>
			{/section}
		</tbody>
		<tfoot>
			<tr>
				<td colspan="13">
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
					<td class="key"><label for="site_code">Mã site <font color="Red">*</font></label></td>
					<td><input type="text" name="site_code" id="site_code" value="" class="wid1" maxlength="100"></td>
				</tr>
				<tr>
					<td class="key"><label for="site_name">Tên site <font color="Red">*</font></label></td>
					<td><input type="text" name="site_name" id="site_name" value="" class="wid1" maxlength="255"></td>
				</tr>
				
				<tr>
					<td class="key"><label for="site_domain">Domain <font color="Red">*</font></label></td>
					<td><input type="text" name="site_domain" id="site_domain" value="" class="wid1" maxlength="255"></td>
				</tr>
				<tr>
					<td class="key"><label for="site_phone">Điện thoại <font color="Red">*</font></label></td>
					<td><input type="text" name="site_phone" id="site_phone" value="" class="wid1" maxlength="20"></td>
				</tr>
				<tr>
					<td class="key"><label for="site_emails">Email <font color="Red">*</font></label></td>
					<td><input type="text" name="site_emails" id="site_emails" value="" class="wid1" maxlength="200"></td>
				</tr>
				<tr>
					<td class="key"><label for="site_qt_feename">Tên phí (Quốc tế) </label></td>
					<td><input type="text" name="site_qt_feename" id="site_qt_feename" value="(Miễn phí)" class="wid1" maxlength="255"></td>
				</tr>
				<tr>
					<td class="key"><label for="site_qt_feeper">Phí thanh toán (Quốc tế)</label></td>
					<td>
						<input type="text" name="site_qt_feeper" id="site_qt_feeper" value="" class="wid1" maxlength="200">
						(%)
					</td>
				</tr>
				<tr>
					<td class="key"><label for="site_qt_feefix">Phí cố định (Quốc tế) </label></td>
					<td><input type="text" name="site_qt_feefix" id="site_qt_feefix" value="" class="wid1" maxlength="100">
					(VNĐ)
					</td>
				</tr>
				<tr>
					<td class="key"><label for="name">Tên phí (Nội địa) </label></td>
					<td>
						<input type="text" name="site_nd_feename" id="site_nd_feename" value="(Miễn phí)" class="wid1" maxlength="200">
					</td>
				</tr>
				<tr>
					<td class="key"><label for="site_nd_feeper">Phí thanh toán (Nội địa) </label></td>
					<td>
						<input type="text" name="site_nd_feeper" id="site_nd_feeper" value="" class="wid1" maxlength="200">
						(%)
					</td>
				</tr>
				<tr>
					<td class="key"><label for="site_nd_feefix">Phí cố định (Nội địa) </label></td>
					<td>
					<input type="text" name="site_nd_feefix" id="site_nd_feefix" value="" class="wid1" maxlength="100">
					(VNĐ)
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
					<td class="key"><label for="site_code">Mã site <font color="Red">*</font></label></td>
					<td><input type="text" name="site_code" id="site_code" value="{$arySite.site_code}" class="wid1" maxlength="100" readonly></td>
				</tr>
				<tr>
					<td class="key"><label for="site_name">Tên site <font color="Red">*</font></label></td>
					<td><input type="text" name="site_name" id="site_name" value="{$arySite.site_name}" class="wid1" maxlength="255"></td>
				</tr>
				<tr>
					<td class="key"><label for="site_domain">Domain <font color="Red">*</font></label></td>
					<td><input type="text" name="site_domain" id="site_domain" value="{$arySite.site_domain}" class="wid1" maxlength="255"></td>
				</tr>
				<tr>
					<td class="key"><label for="site_phone">Điện thoại <font color="Red">*</font></label></td>
					<td><input type="text" name="site_phone" id="site_phone" value="{$arySite.site_phone}" class="wid1" maxlength="20"></td>
				</tr>
				<tr>
					<td class="key"><label for="site_emails">Email <font color="Red">*</font></label></td>
					<td><input type="text" name="site_emails" id="site_emails" value="{$arySite.site_emails}" class="wid1" maxlength="200"></td>
				</tr>
				<tr>
					<td class="key"><label for="site_qt_feename">Tên phí (Quốc tế)</label></td>
					<td><input type="text" name="site_qt_feename" id="site_qt_feename" value="{$arySite.site_qt_feename}" class="wid1" maxlength="255"></td>
				</tr>
				<tr>
					<td class="key"><label for="site_qt_feeper">Phí thanh toán (Quốc tế)</label></td>
					<td>
						<input type="text" name="site_qt_feeper" id="site_qt_feeper" value="{$arySite.site_qt_feeper}" class="wid1" maxlength="200">
						(%)
					</td>
				</tr>
				<tr>
					<td class="key"><label for="site_qt_feefix">Phí cố định (Quốc tế) </label></td>
					<td><input type="text" name="site_qt_feefix" id="site_qt_feefix" value="{$arySite.site_qt_feefix}" class="wid1" maxlength="100">
					(VNĐ)
					</td>
				</tr>
				<tr>
					<td class="key"><label for="name">Tên phí (Nội địa) </label></td>
					<td>
						<input type="text" name="site_nd_feename" id="site_nd_feename" value="{$arySite.site_nd_feename}" class="wid1" maxlength="255">
					</td>
				</tr>
				<tr>
					<td class="key"><label for="site_nd_feeper">Phí thanh toán (Nội địa)</label></td>
					<td>
						<input type="text" name="site_nd_feeper" id="site_nd_feeper" value="{$arySite.site_nd_feeper}" class="wid1" maxlength="200">
						(%)
					</td>
				</tr>
				<tr>
					<td class="key"><label for="site_nd_feefix">Phí cố định (Nội địa) </label></td>
					<td>
					<input type="text" name="site_nd_feefix" id="site_nd_feefix" value="{$arySite.site_nd_feefix}" class="wid1" maxlength="100">
					(VNĐ)
					</td>
				</tr>
				<tr>
					<td class="key"><label for="site_sendemail">Cho phép gửi mail </label></td>
					<td>
					<input type="checkbox" name="site_sendemail" id="site_sendemail" value="1" {if $arySite.site_sendemail == 1}checked{/if}>
					</td>
				</tr>
			</table>
			<input type="hidden" value="{$task}" name="task">
			<input type="hidden" value="edit" name="action">
			<input type="hidden" value="{$siteId}" name="id">
		</fieldset>
	</form>
{/if}

{literal}
<script language="javascript">

function submitform(pressbutton){
	var action = document.adminForm.action.value;
	
	if (pressbutton == 'save') {
		if (action == 'new') {
			objSites.processAction("admin_sites.php?task=new&ajax=1");
		}
		else if (action == 'edit') {
			objSites.processAction("admin_sites.php?task=edit&ajax=1");
		}
	}
	else {
		if (pressbutton) {
			document.adminForm.task.value=pressbutton;
		}
		document.adminForm.submit();
	}
}

if (typeof objSites == 'undefined') {
	objSites = {
		processAction: function(sUrl) {
			$.ajax({
				type: "POST",
				url: sUrl,
				data: $("#adminForm").serialize(),
				dataType: "json",
				success: function(xmlhttp){
					var objData = xmlhttp;
					if (parseInt(objData.intOK) > 0) {
						document.location = "admin_sites.php";
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
</script>
{/literal}
{include file='admin_footer.tpl'}