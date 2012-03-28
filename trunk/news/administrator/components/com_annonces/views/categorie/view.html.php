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

jimport( 'joomla.application.component.view' );

class AnnoncesViewCategorie extends JView
{
	/**
	 * display method of Hello view
	 * @return void
	 **/
	function display($tpl = null)
	{
		$model		= & $this->getModel();
		$editor 	= & JFactory::getEditor();
		$categorie		=& $this->get('Data');
		$isNew		= ($categorie->id < 1);
		
		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'CATEGORY' ).': <small>[ ' . $text.' ]</small>' );

		JToolBarHelper::save();
		JToolBarHelper::cancel();

		$this->assignRef('categorie',	$categorie);
		$this->assignRef('editor',	$editor);

		parent::display($tpl);
	}
}
