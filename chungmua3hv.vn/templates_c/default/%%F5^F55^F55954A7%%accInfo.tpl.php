<?php /* Smarty version 2.6.19, created on 2011-09-17 00:37:53
         compiled from accInfo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'selfUrl', 'accInfo.tpl', 9, false),array('modifier', 'encode', 'accInfo.tpl', 9, false),)), $this); ?>
<div class="pageTitle">THÔNG TIN CÁ NHÂN</div>
	<div class="err_signin">
    	<?php if ($this->_tpl_vars['msg']): ?>
        	<?php echo $this->_tpl_vars['msg']; ?>

        <?php endif; ?>
    </div>
<div class="signinBox">
    <form method="post" name="frmEditInformation" onsubmit="return checkfrmEditInformation(this)">
    	<input type="hidden" name="url" value="<?php echo ((is_array($_tmp=((is_array($_tmp='')) ? $this->_run_mod_handler('selfUrl', true, $_tmp) : selfUrl($_tmp)))) ? $this->_run_mod_handler('encode', true, $_tmp) : smarty_modifier_encode($_tmp)); ?>
" />
        <label class="formLabel_02" for="Name">Họ và tên<span class="formRequest">*</span></label>
        <input type="text" class="formInput" id="Name" name="frmName" value="<?php echo $this->_tpl_vars['accinfo']['Member_Name']; ?>
"><br />
       	
       
        <label class="formLabel_02" for="Email">Email<span class="formRequest">*</span></label>
        <input type="text" class="formInput" id="Email" name="frmEmail" value="<?php echo $this->_tpl_vars['accinfo']['Member_Email']; ?>
" title="Email đăng nhập"><br />
        <label class="formLabel_02" for="Phone">Điện thoại<span class="formRequest">*</span></label>
        <input type="text" class="formInput" id="Phone" name="frmPhone"  style="width:150px;" value="<?php echo $this->_tpl_vars['accinfo']['Member_Phone']; ?>
"><br />
        
        <label class="formLabel_02" for="Name"><span class="forrmDesc">Địa chỉ<span class="formRequest">*</span></span></label>
        <textarea  class="formInput" id="Name" name="frmAddress"><?php echo $this->_tpl_vars['accinfo']['Member_Address']; ?>
</textarea><br />
        
        <label class="formLabel_02" for="Name">Giới tính<span class="formRequest">*</span></label>
        <select name="frmGender" class="formInput" style="width:80px;">
        	<option value="1" <?php if ($this->_tpl_vars['accinfo']['Member_Gender'] == '1'): ?> selected="selected" <?php endif; ?>>Nam</option>
            <option value="2" <?php if ($this->_tpl_vars['accinfo']['Member_Gender'] == '2'): ?> selected="selected" <?php endif; ?>>Nữ</option>
        </select><br />
               <input name="memid" type="hidden" value="<?php echo $this->_tpl_vars['accinfo']['Member_ID']; ?>
">
        <br />
        
                             
        <label class="formLabel_02"></label>
        <input type="submit" class="formUpInfo" value="Lưu thông tin">
    </form>
</div>