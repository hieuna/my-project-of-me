                {if $comment_item_ajax}{foreach from=$comment_item_ajax item=commentItemAjax}
                <div class="commentAjaxLoad" id="{$commentItemAjax.Comment_ID}">
                <div class="commentUser">
                    <img src="upload/no-avatar.jpg" />
                    <div class="commentUserInfo">
                    	<div class="userName"><span>{$commentItemAjax.Member_Name}</span> - Gửi  cách đây {$commentItemAjax.Comment_Mktime|agoTime} trước</div>
                        <p>Đăng ký ngày: {$commentItemAjax.Member_time_limit|echo_date:'d/m/Y'}</p>
                    </div>
                    <div class="commentUserInfo_2">
                    	<div class="userBought"><a class="icon-alert"  onclick="return buydeal(this);" href="bao-cao-vi-pham-p-{$commentItemAjax.Comment_ID}.html?size=500x150">Báo cáo vi phạm ({$commentItemAjax.Comment_Report|default:0})</a></div>
                        <a  class="icon-like" href="dong-y-voi-binh-luan-p-{$commentItemAjax.Comment_ID}.html?size=300x100" onclick="return buydeal(this);"><span>Đồng ý với bình luận này! ({$commentItemAjax.Comment_Like|default:0})</span></a>
                    </div>
                    <div class="clr"></div>
                    <div class="commentUserContent">{$commentItemAjax.Comment_Content}</div>
                </div>
                {if $commentItemAjax.reply}
                {foreach from=$commentItemAjax.reply item=oReply}
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
                </div>{/foreach}{/if}
