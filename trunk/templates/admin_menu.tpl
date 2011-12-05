<style>{literal}
<!--
#navi a {padding-left:0;}
-->
{/literal}</style>
<div class="nav clearfix" style="margin-top:20px;">
	<div class="nav-right">
		<div class="nav-left">
			<ul id="navi">
				<li class="{if $page=="admin_home"}active{/if}"><a href="../">Trang chủ</a></li>
				{if ($admin->admin_info.admin_group==1)}
					<li class="{if $page=="admin_sites"}active{/if}"><a href="admin_sites.php">Merchants</a></li>
					<li class="{if $page=="admin_members"}active{/if}"><a href="admin_members.php">Users</a></li>
					<li class="{if $page=="admin_orders"}active{/if}"><a href="admin_orders.php">Giao dịch</a></li>
					<li class="{if $page=="admin_getmoney"}active{/if}"><a href="admin_getmoney.php">Rút tiền</a></li>
					<li class="{if $page=="admin_complaints"}active{/if}"><a href="admin_complaints.php">Khiếu nại</a></li>
					<li class="{if $page=="admin_errors"}active{/if}"><a href="admin_errors.php">Thông báo lỗi</a></li>
					<li class="{if $page=="admin_users"}active{/if}"><a href="admin_users.php">Quản trị viên</a></li>
				{elseif count($permission)}
					{foreach from=$permission key=k item=perms}
					{if $k=="admin_users" && count($perms)}
						<li class="{if $page=="admin_users"}active{/if}"><a href="admin_users.php">Quản trị viên</a></li>
					{elseif $k=="admin_orders" && count($perms)}
						<li class="{if $page=="admin_orders"}active{/if}"><a href="admin_orders.php">Giao dịch</a></li>
					{elseif $k=="admin_members" && count($perms)}
						<li class="{if $page=="admin_members"}active{/if}"><a href="admin_members.php">Users</a></li>
					{/if}
					{/foreach}
				{/if}
				{if ($admin->admin_info.admin_group==1)}
				<li class="{if $page=="admin_banks"}active{/if}"><a href="admin_banks.php">Ngân hàng</a></li>
				<li class="{if $page=="admin_emails"}active{/if}"><a href="admin_emails.php">Email system</a></li>
				<li><a href="admin_users.php?task=delcache">Xóa cache</a></li>
				{/if}
				<li class="{if $page=="admin_account"}active{/if}" style="background:none"><a href="admin_account.php">Thông tin cá nhân</a></li>
			</ul>
		</div>
	</div>
</div>