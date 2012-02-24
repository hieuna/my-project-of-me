<?php /* Smarty version 2.6.10, created on 2012-02-24 14:53:19
         compiled from D:/AppServ/www/projects/templates/shopping/header.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['dir_template'])."/header_global.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="helper-container">
	<a name="top"></a>
	<div id="ajax_loading_box" class="ajax-loading-box">
		<div class="right-inner-loading-box">
			<div id="ajax_loading_message" class="ajax-inner-loading-box">Loading...</div>
		</div>
	</div>
	<div id="container" class="container">
		<div id="header">
			<div class="header-helper-container">
				<div class="logo-image">
					<a href="index.php"><img src="/cscart/skins/default_orange/customer/images/customer_area_logo.png" width="176" height="69" border="0" alt="Simbirsk Technologies Ltd" /></a>
				</div>
				<p class="quick-links">&nbsp;
						<a href="index.php">Home</a>
						<a href="index.php?dispatch=pages.view&amp;page_id=3">About Us</a>
			
						<a href="index.php?dispatch=pages.view&amp;page_id=1">Contact Us</a>
						<a href="index.php?dispatch=gift_certificates.add">Gift certificates</a>
						<a href="index.php?dispatch=promotions.list">Promotions</a>
						<a href="index.php?dispatch=sitemap.view">Sitemap</a>
				</p>
			<div id="top_menu">
			<ul class="top-menu dropdown"><li class="first-level cm-active"><span><a href="index.php">Home</a></span></li><li class="first-level "><span><a href="index.php?dispatch=categories.catalog">Catalog</a></span></li><li class="first-level "><span><a href="index.php?dispatch=profiles.update">My Account</a></span></li><li class="first-level "><span><a href="index.php?dispatch=checkout.cart">View cart</a></span></li><li class="first-level "><span><a href="index.php?dispatch=pages.view&amp;page_id=3">Company</a></span>
			<ul class="dropdown-vertical-rtl">
						<li >
					<a href="index.php?dispatch=pages.view&amp;page_id=3">About our company</a>
						</li>
					<li class="h-sep">&nbsp;</li>
						<li >
					<a href="index.php?dispatch=pages.view&amp;page_id=1">Contact us</a>
						</li>
			
					<li class="h-sep">&nbsp;</li>
						<li >
					<a href="index.php?dispatch=pages.view&amp;page_id=4">Poll of the week</a>
						</li>
					<li class="h-sep">&nbsp;</li>
						<li >
					<a href="index.php?dispatch=pages.view&amp;page_id=2">What is CS-Cart?</a>
						</li>
			
					</ul>
			</li></ul>
			</div>
			<span class="helper-block">&nbsp;</span>
	</div>

<div class="top-tools-container">
	<span class="float-left">&nbsp;</span>
	<span class="float-right">&nbsp;</span>
	<div class="top-tools-helper">
		<div class="float-right" id="sign_io">
										<a id="sw_login" class="cm-combination">Sign in</a>

				or
				<a href="index.php?dispatch=profiles.add" rel="nofollow">Register</a>
						
						<div id="login" class="cm-popup-box hidden">
				<div class="login-popup">
					<div class="header">Sign in</div>
					


	<form name="login_popup_form" action="index.php" method="post">
<input type="hidden" name="form_name" value="login_popup_form" />
<input type="hidden" name="return_url" value="index.php" />

<div class="form-field">

	<label for="login_popup" class="cm-required">Username:</label>
	<input type="text" id="login_popup" name="user_login" size="30" value="" class="input-text cm-focus" />
</div>

<div class="form-field">
	<label for="psw_popup" class="cm-required">Password:</label>
	<input type="password" id="psw_popup" name="password" size="30" value="" class="input-text password" />
</div>

	
		
	<p class="left">Type the characters you see in the picture below.</p>

		
	<p><input class="captcha-input-text valign" type="text" name="verification_answer" value= "" autocomplete="off" />
			<img id="verification_image_login_login_popup_form" class="image-captcha valign" src="index.php?dispatch=image.captcha&amp;verification_id=e39f3833c1f94df521e6c940b5fe83dd:login_login_popup_form&amp;login_login_popup_form4f427cad51047&amp;" alt="" onclick="this.src += 'reload' ;"  width="100" height="25" />
	</p>

<div class="clear">
	<div class="float-left">
		<input class="valign checkbox" type="checkbox" name="remember_me" id="remember_me_popup" value="Y" />
		<label for="remember_me_popup" class="valign lowercase">Remember me</label>
	</div>

	<div class="float-right">
		
		
 
	<span   class="button-submit-action"><input   type="submit" name="dispatch[auth.login]"  value="Sign in" /></span>

	</div>
</div>
<p class="center"><a href="index.php?dispatch=auth.recover_password">Forgot your password?</a></p>
</form>

				</div>
			</div>

					<!--sign_io--></div>
		<div class="top-search">
			<form action="index.php" name="search_form" method="get">
<input type="hidden" name="subcats" value="Y" />
<input type="hidden" name="status" value="A" />
<input type="hidden" name="pshort" value="Y" />
<input type="hidden" name="pfull" value="Y" />
<input type="hidden" name="pname" value="Y" />
<input type="hidden" name="pkeywords" value="Y" />
<input type="hidden" name="search_performed" value="Y" />
 

<span class="search-products-text">Search:</span>

<select	name="cid" class="search-selectbox">
	<option	value="0">- All categories -</option>
		<option	value="93" >Books</option>
		<option	value="85" >Computers</option>
		<option	value="113" >Music</option>
		<option	value="87" >Apparel</option>
		<option	value="111" >DVD</option>

		<option	value="95" >Audio &amp; Video</option>
		<option	value="119" >Cell Phones</option>
		<option	value="129" >Sports &amp; Outdoors</option>
	</select>

<input type="text" name="q" value="" onfocus="this.select();" class="search-input" /><input type="image" src="/cscart/skins/default_orange/customer/images/icons/go.gif" alt="Search" title="Search" class="go-button" /><input type="hidden" name="dispatch" value="products.search" /><a href="index.php?dispatch=products.search" class="search-advanced">Advanced search</a>

</form>
		</div>
	</div>
</div>

<div class="content-tools">
	<span class="float-left">&nbsp;</span>
	<span class="float-right">&nbsp;</span>
	<div class="content-tools-helper clear">
		
	<div id="cart_status">

	<div class="float-left">
					<img id="sw_cart_box" class="cm-combination cm-combo-on valign hand" src="/cscart/skins/default_orange/customer/images/icons/filled_cart_icon.gif" border="0" alt="Cart" title="Cart" />
			<span class="lowercase"><a href="index.php?dispatch=checkout.cart"><strong>1</strong>&nbsp;item(s)</a>, 			Subtotal:&nbsp;<strong>$449.99</strong></span>
			
		<div id="cart_box" class="cart-list hidden cm-popup-box cm-smart-position">
			<img src="/cscart/skins/default_orange/customer/images/icons/filled_cart_list_icon.gif" alt="Cart" class="cm-popup-switch hand cart-list-icon" />
			<div class="list-container">
				<div class="list">

									<ul>
																														<li class="clear">
							<a href="index.php?dispatch=products.view&amp;product_id=742">HP iPAQ hx2415 Pocket PC</a>
	

	<a  name="delete_cart_item" href="index.php?dispatch=checkout.delete.from_status&amp;cart_id=2912454768" class="cm-ajax" rev="cart_status"><img src="/cscart/skins/default_orange/customer/images/icons/icon_delete_small.gif" width="10" height="9" border="0" alt="Delete" title="Delete" /></a>

							<p>
								<strong class="valign">1</strong>&nbsp;x&nbsp;<span class="none">$</span><span id="sec_price_2912454768" class="none">449.99</span>							</p>

						</li>
																													</ul>
								</div>
				<div class="buttons-container full-cart">
					<a href="index.php?dispatch=checkout.cart" rel="nofollow" class="view-cart">View cart</a>
											<a href="index.php?dispatch=checkout.checkout" rel="nofollow">Checkout</a>
									</div>
			</div>

		</div>
	</div>

	<div class="checkout-link full-cart">

	<a href="index.php?dispatch=checkout.checkout" rel="nofollow">Checkout</a>

	</div>
	<!--cart_status--></div>
		<div class="float-right">

			
			
							<div class="select-wrap">

		
		
	<a class="select-link cm-combo-on cm-combination" id="sw_select_USD_wrap_">US Dollars&nbsp;($)</a>

	<div id="select_USD_wrap_" class="select-popup cm-popup-box hidden">
		<img src="/cscart/skins/default_orange/customer/images/icons/icon_close.gif" width="13" height="13" border="0" alt="" class="close-icon no-margin cm-popup-switch" />
		<ul class="cm-select-list">
							<li><a rel="nofollow" name="USD" href="index.php?currency=USD"  class=" active">US Dollars&nbsp;($)</a></li>

							<li><a rel="nofollow" name="EUR" href="index.php?currency=EUR"  class=" ">Euro&nbsp;(&#8364;)</a></li>
							<li><a rel="nofollow" name="GBP" href="index.php?currency=GBP"  class=" ">GB Pound&nbsp;(&#163;)</a></li>
					</ul>
	</div>
</div>
					</div>

	</div>
</div></div>