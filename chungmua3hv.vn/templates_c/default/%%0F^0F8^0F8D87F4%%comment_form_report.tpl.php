<?php /* Smarty version 2.6.19, created on 2011-09-17 00:41:16
         compiled from comment_form_report.tpl */ ?>
<div id="resultReport"><div class="frmAdđEmail">
<?php if ($this->_tpl_vars['msg']): ?><?php echo $this->_tpl_vars['msg']; ?>

<center><p>

<input type="button" onclick="return closeForm();" class="formBtn" style="clear:both; margin-top:10px; "value="Okie" />
</p></center>

<?php else: ?>
<form method="post" id="emailForm" name="emailForm" onsubmit="return checkFormReport(this)">
<input type="hidden" name="ID" value="<?php echo $this->_tpl_vars['comment']['Comment_ID']; ?>
" />
<h2>Bạn thấy bình luận này vi phạm một trong các điều dưới đây?</h2>
<div style="font-weight:normal; color:red; margin-bottom:5px;"><?php if ($this->_tpl_vars['msg']): ?><?php echo $this->_tpl_vars['msg']; ?>
<?php endif; ?></div>
<label style="font-weight:normal;"> - Nội dung mang tính chất phản động, đả kích.</label><br />
<label style="font-weight:normal;"> - Nội dung không lành mạnh, vô văn hóa...</label><br />
<label style="font-weight:normal;"> - Nội dung không chính xác, mang tính chất quảng cáo, rao vặt...</label><br />
<center><p>

<input type="button" onclick="return closeForm();" class="formBtn" style="clear:both; margin-top:10px; "value="Thoát" />
<input type="submit" class="formBtn" style="clear:both; margin-top:10px;margin-left:5px; "value="Đúng" /></p></center>
</form>
<?php endif; ?>
</div></div>