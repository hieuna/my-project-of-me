{* INCLUDE HEADER CODE *}
{include file="header_global.tpl"}
<!-- HEADER -->
<div id="header">
	{if $sessionCookie}
	<div id="payment-continue-cancel">
		<div class="payment-cc">
			<a id="naviCancel" href="./index.php?task=cancel_pay" class="pybutton"><span>Hủy thanh toán</span></a>
			<a id="naviContinue" href="./payment_method.php?session={$sessionCookie}" class="pybutton"><span>Thanh toán tiếp</span></a>
		</div>
	</div>
	{/if}
	<div id="bgmini"></div>
	<div class="header-{$page_style} clearfix">
	<!-- Trang user class: header-user, cac trang khac class: header-home -->
		<div class="mnTopHead">
			<ul>
				<li><a {if $global_page=='index'} class="active"{/if} href="./">Trang chủ</a></li>
				<li><a href="./info/">Giới thiệu</a></li>
				<li><a href="./info/news.html">Tin tức</a></li>
				<li><a href="./info/help.html">Trợ giúp</a></li>
				<li><a href="./info/contact.html">Liên hệ</a></li>
				<li class="last"><a href="./info/khuyen-mai.html">Khuyến mãi</a></li>
			</ul>
		</div>
		<div class="mnPhoneSupport">
			<div class="sp_phone">04.36321221 - máy lẻ: 123 hoặc 851</div>
			<div class="sp_mail"><a href="mailto:hotro@muachungpay.vn">hotro@muachungpay.vn</a></div>
			<div class="sp_chat"><a href="skype:muachungpay?chat">Skype</a> | <a href="ymsgr:sendim?muachungpay">Yahoo</a></div>
			<div class="clearfix"></div>
		</div>
		
		<a id="logo" href="./"></a>
		<div id="user">
      		{if $user->user_exists}
			<div class="showUser" id="logout">
				<form name="frmLogout">
				<div class="user">Xin chào: <a href='user_info.php'>{if $user->user_info.user_fullname|count_characters:true >= 18} {$user->user_info.user_fullname|truncate:18} {else} {$user->user_info.user_fullname} {/if}</a> 
				<a href='user_logout.php?token={$token}&return_url={$uri->url_current()}'><font color="red">[thoát]</font></a></div>
				<div class="account">Tài khoản: <b class="user_gold_value">{$user->user_info.user_gold|number_format}₫</b> <a href="javascript:void(0);" onclick="shp.chargeGold.step_1();">[ Nạp tiền ]</a></div>
				</form>
			</div>
      		{elseif $setting.setting_signup_enable}
			<div class="showUser" id="login">
				<form action='login.php' method='POST' id='login' name='login'>
				<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td colspan="3">
							<a href="login.php?task=lostPassword">Quên mật khẩu?</a> | 
							<a href="signup.php">Đăng ký</a> | 
							<a href="signup_verify.php?task=resend">Kích hoạt</a>
						</td>
					</tr>
					<tr height="10"><td colspan="3"></td></tr>
					<tr>
						<td>
							<label for="email">Email đăng nhập</label>
							<input type="text" id="email" name="email" class="inputtextbox">
						</td>
						<td>
							<label for="password">Mật khẩu</label>
							<input type="password" class="inputtextbox" id="password" name="password">
						</td>
						<td>
							<input type="submit" value="Đăng nhập" class="inputbutton" onclick="shop.customer.loginHeader();"/>
						</td>
					</tr>
				</table>
				<input type='hidden' name='task' value='dologin' />
				<input type='hidden' name='return_url' value='{$uri->url_current()}' />
				<NOSCRIPT><input type='hidden' name='javascript' value='no' /></NOSCRIPT>
				</form>
			</div>
      		{/if}
		</div>
	</div>	
</div>
{if $global_page == 'index'}
<div id="bgslide">
	<div id="slide">
