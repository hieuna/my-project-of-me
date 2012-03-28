<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined('_JEXEC') or die('Restricted access');


class Annonce extends JTable
{
	/**
	 * Clé primaire
	 * @var int
	 */
	var $id 				= null;
	
	var $etatneuf = 0;
	
	var $categorie = null;
	
	var $date = null;
	
	var $constructeur = null;
	
	var $objet = null;
	
	var $villeObjet = null;
	
	var $annee = 0;
	
	var $longueur = 0.0;
	
	var $largeur = 0.0;
	
	var $prix = 0;
	
	var $vendeurId = -1;
	
	var $telephone = null;
	
	var $portable = null;
	
	var $approuved = 0;
	
	var $published = 0;
	
	var $description = null;
	
	var $propriete1 = null;
	
	var $propriete2 = null;
	
	var $propriete3 = null;
	
	var $propriete4 = null;
	
	var $propriete5 = null;
	
	var $hits = 0;


	function Annonce(& $db) {
		parent::__construct('#__annonces', 'id', $db);
	}

	// overloaded check function
	function check($elsettings)
	{
				return true;
	}
}
?>