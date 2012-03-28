<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.model');

include_once('annonce.php');

/**
 * @package		Joomla
 * @subpackage	Contact
 */
class AnnoncesModelEdit extends AnnoncesModelAnnonce
{
	
	
	
	/**
	 * Enregistrement de l'annonce en base
	 *
	 * @access	public
	 * @return	id
	 */
	function enregistrer($data)	{		global $mainframe;
		$user 		= & JFactory::getUser();
		//Get mailinformation		$row 	= & JTable::getInstance('annonce', '');		$data['description']=JRequest::getVar( 'description', '', 'post', 'string', JREQUEST_ALLOWRAW );
	    if (isset($data['id'])) {	      	$row->load($data['id']);	    }
		if (!$row->bind($data)) {			JError::raiseError( 500, $this->_db->stderr() );			return false;		}
		if ($row->id) 		{		}		else {			$row->date 		= gmdate('Y-m-d H:i:s');			$parametrage = Util::parametrage();			if ( $parametrage->adminValidation == false ) {				$row->approuved = true;				$row->published = true;			}		}
		if (!$row->store(true)) {			JError::raiseError( 500, $this->_db->stderr() );			return false;		}
		return $row->id;	}
	
	
}