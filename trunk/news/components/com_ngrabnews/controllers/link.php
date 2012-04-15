<?php


/**
/**
* @version		$Id: cron.php Nov 1, 2009
* @package		ecom
* @copyright	Copyright (C) 2007 - 2009 NhutCorp. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class NgrabnewsControllerLink extends NgrabnewsController {
	function dostep() {
		$task = JRequest::getVar('task')?JRequest::getVar('task'):JRequest::getVar('layout', null, 'default', 'cmd');
		$this->execute($task);
	}
	function go(){
		global $mainframe;
		$relink = JRequest::getVar( 'url', '', 'GET', 'string' );
		$mainframe->redirect(base64_decode($relink));
		exit();
	}
}
?>
