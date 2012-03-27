<div class="box">
<?php 
 		$cart_id = getValue("cart_id","int","GET",0);
		
        $select_cart_user = new db_query(" SELECT *
									 FROM cart_multi									 
									 WHERE  Id = " . $cart_id);
        $rows = mysql_fetch_assoc($select_cart_user->result);
		$pro_id = $rows["pro_id"];
		//get tên sp:
		$select_cart_pro = new db_query(" SELECT *
									 FROM products_multi									 
									 WHERE  pro_id = " . $pro_id);
        $rows_pro = mysql_fetch_assoc($select_cart_pro->result);
		
?>
<div class="title-style2"><strong>Thanh toán thành công! </strong></div>
    <div class="detail-table1 clearfix">
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
							<td class="text-left"><strong><?=$rows_pro["pro_name"]?> -<span> (Miễn phí giao hàng)</span> <?//=$rows_pro["pro_discount"]?><!--%--></strong></td>
							<td><strong><?=$rows["cart_quality"]?></strong></td>
							<td><strong>x</strong></td>
							<td><strong ><?=number_format($rows_pro["pro_price_deal"],0,"",".")?></strong></td>
							<td><strong>=</strong></td>
							<td><strong><strong><?=number_format($rows_pro["pro_price_deal"]*$rows["cart_quality"],0,"",".")?> VNĐ</strong></td>
						</tr>
						<tr class="bg-blue">
							<td colspan="6" class="text-sum"><span>Tình trạng:</span> <strong>Đang xử lý</strong></td>
						</tr>
					</table>
                    <div class="detail-table clearfix">
                    	<p align="center"><strong>Cảm ơn bạn đã mua hàng tại <a href="../">Mienphigiaohang.vn</a></strong></p>
						<p align="center"><strong>Bạn sẽ nhận được voucher do <a href="../">Mienphigiaohang.vn</a> cung cấp sau khi thanh toán.</strong></p>
                        <p align="right" style="font-size:12px">Click <a href="../">vào đây</a> để quay lại trang chủ.</p>
						<!--<p align="center"><img src="../images/card.jpg"  alt="pic" /></p>-->
					</div>
    </div>
</div>                    
                        