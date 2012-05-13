<?php
/**
 * Extra Search Joomla! 1.5 Native Component
 * @version 2.1.9
 * @author Design COmpass corp <admin@designcompasscorp.com>
 * @link http://www.designcompasscorp.com
 * @license GNU/GPL
 **/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');

error_reporting(E_ALL);


class YouTubeGalleryViewGalleries extends JView
{
    function display($tpl = null)
    {

		global $mainframe;
		
		

		JToolBarHelper::title(JText::_('YouTube Gallery - Galleries'), 'generic.png');
		
		
		JToolBarHelper::addNewX('newItem');
		
		JToolBarHelper::customX( 'copyItem', 'copy.png', 'copy_f2.png', 'Copy', true);
		JToolBarHelper::customX( 'refreshItem', 'forward.png', 'forward_f2.png', 'Update', true);
		//JToolBarHelper::customX( 'refreshItem', 'refresh.png', 'refresh_f2.png', 'Refresh', true);
		JToolBarHelper::deleteListX();


		$db = & JFactory::getDBO();

		$context			= 'com_youtubegallery.galleries.';

		$filter_order		= $mainframe->getUserStateFromRequest( $context.'filter_order',		'filter_order',		's.id',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',	'filter_order_Dir',	'',			'word' );
		
		$search				= $mainframe->getUserStateFromRequest( $context.'search',			'search',			'',			'string' );
		
		$limit		= $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );

		$where = array();

		if ($search)
		{
			$where[] = 'LOWER(s.galleryname) LIKE '.$db->Quote( '%'.$db->getEscaped($search,true).'%', false );

		}

		$where		= count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '';
		
		$orderby	= 'ORDER BY '. $filter_order .' '. $filter_order_Dir ;
		
		$query = 'SELECT COUNT(*)'
		. ' FROM #__youtubegallery AS s '
		. $where
		;
		$db->setQuery( $query );
		if (!$db->query())    echo ( $db->stderr());
		$total = $db->loadResult();
		
		//echo $total;
		//echo 'total='.$total;exit;

		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );

		$query = 'SELECT s.* FROM #__youtubegallery AS s '
		. $where 
		. $orderby
		;

		
		$db->setQuery($query, $pageNav->limitstart, $pageNav->limit );
		if (!$db->query())    echo ( $db->stderr());
		
		$rows = $db->loadObjectList();
		
		if(!isset($rows))
		{
			echo '
			Database error, cannot get list of galleries.
			';
			die;
		}
		
		foreach($rows as $r)
			$r->checked_out='';


		$javascript		= 'onchange="document.adminForm.submit();"';

		$lists['order_Dir']	= $filter_order_Dir;
		$lists['order']		= $filter_order;

		// search filter
		$lists['search']= $search;
		$this->assignRef('items',		$rows);
		$this->assignRef('pagination',		$pageNav);
		$this->assignRef('lists',		$lists);


		parent::display($tpl);
    }
}
?>