<?php
/**
 * Extra Search Joomla! 1.5 Native Component
 * @version 1.0.2
 * @author Design COmpass corp <admin@designcompasscorp.com>
 * @link http://www.designcompasscorp.com
 * @license GNU/GPL
 **/


// no direct access
defined('_JEXEC') or die('Restricted access');

// Import Joomla! libraries
jimport('joomla.application.component.model');

class YouTubeGalleryModelGalleryEdit extends JModel
{

	
    function __construct()
    {
		parent::__construct();
		$array = JRequest::getVar('cid',  0, '', 'array');

		$this->setId((int)$array[0]);
    }

	function setId($id)
	{
		// Set id and wipe data

		$this->_id	= $id;
		$this->_data	= null;
	}

	function &getData()
	{
		//echo 'fff='.$this->_id.'<br>';
		$row =& $this->getTable();
		$row->load( $this->_id );
		return $row;
	}

	function RefreshPlayist($cids)
	{
				$where=array();
				
				foreach($cids as $cid)
						$where[]= 'id='.$cid;
				
				require_once(JPATH_SITE.DS.'components'.DS.'com_youtubegallery'.DS.'includes'.DS.'misc.php');
				
				 // Create a new query object.         
                
				$db = JFactory::getDBO();
                
				$query = 'SELECT * FROM #__youtubegallery';
				
				if(count($where)>0)
						$query.=' WHERE '.implode(' OR ',$where);
								
				$db->setQuery($query);
				if (!$db->query())    die( $db->stderr());
                
				$rows=$db->loadObjectList();
				if(count($rows)<1)
						return false;
				
				foreach($rows as $row)
				{
						$misc=new YouTubeGalleryMisc;
						$misc->tablerow = &$row;
						$misc->update_cache_table($row,true); 
				
						$query='UPDATE #__youtubegallery SET `lastplaylistupdate`="'.date( 'Y-m-d H:i:s').'" WHERE `id`='.$row->id;
						$db->setQuery($query);
						if (!$db->query())    die( $db->stderr());
						
						//Clear Update Info for each video in this gallery
						$query='UPDATE #__youtubegallery_videos SET `lastupdate`="0000-00-00 00:00:00" WHERE `isvideo` AND `galleryid`='.$row->id;
						$db->setQuery($query);
						if (!$db->query())    die( $db->stderr());
						
						
				}
				
				return true;
	}
        
	function store()
	{
	    
	
		$row =& $this->getTable();
		// consume the post data with allow_html
		$data = JRequest::get( 'post',JREQUEST_ALLOWRAW);
		$post = array();

		if (!$row->bind($data))
		{
			return false;
		}

		// Make sure the  record is valid
		if (!$row->check())
		{
			return false;
		}

		//if($row->enablecache)
			//$row->cache=$this->update_cache($row);
			
				if($row->id!=0)
				{
						require_once(JPATH_SITE.DS.'components'.DS.'com_youtubegallery'.DS.'includes'.DS.'misc.php');
						$misc=new YouTubeGalleryMisc;
						$misc->tablerow = &$row;
						$misc->update_cache_table($row); 
						$row->lastplaylistupdate =date( 'Y-m-d H:i:s');
				}	
						
		// Store
		if (!$row->store())
		{
			return false;
		}

		//Create MySQL Table
		$db = &$this->getDBO();
		

		return true;
	}

	/*
	function update_cache(&$row)
	{
				require_once(JPATH_SITE.DS.'components'.DS.'com_youtubegallery'.DS.'includes'.DS.'misc.php');
				$misc=new YouTubeGalleryMisc;
				$misc->tablerow = &$row;
				
				$gallerylist=YouTubeGalleryMisc::csv_explode("\n", $row->gallerylist, '"', true);
				
				
				
				$firstvideo='';
				$gallerylist=$misc->formGalleryList($gallerylist,$row->showtitle, $row->description, $firstvideo, $row->showactivevideotitle);
				
				
				
				
				$result_array=array();
				
				foreach($gallerylist as $g)
				{
						$g_title=str_replace('"','&quot;',$g['title']);
						$g_description=str_replace('"','&quot;',$g['description']);
						
						$result_array[]=
								'"'.$g['videosource'].'",'
								.'"'.$g['videoid'].'",'
								.'"'.$g['imageurl'].'",'
								.'"'.$g_title.'",'
								.'"'.$g_description.'"';
				}
				
				$result=implode(';',$result_array);
				
				//echo 'result='.$result.'<br>';
				//die;
				return $result;
	}
	*/
		
	function ConfirmRemove()
	{
		
		$cancellink='index.php?option=com_youtubegallery&controller=galleries';
		
		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$deletelink='index.php?option=com_youtubegallery&controller=galleries&task=remove_confirmed&cid[]='.implode('*',$cid);
		
		

		//$db = & JFactory::getDBO();
		
		//Get Table Name
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		if (count( $cids ))
		{
			echo '<p>Delete gallery? <a href="'.$cancellink.'">No. Cancel.</a></p>
		

		';
		
		//			<a href="'.$deletelink.'">Yes. I want to delete.</a>
		 echo '
            <form action="index.php?option=com_youtubegallery" method="post" >
            <input type="hidden" name="task" value="remove_confirmed" />
            ';
            $i=0;
            foreach($cids as $cid)
            {
                echo '<input type="hidden" id="cid'.$i.'" name="cid[]" value="'.$cid.'">';
            }
            
            echo '
            <input type="submit" value="'.JText::_( 'Yes. I want to delete.' ).'" class="button" />
            </form>
		';
		
		
		}
		else
		{
			
			echo '<p><a href="'.$cancellink.'">Select items first</a></p>';
		}
		
		
		
		
		

		
		
	}
	function delete($cids)
	{
		$db = & JFactory::getDBO();
		
		$row =& $this->getTable();

		if (count( $cids ))
		{
			foreach($cids as $cid)
			{
						
				
				if (!$row->delete( $cid ))
				{
					return false;
				}
			}
		}
		
		
		
		return true;
	}
	

	function copyItem($cid)
	{


	    $item =& $this->getTable();
	    
		
	    foreach( $cid as $id )
	    {
			
		
		$item->load( $id );
		$item->id 	= NULL;
		
			$old_title=$item->galleryname;
			$new_title='Copy of '.$old_title;
		
		$item->galleryname 	= $new_title;
			
	
		
		if (!$item->check()) {
			return false;
		}

		if (!$item->store()) {
			return false;
		}
		$item->checkin();
			
	    }
		
	

	    return true;
	}
	

	

}

?>