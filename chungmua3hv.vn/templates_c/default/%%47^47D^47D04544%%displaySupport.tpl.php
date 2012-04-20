<?php /* Smarty version 2.6.19, created on 2011-10-24 22:30:58
         compiled from displaySupport.tpl */ ?>
<div class="boxRight">
    <div class="boxTitle">
        Tư vấn trực tiếp
    </div>
    <?php $_from = $this->_tpl_vars['support']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['support']):
?>
        <div class="boxDiscount">
            <div class="nameSupport"><?php echo $this->_tpl_vars['support']['Support_Name']; ?>
</div>
            <div class="numbberSupport" style="font-weight:bold; font-family:'Times New Roman', Times, serif; font-size:14px;"><?php echo $this->_tpl_vars['support']['Support_Phone']; ?>
</div>
            <div class="numbberSupport"><a href="ymsgr:sendIM?<?php echo $this->_tpl_vars['support']['Support_Value']; ?>
"><img src="http://opi.yahoo.com/online?u=<?php echo $this->_tpl_vars['support']['Support_Value']; ?>
&m=g&t=2&l=us" border="0" /></a></div>
        </div>
      <?php endforeach; endif; unset($_from); ?>    
</div>