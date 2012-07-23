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
$group		= JRequest::getString('group', '', 'GET');
?>
<?php echo '<?'; ?>xml version="1.0" encoding="<?php echo $this->_charset ?>"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
	<head>
		<!-- The following JDOC Head tag loads all the header and meta information from your site config and content. -->
		<jdoc:include type="head" />
		<meta content="text/html; charset=utf-8" http-equiv="content-type">
		<meta content="index, follow" name="robots">
		<meta content="Super User" name="author">
		<meta name="alexaVerifyID" content="mTgOEnSXjLVO3GnyYR3ssLRhxRc" />
		<meta name="keywords" content="tap chi, doanh nhan, doanh nhan viet, bao doanh nhan, tap chi doanh nhan viet, am thuc viet, lam dep, thoi trang viet, the thao" />
		<meta name="description" content="tap chi, doanh nhan ,doanh nhan viet, goc doanh nhan, doanh nhan thanh dat, Tạp chí, Tạp chí doanh nhân việt, Doanh nhân thành công, Tạp chí doanh nhân, Góc doanh nhân, Doanh nhân Việt, Tap chi doanh nhan viet, tap chi doanh nhan, làm đẹp 3 miền, ẩm thực việt" />
		<meta name="generator" content="Joomla! - Open Source Content Management" />
		<!-- The following five lines load the Blueprint CSS Framework (http://blueprintcss.org). If you don't want to use this framework, delete these lines. -->
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/styles/style.css" type="text/css" />
        <![if !IE]>
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/styles/css3.css" type="text/css" />
		<![endif]>
		<!--[if IE 9 ]> <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/styles/css3.css" type="text/css" /> <![endif]-->
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/styles/slide_fontpage.css" type="text/css" />
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery-1.7.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.cycle.all.min.js" type="text/javascript"></script>
        <!-- SLIDESHOW -->
        <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.js"></script>
  		<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/scripts.js"></script>
  		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-30462349-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
	</head>
	<body class="body" onload="setAsHomePage(this);">
		<div class="header_full">
			<div class="header">
				<div style="position: relative;" class="clearfix">
				 	<a class="logo" href="index.php"><h1>Cổng thông tin điện tử và truyền thông</h1></a>
				 	<!--  
					 <div class="searchbox" id="searchbox">
						  <div class="clearfix">
							<jdoc:include type="modules" name="news-search" />
						  </div>
					 </div>
					 -->
					 <div class="banner-icon">
						  <jdoc:include type="modules" name="news-icon" />
					 </div>
				 </div>
			</div>
			<div class="nav-wrap">
				 <div class="clearfix">
				 	<jdoc:include type="modules" name="news-topmenu" />
				 </div>
			</div>
		</div>	
	<table cellpadding="0" cellspacing="0" class="master">
		<tr>
			<td valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" class="masterContent">
				<?php
				if ($view == 'frontpage' && !$group){
				?>
 				<tr>
    				<td colspan="3">
	    				<div class="topmaincontent">
	    					<jdoc:include type="modules" name="news-content-center" />
	    				</div>
    				</td>
 				</tr>
 				<?php }?>
 				<tr>
 					<td colspan="3">
	 					<div class="banner_special">
	 						<?php include("html/systems.php");?>
	    					<jdoc:include type="modules" name="news-top" />
	    				</div>
 					</td>
 				</tr>
				<tr>
					<td colspan="3">
					<div style="padding-top: 4px">
						<table cellpadding="0" cellspacing="0" width="100%" border="0">
							<tr>
								<td width="100%" valign="top">
									<div class="mainContainer">
									<?php if ($group):?>
										<?php include("html/warehouse.php");?>
									<?php else:?>
										<?php if ($view != 'section'):?>
										<?php if ($view == 'category' || $view == 'article'):?>
											<div class="fl wid490">
												<?php
												if ($view == 'frontpage'){
													?>
													<div class="view_content">
														<jdoc:include type="modules" name="news-frame1" />
													</div>
													<?php
												}else{
													?>
													<jdoc:include type="modules" name="right" />
													<jdoc:include type="component" />
													<div class="article_others">
														<jdoc:include type="modules" name="news-bottomleft" />
													</div>
													<?php
												} 
												?>
											</div>
											<?php else:?>
											<div class="fl wid700">
												<?php
												if ($view == 'frontpage'){
													?>
													<div class="view_content">
														<jdoc:include type="modules" name="news-frame1" />
													</div>
													<?php
												}else{
													?>
													<jdoc:include type="modules" name="right" />
													<jdoc:include type="component" />
													<div class="article_others">
														<jdoc:include type="modules" name="news-bottomleft" />
													</div>
													<?php
												} 
												?>
											</div>
											<?php endif;?>
										<?php else:?>
										<div class="fl wid700">
											<?php include("html/category.php");?>
										</div>
										<?php endif;?>
										<div class="fl wid310">
											<div class="box_adver_vuong">
												<jdoc:include type="modules" name="news-special" />
												<jdoc:include type="modules" name="news-debug" />
												<jdoc:include type="modules" name="news-adver1" />
												<jdoc:include type="modules" name="news-adver2" />
												<jdoc:include type="modules" name="news-adver3" />
												<div class="banneritem_text">
													<jdoc:include type="modules" name="news-adver4" />
												</div>
												<jdoc:include type="modules" name="news-adver5" />
												<jdoc:include type="modules" name="news-bottommiddle" />
												<div class="box_modules clearfix">
													<div class="banneritem_text">
														<div class="title_box_modules">Thống kê truy cập</div>
														<jdoc:include type="modules" name="news-bottom" />
													</div>
												</div>
											</div>
										</div>
										<?php if ($view == 'category' || $view == 'article'):?>
										<div class="fr wid210 text_center">
											<div class="wid200">
												<jdoc:include type="modules" name="news-right" />
											</div>
										</div>
										<?php endif;?>
									<?php endif;?>	
									</div>
								</td>
							</tr>
						</table>
					</div>
					</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<?php include("html/partner.php");?>	
			</td>
		</tr>
		<tr>
			<td valign="top">
			<table cellspacing="0" cellpadding="0" border="0" class="footer">
				<tr>
					<td align="center">
						<jdoc:include type="modules" name="footer" />
						<p style="text-align: left; padding-left: 25px; margin: 3px 0; position: relative;">
							<a target="_blank" href="http://maxco.vn/danh-muc-san-pham/106/may-chieu-sony" title="may chieu sony">phan phoi may chieu sony</a>,
							<a target="_blank" href="http://maxco.vn/danh-muc-san-pham/108/may-chieu-panasonic" title="may chieu panasonic">phan phoi may chieu panasonic</a>,
							<a target="_blank" href="http://maxco.vn/danh-muc-san-pham/107/may-chieu-sharp" title="may chieu sharp">phan phoi may chieu sharp</a>,
							<a target="_blank" href="http://maxco.vn/danh-muc-san-pham/109/may-chieu-viewsonic" title="may chieu viewsonic">phan phoi may chieu viewsonic</a>,
							<a target="_blank" href="http://maxco.vn/danh-muc-san-pham/110/may-chieu-optoma" title="may chieu optoma">phan phoi may chieu optoma</a>,
							<a target="_blank" href="http://maxco.vn/danh-muc-san-pham/98/may-photocopy-sharp" title="may photocopy sharp">phan phoi may photocopy</a> 
							<div style="position: fixed; bottom: 0; right:0;">
								<a href="http://www.alexa.com/siteinfo/tapchidoanhnhanviet.vn"><script type='text/javascript' src='http://xslt.alexa.com/site_stats/js/s/a?url=tapchidoanhnhanviet.vn'></script></a>
							</div>
						</p>
					</td>
				</tr>
			</table>
			</td>
		</tr>
	</table>
	<script type="text/javascript">
	//Set default home page
    function setAsHomePage(i)
	{	
		if (document.all) {
			i.style.behavior='url(#default#homepage)';
			i.setHomePage('http://tapchidoanhnhanviet.vn');
		}
	}
	$(function() {
		//Set font
		$('.fon5 span, .wid300 span').css('font-family', 'inherit');
		$('.fon5 span, .wid300 span').css('font-size', 'inherit');
		//Slide
	    $('#tab_systems').cycle({
	    	fx: 'fade',
	    	timeout: 15000
	    });
	    $('#tab_content').cycle({
	    	fx: 'scrollLeft',
	    	timeout: 10000
	    });
	    $('#tab_slide').cycle({
	    	fx: 'fade',
	    	timeout: 10000
	    });
	    //location.reload();
	    //window.open("http://tapchidoanhnhanviet.vn");
	    //setInterval( window.open('http://tapchidoanhnhanviet.vn'), 10000 );
	    setInterval(function() {  
	    	//window.open('http://tapchidoanhnhanviet.vn');
	    	location.reload();  
	   	}, 180000);
	});
	</script>
	</body>
</html>
