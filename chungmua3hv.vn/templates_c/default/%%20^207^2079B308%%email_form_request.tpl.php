<?php /* Smarty version 2.6.19, created on 2011-09-17 00:40:23
         compiled from email_form_request.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'email_form_request.tpl', 60, false),)), $this); ?>
<?php echo '
<script>
 function checkFormEmail(frm){
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\\.[A-Z]{2,4}$/i;
	if(frm.frmName.value==\'\'){
		alert(\'Xin vui lòng nhập tiêu đề thắc mắc.\');
		frm.frmName.focus();
		return false;
	}
	if(frm.frmEmail.value==\'\'){
		alert(\'Xin vui lòng nhập email.\');
		frm.frmEmail.focus();
		return false;
	}else{
     if (document.emailForm.frmEmail.value.search(emailRegEx) == -1) {
          alert("Bạn nhập sai địa chỉ email.");
			frm.frmEmail.focus();
		  return false;
	 }else{
		if(frm.frmContent.value==\'\'){
			alert(\'Xin vui lòng nhập nội dung yêu cầu.\');
			frm.frmContent.focus();
			return false;
		}
	 
	$(this).submit(function() {
		vsgShow();
		$.post(\'thac-mac-p-'; ?>
<?php echo $this->_tpl_vars['productname']['Product_ID']; ?>
<?php echo '.html\', { email: frm.frmEmail.value}, function(data) {
			vsgClose();
		  $(\'#result\').html(data);
		});	 	 
		return false;
	});	 
	 return false;
   }
 }
 }
	
</script>
'; ?>
<div id="result"><div class="frmRequestForm">
<form method="post" id="emailForm" name="emailForm" onsubmit="return checkFormEmail(this)">
<h2>Yêu cầu hỗ trợ</h2>
<h3>SẢN PHẨM: " <?php echo $this->_tpl_vars['productname']['Product_Name']; ?>
 " </h3>
<div style="font-weight:normal; color:red; margin-bottom:5px;"><?php if ($this->_tpl_vars['msg']): ?><?php echo $this->_tpl_vars['msg']; ?>
<?php endif; ?></div>

<div class="clr" style="margin-bottom:10px;"></div>

<table class="frmRequest">
<tr><td class="leftBoxrequest">
<label style="font-weight:normal;">Bạn thắc mắc về </label></td><td><select class="formInput02">
<option>Thắc mắc về sản phẩm</option>
<option>Thông báo lỗi</option>
<option>Khác</option>
</select></td></tr>
<tr><td><label style="font-weight:normal;">Tiêu đề: </label></td><td> <input class="formInput02" type="text" name="frmName" />
</td></tr>
<tr><td><label style="font-weight:normal;">Email của bạn: </label></td><td> <input class="formInput02" type="text" name="frmEmail" />
</td></tr>
<tr><td>
<label style="font-weight:normal;">Nội dung: </label></td><td>  <textarea  class="formInput02 labelInput" id="" name="frmContent" style="height:80px" title="<?php echo ((is_array($_tmp=@$_SESSION['member']['Address'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Địa chỉ nhận hàng') : smarty_modifier_default($_tmp, 'Địa chỉ nhận hàng')); ?>
"></textarea>
</td></tr>
<tr><td></td><td>
<input type="button" onclick="return closeForm();" class="formBtn" style="clear:both; margin-top:10px; margin-left:35px;"value="Thoát" />
<input type="submit" class="formBtn" style="clear:both; margin-top:10px;margin-left:5px; "value="Gửi tới Chung Mua 3HV" />
</td></tr></table>

</form>

</div></div>