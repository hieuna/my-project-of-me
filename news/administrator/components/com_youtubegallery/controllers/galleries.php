<?php
/**
 * Extra Search Joomla! 1.5 Native Component
 * @version 1.1.8
 * @author Design COmpass corp <admin@designcompasscorp.com>
 * @link http://www.designcompasscorp.com
 * @license GNU/GPL
 **/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.controller');


class YouTubeGalleryControllerGalleries extends JController
{
	/**
	 * New option item wizard
	 */
	function display()
	{
		JRequest::setVar( 'view', 'galleries');
		
		parent::display();
	}


	function newItem()
	{
		JRequest::setVar( 'view', 'galleryedit');
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);
		parent::display();
	}

	function edit()
	{
		
		JRequest::setVar( 'view', 'galleryedit');
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);
		parent::display();
	}

	/**
	 * Saves a option item
	 */
	
	function save()
	{
		// get our model
		$model = &$this->getModel('galleryedit');
		// attempt to store, update user accordingly
		
		if($this->_task == 'save')
		{
			$link 	= 'index.php?option=com_youtubegallery&controller=galleries';
		}
		
		
		if ($model->store())
		{
			$msg = JText::_( 'Gallery Saved Successfully' );
			$this->setRedirect($link, $msg);
		}
		else
		{
			$msg = JText::_( 'Gallery was Unabled to Save');
			$this->setRedirect($link, $msg, 'error');
		}

		
			
	}

	public function refreshItem()
	{
				
				$model =&$this->getModel('galleryedit');
        	
				
				$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
	    
				if (count($cid)<1) {
		
				       $this->setRedirect( 'index.php?option=com_youtubegallery&controller=galleries', JText::_('No Items Selected'),'error' );
                
						return false;
				}
					    	    
				if($model->RefreshPlayist($cid))
				{
						$msg = JText::_( 'Gallery(s) Refreshed Successfully' );
						$link 	= 'index.php?option=com_youtubegallery&controller=galleries';
						$this->setRedirect($link, $msg);
				}
				else
				{
						$msg = JText::_( 'Gallery(s) was Unabled to Refresh' );
						$link 	= 'index.php?option=com_youtubegallery&controller=galleries';
						$this->setRedirect($link, $msg,'error');
				}

	}
		
		
	/**
	* Cancels an edit operation
	*/
	function cancelItem()
	{
		global $mainframe;

		//JRequest::checkToken() or jexit( 'Invalid Token' );

		
		$model = $this->getModel('item');
		$model->checkin();

		$this->setRedirect( 'index.php?option=com_youtubegallery&controller=galleries');
	}

	/**
	* Cancels an edit operation
	*/
	function cancel()
	{
		$this->setRedirect( 'index.php?option=com_youtubegallery&controller=galleries');
	}

	/**
	* Form for copying item(s) to a specific option
	*/
	

	



	function remove()
	{
		
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		
		$model =& $this->getModel('galleryedit');
		
		$model->ConfirmRemove();
	}
	
	function remove_confirmed()
	{
		

		// Get some variables from the request
		
		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (!count($cid)) {
			$this->setRedirect( 'index.php?option=com_youtubegallery&controller=galleries', JText::_('No Items Selected') );
			return false;
		}

		$model =& $this->getModel('galleryedit');
		if ($n = $model->delete($cid)) {
			$msg = JText::sprintf( 'Gallery(s) deleted', $n );
		} else {
			$msg = $model->getError();
		}
		$this->setRedirect( 'index.php?option=com_youtubegallery&controller=galleries', $msg );
	}

	
	function copyItem()
	{
	    $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
	    
	    
	    
	    $model = $this->getModel('galleryedit');
	    
	    
	    if($model->copyItem($cid))
	    {
		$msg = JText::_( 'Gallery(s) Copied Successfully' );
	    }
	    else
	    {
		$msg = JText::_( 'Gallery(s) was Unabled to Copy' );
	    }
	    
	    $link 	= 'index.php?option=com_youtubegallery&controller=galleries';
	    $this->setRedirect($link, $msg);
	}


	
}