<!--		<img src="./images/slide.jpg" border="0" />-->
		<div class="slideshow margin_bottom">
			<div id="slideshow">
				<ul>
					<li id="li_1" rel="#5f5f5f">
						<a href="https://sohapay.com/info/san-pham-cong-nghe/42-dien-thoai-thoi-trang-qmobile-f363-2sim-2song.html">
						<img src="images/slideshow/slide3.jpg" alt="Qmobile F363" width="980px" height="310px" />
						</a>
					</li>
					<li id="li_2" rel="#ccbfa0">
						<a href="https://sohapay.com/info/nha-hang-an-uong/38-lau-wa-dac-biet-huong-vi-ngay-ngat-cho-ngay-troi-lanh.html">
						<img src="images/slideshow/slide2.jpg" alt="Lẩu Wa" width="980px" height="310px" />
						</a>
					</li>
					<li id="li_3" rel="#0f87c3">
						<a href="#">
						<img src="./images/slideshow/slide_1.png" alt="SohaPay" width="980px" height="310px" />
						</a>
					</li>
					<!--  
					<li id="li_4" rel="#ed9a3e">
						<a href="https://sohapay.com/info/nha-hang-an-uong/40-hcm-dai-tiec-buffet-kichi-kichi-net-van-hoa-moi-cua-nguoi-viet.html">
						<img src="images/slideshow/slide_kichi.jpg" alt="img 1" width="980px" height="310px" />
						</a>
					</li>
					-->
				</ul>
			</div>
			<!--  <div id="page_slide" class="page_slide"></div>-->
		</div>
	</div>
</div>
{/if}
{if $user->user_info.user_id && $page_style=='user'}
<!-- MENU TOP -->
<div id="menutop">
	<div id="menu">
		<div id="menu-top">
			<ul id="topnav">
		        <li id="menu1">
		        	<a href="user_transaction.php?task=dashboard">Quản lý giao dịch</a>
		        	<div class="sh" style="display: none;">
		                <a href="user_transaction.php" {if $global_page=='user_transaction'}class="active_submenu"{/if}>Lịch sử giao dịch</a> <span style="margin-left:10px">|</span>
		                <a href="javascript:void(0);" onclick="shp.chargeGold.step_1();">Nạp tiền</a> <span style="margin-left:10px">|</span>
		                {if $user->user_info.user_type==2}<a href="user_getmoney.php" {if $global_page=='user_getmoney'}class="active_submenu"{/if}>Rút tiền</a>{/if}
		                <div class="right"></div>
		            </div>
		        </li>
		        <li  id="menu2">
		            <a href="user_info.php">Thông tin tài khoản</a>
		            <div class="sh" style="display: none;">
		                <a href="user_info.php" {if $global_page=='user_info' && $task=='view'}class="active_submenu"{/if}>Quản lý tài khoản</a> <span style="margin-left:10px">|</span>
		                {if $user->user_info.user_type==2}<a href="user_bank_list.php" {if $global_page=='user_bank_list'}class="active_submenu"{/if}>Tài khoản ngân hàng</a> <span style="margin-left:10px">|</span>{/if}
		                <a href="user_info.php?task=changePass" {if $global_page=='user_info' && $task=='changePass'}class="active_submenu"{/if}>Đổi mật khẩu</a>
		                <div class="right"></div>
		            </div>
		        </li>
		        {if $user->user_info.user_type==2}
		        <li id="menu3">
		            <a href="user_product_button.php">Tích hợp thanh toán</a>
		            <div class="sh" style="display: none;">
		                <a href="user_product_button.php" {if $global_page=='user_product_button'}class="active_submenu"{/if}>Nút thanh toán sản phẩm</a> <span style="margin-left:10px">|</span>
		                <a href="user_embed_button.php" {if $global_page=='user_embed_button'}class="active_submenu"{/if}>Nút thanh toán thỏa thuận</a>
		                <div class="right"></div>
		            </div>
		        </li>
		        {/if}
		        <li id="menu4">
		            <a href="user_complaints.php">Khiếu nại</a>
		            <div class="sh" style="display: none;">
		                <a href="user_complaints.php" {if $global_page=='user_complaints' && !$type}class="active_submenu"{/if}>Tất cả khiếu nại</a> <span style="margin-left:10px">|</span>
		                {if $user->user_info.user_type==2}
		                <a href="user_complaints.php?type=1" {if $global_page=='user_complaints' && $type==1}class="active_submenu"{/if}>Khiếu nại của người mua</a> <span style="margin-left:10px">|</span>
		                {/if}
		                <a href="user_complaints.php?type=2" {if $global_page=='user_complaints' && $type==2}class="active_submenu"{/if}>Khiếu nại của tôi</a>
		                <div class="right"></div>
		            </div>
		        </li>
	        </ul>
		</div>
	</div>
