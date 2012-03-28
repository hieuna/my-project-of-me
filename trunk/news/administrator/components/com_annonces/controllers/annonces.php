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

class AnnoncesControllerAnnonces extends AnnoncesController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();

		// Register Extra tasks
		$this->registerTask( 'add'  , 	'edit' );
		$this->registerTask( 'unpublish', 	'publish');
	}

	/**
	 * display the edit form
	 * @return void
	 */
	function edit()
	{
		JRequest::setVar( 'view', 'annonce' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save()
	{
		$parametrage = Util::parametrage();
		
		$model = $this->getModel('annonce');
		$post = JRequest::get( 'post' );
		
		if ( $returnid = $model->store($post) ) {
			$msg = JText::_( 'ADS SAVED' );
		} else {
			$msg = JText::_( 'Error Saving ads' );
		}
		
		if ( $returnid && Image::enregistrerPhotos( $returnid, $parametrage->maxSize ) == true ) {
				$msg 	= JText::_( 'ADS SAVED' );
				Mail::envoyerMail( $returnid );
				$link = "index.php?option=com_annonces";
		} else {
			if ( $returnid )
				$link = "index.php?option=com_annonces&controller=annonces&view=annonce&task=edit&cid[]=".$returnid;
			$msg = JText::_('SAVE ERROR');
			JError::raiseWarning('SOME_ERROR_CODE', $model->getError() );
		}
		
		$this->setRedirect($link, $msg);
	}

	/**
	 * logic to remove an add
	 */
 	function remove()
	{
		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$total = count( $cid );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('annonces');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}

		$msg = $total.' '.JText::_( 'ADS DELETED');

		$this->setRedirect( 'index.php?option=com_annonces&view=annonces', $msg );
	}

	
	/**
	* Publishes or Unpublishes one or more records
	* @param array An array of unique category id numbers
	* @param integer 0 if unpublishing, 1 if publishing
	* @param string The current url option
	*/
	function publish()
	{
		$this->setRedirect( 'index.php?option=com_annonces' );

		// Initialize variables
		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$cid		= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$task		= JRequest::getCmd( 'task' );
		$publish	= ($task == 'publish');
		$n			= count( $cid );

		if (empty( $cid )) {
			return JError::raiseWarning( 500, JText::_( 'No items selected' ) );
		}

		JArrayHelper::toInteger( $cid );
		$cids = implode( ',', $cid );

		$query = 'UPDATE #__annonces'
		. ' SET published = ' . (int) $publish
		. ' WHERE id IN ( '. $cids .' )'
		;
		$db->setQuery( $query );
		if (!$db->query()) {
			return JError::raiseWarning( 500, $row->getError() );
		}
		$this->setMessage( JText::sprintf( $publish ? 'Items published' : 'Items unpublished', $n ) );

	}
	
	/**
	 * 
	 * @return unknown_type
	 */
	function valider()
	{
		$this->setRedirect( 'index.php?option=com_annonces' );

		// Initialize variables
		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$cid		= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$task		= JRequest::getCmd( 'task' );
		$publish	= ($task == 'valider');
		$n			= count( $cid );

		if (empty( $cid )) {
			return JError::raiseWarning( 500, JText::_( 'No items selected' ) );
		}

		JArrayHelper::toInteger( $cid );
		$cids = implode( ',', $cid );

		$query = 'UPDATE #__annonces'
		. ' SET published = ' . (int) $publish .', approuved = ' . (int) $publish
		. ' WHERE id IN ( '. $cids .' )'
		;
		$db->setQuery( $query );
		if (!$db->query()) {
			return JError::raiseWarning( 500, $row->getError() );
		}
		$this->setMessage( JText::sprintf( $publish ? 'Items published' : 'Items unpublished', $n ) );
		
		foreach ( $cid as $id) {
			if ( $publish == true )
			Mail::envoyerMail( $id );
		}
	}
	
	/**
	 * Devalider une annonce
	 * 
	 * @return unknown_type
	 */
	function devalider()
	{
		return $this->valider();
	}
	
	/**
	 * Effacement d'une photo
	 * @return 
	 */
	function effacerPhoto()
	{
		$post = JRequest::get( 'post' );
		$id = $post['id'];
		$photoId = $post['photoSupprId'];
		
		Image::supprimerUnePhoto( $id, $photoId );
		$this->setMessage( JText::_("Photo deleted") );
		$this->save();
		$this->setRedirect("index.php?option=com_annonces&controller=annonces&task=edit&cid[]=".$id);
	}
	
	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_annonces', $msg );
	}
	
	/**
	 * L'utilisateur a changé la categorie dans
	 * le formulaire de saisie d'une annonce
	 * @return unknown_type
	 */
	function changerCategorie()
	{
		return $this->edit();
	}
	
	
}
?>
