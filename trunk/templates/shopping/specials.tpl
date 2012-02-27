<div class="mainbox2-container">
	<h1 class="mainbox2-title clear"><span>Sản phẩm nổi bật</span></h1>
	<div class="mainbox2-body">
		<table cellpadding="3" cellspacing="3" border="0" width="100%">
		<tr>
			{section name=loops loop=$lsProductSpecial}
			<td valign="top" class="border-bottom" style="width: 30%;">
				<form action="index.php" method="post" name="product_form_180001153" enctype="multipart/form-data" class="cm-disable-empty-files cm-ajax">
					<input type="hidden" name="result_ids" value="cart_status,wish_list" />
					<input type="hidden" name="redirect_url" value="index.php" />
					<input type="hidden" name="product_data[1153][product_id]" value="1153" />
					<table border="0" cellpadding="3" cellspacing="3" width="100%">
						<tr valign="top">
							<td class="center product-image" width="2%">
								<a href="{$lsProductSpecial[loops].link}">
								<img class=" " id="{$lsProductSpecial[loops].name}" src="{$lsProductSpecial[loops].image1}" width="40" height="40" alt="{$lsProductSpecial[loops].name}"  border="0" />
								</a>
							</td>
							<td width="30%" class="compact">
								<a href="{$lsProductSpecial[loops].link}" class="product-title" title="{$lsProductSpecial[loops].name}">{$lsProductSpecial[loops].name}</a>	
								<p>							
									<span class="cm-reload-180001153 price-update" id="price_update_180001153">
										<input type="hidden" name="appearance[show_price_values]" value="1" />
										<input type="hidden" name="appearance[show_price]" value="1" />
										<span class="price" id="line_discounted_price_180001153">
											<span id="sec_discounted_price_180001153" class="price">{$lsProductSpecial[loops].price|number_format}</span>
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
										<a class="cm-submit-link text-button" id="button_cart_180001153" name="dispatch:-checkout.add..1153-:">Giỏ hàng</a>
									</span>
								</div>
							</td>
						</tr>
					</table>
				</form>
			</td>
			{if $lsProductSpecial[loops].stt%3 ==0}
			</tr><tr>
			{else}
			<td width="2%">&nbsp;</td>
			{/if}
			{/section}
			</tr>
			</tr>
		</table>
	</div>
</div>