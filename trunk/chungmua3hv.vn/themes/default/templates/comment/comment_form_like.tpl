<div id="resultReport"><div class="frmAdđEmail">
{if $msg}{$msg}
<center><p>
<input type="button" onclick="return closeForm();" class="formBtn" style="clear:both; margin-top:10px; "value="Okie" />
</p></center>

{else}
<form method="post" id="emailForm" name="emailForm" onsubmit="return checkFormLike(this)">
<input type="hidden" name="ID" value="{$comment.Comment_ID}" />
<h2>Bạn đồng ý với bình luận này!</h2>
<div style="font-weight:normal; color:red; margin-bottom:5px;">{if $msg}{$msg}{/if}</div>
<center><p>

<input type="button" onclick="return closeForm();" class="formBtn" style="clear:both; margin-top:10px; "value="Thoát" />
<input type="submit" class="formBtn" style="clear:both; margin-top:10px;margin-left:5px; "value="Đúng" /></p></center>
</form>
{/if}
</div></div>
