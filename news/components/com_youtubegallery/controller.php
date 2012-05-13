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

jimport('joomla.application.component.controller');
class YouTubeGalleryController extends JController {
	function display() {
		// Make sure we have a default view
		if(!JRequest::getVar( 'view' ))
		{
				JRequest::setVar('view', 'gallery' );
			    parent::display();
				
		}
		else
		{
				
			parent::display();			
		
		}
	}
}
?>