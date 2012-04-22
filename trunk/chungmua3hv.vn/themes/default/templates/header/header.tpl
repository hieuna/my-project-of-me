<div id="pageHeader">

    	<a href="{$smarty.const.SITE_URL}" class="logo"><img src="themes/default/images/logo.png" alt="photo" /></a>
        <div class="cityMenu">
            <div class="cityName">
                <a href="{$city.Group_Mark}/" class="city">{$city.Group_Name|default:'Toàn Quốc'}</a>
                <ul class="dropDown">
               {foreach from=$destination item=item}
                    <li><a href="{$item.Group_Mark}/">{$item.Group_Name}</a></li>
				{/foreach}
                </ul>   
            </div> 
            <p>Chọn địa điểm khác</p>
        </div>
        
        <div class="listMenu">
            <div class="listName">
            {if $cate}
                <a href="{$cate.Group_Mark}.html" class="list">{$cate.Group_Name|default:'Danh mục sản phẩm'}</a>{else}
                <a class="list">Danh mục sản phẩm</a>
             {/if}
                <ul class="cate_dropDown">
                {section loop=$category name=foo}
                    <li><a href="{$category[foo].Group_Mark}.html">{$category[foo].Group_Name}</a></li>
				{/section}
                </ul>   
            </div> 
        </div>
        
        <!-- SIGNIN -->
        <div class="homeSignIn">
        {if $smarty.session._user.ID}
        		<img src="{if $smarty.session.member.avatar} upload/avatar/{$smarty.session.member.avatar} {else}themes/default/images/ava.png{/if}" alt="photo" width="35" height="35" />
                <div style="float:left; margin:8px 0 0 10px">
                <div class="username">Chào mừng<b> {$smarty.session._user.Name} !</b>&nbsp;&nbsp;|</div><a class="bntLogout" href="javascript:void(0)" onclick="return memberLogOut('{""|selfUrl|encode}')">Thoát [ x ]</a> 
                <div style="clear:both;"></div>
                <div class="listAccount">
                    <div class="listAccountz">
                        <a href="{$cate.Group_Mark}.html" class="list">Quản lý tài khoản</a>
                        <ul class="account_dropDown">
                            <li><a href="doi-mat-khau.html">Đổi mật khẩu</a></li>
                            <li><a title="Kiểm tra đơn hàng" href="theo-doi-don-hang.html">Kiểm tra đơn hàng</a></li>
                            <li><a href="sua-thong-tin-ca-nhan.html">Sửa thông tin cá nhân</a></li>
                        </ul>   
                    </div> 
                </div>
                </div>
        {else}
            <form action="dang-nhap.html" method="post">
            <input type="hidden" name="url" value="{''|selfUrl|encode}" />
            <input type="hidden" name="logintype" value="1" />
                <input type="text" class="homeSignInText labelInput" id="EMail" name="email" title="{if $smarty.cookies.logemail}{$smarty.cookies.logemail}{else}Email đăng nhập{/if}" value="{$smarty.cookies.logemail}">
                <input type="password" name="password" class="homeSignInText" value="Mật khẩu" onclick="this.value=''">

                <input type="submit" class="homeSignInBtn" value="">
                <div class="clr"></div>
                      <div class="homeSignInExtra">
                        <input type="checkbox" name="customer_save_login" class="homeSignInCheck" id="customer_save_login" style="float:left">
                        <div class="homeSignInDesc">
                            <label class="signinNoteLabel" for="customer_save_login">Ghi nhớ</label> |<a title="Click vào đây nếu bạn quên mật khẩu." href="quen-mat-khau.html">Quên mật khẩu</a>|<a href="dang-ky-thanh-vien.html" title="Đăng ký thành viên">Đăng ký</a>

                        </div>
                    </div>
            </form>
            {/if}
        </div>
    </div>
    <!-- TOPNAV -->
    <div class="headerNav">
        <div class="topNav">
            <a title="Đăng ký nhận email khuyến mại từ website" onclick="return buydeal(this);" href="dang-ky-nhan-khuyen-mai.html?size=300x130" rel="nofollow" id="popupHtmlDealsBuy" class="regEmailBtn"><span>Đăng ký nhận Email</span><span class="ico"><img src="themes/default/images/icoEmail.png" alt="photo"/></span></a>

            <a href="theo-doi-don-hang.html" title="Theo dõi đơn hàng của bạn" class="followOderBtn"><span>Theo dõi đơn hàng</span><span class="ico"><img src="themes/default/images/icoFollowOder.png" alt="Theo dõi đơn hàng"/></span></a>
        </div>
        <div class="headerNavExtra">
            <a href="ymsgr:sendIM?{#company_support#}" class="icoTalk">Hỗ trợ trực tuyến</a>
            <span class="icoPhone"><b>Hotline:</b> {#company_hotline#} </span>
        </div>

    </div>
    
    <div class="clr" style="margin-top:35px; margin-bottom:10px;">
    <div class="topMenu" style="margin-top:2px">
   		<div class="right">
   		<ul>
             {section loop=$category max=7 name=foo}
                <li><a href="{$category[foo].Group_Mark}.html" {if $smarty.get.DID==$category[foo].Group_Mark} class="selected"{/if}>{$category[foo].Group_Name}</a></li>
            {/section}
        </ul>
        </div>
   </div>	 
    
    </div>
    
    