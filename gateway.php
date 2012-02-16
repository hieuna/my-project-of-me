<?php 
error_reporting(0);
ob_start();
session_start();
include 'inc/function.php'; 
//var_dump($_SESSION);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link rel="stylesheet" href="css/gateway.css" type="text/css" />
        <link rel="stylesheet" href="css/css3.css" type="text/css" />
        <script src="js/jquery-1.7.min.js" type="text/javascript"></script>
        <script src="js/jquery.fullbg.min.js" type="text/javascript"></script>
        <!-- Search Auto Complete -->
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/jquery-ui.css" type="text/css" />
		<script src="js/jquery.cycle.all.min.js" type="text/javascript"></script>
        <title>XTech-Gateway</title>
    </head>
    <body>
    	<?php loadImage('MOBILE 0');?>
    	<div id="header">
    		<div id="top_header">
    			<div class="main_top_header">
    				<div class="logo">
    					<a href="gateway.php"><img src="images/logo.png" width="87" height="34" /></a>
    				</div>
    				<?php include("inc/menutop.php");?>
    			</div>
    		</div>
    		<div id="bottom_header">
    			<div id="main_bottom_header" class="clearfix">
    				<div class="home">
    					<a href="gateway.php"><img src="images/home.jpg" width="38" height="39" /></a>
    				</div>
    				<div class="search">
    					<div class="keyword">Từ khóa HOT :  
    						<a href="index.php?route=product/search&keyword=Iphone">iPhone</a>, 
    						<a href="index.php?route=product/searchnangcao&txt-search=iPad">iPad</a>, 
    						<a href="index.php?route=product/searchnangcao&txt-search=Kindle fire">Kindle fire</a>, 
    						<a href="index.php?route=product/searchnangcao&txt-search=HTC">HTC</a>, 
    						<a href="index.php?route=product/searchnangcao&txt-search=Nokia">Nokia</a>, 
    						<a href="index.php?route=product/searchnangcao&txt-search=Samsung">Samsung</a>,
    						<a href="index.php?route=product/searchnangcao&txt-search=Sony Ericsson">Sony Ericsson</a>
    					</div>
    					<div class="formSearch">
    						<form autocomplete="off" name="frmSearch" method="post" action="newsearch.php" border="0">
				                <input id="autocomplete" type="text" class="text" style="float:left;" name="txtKeyword" value="Nhập tên sản phẩm cần tìm" onfocus="if (this.value=='Nhập tên sản phẩm cần tìm') this.value='';" onblur="if (this.value.trim()=='') this.value='Nhập tên sản phẩm cần tìm';" />
			                	<a href="javascript:if (document.frmSearch.txtKeyword.value!='Nhập tên sản phẩm cần tìm') document.frmSearch.submit();" style="border: none; margin: 0px; padding: 0px;">
			                    <img src="images/search.jpg" border="0" style="border: none; margin: 0px; padding: 0px; margin-top:10px; float:left;" alt="search" align="absmiddle" />
				                </a>
				            </form>
    					</div>
    				</div>
    				<div class="my-account">
    					<div><a href="javascript:alert('Hệ thống quản lý tài khoản khách hàng đang hoàn thiện !');">Tài khoản của tôi</a></div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div id="main-gateway" class="clearfix">
    		<div class="row1">
    			<div class="cols1 margin-right">
    				<div class="box_cate1"><?php loadImage('MOBILE 1');?></div>
    			</div>
    			<div class="cols2">
    				<div class="box_cate2 margin-right margin-bottom"><?php loadImage('MOBILE 2');?></div>
    				<div class="box_cate2 margin-bottom"><?php loadImage('MOBILE 3');?></div>
    				<div class="box_cate2 margin-right"><?php loadImage('MOBILE 4');?></div>
    				<div class="box_cate2"><?php loadImage('MOBILE 5');?></div>
    			</div>
    		</div>
    		<div class="row1">
    			<div class="cols2 margin-right">
    				<div class="box_cate2 margin-right margin-bottom"><?php loadImage('MOBILE 6');?></div>
    				<div class="box_cate2 margin-bottom"><?php loadImage('MOBILE 7');?></div>
    				<div class="box_cate2 margin-right"><?php loadImage('MOBILE 8');?></div>
    				<div class="box_cate2"><?php loadImage('MOBILE 9');?></div>
    			</div>
    			<div class="cols1">
    				<div class="box_cate1"><?php loadImage('MOBILE 10');?></div>
    			</div>
    		</div>
    		<div class="row1">
    			<div class="cols1 margin-right">
    				<div class="box_cate1"><?php loadImage('MOBILE 11');?></div>
    			</div>
    			<div class="cols2">
    				<div class="box_cate2 margin-right margin-bottom"><?php loadImage('MOBILE 12');?></div>
    				<div class="box_cate2 margin-bottom"><?php loadImage('MOBILE 13');?></div>
    				<div class="box_cate2 margin-right"><?php loadImage('MOBILE 14');?></div>
    				<div class="box_cate2"><?php loadImage('MOBILE 15');?></div>
    			</div>
    		</div>
    		<div class="row1">
    			<div class="cols2 margin-right">
    				<div class="box_cate2 margin-right margin-bottom"><?php loadImage('MOBILE 16');?></div>
    				<div class="box_cate2 margin-bottom"><?php loadImage('MOBILE 17');?></div>
    				<div class="box_cate2 margin-right"><?php loadImage('MOBILE 18');?></div>
    				<div class="box_cate2"><?php loadImage('MOBILE 19');?></div>
    			</div>
    			<div class="cols1">
    				<div class="box_cate1"><?php loadImage('MOBILE 20');?></div>
    			</div>
    		</div>
    	</div>
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
    						<div id="r1" class="rate_widget">
    							<div class="star_1 ratings_stars" id="vote_1" title="1 sao"></div>
    							<div class="star_2 ratings_stars" id="vote_2" title="2 sao"></div>
    							<div class="star_3 ratings_stars" id="vote_3" title="3 sao"></div>
    							<div class="star_4 ratings_stars" id="vote_4" title="4 sao"></div>
    							<div class="star_5 ratings_stars" id="vote_5" title="5 sao"></div>
    						</div>
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
    				<li><a href="<?php echo HTTP_SERVER;?>">Trang chủ</a></li>
    				<li><a href="index.php?route=information/information&information_id=51">Giới thiệu</a></li>
    				<!--<li><a href="#">Tuyển dụng</a></li>-->
    				<!--<li><a href="javascript:void(0);">Sitemap</a></li>-->
    				<!--<li><a href="#">Điều khoản sử dụng</a></li>-->
    			</ul>
    			<div>2011 Công ty cổ phần MBM. Bảo lưu mọi quyền.</div>
    		</div>
    	</div>
    	<?php include("inc/cart.php");?>
    </body>
    <script src="js/function.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        <?php
        $arr = autoCompleted();
        //var_dump($arr); 
        ?>
		$("input#autocomplete").autocomplete({
		    source: [<?php echo $arr;?>]
		});
	});
    </script>
    <script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-15368416-2']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
</html>    