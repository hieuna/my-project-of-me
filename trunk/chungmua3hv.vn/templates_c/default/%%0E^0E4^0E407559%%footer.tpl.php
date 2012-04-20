<?php /* Smarty version 2.6.19, created on 2011-10-14 23:37:35
         compiled from footer.tpl */ ?>
<script src="function.js"></script>
<div class="pageBottom">
        <div class="pageFooter">
        	<div class="logo02"><img src="themes/default/images/logo02.png" alt="photo" /></div>
        	<div class="logo02" style="clear:both; margin-top:60px;">
          <a href="http://www.smartnet.vn" title="Công ty TNHH Dịch Vụ Công Nghệ truyền thông SmartNet - Smartnet Co.,Ltd">  <img src="upload/smarnet.png" alt="Công ty TNHH Dịch Vụ Công Nghệ truyền thông SmartNet - Smartnet Co.,Ltd" /></a>
            </div>
        	<div class="footerNav"><a href="<?php echo @SITE_URL; ?>
">Trang chủ</a>|<a href="san-pham-da-ban.html" title="Sản phẩm đã bán">Sản phẩm đã bán</a>|
            	<?php $_from = $this->_tpl_vars['footer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                	<a href="thong-tin/<?php echo $this->_tpl_vars['item']['Content_Marks']; ?>
.html" title="<?php echo $this->_tpl_vars['item']['Content_Title']; ?>
"><?php echo $this->_tpl_vars['item']['Content_Title']; ?>
</a><?php if ($this->_tpl_vars['item']['Content_ID'] != $this->_tpl_vars['maxid']): ?>|<?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </div>

            <div class="clr"></div>
            <div class="copyRight">
                © 2011 <b><?php echo $this->_config[0]['vars']['company_copy']; ?>
</b><br />
                <span><?php echo $this->_config[0]['vars']['company_address']; ?>
<br />
               Email: <a style="color:#fff;" href="mailto:<?php echo $this->_config[0]['vars']['company_email']; ?>
"><?php echo $this->_config[0]['vars']['company_email']; ?>
</a> - Phone: <?php echo $this->_config[0]['vars']['company_phone']; ?>
 -  Fax: <?php echo $this->_config[0]['vars']['company_fax']; ?>
</span>
            </div>
            <div class="icoFooter">
            	<a href="#"><img src="themes/default/images/icoFooter01.png" alt="photo" /></a>
            	<a href="#"><img src="themes/default/images/icoFooter02.png" alt="photo" /></a>
            	<a href="#"><img src="themes/default/images/icoFooter03.png" alt="photo" /></a>
            	<a href="#"><img src="themes/default/images/icoFooter04.png" alt="photo" /></a>
            </div>
            <div class="clr"></div>
        </div>
    </div>
    
    <div id="loading" style="display:none;">
<div id="closePopup"><a href="javascript:void(0)" onclick="return closeForm();" title="Click  hoặc nhấn ESC để đóng cửa sổ">X</a></div>
   	<div id="loadingcontrol"><img src="themes/default/images/loading.gif" border="0" align="loading" title="loading"/></div>
   <div id="popupCoupon"></div>
</div>