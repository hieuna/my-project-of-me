<?php /* Smarty version 2.6.10, created on 2012-02-26 04:45:06
         compiled from D:/AppServ/www/projects/templates/shopping/newproduct.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'D:/AppServ/www/projects/templates/shopping/newproduct.tpl', 17, false),)), $this); ?>
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