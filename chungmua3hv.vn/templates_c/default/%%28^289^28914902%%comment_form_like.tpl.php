<?php /* Smarty version 2.6.19, created on 2011-09-17 00:41:19
         compiled from comment_form_like.tpl */ ?>
<div id="resultReport"><div class="frmAdđEmail">
<?php if ($this->_tpl_vars['msg']): ?><?php echo $this->_tpl_vars['msg']; ?>

<center><p>
<input type="button" onclick="return closeForm();" class="formBtn" style="clear:both; margin-top:10px; "value="Okie" />
</p></center>

<?php else: ?>
<form method="post" id="emailForm" name="emailForm" onsubmit="return checkFormLike(this)">
<input type="hidden" name="ID" value="<?php echo $this->_tpl_vars['comment']['Comment_ID']; ?>
" />
<h2>Bạn đồng ý với bình luận này!</h2>
<div style="font-weight:normal; color:red; margin-bottom:5px;"><?php if ($this->_tpl_vars['msg']): ?><?php echo $this->_tpl_vars['msg']; ?>
<?php endif; ?></div>
<center><p>

<input type="button" onclick="return closeForm();" class="formBtn" style="clear:both; margin-top:10px; "value="Thoát" />
<input type="submit" class="formBtn" style="clear:both; margin-top:10px;margin-left:5px; "value="Đúng" /></p></center>
</form>
<?php endif; ?>
</div></div>