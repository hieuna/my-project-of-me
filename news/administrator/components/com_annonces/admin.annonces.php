<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once (JPATH_COMPONENT_SITE.DS.'classes'.DS.'util.class.php');
require_once (JPATH_COMPONENT_SITE.DS.'classes'.DS.'image.class.php');
require_once (JPATH_COMPONENT_SITE.DS.'classes'.DS.'mail.class.php');

// Set the table directory
JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');

// Require the base controller
require_once (JPATH_COMPONENT.DS.'controller.php');

// Require specific controller if requested
if( $controller = JRequest::getWord('controller') ) {
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if (file_exists($path)) {
		require_once $path;
	} else {
		$controller = '';
	}
}

//Create the controller
$classname  = 'AnnoncesController'.$controller;
$controller = new $classname();

// Perform the Request task
$controller->execute( JRequest::getWord('task'));
$controller->redirect();
?>