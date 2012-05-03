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
		<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.cycle.all.min.js"></script>
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
				$(function () {
					$("ul#MainMnu li").hover(function () {
						$(this).addClass("hover");
						$('div#mnu', this).css('visibility', 'visible');
					}, function () {
						$(this).removeClass("hover");
						$('div#mnu', this).css('visibility', 'hidden');
					});					
				});      
			</script>

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
    
    <div class="clearFix"></div> 
    <div id="colunmLeft">
		<?php if ($view == 'featured'):?>
        <div style="clear:both;">
			<div class="channeltop">
				<div class="channelttopLeft">
					<jdoc:include type="modules" name="vn-sidebar" style="none" />   
				</div>
				<div class="channelttopright">
					<div class="box-module">
						<jdoc:include type="modules" name="vn-topright" style="none" />
					</div>
				</div>
			</div>
			<div style="margin-bottom: 7px; display:block"></div>
			<div class="QCIframe">
				<div style="clear:both; width:100%;">
					<jdoc:include type="modules" name="vn-adver3" />
				</div>
			</div>
            <div class="clearFix"></div>
        </div>
		<?php endif;?>
        <div id="colunmLeft1">
			<?php
			if ($view == 'featured'){ 
				include("html/homepage.php");
				?>
				<jdoc:include type="modules" name="vn-centermiddle" style="none" />
				<?php
			}else{	
			?>
			<jdoc:include type="component" />
			<div class="article_others">
				<jdoc:include type="modules" name="vn-user9" />
			</div>
			<?php }?>
        </div>
        <?php if ($view != 'featured'):?>
        <div id="colunmRight">
	    	<jdoc:include type="modules" name="vn-adver1" />
			<jdoc:include type="modules" name="vn-user1" style="none" />
	    </div>
        <?php endif;?>
        <div class="clearFix"></div>
    </div>
    <?php if ($view == 'featured'):?>
    <div id="colunmRight">
    	<jdoc:include type="modules" name="vn-adver1" />
		<jdoc:include type="modules" name="vn-user1" style="none" />
    </div>
    <?php else:?>
    <div id="colunmLeft2">
		<div class="boxShareClunmleft2">
			<jdoc:include type="modules" name="vn-bottommiddle" style="none" />    
		</div>
		<jdoc:include type="modules" name="vn-adver2" style="none" />
		<div class="boxVote" style="width:200px;">
			<jdoc:include type="modules" name="vn-user2" />    
		</div>
    </div>
    <?php endif;?>
    <div class="clearFix"></div>  
          

        </div>
        <div class="clearFix">
        </div>
        <div class="boxQcFullbtom">
            

<div class="QCIframe">
    <div style="clear:both;width:100%;">
        <iframe src="http://s.tuoitre.vn/tto/home/Raovat.html" scrolling="no" align="left" width='1000' height='190' frameborder="0" marginheight="0" marginwidth="0"></iframe>
    </div>
</div>
        </div>
        
            


        </div>
        <div id="footer">
        	<div class="copyright">
           		<jdoc:include type="modules" name="vn-bottomright" style="none" />
           	</div>
        </div>
        <div class="clearFix">
        </div>
    </div>
    <!-- EDIT PAGECONTROL-->
<script type="text/javascript">
$(document).ready(function() {	
	$('#most_read').cycle({
		fx: 'turnUp',
		timeout: 5000
	});
	<?php if ($view != 'featured'):?>
	$('#colunmLeft').css('width', '811px');
	$('#colunmLeft1').css('width', '500px');
	<?php endif;?>
});
</script>
</body>
</html>