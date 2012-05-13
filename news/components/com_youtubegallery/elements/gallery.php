<?php
/**
 * YouTubeGallery Joomla! 1.5 Native Component
 * @version 1.1.4
 * @author DesignCompass Corp <admin@designcompasscorp.com>
 * @link http://www.designcompasscorp.com
 * @license GNU/GPL
 **/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

class JElementGallery extends JElement
{

	var	$_name = 'gallery';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$db = &JFactory::getDBO();

		$query = 'SELECT id, galleryname '
		. ' FROM #__youtubegallery '
		. ' ORDER BY id'
		;
		$db->setQuery( $query );
		$options = $db->loadObjectList( );
		if(!$options) $options = array();
		
		return JHTML::_('select.genericlist',  $options, $control_name.'['.$name.']', 'class="inputbox"', 'id', 'galleryname', $value);//, $control_name.$name );
	}
}