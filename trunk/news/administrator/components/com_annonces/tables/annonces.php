<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined('_JEXEC') or die('Restricted access');

class TableAuto extends JTable
{
	/** @var int Primary key */
	var $id					= 0;
	/** @var string */
	var $text				= '';
	/** @var string */
	var $hersteller	  		= '';
	/** @var string */
	var $photo_klein		= '';
	/** @var string */
	var $photo_gross		= '';
	/** @var string */
	var $published			= 0;
	/** @var int */

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableAuto(& $db) {
		parent::__construct('#__auto', 'id', $db);
	}
}
?>
