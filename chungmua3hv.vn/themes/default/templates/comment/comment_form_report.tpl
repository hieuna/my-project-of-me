<div id="resultReport"><div class="frmAdđEmail">
{if $msg}{$msg}
<center><p>

<input type="button" onclick="return closeForm();" class="formBtn" style="clear:both; margin-top:10px; "value="Okie" />
</p></center>

{else}
<form method="post" id="emailForm" name="emailForm" onsubmit="return checkFormReport(this)">
<input type="hidden" name="ID" value="{$comment.Comment_ID}" />
<h2>Bạn thấy bình luận này vi phạm một trong các điều dưới đây?</h2>
<div style="font-weight:normal; color:red; margin-bottom:5px;">{if $msg}{$msg}{/if}</div>
<label style="font-weight:normal;"> - Nội dung mang tính chất phản động, đả kích.</label><br />
<label style="font-weight:normal;"> - Nội dung không lành mạnh, vô văn hóa...</label><br />
<label style="font-weight:normal;"> - Nội dung không chính xác, mang tính chất quảng cáo, rao vặt...</label><br />
<center><p>

<input type="button" onclick="return closeForm();" class="formBtn" style="clear:both; margin-top:10px; "value="Thoát" />
<input type="submit" class="formBtn" style="clear:both; margin-top:10px;margin-left:5px; "value="Đúng" /></p></center>
</form>
{/if}
</div></div>
