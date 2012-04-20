<div class="pageTitle">ĐĂNG KÝ TÀI KHOẢN </div>
<div class="signinBox">
    <div class="error_reg">
		{if $error}
        	{$error}
        {/if}
    </div>
    <form method="post" name="registerAccount" onsubmit="return frmRegisterAccount(this)" >
        <label class="formLabel_02" for="Name">Họ và tên<span class="formRequest">*</span></label>

        <input type="text" class="formInput" id="Name" name="fullname" value="{$smarty.session.reg.name}"><br />
       
        <label class="formLabel_02" for="Pass">Mật khẩu<span class="formRequest">*</span></label>
        <input type="password" id="Pass" class="formInput"  name="password" value="{$smarty.session.reg.pass}"><br />
       
        <label class="formLabel_02" for="rePass">Xác nhận mật khẩu<span class="formRequest">*</span></label>
        <input type="password" id="rePass" class="formInput"  name="passconf" value="{$smarty.session.reg.passconf}"><br />
       
        <label class="formLabel_02" for="Email">Email<span class="formRequest">*</span></label>

        <input type="text" class="formInput" id="Email" name="email" title="Email đăng nhập" value="{$smarty.session.reg.email}"><br />
       
        <label class="formLabel_02" for="Phone">Điện thoại<span class="formRequest">*</span></label>
        <input type="text" class="formInput" id="Phone" name="phone" value="{$smarty.session.reg.phone}"><br />
       
        <label class="formLabel_02" for="Capthcha ">Mã số xác thực<span class="formRequest">*</span></label>
        <img src="lib/captcha/captcha.class.php" border="1"   id="imgCaptcha" >
        <img src="themes/default/images/refresh.png" class="refreshct" onclick="refreshImage(imgCaptcha)" />
        <br />
        <label class="formLabel_02" for="Capthcha ">Nhập mã số xác thực<span class="formRequest">*</span></label>
        <input type="text" class="formInput" id="Capthcha" name="security">
       
        <label class="formLabel_02"></label>
        <span class="forrmDesc">

         <label class="termofuse"><input type="checkbox" name="termofuse" class="homeSignInCheck" id="acceptReg">&nbsp;Tôi đã xem và đồng ý với Quy định của <a href="#">chungmua3hv.vn</a></label>
        </span><br />
        <label class="formLabel_02"></label>
        <input type="submit" class="formBtn" value="Đăng ký tài khoản">
    </ul>
    </form>
</div>
{literal}
   <script type="text/javascript">
	/*$("document").ready(function (){
		var url = 'http://localhost/localdeal/index.php/mod,contact/task,getcaptcha/ajax,true/';
		$.get(url, function (result){
			$("#hid_keycapcha").val(result);
		});
	});*/
	
	function refreshImage(obj){
		img_src = obj.src;
		obj.src = img_src + "?rand=1"+ Math.random();
		var url = '?mod=account&task=getcaptcha&ajax=true/';
		$.get(url, function (result){
			$("#hid_keycapcha").val(result);
		});
	}
	
</script>{/literal}       	