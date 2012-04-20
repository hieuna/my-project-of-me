<?php /* Smarty version 2.6.19, created on 2011-11-03 03:16:54
         compiled from form_follow.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'echo_date', 'form_follow.tpl', 42, false),)), $this); ?>
<div class="pageDefault">
<div class="pageTitle">THEO DÕI ĐƠN HÀNG</div>
<div class="signinBox">
	<div class="err_signin">
    	<?php if ($this->_tpl_vars['msg']): ?>
        	<?php echo $this->_tpl_vars['msg']; ?>

        <?php endif; ?>
    </div>
    <form name="frmFollow" method="post" onsubmit="return checkFollowForm(this)">
    <div style="float:left; width:280px; border:1px solid #4B3E35; padding:10px; height:200px; margin-right:10px;">
        <label class="formLabel" style="width:auto;" for="Email"><strong>MÃ ĐƠN HÀNG</strong><span class="formRequest">*</span></label>
        <input class="formInput" id="_follow" name="_follow" style="width:250px;" title="" type="text" value="<?php echo $_REQUEST['_follow']; ?>
"><br>
<p>Xin vui lòng nhập mã số đơn hàng bạn muốn theo dõi.</p>
        </div>
        <div style="float:left; padding-top:30px; margin-right:10px; font-weight:bold; font-size:20px;">HOẶC</div>
         <div style="float:left; width:290px;  border:1px solid #4B3E35; padding:10px; height:200px;">
        <label class="formLabel" style="width:auto;" for="Email"><strong>ĐỊA CHỈ EMAIL</strong><span class="formRequest">*</span></label>
        <input class="formInput" style="width:270px;" id="_email" name="_email" title="" type="text" value="<?php echo $_REQUEST['_email']; ?>
"><br>
         <p style="margin-left:30px;"><label class="formLabel"></label></p>
        <label class="formLabel" style="width:auto;" for="Email"><strong>SỐ ĐIỆN THOẠI</strong><span class="formRequest">*</span></label>
          <input class="formInput" style="width:270px;"  id="_phone" name="_phone" title="" type="text" value="<?php echo $_REQUEST['_phone']; ?>
">
       <div style="clear:both"></div>
        </div>
        <p style="margin-left:30px;"><label class="formLabel"></label></p>
        <div style="clear:both; margin-top:10px;"></div>
        <center>
       <input class="formBtn" style=" margin-top:30px; margin-bottom:10px;" value="KIỂM TRA NGAY" type="submit">
    </center>
    </form>
</div>
<?php if (! $this->_tpl_vars['cart'] && ! $this->_tpl_vars['productview']): ?><p>Không tìm thấy đơn hàng nào.</p><?php endif; ?>
<?php if ($this->_tpl_vars['cart']): ?>

<div class="pageTitle" id="ttOrder">THÔNG TIN ĐƠN HÀNG MÃ SỐ: <?php echo $this->_tpl_vars['cart']['Shopping_Code']; ?>
</div>

<div class="followDealName"><?php echo $this->_tpl_vars['product']['Product_Name']; ?>
</div>
                <ul class="followDeal">
                	<li><b>Tên khách hàng:</b> <?php echo $this->_tpl_vars['cart']['Shopping_Name']; ?>
 </li>
                	<li><b>Địa chỉ giao hàng:</b> <?php echo $this->_tpl_vars['cart']['Shopping_Address']; ?>
 </li>
                	<li><b>Số lượng đặt mua:</b> <?php echo $this->_tpl_vars['cart']['Shopping_Quantity']; ?>
 </li>
                	<li><b>Tình trạng đơn hàng:</b> <?php if ($this->_tpl_vars['cart']['Shopping_Complete'] == 1): ?>Đã xử lý thành công<?php else: ?>Đang xử lý<?php endif; ?></li>
                 	<li><b>Thời điểm đặt hàng:</b> <?php echo ((is_array($_tmp=$this->_tpl_vars['cart']['Shopping_Create'])) ? $this->_run_mod_handler('echo_date', true, $_tmp, 'H:i A - d/m/Y') : smarty_modifier_echo_date($_tmp, 'H:i A - d/m/Y')); ?>
 </li>
               </ul>
                <div class="clr"></div>
 <?php echo '
               <script>
				$(document).ready(function(){
					gotoTop(\'ttOrder\');
				
				})
                </script>
 '; ?>

                
                

<?php endif; ?>
<?php if ($this->_tpl_vars['productview']): ?>
<div class="pageTitle" id="ttOrder">THÔNG TIN ĐƠN HÀNG ĐẶT MUA</div>
<?php $_from = $this->_tpl_vars['productview']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['_productname'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['_productname']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['_product']):
        $this->_foreach['_productname']['iteration']++;
?>

<div class="followDealName">MÃ ĐƠN HÀNG: <?php echo $this->_tpl_vars['_product']['Shopping_Code']; ?>
</div>
                <ul class="followDeal">
                	<li><b>Mã đơn hàng:</b> <?php echo $this->_tpl_vars['_product']['Shopping_Code']; ?>
 </li>
                	<li><b>Tên sản phẩm mua:</b> <?php echo $this->_tpl_vars['_product']['product_name']; ?>
 </li>
                	<li><b>Địa chỉ giao hàng:</b> <?php echo $this->_tpl_vars['_product']['Shopping_Address']; ?>
 </li>
                	<li><b>Số lượng đặt mua:</b> <?php echo $this->_tpl_vars['_product']['Shopping_Quantity']; ?>
 </li>
                	<li><b>Tình trạng đơn hàng:</b> <?php if ($this->_tpl_vars['_product']['Shopping_Complete'] == 1): ?>Đã xử lý thành công<?php else: ?>Đang xử lý<?php endif; ?></li>
                 	<li><b>Thời điểm đặt hàng:</b> <?php echo ((is_array($_tmp=$this->_tpl_vars['_product']['Shopping_Create'])) ? $this->_run_mod_handler('echo_date', true, $_tmp, 'H:i A - d/m/Y') : smarty_modifier_echo_date($_tmp, 'H:i A - d/m/Y')); ?>
 </li>
               </ul>
                <div class="clr"></div>
<?php endforeach; endif; unset($_from); ?>
                
                
                <div class="clr"></div>
 <?php echo '
               <script>
				$(document).ready(function(){
					gotoTop(\'ttOrder\');
				
				})
                </script>
 '; ?>

                
                

<?php endif; ?>
</div>
<?php echo '
<script>
function checkFollowForm(frm){
	if(frm._email.value==\'\' && frm._phone.value==\'\' && frm._follow.value==\'\' ){
		alert(\'Xin vui lòng nhập mã số đơn hàng.\');
		frm._follow.focus();
		return false;
	}
	 
	
}
</script>
'; ?>

            