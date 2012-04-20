<div id="lastPostsLoader"><img src="themes/default/images/loading.gif" border="0" align="loading" title="loading"/></div>
                <div class="commentBox">
                	<form method="post" name="frmComment"  onsubmit="return checkLoginComment(this)">
                    <input type="hidden" name="frmPID" value="{$smarty.get.ID}" />
                    {if $smarty.session.member.email}
                    <textarea class="textArea" name="frmComment" rows="4" id="comment-txt"></textarea>
                <div style="clear:both; margin-bottom:5px; color:red;">Bình luận không lịch sự sẽ bị xoá để giữ gìn văn hoá chung </div>
                    <input type="submit" value="Gửi bình luận" class="formBtn">
                    {else}
                    <div rel="{''|selfUrl|encode}" id="noLoginClick" class="textArea" style="height:50px;">Bạn cần đăng nhập để thực hiện chức năng này</div>
               {/if}
                    </form>
                </div>
                {if $comment_item}{foreach from=$comment_item item=commentItem}
                <div class="commentAjaxLoad" id="{$commentItem.Comment_ID}">
                <div class="commentUser">
                    <img src="upload/no-avatar.jpg" />
                    <div class="commentUserInfo">
                    	<div class="userName"><span>{$commentItem.Member_Name}</span> - Gửi  cách đây {$commentItem.Comment_Mktime|agoTime} trước</div>
                        <p>Đăng ký ngày: {$commentItem.Member_time_limit|echo_date:'d/m/Y'}</p>
                    </div>
                    <div class="commentUserInfo_2">
                    	<div class="userBought"><a class="icon-alert"  onclick="return buydeal(this);" href="bao-cao-vi-pham-p-{$commentItem.Comment_ID}.html?size=500x150">Báo cáo vi phạm ({$commentItem.Comment_Report|default:0})</a></div>
                        <a  class="icon-like" href="dong-y-voi-binh-luan-p-{$commentItem.Comment_ID}.html?size=300x100" onclick="return buydeal(this);"><span>Đồng ý với bình luận này! ({$commentItem.Comment_Like|default:0})</span></a>
                    </div>
                    <div class="clr"></div>
                    <div class="commentUserContent">{$commentItem.Comment_Content}</div>
                </div>
                {if $commentItem.reply}
                {foreach from=$commentItem.reply item=oReply}
           <!--Hien thi BINH LUAN REPLY-->   
                 <div class="replyTop"></div>
                 <div class="commentUserReply">
                    <img src="upload/no-avatar.jpg" />
                    <div class="commentUserInfo">
                    	<div class="userName"><span>ChungMua3HV</span> - Gửi  cách đây {$oReply.Comment_Mktime|agoTime} trước</div>
                    </div>
                    
                    <div class="clr"></div>
                    <div class="commentUserContent">{$oReply.Comment_Content}</div>
                </div>{/foreach}{/if}
               </div> {/foreach}{/if}
{literal}
 <script>
 $(document).ready(function(){
		
		function lastPostFunc() 
		{ 
//			alert('dasds');
			$("#lastPostsLoader").fadeIn(1);
			$.post("load-comment-ajax.html?PID={/literal}{$smarty.get.ID}{literal}&ID="+$(".commentAjaxLoad:last").attr("id"),
	
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
       {/literal}
