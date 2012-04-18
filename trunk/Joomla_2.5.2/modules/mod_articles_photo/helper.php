<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_archive
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

class modArticlesPhotoHelper
{
	static function getList(&$params)
	{
		//get database
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('c.id, c.title, c.alias, c.introtext, c.images, c.catid, cd.alias AS catalias');
		$query->from('#__content AS c, #__categories AS cd');
		$query->where('c.catid = cd.id');
		$query->where('c.state = 1 AND c.photo = 1');
		//echo $query;

		// Filter by language
		if (JFactory::getApplication()->getLanguageFilter()) {
			$query->where('language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')');
		}

		$db->setQuery($query, 0, intval($params->get('count')));
		$rows = (array) $db->loadObjectList();

		$app	= JFactory::getApplication();
		$menu	= $app->getMenu();
		$item	= $menu->getItems('link', 'index.php?option=com_content&view=archive', true);
		$itemid = isset($item) ? '&Itemid='.$item->id : '';

		$i		= 0;
		$lists	= array();
		foreach ($rows as $row) {
			$date = JFactory::getDate($row->created);
			$slug = $row->id.':'.$row->alias;
			$catslug = $row->catid.':'.$row->catalias;

			$lists[$i] = new stdClass;

			$lists[$i]->link	= JRoute::_(ContentHelperRoute::getArticleRoute($slug, $catslug));
			$lists[$i]->title	= $row->title;
			$lists[$i]->introtext = $row->introtext;
			$lists[$i]->images	= $row->images;

			$i++;
		}
		//var_dump($lists); die;
		return $lists;
	}
}
