<?php

/**
* @version		$Id: admin.content.php 10381 2009-10-09 03:35:53Z pasamio $
* @package		Joomla
* @subpackage	Content
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//Require the submenu for component
jimport('joomla.utilities.date');
jimport( 'joomla.application.component.view');
//include the needed helpers
require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'ngrabnews.class.php');
require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'inc'.DS.'func_engine.php');
require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'inc'.DS.'func_common.php');
require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'inc'.DS.'func_urls.php');
require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'inc'.DS.'func_fixer.php');
require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'ngrabnews.config.php');
require_once (JPATH_COMPONENT_SITE.DS.'CronParser.class.php');

/*
 * Make sure the user is authorized to view this page
 */
$user = & JFactory::getUser();
/*if (!$user->authorize( 'com_product', 'manage' )) {
	$mainframe->redirect( 'index.php', JText::_('ALERTNOTAUTH') );
}*/

// Require the base controller
require_once (JPATH_COMPONENT.DS.'controller.php');
if(!JRequest::getVar('view')) JRequest::setVar('view', 'cron');

// Require specific controller if requested
if($controller = JRequest::getCmd('view', 'cron')) {
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
    if(file_exists($path)) {
        require_once $path;
    } else {
        $controller = '';
    }
}

$classname = 'NgrabnewsController'.$controller;
$controller = new $classname();

// Perform the Request task
$controller->execute( JRequest::getCmd('task'));
$controller->redirect();

?>