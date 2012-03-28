<?php/** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class AnnoncesControllerParameters extends AnnoncesController{
	/**
	 * Constructor
	 *
	 */
	function __construct()
	{
		parent::__construct();

		// Register Extra task
		$this->registerTask( 'apply', 		'save' );
	}

	/**
	 * logic for cancel an action
	 *
	 * @access public
	 * @return void
	 * @since 0.9
	 */
	function cancel()
	{
		global $option;

		$model = $this->getModel('parameters');

		$model->checkin();

		$this->setRedirect( 'index.php?option='.$option.'&view=annonces' );
	}

	/**
	 * logic to create the edit 
	 *
	 */
	function edit( )
	{
		JRequest::setVar( 'view', 'parameters' );

		parent::display();

		$model = $this->getModel('parameters');

		$model->checkout();
	}

	/**	 * saves parameters in the database	 *	 */	function save()	{		// Check for request forgeries		JRequest::checkToken() or die( 'Invalid Token' );
		// Sanitize		$task	= JRequest::getVar('task');		$post 	= JRequest::get( 'post' );
		//get model		$model 	= $this->getModel('parameters');
		if ($model->store($post)) {			$msg	= JText::_( 'SETTINGS SAVE');		} else {			$msg	= JText::_( 'SAVE SETTINGS FAILED');		}
		$link = 'index.php?option=com_annonces&view=parameters';		$model->checkin();		$this->setRedirect( $link, $msg );	}
}
?>