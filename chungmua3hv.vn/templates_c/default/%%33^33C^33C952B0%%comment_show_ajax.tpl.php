<?php /* Smarty version 2.6.19, created on 2011-09-17 00:41:22
         compiled from comment_show_ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'agoTime', 'comment_show_ajax.tpl', 6, false),array('modifier', 'echo_date', 'comment_show_ajax.tpl', 7, false),array('modifier', 'default', 'comment_show_ajax.tpl', 10, false),)), $this); ?>
                <?php if ($this->_tpl_vars['comment_item_ajax']): ?><?php $_from = $this->_tpl_vars['comment_item_ajax']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['commentItemAjax']):
?>
                <div class="commentAjaxLoad" id="<?php echo $this->_tpl_vars['commentItemAjax']['Comment_ID']; ?>
">
                <div class="commentUser">
                    <img src="upload/no-avatar.jpg" />
                    <div class="commentUserInfo">
                    	<div class="userName"><span><?php echo $this->_tpl_vars['commentItemAjax']['Member_Name']; ?>
</span> - Gửi  cách đây <?php echo ((is_array($_tmp=$this->_tpl_vars['commentItemAjax']['Comment_Mktime'])) ? $this->_run_mod_handler('agoTime', true, $_tmp) : agoTime($_tmp)); ?>
 trước</div>
                        <p>Đăng ký ngày: <?php echo ((is_array($_tmp=$this->_tpl_vars['commentItemAjax']['Member_time_limit'])) ? $this->_run_mod_handler('echo_date', true, $_tmp, 'd/m/Y') : smarty_modifier_echo_date($_tmp, 'd/m/Y')); ?>
</p>
                    </div>
                    <div class="commentUserInfo_2">
                    	<div class="userBought"><a class="icon-alert"  onclick="return buydeal(this);" href="bao-cao-vi-pham-p-<?php echo $this->_tpl_vars['commentItemAjax']['Comment_ID']; ?>
.html?size=500x150">Báo cáo vi phạm (<?php echo ((is_array($_tmp=@$this->_tpl_vars['commentItemAjax']['Comment_Report'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
)</a></div>
                        <a  class="icon-like" href="dong-y-voi-binh-luan-p-<?php echo $this->_tpl_vars['commentItemAjax']['Comment_ID']; ?>
.html?size=300x100" onclick="return buydeal(this);"><span>Đồng ý với bình luận này! (<?php echo ((is_array($_tmp=@$this->_tpl_vars['commentItemAjax']['Comment_Like'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
)</span></a>
                    </div>
                    <div class="clr"></div>
                    <div class="commentUserContent"><?php echo $this->_tpl_vars['commentItemAjax']['Comment_Content']; ?>
</div>
                </div>
                <?php if ($this->_tpl_vars['commentItemAjax']['reply']): ?>
                <?php $_from = $this->_tpl_vars['commentItemAjax']['reply']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oReply']):
?>
           <!--Hien thi BINH LUAN REPLY-->   
                 <div class="replyTop"></div>
                 <div class="commentUserReply">
                    <img src="upload/no-avatar.jpg" />
                    <div class="commentUserInfo">
                    	<div class="userName"><span>ChungMua3HV</span> - Gửi  cách đây <?php echo ((is_array($_tmp=$this->_tpl_vars['oReply']['Comment_Mktime'])) ? $this->_run_mod_handler('agoTime', true, $_tmp) : agoTime($_tmp)); ?>
 trước</div>
                    </div>
                    
                    <div class="clr"></div>
                    <div class="commentUserContent"><?php echo $this->_tpl_vars['oReply']['Comment_Content']; ?>
</div>
                </div><?php endforeach; endif; unset($_from); ?><?php endif; ?>
                </div><?php endforeach; endif; unset($_from); ?><?php endif; ?>