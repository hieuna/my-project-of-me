<div class="mainbox2-container">
	<h1 class="mainbox2-title clear"><span>Sản phẩm trong ngày</span></h1>
	<div class="mainbox2-body">
		<div class="product-container clear">
			<div class="float-left product-item-image center">
				<span class="cm-reload-250001498 image-reload">
				<a href="index.php?dispatch=product.view&product_id={$product_of_day->product_id}">
					<img src="{$product_of_day->image1}" width="120"  alt="{$product_of_day->name}" border="0" />
				</a>
				</span>
			</div>
			<div class="product-info">
				<a href="index.php?dispatch=product.view&product_id={$product_of_day->product_id}" class="product-title">{$product_of_day->name}</a>	
				<p class="sku">
					<span class="cm-reload-250001498">
						<span>CODE: <span>{$product_of_day->code}</span></span>
					</span>
				</p>
				<div class="prod-info">
					<div class="prices-container clear">
						<div class="float-left product-prices">
							<span class="cm-reload-250001498 price-update" id="price_update_250001498">
								<span class="price">
									<span class="price">{$product_of_day->price|number_format}</span>
									<span class="price">VNĐ</span>
								</span>
							</span>
						</div>
					</div>
					<span class="cm-reload-250001498" id="product_amount_update_250001498">
						<span class="strong in-stock">Còn hàng</span>
					</span>
		
					<div class="product-descr">
						{$product_of_day->introtext}
						<a href="index.php?dispatch=products.view&amp;product_id=1498" class="lowercase">Xem chi tiết</a>			
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="mainbox2-bottom"><span>&nbsp;</span></div>
</div>