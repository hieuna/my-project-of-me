<?php
$user_name_info= getValue("user_name","str","REQUEST","");

if($user_name_info == $_SESSION['ses_username']){
include("inc_submit_use_profile.php");
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
<div class="title-style2"><strong>Chỉnh sửa thông tin cá nhân : <?=$_SESSION['ses_username']?></strong></div>
					<div class="detail-table1 clearfix">
						
						<div class="box-form1 clearfix">
						<div class="col-style1">
							<ul class="form-style">
								<li class="clearfix">
									<label>Họ Tên (đầy đủ & chính xác) <span class="clred">*</span></label>
									<input type="text" id="fullname" value="<?=$row_user_info["name"]?>" style="width:300px" name="fullname" />
                                    <span id="check_fullname" style="font-size:11px; color:#900; margin-left:54px"></span>
								</li>
                                <li class="clearfix">
									<label>Số điện thoại <span class="clred">*</span></label>
									<input type="text" value="<?=$row_user_info["tel"]?>" id="phone" name="phone"   style="width:300px" />
                                    <span id="check_phone" style="font-size:11px; color:#900;margin-left:54px"></span>
								</li>
								<li class="clearfix">
									<label>Địa Chỉ Email <span class="clred">*</span></label>
									<input type="text" value="<?=$row_user_info["email"]?>" id="email" name="email"  style="width:300px" />
                                    <span id="check_email" style="font-size:11px; color:#900;margin-left:54px"></span>
								</li>
                                <li class="clearfix">
									<label>Địa chỉ</label>
									<input type="text" value="<?=$row_user_info["address"]?>" id="address" name="address"  style="width:400px" />
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