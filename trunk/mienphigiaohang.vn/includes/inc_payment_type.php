<?/*
//doan code mau ket noi nhanh Payoo, nhan ket qua tra ve
//phien ban 0.1
//update 20.07.2011
//hotro YIM: jetleehung


//--------config key
$key='67d16d00201083a2b118dd5128dd6f59';

//--lay thong tin tra ve tu Payoo redirect

$order_no=$_GET['order_no'];
$session=$_GET['session'];
$status=$_GET['status'];
//tao checksum de kiem tra 
$cs=sha1($key.$session.'.'.$order_no.'.'.$status);

if($cs==$_GET['checksum']){
//dung thong tin, update don hang
echo 'OK';
}
else {
die('Co loi trong qua trinh xu ly, vui long lien he bo phan khach hang');
}*/
?>

<?php
include("inc_checkout.php");
$user_id = $_SESSION['ses_userid'];
$select_user = new db_query(" SELECT *
									 FROM users									 
									 WHERE  id = '".$user_id."'");
	$row_user = mysql_fetch_assoc($select_user->result);
	
$pro_cart_id= getValue("id","int","GET",0);
        $select_pro_cart = new db_query(" SELECT *
									 FROM products_multi									 
									 WHERE  pro_id = " . $pro_cart_id);
        $rows_pro_cart = mysql_fetch_assoc($select_pro_cart->result);
?>
<script src="http://mienphigiaohang.vn/js/jquery.js"></script>

<script type="text/javascript">
	 
	  
	  //show type payment

	  $(document).ready(function() {
		   $('#checkhome').click(function(){
			 $('#viadeal').hide();
			 $('#baokim').hide();
			 $('#giaonhan').show();
			 document.getElementById("checkdeal").checked= false;
			 document.getElementById("checkbaokim").checked= false;
		   });
		   $('#checkdeal').click(function(){
			 $('#viadeal').show();
			  $('#baokim').hide();
			 $('#giaonhan').hide();
			 document.getElementById("checkhome").checked= false;
			  document.getElementById("checkbaokim").checked= false;
		   });		
		   $('#checkbaokim').click(function(){
			 $('#viadeal').hide();
			 $('#giaonhan').hide();
			  $('#baokim').show();
			 document.getElementById("checkhome").checked= false;
			 document.getElementById("checkdeal").checked= false;
		   });	
 		});
	  
	  //check script
	  function kiemtra1()
	{
		if(document.deal_checkcart_1.user_name.value=="")
		{
			alert ("Bạn phải nhập Họ tên");
			return false;
		}
				
		
		if(document.deal_checkcart_1.user_phone.value=="")
		{
			alert ("Hãy điền số điện thoại để chúng tôi liên hệ với bạn");
			return false;
		}
		
		if(document.deal_checkcart_1.user_add.value=="")
		{
			alert ("Bạn hãy điền địa chỉ của bạn");
			return false;
		}
		if (isNaN(document.deal_checkcart_1.user_phone.value))
		{
			alert("Số điện thoại của bạn không hợp lệ! Chỉ nhập số!");
			return false;
		}
		
		return true;
	}
	
	function kiemtra2()
	{
		if(document.deal_checkcart_2.user_name2.value=="")
		{
			alert ("Bạn phải nhập Họ tên");
			return false;
		}
				
		
		if(document.deal_checkcart_2.user_phone2.value=="")
		{
			alert ("Hãy điền số điện thoại để chúng tôi liên hệ với bạn");
			return false;
		}
				
		if (isNaN(document.deal_checkcart_2.user_phone2.value))
		{
			alert("Số điện thoại của bạn không hợp lệ! Chỉ nhập số!");
			return false;
		}
		
		return true;
	}
</script>
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

<div class="box">
					<div class="title-style2"><strong>Chọn hình thức thanh toán</strong></div>
					<div class="detail-table1 clearfix">
						<div class="free">
							<div class="fl">
								<input type="checkbox" name="" id="checkhome" />
								Nhận hàng và thanh toán tại nhà<span class="clred">(Áp dụng cho  Hà Nội và HCM)</span></div>
							<img src="../images/icon-home.png" width="31" height="31" alt="pi" /></div>
					<form name="deal_checkcart_1" id="deal_checkcart_1" method="post" onsubmit="return kiemtra1();">                            
						<div class="box-form" id="giaonhan" style="display:none" >
							<ul class="form-style" >
								<li class="clearfix">
									<label>Họ Tên <span class="clred">*</span></label>                                   
									<input type="text" name="user_name" value="<?=$row_user["name"]?>" style="width:300px" />
								</li>
								<li class="clearfix">
									<label>Điện Thoại <span class="clred">*</span></label>
									<input type="text" name="user_phone" value="<?=$row_user["tel"]?>" style="width:300px" />
								</li>
                                <li class="clearfix bottom">
									<label>Địa chỉ <span class="clred">*</span></label>
									<textarea name="user_add" class="textarea1"><?=$row_user["address"]?></textarea>
								</li>
								
								<li class="clearfix bottom">
									<label>Lời nhắn <span class="clred">*</span></label>
									<textarea name="user_mess" class="textarea1"></textarea>
								</li>
								<li class="clearfix">
									<label>&nbsp;</label>
									<input type="checkbox" name="" />
									Tôi đồng ý nhận thông báo Sản phẩm hấp dẫn mỗi ngày qua Email </li>
								<li class="clearfix">
									<label>&nbsp;</label>
									<div class="fl btn1">
                           <input type="hidden"  id="soluong1" value="1" name="soluong1"  onKeyDown="calculate()" />
                           <input type="hidden"  id="pro_id1" value="<?=$rows_pro_cart["pro_id"]?>" name="pro_id1" />
                           <input type="hidden"  id="total1" value="<?=$rows_pro_cart["pro_price_deal"]?>" name="total1"  onKeyDown="calculate()" />
                           <input type="hidden" name="form_checkout1" value="form_checkout1" /> 
										<input type="submit" value="MUA HÀNG" class="button-blue" />
									</div>
								</li>
							</ul>
						</div>
					</form>                        
					<div class="free">
						<div class="fl">
							<input type="checkbox" name="" id="checkdeal"  />
							Thanh toán qua ngân hàng, các ví điện tử, thẻ cào điện thoại và nhận hàng qua Chuyển phát nhanh </div>
							<!--<img src="../images/123Deals.png" width="96" height="30" alt="pic" />-->
					</div>
					<form name="deal_checkcart_2" id="deal_checkcart_2" method="post" onsubmit="return kiemtra2();">                            
                        <div class="box-form" id="viadeal" style="display:none">
							<ul class="form-style">
								<li class="clearfix">
									<label>Họ Tên <span class="clred">*</span></label>
									<input type="text" name="user_name2" value="<?=$row_user["name"]?>" style="width:300px" />
								</li>
								<li class="clearfix">
									<label>Điện Thoại <span class="clred">*</span></label>
									<input type="text" name="user_phone2" value="<?=$row_user["tel"]?>" style="width:300px" />
								</li>
								<li class="clearfix bottom">
									<label>Lời nhắn <span class="clred">*</span></label>
									<textarea name="user_mess2" class="textarea1"></textarea>
								</li>
								<li class="clearfix">
									<label>&nbsp;</label>
									<input type="checkbox" name="" />
									Tôi đồng ý nhận thông báo sản phẩm hấp dẫn mỗi ngày qua Email </li>
								<li class="clearfix">
									<label>&nbsp;</label>                                   
                           <input type="hidden"  id="soluong2" value="1" name="soluong2"  onKeyDown="calculate()" />
                           <input type="hidden"  id="pro_id2" value="<?=$rows_pro_cart["pro_id"]?>" name="pro_id2" />
                           <input type="hidden"  id="total2" value="<?=$rows_pro_cart["pro_price_deal"]?>" name="total2"  onKeyDown="calculate()" />
                           <input type="hidden" name="form_checkout2" value="form_checkout2" />
									<div class="fl btn1">
                                    	
										<input type="submit" value="MUA HÀNG" class="button-blue" />
									</div>
								</li>
							</ul>
						</div>	
                 </form>
                 <div class="free">
						<div class="fl">
							<input type="checkbox" name="" id="checkbaokim" />
							<div style="float: left; margin-right: 15px;">
							<div id="shp"></div>
							<div id="shp_first">
							<?php
							include("../classes/class_payment.php");
							$price_shp = $rows_pro_cart["pro_price_deal"];
							$name_shp = $rows_pro_cart["pro_name"];
							$params = array(
						        'transaction_info'  	=> 'Mua sản phẩm '.$name_shp.' từ mienphigiaohang.vn',
						        'price'                 => $price_shp,
						        'order_product_title' 	=> $name_shp,
								'order_number_min'		=> 1,	
						        'order_ship'          	=> 0,	
						        'return_url'	      	=> 'http://mienphigiaohang.vn/deals'				
					        );
					        $classPayment = new PG_checkout();
							print $classPayment->buildEmbedHTML($params);						
							?>
							</div>
							<script type="text/javascript">
							$(function(){
								$('#quali').change(function(){
									var soluong = $('#quali').val();
									$('#shp_first').hide();
									$.post("../includes/ajax.php", { name: "<?php echo $name_shp;?>", soluong: soluong, price: <?php echo $price_shp;?> },
											 function(data) {
											     $('#shp').html(data);
											   }
									);
								});
							});

							$.post("test.php", { name: "John", time: "2pm" } );
							</script>
							<a style="text-decoration:none; font-size: 12px;" target="_blank" href="https://sohapay.com/info/help/huong-dan-thanh-toan.html"><font color="#FF0000"><blink>[ Hướng dẫn thanh toán]</blink></font></a>
							</div>
							<div style="float: left;">
                                <a href="https://www.baokim.vn/payment/customize_payment/product?business=tienthanh.vnu@gmail.com&product_name=<?=$rows_pro_cart["pro_name"]?>&product_price=<?=$rows_pro_cart["pro_price_deal"]?>&product_quantity=1&total_amount=<?=$rows_pro_cart["pro_price_deal"]?>" onKeyDown="calculate()" id="yugj" target="_blank">
								<img src="https://www.baokim.vn/application/uploads/buttons/btn_safety_payment_1.png" alt="Thanh toán an toàn với Bảo Kim !" border="0" title="Thanh toán trực tuyến an toàn dùng tài khoản Ngân hàng (VietcomBank, TechcomBank, Đông Á, VietinBank, Quân Đội, VIB, SHB,... và thẻ Quốc tế (Visa, Master Card...) qua Cổng thanh toán trực tuyến BảoKim.vn" >
								</a><br/><a href="https://www.baokim.vn/payment_guide/mienphigiaohangcom.html" target="_blank" style="text-decoration:none; font-size: 12px;"><font color="#FF0000"><blink>[ Hướng dẫn thanh toán]</blink></font></a>
							</div>
                            </div>
				 </div>
 	                        
							
		              
							<?
							//doan code mau ket noi nhanh Payoo
							//phien ban 0.1
							//update 20.07.2011
							//hotro YIM: jetleehung

							//----------------khai bao config website va vi dien tu ban hang - Phan nay do Payoo cung cap khi doanh nghiep da tao vdt
							$vdt='tienthanhvnu1';
							$shop_id=272;
							$shop_title='mienphigiaohang.vn';
							$shop_domain='http://mienphigiaohang.vn';
							$key='67d16d00201083a2b118dd5128dd6f59';

							$shop_back_url=$shop_domain.'/receive.php'; // duong dan tro ve sau khi thanh toan xong
							//---------------- ket thuc khai bao config


							//---------------- thong tin don hang - DN cap nhat thong tin cho phu hop vao doan nay
							//ma don hang
							$order_no=time();

							//ngay chuyen hang, dinh dang dd/mm/YYYY vd: 31/12/2011
							//ngay chuyen hang phai >= ngay hien tai
							$order_ship_date=date('d/m/Y');

							//so ngay chuyen hang 
							$order_ship_days=1;

							//so tien cua don hang
							$order_cash_amount=number_format($rows_pro["pro_price_deal"]*$rows["cart_quality"],0,"",".");

							//thong tin chi tiet don hang, do dai phai lon hon 50 ky tu
							//thong tin co the dung HTML nhung truoc khi gui phai dung urlencode de encode lai.
							$chi_tiet_don_hang.='<table border=1>
													<tr style="font-weight:bold;">
														<td>STT</td>
														<td>Ten san pham</td>
														<td>So luong</td>
														<td>Giá (d)</td>
														<td>Thành tien (d)</td>
													</tr>';
							$chi_tiet_don_hang.='	<tr>
														<td><></td>
														<td><.$rows_pro_cart["pro_name"]?></td>
														<td><.$rows["cart_quality"]?></td>
														<td><.$rows_pro_cart["pro_price_deal"]?></td>
														<td><.number_format($rows_pro["pro_price_deal"]*$rows["cart_quality"],0,"",".");?></td>
													</tr>';
							//$chi_tiet_don_hang.='	<tr><td>2</td><td>San pham 2</td><td>1</td><td>2.000</td><td>2.000</td></tr>';
							//$chi_tiet_don_hang.='<tr><td colspan=4>Tong cong</td><td>3.000</td></tr>';
							$chi_tiet_don_hang.='</table>';

							$order_description=urlencode($chi_tiet_don_hang);
							//---------------- ket thuc thong tin don hang

							//tao doan XML de POST ve Payoo, phan nay khong can chinh sua
							$str='<shops>
									<shop>
										<session>'.$order_no.'</session>
										<username>'.$vdt.'</username>
										<shop_id>'.$shop_id.'</shop_id>
										<shop_title>'.$shop_title.'</shop_title>
										<shop_domain>'.$shop_domain.'</shop_domain>
										<shop_back_url>'.$shop_back_url.'</shop_back_url>
										<order_no>'.$order_no.'</order_no>
										<order_cash_amount>'.$order_cash_amount.'</order_cash_amount>
										<order_ship_date>'.$order_ship_date.'</order_ship_date>
										<order_ship_days>'.$order_ship_days.'</order_ship_days>
										<order_description>'.$order_description.'</order_description>
									</shop>
									</shops>';

							//tao checksum de gui qua Payoo nham xac thuc thong tin
							//qui luat sha1(key+xml);
							$checksum=sha1($key.$str);
							?>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<form name="frmPayByPayoo" action="https://www.payoo.com.vn/m/payorder" method="POST" target="_blank">
						<input name = "imageField" type = "image" id = "imageField" alt = "Thanh toán b&#7857;ng Ví &#273;i&#7879;n t&#7917; Payoo" src ="https://www.payoo.com.vn/img/button/PayNow.jpg"/> 
						<input type="hidden" name="cmd" value="_cart" />
						<input type="hidden" name="OrdersForPayoo" value='<?=$str?>'/>
						<input type="hidden" value="<?=$checksum?>" name="CheckSum" />
						</form>               
                 		
				</div>
                </div>
                