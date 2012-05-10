<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<?php
$baseurl = JURI::base();
$db = JFactory::getDbo();

$sql = $db->getQuery(true);
$query = $db->getQuery(true);

foreach ($list as $item) :
$sql = "SELECT id, title, name, alias FROM #__categories WHERE section=".$item->id." AND published=1 ORDER BY ordering ASC, id DESC LIMIT 4";
$db->setQuery($sql);
$lsCategories = $db->loadObjectList();
$query = "SELECT id, catid, sectionid, title, alias, title_alias, introtext, images, created, attribs FROM #__content WHERE sectionid=".$item->id." AND state=1 ORDER BY created DESC LIMIT 6";
$db->setQuery($query);
$rows = $db->loadObjectList();
?>
<div class="mt2">
	<div class="box4 clearfix">
		<ul id="nbm-sub-cat" class="ul2">
			<li class="active"><a href="<?php echo JRoute::_(ContentHelperRoute::getSectionRoute($item->id)); ?>"><?php echo $item->title;?></a></li>
			<?php foreach ($lsCategories as $cate):?>
			<?php $linkcat = JRoute::_(ContentHelperRoute::getCategoryRoute($cate->id, $cate->section));?>
			<li><a href="<?php echo $linkcat;?>"><?php echo $cate->title;?></a></li>
			<?php endforeach;?>
		</ul>
	</div>
	<?php
	$nows = mktime(0,0,0,date("m"),date("d"),date("Y")); 
	$i=0;
	foreach ($rows as $row):
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($row->id, $row->catid, $row->sectionid));
		//Set new link
		$ngay_nhap = mktime(0,0,0,unFormatdate($row->created,"m"),unFormatdate($row->created,"d"),unFormatdate($row->created,"Y"));				
		$days = ($nows - $ngay_nhap)/86400;
		if ($days<2) {
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
			<?php if ($row->attribs!=""):?>
				<?php if ($row->images != ""):?>
				<img class="img130" title="<?php echo $row->title;?>" alt="<?php echo $row->title;?>" src="<?php echo $baseurl;?>images/stories/<?php echo $row->images;?>" />
				<?php else :?>
				<img class="img130" title="<?php echo $row->title;?>" alt="Chưa có ảnh" src="<?php echo $baseurl;?>images/no_image.jpg" />
				<?php endif;?>
			<?php else:?>
				<img class="img130" title="<?php echo $row->title;?>" alt="<?php echo $row->title;?>" src="<?php echo $row->images;?>" />
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
	<div class="line1 mt1"></div> 
</div>
<?php endforeach; ?>

