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
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="error_card_type" name="error_card_type">
						<option {if $card_id==''}selected="selected"{/if} value="">- Tất cả ngân hàng -</option>
						{foreach from=$aryCard key=k item=card}
						<option {if $k==$card_id}selected="selected"{/if} value="{$k}">{$card}</option>
						{/foreach}
					</select>
				</td>
			</tr>
		</tbody>
	</table>
	<table cellspacing="1" class="adminlist">
		<thead>
			<tr>
				<th width="10">#</th>
				<th width="5">
					<input type="checkbox" onclick="checkAll(50);" value="" name="toggle">
				</th>
				<th class="title" nowrap="nowrap" width="100">Loại thẻ</th>
				<th class="title" nowrap="nowrap" width="50">Mã lỗi</th>
				<th class="title" nowrap="nowrap">Tiêu đề</th>
				<th class="title" nowrap="nowrap">Nội dung</th>
				<th class="title" nowrap="nowrap">Hướng dẫn</th>
				<th class="title" nowrap="nowrap">Trạng thái</th>
			</tr>
		</thead>
		<tbody>
			{section name=loops loop=$aryError}
			<tr class="row{if $smarty.section.loops.index%2==0}0{else}1{/if}">
				<td>{$smarty.section.loops.index+1}</td>
				<td align="center">
					<input type="checkbox" onclick="isChecked(this.checked);" value="{$aryError[loops].error_id}" name="cid[]" id="cb{$smarty.section.loops.index}">
				</td>
				<td><a href="admin_errors.php?task=edit&id={$aryError[loops].error_id}">{$aryError[loops].card_type_name}</a></td>
				<td>{$aryError[loops].error_response_code}</td>
				<td><a href="admin_errors.php?task=edit&id={$aryError[loops].error_id}">{$aryError[loops].error_title}</a></td>
				<td>{$aryError[loops].error_message}</td>
				<td>{$aryError[loops].error_guide}</td>
				<td>{if $aryError[loops].error_show}Hiển thị{else}Không hiển thị{/if}</td>
			</tr>
			{sectionelse}
			<tr>
				<td colspan="5" align="center"><font color="red">Không tồn tại bản ghi nào!</font></td>
			</tr>
			{/section}
		</tbody>
	</table>
	
	<input type="hidden" value="{$task}" name="task">
	<input type="hidden" value="" name="boxchecked">
</form>

{elseif $task=="edit" || $task=="new"}
	<script type="text/javascript" src="../include/js/jquery/tiny_mce/tiny_mce.js"></script>
	<form name="adminForm" id="adminForm" method="post" action="{$page}.php">
		<fieldset class="adminform">
			<legend>Nhập thông tin vào các mục</legend>
			<table class="admintable" width="100%">
				<tr>
					<td class="key"><label for="error_card_type">Tên thẻ </label></td>
					<td>
					<select id="error_card_type" name="error_card_type" {if $task=='edit'}disabled{/if}>
						{foreach from=$aryCard key=k item=card}
						<option {if ($aryError.error_card_type==$k)}selected="selected"{/if} value="{$k}">{$card}</option>
						{/foreach}
					</select>
					
					</td>
				</tr>
				<tr>
					<td class="key"><label for="error_response_code">Mã lỗi</label></td>
					<td><input type="text" name="error_response_code" id="error_response_code" value="{$aryError.error_response_code}" class="wid2" maxlength="255"></td>
				</tr>
				<tr>
					<td class="key"><label for="error_title">Tiêu đề lỗi</label></td>
					<td><input type="text" name="error_title" id="error_title" value="{$aryError.error_title}" class="wid2" maxlength="255"></td>
				</tr>
				<tr>
					<td class="key"><label for="error_message">Nội dung lỗi </label></td>
					<td><textarea rows="10" style='width:80%' name="error_message" id="error_message" value="{$aryError.error_message}">{$aryError.error_message}</textarea></td>
				</tr>
				<tr>
					<td class="key"><label for="error_guide">Hướng dẫn </label></td>
					<td><textarea rows="10" style='width:80%' name="error_guide" id="error_guide" value="{$aryError.error_guide}">{$aryError.error_guide}</textarea></td>
				</tr>
			</table>
			<input type="hidden" value="{$task}" name="task">
			<input type="hidden" value="{$task}" name="action">
			<input type="hidden" value="{$aryError.error_id}" id="error_id" name="error_id">
		</fieldset>
	</form>
{/if}

{literal}
<script language="javascript">
tinyMCE.init({
	mode : "exact",
	elements : "error_message",
	theme : "advanced",
	skin : "o2k7",
	plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",
	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,link,unlink,fontselect,fontsizeselect,forecolor,backcolor,pasteword,|,search,replace,code,",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
  entity_encoding : "raw",
	force_br_newlines : false,
	force_p_newlines : false,
	theme_advanced_resizing : true
});
tinyMCE.init({
	mode : "exact",
	elements : "error_guide",
	theme : "advanced",
	skin : "o2k7",
	plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",
	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,link,unlink,fontselect,fontsizeselect,forecolor,backcolor,pasteword,|,search,replace,code,",
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
			objErrors.processAction("admin_errors.php?task=new&ajax=1");
		}
		if (action == 'edit') {
			objErrors.processAction("admin_errors.php?task=edit&ajax=1");
		}
	}
	else {
		if (pressbutton == 'cancel' || pressbutton == 'new' || pressbutton == 'publish' || pressbutton == 'unpublish' || pressbutton == 'delete') {
			document.adminForm.task.value=pressbutton;
		}
		document.adminForm.submit();
	}
}

if (typeof objErrors == 'undefined') {
	objErrors = {
		processAction: function(sUrl) {
			var error_id = $('#error_id').attr('value');
			var typecard = $("#error_card_type").val();
			var code = $('#error_response_code').attr('value');
			var error_title = $('#error_title').attr('value');
			
			var error_guide = tinyMCE.get('error_guide').getContent();
			if(typeof(error_guide)=='undefined') error_guide='';
    		var error_message = tinyMCE.get('error_message').getContent();
    		if(typeof(error_message)=='undefined') error_message='';
    		
    		var data = 'error_guide='+encodeURIComponent(error_guide);
 		    data += '&error_message='+encodeURIComponent(error_message);
 		    data += '&error_title='+error_title;
 		    data += '&code='+code;
 		    data += '&typecard='+typecard;
 		    data += '&id='+error_id;
			$.ajax({
				type: "POST",
				url: sUrl,
				data: data,
				dataType: "json",
				success: function(xmlhttp){
					var objData = xmlhttp;
					if (parseInt(objData.intOK) > 0) {
						document.location = "admin_errors.php";
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