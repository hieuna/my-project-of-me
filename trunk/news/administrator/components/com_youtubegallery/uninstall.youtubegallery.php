<?php
/**
 * YouTubeGallery Joomla! 1.5 Native Component
 * @version 2.1.9
 * @author DesignCompass Corp <admin@designcompasscorp.com>
 * @link http://www.designcompasscorp.com
 * @license GNU/GPL
 **/

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

function com_uninstall()
{
	
$filestodelete=array();

	//Plugin to update
	$filestodelete[]=JPATH_SITE.DS.'plugins'.DS.'content'.DS.'youtubegallery".php';
	$filestodelete[]=JPATH_SITE.DS.'plugins'.DS.'content'.DS.'youtubegallery".xml';
	
	$filestodelete[]=JPATH_SITE.DS.'modules'.DS.'mod_youtubegallery'.DS.'index.html';
	$filestodelete[]=JPATH_SITE.DS.'modules'.DS.'mod_youtubegallery'.DS.'mod_youtubegallery.php';
	$filestodelete[]=JPATH_SITE.DS.'modules'.DS.'mod_youtubegallery'.DS.'mod_youtubegallery.xml';
	$filestodelete[]=JPATH_SITE.DS.'modules'.DS.'mod_youtubegallery';
	
		
	foreach($filestodelete as $file)
	{
		if(file_exists($file))
		{
			if(is_dir($file))
				rmdir($file);
				
			else
				unlink($file);
		}
		
	}
	
	$db	= & JFactory::getDBO();
	
	//ADD PLUGIN
	
	$query = 'DELETE FROM #__plugins WHERE `element`="youtubegallery"';
	$db->setQuery( $query );
	if (!$db->query())    die( $db->stderr());
	
	
	
	//Delete module
	$query = 'SELECT id FROM #__modules WHERE `module`="mod_youtubegallery"';
	$db->setQuery( $query );
	$rows = $db->loadObjectList();
	
	if(count($rows)>0)
	{
		$id=$rows[0]->id;
		
		$query ='DELETE FROM `#__modules` WHERE `module`="mod_youtubegallery"';
		$db->setQuery( $query );
		if (!$db->query())    die( $db->stderr());
		
		$query ='DELETE FROM `#__modules_menu` WHERE `moduleid`='.$id;
		$db->setQuery( $query );
		if (!$db->query())    die( $db->stderr());
	}
		
		
	echo '<p>Youtube Gallery has been uninstalled successfully.</p>';
}

?>
