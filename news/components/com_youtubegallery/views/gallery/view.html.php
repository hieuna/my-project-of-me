<?php
/**
 * YouTubeGallery Joomla! 1.5 Native Component
 * @version 1.0.2
 * @author DesignCompass Corp <admin@designcompasscorp.com>
  * @link http://www.designcompasscorp.com
 * @license GNU/GPL
 **/

// no direct access
defined('_JEXEC') or die('Restricted access');



jimport( 'joomla.application.component.view');
class YouTubeGalleryViewGallery extends JView {
        var $catid=0;
	function display($tpl = null)
	{
		//global $mainframe;
      
		$Model =& $this->getModel();
		$this->assignRef('Model',$Model);
		
		
        parent::display($tpl);
	}
	


	
}
?>
