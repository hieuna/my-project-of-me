<form action="<?php echo str_replace('&', '&amp;', $action); ?>" method="post" id="checkout">
  
</form>
<div class="buttons">
  <table>
    <tr>
      <td align="left"><a onclick="location = '<?php echo str_replace('&', '&amp;', $back); ?>'" class="button"><span><?php echo $button_back; ?></span></a></td>
      <td align="right"><a id="click_to_payment" class="button"><span><?php echo $button_confirm; ?></span></a></td>
    </tr>
  </table>
</div>
<script type="text/javascript"><!--
$('#click_to_payment').click(function() {
	$.ajax({ 
		type: 'GET',
		url: 'index.php?route=payment/cod/confirm',
		success: function() {
		    $.post("index.php?route=checkout/success", function(){
				$('#checkout')[0].submit();
			});
		}		
	});
});
//-->
</script>
