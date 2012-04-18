<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_archive
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

class modArticlesCommentsHelper
{
	static function getList(&$params)
	{
		//get database
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('cd.id, cd.title, cd.alias, cd.created, cd.catid, COUNT(cm.object_id) AS count, cat.alias AS catalias');
		$query->from('#__content AS cd, #__jcomments AS cm, #__categories AS cat');
		$query->where('cd.id = cm.object_id AND cd.catid=cat.id AND cd.state = 1 AND cm.published=1');
		$query->group("cm.object_id");
		$query->order("COUNT(cm.object_id) DESC, cd.created DESC");
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
			$lists[$i]->count	= $row->count;

			$i++;
		}
		//var_dump($lists); die;
		return $lists;
	}
}
