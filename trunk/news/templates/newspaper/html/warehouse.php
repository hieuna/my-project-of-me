<?php
defined('_JEXEC') or die('Restricted access');

$group		= JRequest::getCmd('group', '');
$secid		= JRequest::getInt('secid', 0, 'GET');
$cid		= JRequest::getInt('cid', 0, 'GET');
$feauture	= JRequest::getCmd('feauture', '');

$baseurl	= JURI::base();
$db			= JFactory::getDbo();

$query		= $db->getQuery(true);
$query		= 'SELECT title, CASE WHEN CHAR_LENGTH(alias) THEN CONCAT_WS(":", id, alias) ELSE id END as catslug FROM #__categories WHERE id='.$cid;
$db->setQuery($query);
$row		= $db->loadObject();

$sql		= $db->getQuery(true);
$sql		= 'SELECT id, title, alias, title_alias, images, introtext, CASE WHEN CHAR_LENGTH(alias) THEN CONCAT_WS(":", id, alias) ELSE id END as slug FROM #__content WHERE state=1 AND sectionid='.$secid.' AND catid='.$cid;
$db->setQuery($sql);
$rows		= $db->loadObjectList();

if (count($rows)>0):
	?>
	<div class="box_modules clearfix" style="width: 100%;">
		<div class="title_box_modules"><?php echo $row->title;?></div>
		<table cellpadding="0" cellspacing="0" class="focus">
			<tr>
				<?php
				$i = 0;
				$j = 2; 
				foreach ($rows as $item) :
				$j++;
				if ($i%4 == 0 && $i>0) {
					$class = '';
					$style = ' style="background: #fff;"'; 
				}else {
					$class = ' class="bdr"';
					$style = ' style="background: #F2F8FF;"'; 
				}
				$link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $row->catslug, $secid));
				?>
					<td<?php echo $class;?> style="width: 20%;" valign="top">
						<a href="<?php echo $link; ?>">
							<img class="img55" src="<?php echo $baseurl;?>/images/stories/<?php echo $item->images;?>" />
						</a>
						<a href="<?php echo $link; ?>" class="mostread">
							<?php echo $item->title; ?></a>
					</td>
				<?php 
				$i++;
				if ($i%5 == 0){
					if ($j%7 == 0) echo '</tr><tr style="background: #F2F8FF;">';
					else  echo '</tr><tr>';
				}
				endforeach; 
				?>
			</tr>
		</table>
	</div>
	<?php
endif;