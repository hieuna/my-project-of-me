<?php /* Smarty version 2.6.10, created on 2012-03-13 23:20:29
         compiled from D:/AppServ/www/projects/templates/shopping/products.viewed.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'D:/AppServ/www/projects/templates/shopping/products.viewed.tpl', 52, false),)), $this); ?>
<div id="rhf_shvl_div" class="rhfWrapper">
<table cellspacing="0" cellpadding="0" border="0" style="margin-top: 10px; width: 100%;">
    <tbody><tr valign="top">
        <td id="rviColumn">
            <div class="rhfHistoryWrapper">
                <span><strong id="rhfHistoryColumnTitle">You have no recently viewed items.</strong></span>
				<p>After viewing product detail pages or search results, look here to find an easy way to navigate back to pages you are interested in.</p>
				<div style="display: none;" id="rhfUpsellDescription">
					<p>Look to the right column to find helpful suggestions for your shopping session.</p>
				</div>
			</div>
        </td>
        <td valign="top" id="rhfUpsellColumnContent">
            <div style="padding: 0pt 0px 0pt 10px;">
				<div id="rhf_upsell_div">
					<div id="rhf0Shvl" class="shoveler ">
				    <div class="shoveler-heading">
				        <div class="rhfUpsellColumnTitle"><strong>Tiếp tục mua hàng: </strong> Sản phẩm đã xem</div>
				    </div>
				    <div id="rhf0ButtonWrapper" class="shoveler-button-wrapper">
				        <div class="back-button">
					        <a id="btn_prev" href="javascript: void(0);" title="Quay lại">
						        <span class="bg-text">Quay lại</span>
						        <span title="Quay lại" class="bg-image"></span>
					        </a>
				        </div>
				        <div class="shoveler-content" id="tab_content">
				            <ul>
				            	<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['lsProductViewed']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
								<li class="shoveler-cell" style="margin-left: 20px; margin-right: 20px;">
									<div>
										<span>
											<a title="<?php echo $this->_tpl_vars['lsProductViewed'][$this->_sections['loops']['index']]['name']; ?>
" class="title" href="<?php echo $this->_tpl_vars['lsProductViewed'][$this->_sections['loops']['index']]['link']; ?>
"> 
												<div style="margin-bottom: 6px; margin-top: 0px;" class="imageContainer">
									                 <img height="135" width="99" src="<?php echo $this->_tpl_vars['lsProductViewed'][$this->_sections['loops']['index']]['image1']; ?>
" alt="<?php echo $this->_tpl_vars['lsProductViewed'][$this->_sections['loops']['index']]['name']; ?>
" border="0" />
									            </div>
									            <?php echo $this->_tpl_vars['lsProductViewed'][$this->_sections['loops']['index']]['name']; ?>

											</a>
										</span>
										<div class="rating">
											<span class="rating-stars">
												<span class="crAvgStars">
													<span class="asinReviewsSummary">
														<a href="#">
															<img height="12" width="55" align="absbottom" title="4.5 sao/5 sao" alt="4.5 sao/5 sao" src="<?php echo $this->_tpl_vars['url_template']; ?>
/images/stars-4-5.gif" border="0" />
														</a>&nbsp;
													</span>(<a href="#">5,274</a>)
												</span>
											</span>
										</div>
									    <div class="binding"><?php echo $this->_tpl_vars['lsProductViewed'][$this->_sections['loops']['index']]['name_cate']; ?>
</div>
									    <div class="price"><?php echo ((is_array($_tmp=$this->_tpl_vars['lsProductViewed'][$this->_sections['loops']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp));  echo $this->_tpl_vars['menh_gia']; ?>
</div>
									    <div class="reason-text"></div>
									</div>
								</li>
								<?php if ($this->_tpl_vars['lsProductViewed'][$this->_sections['loops']['index']]['stt']%5 == 0): ?>
								</ul><ul>
								<?php endif; ?>
								<?php endfor; endif; ?>
							</ul>
				        </div>
				        <div class="next-button">
					        <a id="btn_next" href="javascript: void(0);" title="Xem tiếp">
						        <span class="bg-text">Xem tiếp</span>
						        <span title="Xem tiếp" class="bg-image"></span>
					        </a>
				        </div>
				    </div>
</div>
</div></div></td></tr><tr><td colspan="2"></td></tr></tbody></table>
</div>