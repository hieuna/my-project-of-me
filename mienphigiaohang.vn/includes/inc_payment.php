<?php
$pro_cart_id= getValue("id","int","GET",0);
        $select_pro_cart = new db_query(" SELECT *
									 FROM products_multi									 
									 WHERE  pro_id = " . $pro_cart_id);
        $rows_pro_cart = mysql_fetch_assoc($select_pro_cart->result);
?>

<script type="text/javascript">
function calculate()
	{	
		var product_price = document.getElementById('price').value;        
		var soluong = document.getElementById('quali').value;;
		document.getElementById('tonggia').innerHTML = product_price*soluong;
		document.getElementById('total_amount').innerHTML = product_price*soluong;
		document.getElementById('total1').value = product_price*soluong;
		document.getElementById('soluong1').value = soluong;
		document.getElementById('total2').value = product_price*soluong;
		document.getElementById('soluong2').value = soluong;
		document.getElementById('yugj').innerHTML= "<a href='https://www.baokim.vn/payment/customize_payment/product?business=tienthanh.vnu@gmail.com&product_name=<?=$rows_pro_cart["pro_name"]?>&product_price="+ product_price*soluong + "&product_quantity=1&total_amount=" + product_price*soluong + "' target='_blank'>
<img src='
https://www.baokim.vn/application/uploads/buttons/btn_safety_payment_1.png' alt='Thanh toán an toàn với Bảo Kim !' border='0' title='Thanh toán trực tuyến an toàn dùng tài khoản Ngân hàng (VietcomBank, TechcomBank, Đông Á, VietinBank, Quân Đội, VIB, SHB,... và thẻ Quốc tế (Visa, Master Card...) qua Cổng thanh toán trực tuyến BảoKim.vn' >
</a>";
		return true;
	}
</script>
 <form name="deal_cart" id="deal_cart" method="post">

<div class="box">
					<div class="title-style1"><strong>Đặt hàng</strong></div>
					<table width="100%" class="table1">
						<tr class="bg-blue">
							<td class="text-left" width="40%">Sản phẩm</td>
							<td width="15%">Số lượng</td>
							<td width="3%">&nbsp;</td>
							<td width="19%">Đơn giá(VNĐ)</td>
							<td width="3%">&nbsp;</td>
							<td width="20%">Thành tiền(VNĐ)</td>
						</tr>
						<tr>
							<td class="text-left"><strong><?=$rows_pro_cart["pro_name"]?> - <span>(Miễn phí giao hàng)</span> <?//=$rows_pro_cart["pro_discount"]?><!--%--></strong></td>
							<td><select name="quali" id="quali" onChange="calculate()" style="width:50px; font-size:18px; height:25px">
														<option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
								</select></td>
							<td><strong>x</strong></td>
							<td><strong ><?=number_format($rows_pro_cart["pro_price_deal"],0,"",".")?><input type="hidden" value="<?=$rows_pro_cart["pro_price_deal"]?>" id="price" onKeyDown="calculate()" /></strong></td>
							<td><strong>=</strong></td>
							<td><strong><strong><span id="tonggia" onKeyDown="calculate()"><?=number_format($rows_pro_cart["pro_price_deal"],0,"",".")?></span></strong></td>
						</tr>
						<tr class="bg-blue">
							<td colspan="6" class="text-sum"><span>Bạn cần thanh toán:</span> <strong><span id="total_amount" onKeyDown="calculate()"><?=number_format($rows_pro_cart["pro_price_deal"],0,"",".")?></span> VNĐ</strong></td>
						</tr>
                        
					</table>
					<div class="detail-table clearfix">
						<p align="center"><strong>Bạn sẽ nhận được sản phẩm <font color="red"> TẠI NHÀ, được MIỄN PHÍ VẬN CHUYỂN </font> do <a href="#">Mienphigiaohang.vn</a> cung cấp sau khi thanh toán hoặc xác nhận đặt hàng.</strong></p>
					<!--	<p align="center"><img src="../images/card.jpg"  alt="pic" /></p>-->
					</div>
				</div>
</form>                