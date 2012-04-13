<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_archive
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

class modArticlesFocusHelper
{
	static function getList(&$params)
	{
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		if ($option === 'com_content') {
			switch($view)
			{
				case 'category':
					$catids = array(JRequest::getInt('id'));
					break;
				case 'categories':
					$catids = array(JRequest::getInt('id'));
					break;
				case 'article':
					if ($params->get('show_on_article_page', 1)) {
						$article_id = JRequest::getInt('id');
						$catid = JRequest::getInt('catid');

						if (!$catid) {
							// Get an instance of the generic article model
							$article = JModel::getInstance('Article', 'ContentModel', array('ignore_request' => true));

							$article->setState('params', $appParams);
							$article->setState('filter.published', 1);
							$article->setState('article.id', (int) $article_id);
							$item = $article->getItem();

							$catids = array($item->catid);
						}
						else {
							$catids = array($catid);
						}
					}
					else {
						$catids = $params->get('catid');						
					}					

				case 'featured':
				default:
					$catids = $params->get('catid');
					break;
			}
		}
		if ($catids){			
			if ($catids[0] == "") $condition = "";
			else{ 
				$i = 0;
				foreach($catids as $cate){
					$i++;
					if ($i == count($catids)) $str = "";
					else $str = ",";
					if (intval($cate)>0) $array .= $cate.$str;
				}
				//echo $array;
				$condition = " AND catid IN(".$array.")";
			}
		}
		//get database
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('id, title, alias, catid');
		$query->from('#__content');
		$query->where('state = 1 AND focus = 1'.$condition);
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
			$item->slug = $row->id.':'.$row->alias;
			$item->catslug = $row->catid;

			$lists[$i] = new stdClass;

			$lists[$i]->link	= JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug));
			$lists[$i]->title	= $row->title;

			$i++;
		}
		//var_dump($lists); die;
		return $lists;
	}
}
