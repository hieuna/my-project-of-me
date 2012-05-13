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

/*
 * Define constants for all pages
 */
//define( 'COM_YOUTUBEGALLERY_DIR', 'images'.DS.'youtubegalery'.DS );
//define( 'COM_YOUTUBEGALLERY_BASE', JPATH_ROOT.DS.COM_YOUTUBEGALLERY_DIR );
//define( 'COM_YOUTUBEGALLERY_BASEURL', JURI::root().str_replace( DS, '/', COM_YOUTUBEGALLERY_DIR ));

$controllerName = JRequest::getCmd( 'controller', 'galleries' );


switch($controllerName)
{
	

	default:
	
		JSubMenuHelper::addEntry(JText::_('Galleries'), 'index.php?option=com_youtubegallery&controller=galleries', true);
		
		

	break;
}
require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controllerName.'.php' );


$controllerName = 'YouTubeGalleryController'.$controllerName;
$controller	= new $controllerName( );


// Perform the Request task
$controller->execute( JRequest::getCmd('task'));
$controller->redirect();
?>