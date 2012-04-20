<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="site.css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

		<script type="text/javascript">
		$(document).ready(function(){
		//TEXT BOX LABEL
				$('.labelInput').each(function(){
					this.value = $(this).attr('title');
				
					$(this).focus(function(){
						if(this.value == $(this).attr('title')) {
							this.value = '';
						}
					});
				
					$(this).blur(function(){
						if(this.value == '') {
							this.value = $(this).attr('title');
						}
					});
				});
		});
        </script>
</head>
<body>
<div class="all">
    <!-- HEADER-->
    <div id="pageHeader">

    	<a href="#" class="logo"><img src="images/logo.png" alt="photo" /></a>
        <div class="cityMenu">
            <div class="cityName">
                <a href="#" class="city">Hà Nội</a>
                <ul class="dropDown">
                    <li><a href="#">TP Hồ Chí Minh</a></li>
                    <li><a href="#">Đà Nẵng</a></li>

                </ul>   
            </div> 
            <p>Chọn địa điểm khác</p>
        </div>
        
        <div class="listMenu">
            <div class="listName">
                <a href="#" class="list">Danh mục sản phẩm</a>
                <ul class="dropDown">
                    <li><a href="#">Danh mục 01</a></li>

                    <li><a href="#">Danh mục 02</a></li>
                </ul>   
            </div> 
        </div>
        
        <!-- SIGNIN -->
        <div class="homeSignIn">
            <form>
                <input type="text" class="homeSignInText labelInput" id="EMail" name="email" title="Email đăng nhập">
                <input type="text" class="homeSignInText labelInput" onfocus="this.type='password';if(this.value==this.defaultValue){this.value='';}return true;" onblur="if(this.value==''){this.type='text';this.value=this.defaultValue}" name="subject" title="Mật khẩu">

                <input type="button" class="homeSignInBtn" value="">
                <div class="clr"></div>
                      <div class="homeSignInExtra">
                        <input type="checkbox" name="customer_save_login" class="homeSignInCheck" id="customer_save_login" style="float:left">
                        <div class="homeSignInDesc">
                            <label class="signinNoteLabel" for="customer_save_login">Ghi nhớ</label> |<a href="#">Quên mật khẩu</a>|<a href="#">Đăng ký</a>

                        </div>
                    </div>
            </form>
        </div>
    </div>
    <!-- TOPNAV -->
    <div class="headerNav">
        <div class="topNav">
            <a href="#" class="regEmailBtn">

            	<span>Đăng ký nhận Email</span>
                <span class="ico"></span>
            </a>
            <a href="#" class="followOderBtn">
            	<span>Theo dõi đơn hàng</span>
                <span class="ico"></span>
            </a>
        </div>

        <div class="headerNavExtra">
            <a href="#" class="icoTalk">Hỗ trợ trực tuyến</a>
            <span class="icoPhone"><b>Hotline:</b> (04) 35626100 </span>
        </div>
    </div>
    <div class="clr"></div>
    <!-- CONTENT-->

    <div id="pageContent">
    	<div id="pageLeft">
        	<div class="pageDefault">
                <div class="pageTitle">ĐĂNG KÝ TÀI KHOẢN </div>
                <div class="signinBox">
                    <form>
                        <label class="formLabel_02" for="Name">Họ và tên<span class="formRequest">*</span></label>

                        <input type="text" class="formInput" id="Name" name="email"><br />
                       
                        <label class="formLabel_02" for="Pass">Mật khẩu<span class="formRequest">*</span></label>
                        <input type="password" id="Pass" class="formInput"  name="subject"><br />
                       
                        <label class="formLabel_02" for="rePass">Xác nhận mật khẩu<span class="formRequest">*</span></label>
                        <input type="password" id="rePass" class="formInput"  name="subject"><br />
                       
                        <label class="formLabel_02" for="Email">Email<span class="formRequest">*</span></label>

                        <input type="text" class="formInput" id="Email" name="email" title="Email đăng nhập"><br />
                       
                        <label class="formLabel_02" for="Phone">Điện thoại<span class="formRequest">*</span></label>
                        <input type="text" class="formInput" id="Phone" name="phone"><br />
                       
                        <label class="formLabel_02" for="Capthcha ">Mã số xác thực<span class="formRequest">*</span></label>
                        <input type="text" class="formInput" id="Capthcha" name="phone"><img width="60px" height="25px" style="margin:0 0 0 5px" src="" alt="photo" /><br />
                       
                        <label class="formLabel_02"></label>
                        <span class="forrmDesc">

    					 <input type="checkbox" name="customer_save_login" class="homeSignInCheck" id="acceptReg">&nbsp;Tôi đã xem và đồng ý với Quy định của <a href="#">chungmua3hv.vn</a>
                        </span><br />
                        <label class="formLabel_02"></label>
                        <input type="button" class="formBtn" value="Đăng ký tài khoản">
                    </ul>
                    </form>
                </div>
            </div>

        </div>
<!--RIGHT-->
        <div id="pageRight">
            <a href="#"><img src="images/Ads01.gif" alt="photo" /></a>
		</div>
        <div class="clr"></div>
    <!--ket thuc #pageContent-->
    </div>
    <div class="pageBottom">

        <div class="pageFooter">
        	<div class="logo02"><img src="images/logo02.png" alt="photo" /></div>
        	<div class="footerNav"><a href="#">Trang chủ</a>|<a href="#">Sản phẩm đã bán</a>|<a href="#">Qui định</a>|<a href="#">Hướng dẫn</a>|<a href="#">Giới thiệu</a>|<a href="#" class="last">Liên hệ</a></div>

            <div class="clr"></div>
            <div class="copyRight">
                © 2011 <b>SmartNet</b> Media Co.,Ltd. All rights reserved.<br />
                <span>Phòng 206, Tòa nhà Thành Đông, Số 132-138 Kim Mã, Ba Đình, Hà Nội<br />
                contact@smartnet.vn</span>
            </div>

            <div class="icoFooter">
            	<a href="#"><img src="images/icoFooter01.png" alt="photo" /></a>
            	<a href="#"><img src="images/icoFooter02.png" alt="photo" /></a>
            	<a href="#"><img src="images/icoFooter03.png" alt="photo" /></a>
            	<a href="#"><img src="images/icoFooter04.png" alt="photo" /></a>
            </div>
            <div class="clr"></div>
        </div>
    </div>

</div>
</body>
</html>
