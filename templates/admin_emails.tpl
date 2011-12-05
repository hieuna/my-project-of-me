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
{literal}
<style type="text/css">
strong{font-weight:bold}
em{font-style:italic}
</style>
{/literal}
<form name="adminForm" method="post" action="{$page}.php">
	<table style="margin-bottom:5px;">
		<tbody>
			<tr>
				<td width="100%">
				</td>
				<td nowrap="nowrap">
					
				</td>
			</tr>
		</tbody>
	</table>
	<table cellspacing="1" class="adminlist">
		<thead>
			<tr>
				<th width="10">#</th>
				<th width="5">
					<input type="checkbox" onclick="checkAll(50);" value="" name="toggle" />
				</th>
				<th class="title" nowrap="nowrap">Kiểu email</th>
				<th class="title" nowrap="nowrap">Mô tả</th>
				<!--<th class="title" nowrap="nowrap">Từ khóa thay thế</th>
				--><th class="title" nowrap="nowrap">Tiêu đề</th>
				<th class="title" nowrap="nowrap">Nội dung</th>
			</tr>
		</thead>
		<tbody></tbody>
			{section name=loops loop=$aryEmail}
			<tr class="row{if $smarty.section.loops.index%2==0}0{else}1{/if}">
				<td>{$smarty.section.loops.index+1}</td>
				<td align="center">
					<input type="checkbox" onclick="isChecked(this.checked);" value="{$aryEmail[loops].system_email_id}" name="cid[]" id="cb{$smarty.section.loops.index}" />
				</td>
				<td><a href="admin_emails.php?task=edit&id={$aryEmail[loops].system_email_id}">{$aryEmail[loops].system_email_name}</a></td>
				<td>{$aryEmail[loops].system_email_description}</td>
				<!--<td>{$aryEmail[loops].system_email_vars}</td>
				--><td>{$aryEmail[loops].system_email_subject}</td>
				<td>{$aryEmail[loops].system_email_body}</td>
			</tr>
			{sectionelse}
			<tr>
				<td colspan="7" align="center"><font color="red">Không tồn tại bản ghi nào!</font></td>
			</tr>
			{/section}
		</tbody>
	</table>
	
	<input type="hidden" value="{$task}" name="task" />
	<input type="hidden" value="" name="boxchecked" />
</form>

{elseif $task=="edit" || $task=="new"}
	<script type="text/javascript" src="../include/js/jquery/tiny_mce/tiny_mce.js"></script>
	<form name="adminForm" id="adminForm" method="post" action="{$page}.php">
			<table class="admintable" width="100%">
				<tr>
					<td class="key"><label for="system_email_name">Kiểu email </label></td>
					<td>
					<select id="system_email_name" name="system_email_name" style="width:250px">
						{foreach from=$emailType key=k item=type}
						<option value="{$k}" {if $aryEmail.system_email_name==$k}selected{/if}>{$type}</option>
						{/foreach}
					</select>
					
					</td>
				</tr>
				<tr>
					<td class="key"><label for="system_email_description">Mô tả</label></td>
					<td><textarea rows="4" style='width:80%' name="system_email_description" id="system_email_description" >{$aryEmail.system_email_description}</textarea></td>
				</tr>
				<!--<tr>
					<td class="key"><label for="system_email_vars">Từ khóa thay thế</label></td>
					<td><input type="text" name="system_email_vars" id="system_email_vars" style="width:80%" maxlength="255" value="{$aryEmail.system_email_vars}" /></td>
				</tr>
				--><tr>
					<td class="key"><label for="system_email_subject">Tiêu đề</label></td>
					<td><input type="text" name="system_email_subject" id="system_email_subject" value="{$aryEmail.system_email_subject}" style="width:80%" maxlength="255" /></td>
				</tr>
				<tr>
					<td class="key"><label for="system_email_body">Nội dung </label></td>
					<td><textarea rows="15" style='width:80%' name="system_email_body" id="system_email_body">{$aryEmail.system_email_body}</textarea></td>
				</tr>
			</table>
			<input type="hidden" value="{$task}" name="task" />
			<input type="hidden" value="{$task}" name="action" />
			<input type="hidden" value="{$aryEmail.system_email_id}" id="system_email_id" name="system_email_id" />
	</form>
{literal}
<script language="javascript">
tinyMCE.init({
	mode : "exact",
	elements : "system_email_body",
	theme : "advanced",
	skin : "o2k7",
	plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",
	theme_advanced_buttons1 : "code,|,bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,link,unlink,fontselect,fontsizeselect,forecolor,backcolor,pasteword,|,search,replace,",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
  entity_encoding : "raw",
	force_br_newlines : false,
	force_p_newlines : false,
	theme_advanced_resizing : true
});
		
function submitform(pressbutton){
	var action = document.adminForm.action.value;
	
	if (pressbutton == 'save') {
		if (action == 'new') {
			objEmails.processAction("admin_emails.php?task=new&ajax=1");
		}
		if (action == 'edit') {
			objEmails.processAction("admin_emails.php?task=edit&ajax=1");
		}
	}
	else {
		if (pressbutton == 'cancel' || pressbutton == 'new' || pressbutton == 'publish' || pressbutton == 'unpublish' || pressbutton == 'delete') {
			document.adminForm.task.value=pressbutton;
		}
		document.adminForm.submit();
	}
}

if (typeof objEmails == 'undefined') {
	objEmails = {
		processAction: function(sUrl) {
			var email_id = $('#system_email_id').attr('value');
			var system_email_name = $("#system_email_name").val();
			var system_email_description = $('#system_email_description').attr('value');
			var system_email_vars = $('#system_email_vars').attr('value');
			var system_email_subject = $('#system_email_subject').attr('value');
			
			var system_email_body = tinyMCE.get('system_email_body').getContent();
			if(typeof(system_email_body)=='undefined') system_email_body='';
    		
    		var data = 'system_email_body='+encodeURIComponent(system_email_body);
 		    data += '&system_email_name='+system_email_name;
 		    data += '&system_email_description='+system_email_description;
 		    data += '&system_email_vars='+system_email_vars;
 		    data += '&system_email_subject='+system_email_subject;
 		    data += '&id='+email_id;
			$.ajax({
				type: "POST",
				url: sUrl,
				data: data,
				dataType: "json",
				success: function(xmlhttp){
					var objData = xmlhttp;
					if (parseInt(objData.intOK) > 0) {
						document.location = "admin_emails.php";
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
{/if}
{include file='admin_footer.tpl'}