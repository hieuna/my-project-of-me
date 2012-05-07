<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

global $mainframe;

$view		= JRequest::getCmd('view');

if ($view == 'article')
{

   $temp = JRequest::getString('id');
   $temp = explode(':', $temp);
   $uid = $temp[0];

	$db 		= & JFactory::getDBO();

   $query = 'SELECT *' .
      ' FROM #__content' .
      ' WHERE id = '.(int) $uid;
   $db->setQuery($query);

   $row = $db->loadObject();
   
 	$html 		= '';
	$user		= & JFactory::getUser();
	$nullDate	= $db->getNullDate();

	$date		=& JFactory::getDate();
	$config 	= & JFactory::getConfig();
	$now 		= $date->toMySQL();

	$option 	= 'com_content';
	$canPublish = $user->authorize('com_content', 'publish', 'content', 'all');

		// the following is needed as different menu items types utilise a different param to control ordering
		// for Blogs the `orderby_sec` param is the order controlling param
		// for Table and List views it is the `orderby` param
	$params_list = $params->toArray();

/*
	if (array_key_exists('orderby_sec', $params_list)) {
		$order_method = $params->get('orderby_sec', '');
	} else {
		$order_method = $params->get('orderby', '');
	}
		// additional check for invalid sort ordering
	if ( $order_method == 'front' ) {
		$order_method = '';
	}
*/

   $order_method = "rdate";
   
		// Determine sort order
	switch ($order_method)
	{
		case 'date' :
			$orderby = 'a.created';
			break;

		case 'rdate' :
			$orderby = 'a.created DESC';
			break;

		case 'alpha' :
			$orderby = 'a.title';
			break;

		case 'ralpha' :
			$orderby = 'a.title DESC';
			break;

		case 'hits' :
			$orderby = 'a.hits';
			break;

		case 'rhits' :
			$orderby = 'a.hits DESC';
			break;

		case 'order' :
			$orderby = 'a.ordering';
			break;

		case 'author' :
			$orderby = 'a.created_by_alias, u.name';
			break;

		case 'rauthor' :
			$orderby = 'a.created_by_alias DESC, u.name DESC';
			break;

		case 'front' :
			$orderby = 'f.ordering';
			break;

		default :
			$orderby = 'a.ordering';
			break;
	}

	$xwhere = ' AND ( a.state = 1 OR a.state = -1 )';// .
		//' AND ( publish_up = '.$db->Quote($nullDate).' OR publish_up <= '.$db->Quote($now).' )' .
		//' AND ( publish_down = '.$db->Quote($nullDate).' OR publish_down >= '.$db->Quote($now).' )';

		// array of articles in same category correctly ordered
	$query = 'SELECT a.*,cc.title as category_name,'
		. ' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'
		. ' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug'
		. ' FROM #__content AS a'
		. ' LEFT JOIN #__categories AS cc ON cc.id = a.catid'
		. ' WHERE a.catid = ' . (int) $row->catid
		. ' AND a.state = '. (int) $row->state
		//. ($canPublish ? '' : ' AND a.access <= ' .(int) $user->get('aid', 0))
		. $xwhere
		. ' ORDER BY '. $orderby;
	$db->setQuery($query);
	$list = $db->loadObjectList();

		// this check needed if incorrect Itemid is given resulting in an incorrect result
	if ( !is_array($list) ) {
		$list = array();
	}

   if (count($list) > 1)
   {

      $html .= "<h3 class=contentheading>Các bài viết khác trong {$list[0]->category_name}</h3>\n";
      
      $row_count = 0;
      $num_articles = $params->get('num_articles', 5) - 1;
	  $nows = mktime(0,0,0,date("m"),date("d"),date("Y"));
      foreach ($list as $row)
      {
         if ($row_count > $num_articles)
            break;
//  skip the current article
         if ($row->id == $uid)
            continue;   
         $link = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catslug,$row->sectionid));
         $date =& JFactory::getDate($row->created);
         $ngay_nhap = mktime(0,0,0,unFormatdate($row->created,"m"),unFormatdate($row->created,"d"),unFormatdate($row->created,"Y"));
         $days = ($nows - $ngay_nhap)/86400;
		 if ($days<2) $addClass = ' newnew';
		 else $addClass = '';
         $datex = $date->toFormat("%d %B %Y");
         $html .= "<p><a href=$link>{$row->title}</a> <span class='date$addClass'>$datex</span></p>";       
         $row_count++;
      }

		preg_match("#^(.*)(\/.*?)$#", $link, $matches);
		
		$link = $matches[1];
//		echo "<h4>link=$link 1={$matches[1]} 2={$matches[2]}</h4>\n";
		//$html .= "<p><a href=$link>- Entire Category -</a></p>\n";
    
   			// display after content
		echo $html;
	}
}
