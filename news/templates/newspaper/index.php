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
		 
		<div class="subnav">
		 <ul id="ul_submenu" class="clearfix"> 
		  
		 </ul> 
		 <div class="fr">
		 <a href="/skphapluat.rss" class="icon-rss2" id="ctl00_Header1_SubMenu1_lnkRss"></a>
		 </div> 
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
				<tr class="noprint">
					<td colspan="3">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr class="topNavContainer">
							<td class="noprint">
							<div class="menu_main">
							<ul id='verticalMenu' class='vmenu'>
								<li id='item0' class='menu_ngang'><a  class='menu_ngang' id='a0' href='/gioithieu/Trang/Giớithiệu.aspx'>Giới thiệu</a>
								<ul id='subvMenu' class='submenu'>
								<li id='subitem0' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/gioithieu/Trang/Chứcnăngnhiệmvụ.aspx'>Chức năng nhiệm vụ</a>
								</li>
								<li id='subitem1' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/gioithieu/Trang/Cơcấutổchức.aspx'>Cơ cấu tổ chức</a>
								</li>
								<li id='subitem2' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/gioithieu/Trang/Thôngtinliênhệ.aspx'>Thông tin liên hệ</a>
								</li>
								<li id='subitem3' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/gioithieu/Trang/Lịchsửpháttriển.aspx'>Lịch sử phát triển</a>
								</li>
								<li id='subitem4' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/thongtindiaphuong/ttlh/Trang/GiớithiệucácSởThôngtinvàTruyềnthông.aspx'>Sở Thông tin và Truyền thông</a>
								
								</li>
								</ul>
								</li>
								<li class='line'><img width="1" height="26" src="images/line_menu.jpg"></li>
								<li id='item1' class='menu_ngang'><a  class='menu_ngang' id='a1' href='/tintucsukien'>Tin tức - Sự kiện</a>
								<ul id='subvMenu' class='submenu'>
								<li id='subitem0' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/tintucsukien/tinhoatdongcuabo'>Tin hoạt động của Bộ</a>
								</li>
								<li id='subitem1' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/tintucsukien/tintuctrongnganh'>Tin tức trong ngành</a>
								</li>
								<li id='subitem2' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/tintucsukien/tindiaphuong'>Tin địa phương</a>
								</li>
								<li id='subitem3' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/tintucsukien/tintonghop'>Tin tổng hợp</a>
								
								</li>
								<li id='subitem4' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/tintucsukien/vanbanqpplmoibanhanh'>Giới thiệu Văn bản mới ban hành</a>
								</li>
								</ul>
								</li>
								<li class='line'><img width="1" height="26" src="images/line_menu.jpg"></li>
								<li id='item2' class='menu_ngang'><a  class='menu_ngang' id='a2' href='/vbqppl/Lists/Vn%20bn%20QPPL/AllItems.aspx'>Văn bản quản lý</a>
								<ul id='subvMenu' class='submenu'>
								<li id='subitem0' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/vbqppl/Lists/Vn bn QPPL/AllItems.aspx'>Văn bản QPPL</a>
								</li>
								<li id='subitem1' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/vbcddh/Lists/Vn bn ch o iu hnh/AllItems.aspx'>Văn bản CĐĐH</a>
								</li>
								<li id='subitem2' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/layyknd/Trang/default1.aspx'>Lấy ý kiến nhân dân về dự thảo VBQPPL</a>
								
								</li>
								</ul>
								</li>
								<li class='line'><img width="1" height="26" src="images/line_menu.jpg"></li>
								<li id='item3' class='menu_ngang'><a  class='menu_ngang' id='a3' href='/tthc'>Thủ tục hành chính</a>
								<ul id='subvMenu' class='submenu'>
								<li id='subitem0' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/tthc/trang/default.aspx'>Hướng dẫn thủ tục hành chính</a>
								</li>
								<li id='subitem1' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/ttcaicachTTHC/tintuc'>Thông tin cải cách thủ tục hành chính</a>
								</li>
								<li id='subitem2' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/dvhcc/Trang/D%e1%bb%8bchv%e1%bb%a5H%c3%a0nhch%c3%adnhc%c3%b4ng.aspx'>Dịch vụ công trực tuyến mức độ 3</a>
								</li>
								</ul>
								
								</li>
								<li class='line'><img width="1" height="26" src="images/line_menu.jpg"></li>
								<li id='item4' class='menu_ngang'><a  class='menu_ngang' id='a4' href='/clqhkh/bc'>Chiến lược QH KH</a>
								<ul id='subvMenu' class='submenu'>
								<li id='subitem0' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/clqhkh/bc'>Báo chí</a>
								</li>
								<li id='subitem1' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/clqhkh/xb'>Xuất bản</a>
								</li>
								<li id='subitem2' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/clqhkh/buuchinh'>Bưu chính</a>
								</li>
								<li id='subitem3' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/clqhkh/vt'>Viễn thông</a>
								</li>
								
								<li id='subitem4' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/clqhkh/cnttdt'>Công nghệ thông tin, ĐT</a>
								</li>
								<li id='subitem5' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/clqhkh/tsvtd'>Tần số vô tuyến điện</a>
								</li>
								</ul>
								</li>
								<li class='line'><img width="1" height="26" src="images/line_menu.jpg"></li>
								<li id='item5' class='menu_ngang'><a  class='menu_ngang' id='a5' href='/solieubaocao/solieuthongke'>Số liệu - Báo cáo</a>
								<ul id='subvMenu' class='submenu'>
								<li id='subitem0' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/solieubaocao/solieuthongke/Trang/S%E1%BB%91li%E1%BB%87uth%E1%BB%91ngk%C3%AA.aspx'>Số liệu thống kê</a>
								</li>
								<li id='subitem1' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/solieubaocao/danhsachcapphep'>Danh sách cấp phép</a>
								
								</li>
								<li id='subitem2' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/solieubaocao/cnttdt/Trang/S%C3%A1chtr%E1%BA%AFngc%C3%B4ngngh%E1%BB%87th%C3%B4ngtinv%C3%A0truy%E1%BB%81nth%C3%B4ng2010.aspx'>Sách Trắng</a>
								</li>
								<li id='subitem3' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/solieubaocao/tailieu'>Tài liệu</a>
								</li>
								</ul>
								</li>
								<li class='line'><img width="1" height="26" src="images/line_menu.jpg"></li>
								<li id='item6' class='menu_ngang'><a  class='menu_ngang' id='a6' href='/thongtindtdtmscong'>Đầu tư, đấu thầu</a>
								<ul id='subvMenu' class='submenu'>
								<li id='subitem0' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/thongtindtdtmscong/dtk'>Dự án đầu tư đang triển khai</a>
								</li>
								<li id='subitem1' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/thongtindtdtmscong/dht'>Dự án đầu tư đã hoàn tất</a>
								
								</li>
								<li id='subitem2' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/thongtindtdtmscong/cbtk'>Dự án đầu tư chuẩn bị triển khai</a>
								</li>
								<li id='subitem3' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/thongtindtdtmscong/ttdt'>Thông tin đấu thầu</a>
								</li>
								<li id='subitem4' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='/thongtindtdtmscong/vbtk'>Văn bản tham khảo</a>
								</li>
								</ul>
								</li>
								<li class='line'><img width="1" height="26" src="images/line_menu.jpg"></li>
								<li id='item7' class='menu_ngang'><a  class='menu_ngang' id='a7' href='http://hoidap.mic.gov.vn/Trang/default.aspx'>Trao đổi hỏi đáp</a>
								<ul id='subvMenu' class='submenu'>
								<li id='subitem0' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='http://hoidap.mic.gov.vn/Trang/default.aspx'>Hỏi đáp</a>
								
								</li>
								<li id='subitem1' class='submenuitem'><img width="3" hspace="8" height="3" align="absmiddle" src="images/icon_01.jpg"><a href='http://forum.mic.gov.vn'>Diễn đàn</a>
								</li>
								</ul>
								</li>
							</ul>
							</div>
								<div style="float:left;padding-left: 10px;padding-top: 5px;width: 60%;">
												<span id="ctl00_Label1">Thứ Tư 14/03/2012</span></div>
							<div class="mn_c2">

							
								<div class="mnright_c2">
											<div class="lienket">
											<div id="ctl00_MICViewLinksAsDropDownList1" WebPart="true" __WebPartId="{42d79100-0294-4ad4-a682-db428ca1e9cb}" __MarkupType="vsattributemarkup">
	<select name="ctl00$MICViewLinksAsDropDownList1$ddl" id="ctl00_MICViewLinksAsDropDownList1_ddl" class="sitelink" onchange="customviewRedirect(this);">
		<option value="">Li&#234;n kết Website</option>
		<option value="http://www.na.gov.vn/">Quốc hội Việt Nam</option>
		<option value="http://www.cpv.org.vn/">Đảng Cộng sản Việt Nam</option>

		<option value="http://www.chinhphu.vn">Ch&#237;nh phủ</option>
		<option value="http://www.mic.gov.vn">Bộ Th&#244;ng tin v&#224; Truyền th&#244;ng</option>
		<option value="http://www.most.gov.vn/">Bộ Khoa học v&#224; C&#244;ng nghệ</option>

		<option value="http://www.mt.gov.vn/">Bộ Giao th&#244;ng vận tải</option>
		<option value="http://www.mpi.gov.vn/">Bộ Kế hoạch v&#224; Đầu tư</option>
		<option value="http://www.moit.gov.vn">Bộ C&#244;ng Thương</option>
		<option value="http://www.mofa.gov.vn/">Bộ Ngoại giao</option>
		<option value="http://www.moha.gov.vn">Bộ Nội vụ</option>

		<option value="http://www.agroviet.gov.vn/">Bộ N&#244;ng nghiệp v&#224; Ph&#225;t triển N&#244;ng th&#244;n</option>
		<option value="http://www.mof.gov.vn">Bộ T&#224;i ch&#237;nh</option>
		<option value="http://www.xaydung.gov.vn/site/moc">Bộ X&#226;y dựng</option>

		<option value="http://www.moh.gov.vn">Bộ Y tế</option>
		<option value="http://www.moet.gov.vn/">Bộ Gi&#225;o dục v&#224; Đ&#224;o tạo</option>
		<option value="http://www.monre.gov.vn">Bộ T&#224;i nguy&#234;n v&#224; M&#244;i trường</option>

		<option value="http://www.cinet.gov.vn/">Bộ Văn h&#243;a Thể thao v&#224; Du lịch</option>
		<option value="http://www.moj.gov.vn">Bộ Tư ph&#225;p</option>
		<option value="http://www.molisa.gov.vn/">Bộ Lao động - Thương binh v&#224; X&#227; hội</option>

		<option value="http://www.thanhtra.gov.vn/">Thanh tra Ch&#237;nh phủ</option>
		<option value="http://taisancong.vn">Trang Th&#244;ng tin về t&#224;i sản nh&#224; nước - Cục Quản l&#253; C&#244;ng sản - BTC</option>
		<option value="http://www.cema.gov.vn">Ủy ban D&#226;n tộc</option>

		<option value="http://mic.gov.vn/">---------------------------------</option>
		<option value="http://www.vnnic.vn/">Trung t&#226;m Internet Việt Nam</option>
		<option value="http://cuctanso.vn">Cục Tần số v&#244; tuyến điện</option>
		<option value="http://www.diap.gov.vn">Cục Ứng dụng CNTT</option>
		<option value="http://www.vnta.gov.vn/">Cục Viễn th&#244;ng</option>

		<option value="http://vietnam.vn/">Cục Th&#244;ng tin đối ngoại</option>
		<option value="http://www.vtf.vn/vi/">Quỹ Dịch vụ viễn th&#244;ng c&#244;ng &#237;ch Việt Nam</option>
		<option value="http://www.niics.gov.vn/">Viện Chiến lược TT&amp;TT</option>
		<option value="http://vncert.gov.vn/">Trung t&#226;m Ứng cứu khẩn cấp m&#225;y t&#237;nh Việt Nam</option>

		<option value="http://www.ictnews.vn/">B&#225;o Bưu điện Việt Nam</option>
		<option value="http://www.tapchibcvt.gov.vn/">Tạp ch&#237; CNTT&amp;TT</option>
		<option value="http://nxbthongtintruyenthong.vn/">Nh&#224; xuất bản Th&#244;ng tin v&#224; Truyền th&#244;ng</option>

		<option value="http://www.vtc.com.vn">Tổng c&#244;ng ty Truyền th&#244;ng đa phương tiện Việt Nam (VTC)</option>
		<option value="http://mic.gov.vn/">------------------------------------</option>
		<option value="http://vnpt.com.vn">Tập đo&#224;n Bưu ch&#237;nh Viễn th&#244;ng Việt Nam</option>
		<option value="http://www.viettel.com.vn/">Tổng c&#244;ng ty Viễn th&#244;ng qu&#226;n đội</option>

		<option value="http://www.vdc.com.vn/">C&#244;ng ty Điện to&#225;n v&#224; Truyền số liệu VDC</option>
		<option value="http://www.fpt.com.vn/vn/">C&#244;ng ty cổ phần FPT</option>
		<option value="http://www.spt.vn/">C&#244;ng ty Dịch vụ bưu ch&#237;nh viễn th&#244;ng S&#224;i G&#242;n</option>

		<option value="http://hcmc.netnam.vn/">C&#244;ng ty Netnam</option>
		<option value="http://www.congdoanvn.org.vn/">Tổng li&#234;n đo&#224;n Lao động Việt Nam</option>
		<option value="http://ictpress.vn/">Li&#234;n chi hội Nh&#224; b&#225;o Th&#244;ng tin v&#224; Truyền th&#244;ng</option>

	</select>
