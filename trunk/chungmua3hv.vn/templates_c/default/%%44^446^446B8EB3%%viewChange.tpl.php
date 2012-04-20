<?php /* Smarty version 2.6.19, created on 2011-09-17 00:38:18
         compiled from viewChange.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'selfUrl', 'viewChange.tpl', 9, false),array('modifier', 'encode', 'viewChange.tpl', 9, false),)), $this); ?>
<div class="pageTitle">Thay đổi mật khẩu</div>
	<div class="err_signin">
    	<?php if ($this->_tpl_vars['msg']): ?>
        	<?php echo $this->_tpl_vars['msg']; ?>

        <?php endif; ?>
    </div>
<div class="signinBox">
    <form method="post" name="frmChangePassword" onsubmit="return frmPasswordTest(this)">
    	<input type="hidden" name="url" value="<?php echo ((is_array($_tmp=((is_array($_tmp='')) ? $this->_run_mod_handler('selfUrl', true, $_tmp) : selfUrl($_tmp)))) ? $this->_run_mod_handler('encode', true, $_tmp) : smarty_modifier_encode($_tmp)); ?>
" />
        <label class="formLabel_02" for="Name">Mật khẩu hiện tại<span class="formRequest">*</span></label>
        <input type="password" class="formInput" id="Name" name="frmPassword" value=""><br />
        <label class="formLabel_02" for="Name">Mật khẩu mới<span class="formRequest">*</span></label>
        <input type="password" class="formInput" id="Name" name="frmPasswordNew" value=""><br />
       	
        <label class="formLabel_02" for="Name">Nhập lại mật khẩu<span class="formRequest">*</span></label>
        <input type="password" class="formInput" id="Name" name="frmPasswordNewConfirm" value=""><br />
        <p style="margin-left:60px;"><label class="formLabel"></label>
        <input type="submit" class="formUpInfo" value="Đổi mật khẩu"> &nbsp; Click <a style="text-decoration:underline" href="quen-mat-khau.html">vào đây</a> nếu bạn quên mật khẩu</p>
    </form>
</div>