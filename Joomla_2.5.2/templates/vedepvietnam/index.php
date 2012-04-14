<?php
/**
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/* The following line loads the MooTools JavaScript Library */
JHtml::_('behavior.framework', true);

/* The following line gets the application object for things like displaying the site name */
$app = JFactory::getApplication();
$option	= JRequest::GetCmd('option', '', 'GET');
$view	= JRequest::GetCmd('view', '', 'GET');
?>
<?php echo '<?'; ?>xml version="1.0" encoding="<?php echo $this->_charset ?>"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
	<head>
		<!-- The following JDOC Head tag loads all the header and meta information from your site config and content. -->
		<jdoc:include type="head" />

		<!-- The following five lines load the Blueprint CSS Framework (http://blueprintcss.org). If you don't want to use this framework, delete these lines. -->
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/styles.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/styleclassic.css" type="text/css" />
		<!--[if lt IE 8]><link rel="stylesheet" href="blueprint/ie.css" type="text/css" /><![endif]-->
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/core.css" type="text/css" />
    	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/shadowbox.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/page.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/fixstyle.css" type="text/css" />

		<!-- The following line loads the template JavaScript file located in the template folder. It's blank by default. -->
		<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.accordion.js"></script>
	</head>
	<body style="padding: 0px; margin: 0px;">
   
    <div style="clear: both; width: 100%;">
		<div class="pageBdy">
			<div class="itemtop">
				<span class="fontsize12 color3" style="line-height: 28px; padding-left: 10px; float: left;">ISSN 1859 - 1094</span> 
				<a class="defautlhome fontsize12 color10" href="javascript:setHomepage();" style="float: left;">�?t l�m trang ch?</a> 
				<span class="fontsize12 color10" style="padding: 0px 5px 0px 5px; float: left;">|</span>
				<a class="aNewsletter fontsize12 color10" href="http://chuyentrang.tuoitre.vn/Newsletter/" target="_blank">Newsletter</a>
				<span class="fontsize12 color10" style="padding: 0px 5px 0px 5px; float: left;">|</span> 
				<a class="MobileWeb fontsize12 color10" href="http://mobi.tuoitre.vn/" target="_blank">Mobile Web</a>
				<span class="fontsize12 color10" style="padding: 0px 5px 0px 5px; float: left;">|</span>
				<a class="iconrss fontsize12 color10" href="http://tuoitre.vn/Rss/Index.html">Rss</a>
				<a class="icontuoitretop" href="http://tuoitre.vn/Tuoi-tre-cuoi-tuan/index.html">&nbsp;</a> 
				<a class="icontuoitrecuoi" href="http://chuyentrang.tuoitre.vn/TTC/" target="_blank">&nbsp;</a>
				<a class="iconAotrang" href="http://tuoitre.vn/Ao-trang/Index.html">&nbsp;</a>
				<a class="iconVietnews" href="http://tuoitrenews.vn" target="_blank">&nbsp;</a>
				<a class="iconTTMobile" href="http://m.tuoitre.vn" target="_blank">&nbsp;</a>
			</div>
			<div id="header">
            <div class="logo">
                <a href="http://tuoitre.vn">
                    <img style="border: 0px; width: 225px; height: 97px;" src="http://tuoitre.vn/images/trans.gif"
                        alt="" />
                </a>
            </div>
            <div class="boxQcTop">
                
			<div class="QCIframe">
			    <div style="clear:both;width:100%;">
			        <iframe src="http://s.tuoitre.vn/TTO/Home/Top.html" scrolling="no" align="left" width='752' height='85' frameborder="0" marginheight="0" marginwidth="0"></iframe>
			    </div>
			</div>
            </div>
            
			<script type="text/javascript">
				jQuery(function () {
					jQuery("ul#MainMnu li").hover(function () {
						jQuery(this).addClass("hover");
						jQuery('div#mnu', this).css('visibility', 'visible');
					}, function () {

						jQuery(this).removeClass("hover");
						jQuery('div#mnu', this).css('visibility', 'hidden');
					});
				});      
			</script>
			

<div id="mnu_10_child" style="display: none; height: 27px; overflow: hidden;" class="boxMnuSub">
    <div style="width: 992px; float: left; height: 27px; overflow: hidden;">
        <span class="floatLeft fontsize12 color10" style="line-height: 27px; padding-left: 0px;">
            <script type="text/javascript">                writeTime('2012/04/05 22:30:29')</script>
        </span>
        <div style="height: 27px; width: 665px; float: left; overflow: hidden; padding-left: 10px;">
            <div style="width: 80px; float: left; overflow: hidden; line-height: 27px;">
                <b>Tin m?i nh?n: </b>
            </div>
            <div style="width: 385px; float: left; overflow: hidden; line-height: 27px;">
                

<div id="canadaprovinces" class="glidecontentwrapper" style="border:none;overflow:hidden;">    
       
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-xa-hoi/Phap-luat/485724/Vu-ky-su-Tach-Chua-tuyen-an-vi�-phuc-tap.html">
                    V? k? su T?ch: Chua tuy�n �n v� ph?c t?p
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-xa-hoi/Phap-luat/485723/Bat-bang-doi-no-thue-nguoi-Dai-Loan.html">
                    B?t bang d�i n? thu� ngu?i ��i Loan
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/The-gioi/485722/Philippines-de-nghi-to-chuc-hoi-nghi-ve-Truong-Sa.html">
                    Philippines d? ngh? t? ch?c h?i ngh? v? Tru?ng Sa
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/485718/Chay-nha 1 nguoi-chet-1-nguoi-bi-thuong.html">
                    Ch�y nh�,&nbsp;1&nbsp;ngu?i ch?t, 1 ngu?i b? thuong
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/485701/Khi metan-chay-tu-mieng-gieng-khoan.html">
                    Kh�&nbsp;metan ch�y t? mi?ng gi?ng khoan
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/485676/Mua-lon-pho-phuong Dak-Lak bien-thanh-song.html">
                    Mua l?n, ph? phu?ng&nbsp;�?k L?k&nbsp;bi?n th�nh s�ng
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Van-hoa-Giai-tri/485672/Bao-cao-gay-soc-ve-cai-chet-cua-Whitney-Houston.html">
                    B�o c�o g�y s?c v? c�i ch?t c?a Whitney Houston
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/485671/No-min-khai-thac-da-hang-chuc-ho-lo-sap-nha.html">
                    N? m�n khai th�c d�, h�ng ch?c h? lo s?p nh�
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://chuyentrang.tuoitre.vn/Thethao/Index.aspx?ArticleID=485661&ChannelID=5">
                    Minh Qu�n d?ng ch�n ? v�ng 2
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://chuyentrang.tuoitre.vn/Thethao/Index.aspx?ArticleID=485642&ChannelID=14">
                    B?u Th?y: "Anh Tu?n nhi?u sai l?m trong ba tr?n thua"
                </a>
            </div>
        
</div>
<div style="display:none;">
    <div id="p-select" class="glidecontenttoggler" style="display: none">
        
    </div>
</div>

            </div>
            <div style="width: 190px; overflow: hidden; line-height: 27px;">
                <div class="txt_black_m" style="color: #0072BC; vertical-align: middle; float: left;
                    padding-right: 4px;">
                    <b>TTO tr�n m?ng x� h?i</b></div>
                <div style="padding-top: 4px;">
                    <a href="https://www.facebook.com/baotuoitre" target="_blank" style="padding-right: 2px;">
                        <img src="http://tuoitre.vn/App_Themes/TTOBlue/images/img_facebook_ttdv.jpg" alt=""
                            style="border: 0px;" /></a><a href="http://twitter.com/tuoitre_tphcm" target="_blank"
                                style="padding-right: 2px;"><img src="http://tuoitre.vn/App_Themes/TTOBlue/images/img_tweeter_ttdv.jpg"
                                    alt="" style="border: 0px;" /></a><a href="https://plus.google.com/u/0/b/117768766517085478347/117768766517085478347"
                                        target="_blank"><img src="http://tuoitre.vn/App_Themes/TTOBlue/images/img_g_ttdv.jpg"
                                            alt="" style="border: 0px;" /></a></div>
            </div>
        </div>
        <span class="floatRight" style="line-height: 25px; padding-right: 5px;"><a class="nghedox"
            href="http://media.tuoitre.vn/TTAudio.aspx" target="_blank">Nghe d?c b�o</a></span>
    </div>
</div>
<div id="mnu_11_child" style="display: none; height: 27px; overflow: hidden;" class="boxMnuSub">
    <div style="width: 992px; float: left; height: 27px; overflow: hidden;">
        <span class="floatLeft fontsize12 color10" style="line-height: 27px; padding-left: 0px;">
            <script type="text/javascript">                writeTime('2012/04/05 22:30:29')</script>
        </span>
        <div style="height: 27px; width: 665px; float: left; overflow: hidden; padding-left: 10px;">
            <div style="width: 80px; float: left; overflow: hidden; line-height: 27px;">
                <b>Tin m?i nh?n: </b>
            </div>
            <div style="width: 385px; float: left; overflow: hidden; line-height: 27px;">
                

<div id="canadaprovinces" class="glidecontentwrapper" style="border:none;overflow:hidden;">    
       
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-xa-hoi/Phap-luat/485724/Vu-ky-su-Tach-Chua-tuyen-an-vi�-phuc-tap.html">
                    V? k? su T?ch: Chua tuy�n �n v� ph?c t?p
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-xa-hoi/Phap-luat/485723/Bat-bang-doi-no-thue-nguoi-Dai-Loan.html">
                    B?t bang d�i n? thu� ngu?i ��i Loan
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/The-gioi/485722/Philippines-de-nghi-to-chuc-hoi-nghi-ve-Truong-Sa.html">
                    Philippines d? ngh? t? ch?c h?i ngh? v? Tru?ng Sa
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/485718/Chay-nha 1 nguoi-chet-1-nguoi-bi-thuong.html">
                    Ch�y nh�,&nbsp;1&nbsp;ngu?i ch?t, 1 ngu?i b? thuong
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/485701/Khi metan-chay-tu-mieng-gieng-khoan.html">
                    Kh�&nbsp;metan ch�y t? mi?ng gi?ng khoan
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/485676/Mua-lon-pho-phuong Dak-Lak bien-thanh-song.html">
                    Mua l?n, ph? phu?ng&nbsp;�?k L?k&nbsp;bi?n th�nh s�ng
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Van-hoa-Giai-tri/485672/Bao-cao-gay-soc-ve-cai-chet-cua-Whitney-Houston.html">
                    B�o c�o g�y s?c v? c�i ch?t c?a Whitney Houston
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/485671/No-min-khai-thac-da-hang-chuc-ho-lo-sap-nha.html">
                    N? m�n khai th�c d�, h�ng ch?c h? lo s?p nh�
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://chuyentrang.tuoitre.vn/Thethao/Index.aspx?ArticleID=485661&ChannelID=5">
                    Minh Qu�n d?ng ch�n ? v�ng 2
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://chuyentrang.tuoitre.vn/Thethao/Index.aspx?ArticleID=485642&ChannelID=14">
                    B?u Th?y: "Anh Tu?n nhi?u sai l?m trong ba tr?n thua"
                </a>
            </div>
        
</div>
<div style="display:none;">
    <div id="p-select" class="glidecontenttoggler" style="display: none">
        
    </div>
</div>

            </div>
            <div style="width: 190px; overflow: hidden; line-height: 27px;">
                <div class="txt_black_m" style="color: #0072BC; vertical-align: middle; float: left;
                    padding-right: 4px;">
                    <b>TTO tr�n m?ng x� h?i</b></div>
                <div style="padding-top: 4px;">
                    <a href="https://www.facebook.com/baotuoitre" target="_blank" style="padding-right: 2px;">
                        <img src="http://tuoitre.vn/App_Themes/TTOBlue/images/img_facebook_ttdv.jpg" alt=""
                            style="border: 0px;" /></a><a href="http://twitter.com/tuoitre_tphcm" target="_blank"
                                style="padding-right: 2px;"><img src="http://tuoitre.vn/App_Themes/TTOBlue/images/img_tweeter_ttdv.jpg"
                                    alt="" style="border: 0px;" /></a><a href="https://plus.google.com/u/0/b/117768766517085478347/117768766517085478347"
                                        target="_blank"><img src="http://tuoitre.vn/App_Themes/TTOBlue/images/img_g_ttdv.jpg"
                                            alt="" style="border: 0px;" /></a></div>
            </div>
        </div>
        <span class="floatRight" style="line-height: 25px; padding-right: 5px;"><a class="nghedox"
            href="http://media.tuoitre.vn/TTAudio.aspx" target="_blank">Nghe d?c b�o</a></span>
    </div>
</div>
<div id="mnu_0_child" style="display: block; height: 27px; overflow: hidden;" class="boxMnuSub">
    <div style="width: 992px; float: left; height: 27px; overflow: hidden;">
        <span class="floatLeft fontsize12 color10" style="line-height: 27px; padding-left: 0px;">
            <script type="text/javascript">                writeTime('2012/04/05 22:30:29')</script>
        </span>
        <div style="height: 27px; width: 665px; float: left; overflow: hidden; padding-left: 10px;">
            <div style="width: 80px; float: left; overflow: hidden; line-height: 27px;">
                <b>Tin m?i nh?n: </b>
            </div>
            <div style="width: 385px; float: left; overflow: hidden; line-height: 27px;">
                

 <style type="text/css">
 .glidecontentwrapper{
    position: relative; /* Do not change this value */
    width: 666px;
    height: 28px; /* Set height to be able to contain height of largest content shown*/  
    overflow: hidden; 
    margin-left:4px;
}

.glidecontent{ /*style for each glide content DIV within wrapper.*/
    position: absolute; /* Do not change this value */
    background-color: #fff;
    padding: 0px;
    visibility: hidden;
    width: 365px;
    display:block;
    left: -2px;
    line-height:22px;
}

.glidecontent a{color:#000; display:block; padding: 2px 4px 0 4px; background-color: #fff;}

.glidecontent a:hover{display:block; padding: 2px 4px 0 4px; text-decoration:underline;}

.glidecontenttoggler{ /*style for DIV used to contain toggler links. */
    width: 360px;
    margin-top: 6px;
    text-align: center; /*How to align pagination links: "left", "center", or "right"*/
    background: white; /*always declare an explicit background color for fade effect to properly render in IE*/
}

.glidecontenttoggler a{ /*style for every navigational link within toggler */
    display: -moz-inline-box;
    display: inline-block;        
    padding: 1px 3px;
    margin-right: 3px;
    font-weight: bold;
    text-decoration: none;
}

.glidecontenttoggler a.selected{ /*style for selected page's toggler link. ".selected" class auto generated! */
    background: #E4EFFA;
    color: black;
}

.glidecontenttoggler a:hover{
    background: #E4EFFA;
    color: black;
}

.glidecontenttoggler a.toc{ /*style for individual toggler links (page 1, page 2, etc). ".toc" class auto generated! */
}

.glidecontenttoggler a.prev, .glidecontenttoggler a.next{ /*style for "prev" and "next" toggler links. ".prev" and ".next" classes auto generated! */
}

.glidecontenttoggler a.prev:hover, .glidecontenttoggler a.next:hover{
    background: #1A48A4;
    color: white;
}
 </style>

<div id="canadaprovinces" class="glidecontentwrapper" style="border:none;overflow:hidden;">    
       
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-xa-hoi/Phap-luat/485724/Vu-ky-su-Tach-Chua-tuyen-an-vi�-phuc-tap.html">
                    V? k? su T?ch: Chua tuy�n �n v� ph?c t?p
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-xa-hoi/Phap-luat/485723/Bat-bang-doi-no-thue-nguoi-Dai-Loan.html">
                    B?t bang d�i n? thu� ngu?i ��i Loan
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/The-gioi/485722/Philippines-de-nghi-to-chuc-hoi-nghi-ve-Truong-Sa.html">
                    Philippines d? ngh? t? ch?c h?i ngh? v? Tru?ng Sa
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/485718/Chay-nha 1 nguoi-chet-1-nguoi-bi-thuong.html">
                    Ch�y nh�,&nbsp;1&nbsp;ngu?i ch?t, 1 ngu?i b? thuong
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/485701/Khi metan-chay-tu-mieng-gieng-khoan.html">
                    Kh�&nbsp;metan ch�y t? mi?ng gi?ng khoan
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/485676/Mua-lon-pho-phuong Dak-Lak bien-thanh-song.html">
                    Mua l?n, ph? phu?ng&nbsp;�?k L?k&nbsp;bi?n th�nh s�ng
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Van-hoa-Giai-tri/485672/Bao-cao-gay-soc-ve-cai-chet-cua-Whitney-Houston.html">
                    B�o c�o g�y s?c v? c�i ch?t c?a Whitney Houston
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/485671/No-min-khai-thac-da-hang-chuc-ho-lo-sap-nha.html">
                    N? m�n khai th�c d�, h�ng ch?c h? lo s?p nh�
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://chuyentrang.tuoitre.vn/Thethao/Index.aspx?ArticleID=485661&ChannelID=5">
                    Minh Qu�n d?ng ch�n ? v�ng 2
                </a>
            </div>
           
            <div class="glidecontent">
                <a href="http://chuyentrang.tuoitre.vn/Thethao/Index.aspx?ArticleID=485642&ChannelID=14">
                    B?u Th?y: "Anh Tu?n nhi?u sai l?m trong ba tr?n thua"
                </a>
            </div>
        
</div>
<div style="display:none;">
    <div id="p-select" class="glidecontenttoggler" style="display: none">
        
    </div>
</div>

            </div>
            <div style="width: 190px; overflow: hidden; line-height: 27px;">
                <div class="txt_black_m" style="color: #0072BC; vertical-align: middle; float: left;
                    padding-right: 4px;">
                    <b>TTO tr�n m?ng x� h?i</b></div>
                <div style="padding-top: 4px;">
                    <a href="https://www.facebook.com/baotuoitre" target="_blank" style="padding-right: 2px;">
                        <img src="http://tuoitre.vn/App_Themes/TTOBlue/images/img_facebook_ttdv.jpg" alt=""
                            style="border: 0px;" /></a><a href="http://twitter.com/tuoitre_tphcm" target="_blank"
                                style="padding-right: 2px;"><img src="http://tuoitre.vn/App_Themes/TTOBlue/images/img_tweeter_ttdv.jpg"
                                    alt="" style="border: 0px;" /></a><a href="https://plus.google.com/u/0/b/117768766517085478347/117768766517085478347"
                                        target="_blank"><img src="http://tuoitre.vn/App_Themes/TTOBlue/images/img_g_ttdv.jpg"
                                            alt="" style="border: 0px;" /></a></div>
            </div>
        </div>
        <span class="floatRight" style="line-height: 25px; padding-right: 5px;"><a class="nghedox"
            href="http://media.tuoitre.vn/TTAudio.aspx" target="_blank">Nghe d?c b�o</a></span>
    </div>
</div>
<div id="mnu_1_child" class="boxMnuSub" style="display: none;">
    <div style="margin-left: 43px;" onmouseover="Lever2_Mouseover(this);" onmouseout="TimerSelectedTab();">
        <a href="http://phapluat.tuoitre.com.vn" target="_blank" class="txt_gray_m_bold"
            style="margin-left: 0px;">Thu vi?n ph�p lu?t</a> <span class="txt_gray_m_bold" style="padding-left: 4px;
                padding-right: 4px;">|</span> <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/Song-khoe/Index.html"
                    class="txt_gray_m_bold">S?ng kh?e</a> <span class="txt_gray_m_bold" style="padding-left: 4px;
                        padding-right: 4px;">|</span> <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/Phap-luat/Index.html"
                            class="txt_gray_m_bold">Ph�p lu?t</a> <span class="txt_gray_m_bold" style="padding-left: 4px;
                                padding-right: 4px;">|</span> <a href="http://tuoitre.vn/Chinh-tri-xa-hoi/Moi-truong/Index.html"
                                    class="txt_gray_m_bold">M�i tru?ng</a>
    </div>
</div>
<div id="mnu_2_child" class="boxMnuSub" style="display: none;">
    <div style="margin-left: 50px;" onmouseover="Lever2_Mouseover(this);" onmouseout="TimerSelectedTab();">
        <a href="http://tuoitre.vn/The-gioi/Quan-sat-Binh-luan/Index.html" class="txt_gray_m_bold"
            style="margin-left: 0px;">Quan s�t - B�nh lu?n</a> <span class="txt_gray_m_bold"
                style="padding-left: 4px; padding-right: 4px;">|</span> <a href="http://tuoitre.vn/The-gioi/The-gioi-muon-mau/Index.html"
                    class="txt_gray_m_bold">Th? gi?i mu�n m�u</a> <span class="txt_gray_m_bold" style="padding-left: 4px;
                        padding-right: 4px;">|</span> <a href="http://tuoitre.vn/The-gioi/Nguoi-Viet-xa-que/Index.html"
                            class="txt_gray_m_bold">Ngu?i Vi?t xa qu�</a>
    </div>
</div>
<div id="mnu_3_child" class="boxMnuSub" style="display: none;">
    <div style="margin-left: 150px;" onmouseover="Lever2_Mouseover(this);" onmouseout="TimerSelectedTab();">
        <a href="http://teen.tuoitre.vn" target="_blank" class="txt_gray_m_bold" style="margin-left: 0px;">
            Teen</a> <span class="txt_gray_m_bold" style="padding-left: 4px; padding-right: 4px;">
                |</span> <a href="http://tuoitre.vn/Nhip-song-tre/Tinh-yeu-loi-song/Index.html"
                    class="txt_gray_m_bold">T�nh y�u - L?i s?ng</a> <span class="txt_gray_m_bold" style="padding-left: 4px;
                        padding-right: 4px;">|</span> <a href="http://vieclam.tuoitre.vn" target="_blank"
                            class="txt_gray_m_bold">Vi?c l�m</a> <span class="txt_gray_m_bold" style="padding-left: 4px;
                                padding-right: 4px;">|</span> <a href="http://tuoitre.vn/Nhip-song-tre/Lam-dep-Thoi-trang/Index.html"
                                    class="txt_gray_m_bold">L�m d?p - Th?i trang</a>
    </div>
</div>
<div id="mnu_4_child" class="boxMnuSub" style="display: none;">
    <div style="margin-left: 370px;" onmouseover="Lever2_Mouseover(this);" onmouseout="TimerSelectedTab();">
        <a href="http://tuoitre.vn/Giao-duc/Khoa-hoc/Index.html" class="txt_gray_m_bold">
            Khoa h?c</a> <span class="txt_gray_m_bold" style="padding-left: 4px; padding-right: 4px;">
                |</span> <a href="http://chuyentrang.tuoitre.vn/Tuyensinh" target="_blank" class="txt_gray_m_bold">
                    Tuy?n sinh</a> <span class="txt_gray_m_bold" style="padding-left: 4px; padding-right: 4px;">
                        |</span> <a href="http://tuoitre.vn/Giao-duc/Du-hoc/Index.html"
                            class="txt_gray_m_bold" style="margin-left: 0px;">Du h?c</a>
    </div>
</div>
<div id="mnu_5_child" class="boxMnuSub" style="display: none;">
    <div style="margin-left: 400px;" onmouseover="Lever2_Mouseover(this);" onmouseout="TimerSelectedTab();">
        <a href="http://tuoitre.vn/Kinh-te/Tai-chinh-Chung-khoan/Index.html" class="txt_gray_m_bold"
            style="margin-left: 0px;">T�i ch�nh - Ch?ng kho�n</a> <span class="txt_gray_m_bold"
                style="padding-left: 4px; padding-right: 4px;">|</span> <a href="http://tuoitre.vn/kinh-te/The-gioi-xe/Index.html"
                    class="txt_gray_m_bold" style="margin-left: 0px;">Th? gi?i xe</a> <span class="txt_gray_m_bold"
                        style="padding-left: 4px; padding-right: 4px;">|</span> <a href="http://tuoitre.vn/Kinh-te/Quan-sat-thi-truong/Index.html"
                            class="txt_gray_m_bold">Th? tru?ng</a> <span class="txt_gray_m_bold" style="padding-left: 4px;
                                padding-right: 4px;">|</span> <a href="http://tuoitre.vn/Kinh-te/Nhip-cau-tieu-dung/Index.html"
                                    class="txt_gray_m_bold">Nh?p c?u ti�u d�ng</a>
    </div>
</div>
<div id="mnu_6_child" class="boxMnuSub" style="display: none;">
    <div style="width: 692px; float: left; height: 27px; overflow: hidden;">
        <span class="floatLeft fontsize12 color10" style="line-height: 25px; padding-left: 10px;">
            <script type="text/javascript">
                writeTime('2012/04/05 22:30:29');
            </script>
        </span>
    </div>
</div>
<div id="mnu_7_child" class="boxMnuSub" style="display: none;">
    <div style="margin-left: 480px;" onmouseover="Lever2_Mouseover(this);" onmouseout="TimerSelectedTab();">
        <a href="http://media.tuoitre.vn" target="_blank" class="txt_gray_m_bold" style="margin-left: 0px;">
            Media</a> <span class="txt_gray_m_bold" style="padding-left: 4px; padding-right: 4px;">
                |</span> <a href="http://tuoitre.vn/Van-hoa-Giai-tri/Dien-anh/Index.html"
                    class="txt_gray_m_bold">�i?n ?nh</a> <span class="txt_gray_m_bold" style="padding-left: 4px;
                        padding-right: 4px;">|</span> <a href="http://tuoitre.vn/Van-hoa-Giai-tri/San-khau/Index.html"
                            class="txt_gray_m_bold">S�n kh?u</a> <span class="txt_gray_m_bold" style="padding-left: 4px;
                                padding-right: 4px;">|</span> <a href="http://tuoitre.vn/Van-hoa-Giai-tri/Giai-tri-hom-nay/Index.html"
                                    class="txt_gray_m_bold">Gi?i tr� h�m nay</a>
    </div>
</div>
<div id="mnu_8_child" class="boxMnuSub" style="display: none;">
    <div style="width: 692px; float: left; height: 27px; overflow: hidden;">
        <span class="floatLeft fontsize12 color10" style="line-height: 25px; padding-left: 10px;">
            <script type="text/javascript">
                writeTime('2012/04/05 22:30:29');
            </script>
        </span>
    </div>
</div>
<div id="mnu_9_child" class="boxMnuSub" style="display: none;">
    <div style="width: 692px; float: left; height: 27px; overflow: hidden;">
        <span class="floatLeft fontsize12 color10" style="line-height: 25px; padding-left: 10px;">
            <script type="text/javascript">
                writeTime('2012/04/05 22:30:29');
            </script>
        </span>
    </div>
</div>
<div id="mnu_12_child" class="boxMnuSub" style="display: none;">
    <div style="margin-left: 400px;" onmouseover="Lever2_Mouseover(this);" onmouseout="TimerSelectedTab();">
        <a href="http://diaoc.tuoitre.vn/Index.aspx?ChannelID=451" class="txt_gray_m_bold"
            style="margin-left: 0px;" target="_blank">Nh� d?t</a> <span class="txt_gray_m_bold"
                style="padding-left: 4px; padding-right: 4px;">|</span> <a href="http://diaoc.tuoitre.vn/Index.aspx?ChannelID=240"
                    class="txt_gray_m_bold" style="margin-left: 0px;" target="_blank">Tu v?n nh� d?t</a>
        <span class="txt_gray_m_bold" style="padding-left: 4px; padding-right: 4px;">|</span>
        <a href="http://diaoc.tuoitre.vn/Index.aspx?ChannelID=452" class="txt_gray_m_bold"
            target="_blank">Ki?n tr�c</a> <span class="txt_gray_m_bold" style="padding-left: 4px;
                padding-right: 4px;">|</span> <a href="http://diaoc.tuoitre.vn/Index.aspx?ChannelID=368"
                    class="txt_gray_m_bold" target="_blank">Kh�ng gian s?ng</a>
    </div>
</div>
<div id="mnu_13_child" class="boxMnuSub" style="display: none;">
    <div style="margin-left: 400px;" onmouseover="Lever2_Mouseover(this);" onmouseout="TimerSelectedTab();">
        <a href="http://dulich.tuoitre.vn/Index.aspx?ChannelID=333" class="txt_gray_m_bold"
            style="margin-left: 0px;" target="_blank">Nh?ng mi?n d?t l?</a> <span class="txt_gray_m_bold"
                style="padding-left: 4px; padding-right: 4px;">|</span> <a href="http://dulich.tuoitre.vn/Index.aspx?ChannelID=384"
                    class="txt_gray_m_bold" style="margin-left: 0px;" target="_blank">Tu v?n du l?ch</a>
        <span class="txt_gray_m_bold" style="padding-left: 4px; padding-right: 4px;">|</span>
        <a href="http://dulich.tuoitre.vn/Index.aspx?ChannelID=218" class="txt_gray_m_bold"
            target="_blank">?m th?c</a> <span class="txt_gray_m_bold" style="padding-left: 4px;
                padding-right: 4px;">|</span> <a href="http://dulich.tuoitre.vn/Index.aspx?ChannelID=495"
                    class="txt_gray_m_bold" target="_blank">G�c ?nh l? h�nh</a>
    </div>
</div>
<div id="mnu_14_child" class="boxMnuSub" style="display: none;">
    <div style="width: 692px; float: left; height: 27px; overflow: hidden;">
        <span class="floatLeft fontsize12 color10" style="line-height: 25px; padding-left: 10px;">
            <script type="text/javascript">
                writeTime('2012/04/05 22:30:29');
            </script>
        </span>
    </div>
</div>
<div class="clearFix">
</div>


        </div>
		</div>
		<div class="boxMnuMainTop">
			<jdoc:include type="modules" name="vn-topmenu" style="none" />
		</div>
		<div style="position: relative; z-index: 30000" class="boxMnuItem"></div>
	</div>
    <div id="mainBdy">        
        
        <div id="contentBdy">
              
    

    <!-- Drag And Drop-->
    
    <link   rel="stylesheet" type="text/css" href="http://tuoitre.vn/App_Themes/TTOBlue/DragAndDrop.css"/>  
    <div class="clearFix"></div> 
    <div id="colunmLeft">
        <div style="clear:both;">
            
<div class="channeltop">
    <div class="channelttopLeft">
    <jdoc:include type="modules" name="vn-sidebar" style="none" />   
 


    </div>
    <div class="channelttopright">
		<div class="box-module" id="tab_accordion">
			<jdoc:include type="modules" name="vn-topright" style="none" />
		</div>
    </div>
</div>
<div style="margin-bottom: 7px; display:block">
    
	 
</div>


<div class="QCIframe">
    <div style="clear:both;width:100%;">
        <iframe src="http://s.tuoitre.vn/TTO/Home/Center.html" scrolling="no" align="left" width='686' height='168' frameborder="0" marginheight="0" marginwidth="0"></iframe>
    </div>
</div>
            <div class="clearFix"></div>
        </div>
        <div id="colunmLeft1" class="sortHomeCenter">
			<?php
			if ($view == 'featured'){ 
				include("html/homepage.php");
				?>
				<jdoc:include type="modules" name="vn-centermiddle" style="none" />
				<?php
			}else{	
			?>
			<jdoc:include type="component" />
			<?php }?>            
        </div>
        <div id="colunmLeft2">
           




<iframe width="200" height="396" src="http://tv.tuoitre.vn/site/thtt" frameborder="0" allowfullscreen="false" id="iframeTuoiTreTV"></iframe>




<div class="boxShareClunmleft2">
	<jdoc:include type="modules" name="vn-bottommiddle" style="none" />    
</div>

<div class="THTT">
    <div class="THTTHead"></div>
    <div class="THTTTitle">
         <a style="padding-left: 10px; line-height: 25px"
                    class="fontsize11 bold colorF" target="_blank">Video b?n d?c</a>
                    <a href="http://tuoitre.vn/Ban-doc/Cau-noi/405308/Huong-dan-cach-goi-video-ve-cho-TTO.html" class="fontsize10" style="line-height:27px;color:#fff;">(Hu?ng d?n c�ch g?i)</a>
    </div>
    <div class="THTTContent">
              
            <div style="clear:both;" id="MediaPlayerBandoc"></div>            
                        
          
    </div>
    <div style="width:200px;clear:both;background-color:#000;overflow:hidden;padding-top:2px;padding-bottom:3px;margin-bottom:8px;">
         
                <div style="width:179px;margin-left:3px;margin-top:3px;padding-left:10px;clear:both;background-image:url(../Images/whiteldot.jpg);background-repeat:no-repeat;background-position:3px 10px;height:31px;">
                    <span style="cursor:pointer;" onclick="ChangeScrBandoc('http://media.tuoitre.com.vn/Stream/Clips-flv/tromxemay.flv','Tr?m xe m�y - B?n d?c: Mai Xu�n Ti?n','http://media.tuoitre.com.vn/Stream/Clips-flv/anhtromxe.jpg');return false;" class="txt_white_m"> Tr?m xe m�y - B?n d?c: Mai Xu�n Ti?n</span>
               </div>            
            
                <div style="border-bottom:solid 1px #c1c1c1;height:1px;width:100%;clear:both;overflow:hidden;"></div>
            
                <div style="width:179px;margin-left:3px;margin-top:3px;padding-left:10px;clear:both;background-image:url(../Images/whiteldot.jpg);background-repeat:no-repeat;background-position:3px 10px;height:31px;">
                    <span style="cursor:pointer;" onclick="ChangeScrBandoc('http://media.tuoitre.com.vn/Stream/tivio/TVO2012/thang03/clipbandoc-dotrombunxuongduong-HaNoi.flv','�? tr?m b�n xu?ng du?ng - B?n d?c: Ti?n Th?ng','http://media.tuoitre.com.vn/Stream/tivio/TVO2012/thang03/clipbandoc-dotrombunxuongduong-HaNoi.jpg');return false;" class="txt_white_m"> �? tr?m b�n xu?ng du?ng - B?n d?c: Ti?n Th?ng</span>
               </div>            
            
                <div style="border-bottom:solid 1px #c1c1c1;height:1px;width:100%;clear:both;overflow:hidden;"></div>
            
                <div style="width:179px;margin-left:3px;margin-top:3px;padding-left:10px;clear:both;background-image:url(../Images/whiteldot.jpg);background-repeat:no-repeat;background-position:3px 10px;height:31px;">
                    <span style="cursor:pointer;" onclick="ChangeScrBandoc('http://media.tuoitre.com.vn/Stream/tivio/TVO2012/thang02/Xecongkenh1A.flv','Xe c?ng k?nh tr�n qu?c l? 1A - B?n d?c: Ph?m Nh�m','http://media.tuoitre.com.vn/Stream/tivio/TVO2012/thang02/1.jpg');return false;" class="txt_white_m"> Xe c?ng k?nh tr�n qu?c l? 1A - B?n d?c: Ph?m Nh�m</span>
               </div>            
            
    </div>
</div>
<div class="boxShareClunmleft2">
    <div class="boxShareClunmleft2TOp">
        <div class="boxShareClunmleft2Btom">
            <div class="color3 bold fontsize16 padding6 textCter">
                <a class="color2">Chuy�n m?c Tu?i Tr?</a>
            </div>
            <div class="boxCmtt">
                <ul>
                    <li class="liXam">
                        <a href="http://chuyentrang.tuoitre.vn/TheoguongBac" target="_blank">
                            Theo guong B�C
                        </a>
                    </li>
                    <li class="liXam">
                        <a href="http://chuyentrang.tuoitre.vn/TuHaoVietNam" target="_blank">
                            T? h�o Vi?t Nam
                        </a>
                    </li>
                    <li class="liXam">
                        <a href="http://tuoitre.vn//Chu-de/94/Hoang-Sa---Truong-Sa.html" target="_blank">
                            Ho�ng Sa - Tru?ng Sa
                        </a>
                    </li>
                    <li class="liXam">
                        <a href="http://tuoitre.vn/Giao-luu-truc-tuyen/Index.html" target="_blank">
                            Giao luu tr?c tuy?n
                        </a>
                    </li>
                    <li class="liXam">
                        <a href="http://tuoitre.vn/Dong-gop-hao-tam/Index.html">
                            ��ng g�p h?o t�m
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="THTT">
    <a class="link1" href="http://tuoitre.vn/Toasoan/index.htm" target="_blank"></a>
    <div style="margin-top: 2px; overflow: hidden; margin-bottom: 4px">
        <div style="margin-top: 2px">
            <a href="http://www.thanhdoan.hochiminhcity.gov.vn/webtd/vn/Home.aspx" target="_blank">
                <img alt="HVN" title="Website Th�nh do�n Tp. HCM" src="http://tuoitre.vn/Images/ThanhDoanTPHCM.jpg" border="0" />
            </a>
        </div> 
       
        
				 <div style="margin-top: 2px">
            <a href="http://tuoitre.vn/tag/index.html?t=%27V%C3%AC%2bng%C3%A0y%2bmai%2bph%C3%A1t%2btri%E1%BB%83n%27" target="_blank">
                <img alt="HVN" title="V� ng�y mai ph�t tri?n" src="http://tuoitre.vn/Images/ViNgayMaiPhatTrien-1.jpg" border="0" />
            </a>
        </div>
				<div style="margin-top: 2px">
				    <a href="http://tuoitre.vn/tag/index.html?t=G%C3%B3p%2b%C4%91%C3%A1%2bx%C3%A2y%2bTr%C6%B0%E1%BB%9Dng%2bSa">
        <img alt="" title="G�p d� x�y Tru?ng Sa" src="http://tuoitre.vn/Images/Banner-Home/Banner-GopDa-XayTruongSa-200x60.jpg" border="0" />
    </a>
          
        </div>
		    
        

		      <div style="margin-top: 2px">
            <a href="http://tuoitre.vn/tag/index.html?t=%27n%C3%A9t%2bb%C3%BAt%2btri%2b%C3%A2n%27" target="_blank">
                <img width="200" alt="HVN" title="N�t b�t tri �n" src="http://tuoitre.vn/Images/but-tri-an.jpg" border="0" />
            </a>
        </div>


    </div>
    <div class="boxShareClunmleft2" style="display: none;">
        <div class="boxShareClunmleft2TOp">
            <div class="boxShareClunmleft2Btom">
                
                
                
                
                
                
                
                
            </div>
        </div>
    </div>
</div>


<div class="boxVote" style="width:200px;">
	<jdoc:include type="modules" name="vn-user2" />    
</div>

        </div>
        <div class="clearFix"></div>
    </div>
    <div id="colunmRight">
    	<jdoc:include type="modules" name="vn-adver1" />

<div class="HeadTTCT fontsize16 color3 bold">
    <div class="paddingLright10px">
        <a class="color3" style="line-height:35px;" href="http://tuoitre.vn/Tuoi-tre-cuoi-tuan/Index.html" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>                       
    </div>
</div>

<div class="boxShareRight">
    <div class="boxShareRightCtent">
        <a href="http://tuoitre.vn/Tuoi-tre-cuoi-tuan/Redirect.aspx?ArticleID=484857&ChannelID=119" target="_blank"
           style="display:block;width:80px;float:left;height:80px;">
            <img src="http://www.tuoitre.vn/Images/HeadImage/857/484857_100_100.jpg" style="width:80px;height:80px;" alt="" />
        </a>
        <div class="bold" style="line-height: 14px;float:left;overflow:hidden;padding-left:8px;width:192px">
            <a class="color3" href="http://tuoitre.vn/Tuoi-tre-cuoi-tuan/Redirect.aspx?ArticleID=484857&ChannelID=119" target="_blank">
                �Hi?u l?ch s? d? d? do�n tuong lai�
            </a>
        </div>
        
                <ul style="width:190px;">
             
                    <li>
                        <a href="http://tuoitre.vn/Tuoi-tre-cuoi-tuan/Redirect.aspx?ArticleID=484854&ChannelID=119" target="_blank">
                            L?n l�n trong th�nh ph? c?a t�nh b?n
                        </a> 
                    </li>
             
                    <li>
                        <a href="http://tuoitre.vn/Tuoi-tre-cuoi-tuan/Redirect.aspx?ArticleID=484855&ChannelID=119" target="_blank">
                            �?o ho�n luong
                        </a> 
                    </li>
            
                </ul>
            
        <div class="clearFix"></div>
    </div>
</div>

<div class="HeadTTC fontsize16 color3 bold">
    <div class="paddingLright10px">
        <a class="color3" href="http://chuyentrang.tuoitre.vn/TTC" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>                       
    </div>
</div>

<div class="boxShareRight">
    <div class="boxShareRightCtent">
        <a href="http://chuyentrang.tuoitre.vn/TTC/Index.aspx?ArticleID=482254&ChannelID=103" target="_blank"
           style="display:block;width:80px;float:left;height:80px;">
            <img src="http://www.tuoitre.vn/Images/HeadImage/254/482254_100_100.jpg" style="width:80px;height:80px;" alt="" />
        </a>
        <div class="bold" style="line-height: 14px;float:left;overflow:hidden;padding-left:8px;width:192px">
            <a class="color3" href="http://chuyentrang.tuoitre.vn/TTC/Index.aspx?ArticleID=482254&ChannelID=103" target="_blank">
                Ch?ng ngoan
            </a>
        </div>
        
                <ul style="width:190px;">
             
                    <li>
                        <a href="http://chuyentrang.tuoitre.vn/TTC/Index.aspx?ArticleID=482255&ChannelID=103" target="_blank">
                            V? ch?ng t�i trong �b�o gi�
                        </a> 
                    </li>
             
                    <li>
                        <a href="http://chuyentrang.tuoitre.vn/TTC/Index.aspx?ArticleID=482251&ChannelID=103" target="_blank">
                            Thu t? l?p h?c
                        </a> 
                    </li>
            
                </ul>
            
        <div class="clearFix"></div>
    </div>
</div>

<div class="Headaotrang fontsize16 color3 bold">
    <div class="paddingLright10px">
        <a class="color3" href="http://tuoitre.vn/Ao-trang/Index.html" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>                       
    </div>
</div>

<div class="boxShareRight">
    <div class="boxShareRightCtent">
        <a href="http://tuoitre.vn/Ao-trang/484604/Co-mot-Festival-Hue-tho.html" target="_self"
           style="display:block;width:80px;float:left;height:80px;">
            <img src="http://www.tuoitre.vn/Images/HeadImage/604/484604_100_100.jpg" style="width:80px;height:80px;" alt="" />
        </a>
        <div class="bold" style="line-height: 14px;float:left;overflow:hidden;padding-left:8px;width:192px">
            <a class="color3" href="http://tuoitre.vn/Ao-trang/484604/Co-mot-Festival-Hue-tho.html" target="_self">
                C� m?t Festival Hu? tho
            </a>
        </div>
        
                <ul style="width:190px;">
             
                    <li>
                        <a href="http://tuoitre.vn/Ao-trang/479915/E-ap.html" target="_self">
                            E ?p
                        </a> 
                    </li>
             
                    <li>
                        <a href="http://tuoitre.vn/Ao-trang/479921/Mon-qua-bi-mat.html" target="_self">
                            M�n qu� b� m?t
                        </a> 
                    </li>
            
                </ul>
            
        <div class="clearFix"></div>
    </div>
</div>

<div class="HeadTusach fontsize16 color3 bold">
    <div class="paddingLright10px">
        <a class="color3" href="http://tusach.tuoitre.vn" target="_blank" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>                       
    </div>
</div>

<div class="boxShareRight">
    <div class="boxShareRightCtent">
        <a href="http://tusach.tuoitre.vn/?ArticleID=473114&ChannelID=371" target="_blank"
           style="display:block;width:80px;float:left;height:80px;">
            <img src="http://www.tuoitre.vn/Images/HeadImage/114/473114_100_100.jpg" style="width:80px;height:80px;" alt="" />
        </a>
        <div class="bold" style="line-height: 14px;float:left;overflow:hidden;padding-left:8px;width:192px">
            <a class="color3" href="http://tusach.tuoitre.vn/?ArticleID=473114&ChannelID=371" target="_blank">
                �?c m?t t�nh y�u
            </a>
        </div>
        
                <ul style="width:190px;">
             
                    <li>
                        <a href="http://tusach.tuoitre.vn/?ArticleID=473115&ChannelID=371" target="_blank">
                            Giang h? S�i G�n
                        </a> 
                    </li>
             
                    <li>
                        <a href="http://tusach.tuoitre.vn/?ArticleID=471579&ChannelID=371" target="_blank">
                            Steve Jobs - s?c m?nh c?a s? kh�c bi?t - K? cu?i
                        </a> 
                    </li>
            
                </ul>
            
        <div class="clearFix"></div>
    </div>
</div>


<div class="QCIframe">
    <div style="clear:both;width:100%;">
        <iframe src="http://s.tuoitre.vn/tto/home/rightbottom.html" scrolling="no" align="left" width='300' height='83' frameborder="0" marginheight="0" marginwidth="0"></iframe>
    </div>
</div>

<div class="QCIframe">
    <div style="clear:both;width:100%;">
        <iframe src="http://s.tuoitre.vn/tto/home/TriAn.html" scrolling="no" align="left" width='300' height='560' frameborder="0" marginheight="0" marginwidth="0"></iframe>
    </div>
</div>
<style type="text/css" >   
    ul.listOtherNewsChaoco{margin:0; padding: 6px 0 0 5px;border-top:solid 1px #d7d7d7;}
    ul.listOtherNewsChaoco li{list-style:none; background:url(http://tuoitre.vn/App_Themes/TTOBlue/Images/iconRed.jpg) 0 5px no-repeat; padding: 0 0 6px 10px; clear:both;}
    ul.listOtherNewsChaoco li a{color:#000;}
    ul.listOtherNewsChaoco li a:hover{text-decoration:underline;}        
</style>
<div class="tinanh_top"></div>
<div class="tinanh_content">  
    <div style="width:285px;margin:10px auto;clear:both;overflow:hidden">          
        <a href="http://tuoitre.vn/The-gioi/485500/Xem-clip-loc-xoay-cuon-bay-xe-tai-o-My.html"><img src="http://www.tuoitre.vn/Images/Thumbnail/810/556810_336_600.jpg" alt="" style="border:0px;width: 283px; height: 160px;border:solid 1px #c9c9c9;margin-bottom:5px;" /></a>
        <br />
        <a href="http://tuoitre.vn/The-gioi/485500/Xem-clip-loc-xoay-cuon-bay-xe-tai-o-My.html" class="fontsize12 bold color5">Xem clip l?c xo�y cu?n bay xe t?i ? M?</a>
        <br />
        <span class="txt_black_m" style="line-height:17px;">TTO - Nhi?u tr?n l?c xo�y l?n d� d? b? bang Texas (M?) h�m 3-4, m?nh d?n n?i d� l�m t?c m�i h�ng lo?t&nbsp;can nh�, b?t g?c nhi?u c�y xanh, th?m ch� cu?n bay xe t?i. Hi?n chua c� s? li?u thuong vong c? th?.</span>        
        <a href="http://tuoitre.vn/The-gioi/485500/Xem-clip-loc-xoay-cuon-bay-xe-tai-o-My.html" style="float:right;font-style:italic;" class="txt_004a80_m">Xem ti?p &raquo;</a>           
    </div>
    <ul class="listOtherNewsChaoco">        
            
                <li><a href="http://tuoitre.vn/The-gioi/485143/Hinh-anh-may-bay-roi-tham-khoc-o-Nga.html">H�nh ?nh m�y bay roi th?m kh?c ? Nga</a></li>            
               
                <li><a href="http://tuoitre.vn/Van-hoa-Giai-tri/485007/20000-khan-gia-tuong-nho-Trinh-Cong-Son.html">20.000 kh�n gi? tu?ng nh? Tr?nh C�ng Son</a></li>            
               
                <li><a href="http://dulich.tuoitre.vn/Index.aspx?ArticleID=484404&ChannelID=100">T?o d�ng v?i&nbsp;hoa ban tr�n ph?</a></li>            
             
    </ul>
</div>
<div class="tinanh_bottom" style="margin-bottom:6px;"></div>

<div class="boxCtentApPli">
    <div class="boxCtentApPliBtom">
        <div class="titleInfoAppli">
            <div class="padding10 bold fontsize16 color3">
                <span class="bold fontsize16 color3" style="float:left;"> Th�ng tin c?n bi?t </span>
                <a href="javascript:showTtcanbiet(7);" style="float:right;font-weight:normal;" class="fontsize12 color5" id="idallTab">��ng t?t c?</a>
                <div style="float:right;width:1px;overflow:hidden;" id="idallTabContent"></div>
            </div>            
        </div>
        <div class="clearFix" style="padding-left: 5px;">
            <div class="linkApli6" style="margin:0px 0 4px 4px;">
                <div style="width:108px;clear:both;" id="idstock">
                    <a href="javascript:showTtcanbiet(0);"><img alt="" src="http://tuoitre.vn/Images/Trans.gif" style="border:0;width:108px;height:25px;margin-left:5px;"/></a>
                </div>                   
                <div class="Contentttcanbiet" id="idstockContent">
                    <div class="topttcanbiet"></div>
                    <div class="centerttcanbiet" style="padding-top:18px;">
                        
                        <iframe src="http://chart.vietstock.vn/publicchart/RealTimeChart_TTO.aspx" width="280px" height="280" scrolling='no' frameborder='0'></iframe>
                        
                    </div>
                    <div class="bottomttcanbiet"></div>
                </div> 
                <div class="clearFix"></div>
            </div>            
            <div class="linkApli5" style="margin:4px 0px 0px 4px;">
                <div style="width:80px;clear:both;overflow:hidden;" id="idtigia">
                    <a href="javascript:showTtcanbiet(1);">
                        <img alt="" src="http://tuoitre.vn/Images/Trans.gif" style="border:0;width:80px;height:25px;margin-left:8px"/></a>
                </div>   
                <div class="Contentttcanbiet" id="idtigiaContent">
                    <div class="topttcanbiet"></div>
                    <div class="centerttcanbiet" style="padding-top:25px;">                            
                         <iframe style="margin-left:-15px;" src="http://www.eximbank.com.vn/WebsiteExRate1/exchange_tuoitre.aspx" width="295px" height="270" scrolling='no' frameborder='0'></iframe>
                    </div>
                    <div class="bottomttcanbiet"></div>
                </div>         
                <div class="clearFix"></div>
            </div>            
            <div class="linkApli1" style="margin:4px 0px 0px 4px;">
                <div style="width:80px;height:25px;float:left;" id="idgiavang">
                    <a href="javascript:showTtcanbiet(2);" class="">
                        <img alt="" src="http://tuoitre.vn/Images/Trans.gif" style="border:0;width:80px;height:25px;margin-top:3px;margin-left:8px"/></a>
                </div>       
                <div class="Contentttcanbiet" id="idgiavangContent">
                    <div class="topttcanbiet"></div>
                    <div class="centerttcanbiet" style="padding-top:25px;">
                        
                        <div style="width:100%;clear:both;border-top:solid 1px #e1e1e1;height:25px;margin-top:10px;">
                            <div style="width:45%;float:left;overflow:hidden;height:25px;">
                                <span class="fontsize12 bold color10" style="line-height:25px;padding-left:5px;">S?n ph?m</span>
                            </div>
                            <div style="width:35%;float:left;overflow:hidden;height:25px;">
                                <span class="fontsize12 bold color10" style="line-height:25px;padding-left:5px;">Gi� mua</span>
                            </div>
                            <div style="width:20%;float:left;overflow:hidden;height:25px;">
                                <span class="fontsize12 bold color10" style="line-height:25px;padding-left:5px;">Gi� b�n</span>
                            </div>
                        </div>
                             
                                <div style="width:100%;clear:both;border-top:solid 1px #e1e1e1;height:25px;display:block">
                                    <div style="width:45%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 bold color3" style="line-height:25px;padding-left:5px;">V�ng SJC 1L</span>
                                    </div>
                                    <div style="width:35%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;"> 43.400</span>
                                    </div>
                                    <div style="width:20%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;">43.600</span>
                                    </div>
                                </div>
                               
                                <div style="width:100%;clear:both;border-top:solid 1px #e1e1e1;height:25px;display:block">
                                    <div style="width:45%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 bold color3" style="line-height:25px;padding-left:5px;">V�ng n? trang 24 K</span>
                                    </div>
                                    <div style="width:35%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;"> 42.100</span>
                                    </div>
                                    <div style="width:20%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;">43.600</span>
                                    </div>
                                </div>
                               
                                <div style="width:100%;clear:both;border-top:solid 1px #e1e1e1;height:25px;display:block">
                                    <div style="width:45%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 bold color3" style="line-height:25px;padding-left:5px;">V�ng n? trang 18 K</span>
                                    </div>
                                    <div style="width:35%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;"> 30.850</span>
                                    </div>
                                    <div style="width:20%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;">32.850</span>
                                    </div>
                                </div>
                               
                                <div style="width:100%;clear:both;border-top:solid 1px #e1e1e1;height:25px;display:block">
                                    <div style="width:45%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 bold color3" style="line-height:25px;padding-left:5px;">V�ng n? trang 14 K</span>
                                    </div>
                                    <div style="width:35%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;"> 23.570</span>
                                    </div>
                                    <div style="width:20%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;">25.570</span>
                                    </div>
                                </div>
                               
                                <div style="width:100%;clear:both;border-top:solid 1px #e1e1e1;height:25px;display:block">
                                    <div style="width:45%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 bold color3" style="line-height:25px;padding-left:5px;">V�ng SJC</span>
                                    </div>
                                    <div style="width:35%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;"> 43.400</span>
                                    </div>
                                    <div style="width:20%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;">43.620</span>
                                    </div>
                                </div>
                               
                                <div style="width:100%;clear:both;border-top:solid 1px #e1e1e1;height:25px;display:none">
                                    <div style="width:45%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 bold color3" style="line-height:25px;padding-left:5px;">V�ng SJC</span>
                                    </div>
                                    <div style="width:35%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;"> 43.410</span>
                                    </div>
                                    <div style="width:20%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;">43.600</span>
                                    </div>
                                </div>
                               
                                <div style="width:100%;clear:both;border-top:solid 1px #e1e1e1;height:25px;display:none">
                                    <div style="width:45%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 bold color3" style="line-height:25px;padding-left:5px;">V�ng SJC</span>
                                    </div>
                                    <div style="width:35%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;"> 43.390</span>
                                    </div>
                                    <div style="width:20%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;">43.620</span>
                                    </div>
                                </div>
                               
                                <div style="width:100%;clear:both;border-top:solid 1px #e1e1e1;height:25px;display:none">
                                    <div style="width:45%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 bold color3" style="line-height:25px;padding-left:5px;">V�ng SJC</span>
                                    </div>
                                    <div style="width:35%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;"> 43.400</span>
                                    </div>
                                    <div style="width:20%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;">43.600</span>
                                    </div>
                                </div>
                               
                                <div style="width:100%;clear:both;border-top:solid 1px #e1e1e1;height:25px;display:none">
                                    <div style="width:45%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 bold color3" style="line-height:25px;padding-left:5px;">V�ng SJC</span>
                                    </div>
                                    <div style="width:35%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;"> 43.400</span>
                                    </div>
                                    <div style="width:20%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;">43.620</span>
                                    </div>
                                </div>
                               
                                <div style="width:100%;clear:both;border-top:solid 1px #e1e1e1;height:25px;display:none">
                                    <div style="width:45%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 bold color3" style="line-height:25px;padding-left:5px;">V�ng SJC</span>
                                    </div>
                                    <div style="width:35%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;"> 43.400</span>
                                    </div>
                                    <div style="width:20%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;">43.620</span>
                                    </div>
                                </div>
                               
                                <div style="width:100%;clear:both;border-top:solid 1px #e1e1e1;height:25px;display:none">
                                    <div style="width:45%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 bold color3" style="line-height:25px;padding-left:5px;">V�ng SJC</span>
                                    </div>
                                    <div style="width:35%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;"> 43.350</span>
                                    </div>
                                    <div style="width:20%;float:left;overflow:hidden;height:25px;">
                                        <span class="fontsize12 color3" style="line-height:25px;padding-left:5px;">43.650</span>
                                    </div>
                                </div>
                            
                        <div style="width:100%;clear:both;border-top:solid 1px #e1e1e1;margin-top:10px;">
                            <span class="fontsize11 color3" style="line-height:25px;padding-left:5px;">Ngu?n: SJC</span>                            
                            <span class="fontsize11 color3" style="padding:0px 3px 0px 3px;">|</span>   
                            <span class="fontsize11 color3" style="line-height:25px;">C?p nh?t l�c: 03:23:43 PM 05/04/2012</span>
                        </div>
                    </div>
                    <div class="bottomttcanbiet"></div>
                </div>     
                <div class="clearFix"></div>
            </div>             
            <div class="linkApli2" style="margin:4px 0px 0px 4px;">
                 <div style="width:122px;height:27px;float:left;" id="idxoso">
                    <a href="javascript:showdialogsoxokt();">
                        <img alt="" src="http://tuoitre.vn/Images/Trans.gif" style="border:0;width:122px;height:25px;margin-top:3px;margin-left:8px;"/></a>
                </div>        
                <div class="Contentttcanbiet" id="idxosoContent">
                    <div class="topttcanbiet"></div>
                    <div class="centerttcanbiet" style="height:200px;padding-top:18px;">
                        <div id="idsoxokt" style="display:none;" title="X? s?"></div>                    
                    </div>
                    <div class="bottomttcanbiet"></div>
                </div>      
                <div class="clearFix"></div>
            </div>            
            <div class="linkApli3" style="margin:4px 0 0px 4px;">
                 <div style="width:80px;height:25px;float:left;" id="idxebus">
                    <a href="javascript:showTtcanbiet(4)">
                        <img alt="" src="http://tuoitre.vn/Images/Trans.gif" style="border:0;width:80px;height:25px;margin-top:3px;margin-left:8px;"/></a>  
                </div>             
                <div class="Contentttcanbiet" id="idxebusContent">
                    <div class="topttcanbiet"></div>
                    <div class="centerttcanbiet" style="padding-top:25px;">                      
                        <div style="width:100%;clear:both;border-top:solid 1px #cdcdcd;margin-top:10px;overflow:hidden;padding-top:10px;">
                            <div style="width:47px;float:left;">
                                <span class="fontsize12 bold" style="padding-left:8px;">HCM</span>
                            </div>
                            <div style="width:230px;float:left;height:92px;overflow-y:scroll;">
                              
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">01</span>
                                        <a href="javascript:showdialog('2');" class="fontsize12 color3" style="line-height:18px;">Ch? B?n Th�nh - Ch? B�nh T�y</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">02</span>
                                        <a href="javascript:showdialog('3');" class="fontsize12 color3" style="line-height:18px;">Ch? B?n Th�nh - BX Mi?n T�y</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">03</span>
                                        <a href="javascript:showdialog('4');" class="fontsize12 color3" style="line-height:18px;">S�i G�n � An Nhon � Th?nh L?c</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">04</span>
                                        <a href="javascript:showdialog('5');" class="fontsize12 color3" style="line-height:18px;">S�i G�n � C?ng H�a � BX An Suong</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">05</span>
                                        <a href="javascript:showdialog('6');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n - Bi�n H�a</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">06</span>
                                        <a href="javascript:showdialog('11');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n - �H N�ng L�m</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">07</span>
                                        <a href="javascript:showdialog('12');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � G� V?p</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">08</span>
                                        <a href="javascript:showdialog('13');" class="fontsize12 color3" style="line-height:18px;">BX Qu?n 8 � Th? �?c</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">09</span>
                                        <a href="javascript:showdialog('15');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � Hung Long</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">10</span>
                                        <a href="javascript:showdialog('16');" class="fontsize12 color3" style="line-height:18px;">KTX �H Qu?c Gia � BX Mi?n T�y</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">11</span>
                                        <a href="javascript:showdialog('17');" class="fontsize12 color3" style="line-height:18px;">B?n Th�nh � �?m Sen</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">12</span>
                                        <a href="javascript:showdialog('18');" class="fontsize12 color3" style="line-height:18px;">B?n Th�nh � Th�c Giang �i?n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">13</span>
                                        <a href="javascript:showdialog('19');" class="fontsize12 color3" style="line-height:18px;">B?n Th�nh - C? Chi</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">14</span>
                                        <a href="javascript:showdialog('20');" class="fontsize12 color3" style="line-height:18px;">BX Mi?n ��ng - 3/2 - BX Mi?n T�y</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">15</span>
                                        <a href="javascript:showdialog('21');" class="fontsize12 color3" style="line-height:18px;">Ph� �?nh - B�nh Tr? ��ng</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">16</span>
                                        <a href="javascript:showdialog('22');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n - B�nh Tr? ��ng</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">17</span>
                                        <a href="javascript:showdialog('23');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n - Cu x� Ng�n H�ng</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">18</span>
                                        <a href="javascript:showdialog('24');" class="fontsize12 color3" style="line-height:18px;">Ch? B?n Th�nh - Ch? Hi?p Th�nh</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">19</span>
                                        <a href="javascript:showdialog('25');" class="fontsize12 color3" style="line-height:18px;">S�i G�n - KCX Linh Trung - KDL Su?i Ti�n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">20</span>
                                        <a href="javascript:showdialog('26');" class="fontsize12 color3" style="line-height:18px;">B?n Th�nh � Mui Nh� B�</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">22</span>
                                        <a href="javascript:showdialog('27');" class="fontsize12 color3" style="line-height:18px;">BX Qu?n 8 � KCN L� Minh Xu�n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">23</span>
                                        <a href="javascript:showdialog('28');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � Ng� 3 Gi�ng</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">24</span>
                                        <a href="javascript:showdialog('29');" class="fontsize12 color3" style="line-height:18px;">BX Mi?n ��ng � H�c M�n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">25</span>
                                        <a href="javascript:showdialog('30');" class="fontsize12 color3" style="line-height:18px;">BX Qu?n 8 � B�nh Tr? ��ng</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">26</span>
                                        <a href="javascript:showdialog('31');" class="fontsize12 color3" style="line-height:18px;">Ch? B?n Th�nh � BX Mi?n ��ng</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">27</span>
                                        <a href="javascript:showdialog('32');" class="fontsize12 color3" style="line-height:18px;">B?n Th�nh � �u Co � BX An Suong</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">28</span>
                                        <a href="javascript:showdialog('33');" class="fontsize12 color3" style="line-height:18px;">Ch? B?n Th�nh - Ch? Xu�n Th?i Thu?ng</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">29</span>
                                        <a href="javascript:showdialog('34');" class="fontsize12 color3" style="line-height:18px;">B?n Ph� C�t L�i � Ch? �?u m?i Tam B�nh</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">30</span>
                                        <a href="javascript:showdialog('35');" class="fontsize12 color3" style="line-height:18px;">Ch? T�n Huong � Khu du l?ch Su?i Ti�n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">31</span>
                                        <a href="javascript:showdialog('36');" class="fontsize12 color3" style="line-height:18px;">KDC T�n Quy � KDC B�nh L?i</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">32</span>
                                        <a href="javascript:showdialog('37');" class="fontsize12 color3" style="line-height:18px;">BX Mi?n T�y � Ng� 4 Ga</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">33</span>
                                        <a href="javascript:showdialog('38');" class="fontsize12 color3" style="line-height:18px;">BX An Suong � KDL Su?i Ti�n - �?n Vua H�ng</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">34</span>
                                        <a href="javascript:showdialog('39');" class="fontsize12 color3" style="line-height:18px;">Ch? B?n Th�nh - Tru?ng �H RMIT</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">35</span>
                                        <a href="javascript:showdialog('40');" class="fontsize12 color3" style="line-height:18px;">Khu c�ng nghi?p Hi?p Phu?c � C�ng ty xi mang H? Long</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">36</span>
                                        <a href="javascript:showdialog('41');" class="fontsize12 color3" style="line-height:18px;">S�i G�n � Th?i An</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">37</span>
                                        <a href="javascript:showdialog('42');" class="fontsize12 color3" style="line-height:18px;">C?ng B?n Ngh� � Phu?c Ki?ng</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">38</span>
                                        <a href="javascript:showdialog('43');" class="fontsize12 color3" style="line-height:18px;">KDC T�n Quy � CV �?m Sen</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">40</span>
                                        <a href="javascript:showdialog('44');" class="fontsize12 color3" style="line-height:18px;">BX Mi?n ��ng � Ng� Tu Ga</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">41</span>
                                        <a href="javascript:showdialog('45');" class="fontsize12 color3" style="line-height:18px;">C�ng vi�n �?m Sen � B?n xe An Suong</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">42</span>
                                        <a href="javascript:showdialog('46');" class="fontsize12 color3" style="line-height:18px;">Ch? C?u Mu?i � Ch? N�ng S?n Th? �?c</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">43</span>
                                        <a href="javascript:showdialog('47');" class="fontsize12 color3" style="line-height:18px;">Van Th�nh � B?n ph� C�t L�i</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">44</span>
                                        <a href="javascript:showdialog('52');" class="fontsize12 color3" style="line-height:18px;">C?ng Qu?n 4 � B?n Th�nh � B�nh Qu?i</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">45</span>
                                        <a href="javascript:showdialog('53');" class="fontsize12 color3" style="line-height:18px;">Ch? B?n Th�nh � BX Qu?n 8</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">46</span>
                                        <a href="javascript:showdialog('54');" class="fontsize12 color3" style="line-height:18px;">B?n Van Th�nh � B?n M? C?c</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">47</span>
                                        <a href="javascript:showdialog('55');" class="fontsize12 color3" style="line-height:18px;">B?n Van Th�nh � B?n M? C?c</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">48</span>
                                        <a href="javascript:showdialog('56');" class="fontsize12 color3" style="line-height:18px;">Si�u th? CMC � CVPM Quang Trung</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">49</span>
                                        <a href="javascript:showdialog('57');" class="fontsize12 color3" style="line-height:18px;">B?n Th�nh � Metro B�nh Ph�</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">50</span>
                                        <a href="javascript:showdialog('58');" class="fontsize12 color3" style="line-height:18px;">�H B�ch Khoa - �H Khoa h?c T? nhi�n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">51</span>
                                        <a href="javascript:showdialog('59');" class="fontsize12 color3" style="line-height:18px;">BX Mi?n ��ng � Ch? B�nh Hung H�a</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">52</span>
                                        <a href="javascript:showdialog('60');" class="fontsize12 color3" style="line-height:18px;">B?n Th�nh - �H Khoa H?c T? Nhi�n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">53</span>
                                        <a href="javascript:showdialog('61');" class="fontsize12 color3" style="line-height:18px;">L� H?ng Phong � �H Qu?c Gia</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">54</span>
                                        <a href="javascript:showdialog('62');" class="fontsize12 color3" style="line-height:18px;">BX Mi?n ��ng � BX Ch? L?n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">55</span>
                                        <a href="javascript:showdialog('63');" class="fontsize12 color3" style="line-height:18px;">CVPM Quang Trung � Khu C�ng Ngh? cao (Q9)</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">56</span>
                                        <a href="javascript:showdialog('64');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � �H Giao Th�ng V?n T?i</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">57</span>
                                        <a href="javascript:showdialog('65');" class="fontsize12 color3" style="line-height:18px;">Ch? Phu?c B�nh � B?n d� B�nh Qu?i</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">58</span>
                                        <a href="javascript:showdialog('66');" class="fontsize12 color3" style="line-height:18px;">Ng� Tu Ga � B�nh M?</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">59</span>
                                        <a href="javascript:showdialog('67');" class="fontsize12 color3" style="line-height:18px;">BX Qu?n 8 � Ng� Tu Ga</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">60</span>
                                        <a href="javascript:showdialog('68');" class="fontsize12 color3" style="line-height:18px;">BX An Suong � KCN L� Minh Xu�n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">61</span>
                                        <a href="javascript:showdialog('69');" class="fontsize12 color3" style="line-height:18px;">BX Mi?n T�y � KCN L� Minh Xu�n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">62</span>
                                        <a href="javascript:showdialog('70');" class="fontsize12 color3" style="line-height:18px;">BX Qu?n 8 � Th?i An</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">64</span>
                                        <a href="javascript:showdialog('71');" class="fontsize12 color3" style="line-height:18px;">BX Mi?n ��ng � C�ng vi�n �?m Sen</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">65</span>
                                        <a href="javascript:showdialog('72');" class="fontsize12 color3" style="line-height:18px;">B?n Th�nh � CMT8 � BX An Suong</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">66</span>
                                        <a href="javascript:showdialog('73');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � BX An Suong</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">68</span>
                                        <a href="javascript:showdialog('74');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � KCX T�n Thu?n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">69</span>
                                        <a href="javascript:showdialog('75');" class="fontsize12 color3" style="line-height:18px;">B?n Th�nh � �?m Sen � KCN T�n B�nh</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">71</span>
                                        <a href="javascript:showdialog('76');" class="fontsize12 color3" style="line-height:18px;">BX An Suong � Ph?t C� �on</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">72</span>
                                        <a href="javascript:showdialog('77');" class="fontsize12 color3" style="line-height:18px;">B?n Th�nh � Hi?p Phu?c</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">73</span>
                                        <a href="javascript:showdialog('78');" class="fontsize12 color3" style="line-height:18px;">Ch? �?m - KCN L� Minh Xu�n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">74</span>
                                        <a href="javascript:showdialog('79');" class="fontsize12 color3" style="line-height:18px;">BX An Suong � BX C? Chi</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">76</span>
                                        <a href="javascript:showdialog('80');" class="fontsize12 color3" style="line-height:18px;">�?n Vua H�ng - Su?i Ti�n � Long Phu?c</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">77</span>
                                        <a href="javascript:showdialog('81');" class="fontsize12 color3" style="line-height:18px;">�?ng H�a � C?n Th?nh</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">78</span>
                                        <a href="javascript:showdialog('82');" class="fontsize12 color3" style="line-height:18px;">Th?i An � H�c M�n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">79</span>
                                        <a href="javascript:showdialog('83');" class="fontsize12 color3" style="line-height:18px;">BX C? Chi � �?n B?n Du?c</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">80</span>
                                        <a href="javascript:showdialog('84');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � Ba L�ng</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">81</span>
                                        <a href="javascript:showdialog('85');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � L� Minh Xu�n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">82</span>
                                        <a href="javascript:showdialog('86');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � Ng� 3 T�n Qu� T�y</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">83</span>
                                        <a href="javascript:showdialog('87');" class="fontsize12 color3" style="line-height:18px;">BX C? Chi � C?u Th?y Cai</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">84</span>
                                        <a href="javascript:showdialog('88');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � Th? tr?n T�n T�c</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">85</span>
                                        <a href="javascript:showdialog('89');" class="fontsize12 color3" style="line-height:18px;">BX An Suong � KCN Nh? Xu�n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">86</span>
                                        <a href="javascript:showdialog('90');" class="fontsize12 color3" style="line-height:18px;">H�c M�n � KCN Nh? Xu�n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">87</span>
                                        <a href="javascript:showdialog('91');" class="fontsize12 color3" style="line-height:18px;">BX C? Chi � An Nhon T�y</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">88</span>
                                        <a href="javascript:showdialog('92');" class="fontsize12 color3" style="line-height:18px;">B?n Ph� Th? Thi�m � Long Phu?c</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">89</span>
                                        <a href="javascript:showdialog('93');" class="fontsize12 color3" style="line-height:18px;">KCN B�nh Chi?u � BV �a Khoa Th? �?c</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">90</span>
                                        <a href="javascript:showdialog('94');" class="fontsize12 color3" style="line-height:18px;">B�nh Kh�nh � C?n Th?nh</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">91</span>
                                        <a href="javascript:showdialog('95');" class="fontsize12 color3" style="line-height:18px;">BX Mi?n T�y - Ch? NS Th? �?c</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">93</span>
                                        <a href="javascript:showdialog('96');" class="fontsize12 color3" style="line-height:18px;">B?n Th�nh � Khu CX Linh Trung</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">94</span>
                                        <a href="javascript:showdialog('97');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � BX C? Chi</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">95</span>
                                        <a href="javascript:showdialog('98');" class="fontsize12 color3" style="line-height:18px;">BX Mi?n ��ng - Khu D�n Cu KCN T�n B�nh</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">96</span>
                                        <a href="javascript:showdialog('99');" class="fontsize12 color3" style="line-height:18px;">B?n Th�nh � Ch? d?u m?i B�nh �i?n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">99</span>
                                        <a href="javascript:showdialog('100');" class="fontsize12 color3" style="line-height:18px;">Metro An Ph� - Ch? T�n Ph�</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">100</span>
                                        <a href="javascript:showdialog('101');" class="fontsize12 color3" style="line-height:18px;">BX C? Chi � C?u T�n Th�i</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">101</span>
                                        <a href="javascript:showdialog('102');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � B?n Ph� �?nh</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">102</span>
                                        <a href="javascript:showdialog('103');" class="fontsize12 color3" style="line-height:18px;">B?n Th�nh � Nguy?n Van Linh � BX Mi?n T�y</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">103</span>
                                        <a href="javascript:showdialog('104');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � BX Ng� 4 Ga</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">104</span>
                                        <a href="javascript:showdialog('105');" class="fontsize12 color3" style="line-height:18px;">BX An Suong � Tru?ng �H N�ng L�m</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">107</span>
                                        <a href="javascript:showdialog('106');" class="fontsize12 color3" style="line-height:18px;">BX C? Chi � B? Heo</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">110</span>
                                        <a href="javascript:showdialog('107');" class="fontsize12 color3" style="line-height:18px;">Ph� Xu�n � Hi?p Phu?c</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">111</span>
                                        <a href="javascript:showdialog('108');" class="fontsize12 color3" style="line-height:18px;">BX Qu?n 8 � BX An Suong</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">122</span>
                                        <a href="javascript:showdialog('109');" class="fontsize12 color3" style="line-height:18px;">BX An Suong � An Nhon T�y</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">126</span>
                                        <a href="javascript:showdialog('110');" class="fontsize12 color3" style="line-height:18px;">BX C? Chi � B�nh M?</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">139</span>
                                        <a href="javascript:showdialog('111');" class="fontsize12 color3" style="line-height:18px;">BX Mi?n T�y - Ph� Xu�n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">140</span>
                                        <a href="javascript:showdialog('112');" class="fontsize12 color3" style="line-height:18px;">Ch? B?n Th�nh � B?n Ph� �?nh</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">141</span>
                                        <a href="javascript:showdialog('113');" class="fontsize12 color3" style="line-height:18px;">Ch? Long Tru?ng � KCX Linh Trung 2</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">142</span>
                                        <a href="javascript:showdialog('114');" class="fontsize12 color3" style="line-height:18px;">Ch? B?n Th�nh � CV T�n Th?t Thuy?t</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">143</span>
                                        <a href="javascript:showdialog('115');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � B�nh Hung H�a</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">144</span>
                                        <a href="javascript:showdialog('116');" class="fontsize12 color3" style="line-height:18px;">BX Mi?n T�y � Cu x� Nhi�u L?c</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">145</span>
                                        <a href="javascript:showdialog('117');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � Ch? Hi?p Th�nh</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">146</span>
                                        <a href="javascript:showdialog('118');" class="fontsize12 color3" style="line-height:18px;">BX Mi?n ��ng � Hi?p Th�nh</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">147</span>
                                        <a href="javascript:showdialog('119');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � T�n Son Nh?t</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">148</span>
                                        <a href="javascript:showdialog('120');" class="fontsize12 color3" style="line-height:18px;">BX Mi?n T�y � �?m Sen � G� V?p</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">149</span>
                                        <a href="javascript:showdialog('121');" class="fontsize12 color3" style="line-height:18px;">B?n Th�nh � B?y Hi?n � Cu x� Nhi�u L?c</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">150</span>
                                        <a href="javascript:showdialog('122');" class="fontsize12 color3" style="line-height:18px;">BX Ch? L?n � Ng� 3 T�n V?n</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">151</span>
                                        <a href="javascript:showdialog('123');" class="fontsize12 color3" style="line-height:18px;">BX Mi?n T�y � BX An Suong</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">152</span>
                                        <a href="javascript:showdialog('124');" class="fontsize12 color3" style="line-height:18px;">Khu d�n cu Trung Son � S�n bay T�n Son Nh?t</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">601</span>
                                        <a href="javascript:showdialog('125');" class="fontsize12 color3" style="line-height:18px;">BX Mi?n T�y - BX Bi�n H�a</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">615</span>
                                        <a href="javascript:showdialog('126');" class="fontsize12 color3" style="line-height:18px;">B?n xe Ch? L?n � Khu Du l?ch �?i Nam</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">616</span>
                                        <a href="javascript:showdialog('127');" class="fontsize12 color3" style="line-height:18px;">B?n Th�nh - Khu Du l?ch �?i Nam</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">617</span>
                                        <a href="javascript:showdialog('128');" class="fontsize12 color3" style="line-height:18px;">B?n d� B�nh M? - B?n xe B�nh Duong</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">618</span>
                                        <a href="javascript:showdialog('129');" class="fontsize12 color3" style="line-height:18px;">B?n xe Mi?n T�y � Khu Du l?ch �?i Nam</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">703</span>
                                        <a href="javascript:showdialog('130');" class="fontsize12 color3" style="line-height:18px;">B?n Th�nh � M?c B�i</a>
                                    </div>
                                 
                                      <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">704</span>
                                        <a href="javascript:showdialog('131');" class="fontsize12 color3" style="line-height:18px;">B?n xe Mi?n ��ng � M?c B�i</a>
                                    </div>
                                 
                            </div>
                        </div>                              
                        <div style="width:100%;clear:both;border-top:solid 1px #cdcdcd;margin-top:10px;overflow:hidden;padding-top:10px;">
                            <div style="width:47px;float:left;">
                                <span class="fontsize12 bold" style="padding-left:8px;">H� N?i</span>
                            </div>
                            <div style="width:230px;float:left;height:92px;overflow-y:scroll;">
                            
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">01</span>
                                        <a href="javascript:showdialog('137');" class="fontsize12 color3" style="line-height:18px;">Long Bi�n - BX H� ��ng</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">02</span>
                                        <a href="javascript:showdialog('7');" class="fontsize12 color3" style="line-height:18px;">B�c C? - Ba La</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">03</span>
                                        <a href="javascript:showdialog('8');" class="fontsize12 color3" style="line-height:18px;">B?n xe Gi�p B�t - B?n xe Gia L�m</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">04</span>
                                        <a href="javascript:showdialog('9');" class="fontsize12 color3" style="line-height:18px;">Long Bi�n - Linh Nam</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">05</span>
                                        <a href="javascript:showdialog('10');" class="fontsize12 color3" style="line-height:18px;">Linh ��m - Ph� Di?n</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">06</span>
                                        <a href="javascript:showdialog('138');" class="fontsize12 color3" style="line-height:18px;">Ga Ha N?i - B?n xe Thu?ng T�n</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">07</span>
                                        <a href="javascript:showdialog('139');" class="fontsize12 color3" style="line-height:18px;">B?n xe Kim M� - S�n bay N?i B�i</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">08</span>
                                        <a href="javascript:showdialog('140');" class="fontsize12 color3" style="line-height:18px;">Long Bi�n - ��ng M?</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">09</span>
                                        <a href="javascript:showdialog('141');" class="fontsize12 color3" style="line-height:18px;">B? H? - C?u Gi?y - B? H?</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">10</span>
                                        <a href="javascript:showdialog('142');" class="fontsize12 color3" style="line-height:18px;">Long Bi�n - T? Son</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">11</span>
                                        <a href="javascript:showdialog('143');" class="fontsize12 color3" style="line-height:18px;">CV Th?ng Nh?t - �ai H?c N�ng Nghi?p I</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">12</span>
                                        <a href="javascript:showdialog('144');" class="fontsize12 color3" style="line-height:18px;">B?n xe Kim M� - Van �i?n</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">13</span>
                                        <a href="javascript:showdialog('145');" class="fontsize12 color3" style="line-height:18px;">B?n xe Kim M� - B?n xe M? ��nh</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">14</span>
                                        <a href="javascript:showdialog('146');" class="fontsize12 color3" style="line-height:18px;">B? H? - C? Nhu?</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">15</span>
                                        <a href="javascript:showdialog('147');" class="fontsize12 color3" style="line-height:18px;">Long Bi�n - Ph? N?</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">16</span>
                                        <a href="javascript:showdialog('148');" class="fontsize12 color3" style="line-height:18px;">B?n xe Gi�p B�t - B?n xe M? ��nh</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">17</span>
                                        <a href="javascript:showdialog('149');" class="fontsize12 color3" style="line-height:18px;">Long Bi�n - N?i B�i</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">18</span>
                                        <a href="javascript:showdialog('150');" class="fontsize12 color3" style="line-height:18px;">Kim M� - Long Bi�n - Kim M�</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">19</span>
                                        <a href="javascript:showdialog('151');" class="fontsize12 color3" style="line-height:18px;">Tr?n Kh�nh Du - B?n xe H� ��ng</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">20</span>
                                        <a href="javascript:showdialog('152');" class="fontsize12 color3" style="line-height:18px;">B?n xe Kim M� - B?n xe Ph�ng</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">21</span>
                                        <a href="javascript:showdialog('153');" class="fontsize12 color3" style="line-height:18px;">B?n xe Gi�p B�t - B?n xe H� ��ng</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">22</span>
                                        <a href="javascript:showdialog('154');" class="fontsize12 color3" style="line-height:18px;">B?n xe Gia L�m - H� ��ng - Vi?n Qu�n Y 103</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">23</span>
                                        <a href="javascript:showdialog('155');" class="fontsize12 color3" style="line-height:18px;">Nguy?n C�ng Tr? - V�n H? - Long Bi�n - Nguy?n C�ng Tr?</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">24</span>
                                        <a href="javascript:showdialog('156');" class="fontsize12 color3" style="line-height:18px;">BX Luong Y�n - Ng� Tu S? - C?u Gi?y</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">25</span>
                                        <a href="javascript:showdialog('157');" class="fontsize12 color3" style="line-height:18px;">Nam Thang Long - Gi�p B�t</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">26</span>
                                        <a href="javascript:showdialog('158');" class="fontsize12 color3" style="line-height:18px;">Mai �?ng - SV� Qu?c Gia</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">27</span>
                                        <a href="javascript:showdialog('159');" class="fontsize12 color3" style="line-height:18px;">B?n xe H� ��ng - B?n xe Nam Thang Long</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">28</span>
                                        <a href="javascript:showdialog('160');" class="fontsize12 color3" style="line-height:18px;">B?n xe Gi�p B�t - ��ng Ng?c</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">29</span>
                                        <a href="javascript:showdialog('161');" class="fontsize12 color3" style="line-height:18px;">Gi�p B�t - T�y T?u - Thu?ng C�t</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">30</span>
                                        <a href="javascript:showdialog('162');" class="fontsize12 color3" style="line-height:18px;">Mai �?ng - Ho�ng Qu?c Vi?t</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">31</span>
                                        <a href="javascript:showdialog('163');" class="fontsize12 color3" style="line-height:18px;">B�ch Khoa (SV� B�ch Khoa) - �?i H?c M? (Ch�m)</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">32</span>
                                        <a href="javascript:showdialog('164');" class="fontsize12 color3" style="line-height:18px;">B?n xe Gi�p B�t - Nh?n</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">34</span>
                                        <a href="javascript:showdialog('165');" class="fontsize12 color3" style="line-height:18px;">B?n xe M? ��nh - B?n xe Gia L�m</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">35</span>
                                        <a href="javascript:showdialog('166');" class="fontsize12 color3" style="line-height:18px;">Tr?n Kh�nh Du - B?n xe Nam Thang Long</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">36</span>
                                        <a href="javascript:showdialog('167');" class="fontsize12 color3" style="line-height:18px;">Y�n Ph? - Linh ��m</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">37</span>
                                        <a href="javascript:showdialog('168');" class="fontsize12 color3" style="line-height:18px;">B?n xe Gi�p B�t - Linh ��m - B?n xe H� ��ng</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">38</span>
                                        <a href="javascript:showdialog('169');" class="fontsize12 color3" style="line-height:18px;">B?n xe Nam Thang Long - Mai �?ng</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">39</span>
                                        <a href="javascript:showdialog('170');" class="fontsize12 color3" style="line-height:18px;">Ho�ng Qu?c Vi?t - BX nu?c ng?m</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">40</span>
                                        <a href="javascript:showdialog('171');" class="fontsize12 color3" style="line-height:18px;">CV Th?ng Nh?t - Nhu Qu?nh</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">41</span>
                                        <a href="javascript:showdialog('172');" class="fontsize12 color3" style="line-height:18px;">Nghi T�m - BX Gi�p B�t</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">42</span>
                                        <a href="javascript:showdialog('173');" class="fontsize12 color3" style="line-height:18px;">Kim Nguu - �?c Giang</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">43</span>
                                        <a href="javascript:showdialog('174');" class="fontsize12 color3" style="line-height:18px;">CV Th?ng Nh?t - TT ��ng Anh</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">44</span>
                                        <a href="javascript:showdialog('175');" class="fontsize12 color3" style="line-height:18px;">Tr?n Kh�nh Du - BX M? ��nh</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">45</span>
                                        <a href="javascript:showdialog('176');" class="fontsize12 color3" style="line-height:18px;">Tr?n Kh�nh Du - ��ng Ng?c</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">47</span>
                                        <a href="javascript:showdialog('177');" class="fontsize12 color3" style="line-height:18px;">Long Bi�n - B�t Tr�ng</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">48</span>
                                        <a href="javascript:showdialog('178');" class="fontsize12 color3" style="line-height:18px;">Tr?n Kh�nh Du - Ph�p V�n (BX Nu?c Ng?m)</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">49</span>
                                        <a href="javascript:showdialog('179');" class="fontsize12 color3" style="line-height:18px;">Tr?n Kh�nh Du - K�T M? ��nh II</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">50</span>
                                        <a href="javascript:showdialog('180');" class="fontsize12 color3" style="line-height:18px;">Long Bi�n - SV� Qu?c Gia</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">51</span>
                                        <a href="javascript:showdialog('181');" class="fontsize12 color3" style="line-height:18px;">Tr?n Kh�nh Du - K�T Trung Y�n</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">52</span>
                                        <a href="javascript:showdialog('182');" class="fontsize12 color3" style="line-height:18px;">CV Th?ng Nh?t - BX Nu?c Ng?m</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">53</span>
                                        <a href="javascript:showdialog('183');" class="fontsize12 color3" style="line-height:18px;">Ho�ng Qu?c Vi?t - ��ng Anh</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">54</span>
                                        <a href="javascript:showdialog('184');" class="fontsize12 color3" style="line-height:18px;">Long Bi�n - B?c Ninh</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">55</span>
                                        <a href="javascript:showdialog('185');" class="fontsize12 color3" style="line-height:18px;">BX Luong Y�n - Long Bi�n - C?u Gi?y</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">56</span>
                                        <a href="javascript:showdialog('186');" class="fontsize12 color3" style="line-height:18px;">Nam Thang Long - KCN N?i B�i</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">202</span>
                                        <a href="javascript:showdialog('187');" class="fontsize12 color3" style="line-height:18px;">H� N?i - H?i Duong</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">203</span>
                                        <a href="javascript:showdialog('188');" class="fontsize12 color3" style="line-height:18px;">H� N?i - B?c Giang</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">204</span>
                                        <a href="javascript:showdialog('189');" class="fontsize12 color3" style="line-height:18px;">B?n xe Luong Y�n - Thu?n Th�nh (B?c Ninh)</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">206</span>
                                        <a href="javascript:showdialog('190');" class="fontsize12 color3" style="line-height:18px;">B?n xe Gi�p B�t - B?n Xe Ph? L�</a>
                                    </div>
                                
                                    <div style="clear:both">
                                        <span class="fontsize12" style="padding-right:7px;line-height:18px;">207</span>
                                        <a href="javascript:showdialog('191');" class="fontsize12 color3" style="line-height:18px;">H� N?i - Van Giang</a>
                                    </div>
                                       
                            </div>
                        </div>                          
                         <div id="dialog" style="display:none;clear:both;" title="Th�ng tin chi ti?t"></div>                           
                         <p style="margin:0px;padding:10px 8px 0px 0px;text-align:right;">
                            <a class="fontsize12 color5" style="padding-right:8px;" href="http://tuoitre.vn/Thong-tin-dich-vu/Cac-tuyen-xe-buyt/Index.html">Xem th�m &raquo;</a>
                         </p>
                    </div>
                    <div class="bottomttcanbiet"></div>
                </div>
                <div class="clearFix"></div>
            </div>            
            <div class="linkApli4" style="margin:3px 0px 3px 4px;">
                 <div style="width:100px;height:25px;float:left;" id="idtruyenhinh">
                    <a href="javascript:showTtcanbiet(5)" >
                        <img alt="" src="http://tuoitre.vn/Images/Trans.gif" style="border:0;width:100px;height:25px;margin-top:3px;margin-left:8px;"/></a>
                </div>   
                <div class="Contentttcanbiet" id="idtruyenhinhContent">
                    <div class="topttcanbiet"></div>
                    <div class="centerttcanbiet" style="height:200px;padding-top:18px;">
                        <p style="margin:0px;padding:10px 5px 3px 5px;">
                            <a target="_blank" href="http://tuoitre.vn/Van-hoa-giai-tri/Giai-tri-hom-nay/Chuong-trinh-Truyen-hinh/485663/Chuong-trinh-truyen-hinh-ngay-6-4.html" class="fontsize12 bold color" style="color:#f26522;">Chuong tr�nh truy?n h�nh ng�y 6-4</a></span>                            
                        </p>
                         <p style="margin:0px;padding:0px 5px;">
                            <span class="fontsize12">TTO -&nbsp;7g: T�i ch�nh - kinh doanh.&nbsp; 9g30: Van h?c ngh? thu?t: Nh?ng ngh? nh�n g?n b� v?i ch?t li?u qu� huong.&nbsp; 11g: Phim: Th�i h?u Cheon Chu. 13g: Phim: �?i a ho�n....</span>
                         </p>
                            
                                <p style="margin:0px;padding:10px 5px 3px 5px;">
                                    <a target="_blank" href="http://tuoitre.vn/Van-hoa-giai-tri/Giai-tri-hom-nay/Chuong-trinh-Truyen-hinh/485502/Chuong-trinh-truyen-hinh-ngay-5-4.html" class="fontsize12 bold color" style="color:#f26522;">Chuong tr�nh truy?n h�nh ng�y 5-4</a></span>                            
                                </p>
                                 <p style="margin:0px;padding:0px 5px;">
                                    <span class="fontsize12">TTO - VTV1: 7g30: M�n ngon qu� nh�. 11g: Phim: Th�i h?u Cheon Chu. 13g: Phim: �?i a ho�n.&nbsp; 15g: Phim t�i li?u: C�u chuy?n l�ng ph�.&nbsp; 18g: Cu?c s?ng thu?ng ng�y. 20g05:...</span>
                                 </p>
                         
                         <p style="margin:0px;padding:10px 5px;text-align:right;"><a href="http://tuoitre.vn/Van-hoa-giai-tri/Giai-tri-hom-nay/Chuong-trinh-Truyen-hinh/Index.html" target="_blank" class="fontsize12 color5">Xem ti?p &raquo;</a></p>
                    </div>
                    <div class="bottomttcanbiet"></div>
                </div>            
                <div class="clearFix"></div>
            </div>
            <div class="linkAplithoitiet" style="margin:4px 0 4px 4px;" >
                <div style="width:82px;height:25px;float:left;" id="idthoitiet">
                    <a href="javascript:showTtcanbiet(6);">
                        <img alt="" src="http://tuoitre.vn/Images/Trans.gif" style="border:0;width:82px;height:25px;margin-top:3px;margin-left:8px;"/></a>
                </div>      
                <div style="" class="Contentttcanbiet" id="idthoitietContent">
                    <div class="topttcanbiet"></div>
                    <div class="centerttcanbiet" style="padding-top:18px;">
                        <div style="width:100%;clear:both;text-align:right;">
                               <select id="cboLocattion" onchange="LoadDatathoitiet();" style="width: 165px;margin-right:8px;">                                      
                                    <option value="VMXX0007" selected="">TP HCM</option>
                                    <option value="VMXX0006">H� N?i</option>
                                    <option value="VMXX0005">H?i Ph�ng</option>
                                    <option value="7213884">Bu�n M� Thu?t</option>
                                    <option value="VMXX0031">C� Mau</option>
                                    <option value="7213346">C?m Ph?</option>
                                    <option value="VMXX0004">C?n Tho</option>
                                    <option value="VMXX0020">Cao B?ng</option>
                                    <option value="8456">�� L?t</option>
                                    <option value="VMXX0028">�� N?ng</option>
                                    <option value="7208781">Gia Lai</option>
                                    <option value="7208375">H� Giang</option>
                                    <option value="7208075">H� Tinh</option>
                                    <option value="VMXX0009">Hu?</option>
                                    <option value="VMXX0019">L�o Cai</option>
                                    <option value="19163">Long Xuy�n</option>
                                    <option value="7201559">M�ng C�i</option>
                                    <option value="VMXX0011">Nam �?nh</option>
                                    <option value="VMXX0029">Nha Trang</option>
                                    <option value="VMXX0012">Phan Thi?t</option>
                                    <option value="7196808">Pleiku</option>
                                    <option value="27117">Quy Nhon</option>
                                    <option value="VMXX0015">Th�i Nguy�n</option>
                                    <option value="VMXX0026">Vinh</option>
                                    <option value="VMXX0018">Vung T�u</option>
                               </select>
                        </div>
                        <div style="width:100%;clear:both;" id="divThoiTiet"></div>
                        <div class="clearFix"></div>
                    </div>
                    <div class="bottomttcanbiet"></div>
                </div>        
                <div class="clearFix"></div>
            </div>
            <div class="clearFix"></div>
        </div>
    </div>
</div>

<div id="boxFacebookIndex" style="background:url(http://tuoitre.vn/App_Themes/TTOBlue/images/Box-MangXaHoi.jpg) top left repeat-x; height:180px; clear:both; width:300px;">
    <div style="padding: 10px 10px 1px 10px ;width:100%;color:#0072BC;font-size:16px;"><b>Tu?i Tr? Online tr�n m?ng x� h?i</b></div>
    <div style="margin-bottom:5px;list-style:none;padding: 23px 10px 1px 10px ;width:100%;clear:both;">
        <div style="float:left;padding: 2px 20px 0 20px;width:30%;"><a href="https://www.facebook.com/baotuoitre" target="_blank" style="padding-right:5px;"><img src="http://tuoitre.vn/App_Themes/TTOBlue/images/Img_Icon_Facebook_fb.jpg" alt="" style="border:0px;"/></a></div>
        <div style="padding: 5px 0 0 0"><a href="https://www.facebook.com/baotuoitre" target="_blank" style="padding-right:5px;"><img src="http://tuoitre.vn/App_Themes/TTOBlue/images/Img_Icon_Facebooke_Like.jpg" alt="" style="border:0px;"/></a></div>
    </div>
    <div style="margin-bottom:5px;list-style:none;padding: 0 10px 1px 10px ;width:100%;clear:both;">
        <div style="float:left;padding: 5px 20px 0 20px;width:30%;"><a href="https://plus.google.com/u/0/b/117768766517085478347/117768766517085478347" target="_blank" style="padding-right:5px;"><img src="http://tuoitre.vn/App_Themes/TTOBlue/images/Img_Icon_Google_fb.jpg" alt="" style="border:0px;"/></a></div>
        <div style="padding: 5px 0 0 0"><a href="https://plus.google.com/u/0/b/117768766517085478347/117768766517085478347" target="_blank" style="padding-right:5px;"><img src="http://tuoitre.vn/App_Themes/TTOBlue/images/Img_Icon_Google_Like.jpg" alt="" style="border:0px;"/></a></div>
    </div>
    <div style="margin-bottom:5px;list-style:none;padding: 0 10px 10px 10px ;width:100%;clear:both;">
        <div style="float:left;padding: 7px 20px 0 20px;width:30%;"><a href="http://twitter.com/tuoitre_tphcm" target="_blank" style="padding-right:5px;"><img src="http://tuoitre.vn/App_Themes/TTOBlue/images/Img_Icon_Twitter_fb.jpg" alt="" style="border:0px;"/></a></div>
        <div style="padding: 5px 0 0 0"><a href="http://twitter.com/tuoitre_tphcm" target="_blank" style="padding-right:5px;"><img src="http://tuoitre.vn/App_Themes/TTOBlue/images/Img_Icon_Twitter_Like.jpg" alt="" style="border:0px;"/></a></div>
    </div>
</div>

    </div>
    <div class="clearFix"></div>  
          

        </div>
        <div class="clearFix">
        </div>
        <div class="boxQcFullbtom">
            
<div class="boxTTDV_2012">
    <div class="boxTTDVLeft">
        <div class="boxTTDVRight">
            <div class="boxTTDVTitle">
                <div style="width:100%;clear:both; height:30px;">
                    <div style="width:80px;float:left;padding-top: 3px;">
                        <a href="../Thong-tin-dich-vu/Index.html" class="titleHeaderTTDV">C?n bi?t</a>
                    </div>
                    <div class="xemtiepthongtindichvu" style="margin-top:3px;">
                        <a class="fontsize12 color2" style="padding-left:8px;float:left;line-height:24px;" href="../Thong-tin-dich-vu/Index.html" >Xem ti?p &raquo; </a>
                        <a href="http://tuoitre.vn/RssFeeds.aspx?ChannelID=334" class="fontsize12 color11" style="font-weight:bold;float:left;line-height:24px;padding-left:3px;">RSS</a>        
                    </div>
                    <div class="clearFix"></div>
                </div>
            </div>
    
            <div class="boxContentDv" style="padding: 5px 5px 5px 8px; float:left; width:470px;"> 
        <div style="width:100%; clear:both; height:106px;">
            <a  href="http://tuoitre.vn/Thong-tin-dich-vu/suc-khoe-doi-song/485532/De-chi-em-nua-dem-khong-con-phai-thuc-giac.html" target="_self"
                style="display:block; width:100px;height:100px;float:left;margin: 0 10px 2px 0;">
                <img src="http://www.tuoitre.vn/Images/HeadImage/532/485532_100_100.jpg" style="width:100px;height:100px;border:0px;float:left;margin: 0 10px 2px 0;" alt="" />
            </a>                
            <div class="paddingbt4 fontsize13 bold" style="text-align:left;">
                <a class="color3" href="http://tuoitre.vn/Thong-tin-dich-vu/suc-khoe-doi-song/485532/De-chi-em-nua-dem-khong-con-phai-thuc-giac.html">
                    �? ch? em n?a d�m kh�ng c�n ph?i th?c gi?c
                </a>
            </div>
            <div class="textLeft">
                Th�ng tin d?ch v? - Gi?c ng? c� vai tr� v� c�ng quan tr?ng d?i v?i s?c kh?e con ngu?i. Tuy nhi�n, ph? n? khi bu?c sang tu?i �x? chi?u�, d? c� m?t d�m ngon gi?c kh�ng ph?i l� di?u...
            </div>
        </div>
        
        <div class="clearFix">    
            <ul class="listNewsOtherTTDV"><li><a href="http://tuoitre.vn/Thong-tin-dich-vu/giao-duc-huong-nghiep/485476/Khoa-ke-toan-kiem-toan Truong-DHKT-TPHCM-chieu-sinh-K14.html" onmouseout="VietAd_HideTooltip();" onmouseover="VietAd_ShowTooltip('http://tuoitre.vn/Ajax/ArticleToolTip.aspx?ArticleID=485476'); return false">Khoa k? to�n ki?m to�n&nbsp;Tru?ng �HKT TP.HCM chi�u sinh K.14</a> </li></ul>
            <ul class="listNewsOtherTTDV"><li><a href="http://tuoitre.vn/Thong-tin-dich-vu/giao-duc-huong-nghiep/485427/Khai-giang-khoa-hoc-ke-toan-truong --ke-toan-thue---quan-tri.html" onmouseout="VietAd_HideTooltip();" onmouseover="VietAd_ShowTooltip('http://tuoitre.vn/Ajax/ArticleToolTip.aspx?ArticleID=485427'); return false">Khai gi?ng kh�a h?c k? to�n tru?ng&nbsp;- k? to�n thu? - qu?n tr?</a> </li></ul>
            <ul class="listNewsOtherTTDV"><li><a href="http://tuoitre.vn/Thong-tin-dich-vu/tai-chinh-doanh-nghiep/485311/Buoc-tien-moi-cua-dich-vu-ngan-hang-tu-dong-tai-Viet-Nam.html" onmouseout="VietAd_HideTooltip();" onmouseover="VietAd_ShowTooltip('http://tuoitre.vn/Ajax/ArticleToolTip.aspx?ArticleID=485311'); return false">Bu?c ti?n m?i c?a d?ch v? ng�n h�ng t? d?ng t?i Vi?t Nam</a> </li></ul>
            <ul class="listNewsOtherTTDV"><li><a href="http://tuoitre.vn/Thong-tin-dich-vu/suc-khoe-doi-song/485308/DHA-phat-trien-tri-thong-minh-cua-tre.html" onmouseout="VietAd_HideTooltip();" onmouseover="VietAd_ShowTooltip('http://tuoitre.vn/Ajax/ArticleToolTip.aspx?ArticleID=485308'); return false">DHA ph�t tri?n tr� th�ng minh c?a tr?</a> </li></ul>
        </div>
        
        <div class="clearFix"></div>
    </div>
    
            <div class="boxContentDv" style="padding: 5px 0px 8px 8px; float:left; width:480px;"> 
        <div style="width:100%;clear:both; height:106px;">
            <a  href="http://tuoitre.vn/Thong-tin-dich-vu/suc-khoe-doi-song/485531/Cung-con-vuot-qua-chung-bieng-an.html" target="_self"
                style="display:block; width:100px;height:100px;float:left;margin: 0 10px 2px 0;">
                <img src="http://www.tuoitre.vn/Images/HeadImage/531/485531_100_100.jpg" style="width:100px; height:100px; border:0px; float:left;margin: 0 10px 2px 0;" alt="" />
            </a>                
            <div class="paddingbt4 fontsize13 bold" style="text-align:left;">
                <a class="color3" href="http://tuoitre.vn/Thong-tin-dich-vu/suc-khoe-doi-song/485531/Cung-con-vuot-qua-chung-bieng-an.html">
                    C�ng con vu?t qua ch?ng bi?ng an
                </a>
            </div>
            <div class="textLeft">
                Th�ng tin d?ch v? - Khi cho tr? an, n?u cha m? thu?ng xuy�n g?p ph?i nh?ng tru?ng h?p nhu: tr? hi?u d?ng, lo l� chuy?n an u?ng, k�n an, la kh�c khi an, ng?m th?c an kh�ng ch?u...
            </div>
        </div>
        <div class="clearFix">   
            <ul class="listNewsOtherTTDV"><li><a href="http://tuoitre.vn/Thong-tin-dich-vu/suc-khoe-doi-song/485425/Dieu-tri-viem-mui-di-ung-voi-may-BioNase-kinh-te-va-hieu-qua.html" onmouseout="VietAd_HideTooltip();" onmouseover="VietAd_ShowTooltip('http://tuoitre.vn/Ajax/ArticleToolTip.aspx?ArticleID=485425'); return false">�i?u tr? vi�m mui d? ?ng v?i m�y BioNase kinh t? v� hi?u qu?</a> </li></ul>     
            <ul class="listNewsOtherTTDV"><li><a href="http://tuoitre.vn/Thong-tin-dich-vu/du-lich/485416/Khuyen-mai-dac-biet-cua-Mua-Travel.html" onmouseout="VietAd_HideTooltip();" onmouseover="VietAd_ShowTooltip('http://tuoitre.vn/Ajax/ArticleToolTip.aspx?ArticleID=485416'); return false">Khuy?n m�i d?c bi?t c?a Mua Travel</a> </li></ul>
            <ul class="listNewsOtherTTDV"><li><a href="http://tuoitre.vn/Thong-tin-dich-vu/giao-duc-huong-nghiep/485297/Smart-Train-khai-giang-khoa-�Ke-toan-quan-tri-Hoa-Ky---CMA�.html" onmouseout="VietAd_HideTooltip();" onmouseover="VietAd_ShowTooltip('http://tuoitre.vn/Ajax/ArticleToolTip.aspx?ArticleID=485297'); return false">Smart Train khai gi?ng kh�a �K? to�n qu?n tr? Hoa K? - CMA�</a> </li></ul>
            <ul class="listNewsOtherTTDV"><li><a href="http://tuoitre.vn/Thong-tin-dich-vu/suc-khoe-doi-song/485160/Suy-giam-sinh-ly-o-phu-nu-do-suy-giam-than-am.html" onmouseout="VietAd_HideTooltip();" onmouseover="VietAd_ShowTooltip('http://tuoitre.vn/Ajax/ArticleToolTip.aspx?ArticleID=485160'); return false">Suy gi?m sinh l� ? ph? n? do suy gi?m th?n �m</a> </li></ul>
        </div>         
        <div class="clearFix"></div>
    </div>
        </div>
    </div>
</div>
<div class="clearFix" style="height:10px;"></div>

<div class="QCIframe">
    <div style="clear:both;width:100%;">
        <iframe src="http://s.tuoitre.vn/tto/home/Raovat.html" scrolling="no" align="left" width='1000' height='190' frameborder="0" marginheight="0" marginwidth="0"></iframe>
    </div>
</div>
        </div>
        <div class="mnufooter">
            <p style="margin: 0px; padding: 0px;">
                <a href="http://chuyentrang.tuoitre.vn/TuHaoVietNam/">T? H�o Vi?t Nam</a> <a href="http://tuoitre.vn/">
                    Tu?i Tr? Cu?i Tu?n </a><a href="http://chuyentrang.tuoitre.vn/TTC/" target="_blank">
                        Tu?i Tr? Cu?i</a> <a href="http://media.tuoitre.vn" target="_blank">Media Online</a>
                <a href="http://vieclam.tuoitre.vn/" target="_blank">Vi?c L�m</a> <a href="http://tusach.tuoitre.vn/"
                    target="_blank">T? S�ch</a> <a href="http://ecard.tuoitre.vn/" target="_blank">Thi?p</a>
                <a href="http://games.tuoitre.vn/" target="_blank">Games</a> <a style="background: none"
                    href="http://phapluat.tuoitre.com.vn/" target="_blank">Thu Vi?n Lu?t</a>
            </p>
            <p style="margin: 0px; padding: 0px;">
                <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/Index.html">Ch�nh tr? - X� H?i</a> <a
                    href="http://tuoitre.vn/Van-hoa-Giai-tri/Index.html">Van h�a - Gi?i Tr�</a>
                <a href="http://tuoitre.vn/The-gioi/Index.html">Th? Gi?i</a> <a href="http://tuoitre.vn/Kinh-te/Index.html">
                    Kinh T?</a> <a href="http://tuoitre.vn/Giao-duc/Index.html">Gi�o D?c - Du H?c</a>
                <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/Phap-luat/Index.html" target="_blank">Ph�p
                    Lu?t</a> <a href="http://chuyentrang.tuoitre.vn/TheThao/" target="_blank">Th? Thao</a>
                <a href="http://nhipsongso.tuoitre.vn/" target="_blank">Nh?p S?ng S?</a> <a href="http://tuoitre.vn/Nhip-song-tre/Index.html">
                    Nh?p S?ng Tr?</a> <a style="background: none" href="http://tuoitre.vn/Ao-trang/Index.html"
                        target="_blank">�o Tr?ng</a>
            </p>
            <p style="margin: 0px; padding: 0px;">
                <a href="http://tuoitre.vn/Nhip-song-tre/Tinh-yeu-loi-song/Index.html">T�nh Y�u - L?i
                    S?ng</a> <a href="http://tuoitre.vn/The-gioi/Nguoi-Viet-xa-que/Index.html">Ngu?i Vi?t
                        Xa Qu�</a> <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/Song-khoe/Index.html">S?c Kh?e</a>
                <a href="http://tuoitre.vn/giao-duc/khoa-hoc/Index.html">Khoa H?c</a> <a href="http://dulich.tuoitre.vn"
                    target="_blank">Du L?ch</a> <a href="http://tuoitre.vn/Tuyensinh" target="_blank">Tuy?n
                        Sinh</a> <a href="http://tuoitre.vn/Kinh-te/Tai-chinh-Chung-khoan/Index.html">Ch?ng
                            Kho�n</a> <a href="http://diaoc.tuoitre.vn" target="_blank">�?a ?c</a>
                <a href="http://tuoitre.vn/Ban-doc/Nghe-thay-va-viet/Index.html">B?n �?c Vi?t</a>
                <a style="background: none" href="http://tuoitre.vn/ho-so-tu-lieu/index.html">H? So
                    - Tu Li?u </a>
            </p>
        </div>
        <div style="clear: both; width: 310px; margin: 0 auto 10px;">
            
<div class="boxSearch">
    <div class="padding2">
        <div class="floatLeft">
            <select class="option" id="cboInputMethod2" style="width: 46px; height: 15px; border: none!important;
                background-color: Transparent;" onchange="setTypingMode(this.value * 1);" name="Select1">
                <option style="border: none!important; background-color: Transparent;" value="0">T?t</option>
                <option style="border: none!important; background-color: Transparent;" value="1">Telex</option>
                <option style="border: none!important; background-color: Transparent;" value="2">VNI</option>
            </select>
        </div>
        
        <div class="floatLeft" style="padding-left: 6px;">                      
            <input type="text" id="txtKeyword2" class="inputSearch floatLeft" style="width: 132px; height: 17px;" onfocus="textboxChange(this,true,'T�m ki?m')" onblur="textboxChange(this,false,'T�m ki?m')"
                    value="T�m ki?m" name="SearchQuery" onkeypress="return trapEnterKey('chkYahoo2',this.value,event);" />
                <input type="button" class="inputSearch floatLeft" style="width: 60px; height: 20px;
                    cursor: pointer" alt="T�m Ki?m" id="go_search_yahoo2" name="image" onclick="searchEngine2();" />
        </div>
        <div class="floatLeft" style="padding-top: 2px; padding-left: 0px;">
             <input type="checkbox" id="chkYahoo2" onclick="setvalueYahoo();" /></div>
    </div>
</div>

        </div>
        <div class="mnufooterBtom">
            <div style="line-height: 32px" class="floatLeft">
                <a href="http://tuoitre.vn">B?n Quy?n � 2003 - 2010 Tu?i Tr?</a>
            </div>
            <div class="floatLeft" style="text-align: center; width: 570px;">
                <a href="http://tuoitre.vn/Support/unicode.zip">Font Unicode</a> <a href="http://quangcao.tuoitre.vn/Bang-gia-quang-cao/Tuoi-Tre-Online/index.html">
                    B?ng Gi� Qu?ng C�o</a> <a href="http://quangcao.tuoitre.vn/Dat-bao-truc-tuyen/index.html">
                        �?t B�o</a> <a href="http://tuoitre.vn/So-do-Web/Index.html">So �? Web</a>
                <a href="http://tuoitre.vn/Support/support.htm">Hu?ng D?n</a> <a style="background: none;"
                    href="javascript:showWindow('http://chuyentrang.tuoitre.vn/Service/Contact.aspx', false, false, false, false, false, false, true, true, 800, 650, 0, 0);">
                    Li�n H?</a>
            </div>
            <div class="floatRight" style="line-height: 32px">
                <a href="http://moore.vn" target="_blank">Ph�t Tri?n B?i Moore Corp.</a>
            </div>
        </div>
        <div class="clearFix">
        </div>
    </div>
    <!-- EDIT PAGECONTROL-->
    
        
    
    <!-- CATEGORY ZONE -->
    
        

<style type="text/css">
    #modalPage
    {
        display: none;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0px;
        left: 0px;
    }
    
    .modalBackground
    {
         filter: Alpha(Opacity=40);
        -moz-opacity: 0.4;
        opacity: 0.4;
        width: 100%;
        height: 100%;
        background-color: #999999;
        position: absolute;
        z-index: 500;
        top: 0px;
        left: 0px;
    }
    
    .modalContainer
    {
        position: absolute;        
        width: 100%;
        height: 100%;        
        top: 30px;
        left: 30%;
        /*
        left: 40%;
        top: 40%;
        */
        z-index: 750;
    }
    
    .modal
    {
        background-color: white;
        border: solid 1px black;
        padding: 0px;
        position: relative;
        /*
        top: -150px;
        left: -150px;
        */
        z-index: 1000;
        width: 400px;
        height: 500px;
    }
    
    .modalTop
    {
        width: 100%;
        height: 25px;
        background-color: #7FBAE4;
        padding: 0px;
        color: #ffffff;
        font-family: Arial;
        font-weight: bold;
        text-align: right;
    }
    
    .modalTop a, .modalTop a:visited
    {
        color: #ffffff;
    }
    
    .modalBody
    {
        width:100%;
        height:100%;
        padding: 0px;
    }
</style>

<div id="modalPage">
    <div class="modalBackground" id="modalBackground"></div>
    <div class="modalContainer" id="modalContainer">
        <div class="modal">
            <div class="modalTop" style="display:none;">
                <a href="javascript:hideModal('modalPage')">[��ng l?i]</a>
            </div>
            <div class="modalBody" id="modalContent">
                
                
            </div>
        </div>
    </div>
</div>

</form>
</body>
<script language="javascript" type="text/javascript">
     $(function(){
		$('#tab_accordion').accordion(); 
	 });
</script>
</html>