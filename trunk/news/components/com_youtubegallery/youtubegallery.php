<?php
/**
 * YouTubeGallery Joomla! 1.5 Native Component
 * @version 1.0.2
 * @author DesignCompass Corp <admin@designcompasscorp.com>
  * @link http://www.designcompasscorp.com
 * @license GNU/GPL
 **/

// no direct access
error_reporting(E_ALL & E_NOTICE);

defined('_JEXEC') or die('Restricted access');

// Require the base controller
require_once JPATH_COMPONENT.DS.'controller.php';

// Initialize the controller
$controller = new YouTubeGalleryController();
$controller->execute( null );

// Redirect if set by the controller
$controller->redirect();

?>