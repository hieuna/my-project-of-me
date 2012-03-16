<?php
/**
 * @version		$Id: index.php 21720 2011-07-01 08:31:15Z chdemko $
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/* The following line loads the MooTools JavaScript Library */
JHtml::_('behavior.framework', true);

/* The following line gets the application object for things like displaying the site name */
$app 		= JFactory::getApplication();
$option 	= JRequest::getString('option', '', 'GET');
$view 		= JRequest::getString('view', '', 'GET');
?>
<?php echo '<?'; ?>xml version="1.0" encoding="<?php echo $this->_charset ?>"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
	<head>
		<!-- The following JDOC Head tag loads all the header and meta information from your site config and content. -->
		<jdoc:include type="head" />
		<!-- The following five lines load the Blueprint CSS Framework (http://blueprintcss.org). If you don't want to use this framework, delete these lines. -->
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/style.css" type="text/css" />
        <![if !IE]>
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/css3.css" type="text/css" />
		<![endif]>
		<!--[if IE 9 ]> <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/css3.css" type="text/css" /> <![endif]-->
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery-1.7.min.js" type="text/javascript"></script>
        <title>CCBM</title>
	</head>
	<body>
		<div id="main-cmbm" class="clearfix">
    		<div id="header">
    			<div id="logo"><a href="#"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/logo.jpg" border="0" /></a></div>
    			<div id="namecity">
    				Công ty cổ phần tư vấn xây dựng công trình VLXD<br/>
    				<span>Consultancy Joint stock company on construction of building material project</span>
    			</div>
    			<div id="menutop">
    				<ul>
    					<li><a href="#">Văn bản</a></li>
    					<li><a href="#">Thư viện</a></li>
    					<li><a href="#">Cổ đông</a></li>
    					<li><a href="#">Tuyển dụng</a></li>
    					<li><a href="#">Góc văn hóa</a></li>
    					<li><a href="#">Liên hệ</a></li>
    				</ul>
    			</div>
    			<div id="bglanguage"></div>
    		</div>
    		<div id="menu-slide">
    			<div class="menuMain"></div>
    			<div class="slide"></div>
    		</div>
    		<div id="main" class="clearfix">
    			<div id="colsLeft" class="box-shadow">
    				<div class="title pt">Sản phẩm sản xuất & Kinh doanh</div>
    				<div class="clearfix"></div>
    				<ul>
    					<li>
    						<div>
    							<h3><a href="#">Canxi Cacbonat</a></h3>
    							<a href="#"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/product1.jpg" /></a>
    						</div>
    					</li>
    					<li>
    						<div>
    							<h3><a href="#">Dolomit</a></h3>
    							<a href="#"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/product2.jpg" /></a>
    						</div>
    					</li>
    					<li>
    						<div>
    							<h3><a href="#">Kaolin</a></h3>
    							<a href="#"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/product3.jpg" /></a>
    						</div>
    					</li>
    					<li>
    						<div>
    							<h3><a href="#">Talc</a></h3>
    							<a href="#"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/product4.jpg" /></a>
    						</div>
    					</li>
    					<li>
    						<div>
    							<h3><a href="#">Fenspat</a></h3>
    							<a href="#"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/product5.jpg" /></a>
    						</div>
    					</li>
    				</ul>
    			</div>
    			<div id="colsCenter">
    				<div class="title pmain">Tin tức</div>
    				<p class="first box-shadow-p">
    					<a href="#">Tổng giám đốc Nguyễn Khánh Hà làm việc với CÔNG TY CP XI MĂNG LẠNG SƠN</a><br />
    					<img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/cmbm_pic.jpg" />
    					Hệ thống quản lý chất lượng<br />
    					Cùng với việc đầu tư cho nguồn nhân lực, Công ty đã đẩy mạnh áp dụng hệ thống quản lý
    					chất lượng trong hoạt động kinh doanh nhằm đạt hiệu quả một cách cao nhất. Hệ thống
    					quản lý chất lượng phù hợp với tiêu chuẩn ISO 9001:2000 là một yếu tố đảm bảo với khách
    					hàng về tính ổn định của chất lượng sản phẩm, dịch vụ mà CMBM mang lại. Hệ thống quản lý
    					chất lượng theo tiêu chuẩn ISO 9001:2000 đã được CMBM quan tâm xây dựng ngay từ khi còn là
    					doanh nghiệp nhà nước. Khi chuyển đổi mô hình
    				</p>
    				<div class="clearfix"></div>
    				<ul>
    					<li>
    						<a href="#"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/cmbm_image1.jpg" /></a>
    						<a href="#">Ký kết HĐKT gói thầu tư vấn nhà máy xin măng Lam Thạch</a>
    					</li>
    					<li>
    						<a href="#"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/cmbm_image2.jpg" /></a>
    						<a href="#">Ký kết HĐKT gói thầu tư vấn nhà máy xin măng Lam Thạch</a>
    					</li>
    					<li>
    						<a href="#"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/cmbm_image3.jpg" /></a>
    						<a href="#">Ký kết HĐKT gói thầu tư vấn nhà máy xin măng Lam Thạch</a>
    					</li>
    				</ul>
    				<ul style="padding-top: 20px; float: left;">
    					<li>
    						<a href="#"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/cmbm_image1.jpg" /></a>
    						<a href="#">Ký kết HĐKT gói thầu tư vấn nhà máy xin măng Lam Thạch</a>
    					</li>
    					<li>
    						<a href="#"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/cmbm_image2.jpg" /></a>
    						<a href="#">Ký kết HĐKT gói thầu tư vấn nhà máy xin măng Lam Thạch</a>
    					</li>
    					<li>
    						<a href="#"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/cmbm_image3.jpg" /></a>
    						<a href="#">Ký kết HĐKT gói thầu tư vấn nhà máy xin măng Lam Thạch</a>
    					</li>
    				</ul>
    				<div class="clearfix"></div>
    				<div class="orther box-shadow-p">
    					Các tin khác
    					<ul>
    						<li><a href="#">CMBM tiến tới hội nhập quốc tế</a></li>
    						<li><a href="#">Ký kết HĐKT gói thầu tư vấn nhà máy xin măng Lam Thạch</a></li>
    						<li><a href="#">CMBM tiến tới hội nhập quốc tế</a></li>
    						<li><a href="#">Ký kết HĐKT gói thầu tư vấn nhà máy xin măng Lam Thạch</a></li>
    						<li><a href="#">Denkei Nhật Bản đến thăm và làm việc tại CMBM</a></li>
    					</ul>
    				</div>
    			</div>
    			<div id="colsRight" class="box-shadow">
    				<div class="title ptr">Các trung tâm</div>
    				<div class="clearfix"></div>
    				<ul>
    					<li>
    						<div>
    							<a href="#"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/tuvan1.jpg" /></a>
    							<h3><a href="#">Kỹ thuật & Công nghệ</a></h3>
    						</div>
    					</li>
    					<li>
    						<div>
    							<a href="#"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/tuvan2.jpg" /></a>
    							<h3><a href="#">Mỏ - Địa chất</a></h3>
    						</div>
    					</li>
    					<li>
    						<div>
    							<a href="#"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/tuvan3.jpg" /></a>
    							<h3><a href="#">Kỹ thuật & Xây dựng</a></h3>
    						</div>
    					</li>
    					<li>
    						<div>
    							<a href="#"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/tuvan.jpg" /></a>
    							<h3><a href="#">Bán kinh doanh & Đầu tư</a></h3>
    						</div>
    					</li>
    				</ul>
    			</div>
    		</div>
    	</div>
	</body>
</html>
