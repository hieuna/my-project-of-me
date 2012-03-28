<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
jimport( 'joomla.application.component.view');
class AnnoncesViewAnnonce extends JView{	function display($tpl = null)	{		global $mainframe;
		$document 	= & JFactory::getDocument();		$model	  = $this->getModel();		$parametrage = Util::parametrage();
		if ( isset( $parametrage->viewDetailLayout ) )			$this->setLayout( $parametrage->viewDetailLayout );
		// Get the parameters of the active menu item		$menus	= &JSite::getMenu();		$menu    = $menus->getActive();		$pathway 	= $mainframe->getPathWay();
		$params = &$mainframe->getParams();		$annonceId = JRequest::getInt('id', 0);		$model->incrementerVisite( $annonceId );		$annonce = $model->getAnnonce( array( 'id' => $annonceId ));
		$document->addStyleSheet($this->baseurl.'/components/com_annonces/assets/annonces.css');		$document->addCustomTag('<script type="text/javascript" src="'.JURI::root().'components/com_annonces/assets/annonces.js"></script>');				$annonce->vendeur = JFactory::getUser($annonce->vendeurId);		$titreAnnonce = JText::_('ADS_DETAIL'). ': '. JText::_('VENTE') . ' ' . $annonce->objet;
		$document->setTitle( $titreAnnonce  );
		// Fil d'ariane		$pathway = $mainframe->getPathWay();		if ( isset( $menu ) == false )			$pathway->addItem( JText::_("ADS"), JRoute::_('index.php?view=annonces&view=annonces') );
		$pathway->setItemName( 1, JText::_("ADS"));		$pathway->addItem(  JText::_('VENTE') . ' ' . $annonce->objet, JRoute::_('index.php?view=annonces') );
		$tableau_images = Image::getListPhotos( $annonceId );
		$this->assignRef('annonce'  , $annonce);		$this->assignRef('parametrage'  , $parametrage);		$this->assignRef('tableau_images', $tableau_images );		$this->assignRef('user', JFactory::getUser() );
		parent::display($tpl);
	}	
}
?>
