<?php 
/**
 * @version		1.3 com_annonces - petites annonces $
 * @package		simple_ads_-_petites_annonces
 * @copyright	Copyright (c) 2011 - All rights reserved.
 * @license		GNU/GPL
 * @author		Anthony JULOU
 * @author mail	ajulou@yahoo.fr
 *
 **/
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class AnnoncesViewCategories extends JView
{
	/**
	 * Hellos view display method
	 * @return void
	 **/
	function display($tpl = null)	{
		global $option;
		$mainframe = &JFactory::getApplication();
		$document	= & JFactory::getDocument();
		$user 		= & JFactory::getUser();
		
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'.annonces_cat.filter_order', 'filter_order', 	'c.id', 'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'.annonces_cat.filter_order_Dir', 'filter_order_Dir',	'', 'word' );
		$filter_state 		= $mainframe->getUserStateFromRequest( $option.'.annonces_cat.filter_state', 'filter_state', 	'*', 'word' );
		
		
		JToolBarHelper::title( JText::_( 'CATEGORIES' ), 'home' );
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();
		
		JSubMenuHelper::addEntry( JText::_( 'ADS' ), 'index.php?option=com_annonces&view=annonces', true);
		JSubMenuHelper::addEntry( JText::_( 'CATEGORY' ), 'index.php?option=com_annonces&view=categories', false);
		if ($user->get('gid') >=23 ) {
			JSubMenuHelper::addEntry( JText::_( 'CONFIGURATION' ), 'index.php?option=com_annonces&controller=parameters&task=edit', true);
		}
	
		//add css and submenu to document
		$document->addStyleSheet('/components/com_annonces/assets/adminannonces.css');
		
		JHTML::_('behavior.tooltip');
		JHTML::_('behavior.modal', 'a.modal');
		
		$lists['state']	= JHTML::_('grid.state', $filter_state );
		
		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;
		
		// Get data from the model
		$items		= & $this->get( 'Data');
		$pageNav 	= & $this->get( 'Pagination' );
		
		$ordering = ($lists['order'] == 'c.ordering');
	
		//assign data to template

		$this->assignRef('ordering'		, $ordering);
		$this->assignRef('items',		$items);
		$this->assignRef('pageNav' 		, $pageNav);
		$this->assignRef('lists'      	, $lists);
	
		parent::display($tpl);	}
}
