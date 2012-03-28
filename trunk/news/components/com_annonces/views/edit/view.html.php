<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class AnnoncesViewEdit extends JView{
	function display( $tpl=null )	{		global $mainframe, $option;		$document 	= & JFactory::getDocument();		$params 	= & $mainframe->getParams('com_annonces');		$model	  = $this->getModel();
		$editor 	= & JFactory::getEditor();		$parametrage = Util::parametrage();		
		// Get the parameters of the active menu item		$menus	= &JSite::getMenu();		$menu    = $menus->getActive();		$pathway 	= & $mainframe->getPathWay();
		$params = &$mainframe->getParams();		$annonceId = JRequest::getInt('id');		$categorieSelect = JRequest::getInt( 'categorie' ); 		$annonce = $model->getAnnonce( array( 'id' => $annonceId ));		$model->changerDonneesCategorie( $annonce, $categorieSelect );				$categories = $model->getListCategories();
		JHTML::_('behavior.tooltip');		JHTML::_('behavior.modal', 'a.modal');
		//only registered user can add ads		$user   = & JFactory::getUser();		if (!$user->id) {			$mainframe->redirect(JRoute::_('index.php?option=com_user&view=login'), JText::_('PLEASE LOGIN') );		}		if ( Util::peutEditer( ($annonceId == 0), $annonce->vendeurId ) == false )			JError::raiseError( 403, JText::_("ALERTNOTAUTH") );		
		if ( $annonceId ) { 			$annonce->vendeur = JFactory::getUser($annonce->vendeurId);
			$introductionPage = JText::_('INTRO_UPDATE'); 			$titrePage = JText::_('ADS_DETAIL') . ': ' . JText::_('VENTE') . ' ' . $annonce->objet;		} else {			$introductionPage = JText::_('INTRO_NEW'); 			$annonce->vendeur = JFactory::getUser();			$titrePage = $params->get('page_title');		}
		if ( isset( $menu->name ) ) {			$pathway->setItemName( 1, $menu->name );			$pathway->addItem( $titrePage, JRoute::_('index.php?view=annonces') );		}
		// Traitement des images		$tableau_images = Image::getListPhotos( $annonceId );		$document->addStyleSheet($this->baseurl.'/components/com_annonces/assets/annonces.css');
		$this->assignRef('titrePage'  , $titrePage );
		$this->assignRef('introductionPage', $introductionPage );		$this->assignRef('annonce'  , $annonce);		$this->assignRef('tableau_images', $tableau_images );		$this->assignRef('categories'  , $categories);		$this->assignRef('editor'  , $editor);		$this->assignRef('params'  , $params);
		$this->assignRef('parametrage'  , $parametrage);		$this->assignRef('categorieSelect'  , $categorieSelect);		$this->assignRef('item'  , $menu);					parent::display($tpl);	}}?>