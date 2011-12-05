<Table x:FullColumns="1" x:FullRows="1">
  <Row>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Website</Data></Cell>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Mã TT</Data></Cell>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Số tiền ĐH (VNĐ)</Data></Cell>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Số tiền TT (VNĐ)</Data></Cell>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Phương thức TT</Data></Cell>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Thông tin ĐH</Data></Cell>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Thời gian</Data></Cell>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Email</Data></Cell>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Trạng thái TT</Data></Cell>
  </Row>
  {foreach from=$aryPayment key=k item=payment}
  <Row>
	<Cell ss:StyleID="s21"><Data ss:Type="String">{$payment.site_name}</Data></Cell>
	<Cell ss:StyleID="s21"><Data ss:Type="String">{$payment.payment_onepay_merchTxnRef}</Data></Cell>
	<Cell ss:StyleID="s21"><Data ss:Type="Number">{$payment.order_price}</Data></Cell>
	<Cell ss:StyleID="s21"><Data ss:Type="Number">{$payment.payment_total}</Data></Cell>
	<Cell ss:StyleID="s21"><Data ss:Type="String">{$payment.payment_onepay_card_type}</Data></Cell>
	<Cell ss:StyleID="s21"><Data ss:Type="String">{$payment.order_info}</Data></Cell>
	<Cell ss:StyleID="s22"><Data ss:Type="String">{$payment.payment_time}</Data></Cell>
	<Cell ss:StyleID="s22"><Data ss:Type="String">{$payment.order_email}</Data></Cell>
	<Cell ss:StyleID="s21"><Data ss:Type="String">
		{if $payment.order_status==2}refund
		{elseif $payment.payment_status==1}successful
		{elseif $payment.payment_status==-1}paying
		{elseif $payment.payment_status==2}failed
		{elseif $payment.payment_status==4}cancel
		{elseif $payment.payment_status==5}pending
		{elseif $payment.payment_status==6}risk
		{/if}
	</Data></Cell>
  </Row>
  {/foreach}
</Table>