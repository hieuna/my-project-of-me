<?php /* Smarty version 2.6.19, created on 2012-04-20 22:15:31
         compiled from displayDiscount.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'displayDiscount.tpl', 9, false),array('modifier', 'percent', 'displayDiscount.tpl', 12, false),)), $this); ?>
<div class="boxRight">
    <div class="boxTitle">Đang giảm giá</div>
    <?php $_from = $this->_tpl_vars['discount']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['discount']):
?>
    <div class="boxDiscount">
        <a href="san-pham-<?php echo $this->_tpl_vars['discount']['Product_ID']; ?>
/<?php echo $this->_tpl_vars['discount']['Product_LinkName']; ?>
.html" title="<?php echo $this->_tpl_vars['discount']['Product_Name']; ?>
" class="discountTitle"><?php echo $this->_tpl_vars['discount']['Product_Deal']; ?>
</a>
        <div class="discountImg">
            <img src="upload/product/thumb/<?php echo $this->_tpl_vars['discount']['Product_Photo']; ?>
" title="<?php echo $this->_tpl_vars['discount']['Product_Name']; ?>
" />
        </div>
        <div class="discountDetai"><b><?php echo ((is_array($_tmp=@$this->_tpl_vars['discount']['DestinationID'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Toàn quốc') : smarty_modifier_default($_tmp, 'Toàn quốc')); ?>
</b>: <?php echo $this->_tpl_vars['discount']['Product_Name']; ?>
</div>

        <div class="discountBot">
            <div class="discountLabel">Giảm <?php echo ((is_array($_tmp=$this->_tpl_vars['discount']['Product_Price']-$this->_tpl_vars['discount']['Product_DealPrice'])) ? $this->_run_mod_handler('percent', true, $_tmp, $this->_tpl_vars['discount']['Product_Price']) : smarty_modifier_percent($_tmp, $this->_tpl_vars['discount']['Product_Price'])); ?>
%</div>
            <div class="discountView"><a href="san-pham-<?php echo $this->_tpl_vars['discount']['Product_ID']; ?>
/<?php echo $this->_tpl_vars['discount']['Product_LinkName']; ?>
.html" title="<?php echo $this->_tpl_vars['discount']['Product_Name']; ?>
">Xem chi tiết +</a></div>
            <div class="clr"></div>
        </div>
    </div>
    <?php endforeach; endif; unset($_from); ?>      
</div>