<?php /* Smarty version 2.6.10, created on 2012-02-26 07:11:00
         compiled from D:/AppServ/www/projects/templates/shopping/category.product.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'D:/AppServ/www/projects/templates/shopping/category.product.tpl', 35, false),)), $this); ?>
<div id="content">
	<div class="content-helper clear">
		<div class="central-column">
			<div class="central-content">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['dir_template'])."/hotdeals.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<div class="mainbox2-container">
					<h1 class="mainbox2-title clear"><span><?php echo $this->_tpl_vars['category']->name; ?>
</span></h1>
					<div class="mainbox2-body">
						<table cellpadding="3" cellspacing="3" border="0" width="100%">
						<tr>
							<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['lsProduct']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							<td valign="top" class="border-bottom" style="width: 30%;">
								<form action="index.php" method="post" name="product_form_180001153" enctype="multipart/form-data" class="cm-disable-empty-files cm-ajax">
									<input type="hidden" name="result_ids" value="cart_status,wish_list" />
									<input type="hidden" name="redirect_url" value="index.php" />
									<input type="hidden" name="product_data[1153][product_id]" value="1153" />
									<table border="0" cellpadding="3" cellspacing="3" width="100%">
										<tr valign="top">
											<td class="center product-image" width="2%">
												<a href="<?php echo $this->_tpl_vars['lsProduct'][$this->_sections['loops']['index']]['link']; ?>
">
												<?php if ($this->_tpl_vars['lsProduct'][$this->_sections['loops']['index']]['image1'] != ""): ?>
												<img src="<?php echo $this->_tpl_vars['lsProduct'][$this->_sections['loops']['index']]['image1']; ?>
" width="40" height="40" alt="<?php echo $this->_tpl_vars['lsProduct'][$this->_sections['loops']['index']]['name']; ?>
"  border="0" />
												<?php else: ?>
												<img src="image/products/no_image.gif" width="40" height="40" alt="<?php echo $this->_tpl_vars['lsProduct'][$this->_sections['loops']['index']]['name']; ?>
"  border="0" />
												<?php endif; ?>
												</a>
											</td>
											<td width="30%" class="compact">
												<a href="<?php echo $this->_tpl_vars['lsProduct'][$this->_sections['loops']['index']]['link']; ?>
" class="product-title" title="<?php echo $this->_tpl_vars['lsProduct'][$this->_sections['loops']['index']]['name']; ?>
"><?php echo $this->_tpl_vars['lsProduct'][$this->_sections['loops']['index']]['name']; ?>
</a>	
												<p>							
													<span class="cm-reload-180001153 price-update" id="price_update_180001153">
														<input type="hidden" name="appearance[show_price_values]" value="1" />
														<input type="hidden" name="appearance[show_price]" value="1" />
														<span class="price" id="line_discounted_price_180001153">
															<span id="sec_discounted_price_180001153" class="price"><?php echo ((is_array($_tmp=$this->_tpl_vars['lsProduct'][$this->_sections['loops']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
															<span class="price">VNĐ</span>
														</span>
														<!--price_update_180001153-->
													</span>
												</p>
												<div class="cm-reload-180001153" id="add_to_cart_update_180001153">
													<input type="hidden" name="appearance[show_add_to_cart]" value="1" />
													<input type="hidden" name="appearance[separate_buttons]" value="" />
													<input type="hidden" name="appearance[show_list_buttons]" value="" />
													<input type="hidden" name="appearance[but_role]" value="" />
													<span id="cart_add_block_180001153">
														<a class="cm-submit-link text-button" id="button_cart_180001153" name="dispatch:-checkout.add..1153-:">Vào giỏ hàng</a>
													</span>
												</div>
											</td>
										</tr>
									</table>
								</form>
							</td>
							<?php if ($this->_tpl_vars['lsProduct'][$this->_sections['loops']['index']]['stt']%3 == 0): ?>
							</tr><tr>
							<?php else: ?>
							<td width="2%">&nbsp;</td>
							<?php endif; ?>
							<?php endfor; endif; ?>
							</tr>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['dir_template'])."/colsLeft.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['dir_template'])."/colsRight.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>