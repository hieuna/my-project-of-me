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
 				<tr>
    				<td colspan="3">
	    				<div class="console">
							<!-- Console -->
							<span id="ctl00_ctl17_publishingContext1"></span>
							<!-- Console -->
						</div>
	    				<div class="topmaincontent">
	    					<jdoc:include type="modules" name="news-content-center" />
	    				</div>
    				</td>
 				</tr>
 				<tr style="height:7px;">
 				<td width="0px"></td>

 				
 				</td>
 				
 				
 				
 				<td width="0px"></td>
 				
 				</tr>
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
													<jdoc:include type="modules" name="news-frame1" />
													<?php
												}else{
													?>
													<?php if ($this->getBuffer('message')) : ?>
													<div class="error">
														<h2>
															<?php echo JText::_('Message'); ?>
														</h2>
														<jdoc:include type="message" />
													</div>
													<?php endif; ?>
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
											</div>
										</td>
													
													<td valign="top" style="padding-right: 4px; width: 220px; margin-left:10px;" >
													
													<table border="0" cellpadding="0" cellspacing="0" align="center" class="homerightmail">
	<div style="height: 4px">
														</div>

	<tr>
		<td class="mailtitle" style="background-image:url('/Style Library/Imagesnew/mic/bgr_menu.jpg'); height:35px;">
			<font class="font_homerightmail_checkmail">Thư điện tử (mic.gov.vn)</font></td>
		</tr>
		
		<tr>
			<td class="mailcontent">
				
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr><td colspan="2" height="10" ></td></tr>

						<tr>
							<td width="100px"><font class="font_homerightmail_login">Tên truy nhập</font></td>
							<td><input maxlength="120" id="tempMailUser" name="tempMailUser" type="text" class="textbox_mail"></td>
						</tr>
						<tr><td colspan="2" height="10"></td></tr>
						<tr>
							<td><font class="font_homerightmail_login">Mật khẩu</font></td>
							<td><input maxlength="40" id="tempMailPassword" name="tempMailPassword" type="password" class="textbox_mail" onkeydown="KeyDownHandler();"></td>

						</tr>
						<tr><td colspan="2" height="6"></td></tr>
						<tr><td colspan="2" align="center"><input id="btnEmailLogin" type="button" onclick="SubmitEmailForm();"   value="Đăng nhập" size="15" class="button_mail"></td></tr>
						<tr><td colspan="2" height="10px"></td></tr>
					</table>
			</td>
		</tr>
		<tr><td height="2"></td></tr>
</table>

													<div style="height: 4px">
														</div>
													<div style="height: 4px"></div>
												<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td class="poll-title-td">
<span class="poll-title">Bình chọn</span></td>
</tr>
<tr>
<td class="poll-table">
<table width="100%">

<tr>
<td colspan="2" class="poll-question" >
Bạn thường quan tâm tới thông tin nào nhất trên Trang TTĐT Bộ Thông tin và Truyền thông?
<table id="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices" class="ms-" border="0" style="font-family:verdana,arial,helvetica,sans-serif;font-size:8pt;">
	<tr>
		<td><input id="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices_0" type="radio" name="ctl00$PlaceHolderRightDiv$MICQuickPoll1$rbtlChoices" value="Thông tin giới thiệu về Bộ" /><label for="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices_0">Thông tin giới thiệu về Bộ</label></td>
	</tr><tr>
		<td><input id="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices_1" type="radio" name="ctl00$PlaceHolderRightDiv$MICQuickPoll1$rbtlChoices" value="Tin tức" /><label for="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices_1">Tin tức</label></td>
	</tr><tr>
		<td><input id="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices_2" type="radio" name="ctl00$PlaceHolderRightDiv$MICQuickPoll1$rbtlChoices" value="Văn bản Quản lý nhà nước" /><label for="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices_2">Văn bản Quản lý nhà nước</label></td>

	</tr><tr>
		<td><input id="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices_3" type="radio" name="ctl00$PlaceHolderRightDiv$MICQuickPoll1$rbtlChoices" value="Thủ tục hành chính" /><label for="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices_3">Thủ tục hành chính</label></td>
	</tr><tr>
		<td><input id="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices_4" type="radio" name="ctl00$PlaceHolderRightDiv$MICQuickPoll1$rbtlChoices" value="Địa chỉ liên hệ" /><label for="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices_4">Địa chỉ liên hệ</label></td>
	</tr><tr>
		<td><input id="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices_5" type="radio" name="ctl00$PlaceHolderRightDiv$MICQuickPoll1$rbtlChoices" value="Hỏi - đáp" /><label for="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices_5">Hỏi - đáp</label></td>
	</tr><tr>

		<td><input id="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices_6" type="radio" name="ctl00$PlaceHolderRightDiv$MICQuickPoll1$rbtlChoices" value="Số liệu thống kê" /><label for="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices_6">Số liệu thống kê</label></td>
	</tr><tr>
		<td><input id="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices_7" type="radio" name="ctl00$PlaceHolderRightDiv$MICQuickPoll1$rbtlChoices" value="Thông tin khác" /><label for="ctl00_PlaceHolderRightDiv_MICQuickPoll1_rbtlChoices_7">Thông tin khác</label></td>
	</tr>
</table></td>
</tr>
<tr>
<td align="left" >
<div id="pollSubmitButton">[
<a id="ctl00_PlaceHolderRightDiv_MICQuickPoll1_btnSubmit" class="ms-buttonwidthheight" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$PlaceHolderRightDiv$MICQuickPoll1$btnSubmit&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Biểu quyết</a>]</div>

</td>
<td align="right"><div id="pollSubmitButton">[
<a id="ctl00_PlaceHolderRightDiv_MICQuickPoll1_btnShowResult" class="ms-buttonwidthheight" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$PlaceHolderRightDiv$MICQuickPoll1$btnShowResult&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, true))">Xem kết quả</a>]</div></td>
</tr>
</table>
</td>
</tr>
</table>

													
													<div style="height: 4px"></div>

													<div style="height: 4px"></div>
													<div class="linkAdvertisement_Left"><a href="/ClickAdv.aspx?ID=11&amp;siteurl=%2F&amp;list=Danh%20s%C3%A1ch%20qu%E1%BA%A3ng%20c%C3%A1o%20tr%C3%AAn%20rightmenu"><img alt="" border="0" src="/PublishingImages/banner_diachi.jpg" style="BORDER: 0px solid; "></a></div><div class="linkAdvertisement_Left"><a href="/ClickAdv.aspx?ID=13&amp;siteurl=%2F&amp;list=Danh%20s%C3%A1ch%20qu%E1%BA%A3ng%20c%C3%A1o%20tr%C3%AAn%20rightmenu"><img alt="" border="0" src="/PublishingImages/bn_cq_bcxb.jpg" style="BORDER: 0px solid; "></a></div><div class="linkAdvertisement_Left"><a href="/ClickAdv.aspx?ID=14&amp;siteurl=%2F&amp;list=Danh%20s%C3%A1ch%20qu%E1%BA%A3ng%20c%C3%A1o%20tr%C3%AAn%20rightmenu"><img alt="" border="0" src="/PublishingImages/bn_dv_chuyentrach.jpg" style="BORDER: 0px solid; "></a></div><div class="linkAdvertisement_Left"><a href="/ClickAdv.aspx?ID=17&amp;siteurl=%2F&amp;list=Danh%20s%C3%A1ch%20qu%E1%BA%A3ng%20c%C3%A1o%20tr%C3%AAn%20rightmenu"><img alt="" border="0" src="/PublishingImages/vnpt.gif" style="BORDER: 0px solid; "></a></div><div class="linkAdvertisement_Left"><a href="/ClickAdv.aspx?ID=22&amp;siteurl=%2F&amp;list=Danh%20s%C3%A1ch%20qu%E1%BA%A3ng%20c%C3%A1o%20tr%C3%AAn%20rightmenu"><img alt="" border="0" height="97" src="/PublishingImages/vinaphone.jpg" width="222" style="BORDER: 0px solid; "></a></div><div class="linkAdvertisement_Left"><a href="/ClickAdv.aspx?ID=18&amp;siteurl=%2F&amp;list=Danh%20s%C3%A1ch%20qu%E1%BA%A3ng%20c%C3%A1o%20tr%C3%AAn%20rightmenu"><img alt="" border="0" src="/PublishingImages/bn02.jpg" style="BORDER: 0px solid; "></a></div><div class="linkAdvertisement_Left"><a href="/ClickAdv.aspx?ID=20&amp;siteurl=%2F&amp;list=Danh%20s%C3%A1ch%20qu%E1%BA%A3ng%20c%C3%A1o%20tr%C3%AAn%20rightmenu"><img alt="" border="0" src="/PublishingImages/VTN.jpg" style="BORDER: 0px solid; "></a></div><div class="linkAdvertisement_Left"><a href="/ClickAdv.aspx?ID=23&amp;siteurl=%2F&amp;list=Danh%20s%C3%A1ch%20qu%E1%BA%A3ng%20c%C3%A1o%20tr%C3%AAn%20rightmenu"><img alt="" border="0" src="/PublishingImages/mobifone.jpg" style="BORDER: 0px solid; "></a></div>

														
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
