<?php /* Smarty version 2.6.19, created on 2012-04-23 15:22:35
         compiled from product_detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'product_detail.tpl', 8, false),array('modifier', 'echo_date', 'product_detail.tpl', 29, false),array('modifier', 'fulldate', 'product_detail.tpl', 45, false),array('modifier', 'default', 'product_detail.tpl', 52, false),array('modifier', 'percent', 'product_detail.tpl', 53, false),array('function', 'loadModule', 'product_detail.tpl', 130, false),)), $this); ?>
    	<div id="pageLeft">
<form action="?mod=product&task=baokim" method="post" id="frmPOST_<?php echo $this->_tpl_vars['product_item']['Product_ID']; ?>
" name="frmPOST_<?php echo $this->_tpl_vars['product_item']['Product_ID']; ?>
">
<input type="hidden" value="<?php echo $this->_tpl_vars['product_item']['Product_ID']; ?>
" name="productID"/>
<div class="dealBox">
            	<a class="dealTitle"><span><?php if ($this->_tpl_vars['product_item']['DestinationID']): ?><?php echo $this->_tpl_vars['product_item']['DestinationID']; ?>
<?php else: ?> Toàn quốc <?php endif; ?>:</span><?php echo $this->_tpl_vars['product_item']['Product_Name']; ?>
</a>
                    <div class="clr"></div>
                <div class="dealLeft">
                	<div class="dealPrice"><?php echo ((is_array($_tmp=$this->_tpl_vars['product_item']['Product_DealPrice'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
 đ 
						
                    	<?php if ($this->_tpl_vars['checkbtdetail']): ?>
                   		 <a  <?php if ($this->_tpl_vars['product_item']['Product_Sold'] != 1): ?> href="mua-hang.php?ID=<?php echo $this->_tpl_vars['product_item']['Product_ID']; ?>
"<?php endif; ?>></a>
                         <?php endif; ?>                                                  <div style="padding: 10px 50px 0 0; margin:0; width: auto; text-align: right;">							<img id="cl_shp_<?php echo $this->_tpl_vars['product_item']['Product_ID']; ?>
" src="https://sohapay.com/images/btn/muangay_sohapay_green.png" style="border:none; cursor: pointer;" />							<input type="hidden" name="order_email" value="<?php echo $this->_tpl_vars['order_email']; ?>
" />							<input type="hidden" name="order_phone" value="<?php echo $this->_tpl_vars['order_phone']; ?>
" />						 </div>
                         <div style="background-image:url(https://www.baokim.vn/promote/paymentbk.png);width:180px;height:50px;margin-left:-4px;margin-top:8px">
    					<div style="padding-top:5px;margin-left:40px">      		 				  <div style="cursor: pointer; background-color:#78AB2A;border:none;color:#FFF;font-size:14px;height:22px;padding:8px 0 12px 0;font-weight:bold;width:130px" id="target_<?php echo $this->_tpl_vars['product_item']['Product_ID']; ?>
">Mua trực tuyến</div>        				</div>
     					<div style="font-size:11px;margin-left:75px;color:#FFF;margin-top:-14px">Tích lũy : <b><?php echo ((is_array($_tmp=$this->_tpl_vars['product_item']['Product_DealPrice']/100)) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
</b> đ
                        </div>
   					 </div>	                    </div>					<?php echo '                    <script type="text/javascript">                    $(function(){                        $(\'#cl_shp_'; ?>
<?php echo $this->_tpl_vars['product_item']['Product_ID']; ?>
<?php echo '\').click(function(){                            $(\'#frmPOST_'; ?>
<?php echo $this->_tpl_vars['product_item']['Product_ID']; ?>
<?php echo '\').attr("action", "?mod=product&task=sohapay");                            $(\'#frmPOST_'; ?>
<?php echo $this->_tpl_vars['product_item']['Product_ID']; ?>
<?php echo '\').submit();                                                 });                        $(\'#target_'; ?>
<?php echo $this->_tpl_vars['product_item']['Product_ID']; ?>
<?php echo '\').click(function(){                        	$(\'#frmPOST_'; ?>
<?php echo $this->_tpl_vars['product_item']['Product_ID']; ?>
<?php echo '\').attr("action", "?mod=product&task=baokim");                            $(\'#frmPOST_'; ?>
<?php echo $this->_tpl_vars['product_item']['Product_ID']; ?>
<?php echo '\').submit();                         });                    });                    </script>                    '; ?>

                    <div class="dealPriceRight"></div>
                    <div class="featurePrice02"> 
                        <div class="featureValue">Giá trị<p><?php echo ((is_array($_tmp=$this->_tpl_vars['product_item']['Product_Price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
 đ</p></div>
                        <div class="featureSave">Tiết kiệm<p><?php echo ((is_array($_tmp=$this->_tpl_vars['product_item']['Product_Price']-$this->_tpl_vars['product_item']['Product_DealPrice'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
 đ</p></div>

                    </div>
                	<div class="featureTime">
                    	<div class="timeTitle">THÒI GIAN CÒN LẠI</div>
                        <?php if ($this->_tpl_vars['product_item']['Product_Sold'] != 1): ?>
<?php echo '
<script>
var launchDate = new Date("'; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['product_item']['Product_EndDate'])) ? $this->_run_mod_handler('echo_date', true, $_tmp, 'F d,Y H:i:s') : smarty_modifier_echo_date($_tmp, 'F d,Y H:i:s')); ?>
<?php echo '");
var secondsRemaining = Math.floor(launchDate.getTime() / 1000) - Math.floor(new Date().getTime() / 1000);
countdown(secondsRemaining,\'down'; ?>
<?php echo $this->_tpl_vars['product_item']['Product_ID']; ?>
<?php echo '\');
</script>'; ?>


                        <p><div class="countdownTimer" id="down<?php echo $this->_tpl_vars['product_item']['Product_ID']; ?>
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
                        <span>(Tức <?php echo ((is_array($_tmp=$this->_tpl_vars['product_item']['Product_EndDate'])) ? $this->_run_mod_handler('fulldate', true, $_tmp) : smarty_modifier_fulldate($_tmp)); ?>
)</span>
                        <?php else: ?>
                        <b>Sản phẩm đã bán hoặc đã hết hạn sử dụng</b>
                        <?php endif; ?>
                    </div>
                	<div class="featureBought">

                    	<div class="boughtTitle">Đã có <span><?php echo ((is_array($_tmp=@$this->_tpl_vars['product_item']['Product_Buy'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</span> người mua</div>
                        <div class="boughtBar"><div class="boughtPercent" style="width:<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['product_item']['Product_Buy'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)))) ? $this->_run_mod_handler('percent', true, $_tmp, $this->_tpl_vars['product_item']['Product_Quantity']) : smarty_modifier_percent($_tmp, $this->_tpl_vars['product_item']['Product_Quantity'])))) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1)); ?>
%"></div></div>
                        <div class="boughtStatus">Còn <span><?php echo ((is_array($_tmp=@$this->_tpl_vars['product_item']['Product_Quantity']-$this->_tpl_vars['product_item']['Product_Buy'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
/<?php echo ((is_array($_tmp=@$this->_tpl_vars['product_item']['Product_Quantity'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</span> phiếu</div>
                    
                    <b><?php if ($this->_tpl_vars['product_item']['Product_Buy'] >= $this->_tpl_vars['product_item']['Product_Minimun']): ?> Đã đạt đủ số lượng để có giá tốt <?php else: ?>
                    Cần có thêm <?php echo ((is_array($_tmp=@$this->_tpl_vars['product_item']['Product_Minimun']-$this->_tpl_vars['product_item']['Product_Buy'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
 người mua nữa để đạt giá tốt
                    <?php endif; ?></b>
                    </div>
                    <div class="pageView">Lượt xem: <span><?php echo ((is_array($_tmp=$this->_tpl_vars['product_item']['Product_NumberView'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
</span></div>
                    <div class="pageComment" style="cursor:pointer" title="Xem bình luận" onclick="return gotoTop('CommentID')">Bình luận: <span><?php echo ((is_array($_tmp=@$this->_tpl_vars['product_item']['comment'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</span></div><br />

                   
                    <div class="dealBottom">
                    	<!--BUTTON XEM CHI TIET-->
                    </div>
                </div>
            	<div class="dealRight">
                    <div class="dealImage">
                    	<a title="<?php echo $this->_tpl_vars['product_item']['Product_Name']; ?>
"><img src="upload/product/<?php echo $this->_tpl_vars['product_item']['Product_Photo']; ?>
" alt="<?php echo $this->_tpl_vars['product_item']['Product_Name']; ?>
"/></a>
                    </div>
                    <div class="dealHomeContent">
                       <p>
                        <?php echo $this->_tpl_vars['product_item']['Product_Description']; ?>
</p>
                           <p> <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo @SITE_URL; ?>
san-pham-<?php echo $this->_tpl_vars['product_item']['Product_ID']; ?>
/<?php echo $this->_tpl_vars['product_item']['Product_LinkName']; ?>
.html"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe></p>
                    </div>
                </div>
                <div class="dealLabel"><span>GIẢM</span><br /><?php echo ((is_array($_tmp=$this->_tpl_vars['product_item']['Product_Price']-$this->_tpl_vars['product_item']['Product_DealPrice'])) ? $this->_run_mod_handler('percent', true, $_tmp, $this->_tpl_vars['product_item']['Product_Price']) : smarty_modifier_percent($_tmp, $this->_tpl_vars['product_item']['Product_Price'])); ?>
%</div>
                <div class="clr"></div>     
              
               <!--Hien thi phan Luu y khach hang-->
                <div id="boxShortContent" class="boxShortContent">
                    <div class="bgDotted">
                        <div class="dealNote">
                            <div class="dealNoteTitle">ĐIỂM NỔI BẬT</div>
                            <div class="dealNoteContent"><?php echo $this->_tpl_vars['product_item']['Product_Note']; ?>
</div>
                        </div>
                        <div class="dealConditions">
                            <div class="dealConditionsTitle">ĐIỀU KHOẢN SỬ DỤNG</div>
                            <div class="dealNoteContent"><?php echo $this->_tpl_vars['product_item']['Product_Terms_of_Use']; ?>
</div>
                        </div>
                        <div class="clr"></div>
                    </div>
                </div>
                
               <!--Hien thi HOI DAP-->
               <a onclick="return buydeal(this);" href="thac-mac-p-<?php echo $this->_tpl_vars['product_item']['Product_ID']; ?>
.html?size=600x430" id="popupHtmlDealsBuy"  class="reQuest"></a>
                <div class="clr"></div>
               <!--Hien thi thong tin chi tiet-->
                <div class="pageTitle">THÔNG TIN CHI TIẾT</div>
                <div class="dealDetailContent">
               <?php echo $this->_tpl_vars['product_item']['Product_Content']; ?>

               </div>
            </div>
</form>  
            <?php if ($this->_tpl_vars['product_item']['Product_Map']): ?>
            <div class="dealBox">
                <div class="pageTitle">BẢN ĐỔ</div>
              <div style="margin-top:10px;"  >
           <img src="upload/map/<?php echo $this->_tpl_vars['product_item']['Product_Map']; ?>
">
           </div>
            </div><?php endif; ?>
            
            <div class="dealBox" id="CommentID">
                <div class="pageTitle">BÌNH LUẬN (<span><?php echo ((is_array($_tmp=@$this->_tpl_vars['product_item']['comment'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</span>)</div>
            <?php echo smarty_function_loadModule(array('name' => 'comment','task' => 'view'), $this);?>

            </div>
            <?php if ($_GET['goto']): ?>
<?php echo '
<script>
	$(document).ready(function(){ gotoTop(\'CommentID\');})
</script>
'; ?>

            <?php endif; ?>
            </div>
                   <?php echo smarty_function_loadModule(array('name' => 'control','task' => 'right'), $this);?>


          