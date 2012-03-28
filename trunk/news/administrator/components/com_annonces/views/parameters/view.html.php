<?php/** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');


class AnnoncesViewParameters extends JView {

	function display($tpl = null) {		$mainframe = &JFactory::getApplication();

		//initialise variables
		$document 	= & JFactory::getDocument();
		$user 		= & JFactory::getUser();

		//get data from model
		$model		= & $this->getModel();
		$parametres = & $this->get('Data');

		//only admins have access to this view
		if ($user->get('gid') < 23) {
			JError::raiseWarning( 'SOME_ERROR_CODE', JText::_( 'ALERTNOTAUTH'));
			$mainframe->redirect( 'index.php?option=com_annonces&view=annonces' );
		}
		
			
		JToolBarHelper::title( JText::_( 'CONFIGURATION' ), 'home' );
		JToolBarHelper::save();
		JToolBarHelper::cancel();
		
		JHTML::_('behavior.tooltip');
		JHTML::_('behavior.switcher');
		
		//Build submenu
		$contents = '';
		ob_start();
			require_once(dirname(__FILE__).DS.'tmpl'.DS.'navigation.php');
		$contents = ob_get_contents();
		ob_end_clean();
		$document->setBuffer($contents, 'modules', 'submenu');
		//add css and submenu to document
		$document->addStyleSheet('/components/com_annonces/assets/adminannonces.css');
			
			
		$this->assignRef('parametres', $parametres );
	
		
		parent::display($tpl);

	}
	
}