</div>
<div id="menuUser" class="menuChild" style="display: none;">
	<div class="right"></div>
</div>
<div id="header_bar_user">
	<div class="bar_user clearfix">
    <div id="title_form" class="{$global_page}">{$page_title}</div>
    {if $pgThemeTitleRight!=''}<div class="title_info clearfix">{$pgThemeTitleRight}</div>{/if}
  </div>
</div>
{/if}
{if $page_style!='user' && $global_page!='index'}
	<div id="header_bar" class="clearfix">
		<div class="title_bar">{$page_title}</div>
	</div>
{/if}

<div id="main" class="clearfix" style="margin-bottom: 15px">
	<div class="container mt3">
        {$pgMessage}


{literal}
<script type="text/javascript">
	var page = {/literal}'{$global_page}';{literal}
	var bl = '';
	if (page == 'user_transaction' || page == 'user_getmoney') {
		bl = "menu1";
	}
	else if (page == 'user_info' || page == 'user_bank_list') {
		bl = "menu2";
	}
	else if (page == 'user_embed_button' || page == 'user_product_button') {
		bl = "menu3";
	}
	else {
		bl = "menu4";
	}
	$("#"+bl).find("div.sh").show();
	$("#"+bl).addClass('active_menu_user');
	$("div.menuChild").show();
	$(document).ready(function(){
		$("ul#topnav li").hover(function() {
			$(this).find("div.sh").show();
			$(this).addClass('active_menu_user');
			$("div.menuChild").show();
			if (bl != this.id) {
				$("#"+bl).find("div.sh").hide();
				$("#"+bl).removeClass('active_menu_user');
			}
		} , function() {
			$("div.menuChild").hide();
			$(this).find("div.sh").hide();
			//$(this).find("div.right").hide();
			$(this).removeClass('active_menu_user');
			
			$("#"+bl).find("div.sh").show();
			$("#"+bl).addClass('active_menu_user');
			$("div.menuChild").show();
		});
	});


	$(document).ready(function() {
	    $.fn.setCursorPosition = function(pos) {
	        if ($(this).get(0).setSelectionRange) {
	            $(this).get(0).setSelectionRange(pos, pos);
	        } else if ($(this).get(0).createTextRange) {
	        var range = $(this).get(0).createTextRange();
	        range.collapse(true);
	        range.moveEnd('character', pos);
	        range.moveStart('character', pos);
	        range.select();
	        }
	    }
	    $("#login label").each(function (i) {
	        $(this).next("input").attr("value",$(this).html()+"...");
	        $(this).hide();
	    });
	    $("#login input").focus(function() {
	        if($(this).prev("label").html()+"..." == this.value){
	           $(this).val("");
	            $(this).addClass("focus").setCursorPosition(0);
	        }else{
	           $(this).select();
	        }
	    });
	    $("#login input").keypress(function() {
	        if($(this).prev("label").html()+"..." == this.value){
	            this.value = "";
	            $(this).removeClass("focus").addClass("typing");
	        }
	    });
	    $("#login input").blur(function() {
	        $(this).removeClass("focus").removeClass("typing");
	        if(this.value == ""){
	        this.value = $(this).prev("label").html()+"...";
	        }
	    });
	});

	/* slideshow */
	$(function() {
		$('#slideshow ul').cycle({
	        fx:     'fade',
	        timeout: 5000,
	        pager:  '#page_slide',
	        pagerAnchorBuilder: function(idx, slide) { 
	            return '<a href="#"><span>' + idx + '</span></a>'; 
	        },
	        before: function (curr, next, opts){
	        	var bgColor = $(next).attr('rel');
	        	if (bgColor!=null) $('#bgslide').animate({backgroundColor: bgColor});
	        }
	    });
	});
</script>
{/literal}