</div>
											</div>
											<div class="search">
												
														<div id="SRSB"> <div id="ctl00_PlaceHolderSearchArea_SearchBox">
	<table class="ms-sbtable ms-sbtable-ex" border="0">
		<tr class="ms-sbrow">
			<td class="ms-sbcell"><input name="ctl00$PlaceHolderSearchArea$SearchBox$S622C1022_InputKeywords" type="text" maxlength="200" id="ctl00_PlaceHolderSearchArea_SearchBox_S622C1022_InputKeywords" accesskey="S" title="Nhập từ tìm kiếm" class="ms-sbplain" alt="Nhập từ tìm kiếm" onkeypress="javascript:return S622C1022_OSBEK(event);" style="width:130px;" /></td><td class="ms-sbgo ms-sbcell"><a id="ctl00_PlaceHolderSearchArea_SearchBox_S622C1022_go" title="Tìm kiếm" href="javascript:S622C1022_Submit()"><img title="Tìm kiếm" onmouseover="this.src='/_layouts/images/gosearch.gif'" onmouseout="this.src='/Style Library/Imagesnew/MIC/timkiem.jpg'" alt="Tìm kiếm" src="/Style%20Library/Imagesnew/MIC/timkiem.jpg" style="border-width:0px;" /></a></td><td class="ms-sbLastcell"></td>

		</tr>
	</table>
</div></div>
													
											</div>
									</div>
							</div>
								

							<div style="background-color:#c6c0c0; height:1px; width:100%; clear:both;"><img src="/Style Library/Imagesnew/MIC/1x1.gif"/></div>
							</td>

							</tr>
					</table>
					</td>
				</tr>
 				<tr>
    				<td colspan="3">
    				<div class="console">
						
<!-- Console -->
<span id="ctl00_ctl17_publishingContext1"></span>

<!-- Console -->
</div>
    				<div class="topmaincontent">
    					
<div class="contenttop_left">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td id="MSOZoneCell_WebPartctl00_ctl15_MicNew_SlideNewsOnMainTop1" vAlign="top"><table TOPLEVEL border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td valign="top"><div WebPartID="cace60a6-f3b3-4db5-a690-9fffb06956cb" HasPers="false" id="WebPartctl00_ctl15_MicNew_SlideNewsOnMainTop1" width="100%" class="ms-WPBody" allowDelete="false" allowExport="false" style="" ><div class="featured">

				<div id='bngTC'>
				<div id='fragment-0' class='ui-tabs-panel ui-tabs-hide'>
				<img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/20120314_b2.jpg" alt="" width="447px" />
				<div class='info'> 
				<h2><a href='/tintucsukien/tinhoatdongcuabo/Trang/BộtrưởngNguyễnBắcSonthamdựĐạihộiThôngtindiđộngThếgiới.aspx'>Bộ trưởng Nguyễn Bắc Son tham dự Đại hội Thông tin di động Thế giới</a></h2></div> 
				 </div>
				<div id='fragment-1' class='ui-tabs-panel ui-tabs-hide'>
				<img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/20120313T1.JPG" alt="" width="447px" />
				<div class='info'> 
				<h2><a href='/tintucsukien/tinhoatdongcuabo/Trang/XâydựnghệthốngđốithoạigiữachínhquyềnđịaphươngvàdoanhnghiệpthôngquaứngdụngCôngnghệthôngtin.aspx'>Xây dựng hệ thống đối thoại giữa chính quyền địa phương và doanh nghiệp thông qua ứng dụng Công nghệ thông tin</a></h2></div> 
				 </div>

				<div id='fragment-2' class='ui-tabs-panel ui-tabs-hide'>
				<img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/20120313_b1.jpg" alt="" width="447px" />
				<div class='info'> 
				<h2><a href='/tintucsukien/tinhoatdongcuabo/Trang/Dựkiếntiêuchícôngtrìnhviễnthôngquantrọngliênquanđếnanninhquốcgia.aspx'>Dự kiến tiêu chí công trình viễn thông quan trọng liên quan đến an ninh quốc gia</a></h2></div> 
				 </div>
				</div>
				<ul class='ui-tabs-nav'>
				<li class='ui-tabs-nav-item' id='nav-fragment-0'> 
				<a class='frm' href='#fragment-0'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				</a></li> 
				<li class='ui-tabs-nav-item' id='nav-fragment-1'> 
				<a class='frm' href='#fragment-1'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</a></li> 
				<li class='ui-tabs-nav-item' id='nav-fragment-2'> 
				<a class='frm' href='#fragment-2'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</a></li> 
				</ul>
				</div>
				</div></td>

			</tr>
		</table></td>
	</tr>
</table></div>
<div class="contenttop_righ">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td id="MSOZoneCell_WebPartctl00_ctl15_g_12f784c8_9350_466f_9d8e_94fb91d2d9c4" vAlign="top"><table TOPLEVEL border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td valign="top"><div WebPartID="12f784c8-9350-466f-9d8e-94fb91d2d9c4" HasPers="false" id="WebPartctl00_ctl15_g_12f784c8_9350_466f_9d8e_94fb91d2d9c4" width="100%" class="ms-WPBody" allowDelete="false" allowExport="false" style="" ><div class="newsTopmain">

				<h2 class='topnews'>tin nổi bật</h2>
				<div id='item-0' class='newsTopmain-panel'>
				<a  href='/tintucsukien/tinhoatdongcuabo/Trang/TrườngCaođẳngCôngnghiệpinthôngbáotuyểnsinh.aspx'>
				<img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/20120310_a1.jpg" alt="" hspace="10" vspace="10" width="447px" /></a>
				<div class='info'> 
				<h2><a href='/tintucsukien/tinhoatdongcuabo/Trang/TrườngCaođẳngCôngnghiệpinthôngbáotuyểnsinh.aspx'>Trường Cao đẳng Công nghiệp in thông báo tuyển sinh năm 2012</a></h2></div> 
				 </div>
				<div id='item-1' class='newsTopmain-panel'>
				<a  href='/tintucsukien/tintonghop/Trang/TổnghợpbáochíviếtvềngànhTTTTtuần10(từngày03-09032012).aspx'>

				<img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/20120309_n3.jpg" alt="" hspace="10" vspace="10" width="447px" /></a>
				<div class='info'> 
				<h2><a href='/tintucsukien/tintonghop/Trang/TổnghợpbáochíviếtvềngànhTTTTtuần10(từngày03-09032012).aspx'>Tổng hợp báo chí viết về ngành TT& TT tuần 10 (từ ngày 03-09/03/2012)</a></h2></div> 
				 </div>
				<div id='item-2' class='newsTopmain-panel'>
				<a  href='/tintucsukien/tinhoatdongcuabo/Trang/GiaobanBáochíkhuvựcphíaNam.aspx'>
				<img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/20120308_a1.jpg" alt="" hspace="10" vspace="10" width="447px" /></a>
				<div class='info'> 
				<h2><a href='/tintucsukien/tinhoatdongcuabo/Trang/GiaobanBáochíkhuvựcphíaNam.aspx'>Giao ban Báo chí khu vực phía Nam: người phát ngôn tại đơn vị phải chủ động cung cấp thông tin cho báo chí</a></h2></div> 
				 </div>

				</div>
				</div></td>
			</tr>
		</table><div class="ms-PartSpacingVertical"></div></td>
	</tr><tr>
		<td id="MSOZoneCell_WebPartctl00_ctl15_g_42839c1d_e7d4_40eb_b949_d04a0b9a0ec7" vAlign="top"><table TOPLEVEL border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td valign="top"><div WebPartID="42839c1d-e7d4-40eb-b949-d04a0b9a0ec7" HasPers="false" id="WebPartctl00_ctl15_g_42839c1d_e7d4_40eb_b949_d04a0b9a0ec7" width="100%" class="ms-WPBody" allowDelete="false" allowExport="false" style="" ><div class="newsTopmain2">
				<img src='/Style Library/Imagesnew/MIC/line.jpg' border='0' height='1px' class='news'>

				<div class='MainBottomNormal2'>
				<img width='3' hspace='5' height='3' align='absmiddle' src='/Style Library/Imagesnew/MIC/icon_01.jpg'/>
				<h2><a href='/tintucsukien/tinhoatdongcuabo/Trang/QuảnlýcácchươngtrìnhkhuyếnmãicủacácDoanhnghiệpViễnthông.aspx'>Quản lý các chương trình khuyến mãi của các Doanh nghiệp Viễn thông</a></h2>
				 </div>
				<div class='MainBottomNormal2'>
				<img width='3' hspace='5' height='3' align='absmiddle' src='/Style Library/Imagesnew/MIC/icon_01.jpg'/>
				<h2><a href='/tintucsukien/tintuctrongnganh/Trang/NhiếpảnhgiaMỹvàcácphóngviênảnhTTTTtraođổinghiệpvụ.aspx'>Nhiếp ảnh gia Mỹ và các phóng viên ảnh TT&TT trao đổi nghiệp vụ</a></h2>

				 </div>
				</div>
				</div></td>
			</tr>
		</table></td>
	</tr>
</table></div>

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
								
								<td valign="top" style="padding-left: 4px; width: 222px;" class="noprint">
								
									
									
									
									
																	
								</td>
										<td width="100%" valign="top">
										<div id="ctl00_MSO_ContentDiv" class="mainContainer">
											<div>
												


													
													</div>

													<div class="pageTitle">
														
														</div>
														<div class="mainContent" id="divMainContent">
															



				
		


<div class="linkAdvertisement_Main"><a href="/ClickAdv.aspx?ID=1&amp;siteurl=%2F&amp;list=Danh%20s%C3%A1ch%20qu%E1%BA%A3ng%20c%C3%A1o%20gi%E1%BB%AFa%20trang%20ch%E1%BB%A7"><img alt="" border="0" src="/PublishingImages/banner_cc_tthc.jpg" style="BORDER: 0px solid; "></a></div>

