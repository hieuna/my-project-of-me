<Table x:FullColumns="1" x:FullRows="1">
  <Row>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Tên khách hàng</Data></Cell>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Email</Data></Cell>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Số điện thoại</Data></Cell>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Địa chỉ</Data></Cell>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Ngày mua</Data></Cell>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Sản phẩm</Data></Cell>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Giá tiền</Data></Cell>
	<Cell ss:StyleID="s23"><Data ss:Type="String">Giá khuyến mãi</Data></Cell>
  </Row>
  {foreach from=$aryCus key=k item=customer}
  <Row>
	<Cell ss:StyleID="s21"><Data ss:Type="String">{if $customer.name == ""}Không cung cấp tên{else}{$customer.name}{/if}</Data></Cell>
	<Cell ss:StyleID="s21"><Data ss:Type="String">{$customer.email}</Data></Cell>
	<Cell ss:StyleID="s21"><Data ss:Type="String">{$customer.phone}</Data></Cell>
	<Cell ss:StyleID="s21"><Data ss:Type="String">{$customer.address}</Data></Cell>
	<Cell ss:StyleID="s21"><Data ss:Type="String">{$customer.date}</Data></Cell>
	<Cell ss:StyleID="s21"><Data ss:Type="String"></Data></Cell>
	<Cell ss:StyleID="s21"><Data ss:Type="String">{$customer.price}</Data></Cell>
	<Cell ss:StyleID="s22"><Data ss:Type="String">{if $customer.is_promotion==1}Có{else}Không{/if}</Data></Cell>
  </Row>
  {/foreach}
</Table>