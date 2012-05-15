<?php
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

$baseurl	= JURI::base();
$db			= JFactory::getDbo();
$sql		= "SELECT cd.id, cd.title, cd.alias, cd.title_alias, cd.catid, cd.sectionid, cd.images, ct.alias AS calias, "
			."\n CASE WHEN CHAR_LENGTH(cd.alias) THEN CONCAT_WS(':', cd.id, cd.alias) ELSE cd.id END as slug, "
			."\n CASE WHEN CHAR_LENGTH(ct.alias) THEN CONCAT_WS(':', ct.id, ct.alias) ELSE ct.id END as catslug "
			."\n FROM #__content AS cd, #__categories AS ct"
			."\n WHERE cd.catid=ct.id"
			."\n AND cd.systems=1"
			."\n ORDER BY cd.created DESC, cd.ordering ASC"
			;
$db->setQuery($sql);
$rows		= $db->loadObjectList();
if (count($rows) > 0){
?>
<div class="systems" id="tab_systems">
	<ul>
		<?php
		$i = 0; 
		foreach ($rows as $row):
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catslug, $row->sectionid));
		$i++;
		?>
		<li>
			<a href="<?php echo $link;?>"><img src="<?php echo $baseurl;?>/images/stories/<?php echo $row->images;?>" alt="<?php echo $row->title;?>" /></a>
			<a href="<?php echo $link;?>"><?php echo $row->title;?></a>
		</li>
		<?php
		if($i%6 == 0 && $i>0){
			if ($i == count($rows)) echo '</ul>';
			else echo '</ul><ul>';
		}	 
		endforeach;
		?>
</div>
<div class="clearfix"></div>
<?php }?>