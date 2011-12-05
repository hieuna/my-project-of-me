{include file='header.tpl'}
<link type='text/css' href='templates/css/users.css' media="screen" rel='stylesheet'></script>
<div id="signup-page" class="clearfix">
	<div class="fl wid6">
		<div id="payment-info" class="box2 mb2 radius" style="margin-top: 0;">
			<h3 class="tit4">{$page_title_into}</h3>
			<div class="payment-box">
			{if $task == 'unsub'}
				{$ct_message}
				{if $total == 1}
				<div align="right" style="padding:10px; margin-right:300px;">
					<form action="subscribe.php?task=dounsub" method="post">
						<input type="submit" name="submit" style="width:100px;" class="button" value="Ngừng nhận email">
						<input type="hidden" name="email" value="{$email}" />
						<input type="hidden" name="id" value="{$id}" />
						<input type="hidden" name="sub" value="1" />
					</form>
				</div>
				{/if}
			{elseif $task == 'sub'}	
				<div style="color:#444;">
					<form action="subscribe.php?task=sub" method="post">
						{if $is_error_email}
				        <center><span style="color:#FF0000">{$is_error_email}</span></center><br />
				        {/if}
				        <p>Bạn sẽ nhận được thông báo các chương trình khuyến mãi và tích hợp thanh toán qua Email này.</p>
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td valign="top" align="left" width="300">
									<input id="input_email" type="text" name="email" size="50" class="input-text box" maxlength="50" value="Nhập địa chỉ email của bạn..." onblur="if(this.value=='') this.value='Nhập địa chỉ email của bạn...';" onfocus="if(this.value=='Nhập địa chỉ email của bạn...') this.value='';" />
								</td>
								<td valign="top" align="left">
									<input type="submit" name="submit" style="width: 90px;" class="button" value="Gửi đăng ký">
								</td>
							</tr>
						</table>
						<input type="hidden" name="sub" value="1" />
					</form>
				</div>
			{else}
				{$ct_message}	
			{/if}
			</div>
		</div>
	</div>
	<div class="fr wid3">
		{include file='col_right.tpl'}
	</div>
</div>
{include file='footer.tpl'}