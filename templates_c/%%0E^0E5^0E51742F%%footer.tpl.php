<?php /* Smarty version 2.6.10, created on 2012-02-11 10:16:29
         compiled from D:/AppServ/www/mobimart/templates//footer.tpl */ ?>
<div id="footer" class="clearfix">
    		<div class="main_footer">
    			<div class="boxFooterLeft">
    				<div class="contentDiv clearfix">
    					<div style="margin-right:50px;">
    						<h3>Dịch vụ bán hàng</h3>
    						<ul>
    							<li><a href="#">Trang trí sản phẩm tạo cá tính riêng</a></li>
    							<li><a href="#">Tải nhạc - phim - ứng dụng trò chơi</a></li>
    							<li><a href="index.php?route=information/information&information_id=55">Bán hàng trả góp</a></li>
    							<li><a href="#">Giao hàng tại nhà</a></li>
    							<li><a href="index.php?route=information/information&information_id=54">Bảo hành sản phẩm</a></li>
    						</ul>
    					</div>
    					<div>
    						<h3>Hỗ trợ khách hàng</h3>
    						<ul>
    							<li><a href="#">Đăng ký & Sử dụng tài khoản</a></li>
    							<li><a href="index.php?route=information/information&information_id=53">Đặt hàng online</a></li>
    							<li><a href="index.php?route=information/information&information_id=68">Thanh toán online</a></li>
    							<li><a href="#">Cách mở hộp sản phẩm</a></li>
    							<li><a href="#">Sử dụng sản phẩm</a></li>
    						</ul>
    					</div>
    				</div>
    				<div class="contentDiv clearfix" style="margin-top:15px;">
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
    				<div class="colsFooterRight" style="width: 100%;">
    					<div>
    						<div style="float:left; width: auto;"><img src="images/sale.jpg" width="40" border="0" style="margin-right:15px;" /></div>
    						<div style="float:left; width: 270px; padding-top:10px;">Đừng bỏ lỡ cơ hội mua hàng khuyến mại từ chúng tôi.</div> 
    					</div>
    					<div style="padding-left:10px;">
    						<form method="post" name="frmSubscribe" action="subscribe.php">
	    						<span id="msgSubscribe">Nhập địa chỉ e-mail của bạn để nhận thông tin</span><br />
	    						<input id="txtsubscribe" name="txtsubscribe" type="textbox" class="text" value="" />
	    						<input id="subscribe" type="submit"" class="submit" value="" />
    						</form>
    					</div>
    				</div>
    				<div class="colsFooterRight" style="width: 98%; padding-left: 2%; margin-top: 10px; background: none; color: #fff;">
    					<div class="support">Mua hàng online</div>
    					<div class="support" style="margin-right:0;">Hỗ trợ kỹ thuật</div>
    					<div style="margin-bottom:0; float:left; width: 165px;"><h2>01277-73-73-73</h2></div>
    					<div style="margin-bottom:0; float:left; width: 165px;"><h2>0129-753-6666</h2></div>
    				</div>
    				<div class="colsFooterRight" style="width: 100%; background: none;">	
    					<div style="float: right; padding-top: 5px;">
    						<div class="stores"><a href="javascript:void(0);" id="site_map">Địa chỉ cửa hàng XTECH</a></div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div id="footer2" class="clearfix">
    		<div class="main_footer">
    			<ul>
    				<li><a href="<?php echo $this->_tpl_vars['http_root']; ?>
