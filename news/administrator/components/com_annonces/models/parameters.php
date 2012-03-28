<?php/** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class AnnoncesModelParameters extends JModel
{
	/**
	 * Settings data
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Constructor
	 *
	 * @since 0.9
	 */
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Logic for the settings screen
	 *
	 */
	function &getData()
	{
		$query = 'SELECT * FROM #__annonces_parameters WHERE id = 1';

		$this->_db->setQuery($query);
		$this->_data = $this->_db->loadObject();
		$this->updateNewFields();
	
		return $this->_data;
	}

	/**
	 * Permet de creer dynamique les nouveaux champs de base 
	 * de données pour les version antérieures
	 * @return unknown_type
	 */
	function updateNewFields()
	{
		if ( isset( $this->_data->searchActive ) == false )
			Util::updateBddStructure( $this->_data, "annonces_parameters", "searchActive", "BOOL", "1" );
		
		if ( isset( $this->_data->unableSubmitAdInList ) == false )
			Util::updateBddStructure( $this->_data, "annonces_parameters", "unableSubmitAdInList", "BOOL", "1" );
	
		if ( isset( $this->_data->adminValidation ) == false )
			Util::updateBddStructure( $this->_data, "annonces_parameters", "adminValidation", "BOOL", "1" );
	
		if ( isset( $this->_data->nbpage ) == false )
			Util::updateBddStructure( $this->_data, "annonces_parameters", "nbpage", "INT(11)", "10" );
			
		if ( isset( $this->_data->viewDetailLayout ) == false )
			Util::updateBddStructure( $this->_data, "annonces_parameters", "viewDetailLayout", "VARCHAR(10)", "default" );		if ( isset( $this->_data->maxSize ) == false )				Util::updateBddStructure( $this->_data, "annonces_parameters", "maxSize", "INT(11)", "3000" );				
	}
	
	/**
	 * Method to checkin/unlock the item
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	0.9
	 */
	function checkin()
	{
		$item = & $this->getTable('Parameters', '');
		if(! $item->checkin(1)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		return false;
	}
	


	/**
	 * Method to checkout/lock the item
	 *
	 * @access	public
	 * @param	int	$uid	User ID of the user checking the item out
	 * @return	boolean	True on success
	 * @since	0.9
	 */
	function checkout($uid = null)
	{
		// Make sure we have a user id to checkout the article with
		if (is_null($uid)) {
			$user	=& JFactory::getUser();
			$uid	= $user->get('id');
		}
		// Lets get to it and checkout the thing...
		$item = & $this->getTable('Parameters', '');
		if(!$item->checkout($uid, 1)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		return true;
	}

	/**
	 * Tests if the ad is checked out
	 *
	 * @access	public
	 * @param	int	A user id
	 * @return	boolean	True if checked out
	 * @since	0.9
	 */
	function isCheckedOut( $uid=0 )
	{
		if ($this->getData())
		{
			if ($uid) {
				return ($this->_data->checked_out && $this->_data->checked_out != $uid);
			} else {
				return $this->_data->checked_out;
			}
		}
	}

	/**
	 * Saves the settings
	 *
	 */
	function store($post)	{		$parametres = & JTable::getInstance('parameters', '');
		// Bind the form fields to the table
		if (!$parametres->bind($post)) {			$this->setError($this->_db->getErrorMsg());			return false;		}
		$parametres->id = 1;
		if (!$parametres->store( true )) {			$this->setError($this->_db->getErrorMsg());			return false;		}
    	return true;	}
}
?>