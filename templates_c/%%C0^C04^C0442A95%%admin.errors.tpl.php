<?php /* Smarty version 2.6.10, created on 2012-02-14 14:33:51
         compiled from D:/AppServ/www/mobimart/templates/administrator/admin.errors.tpl */ ?>
<div class="ui-widget">
	<div style="padding: 5pt 0.7em;" class="ui-state-error ui-corner-all"> 
		<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-alert"></span> 
		<b><?php echo $this->_tpl_vars['error_header']; ?>
:</b> <?php echo $this->_tpl_vars['error_message']; ?>
</p>
	</div>
</div>
<input class="mt2" type='button' class='button' value='<?php echo $this->_tpl_vars['error_submit']; ?>
' onClick='history.go(-1)'>