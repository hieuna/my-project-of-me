<div class="unified_widget rcm widget small_heading" id="widget_seller">
	<h2>Nhóm sản phẩm bán chạy</h2>
	{section name=loops loop=$lsProductSeller}
	<div style="float: left; width: 20%" class="fluid asin s9a0">
		<div class="inner">
			<div style="position: relative" class="s9hl">
				<a title="{$lsProductSeller[loops].name}" class="title ntTitle noLinkDecoration" href="{$lsProductSeller[loops].link}">
					<div class="imageContainer">
						<img width="135" height="94" alt="{$lsProductSeller[loops].name}" src="{$lsProductSeller[loops].image1}">
					</div>
					{$lsProductSeller[loops].name}
				</a>
				<br clear="none">
				<span class="newListprice gry t11">{$lsProductSeller[loops].price_ny|number_format}{$menh_gia}</span>
				<span class="red t14">{$lsProductSeller[loops].price|number_format}{$menh_gia}</span>
			</div>
		</div>
	</div>
	{/section}
	<div style="clear: left; width: 100%; height: 1px; margin: 0; padding: 0; overflow: hidden"></div>
	<div class="action">
		<span class="carat">&rsaquo;</span>
		<a href="#">Xem thêm</a>
	</div>
	<div class="h_rule"></div>
</div>