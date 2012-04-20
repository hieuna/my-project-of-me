<?php /* Smarty version 2.6.19, created on 2011-09-17 10:12:29
         compiled from product_sold.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'product_sold.tpl', 6, false),array('modifier', 'percent', 'product_sold.tpl', 8, false),array('modifier', 'number_format', 'product_sold.tpl', 11, false),)), $this); ?>
                <div class="pageTitle">SẢN PHẨM ĐÃ BÁN</div>     
<div class="pageDefault">
<?php if ($this->_tpl_vars['product_item_sold']): ?><?php $_from = $this->_tpl_vars['product_item_sold']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oProduct']):
?>
                <!-- Mot box hien thi-->
                <div class="soldBox">
                	<div class="soldTitle"><a title="<?php echo $this->_tpl_vars['oProduct']['Product_Name']; ?>
" href="san-pham-<?php echo $this->_tpl_vars['oProduct']['Product_ID']; ?>
/<?php echo $this->_tpl_vars['oProduct']['Product_LinkName']; ?>
.html" ><?php echo ((is_array($_tmp=$this->_tpl_vars['oProduct']['Product_Name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 100) : smarty_modifier_truncate($_tmp, 100)); ?>
</a></div>
                    <div class="soldImage">
                        <div class="soldLabel">Giảm<p><?php echo ((is_array($_tmp=$this->_tpl_vars['oProduct']['Product_Price']-$this->_tpl_vars['oProduct']['Product_DealPrice'])) ? $this->_run_mod_handler('percent', true, $_tmp, $this->_tpl_vars['oProduct']['Product_Price']) : smarty_modifier_percent($_tmp, $this->_tpl_vars['oProduct']['Product_Price'])); ?>
%</p></div>
                        <a title="<?php echo $this->_tpl_vars['oProduct']['Product_Name']; ?>
" href="san-pham-<?php echo $this->_tpl_vars['oProduct']['Product_ID']; ?>
/<?php echo $this->_tpl_vars['oProduct']['Product_LinkName']; ?>
.html"><img  src="upload/product/<?php echo $this->_tpl_vars['oProduct']['Product_Photo']; ?>
" alt="<?php echo $this->_tpl_vars['oProduct']['Product_Name']; ?>
"/></a>
                    </div>
                    <div class="soldPrice"><?php echo ((is_array($_tmp=$this->_tpl_vars['oProduct']['Product_DealPrice'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
 đ</div>
                    <div class="soldInfo">
                        Giá trị: <b class="soldValue"><?php echo ((is_array($_tmp=$this->_tpl_vars['oProduct']['Product_Price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
 đ </b><br />
                        Tiết kiệm: <b class="soldSave"><?php echo ((is_array($_tmp=$this->_tpl_vars['oProduct']['Product_Price']-$this->_tpl_vars['oProduct']['Product_DealPrice'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
 đ </b>
                    </div>   
                </div>
                
                
            <?php endforeach; endif; unset($_from); ?>
            <?php else: ?>
            Chưa có dữ liệu
            <?php endif; ?>       
                <div class="page">
             <?php if ($this->_tpl_vars['sPaging']): ?>   <?php echo $this->_tpl_vars['sPaging']; ?>
<?php endif; ?>      <!-- Phan trang-->
                   
                </div>
                <div class="clr"></div>
            </div>