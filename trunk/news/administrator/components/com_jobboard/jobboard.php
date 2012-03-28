<?php
/**
 * @package JobBoard
 * @copyright Copyright (c)2010 Tandolin
 * @license GNU General Public License version 2, or later
 */

defined('_JEXEC') or die('Restricted Access');


JToolBarHelper::title(JText::_('Job Board'), 'generic.png');
jimport('joomla.application.component.controller');
require_once( JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'jobboard.php' );

// Get the view and controller from the request, or set to default if they weren't set
JRequest::setVar('view', JRequest::getCmd('view','dashboard'));
JRequest::setVar('cont', JRequest::getCmd('view','dashboard')); // Get controller based on the selected view

jimport('joomla.filesystem.file');

// Load the appropriate controller
$cont = JRequest::getCmd('cont','dashboard');
$path = JPATH_COMPONENT_ADMINISTRATOR.DS.'controllers'.DS.$cont.'.php';
$jb_version = '1.5.1';
if(JFile::exists($path))
{
	// The requested controller exists and there you load it...
	require_once($path);
}
else
{
	// Invalid controller was passed
	JError::raiseError('500',JText::_('Unknown controller' . $path));
}
// echo '<div align="center" style="clear: both;padding-top: 15px"><small>developed by&nbsp;<a href="http://figo.tandolin.co.za" target="_blank">Figo&nbsp;Mago</a>,&nbsp;r&d @ <a href="http://www.tandolin.co.za" target="_blank">www.tandolin.co.za</a></small></div>';

?>
