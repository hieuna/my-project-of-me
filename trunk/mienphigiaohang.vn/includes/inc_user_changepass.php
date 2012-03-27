<?php
$user_name_info= getValue("user_name","str","REQUEST","");

if($user_name_info == $_SESSION['ses_username']){
include("inc_submit_use_changepass.php");
?>
<script type="text/javascript">
function check_input_regis()
	{
		if(document.deal_regis.pass.value=="")
		{
			document.getElementById("check_pass").innerHTML  = "Hãy nhập mật khẩu  đăng nhập của bạn";
			return false;
		}
		if(document.deal_regis.pass.value.length < 6){
			document.getElementById("check_pass").innerHTML  = "Mật khẩu phải lớn hơn hoặc bằng 6 ký tự";
			return false;
			}
		if(document.deal_regis.pass.value != document.deal_regis.re_pass.value)
		{
			document.getElementById("check_repass").innerHTML  = "Mật khẩu không trùng khớp";
			return false;
		}
		
		if(document.deal_regis.pass.re_pass.length < 6){
			document.getElementById("check_repass").innerHTML  = "Mật khẩu phải lớn hơn hoặc bằng 6 ký tự";
			return false;
			}	
		
				
		return true;		
	} 
		
</script>
<?php 
$user_id =$_SESSION['ses_userid'];
$select_user_info = new db_query(" SELECT * 
									 FROM users									 
									 WHERE  id = '".$user_id."'");
$row_user_info = mysql_fetch_assoc($select_user_info->result);
?>

 <form name="deal_regis" id="deal_regis" method="post" onsubmit="return check_input_regis();">

<div class="box">
<div class="title-style2"><strong>Thay đổi mật khẩu tài khoản : <?=$_SESSION['ses_username']?></strong></div>
					<div class="detail-table1 clearfix">
						
						<div class="box-form1 clearfix">
						<div class="col-style1">
							<ul class="form-style">
								<li class="clearfix">
									<label>Mật Khẩu <span class="clred">*</span></label>
									<input type="password" value="" id="pass" name="pass" style="width:300px" />
                                    <span id="check_pass" style="font-size:11px; color:#900; margin-left:54px"></span>
								</li>
								<li class="clearfix">
									<label>Nhập Lại Mật Khẩu <span class="clred">*</span></label>
									<input type="password" value="" id="re_pass" name="re_pass" style="width:300px" />
                                    <span id="check_repass" style="font-size:11px; color:#900; margin-left:54px"></span>
								</li>
                                
								
							</ul>
							</div>
							
							<div class="clear"></div>
							
							<div class="button-style2">
                             	<input type="hidden" name="form_bk" value="form_bk" /> 
								<input id="chapnhan" type="submit" value="CHẤP NHẬN" class="button-blue" />
							</div>
						</div>
					</div>
</div> 
  </form>   
  <?php } else {?>
  
  <div class="box">
<div class="title-style2"><strong>Bạn Không thể vào trang này ! Trở lại trang chủ.</strong></div></div> 
<?php }?>                