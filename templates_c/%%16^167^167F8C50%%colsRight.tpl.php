<?php /* Smarty version 2.6.10, created on 2012-02-27 13:58:44
         compiled from D:/AppServ/www/projects/templates/shopping/colsRight.tpl */ ?>
<div class="right-column">
				<div class="ad-container center">
		<a href="index.php?dispatch=statistics.banners&amp;banner_id=1" >		
		<img src="images/common_image_1.jpg" width="171" height="149" alt="build_your_pc.jpg"  border="0" />
		</a>	</div>
		
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['dir_template'])."/newproduct.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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