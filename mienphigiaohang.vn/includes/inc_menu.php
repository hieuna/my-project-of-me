<div class="main">
        <div class="mainlevel clearfix">
            <ul class="item-main">                                        
			    <li><a <?php if($cat_id == "") echo 'class="active"';?> href="../deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>"><span>Giá tốt hôm nay</span></a></li>  
				<li><a  href="../deals/san-pham-<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>"><span>Giá tốt gần đây</span></a></li>  
				<!--<li><a <?php if($cat_id == 47) echo 'class="active"';?> href="../deals/47-<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>.html"><span>Sản phẩm</span></a></li>  -->
				<li><a <?php if($cat_id == 58) echo 'class="active"';?> href="../deals/58-<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>.html"><span>Đồ gia dụng</span></a></li>  
				<li><a <?php if($cat_id == 53) echo 'class="active"';?> href="../deals/53-<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>.html"><span>Thời trang</span></a></li>  
				<li><a <?php if($cat_id == 54) echo 'class="active"';?> href="../deals/54-<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>.html"><span>Quà tặng</span></a></li>  
				<li><a <?php if($cat_id == 46) echo 'class="active"';?> href="../deals/46-<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>.html"><span>Hóa mỹ phẩm</span></a></li>  
				<li><a href="../deals/search.php"><span>Tìm kiếm</span></a></li>     
            </ul>
            <ul class="item-main fr"> 
              <!--<li><a href="../napthe/" target="_blank"><strong>Nạp thẻ ĐT </strong> <img src="../images/hot_icon3.gif" width="27" height="17" border="0" align="absmiddle" /></a></li>-->
                   <?php if(isset($_SESSION['loged'])) {?>   
                <li >Xin chào :<a href="#"><strong> <?=$_SESSION['ses_username']?></strong></a>
                	 <ul class="sub1">                                                        
						<li><a href="../deals/sua-thong-tin-ca-nhan-<?=$_SESSION['ses_username']?>.html">Thông tin cá nhân</a></li>
                        <li><a href="../deals/doi-mat-khau-<?=$_SESSION['ses_username']?>.html">Đổi mật khẩu</a></li>
						<li><a href="../deals/thong-tin-gio-hang-<?=$_SESSION['ses_username']?>.html">Lịch sử giao dịch</a></li>
						<li ><a href="../deals/dang-xuat.html"><strong>Đăng xuất</strong></a></li>
					</ul>
                </li> 
                 
                <?php } else{?>                                            
			    <li ><a href="../deals/dang-nhap"><strong>Đăng nhập</strong></a></li>
				<li ><a  href="../deals/dang-ky"><strong>Đăng ký</strong></a></li>
                <?php }?>
				<li class="last"><a href="#"><strong>Trợ giúp</strong></a>
					 <ul class="sub1">  
<!--						<li><a href="../deals/search.php" target="_blank">Tìm kiếm</a></li>     -->
						<li><a href="../deals/ve-chung-toi.html" target="_blank">Về chúng tôi</a></li>
						<li><a href="../deals/huong-dan-thanh-toan.html" target="_blank">Hướng dẫn thanh toán</a></li>
						<!--<li><a href="../deals/quy-che.html" target="_blank">Điều khoản sử dụng</a></li>-->
						<!--<li><a href="../deals/gioi-thieu-ve-mien-phi-giao-hang.html">Giới thiệu về Miễn Phí Giao Hàng</a></li>-->
                        <li><a href="../deals/cau-hoi-thuong-gap.html" target="_blank">Câu hỏi thường gặp</a></li>
						
					</ul>
				</li><!--
				<li>
				<!-- Đặt thẻ này ở nơi bạn muốn nút +1 hiển thị -->
				<!--	<g:plusone annotation="inline"></g:plusone>

					<!-- Đặt cuộc gọi hiển thị này ở nơi thích hợp -->
				<!--	<script type="text/javascript">
					  (function() {
						var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
						po.src = 'https://apis.google.com/js/plusone.js';
						var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
					  })();
					</script>
				</li>-->
			</ul>
        </div>
        <!-- End Main Level -->
    </div>