<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined('_JEXEC') or die('Restricted access');


class Categorie extends JTable
{
	/**
	 * Clé primaire
	 * @var int
	 */
	var $id 				= null;
	
   	var $catname = "";
  	
  	var $alias = "";
  	
  	var $catdescription = "";
  	
  	var $meta_keywords = "";
  	
  	var $meta_description = "";
  	
  	var $published = "";
  	
  	var $access = 0;
  	
  	var $ordering = "";
  	
  	var $showYear;
  	
  	var $showDimensions;
  	
  	var $showConstructor;
  	
  	var $property1;
  	
  	var $property2;
  	
  	var $property3;
  	
  	var $property4;
  	
  	var $property5;
  	
  	

	function Categorie(& $db) {
		parent::__construct('#__annonces_categories', 'id', $db);
	}

	
}
?>