<?php /* Smarty version 2.6.10, created on 2012-03-14 00:07:18
         compiled from D:/AppServ/www/projects/templates/shopping/products.discount.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'D:/AppServ/www/projects/templates/shopping/products.discount.tpl', 42, false),)), $this); ?>
<div class="unified_widget rcmBody" id="goldboxDotdContentRc">
	<table style="overflow:hidden;">
	 <tbody><tr>
	  <td style="overflow:hidden; padding:0px;">
	    <h2>Sản phẩm giảm giá</h2>
	  </td>
	 </tr>
	</tbody>
	</table>
	<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['lsProductDiscount']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loops']['show'] = true;
$this->_sections['loops']['max'] = $this->_sections['loops']['loop'];
$this->_sections['loops']['step'] = 1;
$this->_sections['loops']['start'] = $this->_sections['loops']['step'] > 0 ? 0 : $this->_sections['loops']['loop']-1;
if ($this->_sections['loops']['show']) {
    $this->_sections['loops']['total'] = $this->_sections['loops']['loop'];
    if ($this->_sections['loops']['total'] == 0)
        $this->_sections['loops']['show'] = false;
} else
    $this->_sections['loops']['total'] = 0;
if ($this->_sections['loops']['show']):

            for ($this->_sections['loops']['index'] = $this->_sections['loops']['start'], $this->_sections['loops']['iteration'] = 1;
                 $this->_sections['loops']['iteration'] <= $this->_sections['loops']['total'];
                 $this->_sections['loops']['index'] += $this->_sections['loops']['step'], $this->_sections['loops']['iteration']++):
$this->_sections['loops']['rownum'] = $this->_sections['loops']['iteration'];
$this->_sections['loops']['index_prev'] = $this->_sections['loops']['index'] - $this->_sections['loops']['step'];
$this->_sections['loops']['index_next'] = $this->_sections['loops']['index'] + $this->_sections['loops']['step'];
$this->_sections['loops']['first']      = ($this->_sections['loops']['iteration'] == 1);
$this->_sections['loops']['last']       = ($this->_sections['loops']['iteration'] == $this->_sections['loops']['total']);
?>
	<table style="overflow:hidden;">
	 <tbody><tr>
	  <td style="overflow:hidden; padding:0px 7px 0px 0px; margin:0; width: 1%;">
	   <left>
			<a href="<?php echo $this->_tpl_vars['lsProductDiscount'][$this->_sections['loops']['index']]['link']; ?>
" class="gbox" title="<?php echo $this->_tpl_vars['lsProductDiscount'][$this->_sections['loops']['index']]['name']; ?>
">
				<img src="<?php echo $this->_tpl_vars['lsProductDiscount'][$this->_sections['loops']['index']]['image1']; ?>
" class="gbox-img" alt="<?php echo $this->_tpl_vars['lsProductDiscount'][$this->_sections['loops']['index']]['name']; ?>
" width="100" height="100" border="0" />
			</a>
	   </left>
	  </td>
	  <td style="overflow:hidden; padding:0px;">
	    <table style="overflow:hidden;">
	      <tbody><tr>
	        <td style="overflow:hidden; padding:0px;">
	           <div style="margin-bottom:5px;">
					<a href="<?php echo $this->_tpl_vars['lsProductDiscount'][$this->_sections['loops']['index']]['link']; ?>
" class="gbox-b" title="<?php echo $this->_tpl_vars['lsProductDiscount'][$this->_sections['loops']['index']]['name']; ?>
" style="text-decoration: none;">
					<?php echo $this->_tpl_vars['lsProductDiscount'][$this->_sections['loops']['index']]['name']; ?>

					</a>
	           </div>
	        </td>
	      </tr>
	      <tr>
	        <td valign="top" style="overflow:hidden; padding:0; margin-top:5px;">
	           <div class="gbox-dotd-container">
				<table style="width:70%;" id="gbox-pricing-div.A3305F5NNN7TSE">
				  <tbody><tr style="padding-top:2px;white-space:nowrap;overflow:hidden;margin-left:6px;" class="priceBlock">
				   <td style="font-family: 'Arial'; color: rgb(102, 102, 102); font-weight:normal; font-size: 11px;
				    text-align:right; margin-left:8px; padding:0.5px 0 0;" ,="" id="gbox-dotd-list-price-title">
				    Giá bán:
				   </td>
				   <td class="listPrice" style="color: rgb(102, 102, 102); font-size: 12px;font-family:'Arial';text-decoration:line-through;
				    text-align:left; padding:0 0 0 3px;" ,="" id="gbox-dotd-list-price">
				    <?php echo ((is_array($_tmp=$this->_tpl_vars['lsProductDiscount'][$this->_sections['loops']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp));  echo $this->_tpl_vars['menh_gia']; ?>

				   </td>
				  </tr>
				  <tr style="white-space:nowrap;overflow:hidden;margin-left:6px;" class="priceBlock">
				   <td style="font-family: 'Arial'; color: rgb(102, 102, 102); font-size: 11px;  font-weight:normal;text-align:right;
				    margin-left:4px; padding:1px 0 0;" ,="" id="gbox-dotd-promo-price-title">
				    Giảm giá: 
				   </td>
				   <td style="font-family:Arial;font-size:14px; text-align:left;color:#990000; padding:0 0 0 3px;" id="gbox-dotd-promo-price">
				    <?php echo ((is_array($_tmp=$this->_tpl_vars['lsProductDiscount'][$this->_sections['loops']['index']]['discount'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp));  echo $this->_tpl_vars['menh_gia']; ?>

				   </td>
				  </tr>
				
				 <tr style="white-space:nowrap; overflow:hidden;margin-left:6px;" class="priceBlock">
				   <td style="font-family: 'Arial'; color: rgb(102, 102, 102); font-size: 11px; text-align:right; font-weight:normal;
				    margin-left:4px; padding:0;" ,="" id="gbox-dotd-discount-title">
				    Tiết kiệm:
				   </td>
				   <td style="color: rgb(102, 102, 102); font-size: 11px;font-family:'Arial'; text-align:left;font-weight:normal; padding:0 0 0 3px;" ,="" class="pricing" id="gbox-dotd-discount">
				    <?php echo ((is_array($_tmp=$this->_tpl_vars['lsProductDiscount'][$this->_sections['loops']['index']]['price_sale'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp));  echo $this->_tpl_vars['menh_gia']; ?>

				    (<?php echo $this->_tpl_vars['lsProductDiscount'][$this->_sections['loops']['index']]['percent']; ?>
%)
				   </td>
				 </tr>
				</tbody>
				</table>
	           </div>
	        </td>
	      </tr>
	    </tbody>
	    </table>
	  </td>
	 </tr>
	</tbody>
	</table>

	<table style="overflow:hidden;">
	 <tbody><tr>
	  <td style="overflow:hidden; padding-top:10px; padding-bottom:0px;">
	   <p class="seemore">
	    <span class="carat">
	     ›
	    </span>
	    <span style="margin-left:-4px;">
	     <a href="/gp/goldbox/ref=xs_gb_gateway_redir">
	      Today's Deals
	     </a>
	    </span>
	   </p>
	  </td>
	 </tr>
	</tbody>
	</table>
	<?php endfor; endif; ?>
</div>