<?php
include("inc_checkout.php");
$user_id = $_SESSION['ses_userid'];
$select_user = new db_query(" SELECT *
									 FROM users									 
									 WHERE  id = '".$user_id."'");
	$row_user = mysql_fetch_assoc($select_user->result);
?>
<script src="http://123deals.vn/js/jquery.js"></script>

<script type="text/javascript">
	 
	  
	  //show type payment

	  $(document).ready(function() {
		   $('#checkhome').click(function(){
			 $('#viadeal').hide();
			 $('#giaonhan').show();
			 document.getElementById("checkdeal").checked= false;
		   });
		   $('#checkdeal').click(function(){
			 $('#viadeal').show();
			 $('#giaonhan').hide();
			 document.getElementById("checkhome").checked= false;
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
<div class="box">
					<div class="title-style2"><strong>Chọn hình thức thanh toán</strong></div>
					<div class="detail-table1 clearfix">
						<div class="free">
							<div class="fl">
								<input type="checkbox" name="" id="checkhome" />
								Nhận hàng và thanh toán tại nhà<span class="clred">(Áp dụng cho nội thành Hà Nội và HCM)</span></div>
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
							<!--<img src="../images/123Deals.png" width="96" height="30" alt="pic" />--></div>
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
									Tôi đồng ý nhận thông báo Deals hấp dẫn mỗi ngày qua Email </li>
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
				</div>
                </div>
                