<table cellspacing="0" cellpadding="0" border="0" width="100%" class="main_tintuc_title_box_focus">
	<tr style="background-image:url('/Style Library/Imagesnew/MIC/bgr_menu1.jpg');height:35px;">
		<td>
		<table cellspacing="0" cellpadding="0" border="0" width="100%" id="main_tintuc_title_0">
			<tr>

				<td style="height:35px" class="main_tintuc_box_title_selected_lefttitle">
				<img alt="" src="/_layouts/images/blank.gif" width="7px" height="28px" /></td>
				<td align="center" class="main_tintuc_box_selected_title">
				<a href="javascript:void(0)" onclick="ChangeSelectedOnMainTinTuc(0);">
				
				
				
				
				Tin hoạt động của Bộ</a></td>
				<td class="main_tintuc_box_title_selected_righttitle">
				<img alt="" src="/_layouts/images/blank.gif" width="7px" height="28px" /></td>
			</tr>

		</table>
		</td>
		<td>
		<table cellspacing="0" cellpadding="0" width="100%" border="0" id="main_tintuc_title_1">
			<tr>
				<td style="height:35px" class="main_tintuc_box_title_unselected_lefttitle">
				<img alt="" src="/_layouts/images/blank.gif" width="7px" height="28px" /></td>
				<td align="center" class="main_tintuc_box_unselected_title">
				<a href="javascript:void(0)" onclick="ChangeSelectedOnMainTinTuc(1);">

				
				
				
				
				Tin tổng hợp</a></td>
				<td class="main_tintuc_box_title_unselected_righttitle">
				<img alt="" src="/_layouts/images/blank.gif" width="7px" height="28px" /></td>
			</tr>
		</table>
		</td>
		<td>
		<table cellspacing="0" cellpadding="0" width="100%" border="0" id="main_tintuc_title_2">

			<tr>
				<td style="height:35px" class="main_tintuc_box_title_unselected_lefttitle">
				<img alt="" src="/_layouts/images/blank.gif" width="7px" height="28px" /></td>
				<td align="center" class="main_tintuc_box_unselected_title">
				<a href="javascript:void(0)" onclick="ChangeSelectedOnMainTinTuc(2);">
				
				
				
				
				Tin địa phương</a></td>
				<td class="main_tintuc_box_title_unselected_righttitle">
				<img alt="" src="/_layouts/images/blank.gif" width="7px" height="28px" /></td>

			</tr>
		</table>
		</td>
		<td>
		<table cellspacing="0" cellpadding="0" border="0" width="100%" id="main_tintuc_title_3">
			<tr>
				<td style="height:35px" class="main_tintuc_box_title_unselected_lefttitle">
				<img alt="" src="/_layouts/images/blank.gif" width="7px" height="28px" /></td>
				<td align="center" class="main_tintuc_box_unselected_title">

				<a href="javascript:void(0)" onclick="ChangeSelectedOnMainTinTuc(3);">
				
				
				
				
				Tin trong ngành</a></td>
				<td class="main_tintuc_box_title_unselected_righttitle">
				<img alt="" src="/_layouts/images/blank.gif" width="7px" height="28px" /></td>
			</tr>
		</table>
		</td>
		<td align="right">

		<table cellspacing="0" cellpadding="0" border="0" width="100%" id="main_tintuc_title_4">
			<tr>
				<td style="height:35px" class="main_tintuc_box_title_unselected_lefttitle">
				<img alt="" src="/_layouts/images/blank.gif" width="7px" height="28px" /></td>
				<td align="center" class="main_tintuc_box_unselected_title">
				<a href="javascript:void(0)" onclick="ChangeSelectedOnMainTinTuc(4);">
				
				
				
				
				Văn bản mới</a></td>
				<td class="main_tintuc_box_title_unselected_righttitle">

				<img alt="" src="/_layouts/images/blank.gif" width="7px" height="28px" /></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
                <td colspan="5" height="3" bgcolor="#0864a6"><img width="1" height="1" src="../../Style Library/Imagesnew/MIC/1x1.gif"></td>
              </tr>
	

</table>



<div class="main_tintuc_box_focus">
<div id="main_tintuc_body_0">
<table cellpadding="0" cellspacing="0">
<tr>
<td style="width:65%">
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<a href='/tintucsukien/tinhoatdongcuabo/Trang/XâydựnghệthốngđốithoạigiữachínhquyềnđịaphươngvàdoanhnghiệpthôngquaứngdụngCôngnghệthôngtin.aspx' class="MainBottomFocus_Header1">Xây dựng hệ thống đối thoại giữa chính quyền địa phương và doanh nghiệp thông qua ứng dụng Công nghệ thông tin</a><span class="MainBottomFocus_Created"> (02:10 CH 13/03/2012)</span></td></tr><tr><td valign="top" width="100%">
<img src="images/20120313T1.JPG" alt="" align="left" hspace="10" vspace="1" width="200px" /><div class="MainBottomFocus_Description">Ngày 13/03/2012 tại 18 Nguyễn Du, Hà Nội, Thứ trưởng Bộ TT&amp;TT Nguyễn Minh Hồng đã có buổi làm việc với Phòng Công nghiệp và Thương mại Việt Nam (VCCI) về việc xây dựng hệ thống đối thoại giữa chính quyền địa phương và doanh nghiệp thông qua ứng dụng Công nghệ thông tin(CNTT). Tham dự buổi làm việc có đại diện đến từ VCCI, Cục Ứng dụng Công nghệ thông tin -  Bộ TT&amp;TT và Công ty chứng thực chữ ký số CKCA.</div></td></tr><tr><td colspan="2">

<img src="/Style Library/Imagesnew/MIC/line.jpg" border="0" width="499px" height="1px" />
</td></tr></table>
<div class="MainBottomNormal1">
<img width="3" hspace="5" height="3" align="absmiddle" src="../../Style Library/Imagesnew/MIC/icon_01.jpg"><a href='/tintucsukien/tinhoatdongcuabo/Trang/Dựkiếntiêuchícôngtrìnhviễnthôngquantrọngliênquanđếnanninhquốcgia.aspx' class="MainBottomNormal_Header">Dự kiến tiêu chí công trình viễn thông quan trọng liên quan đến an ninh quốc gia</a> <span class="MainBottomNormal_Created">(13/03/2012)</span></div><div class="MainBottomNormal1">
<img width="3" hspace="5" height="3" align="absmiddle" src="../../Style Library/Imagesnew/MIC/icon_01.jpg"><a href='/tintucsukien/tinhoatdongcuabo/Trang/TrườngCaođẳngCôngnghiệpinthôngbáotuyểnsinh.aspx' class="MainBottomNormal_Header">Trường Cao đẳng Công nghiệp in thông báo tuyển sinh năm 2012</a> <span class="MainBottomNormal_Created">(10/03/2012)</span></div>
</td>
<td width="1" bgcolor="#CCCCCC"><img width="1" height="1" src="../../Style Library/Imagesnew/MIC/1x1.gif"></td>

<td>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<img src="images/20120308_b2.jpg" alt="" align="left" hspace="10" vspace="1" width="66px" /><a href='/tintucsukien/tinhoatdongcuabo/Trang/QuảnlýcácchươngtrìnhkhuyếnmãicủacácDoanhnghiệpViễnthông.aspx' class="MainBottomFocus_Header">Quản lý các chương trình khuyến mãi của các Doanh nghiệp Viễn thông</a></td></tr><tr><td valign="top" width="100%">

</td></tr></table>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<img src="images/20120305_u1.jpg" alt="" align="left" hspace="10" vspace="1" width="66px" /><a href='/tintucsukien/tinhoatdongcuabo/Trang/ThứtrưởngNguyễnMinhHồnglàmviệcvớiĐoàngiámsátcủaWBvềDựánpháttriểnCNTT-TTtạiVN.aspx' class="MainBottomFocus_Header">Thứ trưởng Nguyễn Minh Hồng làm việc với Đoàn giám sát của WB về Dự án phát triển CNTT-TT tại Việt Nam</a></td></tr><tr><td valign="top" width="100%">
</td></tr></table>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<img src="images/20120305_b2.jpg" alt="" align="left" hspace="10" vspace="1" width="66px" /><a href='/tintucsukien/tinhoatdongcuabo/Trang/ThanhtraBộThôngtinvàTruyềnthôngyêucầucácĐàiPTTHBáocáoviệcniêmyết,cungcấpthôngtingiá,cướckhiquảngcáodịchvụnộidungquatinnhắn.aspx' class="MainBottomFocus_Header">Thanh tra Bộ Thông tin và Truyền thông yêu cầu các Đài PTTH Báo cáo việc niêm yết, cung cấp thông tin giá, cước khi quảng cáo dịch vụ nội dung qua tin nhắn</a></td></tr><tr><td valign="top" width="100%">
</td></tr></table>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<img src="images/20120301T2.JPG" alt="" align="left" hspace="10" vspace="1" width="66px" /><a href='/tintucsukien/tinhoatdongcuabo/Trang/HọpbáoHộithảoQuốcgiavềChínhphủđiệntửlầnthứ10–2012.aspx' class="MainBottomFocus_Header">Hội thảo Quốc gia về Chính phủ điện tử lần thứ 10 năm 2012</a></td></tr><tr><td valign="top" width="100%">
</td></tr></table>
<div>&nbsp;</div><div style="text-align:right;">
<a class="XemTatCa" href='/tintucsukien/tinhoatdongcuabo/Trang/default.aspx'>Xem tất cả &gt;&gt;</a></div>

</td>
</tr>
</table>

</div>
<div id="main_tintuc_body_1">
<table cellpadding="0" cellspacing="0">
<tr>
<td style="width:65%">
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<a href='/tintucsukien/tintonghop/Trang/TổnghợpbáochíviếtvềngànhTTTTtuần10(từngày03-09032012).aspx' class="MainBottomFocus_Header1">Tổng hợp báo chí viết về ngành TT& TT tuần 10 (từ ngày 03-09/03/2012)</a><span class="MainBottomFocus_Created"> (02:34 CH 09/03/2012)</span></td></tr><tr><td valign="top" width="100%">
<img src="images/20120309_n3.jpg" alt="" align="left" hspace="10" vspace="1" width="200px" /><div class="MainBottomFocus_Description">Hoạt động của ngành TT&amp; TT được phản ánh trên các tờ báo điện tử tuần qua không nhiều. Nổi bật nhất là thông tin Thanh tra Bộ TT&amp; TT có công văn yêu cầu các đài truyền hình phải chấm dứt tình trạng “nhập nhèm” giá cước. Ngoài ra, có một số thông tin đáng được quan tâm như: Xử lý, thu hồi nhiều khoản tiền lớn tại Tập đoàn Viettel; Tiến hành Thanh tra Tập đoàn Bưu chính Viễn thông; TPHCM sử dụng phần mềm bảo mật của Bkav; Hà Nội: Vẫn còn đại lý Internet gần trường học; Thủ tướng yêu cầu đẩy nhanh tiến độ Dự án Phát triển CNTT-TT…</div></td></tr><tr><td colspan="2">

<img src="/Style Library/Imagesnew/MIC/line.jpg" border="0" width="499px" height="1px" />
</td></tr></table>
<div class="MainBottomNormal1">
<img width="3" hspace="5" height="3" align="absmiddle" src="../../Style Library/Imagesnew/MIC/icon_01.jpg"><a href='/tintucsukien/tintonghop/Trang/Côngnghệdiđộngthayđổicuộcsốngcủanôngdân.aspx' class="MainBottomNormal_Header">Công nghệ di động thay đổi cuộc sống của nông dân</a> <span class="MainBottomNormal_Created">(09/03/2012)</span></div><div class="MainBottomNormal1">
<img width="3" hspace="5" height="3" align="absmiddle" src="../../Style Library/Imagesnew/MIC/icon_01.jpg"><a href='/tintucsukien/tintonghop/Trang/WBthúccôngdânthếgiớithamgiagiảiphápICT.aspx' class="MainBottomNormal_Header">WB thúc công dân thế giới tham gia giải pháp ICT</a> <span class="MainBottomNormal_Created">(09/03/2012)</span></div>
</td>
<td width="1" bgcolor="#CCCCCC"><img width="1" height="1" src="../../Style Library/Imagesnew/MIC/1x1.gif"></td>
<td>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<img src="images/20120302_n2.bmp" alt="" align="left" hspace="10" vspace="1" width="66px" /><a href='/tintucsukien/tintonghop/Trang/TổnghợpbáochíviếtvềngànhTTTTtuần09(từngày2502-02032012).aspx' class="MainBottomFocus_Header">Tổng hợp báo chí viết về ngành TT&TT tuần 09 (từ ngày 25/02-02/03/2012)</a></td></tr><tr><td valign="top" width="100%">

