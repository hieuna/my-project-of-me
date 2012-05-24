<?php
defined('_JEXEC') or die('Restricted access');

$id			=  JRequest::getInt('id', 0, 'GET');

$nows = mktime(0,0,0,date("m"),date("d"),date("Y"));

$baseurl	= JURI::base();
$db			= JFactory::getDbo();
$query		= $db->getQuery(true);
$query		= "SELECT id, title, alias, section FROM #__categories WHERE published=1 AND section=".$id." ORDER BY ordering ASC, id DESC";
$db->setQuery($query);
$listCate	= $db->loadObjectList();
foreach ($listCate as $cate) {
	$sql	= $db->getQuery(true);
	$sql	= "SELECT id, title, alias, introtext, images, catid, sectionid, created FROM #__content WHERE state=1 AND sectionid=".$id." AND catid=".$cate->id." ORDER BY ordering ASC, created DESC, id DESC LIMIT 0,6";
	$db->setQuery($sql);
	$rows	= $db->loadObjectList();
	
	$ngay_nhap_first = mktime(0,0,0,unFormatdate($rows[0]->created,"m"),unFormatdate($rows[0]->created,"d"),unFormatdate($rows[0]->created,"Y"));
	$days_first = ($nows - $ngay_nhap_first)/86400;
	if ($days_first<1) $addClassFirst = ' newnew';
	else $addClassFirst = '';
	
	$link_first = JRoute::_(ContentHelperRoute::getArticleRoute($rows[0]->id, $rows[0]->catid, $rows[0]->sectionid));
	?>
	<div class="box-category">
		<div class="title-category">
			<a href="<?php echo JRoute::_(ContentHelperRoute::getSectionRoute($cate->id)); ?>"><?php echo $cate->title;?></a>
		</div>
		<div class="content-category">
			<div class="content-left-category fl">
				<a href="<?php echo $link_first;?>">
					<?php if ($rows[0]->images != ""):?>
					<img class="img130" title="<?php echo $rows[0]->title;?>" alt="<?php echo $rows[0]->title;?>" src="<?php echo $baseurl;?>images/stories/<?php echo $rows[0]->images;?>" />
					<?php else :?>
					<img class="img130" title="<?php echo $rows[0]->title;?>" alt="Chưa có ảnh" src="<?php echo $baseurl;?>images/no_image.jpg" />
					<?php endif;?>
				</a>
				<a href="<?php echo $link_first;?>" class="fon6<?php echo $addClassFirst;?>"><?php echo $rows[0]->title;?></a> 
				<div class="fon5 mt0">
				<?php echo html_entity_decode($rows[0]->introtext);?>
				</div>
			</div>
			<div class="content-right-category fr">
				<ul>
				<?php
				$i=0; 
				foreach ($rows as $row) {
					$link = JRoute::_(ContentHelperRoute::getArticleRoute($row->id, $row->catid, $row->sectionid));
					$ngay_nhap = mktime(0,0,0,unFormatdate($row->created,"m"),unFormatdate($row->created,"d"),unFormatdate($row->created,"Y"));				
					$days = ($nows - $ngay_nhap)/86400;
					if ($days<1) $addClass = ' class="newnew"';
					else $addClass = '';
					if ($i > 0){
					?>
					<li><a<?php echo $addClass;?> href="<?php echo $link;?>"><?php echo $row->title;?></a></li>
					<?php	
					}
					$i++;
				}
				?>
				</ul>
			</div>
		</div>
	</div>
	<?php
}
?>