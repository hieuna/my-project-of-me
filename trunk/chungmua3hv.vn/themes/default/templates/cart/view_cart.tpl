{literal}
<script type="text/javascript">
	function updateCart(){
		document.frm_cart.action = "{/literal}{$smarty.const.SITE_URL}{literal}index.php?mod=cart&task=update_cart";
		document.frm_cart.submit();
	}
</script>
{/literal}
<div class="Module">
	<div class="tabBlue">					
		<b>{#cart#}</b>
	</div>
	
	<div class="borderModule">
		<form name="frm_cart" action="" method="post">
		
			 <table width="100%" cellpadding="3" cellspacing="1" border="1" bordercolor="#999" style="border-collapse:collapse;">
			   <tr align="center">
					<th>Tên sản phẩm</th>
					<th>Đơn gián</th>
					<th>Số lượng</th>
					<th>Thành tiền</th>
					<th>Chức năng</th>
			   </tr>
			   
			   {foreach item=item from=$result}
			   {assign var=pid value=$item.Product_ID}
			   {assign var="delete_link" value="index.php?mod=cart&task=delete&pid=$pid"}
			   <tr>
					<td align="center">{$item.Product_Name}</td>				   		
					<td width="90" align="center" valign="middle">
						{$item.Product_Price|number_format:0:".":"."} {$currency}
					</td>
					<td width="90" align="center" valign="middle">
						<input type="text" name="quantity[{$pid}]" style="width:50px;" value="{$item.quantity}"/>
					</td>
					<td width="100" align="right"><b style="color:#FF0000">{$item.subtotal|number_format:0:".":"."} {$currency}</b>&nbsp;&nbsp;</td>
					<td align="center" width="50" valign="middle">
						<a href="#" onclick='if(confirm("Bạn thực sự muốn xóa?")) location.href="{$smarty.const.SITE_URL}{$delete_link|url_friendly}";'><img src="{$smarty.const.SITE_URL}/themes/default/images/delete.jpg" title="Xóa" border="0" ></a>
				   </td>
			   </tr>
			   {foreachelse}
				<tr>
				   <td colspan="6" align="center" style="padding:10px 0;"><b class="colorBrown">Chưa có sản phẩm nào trong giỏ hàng của bạn.</b></td>
			   </tr>
			   {/foreach}		   
			   
			   {if $result}			   
				<tr>
				   <td colspan="2" align="right" style="font-weight:bold; text-transform:uppercase">Thành tiền &nbsp;&nbsp;</td>
				   {assign var=translateVND value=$total*$rate}
				   <td colspan="4"><span id="total" style="font-weight:bold;">&nbsp;&nbsp;{$total|number_format:0:".":"."} {$currency} = {$translateVND|number_format:0:".":"."} vnđ </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  </span></td>				   
			   </tr>
			   {/if}
			   
			 </table>
			
			 <div style="margin-top:10px;" align="right">
				<a class="ButtonCart" href="{$smarty.const.SITE_URL}{"index.php?mod=product"|url_friendly}">Tiếp tục mua hàng</a>
				 {if $result}
				 {assign var="clear_link" value="/index.php?mod=cart&task=clear"}
				 <a class="ButtonCart" href="#" onclick="updateCart(); return false;">Cập nhật</a>
				 <a class="ButtonCart" href="{$smarty.const.SITE_URL}{"index.php?mod=cart&task=checkout"|url_friendly}">Thanh toán</a>
				 <a class="ButtonCart" href="#" onclick='if(confirm("Bạn thực sự muốn xóa giỏ hàng?")) location.href="{$smarty.const.SITE_URL}{$clear_link|url_friendly}";'>Xóa giỏ hàng</a>
				 {/if}
				 <div class="clr"></div>
			</div> 
			
		
		</form>
	</div>	
</div>
<div class="clr"></div>