</td></tr></table>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<img src="/tintucsukien/tintonghop/PublishingImages/20120305_b3.jpg" alt="" align="left" hspace="10" vspace="1" width="66px" /><a href='/tintucsukien/tintonghop/Trang/HộinghịBộtrưởngThôngtinASEANtạiMalaysia.aspx' class="MainBottomFocus_Header">Hội nghị Bộ trưởng Thông tin ASEAN tại Malaysia</a></td></tr><tr><td valign="top" width="100%">
</td></tr></table>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<img src="/tintucsukien/tintonghop/PublishingImages/usps.jpg" alt="" align="left" hspace="10" vspace="1" width="66px" /><a href='/tintucsukien/tintonghop/Trang/Mỹđóngcửamộtnửasốbưuđiệndothualỗ.aspx' class="MainBottomFocus_Header">Mỹ đóng cửa một nửa số bưu điện do thua lỗ</a></td></tr><tr><td valign="top" width="100%">
</td></tr></table>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<a href='/tintucsukien/tintonghop/Trang/ITUmuốndùngmạngdiđộngtoàncầuthếhệmới.aspx' class="MainBottomFocus_Header">ITU muốn dùng mạng di động toàn cầu thế hệ mới</a></td></tr><tr><td valign="top" width="100%">
</td></tr></table>
<div>&nbsp;</div><div style="text-align:right;">
<a class="XemTatCa" href='/tintucsukien/tintonghop/Trang/default.aspx'>Xem tất cả &gt;&gt;</a></div>

</td>
</tr>
</table>
</div>
<div id="main_tintuc_body_2">
<table cellpadding="0" cellspacing="0">
<tr>
<td style="width:65%">
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<a href='/tintucsukien/tindiaphuong/Trang/SởTTTTQuảngTrịgiaobanbáochítháng1-22012.aspx' class="MainBottomFocus_Header1">Sở TT&TT Quảng Trị giao ban báo chí tháng 1-2/2012</a><span class="MainBottomFocus_Created"> (10:03 SA 12/03/2012)</span></td></tr><tr><td valign="top" width="100%">
<img src="images/20120312_b1.jpg" alt="" align="left" hspace="10" vspace="1" width="200px" /><div class="MainBottomFocus_Description">Ngày 7/3/2012, Sở Thông tin và Truyền thông Quảng Trị chủ trì, phối hợp với Ban Tuyên giáo Tỉnh uỷ và Hội Nhà báo Việt Nam tỉnh tổ chức Hội nghị giao ban báo chí tháng 1 và tháng 2 năm 2012.</div></td></tr><tr><td colspan="2">

<img src="/Style Library/Imagesnew/MIC/line.jpg" border="0" width="499px" height="1px" />
</td></tr></table>
<div class="MainBottomNormal1">
<img width="3" hspace="5" height="3" align="absmiddle" src="../../Style Library/Imagesnew/MIC/icon_01.jpg"><a href='/tintucsukien/tindiaphuong/Trang/SởTTTTNghệAntổchứcHộinghịcánbộcôngchứcnăm2012.aspx' class="MainBottomNormal_Header">Sở TT&TT Nghệ An tổ chức Hội nghị cán bộ công chức năm 2012</a> <span class="MainBottomNormal_Created">(12/03/2012)</span></div><div class="MainBottomNormal1">
<img width="3" hspace="5" height="3" align="absmiddle" src="../../Style Library/Imagesnew/MIC/icon_01.jpg"><a href='/tintucsukien/tindiaphuong/Trang/ĐắkLắkHộinghịgiaobanbáochítháng2năm2012.aspx' class="MainBottomNormal_Header">Đắk Lắk: Hội nghị giao ban báo chí tháng 2 năm 2012</a> <span class="MainBottomNormal_Created">(08/03/2012)</span></div>
</td>
<td width="1" bgcolor="#CCCCCC"><img width="1" height="1" src="../../Style Library/Imagesnew/MIC/1x1.gif"></td>
<td>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">

<a href='/tintucsukien/tindiaphuong/Trang/SởThôngtinvàTruyềnthôngTiềnGiangduytrìchứngnhậntiêuchuẩnISO90012008.aspx' class="MainBottomFocus_Header">Sở Thông tin và Truyền thông Tiền Giang duy trì chứng nhận tiêu chuẩn ISO 9001:2008</a></td></tr><tr><td valign="top" width="100%">
</td></tr></table>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<img src="images/20120305_b5.jpg" alt="" align="left" hspace="10" vspace="1" width="66px" /><a href='/tintucsukien/tindiaphuong/Trang/ĐồngThápHộinghịGiaobanBáochítháng022012.aspx' class="MainBottomFocus_Header">Đồng Tháp: Hội nghị Giao ban Báo chí tháng 02/2012</a></td></tr><tr><td valign="top" width="100%">
</td></tr></table>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<img src="images/20120301_b1.jpg" alt="" align="left" hspace="10" vspace="1" width="66px" /><a href='/tintucsukien/tindiaphuong/Trang/SởTTTTVĩnhLonggiaobanquảntrịmạng.aspx' class="MainBottomFocus_Header">Sở TT&TT Vĩnh Long giao ban quản trị mạng</a></td></tr><tr><td valign="top" width="100%">
</td></tr></table>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<img src="images/20120228_b1.jpg" alt="" align="left" hspace="10" vspace="1" width="66px" /><a href='/tintucsukien/tindiaphuong/Trang/NgànhTTTTNghệAntriểnkhaicôngtácPCLBTKCNnăm2012.aspx' class="MainBottomFocus_Header">Ngành TT&TT Nghệ An triển khai công tác PCLB&TKCN năm 2012</a></td></tr><tr><td valign="top" width="100%">

</td></tr></table>
<div>&nbsp;</div><div style="text-align:right;">
<a class="XemTatCa" href='/tintucsukien/tindiaphuong/Trang/default.aspx'>Xem tất cả &gt;&gt;</a></div>

</td>
</tr>
</table>
</div>
<div id="main_tintuc_body_3">
<table cellpadding="0" cellspacing="0">
<tr>
<td style="width:65%">
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<a href='/tintucsukien/tintuctrongnganh/Trang/TPHCMtriểnkhaigiảipháptổngthểchốngvirus.aspx' class="MainBottomFocus_Header1">TP.HCM triển khai giải pháp tổng thể chống virus</a><span class="MainBottomFocus_Created"> (01:11 CH 09/03/2012)</span></td></tr><tr><td valign="top" width="100%">

<img src="/tintucsukien/tintuctrongnganh/PublishingImages/20120309_b1.jpg" alt="" align="left" hspace="10" vspace="1" width="200px" /><div class="MainBottomFocus_Description">Vượt qua các nhà sản xuất phần mềm diệt virus của nước ngoài, Công ty Bkav vừa thắng gói thầu cung cấp Giải pháp tổng thể phòng chống virus Bkav Endpoint Enterprise cho hệ thống các cơ quan hành chính tại Thành phố Hồ Chí Minh.</div></td></tr><tr><td colspan="2">
<img src="/Style Library/Imagesnew/MIC/line.jpg" border="0" width="499px" height="1px" />
</td></tr></table>
<div class="MainBottomNormal1">
<img width="3" hspace="5" height="3" align="absmiddle" src="../../Style Library/Imagesnew/MIC/icon_01.jpg"><a href='/tintucsukien/tintuctrongnganh/Trang/NhiếpảnhgiaMỹvàcácphóngviênảnhTTTTtraođổinghiệpvụ.aspx' class="MainBottomNormal_Header">Nhiếp ảnh gia Mỹ và các phóng viên ảnh TT&TT trao đổi nghiệp vụ</a> <span class="MainBottomNormal_Created">(07/03/2012)</span></div><div class="MainBottomNormal1">
<img width="3" hspace="5" height="3" align="absmiddle" src="../../Style Library/Imagesnew/MIC/icon_01.jpg"><a href='/tintucsukien/tintuctrongnganh/Trang/EricssonquảnlýtrungtâmthôngtinMobiFone.aspx' class="MainBottomNormal_Header">Ericsson quản lý trung tâm thông tin MobiFone</a> <span class="MainBottomNormal_Created">(01/03/2012)</span></div>
</td>
<td width="1" bgcolor="#CCCCCC"><img width="1" height="1" src="../../Style Library/Imagesnew/MIC/1x1.gif"></td>

<td>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<a href='/tintucsukien/tintuctrongnganh/Trang/Viettelchitới2000tỷđồngnămchohoạtđộngnghiêncứu.aspx' class="MainBottomFocus_Header">Viettel chi tới 2.000 tỷ đồng/năm cho hoạt động nghiên cứu</a></td></tr><tr><td valign="top" width="100%">
</td></tr></table>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<a href='/tintucsukien/tintuctrongnganh/Trang/Sẽcắthợpđồngthuêbaođăngkýsaithôngtin.aspx' class="MainBottomFocus_Header">Sẽ cắt hợp đồng thuê bao đăng ký sai thông tin</a></td></tr><tr><td valign="top" width="100%">
</td></tr></table>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<img src="images/20120221_n1.jpg" alt="" align="left" hspace="10" vspace="1" width="66px" /><a href='/tintucsukien/tintuctrongnganh/Trang/MạngViệtNamgovnđạtmốc12triệuthànhviên.aspx' class="MainBottomFocus_Header">Mạng Việt Nam "go.vn" đạt mốc 12 triệu thành viên</a></td></tr><tr><td valign="top" width="100%">
</td></tr></table>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<a href='/tintucsukien/tintuctrongnganh/Trang/Cắtdịchvụnếutrảtrướckhôngđăngkýlạithôngtin.aspx' class="MainBottomFocus_Header">Cắt dịch vụ nếu trả trước không đăng ký lại thông tin</a></td></tr><tr><td valign="top" width="100%">
</td></tr></table>

<div>&nbsp;</div><div style="text-align:right;">
<a class="XemTatCa" href='/tintucsukien/tintuctrongnganh/Trang/default.aspx'>Xem tất cả &gt;&gt;</a></div>

</td>
</tr>
</table>
</div>
<div id="main_tintuc_body_4">
<table cellpadding="0" cellspacing="0">
<tr>
<td style="width:65%">

<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<a href='/tintucsukien/vanbanqpplmoibanhanh/Trang/Quyđịnhmớivềđấugiá,chuyểnnhượngquyềnsửdụngtầnsốvôtuyếnđiện.aspx' class="MainBottomFocus_Header1">Quy định mới về đấu giá, chuyển nhượng quyền sử dụng tần số vô tuyến điện</a><span class="MainBottomFocus_Created"> (09:55 SA 14/03/2012)</span></td></tr><tr><td valign="top" width="100%">

<div class="MainBottomFocus_Description"><p>Thủ tướng Chính phủ vừa ban hành Quyết định số <a href="/vbqppl/Lists/Vn%20bn%20QPPL/DispForm.aspx?ID=7814">16/2012/QĐ-TTg </a>quy định về đấu giá, chuyển nhượng quyền sử dụng tần số vô tuyến điện. Theo văn bản này, để được sử dụng tần số vô tuyến điện, chuyển nhượng quyền sử dụng tần số vô tuyến điện, doanh nghiệp phải tham gia đấu giá.</p></div></td></tr><tr><td colspan="2">
<img src="/Style Library/Imagesnew/MIC/line.jpg" border="0" width="499px" height="1px" />
</td></tr></table>
<div class="MainBottomNormal1">
<img width="3" hspace="5" height="3" align="absmiddle" src="../../Style Library/Imagesnew/MIC/icon_01.jpg"><a href='/tintucsukien/vanbanqpplmoibanhanh/Trang/Cơquanđượcgiaothựchiệnchứcnăngthanhtrachuyênngành.aspx' class="MainBottomNormal_Header">Cơ quan được giao thực hiện chức năng thanh tra chuyên ngành</a> <span class="MainBottomNormal_Created">(13/02/2012)</span></div><div class="MainBottomNormal1">
<img width="3" hspace="5" height="3" align="absmiddle" src="../../Style Library/Imagesnew/MIC/icon_01.jpg"><a href='/tintucsukien/vanbanqpplmoibanhanh/Trang/BộTTTTcôngbốdanhmụcvănbảnquyphạmphápluậtvềthôngtinvàtruyềnthônghếthiệulựcthihành.aspx' class="MainBottomNormal_Header">Bộ TT& TT công bố một số văn bản quy phạm pháp luật về TT&TT hết hiệu lực thi hành</a> <span class="MainBottomNormal_Created">(06/02/2012)</span></div>

