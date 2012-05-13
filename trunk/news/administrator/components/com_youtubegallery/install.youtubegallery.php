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

function com_install()
{
	jimport('joomla.filesystem.file');

	$filestodelete=array();

	//Plugin to update
	$filestodelete[]=JPATH_SITE.DS.'plugins'.DS.'content'.DS.'youtubegallery.php';
	$filestodelete[]=JPATH_SITE.DS.'plugins'.DS.'content'.DS.'youtubegallery.xml';
	
	$filestodelete[]=JPATH_SITE.DS.'components'.DS.'com_youtubegallery'.DS.'plugin'.DS.'index.html';
	
	//Module to update
	$filestodelete[]=JPATH_SITE.DS.'modules'.DS.'mod_youtubegallery'.DS.'index.html';
	$filestodelete[]=JPATH_SITE.DS.'modules'.DS.'mod_youtubegallery'.DS.'mod_youtubegallery.php';
	$filestodelete[]=JPATH_SITE.DS.'modules'.DS.'mod_youtubegallery'.DS.'mod_youtubegallery.xml';
	
	
	//echo 'f';
	foreach($filestodelete as $file)
	{
		//echo $file;
		if(file_exists($file))
		{
			
			if(is_dir($file))
			{
				rmdir($file);
				//echo ' - dir deleted';
			}	
			else
			{
				unlink($file);
				//echo ' - file deleted';
			}
		}

	}
	//plugin
	rename(JPATH_SITE.DS.'components'.DS.'com_youtubegallery'.DS.'plugin'.DS.'youtubegallery.php',JPATH_SITE.DS.'plugins'.DS.'content'.DS.'youtubegallery.php');
	rename(JPATH_SITE.DS.'components'.DS.'com_youtubegallery'.DS.'plugin'.DS.'youtubegallery.xml',JPATH_SITE.DS.'plugins'.DS.'content'.DS.'youtubegallery.xml');
	
	rmdir(JPATH_SITE.DS.'components'.DS.'com_youtubegallery'.DS.'plugin');
	//module
	rename(JPATH_SITE.DS.'components'.DS.'com_youtubegallery'.DS.'module',JPATH_SITE.DS.'modules'.DS.'mod_youtubegallery');
	

	if (file_exists(JPATH_SITE.DS."administrator".DS."components".DS."com_youtubegallery".DS."youtubegallery.php"))
       	{

		echo '<h1>YouTube Gallery 2.1.9 installed succesfully</h1>';
	}
	else
	{
		echo '<font color="red">Sorry, something went wrong while installing YouTube Gallery on your web site</font>';
	}


	$db	= & JFactory::getDBO();
	
	//ADD PLUGIN
	
	$query = 'SELECT count(*) FROM #__plugins WHERE `element`="youtubegallery"';
	$db->setQuery( $query );
	$total_rows = $db->loadResult();
	
	if($total_rows==0)
	{
		$query ='INSERT `#__plugins` SET `name`="Content - YouTubeGallery", `element`="youtubegallery", `folder`="content", published=1';
		$db->setQuery( $query );
		if (!$db->query())    die( $db->stderr());
	}
	
	//Add module
	$query = 'SELECT count(*) FROM #__modules WHERE `module`="mod_youtubegallery"';
	$db->setQuery( $query );
	$total_rows = $db->loadResult();
	if($total_rows==0)
	{
		//add module
		
		$query ='INSERT `#__modules` SET '
			.' `title`="YouTube Gallery", '
			.' `position`="left", '
			.' `published`=0, '
			.' `module`="mod_youtubegallery", '
			.' `params`=""';
			
		$db->setQuery( $query );
		if (!$db->query())    die( $db->stderr());
		
		
		//Check menu Items
		$query = 'SELECT id FROM #__modules WHERE '
			.' `title`="YouTube Gallery" AND'
			.' `module`="mod_youtubegallery" AND'
			.' `position`="left" AND'
			.' `published`=0'
			.' LIMIT 1';
			
		//Add menu Items	
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		
		if(count($rows)==1)
		{
			$id=$rows[0]->id;
			
			$query = 'SELECT count(*)  FROM #__modules_menu WHERE moduleid='.$id;
			$db->setQuery( $query );
			$total_rows = $db->loadResult();
			if($total_rows==0)
			{
				$query ='INSERT `#__modules_menu` SET `menuid`=0, `moduleid`='.$id;
				$db->setQuery( $query );
				if (!$db->query())    die( $db->stderr());
			}
		}
		else
			echo '<p>Database error, cannot add module</p>';
		
		
	}

	//Upgrades
	
	
	//functions

	
	function AddColumnIfNotExist($tablename, $columnname, $fieldtype, $options,$showerror=false)
    {
		$db =& JFactory::getDBO();

		$query="ALTER TABLE `".$tablename."` ADD COLUMN `".$columnname."` ".$fieldtype." ".$options.";";
				
		$db->setQuery( $query );
				
		
			if (!$db->query())
			{
				if($showerror)
					echo '<p>'.$db->stderr().'</p>';
			}
	
	}
	
	//end functions
		
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'width', 'int(11)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'height', 'int(11)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'playvideo', 'tinyint(1)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'repeat', 'tinyint(1)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'fullscreen', 'tinyint(1)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'autoplay', 'tinyint(1)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'related', 'tinyint(1)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'showinfo', 'tinyint(1)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'bgcolor', 'varchar(20)', '');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'cols', 'smallint(6)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'showtitle', 'tinyint(1)', 'NOT NULL');
	
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'cssstyle', 'varchar(255)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'navbarstyle', 'varchar(255)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'thumbnailstyle', 'varchar(255)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'linestyle', 'varchar(255)', 'NOT NULL');

	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'showgalleryname', 'varchar(255)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'gallerynamestyle', 'varchar(255)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'showactivevideotitle', 'varchar(255)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'activevideotitlestyle', 'varchar(255)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'color1', 'varchar(20)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'color2', 'varchar(20)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'border', 'tinyint(1)', 'NOT NULL');
	
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'description', 'tinyint(1)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'descr_position', 'smallint(6)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'descr_style', 'varchar(255)', 'NOT NULL');

	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'openinnewwindow', 'tinyint(1)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'rel', 'varchar(255)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'hrefaddon', 'varchar(255)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'pagination', 'smallint(6)', 'NOT NULL');
	
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'customlimit', 'smallint(6)', 'NOT NULL');
	
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'catid', 'int(11)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'controls', 'tinyint(1)', 'NOT NULL default 1');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'youtubeparams', 'varchar(450)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'playertype', 'smallint(6)', 'NOT NULL');
	
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'useglass', 'tinyint(1)', 'NOT NULL default 0');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'logocover', 'varchar(255)', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'cache', 'text', 'NOT NULL');
	//AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'enablecache', 'tinyint(1)', 'NOT NULL default 0');

	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'customlayout', 'text', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'randomization', 'tinyint(1)', 'NOT NULL default 0');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'prepareheadtags', 'tinyint(1)', 'NOT NULL default 0');
	
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'updateperiod', 'smallint(6)', 'NOT NULL default 0');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'lastplaylistupdate', 'datetime', 'NOT NULL');
	AddColumnIfNotExist($db->getPrefix().'youtubegallery', 'muteonplay', 'tinyint(1)', 'NOT NULL default 0');

  
	$db =& JFactory::getDBO();

	$query='
