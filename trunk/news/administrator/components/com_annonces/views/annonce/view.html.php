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

class AnnoncesViewAnnonce extends JView
{
	/**
	 * display method of Hello view
	 * @return void
	 **/
	function display($tpl = null)
	{
		global $option;
		$mainframe = &JFactory::getApplication();
		$model		= & $this->getModel();
		$editor 	= & JFactory::getEditor();
		$categorieSelect = JRequest::getInt( 'categorie', 0,	 'post' ); 
	
		$annonce		=& $this->get('Data');
		$model->changerDonneesCategorie( $annonce, $categorieSelect );

		$isNew		= ($annonce->id < 1);
		$listUsers = $model->getListUsers();
		$categories = $model->getListCategories();
		
		if ( count( $categories ) == 0 )
			$mainframe->redirect(JRoute::_('index.php?option=com_annonces'), JText::_('CREATE CATEGORY') );
		
		$parametrage = Util::parametrage();

		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'ADS' ).': <small>[ ' . $text.' ]</small>' );

		JToolBarHelper::save();
		JToolBarHelper::cancel();

		$tableau_images = Image::getListPhotos( $annonce->id );
    		
		$this->assignRef('tableau_images', $tableau_images );
		$this->assignRef('annonce',	$annonce);
		$this->assignRef('categories',	$categories);
		$this->assignRef('listUsers',	$listUsers);
		$this->assignRef('editor',	$editor);
		$this->assignRef('parametrage', $parametrage);

		parent::display($tpl);
	}
}
