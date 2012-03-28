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
jimport('joomla.application.component.model');

/**
 *Auto Component Auto Model
 *
 */
class AnnoncesModelAnnonces extends JModel
{
	var $_total = null;
	
	var $_pagination = null;
	
	/**
	 * Constructeur
	 * @return unknown_type
	 */
	function __construct()
	{
		parent::__construct();

		global $mainframe;
		$parametrage = Util::parametrage();

		// Get the paramaters of the active menu item
		$params 	= & $mainframe->getParams();

		//get the number of events from database
		$limit       	= $mainframe->getUserStateFromRequest('com_annonces.limit', 'limit', $parametrage->nbpage, 'int');
		$limitstart		= JRequest::getInt('limitstart');

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);

		$filter_order = $mainframe->getUserStateFromRequest('com_covehiculage.filter_order', 'filter_order', 'a.date', 'string');
		$this->setState('filter_order', $filter_order );
		
		$filter_order_Dir = $mainframe->getUserStateFromRequest('com_covehiculage.filter_order_Dir', 'filter_order_Dir', 'DESC', 'string');
		$this->setState('filter_order_dir', $filter_order_Dir );
	}
	
	/**
	 * Construit la requete SQL
	 * @param unknown_type $options
	 * @param unknown_type $parametres
	 * @return unknown_type
	 */
	function _getAutoQuery( &$options, $parametres )
	{
		$db			= JFactory::getDBO();
		$id			= @$options['id'];

		$select = 'a.*, c.catname, c.showYear, c.showDimensions, c.showConstructor, u.name ';
		$from	= '#__annonces AS a ';
		$orderby	= $this->_buildCategoryOrderBy();
		
		$query = "SELECT " . $select .
				"\n FROM " . $from .
				"\n LEFT JOIN #__annonces_categories AS c ON c.id = a.categorie".
				"\n LEFT JOIN #__users AS u ON a.vendeurId = u.id".
				"\n WHERE " . $this->filterWhere( $options, $parametres ).
				"\n " . $orderby;
		
		return $query;
	}
	
	/**
	 * 
	 * @return unknown_type
	 */
	function filterWhere( &$options, $parametres )
	{
		$filter 		= JRequest::getString('filter', '', 'request');
		$filter_type 	= JRequest::getWord('filter_type', '', 'request');

		$where = "";
		
		$wheres[] = 'c.published =1 and a.published = 1 AND a.approuved = 1';
		
		$catid = @$options['categorie'];
		if ( $catid )
			$wheres[] = 'categorie = ' . (int) $catid;
		
		if ( $parametres->published_days && $parametres->published_days != 0 )  
			$wheres [] = 'a.date > \'' . date( 'Y-m-d', strtotime("-".$parametres->published_days." day")) .'\''; 
		
		$where = implode( ' AND ', $wheres );
			
		if ($filter)
		{
			// clean filter variables
			$filter 		= JString::strtolower($filter);
			$filter			= $this->_db->Quote( '%'.$this->_db->getEscaped( $filter, true ).'%', false );
			$filter_type 	= JString::strtolower($filter_type);

			$where = ' AND (';
			$where .= ' LOWER( a.objet ) LIKE '.$filter;
			$where .= ' OR LOWER( c.catname ) LIKE '.$filter;
			$where .= ' OR LOWER( a.villeObjet ) LIKE '.$filter;
			$where .= ' OR LOWER( a.description ) LIKE '.$filter;
			$where .= ' )';
			
		}
		
		return $where;
	}
	
	/**
	 * Total nr of ads
	 *
	 * @access public
	 * @return integer
	 */
	function getTotal( $options, $parametres )
	{
		if (empty($this->_total))
		{
			$query = $this->_getAutoQuery($options, $parametres);
			$this->_total = $this->_getListCount($query);
		}

		return $this->_total;
	}
	
	/**
	 * Method to get a pagination object for the ads
	 *
	 * @access public
	 * @return integer
	 */
	function getPagination()
	{
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->_total, $this->getState('limitstart'), $this->getState('limit') );
		}

		return $this->_pagination;
	}
	
	/**
	 * Construit la liste des annonces
	 * @param $options
	 * @param $parametres
	 * @return unknown_type
	 */
	function getListeAnnonces( $options=array(), $parametres )
	{
		$query	= $this->_getAutoQuery( $options, $parametres );
		$result = $this->_getList( $query, $this->getState('limitstart'), $this->getState('limit') );
		
		return @$result;
	}
	
	/**
	 * Build the order clause
	 *
	 * @access private
	 * @return string
	 */
	function _buildCategoryOrderBy()
	{
		$filter_order		= $this->getState('filter_order');
		$filter_order_dir	= $this->getState('filter_order_dir');
		$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_dir;

		return $orderby;
	}
	
	/**
	 * Cherche les colonnes a afficher
	 * @param $listeAnnonces
	 * @return unknown_type
	 */
	function getShowColumns( $listeAnnonces )
	{
		$show = new stdclass();
		$show->showYear = false;
		$show->showDimensions = false;
		$show->showConstructor = true;
		
		foreach ( $listeAnnonces as $annonce )
		{
			$show->showYear |= $annonce->showYear;
			$show->showDimensions |= $annonce->showDimensions;
		}
		return $show;
	}
	
	/**
	 * Initialise la nouvelle categorie dans l'annonce
	 * 
	 * @param $annonce
	 * @param $categorie
	 * @return unknown_type
	 */
	function getListCategorieLiens( $catidSelected ) 
	{
		if ( ! $catidSelected )
			$catidSelected = 0;
		
		$parametrage = Util::parametrage();	
			
		$query = 'SELECT c.catname, c.id, COUNT(*) AS nb'
		. ' FROM #__annonces_categories c '
		. ' LEFT JOIN #__annonces a ON a.categorie = c.id'
		. ' WHERE ' . $this->filterWhere( $options, $parametrage )
		. ' GROUP BY c.catname'
		. ' ORDER BY c.ordering'
		;
		
		$this->_db->setQuery( $query );
					
		$listeCategorie = $this->_db->loadObjectList(); 
		
		$listeLiens = array();
		$tteCategorie = new stdclass();
		$tteCategorie->libelle = JText::_('ALLE');
		$tteCategorie->lien = 'index.php?option=com_annonces&view=annonces';
		$listeLiens[] = $tteCategorie;
		$total = 0;	
		foreach ( $listeCategorie as $categorie ) {
			$uneCategorie = new stdclass();
			$uneCategorie->libelle = $categorie->catname;
			if ( $catidSelected != $categorie->id )
				$uneCategorie->lien = 'index.php?option=com_annonces&view=annonces&catid='.$categorie->id;
			else 
				$uneCategorie->lien = 'index.php?option=com_annonces&view=annonces&catid='.$categorie->id;
			
			$uneCategorie->nbAnnonces = $categorie->nb;
			$total += $categorie->nb;
			$listeLiens[] = $uneCategorie;
		}
		$listeLiens[0]->nbAnnonces = $total;		
		
		return $listeLiens;
	}
}
?>
