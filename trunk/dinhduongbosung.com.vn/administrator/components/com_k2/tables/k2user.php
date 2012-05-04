<?php
/**
 * @version		$Id: k2user.php 1492 2012-02-22 17:40:09Z joomlaworks@gmail.com $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class TableK2User extends JTable
{

	var $id = null;
	var $userID = null;
	var $userName = null;
	var $gender = null;
	var $description = null;
	var $image = null;
	var $url = null;
	var $group = null;
	var $plugins = null;
	var $ip = null;
	var $hostname = null;
	var $notes = null;

	function __construct( & $db) {
	
		parent::__construct('#__k2_users', 'id', $db);
	}
	
	function check() {
	
		if (trim($this->url) != '' && substr($this->url, 0, 7) != 'http://')
		$this->url = 'http://'.$this->url;
		return true;
	}
	
	function bind($array, $ignore = '')	{
	
		if (key_exists('plugins', $array) && is_array($array['plugins'])) {
			$registry = new JRegistry();
			$registry->loadArray($array['plugins']);
			$array['plugins'] = $registry->toString();
		}
		
		return parent::bind($array, $ignore);
	}
	
}