</td>
<td width="1" bgcolor="#CCCCCC"><img width="1" height="1" src="../../Style Library/Imagesnew/MIC/1x1.gif"></td>
<td>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<img src="/tintucsukien/vanbanqpplmoibanhanh/PublishingImages/2011113-u1.jpg" alt="" align="left" hspace="10" vspace="1" width="66px" /><a href='/tintucsukien/vanbanqpplmoibanhanh/Trang/BộTTTTBanhànhChỉthịvềtổchứcđónTếtNguyênđánNhâmThìnnăm2012.aspx' class="MainBottomFocus_Header">Bộ TT&TT Ban hành Chỉ thị về tổ chức đón Tết Nguyên đán Nhâm Thìn năm 2012</a></td></tr><tr><td valign="top" width="100%">
</td></tr></table>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<img src="images/20111229_a1.jpg" alt="" align="left" hspace="10" vspace="1" width="66px" /><a href='/tintucsukien/vanbanqpplmoibanhanh/Trang/BộtrưởngBộTTTTbanhànhChỉthịvềcôngtácthiđua,khenthưởngnăm2012.aspx' class="MainBottomFocus_Header">Bộ trưởng Bộ TT&TT ban hành Chỉ thị về công tác thi đua, khen thưởng năm 2012</a></td></tr><tr><td valign="top" width="100%">
</td></tr></table>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<img src="/tintucsukien/vanbanqpplmoibanhanh/PublishingImages/20120105_b1.jpg" alt="" align="left" hspace="10" vspace="1" width="66px" /><a href='/tintucsukien/vanbanqpplmoibanhanh/Trang/BộTTTTchỉthịvềviệcngănchặntinnhắnrác,tinnhắnlừađảotrongdịptết,lễhội2012.aspx' class="MainBottomFocus_Header">Bộ TT&TT chỉ thị về việc ngăn chặn tin nhắn rác, tin nhắn lừa đảo trong dịp tết, lễ hội 2012</a></td></tr><tr><td valign="top" width="100%">

</td></tr></table>
<table cellpadding="3" cellspacing="0" border="0" width="100%"><tr><td valign="top">
<a href='/tintucsukien/vanbanqpplmoibanhanh/Trang/QuyếtđịnhvềviệckiệntoànHộiđồngThiđua-KhenthưởngBộThôngtinvàTruyềnthông.aspx' class="MainBottomFocus_Header">Quyết định về việc kiện toàn Hội đồng Thi đua - Khen thưởng Bộ Thông tin và Truyền thông</a></td></tr><tr><td valign="top" width="100%">
</td></tr></table>
<div>&nbsp;</div><div style="text-align:right;">
<a class="XemTatCa" href='/tintucsukien/vanbanqpplmoibanhanh/Trang/default.aspx'>Xem tất cả &gt;&gt;</a></div>

</td>
</tr>
</table>
</div>
</div>

<br />
<table cellpadding="0" cellspacing="0">
<tr style="background-image:url('/Style Library/Imagesnew/MIC/bgr_menu1.jpg');height:35px;">
				<td height="35px" >
					<table cellspacing="0" cellpadding="0" width="30%" border="0" id="main_tintuc_title_0">
							<tr style="height:35px;">
								<td class="main_tintuc_box_title_selected_lefttitle">
								<img alt="" src="/_layouts/images/blank.gif" width="7px" height="28px" /></td>
								<td align="center" class="main_tintuc_box_selected_title">
								<a>TIN VIDEO</a></td>

								<td class="main_tintuc_box_title_selected_righttitle">
								<img alt="" src="/_layouts/images/blank.gif" width="7px" height="28px" /></td>
							</tr>
							
						</table>
				</td>
				<td>&nbsp;</td>
				<td style="background-image:url('/Style Library/Imagesnew/MIC/bgr_menu1.jpg');height:35px;"></td>
</tr>
<tr>
	<td colspan="4" height="3" bgcolor="#0864a6"><img width="1" height="1" src="../../Style Library/Imagesnew/MIC/1x1.gif"></td>

 </tr>	
<tr>
				<td style="width:65%;">
				
				<table width="100%" cellspacing="0" cellpadding="3" border="0"><tbody>
<tr><td valign="top"><a class="MainBottomFocus_Header1" href="/ShowVideo.aspx?ID=149">Họp Hội đồng giám đốc CNTT của cơ quan nhà nước các tỉnh, thành phố trực thuộc TW</a></td></tr>
<tr><td align="center">
<embed height="380" width="444" flashvars="width=444&height=380&file=/Qun l media/Hoi dong CIO cac co quan nha nuoc, cac tinh thanh truc thuoc TW.flv&image=/PublishingImages/20120228-h1.jpg" wmode="transparent" allowfullscreen="true" allowscriptaccess="always" quality="high" name="MediaPlayer" id="MediaPlayer" style="" src="/mediaplayer.swf" type="application/x-shockwave-flash" />
<br /> &nbsp; &nbsp;<a href="/Qun%20l%20media/Hoi%20dong%20CIO%20cac%20co%20quan%20nha%20nuoc,%20cac%20tinh%20thanh%20truc%20thuoc%20TW.wmv">Download video</a>
</TD></TR>
<tr><td></td></tr>

</TBODY></TABLE>

				</td>
				<td width="1" bgcolor="#CCCCCC"><img width="1" height="1" src="../../Style Library/Imagesnew/MIC/1x1.gif"></td>
<td>

<div class="MainBottomNormalvideo"><img src="/PublishingImages/20120228-h1.jpg" alt="" align="left" hspace="10" width="66px" style="float:left;" />
<a class="MainBottomNormal_Header" href="/ShowVideo.aspx?ID=149">Họp Hội đồng giám đốc CNTT của cơ quan nhà nước các tỉnh, thành phố trực thuộc TW</a>
 <span class="MainBottomNormal_Created">(01/03/2012)</span></div>
<img width="234" height="1" src="images/line2.jpg">
<div class="MainBottomNormalvideo"><img src="/PublishingImages/20120229-H1.jpg" alt="" align="left" hspace="10" width="66px" style="float:left;" />
<a class="MainBottomNormal_Header" href="/ShowVideo.aspx?ID=147">Sở TT&TT Hà Nội trao giải thưởng ứng dụng CNTT và ra mắt Trung tâm dữ liệu TP Hà Nội</a>

 <span class="MainBottomNormal_Created">(29/02/2012)</span></div>
<img width="234" height="1" src="images/line2.jpg">
<div class="MainBottomNormalvideo"><img src="images/20120224_a1.jpg" alt="" align="left" hspace="10" width="66px" style="float:left;" />
<a class="MainBottomNormal_Header" href="/ShowVideo.aspx?ID=145">Hội nghị tổng kết thi đua khen thưởng Phát thanh, Truyền hình năm 2011</a>
 <span class="MainBottomNormal_Created">(25/02/2012)</span></div>
<img width="234" height="1" src="images/line2.jpg">
<div class="MainBottomNormalvideo"><img src="/PublishingImages/TTLL_h1.jpg" alt="" align="left" hspace="10" width="66px" style="float:left;" />
<a class="MainBottomNormal_Header" href="/ShowVideo.aspx?ID=143">Thứ trưởng Bộ TT&TT Nguyễn Minh Hồng thăm và làm việc với Binh chủng Thông tin liên lạc</a>
 <span class="MainBottomNormal_Created">(17/02/2012)</span></div>

<img width="234" height="1" src="images/line2.jpg">
<div class="MainBottomNormalvideo"><img src="/PublishingImages/20120213-u1.jpg" alt="" align="left" hspace="10" width="66px" style="float:left;" />
<a class="MainBottomNormal_Header" href="/ShowVideo.aspx?ID=141">Hoàn thiện dự thảo Quy hoạch phát triển viễn thông quốc gia đến năm 2020  </a>
 <span class="MainBottomNormal_Created">(14/02/2012)</span></div>
<img width="234" height="1" src="images/line2.jpg">
<div>&nbsp;</div><div style="text-align:right;">
<a class="XemTatCa" href='/ShowVideo.aspx'>Xem tất cả &gt;&gt;</a></div>


</td>
</tr>
</table>

       
<table cellpadding="0" cellspacing="0" width="100%">

<tr>
 <td height="3" bgcolor="#aeaeaf"><img width="1" height="1" src="../../Style Library/Imagesnew/MIC/1x1.gif"></td>
 </tr>

             
<tr><td>
<table width="100%" cellspacing="1" cellpadding="8">
<tr style="background-image:url('../../Style Library/Imagesnew/MIC/bgr_2.jpg');">
<td width="33%" valign="top">

<table width="100%" cellpadding="0" cellspacing="0" border="0">

	<tr>
		<td id="MSOZoneCell_WebPartctl00_ctl15_MicNewAdBottom1" vAlign="top"><table TOPLEVEL border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td valign="top"><div WebPartID="6810e810-4954-4e8b-95db-94322086d5dc" HasPers="false" id="WebPartctl00_ctl15_MicNewAdBottom1" width="100%" class="ms-WPBody" allowDelete="false" allowExport="false" style="" ><table width="100%" cellspacing="0" cellpadding="0" border="0"> <tr><td valign="top"  bgcolor="#FFFFFF" align="center"><table width="220" cellspacing="0" cellpadding="4" border="0"><tbody><tr><td align='left'><span class="linkAdvertisement_Bottom"><a href="/ClickAdv.aspx?ID=2&amp;siteurl=%2F&amp;list=Qu%E1%BA%A3ng%20c%C3%A1o%20%C4%91%C3%A1y%20trang"><img alt="" border="0" src="/Style%20Library/Bannerbot/icon2.jpg" style="BORDER: 0px solid; "></a></span><span class="titleAd_Bottom">Tuyển dụng, tuyển sinh</span></td></tr></tbody></table></td></tbody></table><table width="100%" cellspacing="0" cellpadding="0" border="0"> <tr><td valign="top"  bgcolor="#FFFFFF" align="center"><table width="220" cellspacing="0" cellpadding="4" border="0"><tbody><tr><td align='left'><span class="linkAdvertisement_Bottom"><a href="/ClickAdv.aspx?ID=3&amp;siteurl=%2F&amp;list=Qu%E1%BA%A3ng%20c%C3%A1o%20%C4%91%C3%A1y%20trang"><img alt="" border="0" src="/Style%20Library/Bannerbot/icon3.jpg" style="BORDER: 0px solid; "></a></span><span class="titleAd_Bottom">Thông tin địa phương</span></td></tr></tbody></table></td></tbody></table><table width="100%" cellspacing="0" cellpadding="0" border="0"> <tr><td valign="top"  bgcolor="#FFFFFF" align="center"><table width="220" cellspacing="0" cellpadding="4" border="0"><tbody><tr><td align='left'><span class="linkAdvertisement_Bottom"><a href="/ClickAdv.aspx?ID=4&amp;siteurl=%2F&amp;list=Qu%E1%BA%A3ng%20c%C3%A1o%20%C4%91%C3%A1y%20trang"><img alt="" border="0" src="/Style%20Library/Bannerbot/icon4.jpg" style="BORDER: 0px solid; "></a></span><span class="titleAd_Bottom">Doanh nghiệp bưu chính, viễn thông, CNTT</span></td></tr></tbody></table></td></tbody></table><table width="100%" cellspacing="0" cellpadding="0" border="0"> <tr><td valign="top"  bgcolor="#FFFFFF" align="center"><table width="220" cellspacing="0" cellpadding="4" border="0"><tbody><tr><td align='left'><span class="linkAdvertisement_Bottom"><a href="/ClickAdv.aspx?ID=5&amp;siteurl=%2F&amp;list=Qu%E1%BA%A3ng%20c%C3%A1o%20%C4%91%C3%A1y%20trang"><img alt="" border="0" src="/Style%20Library/Bannerbot/icon5.jpg" style="BORDER: 0px solid; "></a></span><span class="titleAd_Bottom">Tổ chức, hiệp hội TT&TT</span></td></tr></tbody></table></td></tbody></table></div></td>
			</tr>

		</table></td>
	</tr>
</table>

