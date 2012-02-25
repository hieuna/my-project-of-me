<?php /* Smarty version 2.6.10, created on 2012-02-25 21:56:16
         compiled from D:/AppServ/www/projects/templates/shopping/colsRight.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'D:/AppServ/www/projects/templates/shopping/colsRight.tpl', 22, false),)), $this); ?>
<div class="right-column">
				<div class="ad-container center">
		<a href="index.php?dispatch=statistics.banners&amp;banner_id=1" >		<img class=" "  src="/cscart/images/promo/0/common_image_1.jpg" width="171" height="149" alt="build_your_pc.jpg"  border="0" />
		</a>	</div>
		
<div class="sidebox-wrapper ">
	<h3 class="sidebox-title"><span>Sản phẩm mới</span></h3>
	<div class="sidebox-body">
		<ul>
			<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['lsProductNews']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<li class="compact">
				<div class="item-image product-item-image">
					<a href="<?php echo $this->_tpl_vars['lsProductNews'][$this->_sections['loops']['index']]['link']; ?>
">
					<img src="<?php echo $this->_tpl_vars['lsProductNews'][$this->_sections['loops']['index']]['image1']; ?>
" width="40" height="40" alt="<?php echo $this->_tpl_vars['lsProductNews'][$this->_sections['loops']['index']]['name']; ?>
" border="0" />
					</a>
				</div>
				<div class="item-description">
					<a href="<?php echo $this->_tpl_vars['lsProductNews'][$this->_sections['loops']['index']]['link']; ?>
" class="product-title"><?php echo $this->_tpl_vars['lsProductNews'][$this->_sections['loops']['index']]['name']; ?>
</a>	
					<div class="margin-top">
						<span class="cm-reload-260001028 price-update">
							<span class="price">
								<span class="price"><?php echo ((is_array($_tmp=$this->_tpl_vars['lsProductNews'][$this->_sections['loops']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
								<span class="price">VNĐ</span>
							</span>
						</span>
					</div>
				</div>
			</li>
			<li class="delim">&nbsp;</li>
			<?php endfor; endif; ?>
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