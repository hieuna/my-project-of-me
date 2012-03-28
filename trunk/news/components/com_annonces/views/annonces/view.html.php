<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
jimport( 'joomla.application.component.view');
/**
 * HTML View class for the auto Component
 */
class AnnoncesViewAnnonces extends JView{	function display($tpl = null)	{		global $mainframe;		$document 	= & JFactory::getDocument();		$user		=& JFactory::getUser();		$menu		= & JSite::getMenu();		$item    	= $menu->getActive();		$model	  = &$this->getModel();		$uri 		= & JFactory::getURI();		$parametrage = Util::parametrage();
		$catid = JRequest::getInt('catid', 0);		$lists	= $this->_buildSortLists($parametrage);  		$annonces     = $model->getListeAnnonces( array( 'categorie' => $catid ), $parametrage );  		$showColumns = $model->getShowColumns( $annonces );  		$total 		= $model->getTotal( array( 'categorie' => $catid ), $parametrage );  		$listeCategories = $model->getListCategorieLiens( $catid );  		$limitstart		= JRequest::getInt('limitstart');		$limit       	= $mainframe->getUserStateFromRequest('com_annonces.limit', 'limit', $parametrage->nbpage, 'int');
  		$document->addStyleSheet($this->baseurl.'/components/com_annonces/assets/annonces.css');  		// Create the pagination object
		jimport('joomla.html.pagination');		$pageNav = new JPagination($total, $limitstart, $limit);
		// fil d'ariane
		$pathway = $mainframe->getPathWay();
		if ( isset( $item ) == false )
			$pathway->addItem( JText::_("ADS"), JRoute::_('index.php?view=annonces&view=annonces') );
		
		$k = 0;
		
		for($i = 0; $i <  count( $annonces ); $i++)
		{
			$annonce =& $annonces[$i];
			
			//$contact->link = JRoute::_('index.php?option=com_contact&view=contact&id='.$contact->slug.'&catid='.$contact->catslug, false);
			$annonce->odd	= $k;
			$annonce->count = $i;
			$userVendeur = JFactory::getUser($annonce->vendeurId);
			$annonce->vendeur = $userVendeur->name;
			$annonce->vignette_url= Image::vignetteExists( $annonce->id, 1 );
			
			$k = 1 - $k;
		}
		
		if ($lists['filter']) {
			$uri->setVar('filter', $lists['filter']);
		} else {
			$uri->delVar('filter');
		}
		
		$this->assign('lists', $lists);
		$this->assignRef('annonces'  , $annonces);
		$this->assignRef('user'   , $user);
		$this->assignRef('parametrage', $parametrage);
		$this->assignRef('listeCategories', $listeCategories );
		$this->assignRef('showColumns', $showColumns );
		$this->assign('action', $uri->toString());
		$this->assignRef('pageNav', $pageNav);
		$this->assignRef('item', $item);
		
		parent::display($tpl);
	}	
	
	function _buildSortLists($parametrage)
	{		// Table ordering values		$filter_order		= JRequest::getCmd('filter_order', 'a.objet');		$filter_order_Dir	= JRequest::getCmd('filter_order_Dir', 'ASC');
		$filter				= JRequest::getString('filter');		$filter_type		= JRequest::getString('filter_type');
		$sortselects = array();		$sortselects[]	= JHTML::_('select.option', 'type', 'Type' );		$sortselect 	= JHTML::_('select.genericlist', $sortselects, 'filter_type', 'size="1" class="inputbox"', 'value', 'text', $filter_type );
		$lists['order_Dir'] 	= $filter_order_Dir;		$lists['order'] 		= $filter_order;		$lists['filter'] 		= $filter;
		$lists['filter_type'] 	= $sortselect;
		return $lists;
	}
	
}
?>
