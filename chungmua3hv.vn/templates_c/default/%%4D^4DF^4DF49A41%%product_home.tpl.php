<?php /* Smarty version 2.6.19, created on 2012-01-13 21:38:36
         compiled from product_home.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'product_home.tpl', 12, false),array('modifier', 'echo_date', 'product_home.tpl', 41, false),array('modifier', 'fulldate', 'product_home.tpl', 57, false),array('modifier', 'default', 'product_home.tpl', 61, false),array('modifier', 'percent', 'product_home.tpl', 62, false),)), $this); ?>

<?php $_from = $this->_tpl_vars['product_item_home']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oProduct']):
?>
<form action="?mod=product&task=baokim" method="post">
<input type="hidden" value="<?php echo $this->_tpl_vars['oProduct']['Product_ID']; ?>
" name="productID"/>
<div class="dealBox">
            	
<a title="<?php echo $this->_tpl_vars['oProduct']['Product_Deal']; ?>
" href="san-pham-<?php echo $this->_tpl_vars['oProduct']['Product_ID']; ?>
/<?php echo $this->_tpl_vars['oProduct']['Product_LinkName']; ?>
.html" class="dealTitle"><span><?php if ($this->_tpl_vars['oProduct']['DestinationID']): ?><?php echo $this->_tpl_vars['oProduct']['DestinationID']; ?>
<?php else: ?> Toàn quốc <?php endif; ?>:</span><?php echo $this->_tpl_vars['oProduct']['Product_Name']; ?>
</a>

                    <div class="clr"></div>
                    
                <div class="dealLeft">
                	<div class="dealPrice"><?php echo ((is_array($_tmp=$this->_tpl_vars['oProduct']['Product_DealPrice'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
 đ 
                    	
                 	<?php if ($this->_tpl_vars['checkbthome']): ?>
                    <a href="mua-hang.php?ID=<?php echo $this->_tpl_vars['oProduct']['Product_ID']; ?>
"></a>
                 	<?php endif; ?>
                    <div style="background-image:url(https://www.baokim.vn/promote/paymentbk.png);width:180px;height:50px;margin-left:-4px;margin-bottom:10px">
    					<div style="padding-top:5px;margin-left:40px">
        
      		 				 <input type="submit" style="background-color:#78AB2A;border:none;color:#FFF;font-size:14px;height:41px;padding-bottom:10px;font-weight:bold;width:130px" id="target" name="submit" value="Mua Trực Tuyến"/>
          
        				</div>
     					<div style="font-size:11px;margin-left:75px;color:#FFF;margin-top:-14px">Tích lũy : <b><?php echo ((is_array($_tmp=$this->_tpl_vars['oProduct']['Product_DealPrice']/100)) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
</b> đ
                        </div>
   					 </div>	
                        
                       
                    </div>
                   
                    
                    <div class="dealPriceRight"></div>
                    <div class="featurePrice02"> 
                        <div class="featureValue">Giá trị<p><?php echo ((is_array($_tmp=$this->_tpl_vars['oProduct']['Product_Price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
 đ</p></div>
                        <div class="featureSave">Tiết kiệm<p><?php echo ((is_array($_tmp=$this->_tpl_vars['oProduct']['Product_Price']-$this->_tpl_vars['oProduct']['Product_DealPrice'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
 đ</p></div>

                    </div>
                	<div class="featureTime">
                    	<div class="timeTitle">THÒI GIAN CÒN LẠI</div>
<?php echo '
<script>
var launchDate = new Date("'; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['oProduct']['Product_EndDate'])) ? $this->_run_mod_handler('echo_date', true, $_tmp, 'F d,Y H:i:s') : smarty_modifier_echo_date($_tmp, 'F d,Y H:i:s')); ?>
<?php echo '");
var secondsRemaining = Math.floor(launchDate.getTime() / 1000) - Math.floor(new Date().getTime() / 1000);
countdown(secondsRemaining,\'down'; ?>
<?php echo $this->_tpl_vars['oProduct']['Product_ID']; ?>
<?php echo '\');
</script>'; ?>


                        <p><div class="countdownTimer" id="down<?php echo $this->_tpl_vars['oProduct']['Product_ID']; ?>
">
						<div class="days">
							<label class="number">00</label> Ngày, </div>
						<div class="hours">
							<label class="number">00</label> Giờ</div>
						<div class="minutes">
							<label class="number">00</label> Phút</div>
						<div class="seconds">
							<label class="number">00</label> Giây</div>
					</div></p>
                    <div class="clear"></div>
                        <span>(Tức <?php echo ((is_array($_tmp=$this->_tpl_vars['oProduct']['Product_EndDate'])) ? $this->_run_mod_handler('fulldate', true, $_tmp) : smarty_modifier_fulldate($_tmp)); ?>
)</span>
                    </div>
                	<div class="featureBought">

                    	<div class="boughtTitle">Đã có <span><?php echo ((is_array($_tmp=@$this->_tpl_vars['oProduct']['Product_Buy'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</span> người mua</div>
                        <div class="boughtBar"><div class="boughtPercent" style="width:<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['oProduct']['Product_Buy'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)))) ? $this->_run_mod_handler('percent', true, $_tmp, $this->_tpl_vars['oProduct']['Product_Quantity']) : smarty_modifier_percent($_tmp, $this->_tpl_vars['oProduct']['Product_Quantity'])))) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1)); ?>
%"></div></div>
                        <div class="boughtStatus">Còn <span><?php echo ((is_array($_tmp=@$this->_tpl_vars['oProduct']['Product_Quantity']-$this->_tpl_vars['oProduct']['Product_Buy'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
/<?php echo ((is_array($_tmp=@$this->_tpl_vars['oProduct']['Product_Quantity'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</span> phiếu</div>
                    
                    <b><?php if ($this->_tpl_vars['oProduct']['Product_Buy'] >= $this->_tpl_vars['oProduct']['Product_Minimun']): ?> Đã đạt đủ số lượng để có giá tốt <?php else: ?>
                    Cần có thêm <?php echo ((is_array($_tmp=@$this->_tpl_vars['oProduct']['Product_Minimun']-$this->_tpl_vars['oProduct']['Product_Buy'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
 người mua nữa để đạt giá tốt
                    <?php endif; ?></b>
                    </div>
                    <div class="pageView">Lượt xem: <span><?php echo ((is_array($_tmp=$this->_tpl_vars['oProduct']['Product_NumberView'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
</span></div>

                                     <div class="dealBottom">
                    	<!--BUTTON XEM CHI TIET-->
                    	<a href="san-pham-<?php echo $this->_tpl_vars['oProduct']['Product_ID']; ?>
/<?php echo $this->_tpl_vars['oProduct']['Product_LinkName']; ?>
.html" class="viewDetail">XEM CHI TIẾT +</a>
                    </div><br />
                    
                </div>
                
            	<div class="dealRight">
                    <div class="dealImage">

                    	<a href="san-pham-<?php echo $this->_tpl_vars['oProduct']['Product_ID']; ?>
/<?php echo $this->_tpl_vars['oProduct']['Product_LinkName']; ?>
.html"><img src="upload/product/<?php echo $this->_tpl_vars['oProduct']['Product_Photo']; ?>
" alt=""/></a>
                    </div>
                    <div class="dealHomeContent">
                        <p>
                        <?php echo $this->_tpl_vars['oProduct']['Product_Description']; ?>
</p>
                        <p> <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo @SITE_URL; ?>
san-pham-<?php echo $this->_tpl_vars['oProduct']['Product_ID']; ?>
/<?php echo $this->_tpl_vars['oProduct']['Product_LinkName']; ?>
.html"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe></p>
                    </div>
                </div>
                <div class="dealLabel"><span>GIẢM</span><br /><?php echo ((is_array($_tmp=$this->_tpl_vars['oProduct']['Product_Price']-$this->_tpl_vars['oProduct']['Product_DealPrice'])) ? $this->_run_mod_handler('percent', true, $_tmp, $this->_tpl_vars['oProduct']['Product_Price']) : smarty_modifier_percent($_tmp, $this->_tpl_vars['oProduct']['Product_Price'])); ?>
%</div>
                <div class="clr"></div>     
                
            </div>
            </form>
            <?php endforeach; endif; unset($_from); ?>