</td>
<td width="34%" valign="top">

<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td id="MSOZoneCell_WebPartctl00_ctl15_MicNewAdBottom2" vAlign="top"><table TOPLEVEL border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td valign="top"><div WebPartID="b72a508e-14e8-47b5-ab81-2b6a62ddc6a9" HasPers="false" id="WebPartctl00_ctl15_MicNewAdBottom2" width="100%" class="ms-WPBody" allowDelete="false" allowExport="false" style="" ><table width="100%" cellspacing="0" cellpadding="0" border="0"> <tr><td valign="top"  bgcolor="#FFFFFF" align="center"><table width="220" cellspacing="0" cellpadding="4" border="0"><tbody><tr><td align='left'><span class="linkAdvertisement_Bottom"><a href="/ClickAdv.aspx?ID=1&amp;siteurl=%2F&amp;list=Qu%E1%BA%A3ng%20c%C3%A1o%20%C4%91%C3%A1y%20trang%201"><img alt="" border="0" src="/Style%20Library/Bannerbot/icon6.jpg" style="BORDER: 0px solid; "></a></span><span class="titleAd_Bottom">Điều tra thống kê toàn quốc phổ cập dịch vụ</span></td></tr></tbody></table></td></tbody></table><table width="100%" cellspacing="0" cellpadding="0" border="0"> <tr><td valign="top"  bgcolor="#FFFFFF" align="center"><table width="220" cellspacing="0" cellpadding="4" border="0"><tbody><tr><td align='left'><span class="linkAdvertisement_Bottom"><a href="/ClickAdv.aspx?ID=2&amp;siteurl=%2F&amp;list=Qu%E1%BA%A3ng%20c%C3%A1o%20%C4%91%C3%A1y%20trang%201"><img alt="" border="0" src="/Style%20Library/Bannerbot/icon7.jpg" style="BORDER: 0px solid; "></a></span><span class="titleAd_Bottom">Đưa Việt Nam sớm trở thành nước mạnh về CNTT-TT</span></td></tr></tbody></table></td></tbody></table><table width="100%" cellspacing="0" cellpadding="0" border="0"> <tr><td valign="top"  bgcolor="#FFFFFF" align="center"><table width="220" cellspacing="0" cellpadding="4" border="0"><tbody><tr><td align='left'><span class="linkAdvertisement_Bottom"><a href="/ClickAdv.aspx?ID=3&amp;siteurl=%2F&amp;list=Qu%E1%BA%A3ng%20c%C3%A1o%20%C4%91%C3%A1y%20trang%201"><img alt="" border="0" src="/Style%20Library/Bannerbot/icon8.jpg" style="BORDER: 0px solid; "></a></span><span class="titleAd_Bottom">Giới thiệu sản phẩm, dịch vụ ngành TT&TT</span></td></tr></tbody></table></td></tbody></table><table width="100%" cellspacing="0" cellpadding="0" border="0"> <tr><td valign="top"  bgcolor="#FFFFFF" align="center"><table width="220" cellspacing="0" cellpadding="4" border="0"><tbody><tr><td align='left'><span class="linkAdvertisement_Bottom"><a href="/ClickAdv.aspx?ID=4&amp;siteurl=%2F&amp;list=Qu%E1%BA%A3ng%20c%C3%A1o%20%C4%91%C3%A1y%20trang%201"><img alt="" border="0" src="/Style%20Library/Bannerbot/icon9.jpg" style="BORDER: 0px solid; "></a></span><span class="titleAd_Bottom">Trang Thông tin năng lực quản lý, đầu tư</span></td></tr></tbody></table></td></tbody></table></div></td>

			</tr>
		</table></td>
	</tr>
</table>

</td>
<td width="33%" valign="top">
 
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td id="MSOZoneCell_WebPartctl00_ctl15_MicNewAdBottom3" vAlign="top"><table TOPLEVEL border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>

				<td valign="top"><div WebPartID="6fd3d8a2-51a7-4138-bd18-88669163cadd" HasPers="false" id="WebPartctl00_ctl15_MicNewAdBottom3" width="100%" class="ms-WPBody" allowDelete="false" allowExport="false" style="" ><table width="100%" cellspacing="0" cellpadding="0" border="0"> <tr><td valign="top"  bgcolor="#FFFFFF" align="center"><table width="220" cellspacing="0" cellpadding="4" border="0"><tbody><tr><td align='left'><span class="linkAdvertisement_Bottom"><a href="/ClickAdv.aspx?ID=1&amp;siteurl=%2F&amp;list=Qu%E1%BA%A3ng%20c%C3%A1o%20%C4%91%C3%A1y%20trang%202"><img alt="" border="0" src="/Style%20Library/Bannerbot/icon10.jpg" style="BORDER: 0px solid; "></a></span><span class="titleAd_Bottom">Tiêu chuẩn, Chất lượng và Đánh giá phù hợp</span></td></tr></tbody></table></td></tbody></table><table width="100%" cellspacing="0" cellpadding="0" border="0"> <tr><td valign="top"  bgcolor="#FFFFFF" align="center"><table width="220" cellspacing="0" cellpadding="4" border="0"><tbody><tr><td align='left'><span class="linkAdvertisement_Bottom"><a href="/ClickAdv.aspx?ID=2&amp;siteurl=%2F&amp;list=Qu%E1%BA%A3ng%20c%C3%A1o%20%C4%91%C3%A1y%20trang%202"><img alt="" border="0" src="/Style%20Library/Bannerbot/icon11.jpg" style="BORDER: 0px solid; "></a></span><span class="titleAd_Bottom">Thông tin về chương trình nghiên cứu, đề tài khoa học</span></td></tr></tbody></table></td></tbody></table><table width="100%" cellspacing="0" cellpadding="0" border="0"> <tr><td valign="top"  bgcolor="#FFFFFF" align="center"><table width="220" cellspacing="0" cellpadding="4" border="0"><tbody><tr><td align='left'><span class="linkAdvertisement_Bottom"><a href="/ClickAdv.aspx?ID=3&amp;siteurl=%2F&amp;list=Qu%E1%BA%A3ng%20c%C3%A1o%20%C4%91%C3%A1y%20trang%202"><img alt="" border="0" src="/Style%20Library/Bannerbot/icon12.jpg" style="BORDER: 0px solid; "></a></span><span class="titleAd_Bottom">Thanh tra - Kiểm tra</span></td></tr></tbody></table></td></tbody></table><table width="100%" cellspacing="0" cellpadding="0" border="0"> <tr><td valign="top"  bgcolor="#FFFFFF" align="center"><table width="220" cellspacing="0" cellpadding="4" border="0"><tbody><tr><td align='left'><span class="linkAdvertisement_Bottom"><a href="/ClickAdv.aspx?ID=4&amp;siteurl=%2F&amp;list=Qu%E1%BA%A3ng%20c%C3%A1o%20%C4%91%C3%A1y%20trang%202"><img alt="" border="0" src="/PublishingImages/icon1.jpg" style="BORDER: 0px solid; "></a></span><span class="titleAd_Bottom">Lấy ý kiến nhân dân về dự thảo VBQPPL</span></td></tr></tbody></table></td></tbody></table></div></td>
			</tr>
		</table></td>
	</tr>
</table>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
     
</td></tr>

              
<tr><td>
<table width="100%" cellspacing="1" cellpadding="8">
<tr style="background-image:url('../../Style Library/Imagesnew/MIC/bgr_2.jpg');">
<td width="33%" valign="top">

<table width="100%" cellpadding="0" cellspacing="0" border="0">

	<tr>
		<td id="MSOZoneCell_WebPartctl00_ctl15_g_ca1c677e_54ff_4d87_a059_0100b4c9c4f0" vAlign="top"><table TOPLEVEL border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td valign="top"><div WebPartID="ca1c677e-54ff-4d87-a059-0100b4c9c4f0" HasPers="false" id="WebPartctl00_ctl15_g_ca1c677e_54ff_4d87_a059_0100b4c9c4f0" width="100%" class="ms-WPBody" allowDelete="false" allowExport="false" style="" ><span class="linkAdvertisement_Bottom"><a href="/ClickAdv.aspx?ID=9&amp;siteurl=%2F&amp;list=Danh%20s%C3%A1ch%20qu%E1%BA%A3ng%20c%C3%A1o%20%E1%BB%9F%20cu%E1%BB%91i%20trang"><img align="MIDDLE" alt="" border="0" src="/PublishingImages/bn_dv_cong.jpg" style="BORDER: 0px solid; "></a></span></div></td>
			</tr>
		</table><div class="ms-PartSpacingVertical"></div></td>
	</tr><tr>
		<td id="MSOZoneCell_WebPartWPQ2" vAlign="top"><table TOPLEVEL border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>

				<td valign="top"><div WebPartID="d622173f-dcc0-4399-98a6-2e3efe137ad4" HasPers="false" id="WebPartWPQ2" width="100%" class="ms-WPBody" allowDelete="false" style="" ><table width="235" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td></td></tr>
				<tr><td valign="top" background="/Style Library/Imagesnew/MIC/bgr_menu.jpg" height="25" class="text_h"><img align="absMiddle" width="21" hspace="5" height="20" src="/style%20library/images/mic/Phone-Icon.png">Số điện thoại đặc biệt</td></tr>
				<tr><td align="left" style="background-image:url('/style%20library/images/mic/forex_bgr.png');background-repeat:repeat-y;">
				<div style="padding:4px;">
				<table cellspacing="0" cellpadding="2" style="width:100%;" class="tigia">
				<tbody><tr><td class="tigia1" style="width: 168px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tên chức năng</td><td>Số ĐT</td></tr>
				<tr><td class="tigia1" style="width: 168px">Gọi tự động đi liên tỉnh</td><td>0</td></tr>

				<tr><td class="tigia1" style="width: 168px">Gọi tự động đi quốc tế</td><td>00</td></tr>
								<tr><td class="tigia1" style="width: 168px">Đăng ký đàm thoại quốc tế</td><td>110</td></tr>
				<tr><td class="tigia1" style="width: 168px">Công an</td><td>113</td></tr>
				<tr><td class="tigia1" style="width: 168px">Cứu hỏa</td><td>114</td></tr>
				<tr><td class="tigia1" style="width: 168px">Cấp cứu y tế</td><td>115</td></tr>

				<tr><td class="tigia1" style="width: 168px">Giải đáp số ĐT nội hạt</td><td>116</td></tr>
				</tbody></table>
				</div>
				</td></tr><tr><td align="left" bgcolor="#217abc"><img width="235" height="7" src="/style%20library/images/mic/r_bottom.jpg"></td></tr></tbody></table>
</div></td>
			</tr>
		</table></td>
	</tr>

</table>

</td>
<td width="34%" valign="top">