">Trang chủ</a></li>
    				<li><a href="index.php?route=information/information&information_id=51">Giới thiệu</a></li>
    				<!--<li><a href="#">Tuyển dụng</a></li>-->
    				<!--<li><a href="javascript:void(0);">Sitemap</a></li>-->
    				<!--<li><a href="#">Điều khoản sử dụng</a></li>-->
    			</ul>
    			<div>2011 Công ty cổ phần MBM. Bảo lưu mọi quyền.</div>
    		</div>
    	</div>
    	<!-- CART -->
    	<div id="cart">
			<div class="menu-cart-products">
				<div id="box_register" class="border-radius-cart">
					<div class="close"><img src="images/close.gif" /></div>
					<div class="bxRegister">
						<!-- show form -->
						<form action="login.php" method="post" name="frmLogin">
						<table cellpadding="0" cellspacing="0" width="100%" class="table_us" id="table_login">
							<tr>
								<td colspan="2" style="text-align:center;"><b style="color:red;" id="msg_blg">Vui lòng nhập đúng các thông tin đăng nhập !</b></td>
							</tr>
							<tr>
								<td>Tên đăng nhập:</td>
								<td><input type="text" name="username_lg" id="username_lg" class="txtTextBox" value="" /></td>
							</tr>
							<tr>
								<td>Mật khẩu:</td>
								<td><input type="password" name="password_lg" id="password_lg" class="txtTextBox" value="" /></td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="submit"" name="sbLogin" id="sbLogin" value="Đăng nhập" />
									<input type="reset""" name="sbReset" id="sbRset" value="Hủy bỏ" />
								</td>
							</tr>
						</table>
						</form>
						<table cellpadding="0" cellspacing="0" width="100%" class="table_us" id="table_register">
							<tr>
								<td colspan="2" style="text-align:center;"><b style="color:red;" id="msg_b">Vui lòng nhập đầy đủ các thông tin dưới đây !</b></td>
							</tr>
							<tr>
								<td width="30%">Họ và tên đệm:</td>
								<td><input type="text" name="firstname" id="firstname" class="txtTextBox" value="" /></td>
							</tr>
							<tr>
								<td>Tên của bạn:</td>
								<td><input type="text" name="lastname" id="lastname" class="txtTextBox" value="" /></td>
							</tr>
							<tr>
								<td>Địa chỉ email:</td>
								<td><input type="text" name="email" id="email" class="txtTextBox" value="" /></td>
							</tr>
							<tr>
								<td>Tên đăng nhập:</td>
								<td><input type="text" name="username" id="username" class="txtTextBox" value="" /></td>
							</tr>
							<tr>
								<td>Mật khẩu:</td>
								<td><input type="password" name="password" id="password" class="txtTextBox" value="" /></td>
							</tr>
							<tr>
								<td>Nhắc lại mật khẩu:</td>
								<td><input type="password" name="repassword" id="repassword" class="txtTextBox" value="" /></td>
							</tr>
							<tr>
								<td>Số điện thoại:</td>
								<td><input type="text" name="phone" id="phone" class="txtTextBox" value="" /></td>
							</tr>
							<tr>
								<td>Địa chỉ:</td>
								<td><input type="text" name="address" id="address" class="txtTextBox" value="" /></td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="button"" name="sbRegister" id="sbRegister" value="Đăng ký" />
									<input type="button"" name="sbReset" id="sbReset" value="Hủy bỏ" />
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div id="box-cart" class="border-radius-cart">
					<div class="close"><img src="images/close.gif" /></div>
					<div class="click-slide-prev">
						<a href="javascript:void(0);" id="btn_back">
							<img src="images/prev.jpg" />
						</a>
					</div>
					<div id="tab_content">
						<!-- show data -->
					</div>
					<div class="click-slide">
						<a href="javascript:void(0);" id="btn_next">
							<img src="images/next.jpg" />
						</a>
					</div>
				</div>
				<div id="map" class="border-radius-cart">
					<div class="title_map box-shadow-map">
						<ul>
							<li>Mở cửa từ <b>8h - 22h kể cả chủ nhật và ngày lễ</b></li>
							<li>Chăm sóc khách hàng: <b>097-989-1080</b></li>
							<li>Quản lý chất lượng: <b>090-462-8286</b></li>
						</ul>
						<div class="close_map">
							<img src="images/close_map.gif" />
						</div>
					</div>
					<div class="main_map clearfix">
						<div class="cols_map1">
							<div class="row_map">
								<div class="field uppercase bold clearfix">XTECH tại Hà Nội</div>
								<div class="field uppercase padding-left1 clearfix">Quận Đống Đa</div>
								<div class="field padding-left2 clearfix sm1"><b>1/ 169B phố Thái Hà, Phường Láng Hạ</b></div>
								<div class="field padding-left3 clearfix sm1">Siêu thị: <b>04-3537-6769</b> / Quản lý: <b>098-312-7576</b> / Diện tích đỗ xe: <b>5 ô-tô & 50 xe máy</b></div>
								<div class="field padding-left2 clearfix sm2"><b>2/ 48 phố Thái Hà, Phường Trung Liệt</b></div>
								<div class="field padding-left3 clearfix sm2">Siêu thị: <b>04-3538-0254</b> / Quản lý: <b>099-361-0841</b> / Diện tích đỗ xe: <b>15 xe máy</b></div>
							</div>
						</div>
						<div class="cols_map2">
							<img src="images/map.gif" id="map1" />
							<img src="images/map2.gif" id="map2" />
						</div>
					</div>
				</div>
			</div>
			<div class="menu-cart">
				<div class="main_cart">
					<div class="register">
						<a href="javascript:alert('Hệ thống quản lý tài khoản khách hàng đang hoàn thiện !');">Đăng nhập</a> | <a href="javascript:alert('Hệ thống quản lý tài khoản khách hàng đang hoàn thiện !');">Đăng ký</a> 
					</div>
					<ul>
						<li><a href="index.php?route=checkout/cart">Giỏ hàng [0]</a></li>
						<!--  
						<li><a href="javascript:void(0);" id="sp_2">Sản phẩm vừa xem [2]</a></li>
						<li><a href="javascript:void(0);" id="sp_3">So sánh sản phẩm [2]</a></li>
						-->
					</ul>					
				</div>
			</div>
		</div>
    </body>
    <?php echo '
    <script type="text/javascript">
    $(document).ready(function() {
    	//background full screen
    	$("#background").fullBg();
    	
        //auto completed
    	$("input#autocomplete").autocomplete({
    	    source: [';  echo $this->_tpl_vars['array'];  echo ']
    	});
        //hot deal
        $(".box-hotdeal").hover(function(){
            $(this).find(".lsInfomation").fadeIn(\'slow\');
            $(".lsCustomer").fadeOut(\'slow\');
        },function(){
        	$(this).find(".lsInfomation").fadeOut(\'slow\');
        });
        $(".buy a").click(function(){
        	var id	= $(this).attr("id").substring(3);
        	$(".lsCustomer").fadeOut(\'slow\');
        	if ($("#cus_"+id).css("display") == "none"){
	        	$("#cus_"+id).fadeIn(\'slow\');
	        	$("#cus_"+id).load("ajax.php?task=customer&hotdeal_id="+id);
        	}else{
        		$("#cus_"+id).fadeOut(\'slow\');
        	}
        });

      	//map
        $("#site_map").click(function(){
        	$("#map").fadeIn();
        	$("#map1").show();
    		$("#map2").hide();
        	$(".sm1").click(function(){
        		$("#map1").show();
        		$("#map2").hide();
        	});
        	$(".sm2").click(function(){
        		$("#map2").show();
        		$("#map1").hide();
        	});
        });
        //close
        $(".close img, .close_map img, .close_cus img").click(function(){
        	$("#box-cart, #box_register, #map, .lsCustomer").fadeOut();
        });
      	//vote
    	$(\'.rate_widget\').each(function(i) {
            var widget = this;
            var out_data = {
                widget_id : $(widget).attr(\'id\'),
                fetch: 1
            };
            $.post(
                \'ratings.php\',
                out_data,
                function(INFO) {
                    $(widget).data( \'fsr\', INFO );
                    set_votes(widget);
                },
                \'json\'
            );
        });

        $(\'.ratings_stars\').hover(
            // Handles the mouseover
            function() {
                $(this).prevAll().andSelf().addClass(\'ratings_over\');
                $(this).nextAll().removeClass(\'ratings_vote\'); 
            },
            // Handles the mouseout
            function() {
                $(this).prevAll().andSelf().removeClass(\'ratings_over\');
                // can\'t use \'this\' because it wont contain the updated data
                set_votes($(this).parent());
            }
        );
        
        // This actually records the vote
        $(\'.ratings_stars\').bind(\'click\', function() {
            var star = this;
            var widget = $(this).parent();
            
            var clicked_data = {
                clicked_on : $(star).attr(\'class\'),
                widget_id : $(star).parent().attr(\'id\')
            };
            $.post(
                \'ratings.php\',
                clicked_data,
                function(INFO) {
                    widget.data( \'fsr\', INFO );
                    set_votes(widget);
                },
                \'json\'
            ); 
        });
        
        $(".ratings_stars").click(function()
    	{
        	var id = $(this).attr("id").substring(5);
        	var dataString = \'id=\'+ id ;
        	var parent = $(this);

        	$(this).fadeIn(200).html(\'<img src="images/star_vote.png" />\');
        	$.ajax({
    	    	type: "GET",
    	    	url: "ajax.php?task=vote&id="+id,
    	    	data: dataString,
    	    	cache: false,

    	    	success: function(html)
    	    	{
    	    	parent.html(html);
    	    	}
        	});
        	return false;
    	});
	});
    function set_votes(widget) {

        var avg = $(widget).data(\'fsr\').whole_avg;
        var votes = $(widget).data(\'fsr\').number_votes;
        var exact = $(widget).data(\'fsr\').dec_avg;

        window.console && console.log(\'and now in set_votes, it thinks the fsr is \' + $(widget).data(\'fsr\').number_votes);
        
        $(widget).find(\'.star_\' + avg).prevAll().andSelf().addClass(\'ratings_vote\');
        $(widget).find(\'.star_\' + avg).nextAll().removeClass(\'ratings_vote\'); 
        $(widget).find(\'.total_votes\').text( votes + \' votes recorded (\' + exact + \' rating)\' );
    }
    </script>
    <script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push([\'_setAccount\', \'UA-15368416-2\']);
	  _gaq.push([\'_trackPageview\']);
	
	  (function() {
	    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
	    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
	    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
	'; ?>

</html>