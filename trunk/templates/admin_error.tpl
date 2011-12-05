{include file='admin_header.tpl'}
<div class="ui-widget">
	<div style="padding: 5pt 0.7em;" class="ui-state-error ui-corner-all"> 
		<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-alert"></span> 
		<b>{$error_header}:</b> {$error_message}</p>
	</div>
</div>
<input class="mt2" type='button' class='button' value='{$error_submit}' onClick='history.go(-1)'>
{include file='admin_footer.tpl'}