<div class="unified_widget rcm widget small_heading" id="ns_0F50DNGPMDNXKSZSZ9NJ_3826_Widget">
	<h2>Nhóm sản phẩm nổi bật</h2>
	{section name=loops loop=$lsProductSpecial}
	<div style="float: left; width: 20%" class="fluid asin s9a0">
		<div class="inner">
			<div style="position: relative" class="s9hl">
				<a title="{$lsProductSpecial[loops].name}" class="title ntTitle noLinkDecoration" href="{$lsProductSpecial[loops].link}">
					<div class="imageContainer">
						<img width="135" height="94" alt="{$lsProductSpecial[loops].name}" src="{$lsProductSpecial[loops].image1}">
					</div>
					{$lsProductSpecial[loops].name}
				</a>
				<br clear="none">
				<span class="newListprice gry t11">{$lsProductSpecial[loops].price_ny|number_format}{$menh_gia}</span>
				<span class="red t14">{$lsProductSpecial[loops].price|number_format}{$menh_gia}</span>
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