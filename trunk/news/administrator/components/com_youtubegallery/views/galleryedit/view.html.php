<?php
/**
 * Extra Search Joomla! 1.5 Native Component
 * @version 1.0.2
 * @author Design COmpass corp <admin@designcompasscorp.com>
 * @link http://www.designcompasscorp.com
 * @license GNU/GPL
 **/

defined('_JEXEC') or die('Restricted access');



// Import Joomla! libraries
jimport( 'joomla.application.component.view');
class YouTubeGalleryViewGalleryEdit extends JView
{
    function display($tpl = null)
    {
		global $mainframe;
		

		$row =& $this->get('Data');

		$this->assignRef('tableid',	$row->id);
		
		
		$isNew= ($row->id < 1);
		$this->assignRef('isNew',$isNew);

		$text = $isNew ? JText::_( 'NEW' ) : JText::_( 'EDIT' );
		JToolBarHelper::title(   JText::_( 'YouTube Gallery', 'generic.png' ).': <small><small>[ '. $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		$Model =& $this->getModel();
		$this->assignRef('Model',		$Model);
		
    
       	$this->assignRef('row',$row);
		
		
		
        parent::display($tpl);
    }
}
?>
