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
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
jimport('joomla.application.component.controller');


/**
 * Auto Component Controller
 */
class AnnoncesController extends JController
{
	function display()
	{
		// Setzt einen Standard view 
		if ( ! JRequest::getCmd( 'view' ) ) {
			JRequest::setVar('view', 'categories' );
		}
		parent::display();
	}
	
	
	
	/**
	 * Sauvegarde d'une annonce ( création ou modification )
	 */
	function sauverAnnonce()
	{
		$parametrage = Util::parametrage();
		
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		$user = & JFactory::getUser();
		if ($user->get('id') < 1) {
			JError::raiseError( 403, JText::_('ALERTNOTAUTH') );
			return;
		}
		
		$post 		= JRequest::get( 'post' );
		
		$isNew = ($post['id']) ? false : true;
		$model = $this->getModel('edit');

		$link = JRequest::getString('referer', JURI::base(), 'post');				
		$returnid = $model->enregistrer($post);
		if ( $returnid && Image::enregistrerPhotos( $returnid, $parametrage->maxSize ) == true ) {
				$msg 	= JText::_( 'ADS SAVED' );
				Mail::envoyerMail( $returnid );
				$link = "index.php?option=com_annonces&view=annonces";
		} else {
			if ( $returnid )
				$link = "index.php?option=com_annonces&returnid=&view=edit&id=".$returnid;
			$msg = JText::_('SAVE ERROR');
			JError::raiseWarning('SOME_ERROR_CODE', $model->getError() );
		}
		$this->setRedirect($link, $msg );
	}
	
	/**
	 * logic to remove an add
	 */
 	function delete()
	{
		$post 		= JRequest::get( 'get' );
		$vendeurId = $post['vendeurId'];
		
		$isNew = ($post['id']) ? false : true;
		if ( $isNew == true || Util::peutEditer( false, $vendeurId ) == false )
			return false;

		$model = $this->getModel('edit');
		if ( $model->delete( $post['id'] ) ) 
			$msg = JText::_( 'AD DELETED');
		else
			$msg = JText::_( 'ERROR WHILE DELETING AD');
		
		$this->setRedirect( JRoute::_('index.php?option=com_annonces&view=annonces'), $msg );
	}
	
	/**
	 * Annulation de la sauvegarde
	 */
	function annulerSauver()
	{
		$user	= & JFactory::getUser();
		$id		= JRequest::getInt( 'id');

		if ($user->get('id') < 1) {
			JError::raiseError( 403, JText::_('ALERTNOTAUTH') );
			return;
		}

		$this->setRedirect( JRoute::_('index.php?option=com_annonces&view=annonces') );
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
		
		$this->sauverAnnonce();
		Image::supprimerUnePhoto( $id, $photoId );
		$this->setMessage( JText::_("Photo deleted") );
		$this->setRedirect("index.php?option=com_annonces&view=edit&id=".$id);
	}
	
	/**
	 * Envoi d'un email de contact au vendeur
	 * 
	 * @return unknown_type
	 */
	function contacterVendeur()
	{
		global $mainframe;

		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		// Initialize some variables
		$db			= & JFactory::getDBO();
		$SiteName	= $mainframe->getCfg('sitename');

		$default	= JText::sprintf( 'MAILENQUIRY', $SiteName );
		$contactId	= JRequest::getInt( 'id',			0,			'post' );
		$name		= JRequest::getVar( 'name',			'',			'post' );
		$email		= JRequest::getVar( 'email',		'',			'post' );
		$body		= JRequest::getVar( 'text',			'',			'post' );
		$emailCopy	= JRequest::getInt( 'email_copy', 	0,			'post' );

		 // load the contact details
		$model		= &$this->getModel('annonce');

		// query options
		$qOptions['id']	= $contactId;
		$annonce		= $model->getAnnonce( $qOptions );
		$vendeur = JFactory::getUser($annonce->vendeurId);
		
		/*
		 * If there is no valid email address or message body then we throw an
		 * error and return false.
		 */
		jimport('joomla.mail.helper');
		if (!$email || !$body || (JMailHelper::isEmailAddress($email) == false))
		{
			$this->setError(JText::_('CONTACT_FORM_NC'));
			$this->display();
			return false;
		}

		$MailFrom 	= $mainframe->getCfg('mailfrom');
		$FromName 	= $mainframe->getCfg('fromname');

		// Prepare email body
		$prefix = JText::sprintf('ENQUIRY_TEXT', JURI::base());
		$body 	= $prefix."\n".$name.' <'.$email.'>'."\r\n\r\n".stripslashes($body);
		$subject = JText::sprintf('YOUR_ADDS', $annonce->typeVoilier );
		
		$mail = JFactory::getMailer();

		$mail->addRecipient( $vendeur->email );
		$mail->setSender( array( $email, $name ) );
		$mail->setSubject( $FromName.': '.$subject );
		$mail->setBody( $body );

		$sent = $mail->Send();
			
		// check whether email copy function activated
		if ( $emailCopy )
		{
			$copyText 		= JText::sprintf('Copy of:', $contact->name, $SiteName);
			$copyText 		.= "\r\n\r\n".$body;
			$copySubject 	= JText::_('Copy of:')." ".$subject;

			$mail = JFactory::getMailer();

			$mail->addRecipient( $email );
			$mail->setSender( array( $MailFrom, $FromName ) );
			$mail->setSubject( $copySubject );
			$mail->setBody( $copyText );

			$sent = $mail->Send();
		}

		$msg = JText::_( 'Thank you for your e-mail');
		$link = JRoute::_('index.php?option=com_annonces&view=annonce&id='.$annonce->id, false);
		$this->setRedirect($link, $msg);
	}
	
	/**
	 * L'utilisateur a changé la categorie dans
	 * le formulaire de saisie d'une annonce
	 * @return unknown_type
	 */
	function changerCategorie()
	{
		$id	= JRequest::getVar( 'id',			'',			'post' );
		$catid	= JRequest::getVar( 'categorie',			'',			'post' );
		$this->setRedirect("index.php?option=com_annonces&view=edit&id=".$id."&categorie=".$catid."&Itemid=".JRequest::getString('Itemid'));
	}
	
}
