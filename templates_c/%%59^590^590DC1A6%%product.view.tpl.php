<?php /* Smarty version 2.6.10, created on 2012-02-26 10:34:26
         compiled from D:/AppServ/www/projects/templates/shopping/product.view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'D:/AppServ/www/projects/templates/shopping/product.view.tpl', 60, false),array('modifier', 'date_format', 'D:/AppServ/www/projects/templates/shopping/product.view.tpl', 143, false),)), $this); ?>
<div id="content">
	<div class="content-helper clear">
		<div class="central-column">
			<div class="central-content">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['dir_template'])."/hotdeals.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<div class="mainbox-container">
					<div class="mainbox-body">
						<div class="product-main-info">
							<form class="cm-disable-empty-files cm-ajax" enctype="multipart/form-data" name="product_form_742" method="post" action="index.php">
								<input type="hidden" value="cart_status,wish_list" name="result_ids">
								<input type="hidden" value="index.php?dispatch=products.view&amp;product_id=742" name="redirect_url">
								<input type="hidden" value="742" name="product_data[742][product_id]">
					
								<div class="clear">
									<div id="product_images_742_update" class="image-border float-left center cm-reload-742">
										<?php echo '
										<script type="text/javascript">
										//&lt;![CDATA[
										lang.close = \'Close\';
										lang.click_on_images_text = \'Click on images to change view\';
										lang.press_esc_to = \'Press \\"Esc\\" to\';
										//]]&gt;
										</script>
										'; ?>

										<script src="/cscart/js/previewer.js" type="text/javascript"></script>	
										<a rev="<?php echo $this->_tpl_vars['product']->image1; ?>
" href="<?php echo $this->_tpl_vars['product']->image1; ?>
" id="detailed_href1_742">
										<img src="<?php echo $this->_tpl_vars['product']->image1; ?>
" alt="<?php echo $this->_tpl_vars['product']->name; ?>
" class="cm-thumbnails" id="det_img_742" width="250" border="0" /></a>
										<p id="detailed_box_742" class="center">
											<a class="cm-thumbnails-opener view-larger-image" href="<?php echo $this->_tpl_vars['product']->image1; ?>
" id="detailed_href2_742">Xem ảnh lớn</a>
										</p>
										<?php echo '
										<script type="text/javascript">
										//&lt;![CDATA[
											rebuild_previewer = true;
										//]]&gt;
										</script>
										'; ?>
			
										<!--product_images_742_update-->
									</div>
											
									<div class="product-info">
										<h1 class="mainbox-title"><?php echo $this->_tpl_vars['product']->name; ?>
</h1>
										<p class="sku">
											<span id="sku_update_742" class="cm-reload-742">
												<input type="hidden" value="1" name="appearance[show_sku]">
												<span id="sku_742">CODE: <span id="product_code_742"><?php echo $this->_tpl_vars['product']->code; ?>
</span></span>
											</span>
										</p>
										<p class="sku">
											<span id="sku_update_742" class="cm-reload-742">
												<input type="hidden" value="1" name="appearance[show_sku]">
												<span id="sku_742">MODEL: <span id="product_code_742"><?php echo $this->_tpl_vars['product']->model; ?>
</span></span>
											</span>
										</p>
										<hr class="dashed clear-both">
										<div class="clear">
											<p>
												<span class="price-update">
													<span class="price price_ny">Giá niêm yết: 
														<span class="price price_ny"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->price_ny)) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
														<span class="price price_ny">VNĐ</span>
													</span>
												</span>
											</p>
											<p>	
												<span class="price-update fl">
													<span class="price">Giá bán: 
														<span class="price"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->price)) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
														<span class="price">VNĐ</span>
													</span>
												</span>
												<?php if ($this->_tpl_vars['product']->number_color > 0): ?>
													<?php $_from = $this->_tpl_vars['product']->colors; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['color']):
?>
														<span class="color" style="background-color: <?php echo $this->_tpl_vars['color']['value_color']; ?>
" id="color_<?php echo $this->_tpl_vars['color']['value_color']; ?>
"></span>
													<?php endforeach; endif; unset($_from); ?>
												<?php else: ?>
												<span class="fl">Một giá với toàn bộ các màu</span>
												<?php endif; ?>
											</p>
											<?php if ($this->_tpl_vars['product']->percent > 0): ?>
											<p>	
												<span class="price-update">
													<span class="price">Giá bán giảm: 
														<span class="price"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->discount)) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
														<span class="price">VNĐ (<?php echo $this->_tpl_vars['product']->percent; ?>
)%</span>
													</span>
												</span>
											</p>
											<?php endif; ?>		
										</div>
										<span id="product_amount_update_742" class="cm-reload-742">
											<input type="hidden" value="1" name="appearance[show_product_amount]">
											<span id="in_stock_info_742" class="strong in-stock">Còn hàng</span>
										</span>
										
										<div id="product_options_update_742" class="cm-reload-742">
											<input type="hidden" value="1" name="appearance[show_product_options]">
											<script src="/cscart/js/jquery.simpletip-1.3.1.js" type="text/javascript"></script>
											<input type="hidden" value="1" name="appearance[details_page]">
											<input type="hidden" value="D" name="additional_info[info_type]">
											<input type="hidden" value="1" name="additional_info[get_icon]">
											<input type="hidden" value="1" name="additional_info[get_detailed]">
											<input type="hidden" value="1" name="additional_info[get_options]">
											<input type="hidden" value="1" name="additional_info[get_discounts]">
											<input type="hidden" value="" name="additional_info[get_features]">
											<input type="hidden" value="" name="additional_info[get_extra]">
											<input type="hidden" value="1" name="additional_info[get_for_one_product]">
										</div>
								
										<div id="qty_update_742" class="cm-reload-742">
											<input type="hidden" value="1" name="appearance[show_qty]">
											<input type="hidden" value="" name="appearance[capture_options_vs_qty]">
											<div class="form-field product-list-field">
												<label for="amount_<?php echo $this->_tpl_vars['product']->product_id; ?>
">Số lượng:</label>
												<span><?php echo $this->_tpl_vars['product']->amount; ?>
</span>
											</div>
											<?php if ($this->_tpl_vars['product']->weight != ""): ?>
											<div class="form-field product-list-field">
												<label for="weight_<?php echo $this->_tpl_vars['product']->product_id; ?>
">Trọng lượng:</label>
												<span><?php echo $this->_tpl_vars['product']->weight; ?>
</span>
											</div>
											<?php endif; ?>
											<?php if ($this->_tpl_vars['product']->length != ""): ?>
											<div class="form-field product-list-field">
												<label for="length_<?php echo $this->_tpl_vars['product']->product_id; ?>
">Chiều dài:</label>
												<span><?php echo $this->_tpl_vars['product']->length; ?>
</span>
											</div>
											<?php endif; ?>
											<?php if ($this->_tpl_vars['product']->width != ""): ?>
											<div class="form-field product-list-field">
												<label for="width_<?php echo $this->_tpl_vars['product']->product_id; ?>
">Chiều rộng:</label>
												<span><?php echo $this->_tpl_vars['product']->width; ?>
</span>
											</div>
											<?php endif; ?>
											<?php if ($this->_tpl_vars['product']->height != ""): ?>
											<div class="form-field product-list-field">
												<label for="height_<?php echo $this->_tpl_vars['product']->product_id; ?>
">Chiều cao:</label>
												<span><?php echo $this->_tpl_vars['product']->height; ?>
</span>
											</div>
											<?php endif; ?>
											<div class="form-field product-list-field">
												<label for="date_<?php echo $this->_tpl_vars['product']->product_id; ?>
">Ngày đăng:</label>
												<span><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->created)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>
</span>
											</div>
											<div class="form-field product-list-field">
												<label for="date_<?php echo $this->_tpl_vars['product']->product_id; ?>
">Cập nhật lúc:</label>
												<span><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->modified)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>
</span>
											</div>
										</div>
										<div id="advanced_options_update_742" class="cm-reload-742"></div>
											<div class="buttons-container nowrap">
												<div id="add_to_cart_update_742" class="cm-reload-742">
													<input type="hidden" value="1" name="appearance[show_add_to_cart]">
													<input type="hidden" value="" name="appearance[separate_buttons]">
													<input type="hidden" value="1" name="appearance[show_list_buttons]">
													<input type="hidden" value="action" name="appearance[but_role]">
													<span id="cart_add_block_742">
														<span class="button-submit-action" id="wrap_button_cart_742">
														<input type="submit" value="Add to Cart" name="dispatch[checkout.add..742]" id="button_cart_742">
														</span>
													</span>
													<span id="cart_buttons_block_742">
														<a name="dispatch:-wishlist.add..742-:" id="button_wishlist_742" class="cm-submit-link text-button">Cho vào danh sách yêu thích</a>
													</span>
												</div>
											</div>
										</div>
									</div>
							</form>
							<script src="/cscart/js/tabs.js" type="text/javascript"></script>
							<div class="tabs clear cm-j-tabs">
								<ul>
									<li class="cm-js cm-active" id="block_description"><a>Mô tả sản phẩm</a></li>
									<li class="cm-js" id="block_send_to_friend"><a>Gửi cho bạn bè</a></li>
									<li class="cm-js" id="block_tags"><a>Tags</a></li>
								</ul>
							</div>
							<div id="tabs_content" class="cm-tabs-content clear">
								<div class="wysiwyg-content" id="content_block_recurring_plans"></div>
								<div class="wysiwyg-content" id="content_block_description" style="display: block;">
									<p><b><?php echo $this->_tpl_vars['product']->introtext; ?>
</b></p>
									<p><?php echo $this->_tpl_vars['product']->fulltext; ?>
</p>
								</div>
								<div class="wysiwyg-content hidden" id="content_block_send_to_friend" style="display: none;">
									<div id="content_send_to_friend">
									<form method="post" action="index.php" name="send_to_friend_form">
										<input type="hidden" value="send_to_friend" name="selected_section">
										<input type="hidden" value="index.php?dispatch=products.view&amp;product_id=742" name="redirect_url">
										
										<div class="form-field">
											<label for="send_name">Name of your friend:</label>
											<input type="text" value="" name="send_data[to_name]" size="50" class="input-text" id="send_name">
										</div>
										
										<div class="form-field">
											<label class="cm-required cm-email" for="send_email">E-mail of your friend:</label>
											<input type="text" value="" name="send_data[to_email]" size="50" class="input-text" id="send_email">
										</div>
										
										<div class="form-field">
											<label for="send_yourname">Your name:</label>
											<input type="text" value="" name="send_data[from_name]" class="input-text" size="50" id="send_yourname">
										</div>
										
										<div class="form-field">
											<label class="cm-email" for="send_youremail">Your e-mail:</label>
											<input type="text" value="" name="send_data[from_email]" size="50" class="input-text" id="send_youremail">
										</div>
										
										<div class="form-field">
											<label class="cm-required" for="send_notes">Your message:</label>
											<textarea name="send_data[notes]" cols="72" rows="5" class="input-textarea" id="send_notes"><?php echo $this->_tpl_vars['product']->name; ?>
</textarea>
										</div>
										<p class="left">Type the characters you see in the picture below.</p>
								
										<p>
											<input type="text" autocomplete="off" value="" name="verification_answer" class="captcha-input-text valign">
											<img width="100" height="25" onclick="this.src += 'reload' ;" alt="" src="index.php?dispatch=image.captcha&amp;verification_id=e39f3833c1f94df521e6c940b5fe83dd:send_to_friend&amp;send_to_friend4f497cf6109c7&amp;" class="image-captcha valign" id="verification_image_send_to_friend">
										</p>
						
										<div class="buttons-container">
											<span class="button-submit"><input type="submit" value="Send" name="dispatch[send_to_friend.send]"></span>
						
										</div>
									</form>
								</div>
								</div>
																																			
								<div class="wysiwyg-content hidden" id="content_block_discussion"></div>
								<div class="wysiwyg-content hidden" id="content_block_features"></div>
								<div class="wysiwyg-content hidden" id="content_block_files"></div>
								<div class="wysiwyg-content hidden" id="content_block_required_products"></div>
								<div class="wysiwyg-content hidden" id="content_block_tags" style="display: none;">
									<div id="content_tags">
									    <form name="add_tags_form" method="post" action="index.php">
											<input type="hidden" value="index.php?dispatch=products.view&amp;product_id=742" name="redirect_url">
											<input type="hidden" value="P" name="tags_data[object_type]">
											<input type="hidden" value="742" name="tags_data[object_id]">
											<input type="hidden" value="tags" name="selected_section">
											<div class="form-field">
												<label>Popular tags:</label>
												None
											</div>
											<div class="form-field">
												<label>My tags:</label>
												<a href="index.php?dispatch=auth.login_form&amp;return_url=index.php%3Fdispatch%3Dproducts.view%26product_id%3D742" class="text-button">Sign in to enter tags</a>
											</div>
										</form>
									</div>
								</div>
							</div>
					</div>
					<div class="product-details"></div>
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