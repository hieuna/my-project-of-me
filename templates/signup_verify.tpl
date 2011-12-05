{include file='header.tpl'}
<link type='text/css' href='templates/css/signup.css' media="screen" rel='stylesheet'></script>
<div id="signup-page" class="clearfix">
	<div>
		{include file='signup-guide-step.tpl'}
		<div id="payment-info">
			
		        {* DISPLAY ERROR *}
		        {if $is_error}
		          <div class='error' style="padding:5px"><font color='red'>{$is_error}</font></div>
		        {elseif $result}
		        	<div class='error' style="padding:5px">{$result}</div>
		        {/if}
		        {if !$verify && ($task=='step2')}
		        <h3 class="tit4">Kích hoạt tài khoản</h3>
				<div class="payment-box">
		        	{if $task=='step2'}
		        	<p>Cám ơn bạn đăng ký mở tài khoản, chúng tôi vừa gửi một Email chứa đường Link kích hoạt tài khoản tới địa chỉ {$signup_email} mà bạn vừa đăng ký, vui lòng kiểm tra và Click vào đường Link đó để tiếp tục...</p>
		        	{else}
		        	<p>Chúng tôi vừa gửi lại một Email chứa đường Link kích hoạt tài khoản tới địa chỉ {$signup_email} mà bạn đã đăng ký, vui lòng kiểm tra và Click vào đường Link đó để tiếp tục...</p>
		        	{/if}
		        	<p>Trường hợp không nhận được Email, hãy thử lần lượt các biện pháp sau:</p>
					<ul class="list1">
						<li>Kiểm tra trong hộp Spam hoặc Bulk Mail xem có Email nào từ noreply@sohapay.com không?
						<li><a href='signup_verify.php?task=resend_do&resend_email={$signup_email}'>Bấm vào đây</a> để chúng tôi gửi lại Email kích hoạt (tối đa 3 lần).
						<li>Liên hệ trung tâm hỗ trợ khách hàng của chúng tôi để được trợ giúp!
					</ul>
		        {* DISPLAY RESEND *}
		        {elseif $resend == 1}
		        <h3 class="tit4">Gửi lại Email kích hoạt</h3>
				<div class="payment-box">
		          {if $result != 0}
		            <div class='success'>{$result}</div>
		          {else}
		            <div>Để nhận lại email kích hoạt, bạn hãy nhập địa chỉ Email mà bạn đã dùng để đăng ký tài khoản.</div>
		            <br>
		            <form action='signup_verify.php' method='POST'>
		            Nhập địa chỉ Email<br><input type='text' class='input-text' name='resend_email' size='40' maxlength='70'>
		            <br><br>
		            <input type='submit' class='button' value='Gửi lại xác thực'>
		            <input type='hidden' name='task' value='resend_do'>
		            </form>
		        {/if}
		        
		        {* DISPLAY SUCCESSFUL VERIFICATION *}
		        {else}
		        <h3 class="tit4">Hoàn thành</h3>
				<div class="payment-box">
		          Bạn đã hoàn thành việc đăng ký tài khoản trên SohaPay. <a href="login.php">Bấm vào đây để đăng nhập</a>
		        {/if}
		    </div>
		</div>
	</div>
</div>
{include file='footer.tpl'}