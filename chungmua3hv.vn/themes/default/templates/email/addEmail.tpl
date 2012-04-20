{literal}
<script>
 function checkFormEmail(frm){
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	if(frm.frmEmail.value==''){
		alert('Xin vui lòng nhập email.');
		frm.frmEmail.focus();
		return false;
	}
     if (document.emailForm.frmEmail.value.search(emailRegEx) == -1) {
          alert("Bạn nhập sai địa chỉ email.");
		frm.frmEmail.focus();
		  return false;
	 }
	 
	$(this).submit(function() {
		vsgShow();
		$.post('dang-ky-nhan-khuyen-mai.html', { email: frm.frmEmail.value}, function(data) {
			vsgClose();
		  $('#result').html(data);
		});	 	 
		return false;
	});	 
	 return false;
   }
	 
	
</script>
{/literal}<div id="result"><div class="frmAdđEmail">
<form method="post" id="emailForm" name="emailForm" onsubmit="return checkFormEmail(this)">
<h2>Đăng ký nhận email thông báo giảm giá</h2>
<div style="font-weight:normal; color:red; margin-bottom:5px;">{if $msg}{$msg}{/if}</div>
<label style="font-weight:normal;">Email: </label> <input type="text" name="frmEmail" />
<input type="button" onclick="return closeForm();" class="formBtn" style="clear:both; margin-top:10px; margin-left:35px;"value="Thoát" />
<input type="submit" class="formBtn" style="clear:both; margin-top:10px;margin-left:5px; "value="Đăng ký" />
</form>

</div></div>
