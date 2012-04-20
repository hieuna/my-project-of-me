<?php /* Smarty version 2.6.19, created on 2011-09-17 00:33:43
         compiled from adver.tpl */ ?>
<div class="boxAdvert">
<div class="boxTitle">Quảng Cáo</div>
    <div class="adver">
    <?php $_from = $this->_tpl_vars['adver']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['adver']):
?>
    	<?php if ($this->_tpl_vars['adver']['Image_Type'] == 'swf'): ?>
        	<?php echo $this->_tpl_vars['adver']['str']; ?>

        <?php else: ?>
        	<a href="<?php echo $this->_tpl_vars['adver']['Image_Link']; ?>
"><?php echo $this->_tpl_vars['adver']['str']; ?>
</a>
        <?php endif; ?>        
    <?php endforeach; endif; unset($_from); ?>
    </div>
</div>