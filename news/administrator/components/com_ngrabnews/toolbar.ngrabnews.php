<?php 
/** ensure this file is being included by a parent file */ 
defined('_JEXEC') or die('Direct Access to this location is not allowed.'); 
// Include toolbar's HTML class 
require_once($mainframe->getPath('toolbar_html')); 
$view	= JRequest::getCmd('act','');

JHTML::_('behavior.switcher');

// Load submenu's
$views	= array(
					'license' 		=> JText::_('License'),
					'filter' 	=> JText::_('Filter'),
					'cron' 	=> JText::_('Auto Run'),
					'logs'		=> JText::_('Logs'),
				);

foreach( $views as $key => $val )
{
	$active	= ( $view == $key );
	$key= $key?'&act='.$key:'';
	JSubMenuHelper::addEntry( $val , 'index.php?option=com_ngrabnews' . $key , $active );
}

switch($act) { 

  case 'filter': 
    switch ($task) { 
      case 'add': 
        TOOLBAR_ngrabnews::editButtons_default(); 
        break; 
      case 'edit': 
        TOOLBAR_ngrabnews::editButtons_default();  
        break; 
      default:  
        TOOLBAR_ngrabnews::FilterButtons_default();
        break; 
    } 
    break; 

  case 'cron': 
    switch ($task) { 
      case 'add': 
        TOOLBAR_ngrabnews::editButtons_default(); 
        break; 
      case 'edit': 
        TOOLBAR_ngrabnews::editButtons_default();  
        break; 
      default:  
        TOOLBAR_ngrabnews::CronButtons_default();
        break; 
    } 
    break; 
	
  case 'logs': 
    switch ($task) { 
      default:  
        TOOLBAR_ngrabnews::LogsButtons_default();
        break; 
    } 
    break; 

}

?> 

