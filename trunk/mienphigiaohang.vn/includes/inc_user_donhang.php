<?php
$user_name_info= getValue("user_name","str","REQUEST","");

if($user_name_info == $_SESSION['ses_username']){

 ?>
<div class="box">
<?php 
 		$user_id =$_SESSION['ses_userid'];
	
        $select_cart_user = new db_query(" SELECT *
									 FROM cart_multi									 
									 WHERE  user_id = " . $user_id);
        
		
?>
<div class="title-style2"><strong>Thông tin thanh toán của tài khoản: <?=$_SESSION['ses_username']?></strong></div>
    <div class="detail-table1 clearfix">
    		<table width="100%" class="table1">
						<tr class="bg-blue">
                        	<td class="text-left" width="10%">STT</td>
							<td class="text-left" width="40%">Sản phẩm</td>
							<td width="15%">Số lượng</td>							
							<td width="20%">Thành tiền(VNĐ)</td>
                            <td width="20%">Ngày giao dịch</td>
                            <td width="20%">Trạng thái</td>
						</tr>
                        <?php
						$i = 0;
						while($rows = mysql_fetch_assoc($select_cart_user->result)){
						  $pro_id = $rows["pro_id"];
						  //get tên sp:
						  $select_cart_pro = new db_query(" SELECT *
													   FROM products_multi									 
													   WHERE  pro_id = " . $pro_id);
						  $rows_pro = mysql_fetch_assoc($select_cart_pro->result);
							$i++;
						
						 ?>
						<tr>
                        <td class="text-left"><strong><?=$i?></strong></td>
                        <td class="text-left"><!--<strong>Free Shiping</strong>--><?= $rows_pro["pro_name"]?> <!-- - GIẢM GIÁ <?//=$rows_pro["pro_discount"]?>%--></td>
				
							<td><strong><?=$rows["cart_quality"]?></strong></td>							
							<td><strong><strong><?=number_format($rows_pro["pro_price_deal"]*$rows["cart_quality"],0,"",".")?> VNĐ</strong></td>
                            <td><strong><?=date("d/m/Y h:m:s",$rows["time_sent"])?></strong></td>
                             <td class="text-left"><strong><?php 
				 if($rows["oder_status"] ==1){echo 'Đang xử lý';}
				 else if($rows["oder_status"] ==2){echo 'Hoàn tất';}
				 else if($rows["oder_status"] ==3){echo 'Đơn hàng hủy';}
			?></strong></td>
						</tr>
                        <?php }?>
						
					</table>
                    <div class="detail-table clearfix">
                    	<p align="center"><strong>Cảm ơn bạn đã mua hàng tại <a href="http://mienphigiaohang.com">Mienphigiaohang.vn</a></strong></p>
						<p align="center"><strong>Bạn sẽ nhận được voucher do <a href="http://mienphigiaohang.com">Mienphigiaohang.vn</a> cung cấp sau khi thanh toán.</strong></p>
                        <p align="right" style="font-size:12px">Click <a href="../">vào đây</a> để quay lại trang chủ.</p> 
						<!--<p align="center"><img src="../images/card.jpg"  alt="pic" /></p>-->
					</div>
    </div>
</div>                    
 <?php } else {?>
  
  <div class="box">
<div class="title-style2"><strong>Bạn Không thể vào trang này ! Trở lại trang chủ.</strong></div></div> 
<?php }?>                                        