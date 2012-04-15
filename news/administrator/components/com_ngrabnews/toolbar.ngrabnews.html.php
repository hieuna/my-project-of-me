<?php 
/** ensure this file is being included by a parent file */ 
defined('_JEXEC') or die('Direct Access to this location is not allowed.'); 

class TOOLBAR_ngrabnews { 
	
    function FilterButtons_default() { 
		JToolBarHelper::title( JText::_( 'Filter Spider' ), 'filter' );
        JToolBarHelper::deleteList(); 
        JToolBarHelper::editList(); 
        JToolBarHelper::addNew(); 
    } 

    function CronButtons_default() { 
        // Open the table that contains the buttons 
		JToolBarHelper::title( JText::_( 'Auto run' ), 'cron' );
        JToolBarHelper::custom('run', 'runnow', 'runnow', JText::_( 'Run Now' ),true) ; 
        JToolBarHelper::publish(); 
        JToolBarHelper::unpublish(); 
        JToolBarHelper::deleteList(); 
        JToolBarHelper::editList(); 
        JToolBarHelper::addNew(); 
    } 

	function editButtons_default() {
		global $cid;
		JToolBarHelper::title( JText::_( 'Edit' ), 'edit' );
 		JToolBarHelper::save( 'save' );
		JToolBarHelper::spacer();
		if ( $cid ) {
			// for existing content items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', JText::_( 'Close' ) );
		} else {
			JToolBarHelper::cancel( 'cancel' );
		}
	}

    function LogsButtons_default() { 
		JToolBarHelper::title( JText::_( 'View logs' ), 'logs' );
        JToolBarHelper::deleteList(); 
    } 

} 

?> 

