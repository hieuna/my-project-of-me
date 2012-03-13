<?php /* Smarty version 2.6.10, created on 2012-03-13 13:30:02
         compiled from D:/AppServ/www/projects/templates/shopping/products.seller.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'D:/AppServ/www/projects/templates/shopping/products.seller.tpl', 14, false),)), $this); ?>
<div class="unified_widget rcm widget small_heading" id="ns_0F50DNGPMDNXKSZSZ9NJ_3826_Widget">
	<h2>Nhóm sản phẩm bán chạy</h2>
	<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['lsProductSeller']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<div style="float: left; width: 20%" class="fluid asin s9a0">
		<div class="inner">
			<div style="position: relative" class="s9hl">
				<a title="<?php echo $this->_tpl_vars['lsProductSeller'][$this->_sections['loops']['index']]['name']; ?>
" class="title ntTitle noLinkDecoration" href="<?php echo $this->_tpl_vars['lsProductSeller'][$this->_sections['loops']['index']]['link']; ?>
">
					<div class="imageContainer">
						<img width="135" height="94" alt="<?php echo $this->_tpl_vars['lsProductSeller'][$this->_sections['loops']['index']]['name']; ?>
" src="<?php echo $this->_tpl_vars['lsProductSeller'][$this->_sections['loops']['index']]['image1']; ?>
">
					</div>
					<?php echo $this->_tpl_vars['lsProductSeller'][$this->_sections['loops']['index']]['name']; ?>

				</a>
				<br clear="none">
				<span class="newListprice gry t11"><?php echo ((is_array($_tmp=$this->_tpl_vars['lsProductSeller'][$this->_sections['loops']['index']]['price_ny'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp));  echo $this->_tpl_vars['menh_gia']; ?>
</span>
				<span class="red t14"><?php echo ((is_array($_tmp=$this->_tpl_vars['lsProductSeller'][$this->_sections['loops']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp));  echo $this->_tpl_vars['menh_gia']; ?>
</span>
			</div>
		</div>
	</div>
	<?php endfor; endif; ?>
	<div style="clear: left; width: 100%; height: 1px; margin: 0; padding: 0; overflow: hidden"></div>
	<div class="action">
		<span class="carat">&rsaquo;</span>
		<a href="#">Xem thêm</a>
	</div>
	<div class="h_rule"></div>
</div>