<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td id="MSOZoneCell_WebPartctl00_ctl15_g_66aed074_6849_4eb2_a89d_eaefc0ef151a" vAlign="top"><table TOPLEVEL border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td valign="top"><div WebPartID="66aed074-6849-4eb2-a89d-eaefc0ef151a" HasPers="false" id="WebPartctl00_ctl15_g_66aed074_6849_4eb2_a89d_eaefc0ef151a" width="100%" class="ms-WPBody" allowDelete="false" allowExport="false" style="" ><span class="linkAdvertisement_Bottom"><a href="/ClickAdv.aspx?ID=1&amp;siteurl=%2F&amp;list=Danh%20s%C3%A1ch%20qu%E1%BA%A3ng%20c%C3%A1o%20%E1%BB%9F%20cu%E1%BB%91i%20trang%201"><img alt="" border="0" src="/PublishingImages/banner_traloi_tt.jpg" style="BORDER: 0px solid; "></a></span></div></td>
			</tr>
		</table><div class="ms-PartSpacingVertical"></div></td>

	</tr><tr>
		<td id="MSOZoneCell_WebPartctl00_ctl15_g_4b9d1816_7964_474f_9826_a1ef7ddecf20" vAlign="top"><table TOPLEVEL border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td valign="top"><div WebPartID="4b9d1816-7964-474f-9826-a1ef7ddecf20" HasPers="false" id="WebPartctl00_ctl15_g_4b9d1816_7964_474f_9826_a1ef7ddecf20" width="100%" class="ms-WPBody" allowDelete="false" allowExport="false" style="" >
				<script type="text/javascript" language="javascript" src="http://vnexpress.net/Service/Gold_Content.js"></script>
				<TABLE border=0 cellSpacing=0 cellPadding=0 width=240><TBODY><TR><TD></TD></TR>
				<TR><TD class=text_h background='/Style Library/Imagesnew/MIC/bgr_menu.jpg' height=25 vAlign=top><IMG hspace=5 align=absMiddle src="/style%20library/images/mic/goldpriceIcon.png" width=21 height=20>Giá vàng trong nước</TD></TR>
				<TR><TD style="background-image:url('/style%20library/images/mic/giavang_bgr.png');background-repeat:repeat-y;" align="left">

				<div style="padding:4px;">
				<table class="tigia" style="width:100%;" cellpadding="2" cellspacing="0">
				<tr><td class="tigia1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td class="tigia1">Mua vào</td><td>Bán ra</td></tr>
				<tr><td class="tigia1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SBJ</td><td class="tigia1"><script>document.write(vGoldSbjBuy);</script></td><td><script>document.write(vGoldSbjSell);</script></td></tr>
				<tr><td class="tigia1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SJC</td><td class="tigia1"><script>document.write(vGoldSjcBuy);</script></td><td><script>document.write(vGoldSjcSell);</script></td></tr>

				</table>
				</div>
				</TD></TR><TR><TD bgColor=#217abc align=left><IMG src="/style%20library/images/mic/r_bottom.jpg" width=240 height=7></TD></TR></TBODY></TABLE>
				<div style="height: 4px"><img src="/_layouts/images/blank.gif" height="4px" /></div>
				</div></td>
			</tr>
		</table><div class="ms-PartSpacingVertical"></div></td>
	</tr><tr>
		<td id="MSOZoneCell_WebPartctl00_ctl15_g_dfcbd55d_22ee_453d_abc7_ebf0f35542b8" vAlign="top"><table TOPLEVEL border="0" cellpadding="0" cellspacing="0" width="100%">

			<tr>
				<td valign="top"><div WebPartID="dfcbd55d-22ee-453d-abc7-ebf0f35542b8" HasPers="false" id="WebPartctl00_ctl15_g_dfcbd55d_22ee_453d_abc7_ebf0f35542b8" width="100%" class="ms-WPBody" allowDelete="false" allowExport="false" style="" >
				<TABLE border=0 cellSpacing=0 cellPadding=0 width=235><TBODY><TR><TD></TD></TR>
				<TR><TD class=text_h background='/Style Library/Imagesnew/MIC/bgr_menu.jpg' height=25 vAlign=top><IMG hspace=5 align=absMiddle src="/style%20library/images/mic/cloud.png" width=21 height=20>Dự báo thời tiết</TD></TR>
				<TR><TD style="background-image:url('/style%20library/images/mic/weather_bgr.png');background-repeat:repeat-y;" align="left">
				<script>var coc_weather_hcmIcon='/Images/Weather/i_troinang.gif';var coc_weather_hcmT1='/Images/Weather/3.gif';var coc_weather_hcmT2='/Images/Weather/6.gif';var coc_weather_hcmTotal='<lable>Ít mây, trời nắng.</lable><lable> &#272;&#7897; &#7849;m 39%</lable>';</script>
				<script>var coc_weather_sonlaIcon='/Images/Weather/i_nhieumay.gif';var coc_weather_sonlaT1='/Images/Weather/2.gif';var coc_weather_sonlaT2='/Images/Weather/0.gif';var coc_weather_sonlaTotal='<lable>Nhiều mây, không mưa.</lable><lable> &#272;&#7897; &#7849;m 70%</lable>';</script>

				<script>var coc_weather_haiphongIcon='/Images/Weather/i_nhieumay.gif';var coc_weather_haiphongT1='/Images/Weather/1.gif';var coc_weather_haiphongT2='/Images/Weather/7.gif';var coc_weather_haiphongTotal='<lable>Nhiều mây, không mưa.</lable><lable> &#272;&#7897; &#7849;m 93%</lable>';</script>
				<script>var coc_weather_hanoiIcon='/Images/Weather/i_nhieumay.gif';var coc_weather_hanoiT1='/Images/Weather/1.gif';var coc_weather_hanoiT2='/Images/Weather/8.gif';var coc_weather_hanoiTotal='<lable>Nhiều mây, không mưa.</lable><lable> &#272;&#7897; &#7849;m 78%</lable>';</script>
				<script>var coc_weather_danangIcon='/Images/Weather/i_nhieumay.gif';var coc_weather_danangT1='/Images/Weather/2.gif';var coc_weather_danangT2='/Images/Weather/6.gif';var coc_weather_danangTotal='<lable>Nhiều mây, không mưa.</lable><lable> &#272;&#7897; &#7849;m 69%</lable>';</script>
				<script>var coc_weather_vinhIcon='/Images/Weather/i_nhieumay.gif';var coc_weather_vinhT1='/Images/Weather/1.gif';var coc_weather_vinhT2='/Images/Weather/8.gif';var coc_weather_vinhTotal='<lable>Nhiều mây, không mưa.</lable><lable> &#272;&#7897; &#7849;m 88%</lable>';</script>
				<script>var coc_weather_nhatrangIcon='/Images/Weather/i_nhieumay.gif';var coc_weather_nhatrangT1='/Images/Weather/2.gif';var coc_weather_nhatrangT2='/Images/Weather/9.gif';var coc_weather_nhatrangTotal='<lable>Nhiều mây, không mưa.</lable><lable> &#272;&#7897; &#7849;m 71%</lable>';</script>
				<script>var coc_weather_pleicuIcon='/Images/Weather/i_nhieumay.gif';var coc_weather_pleicuT1='/Images/Weather/3.gif';var coc_weather_pleicuT2='/Images/Weather/0.gif';var coc_weather_pleicuTotal='<lable>Nhiều mây, không mưa.</lable><lable> &#272;&#7897; &#7849;m 50%</lable>';</script>

				<div style="padding:5px">
				<select name="coc_weather" id="coc_weather" onchange="selectweather(this);">
				<option value='hcm'>TP Hồ Chí Minh</option>
				<option value='hanoi' selected=true>TP Hà Nội</option>
				<option value='danang'>TP Đà Nẵng</option>
				<option value='sonla'>Sơn La</option>
				<option value='haiphong'>Hải Phòng</option>

				<option value='vinh'>Vinh</option>
				<option value='nhatrang'>Nha Trang</option>
				<option value='pleicu'>Pleiku</option>
				</select>
				<div id="coc_main_weather">
				<img id="coc_img_weather_icon" src="" border="0" />
				<img id="coc_img_weather_t1" src="" border="0" />

				<img id="coc_img_weather_t2" src="" border="0" />
				<img id="coc_img_weather_t3" src="http://vnexpress.net/Images/Weather/c.gif" border="0" />
				<div id="coc_img_weather_total"></div>
				</div>
				</div>
				</TD></TR><TR><TD bgColor=#217abc align=left><IMG src="/style%20library/images/mic/weather_r_bottom.jpg" width=235 height=7></TD></TR></TBODY></TABLE>
				</div></td>

			</tr>
		</table></td>
	</tr>
</table>

</td>
<td width="33%" valign="top">
 
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td id="MSOZoneCell_WebPartctl00_ctl15_g_faafa6cd_218b_4b95_99aa_06ea85ba75a1" vAlign="top"><table TOPLEVEL border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>

				<td valign="top"><div WebPartID="faafa6cd-218b-4b95-99aa-06ea85ba75a1" HasPers="false" id="WebPartctl00_ctl15_g_faafa6cd_218b_4b95_99aa_06ea85ba75a1" width="100%" class="ms-WPBody" allowDelete="false" allowExport="false" style="" ><span class="linkAdvertisement_Bottom"><a href="/ClickAdv.aspx?ID=1&amp;siteurl=%2F&amp;list=Danh%20s%C3%A1ch%20qu%E1%BA%A3ng%20c%C3%A1o%20%E1%BB%9F%20cu%E1%BB%91i%20trang%202"><img alt="" border="0" src="/Style%20Library/Imagesnew/MIC/bn_diachi.jpg" style="BORDER: 0px solid; "></a></span></div></td>
			</tr>
		</table><div class="ms-PartSpacingVertical"></div></td>
	</tr><tr>
		<td id="MSOZoneCell_WebPartctl00_ctl15_g_39912e55_89e1_45a3_816d_28f43a6ec72d" vAlign="top"><table TOPLEVEL border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td valign="top"><div WebPartID="39912e55-89e1-45a3-816d-28f43a6ec72d" HasPers="false" id="WebPartctl00_ctl15_g_39912e55_89e1_45a3_816d_28f43a6ec72d" width="100%" class="ms-WPBody" allowDelete="false" allowExport="false" style="" ><script type="text/javascript" language="javascript" src="http://vnexpress.net/Service/Forex_Content.js"></script>
				<TABLE border=0 cellSpacing=0 cellPadding=0 width=235><TBODY><TR><TD></TD></TR>

				<TR><TD class=text_h background='/Style Library/Imagesnew/MIC/bgr_menu.jpg' height=25 vAlign=top><IMG hspace=5 align=absMiddle src="/style%20library/images/mic/forexIcon.png" width=21 height=20>Tỉ giá ngoại tệ</TD></TR>
				<TR><TD style="background-image:url('/style%20library/images/mic/forex_bgr.png');background-repeat:repeat-y;" align="left">
				<div style="padding:4px;">
				<table class="tigia" style="width:100%;" cellpadding="2" cellspacing="0">
				<tr><td class="tigia1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;USD</td><td><script>document.write(vCosts[0]);</script>0</td></tr>
				<tr><td class="tigia1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EUR</td><td><script>document.write(vCosts[8]);</script>0</td></tr>

				<tr><td class="tigia1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GBP</td><td><script>document.write(vCosts[1]);</script>0</td></tr>
				<tr><td class="tigia1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HKD</td><td><script>document.write(vCosts[2]);</script>0</td></tr>
				<tr><td class="tigia1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JPY</td><td><script>document.write(vCosts[4]);</script>0</td></tr>
				<tr><td class="tigia1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AUD</td><td><script>document.write(vCosts[5]);</script>0</td></tr>

				<tr><td class="tigia1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CAD</td><td><script>document.write(vCosts[6]);</script>0</td></tr>
				<tr><td class="tigia1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SGD</td><td><script>document.write(vCosts[7]);</script>0</td></tr>
				</table>
				</div>
				</TD></TR><TR><TD bgColor=#217abc align=left><IMG src="/style%20library/images/mic/r_bottom.jpg" width=235 height=7></TD></TR></TBODY></TABLE>
				</div></td>

			</tr>
		</table></td>
	</tr>
</table>

