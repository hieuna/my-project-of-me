<?php
defined('_JEXEC') or die;

$baseurl = JURI::base();
$db = JFactory::getDbo();

//Get Categories
$query 		= $db->getQuery(true);

$query->select("id, title, alias");
$query->from("#__categories");
$query->where("published=1 AND level=2");
$query->order("parent_id ASC, id ASC");
$db->setQuery($query);
$results = $db->loadObjectList();
echo '<ul id="colHomeCenter">';
foreach ($results as $result)
{
	$subquery 	= $db->getQuery(true);
	$subquery->select("id, title, alias");
	$subquery->from("#__categories");
	$subquery->where("published=1 AND level=3 AND parent_id=".$result->id);
	$subquery->order("parent_id ASC, id ASC");
	$db->setQuery($subquery);
	$sbResults = $db->loadObjectList();
	//echo count($sbResults);
	$array = $result->id.",";
	?>
	<li>
		<div class="ChannelSample_left"></div>
		<div class="ChannelSample_rpt">
			<div class="sortHomeTitle">
				<div class="boxTabMnuShare">
	                <a class="txt_16_bold afl"><?php echo $result->title;?></a>
	                <?php
	                $i = 0;
	                foreach ($sbResults as $sbresult){
	                	$array .= $sbresult->id.",";
	                	?>
	                	<a class="txt_12 afr"><?php echo $sbresult->title;?></a><span class="txt_space">|</span>
	                	<?php
	                	echo $i++; 
	                }
	                $array;
	                ?>
	                <div class="clearFix"></div>
	            </div>
			</div>
			<div style="clear:both;">
				<div class="boxContentOderShare">
					<a target="_self" href="http://tuoitre.vn/The-gioi/Ho-so/471787/Nhung-hanh-trinh-lang-man.html">  <img alt="" src="http://www.tuoitre.vn/Images/HeadImage/787/471787_100_100.jpg" style="width:100px;height:100px;border:solid 1px #efedee;float:left;margin: 0 8px 2px 0;">  </a>
					<div class="paddingbt4 fontsize13 bold">
				        <a target="_self" href="http://tuoitre.vn/The-gioi/Ho-so/471787/Nhung-hanh-trinh-lang-man.html" class="color3">Những hành trình lãng mạn</a>
				         <img style="display: none" src="http://123.30.128.11/images/video_icon.gif" alt="Video" class="icon-ArticleAttribute">
				         <img style="display: none" src="http://123.30.128.11/images/slideshow_icon.gif" alt="SlideShow" class="icon-ArticleAttribute">
				         <img style="display: none" src="http://123.30.128.11/images/audio_icon.gif" alt="Audio" class="icon-ArticleAttribute">                       
				    </div>
				    <div class="textLeft">TTCT - Đây không phải là lần đầu Scott xuống Nam Cực. Scott đã từng dẫn đầu chuyến đi tương tự vào năm 1904.</div>
				    <div style="height:40px;overflow:hidden;" class="clearFix">
		                <div class="ItemSubCS">             
		                    <a target="_self" href="http://tuoitre.vn/Nhip-song-tre/Tinh-yeu-loi-song/484931/Chap-nhan-la-nguoi-so-2.html" onmouseover="VietAd_ShowTooltip('http://tuoitre.vn/Ajax/ArticleToolTip.aspx?ArticleID=484931'); return false" onmouseout="VietAd_HideTooltip();" class="fontsize12 color5">
		                        Chấp nhận là người số 2
		                    </a>                    
		                    <img style="display: none" src="http://123.30.128.11/images/video_icon.gif" alt="Video" class="icon-ArticleAttribute">
		                        <img style="display: none" src="http://123.30.128.11/images/slideshow_icon.gif" alt="SlideShow" class="icon-ArticleAttribute">
		                        <img style="display: none" src="http://123.30.128.11/images/audio_icon.gif" alt="Audio" class="icon-ArticleAttribute">
		                </div>                
		                <div class="ItemSubCS">             
		                    <a target="_self" href="http://tuoitre.vn/Nhip-song-tre/Tinh-yeu-loi-song/484932/Lo-“cay”-quenyeu.html" onmouseover="VietAd_ShowTooltip('http://tuoitre.vn/Ajax/ArticleToolTip.aspx?ArticleID=484932'); return false" onmouseout="VietAd_HideTooltip();" class="fontsize12 color5">
		                        Lo “cày” quên...yêu
		                    </a>                    
		                    <img style="display: none" src="http://123.30.128.11/images/video_icon.gif" alt="Video" class="icon-ArticleAttribute">
		                        <img style="display: none" src="http://123.30.128.11/images/slideshow_icon.gif" alt="SlideShow" class="icon-ArticleAttribute">
		                        <img style="display: none" src="http://123.30.128.11/images/audio_icon.gif" alt="Audio" class="icon-ArticleAttribute">
		                </div>                
				    </div>
				    <div class="xemtiep">                
				        <a target="_self" href="http://tuoitre.vn/Nhip-song-tre/Tinh-yeu-loi-song/Index.html" style="padding-left:13px;float:left;line-height:23px;" class="fontsize12 color2">Xem tiếp »</a>
				        <a style="font-weight:bold;float:left;line-height:23px;padding-left:3px;" class="fontsize12 color11" target="_blank" href="http://tuoitre.vn/RssFeeds.aspx?ChannelID=194">RSS</a>
				    </div>
				</div>
			</div>
		</div>
		<div class="ChannelSample_right"></div>
		<div style="clear: both;"></div>
	</li>
	<?php
}
echo '</ul>';
?>