<?php
include("inc_submit_login_payment.php");
?>
<script type="text/javascript">
function check_input_login()
	{
		
		if(document.deal_login.user_name.value=="")
		{
			document.getElementById("txtHint").innerHTML  = "Hãy nhập tài khoản đăng nhập của bạn";
			return false;
		}
		
		if(document.deal_login.pass.value=="")
		{
			document.getElementById("check_pass").innerHTML  = "Hãy nhập mật khẩu  đăng nhập của bạn";
			return false;
		}		
		if(document.deal_login.pass.value.length < 6){
			document.getElementById("check_pass").innerHTML  = "Mật khẩu phải lớn hơn hoặc bằng 6 ký tự";
			return false;
			}		
		return true;		
	} 
		
</script>
 <form name="deal_login" id="deal_login" method="post" onsubmit="return check_input_login();">
<div class="box">
    <div class="title-style2"><strong>Đăng nhập hoặc</strong> <a href="../deals/dang-ky"><strong>Đăng ký</strong></a></div>
    <div class="detail-table1 clearfix">
        
        <div class="box-form1 clearfix">
        <div class="col-style1">
            <ul class="form-style">
                <li class="clearfix">
                    <label>Tên tài khoản </label>                  
                    <input type="text" value="" id="user_name" name="user_name"  style="width:300px" />
                    <span id="txtHint" style="font-size:11px; color:#900;margin-left:51px"></span>
                </li>
                <li class="clearfix bottom3">
                    <label>Mật Khẩu </label>
                    <input type="password" value="" id="pass" name="pass" style="width:300px" />
                     <span id="check_pass" style="font-size:11px; color:#900; margin-left:51px"></span>
                </li>
                <li class="clearfix bottom">
                    <a class="s12" href="#">Quên mật khẩu?</a>
                </li>
                <li><input type="checkbox" name="" /> Nhớ tài khoản</li>
            </ul>
            </div>
            <div class="clear"></div>
            
            <div class="button-style2">
            	<input type="hidden" name="form_login" value="form_login" /> 
                <input type="submit" value="CHẤP NHẬN" class="button-blue" />
            </div>
        </div>                        
    </div>    
</div>
</form>