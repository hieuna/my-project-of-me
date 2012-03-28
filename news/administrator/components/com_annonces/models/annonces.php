<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class AnnoncesModelAnnonces extends JModel
{
	var $_data = null;

	var $_total = null;

	/**
	 * Pagination object
	 *
	 * @var object
	 */
	var $_pagination = null;

	/**
	 * Constructor
	 *
	 * @since 0.9
	 */
	function __construct()
	{
		parent::__construct();

		global $option;		$mainframe = &JFactory::getApplication();

    	$limit      = $mainframe->getUserStateFromRequest( $option.'.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
    	$limitstart = $mainframe->getUserStateFromRequest( $option.JRequest::getCmd( 'view').'.limitstart', 'limitstart', 0, 'int' );
		
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);

	}

	/**
	 * Method to get ad item data
	 *
	 * @access public
	 * @return array
	 */
	function getData()
	{
		if (empty($this->_data))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
		}

		return $this->_data;
	}

	/**
	 * Total nr of ads
	 *
	 * @access public
	 * @return integer
	 */
	function getTotal()
	{
		// Lets load the total nr if it doesn't already exist
		if (empty($this->_total))
		{
			$query = $this->_buildQuery();
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
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}

		return $this->_pagination;
	}

	/**
	 * Build the query
	 *
	 * @access private
	 * @return string
	 */
	function _buildQuery()
	{
		// Get the WHERE and ORDER BY clauses for the query
		$where		= $this->_buildContentWhere();
		$orderby	= $this->_buildContentOrderBy();

		$query = 'SELECT a.*, u.name as vendeur, u.email as mailVendeur, c.catname'
					. ' FROM #__annonces AS a'
					. ' LEFT JOIN #__users AS u ON a.vendeurId = u.id'
					. ' LEFT JOIN #__annonces_categories AS c ON c.id = a.categorie'
					. $where
					. $orderby
					;
				
		return $query;
	}

	/**
	 * Build the order clause
	 *
	 * @access private
	 * @return string
	 */
	function _buildContentOrderBy()
	{
		global $option;		$mainframe = &JFactory::getApplication();

		$filter_order		= $mainframe->getUserStateFromRequest( $option.'.annonces.filter_order', 'filter_order', 'a.id', 'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'.annonces.filter_order_Dir', 'filter_order_Dir', 'DESC', 'word' );

		$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir;

		return $orderby;
	}

	/**
	 * Build the where clause
	 *
	 * @access private
	 * @return string
	 */
	function _buildContentWhere()
	{
		global $option;		$mainframe = &JFactory::getApplication();

		$filter_state 		= $mainframe->getUserStateFromRequest( $option.'.filter_state', 'filter_state', '', 'word' );
		$filter 			= $mainframe->getUserStateFromRequest( $option.'.filter', 'filter', '', 'int' );
		$where = array();

		$where 		= ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );

		return $where;
	}

	

	

	/**
	 * Methode pour effacer une annonce
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function delete($cid = array())
	{
		$result = false;

		if (count( $cid ))
		{
			$cids = implode( ',', $cid );
			$query = 'DELETE FROM #__annonces'
					. ' WHERE id IN ('. $cids .')'
					;

			$this->_db->setQuery( $query );

			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			
			foreach ($cid as $id) {
				// Suppression du repertoire photo
				Image::supprimerPhotos( $id );
			}
		}

		return true;
	}
}//Class end
?>