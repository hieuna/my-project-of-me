<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');


class AnnoncesModelCategorie extends JModel
{
	/**
	 * @var int
	 */
	var $_id = null;

	/**
	 * ads data array
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
			$query = 'SELECT c.*'
					. ' FROM #__annonces_categories AS c'
					. ' WHERE c.id = '.$this->_id
					;
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();

			return (boolean) $this->_data;
		}
		return true;
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
			$category = new stdClass();
			$category->id = 0;
			$category->approuved=false;
			$category->catdescription="";
			$category->catname="";
			$category->alias="";
			$category->published="";
			$category->meta_keywords = "";
  			$category->meta_description = "";
  			$category->published = 0;
	  		$category->access = 0;
  			$category->ordering = "";
  			$category->showYear=true;
  			$category->showDimensions=true;
  			$category->showConstructor=true;
			$category->property1=null;
			$category->property2=null;
			$category->property3=null;
			$category->property4=null;
			$category->property5=null;
			$this->_data = $category;
			return (boolean) $this->_data;
		}
		return true;
	}


	/**
	 * Method to store the category
	 */
	function store($data)
	{		$mainframe = &JFactory::getApplication();

		$data['description']=JRequest::getVar( 'catdescription', '', 'post', 'string', JREQUEST_ALLOWHTML );
		
		$user		= & JFactory::getUser();
		$row 	= & JTable::getInstance('categorie', '');

		// Bind the form fields to the table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
	
		// sanitise id field
		$row->id = (int) $row->id;
		if (!$row->id) {
			$row->ordering = $row->getNextOrder();
		}

		$alias = JFilterOutput::stringURLSafe($row->catname);
		if(empty($row->alias) || $row->alias == $alias ) {
			$row->alias = $alias;
		}
		
		// Store the table to the database
		if (!$row->store( true )) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		return $row->id;
	}
	
	/**
	 * Method to change acces level
	 * @param $id
	 * @param $access
	 * @return unknown_type
	 */
	function access($id, $access)
	{
		$row  =& $this->getTable('categorie', '');

		$row->load( $id );
		$row->access = $access;

		if ( !$row->store() ) {
			return $row->getError();
		}

		return true;
	}
	
	

	
}
?>