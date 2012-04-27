<?php
defined('_JEXEC') or die('Restricted access');

$baseurl	= JURI::base();
$db			= JFactory::getDbo();
$query		= $db->getQuery(true);
$query		= "SELECT bid, name, alias, imageurl, clickurl, description FROM #__banner WHERE showBanner=1 AND catid=79 ORDER BY ordering ASC, bid DESC";
$db->setQuery($query);
$rowsBanners = $db->loadObjectList();
?>
<div class="divboxPartner">
	<h2>Đối tác tài trợ</h2>
	<div class="boxPartner" id="tab_content">
		<ul>
			<?php
			$i = 0;
			 foreach ($rowsBanners as $banner) {
			 	$link = JRoute::_( 'index.php?option=com_banners&task=click&bid='. $banner->bid );
			 	$i++;
				?>
				<li>
					<a class="fl" href="<?php echo $link;?>" target="_blank"><img src="<?php echo $baseurl;?>images/banners/<?php echo $banner->imageurl;?>" /></a>
					<p><a href="<?php echo $link;?>" target="_blank"><?php echo $banner->name;?></a></p>
					<p><?php echo $banner->description;?></p>
				</li>
				<?php
				if($i%5 == 0) echo '</ul><ul>';
			} 
			?>
		</ul>
	</div>
</div>