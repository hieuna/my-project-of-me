<?php
define( '_JEXEC', 1 );
define('JPATH_BASE', dirname(__FILE__) );
define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
require_once ( JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php' );

$mainframe =& JFactory::getApplication('site');

$baseurl	= JURI::base();
$task	= JRequest::getString('task', 'task');

//Load Article for content system customers
if ($task == 'load_system'){
	$id		= JRequest::getInt('id', 0, 'GET');
	
	$db			= JFactory::getDbo();
	$sql		= "SELECT cd.id, cd.title, cd.alias, cd.title_alias, cd.catid, cd.sectionid, cd.images, ct.alias AS calias, "
				."\n CASE WHEN CHAR_LENGTH(cd.alias) THEN CONCAT_WS(':', cd.id, cd.alias) ELSE cd.id END as slug, "
				."\n CASE WHEN CHAR_LENGTH(ct.alias) THEN CONCAT_WS(':', ct.id, ct.alias) ELSE ct.id END as catslug "
				."\n FROM #__content AS cd, #__categories AS ct"
				."\n WHERE cd.catid=ct.id"
				."\n AND cd.systems=1"
				."\n AND cd.id=".$id
				."\n LIMIT 1"
				;
	$db->setQuery($sql);
	$row		= $db->loadObject();
	//var_dump($row);
	?>
	<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catslug, $row->sectionid));?>">
	<img class="full" src="<?php echo $baseurl;?>/images/stories/<?php echo $row->images;?>" alt="<?php echo $row->title;?>" />
	</a>
	<div class="show_title_system_main"><?php echo $row->title;?></div>
	<?php	
}