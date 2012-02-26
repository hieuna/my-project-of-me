<?php /* Smarty version 2.6.10, created on 2012-02-26 04:47:28
         compiled from D:/AppServ/www/projects/templates/shopping/menuleft.tpl */ ?>
<div class="sidebox-categories-wrapper ">
	<h3 class="sidebox-title">
	<span>Danh mục sản phẩm</span></h3>
	<div class="sidebox-body">
		<div class="clear">
			<?php echo $this->_tpl_vars['showMenuLeft']; ?>

			<ul id="vmenu_8" class="dropdown dropdown-vertical">
				<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['lsMenuLeft']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<li class="dir">
					<ul>
						<li><a href="index.php?dispatch=categories.view&amp;category_id=152">sadsadasdsa</a></li>
						<li class="h-sep">&nbsp;</li>
						<li><a href="index.php?dispatch=categories.view&amp;category_id=153">Nhóm sản phẩm con</a></li>
					</ul>
					<a href="index.php?dispatch=categories.view&amp;category_id=93"><?php echo $this->_tpl_vars['lsMenuLeft'][$this->_sections['loops']['index']]['name']; ?>
</a>
				</li>
				<li class="h-sep">&nbsp;</li>
				<?php endfor; endif; ?>
			</ul>
		</div>
	</div>
	<div class="sidebox-bottom"><span>&nbsp;</span></div>
</div>