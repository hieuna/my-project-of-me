{*
<div class="box2 mb2 radius">
	<h3 class="tit4">Quản lý tài khoản</h3>
	<div class="payment-box">
		<ul class="list1">
			<li><a {if $global_page=='user_info'}class="active"{/if} href="user_info.php">Thông tin tài khoản</a></li>
			<li><a href="user_order.php" {if $global_page=='user_orders'}class="active"{/if} href="javascript:void(0);">Quản trị giao dịch</a></li>
			<li><a href="javascript:void(0);" onclick="shp.chargeGold.step_1();">Nạp tiền</a></li>
            {if $user->user_info.user_type==2}
            <li><a href="user_product_button.php" {if $global_page=='user_product_button'}class="active"{/if}>Tạo nút thanh toán sản phẩm</a></li>
            <li><a href="user_embed_button.php" {if $global_page=='user_embed_button'}class="active"{/if}>Tạo nút thanh toán thỏa thuận</a></li>
            <li><a href="user_payment_list.php" {if $global_page=='user_payment_list'}class="active"{/if}>Danh sách giao dịch</a></li>
            <li><a href="user_bank_list.php" {if $global_page=='user_bank_list'}class="active"{/if}>Tài khoản ngân hàng</a></li>
            {/if}
			<li><a href='user_logout.php?token={$token}'><font color="red">Thoát</font></a></li>
		</ul>
	</div>
</div>
*}