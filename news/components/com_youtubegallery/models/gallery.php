<?php
/**
 * YouTubeGallery Joomla! 1.5 Native Component
 * @version 2.1.9
 * @author DesignCompass Corp <admin@designcompasscorp.com>
  * @link http://www.designcompasscorp.com
 * @license GNU/GPL
 **/
error_reporting(E_ALL ^ E_NOTICE); 
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

require_once(JPATH_SITE.DS.'components'.DS.'com_youtubegallery'.DS.'includes'.DS.'misc.php');

class YouTubeGalleryModelGallery extends JModel {
		
		
		var $galleryid;
		var $gallery_list;
		var $YouTubeGalleryMisc;
		var $row;
		var $misc;
		var $total_number_of_rows;
	
		function __construct()
		{
				$db = & JFactory::getDBO();
				$this->misc=new YouTubeGalleryMisc;

				
				$this->galleryid=0;
				//$this->gallery_name='[GALLERY NOT FOUND]';
			
				
				//$this->video_width=300;
				//$this->video_height=300;
				
		        parent::__construct();
				global $mainframe;
				
				$params = &JComponentHelper::getParams( 'com_youtubegallery' );
				
				if(JRequest::getVar('galleryid'))
				{
						$this->galleryid=JRequest::getInt('galleryid',0);
				}
				else
				{
						
						$this->galleryid=(int)$params->get( 'galleryid' );
				}
				
				
				$query = 'SELECT * FROM #__youtubegallery WHERE id='.$this->galleryid.' LIMIT 1';
				$db->setQuery($query);
				
				if (!$db->query())    echo ( $db->stderr());
				$rows = $db->loadObjectList();
				
				$this->row=array();
				
				if(count($rows)==0)
				{
						echo '<p>Gallery not found</p>';
						return false;
				}
				
				
				$this->row=$rows[0];
				$misc->tablerow = &$this->row;

				$this->total_number_of_rows=0;
							
				$this->misc->update_playlist($this->row);
								
				$videoid=JRequest::getVar('videoid');
		
				if($this->row->playvideo==1 and $videoid!='')
					$this->row->autoplay=1;

				$videoid_new=$videoid;
				$this->gallery_list=$this->misc->getGalleryList_FromCache_From_Table($this->row->id,$videoid_new,$this->total_number_of_rows);
							
				if($videoid=='')
				{
						if($this->row->playvideo==1 and $videoid_new!='')
								JRequest::setVar('videoid',$videoid_new);
				}
				

		}
	
}
?>
