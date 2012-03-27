<?php
include("inc_submit_regis_payment.php");
?>
<script type="text/javascript">
function check_input_regis()
	{
		if(document.deal_regis.fullname.value=="")
		{
			document.getElementById("check_fullname").innerHTML = "Hãy điền đầy đủ họ tên của bạn";
			return false;
		}
		if(document.deal_regis.phone.value=="")
		{
			document.getElementById("check_phone").innerHTML  = "Hãy nhập số điện thoại để chúng tôi có thể liên hệ với bạn";
			return false;
		}
				
		if((document.deal_regis.email.value.indexOf('@') < 0 ) || ((document.deal_regis.email.value.charAt(document.deal_regis.email.value.length-4)!=".")&&(document.deal_regis.email.value.charAt(document.deal_regis.email.value.length-3)!=".")))
		{
			document.getElementById("check_email").innerHTML  = "Email bạn nhập không đúng cú pháp. Email phải có cú pháp: xxx@yyy.zzz";
			return false;
		}
		
		if(document.deal_regis.user_name.value=="")
		{
			document.getElementById("txtHint").innerHTML  = "Hãy nhập tài khoản đăng nhập của bạn";
			return false;
		}
		
		if(document.deal_regis.pass.value=="")
		{
			document.getElementById("check_pass").innerHTML  = "Hãy nhập mật khẩu  đăng nhập của bạn";
			return false;
		}
		if(document.deal_regis.pass.value != document.deal_regis.re_pass.value)
		{
			document.getElementById("check_repass").innerHTML  = "Mật khẩu không trùng khớp";
			return false;
		}
		if(document.deal_regis.pass.value.length < 6){
			document.getElementById("check_pass").innerHTML  = "Mật khẩu phải lớn hơn hoặc bằng 6 ký tự";
			return false;
			}
		if(document.deal_regis.pass.re_pass.length < 6){
			document.getElementById("check_repass").innerHTML  = "Mật khẩu phải lớn hơn hoặc bằng 6 ký tự";
			return false;
			}	
		
		return true;		
	} 
		
</script>
 <form name="deal_regis" id="deal_regis" method="post" onsubmit="return check_input_regis();">

<div class="box">
<div class="title-style2"><strong>Bạn chưa có tài khoản trên Mienphigiaohang.vn ?<br>Hãy điển thông tin bên dưới để thực hiện mua hàng</strong></div>
					<div class="detail-table1 clearfix">
						
						<div class="box-form1 clearfix">
						<div class="col-style1">
							<ul class="form-style">
								<li class="clearfix">
									<label>Họ Tên (đầy đủ & chính xác) <span class="clred">*</span></label>
									<input type="text" id="fullname" value="" style="width:300px" name="fullname" />
                                    <span id="check_fullname" style="font-size:11px; color:#900; margin-left:51px"></span>
								</li>
                                <li class="clearfix">
									<label>Số điện thoại <span class="clred">*</span></label>
									<input type="text" value="" id="phone" name="phone"   style="width:300px" />
                                    <span id="check_phone" style="font-size:11px; color:#900;margin-left:51px"></span>
								</li>
								<li class="clearfix">
									<label>Địa Chỉ Email <span class="clred">*</span></label>
									<input type="text" value="" id="email" name="email"  style="width:300px" />
                                    <span id="check_email" style="font-size:11px; color:#900;margin-left:51px"></span>
								</li>
                                <li class="clearfix">
									<label>Tài khoản đăng nhập <span class="clred">*</span></label>
									<input type="text" value="" id="user_name" name="user_name"  style="width:300px" />
                                    <span id="txtHint" style="font-size:11px; color:#900;margin-left:51px"></span>
								</li>
                                
								<li class="clearfix">
									<label>Mật Khẩu <span class="clred">*</span></label>
									<input type="password" value="" id="pass" name="pass" style="width:300px" />
                                    <span id="check_pass" style="font-size:11px; color:#900; margin-left:51px"></span>
								</li>
								<li class="clearfix">
									<label>Nhập Lại Mật Khẩu <span class="clred">*</span></label>
									<input type="password" value="" id="re_pass" name="re_pass" style="width:300px" />
                                    <span id="check_repass" style="font-size:11px; color:#900; margin-left:51px"></span>
								</li>
								
							</ul>
							</div>
							<div class="col-style2">
							<p align="center"><strong class="clblue">Bạn đã có tài khoản?</strong><br /><input type="button" class="button-blue"  value="ĐĂNG NHẬP" id="dangnhap" onClick="window.location='../deals/thanh-toan-san-pham-<?=$pro_cart_id?>-log.html'" /></p>
							</div>
							<div class="clear"></div>
							<div class="agree">
							<ul class="form-style">
								<li class="clearfix">
									<label>
                                    	<input type="checkbox" name="email_sent"  value="0"/>
                                    </label>
									Bỏ chọn nếu bạn không muốn nhận thông báo sản phẩm hàng ngày qua Email
								</li>
								<li class="clearfix">
									<label><input type="checkbox" name="checkok"  id="checkok" checked="checked" /></label>
									<div class="fill-text">
										<p class="bottom3">Tôi chấp nhận các <a href="http://mienphigiaohang.vn/deals/quy-che.html" target="_blank">Quy chế sàn giao dịch</a></p>
										<p class="s12">Bằng cách chấp nhận các điều khoản & điều kiện, tôi đã đọc và đồng ý với tất cả các điều khoản và điều kiện được quy định bởi <a href="#">Mienphigiaohang.vn</a>. Nếu bạn muốn biết thêm thông tin, xin vui lòng truy cập vào trang <a href="http://mienphigiaohang.vn/deals/quy-che.html" target="_blank">Quy chế sàn giao dịch</a> của chúng tôi để đọc các điều khoản, chính sách bảo mật, và chính sách hoàn trả.</p>
								</div>
								</li>
							</ul>
							</div>
							<div class="button-style2">
                             	<input type="hidden" name="form_bk" value="form_bk" /> 
								<input id="chapnhan" type="submit" value="CHẤP NHẬN" class="button-blue" />
							</div>
						</div>
					</div>
</div> 
  </form>                   