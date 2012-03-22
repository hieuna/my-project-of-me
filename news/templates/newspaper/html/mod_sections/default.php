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
$query = "SELECT id, catid, sectionid, title, alias, title_alias, introtext, images FROM #__content WHERE sectionid=".$item->id." AND state=1 ORDER BY created DESC LIMIT 5";
$db->setQuery($query);
$rows = $db->loadObjectList();
?>
<div class="mt2">
	<div class="box4">
		<ul id="nbm-sub-cat" class="ul2">
			<li class="active"><a href="<?php echo JRoute::_(ContentHelperRoute::getSectionRoute($item->id)); ?>"><?php echo $item->title;?></a></li>
			<?php foreach ($lsCategories as $cate):?>
			<?php $linkcat = JRoute::_(ContentHelperRoute::getCategoryRoute($cate->id, $cate->section));?>
			<li><a href="<?php echo $linkcat;?>"><?php echo $cate->title;?></a></li>
			<?php endforeach;?>
		</ul>
	</div>
	<?php 
	$i=0;
	foreach ($rows as $row):
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($row->id, $row->catid, $row->sectionid));
		if ($i== 0){
		?>
		<div class="mt1 clearfix">
			<a href="<?php echo $link;?>">
				<img class="img130" title="<?php echo $row->title;?>" alt="Ảnh nổi bật" src="<?php echo $baseurl;?>images/stories/<?php echo $row->images;?>" />
			</a>
			<div class="fl wid325">
				<a href="<?php echo $link;?>" class="fon6"><?php echo $row->title;?></a> 
				<div class="fon5">
				<?php echo html_entity_decode($row->introtext);?>
				</div>
				<a href="<?php echo $link;?>" class="icon-detail fon7">Xem tiếp</a>
			</div>
		</div>
		<ul class="ul3 mt2"> 
		<?php 
		}else{
		?>
		<?php
		}
		?>
		<li><a href="<?php echo $link;?>"><?php echo $row->title;?></a></li>
		<?php
		$i++; 
	endforeach;
	?>
	</ul>
	<div class="line1 mt1"></div> 
</div>
<?php endforeach; ?>

