<?php /* Smarty version 2.6.10, created on 2012-01-05 11:32:05
         compiled from footer.tpl */ ?>
<div id="footer" class="clearfix">
    		<div class="main_footer">
    			<div class="boxFooterLeft">
    				<div class="contentDiv clearfix">
    					<div style="margin-right:50px;">
    						<h3>Dịch vụ bán hàng</h3>
    						<ul>
    							<!--  <li><a href="#">Trang trí sản phẩm tạo cá tính riêng</a></li>-->
    							<!--  <li><a href="#">Tải nhạc - phim - ứng dụng trò chơi</a></li>-->
    							<li><a href="index.php?route=information/information&information_id=55">Bán hàng trả góp</a></li>
    							<!--  <li><a href="#">Giao hàng tại nhà</a></li>-->
    							<li><a href="index.php?route=information/information&information_id=54">Bảo hành sản phẩm</a></li>
    						</ul>
    					</div>
    					<div>
    						<h3>Hỗ trợ khách hàng</h3>
    						<ul>
    							<!--  <li><a href="#">Đăng ký & Sử dụng tài khoản</a></li>-->
    							<li><a href="index.php?route=information/information&information_id=53">Đặt hàng online</a></li>
    							<li><a href="index.php?route=information/information&information_id=68">Thanh toán online</a></li>
    							<!--  <li><a href="#">Cách mở hộp sản phẩm</a></li>-->
    							<!--  <li><a href="#">Sử dụng sản phẩm</a></li>-->
    						</ul>
    					</div>
    				</div>
    				<div class="contentDiv clearfix">
    					<div>
    						<h5>Đánh giá chất lượng</h5>
    						<ul class="voteul">
    							<li class="vote" id="vote_1"></li>
    							<li class="vote" id="vote_2"></li>
    							<li class="vote" id="vote_3"></li>
    							<li class="vote" id="vote_4"></li>
    							<li class="vote" id="vote_5"></li>
    						</ul>
    					</div>
    					<div>
    						<h5>Phàn nàn chất lượng</h5>
    						<h2>090-462-8286</h2>
    					</div>
    					<div style="margin-right:0;">
    						<h5>Kết nối với chúng tôi</h5>
    						<ul class="connect">
    							<li><a href="http://www.facebook.com/xtechonline?ref=tn_tnmn"><img src="images/facebook.jpg" /></a></li>
    							<li><a href="https://plus.google.com/u/0/113079457263731184385/posts#113079457263731184385/posts"><img src="images/google.jpg" /></a></li>
    							<li><a href="http://twitter.com/#!/xtechonline1"><img src="images/switter.jpg" /></a></li>
    							<!--  <li><a href="#"><img src="images/rss.jpg" /></a></li>-->
    						</ul>
    					</div>
    				</div>
    			</div>
    			<div class="boxFooterRight">
    				<div class="colsFooterRight" style="width: 60%;">
    					<div>
    						<img src="images/sale.jpg" border="0" />
    						Đừng bỏ lỡ cơ hội mua hàng khuyến mại từ chúng tôi. 
    					</div>
    					<div>
    						<form method="post" name="frmSubscribe" action="subscribe.php">
	    						<span id="msgSubscribe">Nhập địa chỉ e-mail của bạn để nhận thông tin</span><br />
	    						<input id="txtsubscribe" name="txtsubscribe" type="textbox" class="text" value="" />
	    						<input id="subscribe" type="submit"" class="submit" value="" />
    						</form>
    					</div>
    					<div>
    						<div class="stores"><a href="javascript:void(0);" id="site_map">Địa chỉ cửa hàng XTECH</a></div>
    					</div>
    				</div>
    				<div class="colsFooterRight" style="width: 38%; padding-left: 2%;">
    					<div class="support">Mua hàng online</div>
    					<div style="margin-bottom:0;"><h2>01277-73-73-73</h2></div>
    					<div class="support">Hỗ trợ kỹ thuật</div>
    					<div style="margin-bottom:0;"><h2>0129-753-6666</h2></div>
    					<div style="margin-bottom:0;">
    						<ul class="connect">
    							<li><a href="ymsgr:sendim?xtechonline"><img src="images/yahoo.png" /></a></li>
    							<li><a href="skype:xtech.online1?chat"><img src="images/skype.png" /></a></li>
    						</ul>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div id="footer2" class="clearfix">
    		<div class="main_footer">
    			<ul>
    				<li><a href="<?php echo '<?php'; ?>
 echo HTTP_SERVER;<?php echo '?>'; ?>
">Trang chủ</a></li>
    				<li><a href="index.php?route=information/information&information_id=51">Giới thiệu</a></li>
    				<!--<li><a href="#">Tuyển dụng</a></li>-->
    				<!--<li><a href="javascript:void(0);">Sitemap</a></li>-->
    				<!--<li><a href="#">Điều khoản sử dụng</a></li>-->
    			</ul>
    			<div>2011 Công ty cổ phần MBM. Bảo lưu mọi quyền.</div>
    		</div>
    	</div>
    	<?php echo '<?php'; ?>
 include("inc/cart.php");<?php echo '?>'; ?>

    </body>
</html>