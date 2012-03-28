<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.model');

/**
 * @package		Joomla
 */
class AnnoncesModelAnnonce extends JModel
{
	/**
	 * Builds the query to select contact items
	 * @param array
	 * @return string
	 * @access protected
	 */
	function _getAnnonceQuery( &$options )
	{
		// TODO: Cache on the fingerprint of the arguments
		$db			=& JFactory::getDBO();
		$id			= @$options['id'];
		$groupBy	= @$options['group by'];
		$orderBy	= @$options['order by'];

		$select = 'a.*, c.catname, c.showYear, c.showDimensions, c.showConstructor, c.property1 as libelle1, ' .
				  'c.property2 as libelle2, c.property3 as libelle3, c.property4 as libelle4, c.property5 as libelle5';
		$from	= '#__annonces AS a';
	
		$wheres[] = 'a.id = ' . (int) $id;
		
		
		/*
		 * Query to retrieve all categories that belong under the contacts
		 * section and that are published.
		 */
		$query = 'SELECT ' . $select .
				' FROM ' . $from .
				' LEFT JOIN #__annonces_categories AS c ON c.id = a.categorie'.
				' WHERE ' . implode( ' AND ', $wheres );
		
		return $query;
	}

	/**
	 * @param array
	 * @return mixed Object or null
	 */
	function getAnnonce( $options=array() )
	{
		if ( $options['id'] )
		{ 
			$query	= $this->_getAnnonceQuery( $options );
			$result = $this->_getList( $query );
			
			return @$result[0];
		}
		else
		{
			$annonce = new stdClass();
			$annonce->id= 0;
			$datenow =& JFactory::getDate();
			$annonce->date = $datenow->toFormat("%Y-%m-%d");
			$annonce->approuved=false;
			$annonce->objet="";
			$annonce->constructeur="";
			$annonce->categorie=null;
			$annonce->etatneuf=0;
			$annonce->hits=0;
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
			
			$annonce->showYear = false;
			$annonce->showConstructor = false;
			$annonce->showDimensions = false;
			$annonce->libelle1="";
			$annonce->libelle2="";
			$annonce->libelle3="";
			$annonce->libelle4="";
			$annonce->libelle5="";
			
			return $annonce;
		}
	}
	
	function changerDonneesCategorie( &$annonce, $categorie ) 	{		if ( $categorie == 0 )			$categorie = $annonce->categorie;
		if ( $categorie == 0 )			return;
		$query = 'SELECT *'		. ' FROM #__annonces_categories'		. ' WHERE '		. ( $categorie > 0 ? 'id = ' . $categorie : 'published = 1');		$this->_db->setQuery( $query );
		$listeCategorie = $this->_db->loadObjectList();  
		if ( count( $listeCategorie ) > 0 )			$lcategorie = $listeCategorie[0];		else			return false;
		$annonce->categorie = $lcategorie->id;		$annonce->showYear = $lcategorie->showYear;		$annonce->showConstructor = $lcategorie->showConstructor;		$annonce->showDimensions = $lcategorie->showDimensions;		$annonce->libelle1= $lcategorie->property1;		$annonce->libelle2= $lcategorie->property2;		$annonce->libelle3= $lcategorie->property3;		$annonce->libelle4= $lcategorie->property4;		$annonce->libelle5= $lcategorie->property5;
		return $annonce;	}
	/**	 * Ajoute un hit de visite	 * @return unknown_type	 */	function incrementerVisite( $pId ) 	{		global $mainframe, $option;
		$isDejaVisitee = $mainframe->getUserState( $option.'.dejaVisitee'.$pId );		if ( !$isDejaVisitee )		{					$db			=& JFactory::getDBO();			$id			= @$options['id'];			$query = 'UPDATE #__annonces'				. ' SET hits = hits + 1'				. ' WHERE id = ' . (int) $pId;
			$db->setQuery( $query );			$db->query();			$mainframe->setUserState( $option.'.dejaVisitee'.$pId, 1 );		}	}
	/**	 * Retourne la liste des categories	 * @return unknown_type	 */	function getListCategories()	{		$query = 'SELECT id AS value, catname AS text'		. ' FROM #__annonces_categories'		. ' WHERE published = 1'		. ' ORDER BY ordering'		;
		$this->_db->setQuery( $query );		$result = $this->_db->loadObjectList();  
		return $result;	}
	/**	 * Effacement d'une annonce 	 * @param unknown_type $id	 * @return unknown_type	 */
	function delete( $id ) 
	{
		$user 	= & JFactory::getUser();
		$userid = $user->get('id');

		// Must be logged in
		if ($userid < 1) {
			JError::raiseError( 403, JText::_('ALERTNOTAUTH') );
			return;
		}

		$query = 'DELETE FROM #__annonces WHERE id = ' . $id;
		$this->_db->SetQuery( $query );

		if (!$this->_db->query()) {
			JError::raiseError( 500, $this->_db->getErrorMsg() );
			return false;
		}

		return true;
	}
	
}