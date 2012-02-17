
<div class="buttons">
  <table>
    <tr>
      <td align="left"><a onclick="location = '<?php echo str_replace('&', '&amp;', $back); ?>'" class="button"><span><?php echo $button_back; ?></span></a></td>
      <td align="right"><a onclick="$('#checkout').submit();" id="checkout" class="button"><span><?php echo $button_confirm; ?></span></a></td>
    </tr>
  </table>
</div>
<script type="text/javascript"><!--
$('#checkout').click(function() {
	$.ajax({ 
		type: 'GET',
		url: 'index.php?route=payment/baokim/confirm',		
		success: function() {
			location = '<?php echo $action; ?>';
		}	
	});
});
//--></script>