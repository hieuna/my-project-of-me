<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<?php
$baseurl = JURI::base();
$db = JFactory::getDbo();

$sql = $db->getQuery(true);
$query = $db->getQuery(true);

foreach ($list as $item) :
$query = "SELECT id, catid, sectionid, title, alias, title_alias, introtext, images, created FROM #__content WHERE sectionid=".$item->id." AND state=1 ORDER BY created DESC LIMIT 6";
$db->setQuery($query);
$rows = $db->loadObjectList();
?>
<div class="mt2">
	<div class="box4 bgr_menu3 clearfix">
		<ul id="nbm-sub-cat" class="ul2">
			<li class="active"><a href="<?php echo JRoute::_(ContentHelperRoute::getSectionRoute($item->id)); ?>"><?php echo $item->title;?></a></li>
		</ul>
	</div>
	<?php
	$nows = mktime(0,0,0,date("m"),date("d"),date("Y")); 
	$i=0;
	foreach ($rows as $row):
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($row->id."-".$row->alias, $row->catid, $row->sectionid));
		//Set new link
		$ngay_nhap = mktime(0,0,0,unFormatdate($row->created,"m"),unFormatdate($row->created,"d"),unFormatdate($row->created,"Y"));				
		$days = ($nows - $ngay_nhap)/86400;
		if ($days<1) {
			$addClass = ' newnew';
			$addClass2 = ' class="newnew"';
		}else{
			$addClass = '';
			$addClass2 = '';
		}
		
		if ($i== 0){
		?>
		<div class="mt1 clearfix">
			<a href="<?php echo $link;?>">
				<?php if ($row->images != ""):?>
				<img class="img130" title="<?php echo $row->title;?>" alt="<?php echo $row->title;?>" src="<?php echo $baseurl;?>images/stories/<?php echo $row->images;?>" />
				<?php else :?>
				<img class="img130" title="<?php echo $row->title;?>" alt="Chưa có ảnh" src="<?php echo $baseurl;?>images/no_image.jpg" />
				<?php endif;?>
			</a>
			<div class="fl wid325">
				<a href="<?php echo $link;?>" class="fon6<?php echo $addClass;?>"><?php echo $row->title;?></a> 
				<div class="fon5 mt0">
				<?php echo html_entity_decode($row->introtext);?>
				</div>
			</div>
		</div>
		<ul class="ul3 mt2"> 
		<?php 
		}else{
		?>
		<li><a<?php echo $addClass2;?> href="<?php echo $link;?>"><?php echo $row->title;?></a></li>
		<?php
		}
		$i++; 
	endforeach;
	?>
	</ul>
</div>
<?php endforeach; ?>

