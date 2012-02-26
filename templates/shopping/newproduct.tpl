<div class="sidebox-wrapper ">
	<h3 class="sidebox-title"><span>Sản phẩm mới</span></h3>
	<div class="sidebox-body">
		<ul>
			{section name=loops loop=$lsProductNews}
			<li class="compact">
				<div class="item-image product-item-image">
					<a href="{$lsProductNews[loops].link}">
					<img src="{$lsProductNews[loops].image1}" width="40" height="40" alt="{$lsProductNews[loops].name}" border="0" />
					</a>
				</div>
				<div class="item-description">
					<a href="{$lsProductNews[loops].link}" class="product-title">{$lsProductNews[loops].name}</a>	
					<div class="margin-top">
						<span class="cm-reload-260001028 price-update">
							<span class="price">
								<span class="price">{$lsProductNews[loops].price|number_format}</span>
								<span class="price">VNĐ</span>
							</span>
						</span>
					</div>
				</div>
			</li>
			<li class="delim">&nbsp;</li>
			{/section}
		</ul>
	</div>
	<div class="sidebox-bottom"><span>&nbsp;</span></div>
</div>