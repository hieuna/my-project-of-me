<div class="right-column">
				<div class="ad-container center">
		<a href="index.php?dispatch=statistics.banners&amp;banner_id=1" >		<img class=" "  src="/cscart/images/promo/0/common_image_1.jpg" width="171" height="149" alt="build_your_pc.jpg"  border="0" />
		</a>	</div>
		
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
<div class="sidebox-wrapper ">
	<h3 class="sidebox-title"><span>My account</span></h3>

	<div class="sidebox-body">
<ul class="arrows-list">
			<li><a href="index.php?dispatch=auth.login_form&amp;return_url=index.php" rel="nofollow" class="underlined">Sign in</a> / <a href="index.php?dispatch=profiles.add" rel="nofollow" class="underlined">Register</a></li>
		<li><a href="index.php?dispatch=orders.search" rel="nofollow" class="underlined">Orders</a></li>

<li><a href="index.php?dispatch=tags.summary" rel="nofollow">My tags</a></li>

<li><a href="index.php?dispatch=wishlist.view" rel="nofollow">Wish list</a></li>

<li><a href="index.php?dispatch=subscriptions.search" rel="nofollow">Subscriptions</a></li>



</ul>

<div class="updates-wrapper" id="track_orders">

<form action="index.php" method="get" class="cm-ajax" name="track_order_quick">
<input type="hidden" name="result_ids" value="track_orders" />

<p>Track my order(s):</p>

<div class="form-field">

<label for="track_order_item12" class="cm-required hidden">Track my order(s):</label>
	<input type="text" size="20" class="input-text cm-hint" id="track_order_item12" name="track_data" value="Order ID/Email" />
	<input type="image" src="/cscart/skins/default_orange/customer/images/icons/go.gif" alt="Go" title="Go" class="go-button" />
<input type="hidden" name="dispatch" value="orders.track_request" />	</div>

</form>

<!--track_orders--></div>
</div>
	<div class="sidebox-bottom"><span>&nbsp;</span></div>
</div>
<div class="sidebox-wrapper ">
	<h3 class="sidebox-title"><span>Recently viewed</span></h3>

	<div class="sidebox-body"><ul class="bullets-list">

	<li>
		<a href="index.php?dispatch=products.view&amp;product_id=742">HP iPAQ hx2415 Pocket PC</a>
	</li>

</ul>
</div>
	<div class="sidebox-bottom"><span>&nbsp;</span></div>
</div>

<div class="sidebox-wrapper hidden cm-hidden-wrapper">
	<h3 class="sidebox-title"><span>Feature comparison</span></h3>

	<div class="sidebox-body"><div id="comparison_list">


<!--comparison_list--></div>
</div>
	<div class="sidebox-bottom"><span>&nbsp;</span></div>
</div>
			</div>