</td>
</tr>
</table>
</td>
</tr>
</table>
            
															</div>
														</div>

														
														
													</td>
													
													<td valign="top" style="padding-right: 4px; width: 220px; margin-left:10px;" class="noprint">
													<table cellspacing="0" cellpadding="0" border="0" width="210" style="margin-left: 1px; background-image :url('/Style Library/Imagesnew/mic/bgr_left.jpg');background-repeat:no-repeat;" class="style1">
															<tr>
																												
															
															<td height="25"  valign="top" class="text_h">
															THÔNG TIN TRUYỀN THÔNG</td>
														</tr>
														<tr>

															<td align="left" >
															<table cellspacing="1" cellpadding="1" border="0" width="200">
																<tr>
																	<td>
																	<table cellspacing="2" cellpadding="2" border="0" width="215" >
																		<tr>
																			<td width="30" valign="top">
																			&nbsp;</td>
																			<td width="186">

																			<a class="menu_r" href="/trang/baochi.aspx">
																			BÁO 
																			CHÍ</a></td>
																		</tr>
																	</table>
																	</td>
																</tr>
																<tr>
																	<td>

																	</td>
																</tr>
																<tr>
																	<td>
																	<table cellspacing="2" cellpadding="1" border="0" width="215" >
																		<tr>
																			<td width="30" valign="top">
																			&nbsp;</td>
																			<td width="186">

																			<a class="menu_r" href="/trang/xuatban.aspx">
																			XUẤT 
																			BẢN</a></td>
																		</tr>
																	</table>
																	</td>
																</tr>
																<tr>
																	<td>

																	</td>
																</tr>
																<tr>
																	<td>
																	<table cellspacing="2" cellpadding="1" border="0" width="215" >
																		<tr>
																			<td width="30" valign="top">
																			</td>
																			<td width="186">

																			<a class="menu_r" href="/trang/buuchinh.aspx">
																			BƯU 
																			CHÍNH</a>
																			</td>
																		</tr>
																	</table>
																	</td>
																</tr>
																<tr>

																	<td>
																	</td>
																</tr>
																<tr>
																	<td>
																	<table cellspacing="2" cellpadding="1" border="0" width="215" >
																		<tr>
																			<td width="30" valign="top">
																			&nbsp;</td>

																			<td width="186">
																			<a class="menu_r" href="/trang/vienthong.aspx">
																			VIỄN 
																			THÔNG</a>
																			</td>
																		</tr>
																	</table>
																	</td>
																</tr>

																<tr>
																	<td>
																	</td>
																</tr>
																<tr>
																	<td>
																	<table cellspacing="2" cellpadding="1" border="0" width="215" >
																		<tr>
																			<td width="30" valign="top">

																			&nbsp;</td>
																			<td width="186">
																			<a class="menu_r" href="/trang/cntt.aspx">
																			CÔNG 
																			NGHỆ 
																			THÔNG 
																			TIN</a>
																			</td>
																		</tr>
																	</table>
																	</td>

																</tr>
															</table>
															</td>
														</tr>
															<!--<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR><TD class="poll-title-td"><SPAN class="poll-title">Họp Hội đồng giám đốc CNTT của cơ quan nhà nước các tỉnh, thành phố trực thuộc TW</SPAN></TD></TR><TR><TD>
<embed height="220" width="222" flashvars="width=222&height=220&file=/Qun l media/Hoi dong CIO cac co quan nha nuoc, cac tinh thanh truc thuoc TW.flv&image=/PublishingImages/20120228-h1.jpg" wmode="transparent" allowfullscreen="true" allowscriptaccess="always" quality="high" name="MediaPlayer" id="MediaPlayer" style="" src="/mediaplayer.swf" type="application/x-shockwave-flash" />
</TD></TR>
</TBODY></TABLE>
<div style="scrollbar-arrow-color: blue; scrollbar-face-color: #e7e7e7; overflow-y: scroll; width: 100%; scrollbar-darkshadow-color: #888888; height: 100px; scrollbar-3dlight-color: #a0a0a0;">
<TABLE cellSpacing=0 cellPadding=0 width="206px"><TBODY>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=147'>
Sở TT&TT Hà Nội trao giải thưởng ứng dụng CNTT và ra mắt Trung tâm dữ liệu TP Hà Nội
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=145'>
Hội nghị tổng kết thi đua khen thưởng Phát thanh, Truyền hình năm 2011
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=143'>
Thứ trưởng Bộ TT&TT Nguyễn Minh Hồng thăm và làm việc với Binh chủng Thông tin liên lạc
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=141'>
Hoàn thiện dự thảo Quy hoạch phát triển viễn thông quốc gia đến năm 2020  
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=139'>
Ngành TT&TT chú trọng đẩy mạnh hoạt động ứng dụng CNTT trong năm 2012
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=137'>
Hội nghị Toàn quốc về Điểm Bưu điện – Văn hóa xã
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=135'>
Một số kết quả hoạt động của Bộ TT&TT năm 2011
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=133'>
Hội nghị triển khai nhiệm vụ năm 2012 Bộ Thông tin và Truyền thông
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=131'>
Cục Tần số vô tuyến điện triển khai công tác năm 2012
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=129'>
Lễ trao Giải thưởng Sách Việt Nam lần thứ 7
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=127'>
Bộ trưởng Bộ Thông tin Văn hoá và Du lịch nước CHDCND Lào thăm và làm việc tại Việt Nam
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=125'>
Đoàn Bộ Bưu chính Viễn thông Lào thăm và làm việc tại Việt Nam
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=123'>
Hội nghị các cơ quan chủ quản Nhà xuất bản
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=121'>
Hội nghị tập huấn nghiệp vụ kiểm soát thủ tục hành chính
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=119'>
Khai mạc Triển lãm về viễn thông, CNTT và Điện tử lớn nhất tại Việt Nam
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=117'>
Khai mạc Tuần lễ VNPT 2011 – “Trao nụ cười, nhận niềm tin”
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=115'>
Khởi động dự án "Nâng cao khả năng sử dụng máy tính và truy nhập Internet công cộng tại Việt Nam"
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=113'>
Trao tặng Kỷ niệm chương vì sự nghiệp TT&TT và Họp báo khởi động dự án “Nâng cao sử dụng máy tính và truy nhập Internet công cộng tại Việt Nam”
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=111'>
Khai trương phòng đo tương thích điện từ EMC
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=109'>
Tăng cường năng lực quản lý tương thích điện từ tại Việt Nam
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=107'>
Khai mạc Triển lãm Quốc tế Điện tử tiêu dùng và Tin học viễn thông lần thứ 2
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=105'>
Nâng cấp Trang Thông tin điện tử Bộ TT&TT hỗ trợ người khuyết tật
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=103'>
Đại hội Công đoàn cơ quan Bộ Thông tin và Truyền thông nhiệm kỳ 2011 – 2013
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=101'>
Hội nghị Ban chấp hành Đảng bộ Khối các cơ quan Trung ương lần thứ V
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=99'>
Hội nghị đánh giá 6 năm thi hành Luật Xuất bản
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=98'>
Hội nghị Tổng kết Điều tra thống kê hiện trạng phổ cập dịch vụ điện thoại, Internet và nghe – nhìn toàn quốc năm 2010
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=95'>
Kỷ niệm 137 năm ngày thành lập Liên minh Bưu chính Thế giới và Phát động cuộc thi viết thứ UPU lần thứ 41
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=93'>
Bộ TT&TT trao tặng sách ảnh “Đại tướng Tổng Tư lệnh Võ Nguyên Giáp” cho Gia đình Đại tướng Võ Nguyên Giáp
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=91'>
Bộ TT&TT trao tặng sách ảnh “Đại tướng Tổng Tư lệnh Võ Nguyên Giáp” cho Hội Cựu chiến binh Việt Nam
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=89'>
Hội thảo kết nối nông thôn vì giáo dục và phát triển của ASEAN
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=87'>
Việt Nam và An-giê-ri kí kết biên bản hợp tác trong lĩnh vực Bưu chính viễn thông và công nghệ thông tin
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=85'>
Viện Khoa học kỹ thuật bưu điện tổ chức Lễ kỷ niệm 45 năm ngày thành lập và đón nhận Huân chương Độc lập hạng Nhất
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=83'>
Đoàn công tác của Bộ TT&TT đến thăm và làm việc với Sở TT&TT Thái Nguyên
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=81'>
Đài PT-TH Thái Nguyên kỷ niệm ngày thành lập ngành Phát Thanh - Truyền hình, Báo điện tử và lên sóng vệ tinh VINASAT1 kênh TN1
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=80'>
Lễ công bố Quyết định thành lập Cục Viễn thông
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=77'>
Hội nghị phổ biến và giải đáp trực tiếp về Luật Bưu chính, Luật Viễn thông và Luật Tần số vô tuyến điện
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=75'>
Lễ bàn giao nhiệm vụ Bộ trưởng Bộ Thông tin và Truyền thông
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=73'>
Nguyên Bộ trưởng Lê Doãn Hợp phát biểu tại Lễ bàn giao nhiệm vụ Bộ trưởng Bộ Thông tin và Truyền thông
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=71'>
Bộ trưởng Bộ Thông tin, Văn hóa và Du lịch Cộng hòa dân chủ nhân dân Lào đến thăm và làm việc với Bộ TT&TT
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=69'>
Tổng thư ký Liên minh viễn thông quốc tế (ITU) Hamadoun Toure’ đến thăm và làm việc tại Việt Nam
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=67'>
Bộ trưởng Bộ TT&TT Lê Doãn Hợp thăm và làm việc với tỉnh Thái Nguyên
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=65'>
Bộ trưởng Lê Doãn Hợp đến thăm và làm việc với Trung ương Hội Nông dân Việt Nam
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=63'>
Công ty Thông tin di động - Mobifone đón nhận danh hiệu Anh hùng lao động
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=61'>
Đảng bộ Bộ TT&TT tổ chức Hội nghị học tập, quán triệt và triển khai thực hiện Nghị quyết Đại hội Đảng toàn quốc lần thứ XI của Đảng
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=59'>
Bộ TT&TT sơ kết công tác 6 tháng đầu năm và triển khai công tác 6 tháng cuối năm 2011
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=57'>
Doanh nghiệp thứ 6 được cấp giấy phép cung cấp dịch vụ chứng thực chữ ký số
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=55'>
Trao giải Báo chí Quốc gia lần thứ V năm 2010
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=53'>
Lễ trao giải báo chí Thông tin và Truyền thông lần thứ 7 năm 2010
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=51'>
Bộ TT&TT trao tặng “Máy tính cho cuộc sống” cho Hội Cựu chiến binh Việt Nam
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=49'>
Bộ trưởng Bộ TT&TT Lê Doãn Hợp thăm và làm việc với Tổng cục xây dựng lực lượng công an nhân dân
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=47'>
Khai mạc Hội nghị viễn thông quốc tế Việt Nam năm 2011
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=45'>
Bộ trưởng Lê Doãn Hợp đến thăm và làm việc với Hội Cựu chiến binh Việt Nam
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=43'>
Đoàn công tác Bộ Thông tin và Truyền thông thăm và làm việc với Tổng Liên đoàn Lao động Việt Nam
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=41'>
Bộ Thông tin và Truyền thông thăm và làm việc với Trung ương Đoàn thanh niên cộng sản Hồ Chí Minh
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=40'>
Lễ tổng kết và trao giải cuộc thi viết thư quốc tế UPU lần thứ 40 của Việt Nam
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=37'>
Khai mạc Diễn đàn chính sách và thể lệ APT lần thứ 11
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=35'>
Bộ trưởng Bộ TT&TT Lê Doãn Hợp thăm và làm việc với Trường Đại học FPT
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=32'>
Đoàn công tác Bộ TT&TT đến thăm và làm việc với Tổng cục Chính trị Quân đội nhân dân Việt Nam
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=30'>
Lễ trao giải thưởng CNTT-TT năm 2010 (VICTA 2010)
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=28'>
Công nghệ thông tin - Nền tảng để phát triển đất nước
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=27'>
10 Sự kiện Ngành Thông tin và Truyền thông năm 2010
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=25'>
Giới thiệu chương trình Nhân vật sự kiện TT&TT tháng 11 năm 2010
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=24'>
Giới thiệu Nhân vật sự kiện Thông tin và Truyền thông tháng 10 năm 2010
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=22'>
Nhân vật sự kiện Thông tin và Truyền thông số 16 năm 2010
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=20'>
Phong trào thi đua yêu nước và Công tác thi đua khen thưởng Ngành TT&TT 2006-2010
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=16'>
Hướng dẫn điều tra thống kê Hiện trạng phổ cập dịch vụ điện thoại, Internet và nghe nhìn toàn quốc 2010
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=15'>
Hướng dẫn điều tra thống kê Hiện trạng phổ cập dịch vụ điện thoại, Internet và nghe nhìn toàn quốc 2010
</a></SPAN></TD></TR>
<TR><TD class="poll-title-td"><img src="/Style Library/Images/Mic/white_image.PNG" width="2" heigth="2" /><SPAN class="poll-title" style="font-size:10px;">
<a href='/ShowVideo.aspx?ID=9'>
10 Sự kiện nổi bật Ngành Thông tin và Truyền thông năm 2009
</a></SPAN></TD></TR>
</TBODY></TABLE>
</div>
-->
														
													</table>
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
					
				
 
	<script type="text/javascript">
	$(function(){
		$('.menu-nav li').hover(function(){
			$(this).addClass('current');
		},
		function(){
			$(this).removeClass('current');
		});
	});
	</script>
	</body>
</html>
