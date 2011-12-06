<?php /* Smarty version 2.6.26, created on 2011-12-06 10:03:34
         compiled from footer_debug.tpl */ ?>
<!-- BEGIN DEBUG -->
<div id="pg_debug_window" style="display:none;">
	<div id="pg_debug_window_body">
      <div id="pg_debug_window_body_container"></div>
    </div>
</div>
<link rel="stylesheet" href="./templates/css/debug.css" title="stylesheet" type="text/css" />
<link rel="stylesheet" href="./include/sqlparserlib/sqlsyntax.css" title="stylesheet" type="text/css" />
<script type="text/javascript" src="./include/js/jquery/js/jquery-ui-1.8.2.custom.min.js"></script>
<?php echo '
<script type=\'text/javascript\'>
$(\'window\').ready(function() {
	$.ajax({
	    url: \'ajax.php\',
	    type: \'POST\',
	    data: {
	      	task: \'get_debug_info\',
	      	id: \''; ?>
<?php echo $this->_tpl_vars['debug_uid']; ?>
<?php echo '\'
	    },
	    success: function(data)
	    {
	      	$(\'#pg_debug_window_body_container\').html(data);
			
	      	$(\'#pg_debug_window\').css(\'display\',\'\');
	    }
	});
});
</script>
'; ?>

<!-- END DEBUG -->