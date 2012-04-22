<?php /* Smarty version 2.6.19, created on 2012-04-22 17:11:14
         compiled from product_home.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'percent', 'product_home.tpl', 29, false),array('modifier', 'echo_date', 'product_home.tpl', 33, false),array('modifier', 'number_format', 'product_home.tpl', 69, false),array('modifier', 'default', 'product_home.tpl', 102, false),)), $this); ?>

<!-- 2 deal hot tren -->
<div class="mb-wrapper">
<div class="mb-top-home">
      <div class="mbt-l"></div>
      <div class="mbt-m-home"></div>
      <div class="mbt-r"></div>
      <div class="clear"></div>
   </div>
   <div class="mb-mid-home">
      <div class="coupon-title-home">
      <p style="float: left;font-size:18px; text-transform:uppercase;">Deal HOT hôm nay</p>
</div>
     
</div>
      <div class="clear"></div>
      </div>
      <div class="wrap-top">
      <?php unset($this->_sections['foo']);
$this->_sections['foo']['loop'] = is_array($_loop=$this->_tpl_vars['product_item_home']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foo']['max'] = (int)2;
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['show'] = true;
if ($this->_sections['foo']['max'] < 0)
    $this->_sections['foo']['max'] = $this->_sections['foo']['loop'];
$this->_sections['foo']['step'] = 1;
$this->_sections['foo']['start'] = $this->_sections['foo']['step'] > 0 ? 0 : $this->_sections['foo']['loop']-1;
if ($this->_sections['foo']['show']) {
    $this->_sections['foo']['total'] = min(ceil(($this->_sections['foo']['step'] > 0 ? $this->_sections['foo']['loop'] - $this->_sections['foo']['start'] : $this->_sections['foo']['start']+1)/abs($this->_sections['foo']['step'])), $this->_sections['foo']['max']);
    if ($this->_sections['foo']['total'] == 0)
        $this->_sections['foo']['show'] = false;
} else
    $this->_sections['foo']['total'] = 0;
if ($this->_sections['foo']['show']):

            for ($this->_sections['foo']['index'] = $this->_sections['foo']['start'], $this->_sections['foo']['iteration'] = 1;
                 $this->_sections['foo']['iteration'] <= $this->_sections['foo']['total'];
                 $this->_sections['foo']['index'] += $this->_sections['foo']['step'], $this->_sections['foo']['iteration']++):
$this->_sections['foo']['rownum'] = $this->_sections['foo']['iteration'];
$this->_sections['foo']['index_prev'] = $this->_sections['foo']['index'] - $this->_sections['foo']['step'];
$this->_sections['foo']['index_next'] = $this->_sections['foo']['index'] + $this->_sections['foo']['step'];
$this->_sections['foo']['first']      = ($this->_sections['foo']['iteration'] == 1);
$this->_sections['foo']['last']       = ($this->_sections['foo']['iteration'] == $this->_sections['foo']['total']);
?>
<form action="?mod=product&task=baokim" method="post">
<input type="hidden" value="<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_ID']; ?>
" name="productID"/>
 <div class="wrap-top-deal" <?php if ($this->_sections['foo']['index']%2 == 0): ?>style=" margin-right:10px;"<?php endif; ?>>



<div class="wrap-top-deal-img"><a title="<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Name']; ?>
" href="san-pham-<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_ID']; ?>
/<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_LinkName']; ?>
.html"><img class="" src="upload/product/<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Photo']; ?>
" /></a>
  <div class="wrap-top-deal-percent">
<span>Giảm</span>
<span style="font-size: 20px; font-weight: bolder; margin-left: 5px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Price']-$this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_DealPrice'])) ? $this->_run_mod_handler('percent', true, $_tmp, $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Price']) : smarty_modifier_percent($_tmp, $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Price'])); ?>
%</span></div>
<div class="block_2_home_top" style="display: none;">
 <?php echo '
<script>
var launchDate = new Date("'; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_EndDate'])) ? $this->_run_mod_handler('echo_date', true, $_tmp, 'F d,Y H:i:s') : smarty_modifier_echo_date($_tmp, 'F d,Y H:i:s')); ?>
<?php echo '");
var secondsRemaining = Math.floor(launchDate.getTime() / 1000) - Math.floor(new Date().getTime() / 1000);
countdown(secondsRemaining,\'down'; ?>
<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_ID']; ?>
<?php echo '\');
</script>'; ?>


 
  <div class="bl2-mid-home" id="down<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_ID']; ?>
" align="center">
            <p class="middle-white">Thời hạn mua còn:&nbsp;</p>
      <div class="time-remain">
         <div class="days"><label class="number">00</label></div>
         <div class="dot-dot">:</div>
         <div class="hours"><label class="number">00</label></div>
         <div class="dot-dot">:</div>
         <div class="minutes"><label class="number">00</label></div>
      </div>
      <table width="90%">
         <tbody><tr>
            <td align="center" width="33%">Ngày</td>
            <td align="center" width="33%">Giờ</td>
            <td align="center" width="33%">Phút</td>
         </tr>
      </tbody></table>
         </div>
</div>

 <div class="wrap-top-deal-buynow" style="display: none;"><a title="<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Name']; ?>
" href="san-pham-<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_ID']; ?>
/<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_LinkName']; ?>
.html"></a></div>
<div class="wtd_bg_numberorder"></div>

</div>
<div class="wtd_title">
<p><a title="<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Name']; ?>
" href="san-pham-<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_ID']; ?>
/<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_LinkName']; ?>
.html" style="color: rgb(51, 51, 51); margin: 6px 0px;"><?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Deal']; ?>
</a></p>
<div style="font-size:12px; font-family:Arial, Helvetica, sans-serif; height:40px; overflow-y:hidden"><?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Description']; ?>
</div>

</div>
<div class="wrap-top-deal-info">
<div class="wrap-top-deal-buy">
<div class="wrap-top-deal-price"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_DealPrice'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
&nbsp;đ</span></div>
<div class="wrap-top-deal-percen">
<span style="color: #333333;"><?php echo ((is_array($_tmp=$this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
&nbsp;đ</span>
</div>
<div class="clear"></div>
</div>
<!--button buy-->
<div class="wtdi_loantin">
 <div class="dealPriceHome">
                    	
                 	                   <a href="mua-hang.php?ID=<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_ID']; ?>
"></a>
                 	                    <div class="baokim">
                 	                      <div style="background-image:url(https://www.baokim.vn/promote/paymentbk.png);width:180px;height:50px;margin-left:-4px;margin-bottom:0px">
                 	                        <div style="padding-top:5px;margin-left:40px">
                 	                          
                 	                          <input style="background-color: rgb(120, 171, 42); border: medium none; color: rgb(255, 255, 255); font-size: 14px; height: 41px; padding-bottom: 10px; font-weight: bold; width: 130px;" id="target" name="submit" value="Mua Trực Tuyến" type="submit">
               	                            </div>
                 <div style="font-size:11px;margin-left:75px;color:#FFF;margin-top:-14px">Tích lũy : <b><?php echo ((is_array($_tmp=$this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_DealPrice']/100)) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
</b> đ  </div>
   					                      </div>
    									 </div> 
                                                                             
     </div>
 <!--end button buy-->                 
<div class="clear"></div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div style="border-top: dotted 1px #e3e3e3; padding-top: 7px; margin-top: 5px;">
<div class="wtdi_transpost" align="center">
<p style="color:#333333; margin-top:2px;"> <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo @SITE_URL; ?>
san-pham-<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_ID']; ?>
/<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_LinkName']; ?>
.html"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:60px"></iframe></p></div>
<div style="float: right;">
<p class="wtd_numberorder">Có&nbsp;<span style="font-size: 14px;font-weight: bold;color: #ff0000; "><?php echo ((is_array($_tmp=@$this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Buy'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</span>&nbsp;người đặt mua</p>
</div>
</div>
</div>
</div></form><?php endfor; endif; ?>


<div class="clear">
</div>
      </div>    
      <div class="mb-bot-home">
      <div class="mbb-l"></div>
      <div class="mbb-m-home"></div>
      <div class="mbb-r"></div>
      <div class="clear"></div>
   </div>
<!-- End 2 deal hot tren -->
    </form>

    <!-- Cac deal khac dang luoi -->
<div class="mb-wrapper">
<div class="mb-top-home">
      <div class="mbt-l"></div>
      <div class="mbt-m-home"></div>
      <div class="mbt-r"></div>
      <div class="clear"></div>
   </div>
   <div class="mb-mid-home">
   <a id="filter_deal"></a>
<div class="wrap-bottom-nav">
<a id="tab_menu_deal"></a>
<ul class="wrap-bottom-ul">
<li class="wrap-bottom-ul-all wrap-bottom-ul-all-active"><a><span>Tất cả Deal</span></a></li>
<li class="wrap-bottom-ul-buy "><a href="dang-giam-gia.html"><span>Đang giảm giá</span></a></li>
<div class="clear"></div>
</ul>



<div class="clear"></div>
</div>
<div class="wrap-bottom-list">
      <?php unset($this->_sections['foo']);
$this->_sections['foo']['loop'] = is_array($_loop=$this->_tpl_vars['product_item_home']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foo']['start'] = (int)2;
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['show'] = true;
$this->_sections['foo']['max'] = $this->_sections['foo']['loop'];
$this->_sections['foo']['step'] = 1;
if ($this->_sections['foo']['start'] < 0)
    $this->_sections['foo']['start'] = max($this->_sections['foo']['step'] > 0 ? 0 : -1, $this->_sections['foo']['loop'] + $this->_sections['foo']['start']);
else
    $this->_sections['foo']['start'] = min($this->_sections['foo']['start'], $this->_sections['foo']['step'] > 0 ? $this->_sections['foo']['loop'] : $this->_sections['foo']['loop']-1);
if ($this->_sections['foo']['show']) {
    $this->_sections['foo']['total'] = min(ceil(($this->_sections['foo']['step'] > 0 ? $this->_sections['foo']['loop'] - $this->_sections['foo']['start'] : $this->_sections['foo']['start']+1)/abs($this->_sections['foo']['step'])), $this->_sections['foo']['max']);
    if ($this->_sections['foo']['total'] == 0)
        $this->_sections['foo']['show'] = false;
} else
    $this->_sections['foo']['total'] = 0;
if ($this->_sections['foo']['show']):

            for ($this->_sections['foo']['index'] = $this->_sections['foo']['start'], $this->_sections['foo']['iteration'] = 1;
                 $this->_sections['foo']['iteration'] <= $this->_sections['foo']['total'];
                 $this->_sections['foo']['index'] += $this->_sections['foo']['step'], $this->_sections['foo']['iteration']++):
$this->_sections['foo']['rownum'] = $this->_sections['foo']['iteration'];
$this->_sections['foo']['index_prev'] = $this->_sections['foo']['index'] - $this->_sections['foo']['step'];
$this->_sections['foo']['index_next'] = $this->_sections['foo']['index'] + $this->_sections['foo']['step'];
$this->_sections['foo']['first']      = ($this->_sections['foo']['iteration'] == 1);
$this->_sections['foo']['last']       = ($this->_sections['foo']['iteration'] == $this->_sections['foo']['total']);
?>
<form action="?mod=product&task=baokim" method="post">
<input type="hidden" value="<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_ID']; ?>
" name="productID"/>

<div class="wrap-bottom-deal">
<div class="wrap-bottom-deal-img">
<a title="<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Deal']; ?>
" href="san-pham-<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_ID']; ?>
/<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_LinkName']; ?>
.html"><img  src="upload/product/<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Photo']; ?>
"></a>
<div class="wrap-bottom-deal-buynow" style="display: none;"><a title="<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Deal']; ?>
" href="san-pham-<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_ID']; ?>
/<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_LinkName']; ?>
.html"></a></div>
      
      <div class="like-block-bottom"></div>
            
<div class="wrap-bottom-deal-percent">
<span>Giảm</span>
<span style="margin-top: 0px; font-size: 18px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Price']-$this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_DealPrice'])) ? $this->_run_mod_handler('percent', true, $_tmp, $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Price']) : smarty_modifier_percent($_tmp, $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Price'])); ?>
%</span></div>
<div class="block-2-home" style="display: none;">
 <?php echo '
<script>
var launchDate = new Date("'; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_EndDate'])) ? $this->_run_mod_handler('echo_date', true, $_tmp, 'F d,Y H:i:s') : smarty_modifier_echo_date($_tmp, 'F d,Y H:i:s')); ?>
<?php echo '");
var secondsRemaining = Math.floor(launchDate.getTime() / 1000) - Math.floor(new Date().getTime() / 1000);
countdown(secondsRemaining,\'down'; ?>
<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_ID']; ?>
<?php echo '\');
</script>'; ?>


 
  <div class="bl2-mid-home" id="down<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_ID']; ?>
" align="center">
            <p class="middle-white">Thời hạn mua còn:&nbsp;</p>
      <div class="time-remain">
         <div class="days"><label class="number">00</label></div>
         <div class="dot-dot">:</div>
         <div class="hours"><label class="number">00</label></div>
         <div class="dot-dot">:</div>
         <div class="minutes"><label class="number">00</label></div>
      </div>
      <table width="90%">
         <tbody><tr>
            <td align="center" width="33%">Ngày</td>
            <td align="center" width="33%">Giờ</td>
            <td align="center" width="33%">Phút</td>
         </tr>
      </tbody></table>
         </div>
</div>
</div>
<div class="wbd_title">
<p><a title="<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Name']; ?>
" href="san-pham-<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_ID']; ?>
/<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_LinkName']; ?>
.html" style="color: rgb(51, 51, 51); margin: 6px 0px;"><?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Deal']; ?>
</a></p>
<div style="font-size:12px; font-family:Arial, Helvetica, sans-serif; height:40px; overflow-y:hidden"><?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Description']; ?>
</div>
</div>
<div class="wrap-bottom-deal-info">
<div class="wrap-bottom-deal-buy">
<div class="wrap-top-deal-price"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_DealPrice'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
đ</span></div>
<div class="wrap-top-deal-percen"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
đ</span></div>
<div class="clear"></div>
</div>
<div class="wbdi_loantin">
  <div class="dealPriceHome-list"> <a title="<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Name']; ?>
" href="mua-hang.php?ID=<?php echo $this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_ID']; ?>
"></a>
                    <div class="baokim-list">
          <div style="background-image:url(themes/default/images/baokim_03.png);width:80px;height:42px;margin-left:-4px;margin-bottom:0px;">
            <div style="padding-top:5px;margin-left:27px">
              <input style="background-color: rgb(120, 171, 42); border: medium none; color: rgb(255, 255, 255); font-size: 10px; height: 12px; padding-bottom: 9px; width: 50px;" id="target2" name="target" value="Tích lũy" type="submit" />
            </div>
            <div style="font-size:10px;margin-left:37px;color:#FFF;margin-top:5px"> <b>4,300</b> đ </div>
          </div>
        </div>
    </div>
<div class="clear"></div>

</div>
<div class="clear"></div>
<div style="border-top: dotted 1px #e3e3e3; margin-top: 4px;">
<div class="wbdi_transpost" style="margin-top: 5px;" align="center">
</div>
<div style="float: right; margin-top: 6px;">
<p class="wtd_numberorder">Có&nbsp;<span style="font-size: 14px;font-weight: bold; color: #ff0000;"><?php echo ((is_array($_tmp=@$this->_tpl_vars['product_item_home'][$this->_sections['foo']['index']]['Product_Buy'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</span>&nbsp;người đặt mua</p>
</div>
</div>
</div>

</div></form><?php endfor; endif; ?>



<div class="clear"></div>
</div>
</div>
   <div class="mb-bot-home">
      <div class="mbb-l"></div>
      <div class="mbb-m-home"></div>
      <div class="mbb-r"></div>
      <div class="clear"></div>
</div>
</div>