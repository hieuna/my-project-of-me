<?php /* Smarty version 2.6.19, created on 2012-04-22 20:13:56
         compiled from comment_detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'selfUrl', 'comment_detail.tpl', 10, false),array('modifier', 'encode', 'comment_detail.tpl', 10, false),array('modifier', 'agoTime', 'comment_detail.tpl', 19, false),array('modifier', 'echo_date', 'comment_detail.tpl', 20, false),array('modifier', 'default', 'comment_detail.tpl', 23, false),)), $this); ?>
<div id="lastPostsLoader"><img src="themes/default/images/loading.gif" border="0" align="loading" title="loading"/></div>
                <div class="commentBox">
                	<form method="post" name="frmComment"  onsubmit="return checkLoginComment(this)">
                    <input type="hidden" name="frmPID" value="<?php echo $_GET['ID']; ?>
" />
                    <?php if ($_SESSION['member']['email']): ?>
                    <textarea class="textArea" name="frmComment" rows="4" id="comment-txt"></textarea>
                <div style="clear:both; margin-bottom:5px; color:red;">Bình luận không lịch sự sẽ bị xoá để giữ gìn văn hoá chung </div>
                    <input type="submit" value="Gửi bình luận" class="formBtn">
                    <?php else: ?>
                    <div rel="<?php echo ((is_array($_tmp=((is_array($_tmp='')) ? $this->_run_mod_handler('selfUrl', true, $_tmp) : smarty_modifier_selfUrl($_tmp)))) ? $this->_run_mod_handler('encode', true, $_tmp) : smarty_modifier_encode($_tmp)); ?>
" id="noLoginClick" class="textArea" style="height:50px;">Bạn cần đăng nhập để thực hiện chức năng này</div>
               <?php endif; ?>
                    </form>
                </div>
                <?php if ($this->_tpl_vars['comment_item']): ?><?php $_from = $this->_tpl_vars['comment_item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['commentItem']):
?>
                <div class="commentAjaxLoad" id="<?php echo $this->_tpl_vars['commentItem']['Comment_ID']; ?>
">
                <div class="commentUser">
                    <img src="upload/no-avatar.jpg" />
                    <div class="commentUserInfo">
                    	<div class="userName"><span><?php echo $this->_tpl_vars['commentItem']['Member_Name']; ?>
</span> - Gửi  cách đây <?php echo ((is_array($_tmp=$this->_tpl_vars['commentItem']['Comment_Mktime'])) ? $this->_run_mod_handler('agoTime', true, $_tmp) : smarty_modifier_agoTime($_tmp)); ?>
 trước</div>
                        <p>Đăng ký ngày: <?php echo ((is_array($_tmp=$this->_tpl_vars['commentItem']['Member_time_limit'])) ? $this->_run_mod_handler('echo_date', true, $_tmp, 'd/m/Y') : smarty_modifier_echo_date($_tmp, 'd/m/Y')); ?>
</p>
                    </div>
                    <div class="commentUserInfo_2">
                    	<div class="userBought"><a class="icon-alert"  onclick="return buydeal(this);" href="bao-cao-vi-pham-p-<?php echo $this->_tpl_vars['commentItem']['Comment_ID']; ?>
.html?size=500x150">Báo cáo vi phạm (<?php echo ((is_array($_tmp=@$this->_tpl_vars['commentItem']['Comment_Report'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
)</a></div>
                        <a  class="icon-like" href="dong-y-voi-binh-luan-p-<?php echo $this->_tpl_vars['commentItem']['Comment_ID']; ?>
.html?size=300x100" onclick="return buydeal(this);"><span>Đồng ý với bình luận này! (<?php echo ((is_array($_tmp=@$this->_tpl_vars['commentItem']['Comment_Like'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
)</span></a>
                    </div>
                    <div class="clr"></div>
                    <div class="commentUserContent"><?php echo $this->_tpl_vars['commentItem']['Comment_Content']; ?>
</div>
                </div>
                <?php if ($this->_tpl_vars['commentItem']['reply']): ?>
                <?php $_from = $this->_tpl_vars['commentItem']['reply']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oReply']):
?>
           <!--Hien thi BINH LUAN REPLY-->   
                 <div class="replyTop"></div>
                 <div class="commentUserReply">
                    <img src="upload/no-avatar.jpg" />
                    <div class="commentUserInfo">
                    	<div class="userName"><span>ChungMua3HV</span> - Gửi  cách đây <?php echo ((is_array($_tmp=$this->_tpl_vars['oReply']['Comment_Mktime'])) ? $this->_run_mod_handler('agoTime', true, $_tmp) : smarty_modifier_agoTime($_tmp)); ?>
 trước</div>
                    </div>
                    
                    <div class="clr"></div>
                    <div class="commentUserContent"><?php echo $this->_tpl_vars['oReply']['Comment_Content']; ?>
</div>
                </div><?php endforeach; endif; unset($_from); ?><?php endif; ?>
               </div> <?php endforeach; endif; unset($_from); ?><?php endif; ?>
<?php echo '
 <script>
 $(document).ready(function(){
		
		function lastPostFunc() 
		{ 
//			alert(\'dasds\');
			$("#lastPostsLoader").fadeIn(1);
			$.post("load-comment-ajax.html?PID='; ?>
<?php echo $_GET['ID']; ?>
<?php echo '&ID="+$(".commentAjaxLoad:last").attr("id"),
	
			function(data){
				if (data) {
					$(".commentAjaxLoad:last").after(data);	
				}
				$("#lastPostsLoader").fadeOut(1);
			});
		};  
		
		$(window).scroll(function(){
			if  ($(window).scrollTop() == $(document).height() - $(window).height()){
			   lastPostFunc();
			}
		}); 
	

})
 </script>      
       '; ?>
