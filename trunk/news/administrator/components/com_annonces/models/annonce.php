<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');


class AnnoncesModelAnnonce extends JModel
{
	/**
	 * @var int
	 */
	var $_id = null;

	/**
	 * Ads data array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Categories data array
	 *
	 * @var array
	 */
	var $_categories = null;

	/**
	 * Constructor
	 *
	 * @since 0.9
	 */
	function __construct()
	{
		parent::__construct();

		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
		JArrayHelper::toInteger($cid, array(0));
		$this->setId($cid[0]);
	}

	
	
	/**
	 * Method to set the identifier
	 *
	 * @access	public
	 * @param	int ad identifier
	 */
	function setId($id)
	{
		// Set ad id and wipe data
		$this->_id	    = $id;
		$this->_data	= null;
	}

	/**
	 * Logic for the ad edit screen
	 *
	 */
	function &getData()
	{
		if ($this->_loadData())
		{
		}
		else  $this->_initData();

		return $this->_data;
	}

	/**
	 * Method to load content ad data
	 *
	 * @access	private
	 * @return	boolean	True on success
	 * @since	0.9
	 */
	function _loadData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$idtemp = JRequest::getInt( 'id', 0,	 'post' );
			if ( $idtemp < 1 ) {
				$idtemp2 = JRequest::getVar( 'cid' );
				if  ( $idtemp2 > 0 )
					$idtemp = $idtemp2[0];
			}
			$this->_id = $idtemp;
			
			$query = 'SELECT a.*,u.name as vendeur, c.property1 as libelle1, c.property2 as libelle2'
					. ', c.property3 as libelle3, c.property4 as libelle4, c.property5 as libelle5'
					. ',c.showYear, c.showDimensions, c.showConstructor'
					. ' FROM #__annonces AS a'
					. ' LEFT JOIN #__users AS u ON u.id = a.vendeurId'
					. ' LEFT JOIN #__annonces_categories AS c ON c.id = a.categorie'
					. ' WHERE a.id = '.$this->_id
					;
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();

			return (boolean) $this->_data;
		}
		return true;
	}

	/**
	 * Method to get the members data
	 *
	 */
	function &getListUsers()
	{
        $users = array();
        $query = 'SELECT id AS value, name as text'
        		. ' FROM #__users'
        		. ' ORDER BY name ASC'
        		;

        $this->_db->setQuery( $query );
        $users = $this->_db->loadObjectList();

    	return $users;
	}
	
	/**
	 * Retourne la liste des categories
	 * @return unknown_type
	 */
	function getListCategories()
	{
		$query = 'SELECT id AS value, catname AS text'
		. ' FROM #__annonces_categories'
		. ' ORDER BY ordering'
		;
		$this->_db->setQuery( $query );

		$result = $this->_db->loadObjectList();  
		
		return $result;
	}
	
	

	/**
	 * Method to initialise the ad data
	 *
	 * @access	private
	 * @return	boolean	True on success
	 * @since	0.9
	 */
	function _initData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$annonce = new stdClass();
			$annonce->id= 0;
			$datenow =& JFactory::getDate();
			$annonce->date = $datenow->toFormat("%Y-%m-%d");
			$annonce->approuved=false;
			$annonce->objet="";
			$annonce->hits=0;
			$annonce->constructeur="";
			$annonce->categorie=null;
			$annonce->etatneuf=0;
			$annonce->annee=null;
			$annonce->villeObjet=null;
			$annonce->longueur=null;
			$annonce->largeur=null;
			$annonce->published=false;
			$annonce->propriete1="";
			$annonce->propriete2="";
			$annonce->propriete3="";
			$annonce->propriete4="";
			$annonce->propriete5="";
			$annonce->prix=null;
			$annonce->vendeurId=null;
			$annonce->description=null;
			$annonce->telephone=null;
			$annonce->portable=null;
			$this->_data = $annonce;
			return (boolean) $this->_data;
		}
		return true;
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
		return true;
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
		if ($this->_id)
		{
			if (is_null($uid)) {
				$user	=& JFactory::getUser();
				$uid	= $user->get('id');
			}
			$ad = & JTable::getInstance('annonces', '');
			return $ad->checkout($uid, $this->_id);
		}
		return false;
	}

	/**
	 * Tests if the ad is checked out
	 *
	 */
	function isCheckedOut( $uid=0 )
	{
		if ($this->_loadData())
		{
			if ($uid) {
				return ($this->_data->checked_out && $this->_data->checked_out != $uid);
			} else {
				return $this->_data->checked_out;
			}
		} elseif ($this->_id < 1) {
			return false;
		} else {
			JError::raiseWarning( 0, 'Unable to Load Data');
			return false;
		}
	}

	/**
	 * Method to store the ad
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function store($data)
	{
		$mainframe = &JFactory::getApplication();

		$data['description']=JRequest::getVar( 'description', '', 'post', 'string', JREQUEST_ALLOWHTML );
		
		$user		= & JFactory::getUser();
		$row 	= & JTable::getInstance('annonce', '');

		// Bind the form fields to the table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
	
		// sanitise id field
		$row->id = (int) $row->id;
		
		// Are we saving from an item edit?
		if ($row->id) {
		} else {
			$row->date 		= gmdate('Y-m-d H:i:s');
		}
		
		// Store the table to the database
		if (!$row->store( true )) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		return $row->id;
	}
	
	/**
	 * Initialise la nouvelle categorie dans l'annonce
	 * 
	 * @param $annonce
	 * @param $categorie
	 * @return unknown_type
	 */
	function changerDonneesCategorie( $annonce, $categorie ) 
	{
		if ( $categorie == 0 )
			$categorie = $annonce->categorie;
			
		$query = 'SELECT *'
			. ' FROM #__annonces_categories'
			. ' WHERE '
			. ( $categorie > 0 ? 'id = ' . $categorie : 'published = 1');
			$this->_db->setQuery( $query );
	
			$listeCategorie = $this->_db->loadObjectList();  
			if ( count( $listeCategorie ) > 0 )
				$lcategorie = $listeCategorie[0];
			else
				return false;
			
			$annonce->categorie = $lcategorie->id;
			$annonce->showYear = $lcategorie->showYear;
			$annonce->showConstructor = $lcategorie->showConstructor;
			$annonce->showDimensions = $lcategorie->showDimensions;
			$annonce->libelle1= $lcategorie->property1;
			$annonce->libelle2= $lcategorie->property2;
			$annonce->libelle3= $lcategorie->property3;
			$annonce->libelle4= $lcategorie->property4;
			$annonce->libelle5= $lcategorie->property5;
				
		return $annonce;
	}
	
}
?>