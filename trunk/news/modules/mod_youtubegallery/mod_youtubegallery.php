<?php
/**
 * YouTubeGallery Joomla! 1.5 Native Component
 * @version 2.1.9
 * @author DesignCompass Corp <admin@designcompasscorp.com>
 * @link http://www.designcompasscorp.com
 * @license GNU/GPL
 **/

// no direct access
defined('_JEXEC') or die('Restricted access');
    
	
$galleryid=(int)$params->get('galleryid');

if($galleryid!=0)
{
		

	require_once(JPATH_SITE.DS.'components'.DS.'com_youtubegallery'.DS.'includes'.DS.'render.php');
	require_once(JPATH_SITE.DS.'components'.DS.'com_youtubegallery'.DS.'includes'.DS.'misc.php');
	
	$renderer= new YouTubeGalleryRenderer;


	
	//Load GALLERY ROW
	$db = & JFactory::getDBO();
				
	$query = 'SELECT * FROM #__youtubegallery WHERE id='.$galleryid.' LIMIT 1';
	$db->setQuery($query);
	if (!$db->query())    die ( $db->stderr());
		
		
	$rows = $db->loadObjectList();
			
	if(count($rows)==0)
		return '';
			
	$row=$rows[0];

	$misc=new YouTubeGalleryMisc;
	$misc->tablerow = &$row;

	$total_number_of_rows=0;
							
	$misc->update_playlist($row);
								
	$videoid=JRequest::getVar('videoid');

	if($row->playvideo==1 and $videoid!='')
		$row->autoplay=1;

	$videoid_new=$videoid;
	$gallerylist=$misc->getGalleryList_FromCache_From_Table($galleryid,$videoid_new,$total_number_of_rows);
							
	if($videoid=='')
	{
		if($row->playvideo==1 and $videoid_new!='')
			JRequest::setVar('videoid',$videoid_new);
	}
			
	$renderer= new YouTubeGalleryRenderer;
		
	$result=$renderer->render(
								 $gallerylist,
								 $galleryid,
								 $row,
								 $total_number_of_rows
								 );
	
	echo	$result;


}	
	
?>