CREATE TABLE IF NOT EXISTS `#__youtubegallery_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(50) NOT NULL,

  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;	
	';
				
	$db->setQuery( $query );
	if (!$db->query())
		echo '<p>'.$db->stderr().'</p>';
	


	$query='
CREATE TABLE IF NOT EXISTS `#__youtubegallery_videos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `galleryid` int(11) NOT NULL,
  `parentid` int(11) NOT NULL,
  `videosource` varchar(30) NOT NULL,
  `videoid` varchar(30) NOT NULL,
  `imageurl` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `custom_imageurl` varchar(255) NOT NULL,
  `custom_title` varchar(255) NOT NULL,
  `custom_description` text NOT NULL,
  `specialparams` varchar(255) NOT NULL,
  `lastupdate` datetime NOT NULL,
  `allowupdates` tinyint(1) NOT NULL default 0,
  `status` smallint(6) NOT NULL,
  `isvideo` tinyint(1) NOT NULL default 0,
  `link` varchar(255) NOT NULL,

  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

	';
				
	$db->setQuery( $query );
	if (!$db->query())
		echo '<p>'.$db->stderr().'</p>';
	

	AddColumnIfNotExist($db->getPrefix().'youtubegallery_videos', 'ordering', 'int(11)', 'NOT NULL default 0');


}

?>
