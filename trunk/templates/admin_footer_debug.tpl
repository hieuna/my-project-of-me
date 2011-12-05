<!-- BEGIN DEBUG -->
<div id="pg_debug_window" style="display:none;">
	<div id="pg_debug_window_body">
      <div id="pg_debug_window_body_container"></div>
    </div>
</div>
<link rel="stylesheet" href="../templates/css/debug.css" title="stylesheet" type="text/css" />
<link rel="stylesheet" href="../include/sqlparserlib/sqlsyntax.css" title="stylesheet" type="text/css" />
<script type="text/javascript" src="../include/js/jquery/js/jquery-ui-1.8.2.custom.min.js"></script>
{literal}
<script type='text/javascript'>
$('window').ready(function() {
	$.ajax({
	    url: '../ajax.php',
	    type: 'POST',
	    data: {
	      	task: 'get_debug_info',
	      	id: '{/literal}{$debug_uid}{literal}'
	    },
	    success: function(data)
	    {
	      	$('#pg_debug_window_body_container').html(data);
			
	      	$('#pg_debug_window').css('display','');
	    }
	});
});
</script>
{/literal}
<!-- END DEBUG -->