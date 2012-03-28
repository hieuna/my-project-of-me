<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined('_JEXEC') or die('Restricted access');
class Util {
	function peutEditer( $nouvelleAnnonce, $vendeurId )	{		$user = & JFactory::getUser();		$resultat = false;
		// Administrateur, oui
		if ( $user->get('gid') > 24 )			$resultat = true;		else {			if ( $nouvelleAnnonce == true ) 				$resultat = ( $user->get('id') > 0 );			else // Annonce existante				$resultat = ( $user->get('id') == $vendeurId );		}			return $resultat;	}
	function editLink( $nouvelleAnnonce, $vendeurId, $text, $view, $task, $id, $Itemid)	{		$output = "";
		if ( Util::peutEditer( $nouvelleAnnonce, $vendeurId ) == true )		{			JHTML::_('behavior.tooltip');			$icon =  ( $task == 'delete' ? 'icon_delete.png' : 'edit.png');			$path =  ( $task == 'delete' ? '/components/com_annonces/assets/images/' : '/images/M_images/');
			$image = JHTML::_('image.site', $icon, $path, NULL, NULL, JText::_( 'EDIT OBJECT' ));			$link 	= 'index.php?option=com_annonces&view='.$view.'&task='.$task.'&id='.$id.'&vendeurId='.$vendeurId.'&returnid='.$Itemid;			$link = ( $task == 'delete' ? 'javascript:confirmDelete(\''. $link .'\')' : $link);
			$output	= '<a href="'.JRoute::_($link).'" title="'.$text.'">'.$image.'</a>';		}
		return $output;		}
	function htmlButtonApprouved( $row, $i )	{		$task2 = "";		$imgpath='images/';
		switch ( $row->approuved ) 		{				case 0:	        		$img2 = 'publish_x.png';	        		$task2 = 'valider';					$hover = 'En attente de validation';				break;
				case 1:	        		$img2 = 'tick.png';	        		$task2 = 'devalider';					$hover = 'Validee';				break;		}
		
		$result = '<a href="javascript:void(0);" onClick="return listItemTask(\'cb'.$i.'\',\''.$task2.'\')">';
		$result .='<img src="'.$imgpath.$img2.'" width="16" height="16" border="0" title="'.$hover.'" alt="'.$hover.'" /></a>';
		
		return $result;
	}
	
	/**	 * Pulls settings from database and stores in an static object	 *	 * @return object	 * @since 0.9	 */	function &parametrage()	{		static $parametrage;
		if (!is_object($parametrage))		{			$db 	= & JFactory::getDBO();			$sql 	= 'SELECT * FROM #__annonces_parameters WHERE id = 1';			$db->setQuery($sql);			$parametrage = $db->loadObject();
			// Verifie et creer les champs qui manqueraient dans la version installée 			if ( isset( $parametrage->searchActive ) == false )				Util::updateBddStructure( $parametrage, "annonces_parameters", "searchActive", "BOOL", "1" );
			if ( isset( $parametrage->unableSubmitAdInList ) == false )				Util::updateBddStructure( $parametrage, "annonces_parameters", "unableSubmitAdInList", "BOOL", "1" );
			if ( isset( $parametrage->adminValidation ) == false )				Util::updateBddStructure( $parametrage, "annonces_parameters", "adminValidation", "BOOL", "1" );
			if ( isset( $parametrage->nbpage ) == false )				Util::updateBddStructure( $parametrage, "annonces_parameters", "nbpage", "INT(11)", "10" );
			if ( isset( $parametrage->viewDetailLayout ) == false )				Util::updateBddStructure( $parametrage, "annonces_parameters", "viewDetailLayout", "VARCHAR(10)", "default" );
			if ( isset( $parametrage->maxSize ) == false )				Util::updateBddStructure( $parametrage, "annonces_parameters", "maxSize", "INT(11)", "3000" );		}
		return $parametrage;	}
	
	
	/**
	 * Retourne la liste des type de view pour le detail d'une annonce
	 * 
	 * @return unknown_type
	 */
	function viewDetailLayoutList()
	{
		$liste = array ();
		$default1 = new stdClass();
		$default1->value = "default";
		$default1->text = "Layout view 1";
		$liste[] = $default1;
		
		$default2 = new stdClass();
		$default2->value = "default2";
		$default2->text = "Layout view 2";
		$liste[] = $default2;
		
		return $liste;
	}	
	
	/**
	 * Ajout d'un champ inexistant dans la table spécifiée
	 * @return unknown_type
	 */
	function updateBddStructure( $object, $tableName, $field, $type, $value )
	{
		global $mainframe;
	    $db   = JFactory::getDBO();
	    $query   = "select " . $field . " from #__" . $tableName;
	    $table_exist = $db->setQuery( $query );
	
	    if ( $table_exist == false )
	    {
			$table_query = "ALTER TABLE #__". $tableName 
				. " ADD " . $field . " " . $type . " DEFAULT '". $value . "'";
			
			$object->$field = $value;
	     	$db->setQuery( $table_query );

	        if (!$db->query())
	        {
	            $status['error'] = 'Error : ' . $db->stderr();
	            
	            return $status;
	        }
	    }
		
	}
}