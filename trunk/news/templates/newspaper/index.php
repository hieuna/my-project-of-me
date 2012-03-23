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
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/styles/style.css" type="text/css" />
        <![if !IE]>
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/css3.css" type="text/css" />
		<![endif]>
		<!--[if IE 9 ]> <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/css3.css" type="text/css" /> <![endif]-->
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/styles/slide_fontpage.css" type="text/css" />
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery-1.7.min.js" type="text/javascript"></script>
        <!-- SLIDESHOW -->
        <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.js"></script>
  		<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/scripts.js"></script>
	</head>
	<body class="body">
	<div class="header">
		<div style="position: relative;" class="clearfix">
		 	<a class="logo" href="/"><h1>Báo điện tử của báo khuyến học &amp; Dân Trí</h1></a>
		 	<div class="div_gdpda" id="div_gdpda"><a href="/?removecookie=true">Giao diện PDA</a></div>
			 <div class="searchbox" id="searchbox">
				  <div class="clearfix">
					 <input type="text" id="txtData" name="q" onkeypress="return BBEnterPress();">
					 <input type="submit" onsubmit="BBSearch(); return false;" onclick="BBSearch(); return false;" class="btn" value="Tìm kiếm">
					 <input type="hidden" value="1" id="dantri">
				  </div>
			 </div>
			 <div class="links">
				  <a target="_blank" href="http://muachung.vn/" class="icon-game">Mua chung</a>
				  <a href="/c702s702/blog/trang-1.htm" class="icon-ads">Blog</a>
				  <a href="/c167/tam-long-nhan-ai.htm" class="icon-humane">Tấm lòng nhân ái</a>
				  <a target="_blank" href="http://baogiay.dantri.com.vn" class="icon-tuanbao2">Tuần báo</a>
				  <a href="http://enbac.com" class="icon-bussiness">Mua bán</a>
				  <a target="_blank" href="http://bexinh.dantri.com.vn" class="icon-bexinh">Bé xinh</a>
				  <a href="/c673/diendan/trang-1.htm" class="icon-forum">Diễn đàn dân trí</a>
				  <a target="_blank" href="http://www.dtinews.vn" class="icon-tienganh">English</a>
			 </div>
		 </div>
	</div>
	<div class="top-ads">
		<div style="margin: 0pt auto; width: 1004px;">
			<img width="1004" height="90" border="0" src="http://admicro2.vcmedia.vn/images/muachung122011980x90.jpg" id="ads_zone221_banner0">
		</div>
	</div>
	<div class="nav-wrap">
		 <div class="clearfix">
		 	<jdoc:include type="modules" name="news-topmenu" />
		 </div>
	</div>
<div>


</div>



<div>

	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWOgKn4qPlCwKy4e2fBwLoy569BALY8/ATAsfy65UBAr60ivQLApmqwKEEArPc3cEGAvHyqLkKAvrFuKoJAqSV2/MFAu+0y7AGAqLX9dcGAsCCjpgLAsrDi4YCAsCCttQKApmqmAcC8NrC0gUC8e/QYgLAgr6YCgLOpd/0BQL86rKTDgKqlIbdCwLhy9a4AQLRo9bxDwLc9NWzCAKhnKG4CAKjkNWkDgK0lcijBwKdt5zVBgKj2pmfCAKpgpyODwKd4/3CBgKs7cGMAQLN+qG0CQLYja33CgLVyvTkBgLRo9bxDwLDmN+kCALztoapCwKl0snlBgLH8sPKBwL27ph4AqLDrNYDAtaWlM0FArnYmQUC8PWd1gsCro/f7w0Cg4SQzg8CpMWVrQgC7si83wYCnrn+ywUCr4b14gQC/6DIkA0Cgtq2xQgC6vSo0QEC+qWG1Q0CrqnvwgJ7+XPOdEwVuEJViCipsawU9wLA4Q==" />
</div>
	
	<table cellpadding="0" cellspacing="0" class="master">
		<tr>
			<td valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" class="masterContent">
				<?php
				if ($view == 'frontpage'){
				?>
 				<tr>
    				<td colspan="3">
	    				<div class="topmaincontent">
	    					<jdoc:include type="modules" name="news-content-center" />
	    				</div>
    				</td>
 				</tr>
 				<tr>
 					<td colspan="3">
	 					<div class="banner_special">
	    					<jdoc:include type="modules" name="news-sidebar" />
	    				</div>
 					</td>
 				</tr>
 				<?php }?>
				<tr>
					<td colspan="3">

					<div style="padding-top: 4px">
						<table cellpadding="0" cellspacing="0" width="100%" border="0">
							<tr>
								<td width="100%" valign="top">
											<div class="mainContainer">
												<div class="fl wid470">
												<?php
												if ($view == 'frontpage'){
													?>
													<div class="view_content">
														<jdoc:include type="modules" name="news-frame1" />
													</div>
													<?php
												}else{
													?>
													<jdoc:include type="component" />
													<?php
												} 
												?>
												</div>
												<div class="fl wid310">
													<div class="box_adver_vuong">
														<jdoc:include type="modules" name="news-adver1" />
														<jdoc:include type="modules" name="news-adver2" />
														<jdoc:include type="modules" name="news-adver3" />
														<div class="banneritem_text">
															<jdoc:include type="modules" name="news-adver4" />
														</div>
														<jdoc:include type="modules" name="news-adver5" />
													</div>
												</div>
												<div class="fr wid210 text_center">
													<div class="wid200 margin_auto">
														<jdoc:include type="modules" name="news-right" />
													</div>
												</div>
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

					</table>
					<table cellspacing="0" cellpadding="0" border="0" class="footer noprint">
						<tr>
							<td align="center">
							<p class="bottom">CƠ QUAN CHỦ QUẢN: <strong>BỘ THÔNG 
							TIN VÀ TRUYỀN THÔNG (MIC)</strong> <br />
							Giấy phép thiết lập Trang thông tin điện tử số 260/GP-TTĐT do Cục Quản lý Phát thanh, Truyền hình và Thông tin điện tử cấp ngày 08/12/2010. <br />
							Chịu trách nhiệm chính: Ông Trần Vũ Hà, Q. Giám đốc Trung tâm 
							Thông tin - Bộ Thông tin và Truyền thông. <br />

							Bản quyền thuộc Trung tâm Thông tin. Địa chỉ: 18 Nguyễn Du - Hà Nội; <br />
							Email: <a href="mailto:banbientap@mic.gov.vn">banbientap@mic.gov.vn</a> 
							; Điện thoại: 04.3.5563462; Fax: 
							04.3.5563458. <br />
							<em>Ghi rõ nguồn &quot;MIC&quot; khi phát hành 
							lại thông tin từ website này </em></p>
							</td>

						</tr>
					</table>
					
				
 
	</body>
</html>
