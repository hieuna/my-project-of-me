<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
class Mail 
{
	
	/**
	 * Methode pour envoyer un mail
	 */
	function envoyerMail( $annonceId )
	{
		global $mainframe;
		
		$parametrage = Util::parametrage();
		
		$db			= & JFactory::getDBO();
		$query = 'SELECT a.*,u.name as vendeur'
					. ' FROM #__annonces AS a'
					. ' LEFT JOIN #__users AS u ON u.id = a.vendeurId'
					. ' WHERE a.id = '.$annonceId
					;
		$db->setQuery($query);
		$annonce = $db->loadObject();

		$vendeur = JFactory::getUser($annonce->vendeurId);

		$email = $vendeur->email;
		$name = $vendeur->name;
		$SiteName	= $mainframe->getCfg('sitename');
		$MailFrom 	= $mainframe->getCfg('mailfrom');
		$FromName 	= $mainframe->getCfg('fromname');

		// Prepare email body
		$body 	= ( $annonce->approuved == true ? JText::sprintf('MAIL_UPDATE',$vendeur->name) : JText::sprintf('MAIL_ADD', $vendeur->name) );
		$subject = ( $annonce->approuved == true ? JText::_('MAIL_UPDATE_SUBJECT') : JText::_('MAIL_ADD_SUBJET') );
		
		$body.="\n\n". JText::_('PROPERTIES'). ' : '.$annonce->objet;
		$body.="\n". JText::_('SELLER'). ' : '.$name;
		
		if ( $annonce->approuved == true ) {
			$body.="\n\n". JText::_('MODIFY_MAIL');
			$body.="\n".JURI::root()."index.php?option=com_annonces&view=annonce&id=".$annonce->id;
		}
		$body.="\n\n--\n". JText::_('SIGNATURE_MAIL');
		$body.="\n". $SiteName ."\n". str_replace( "administrator/", "", JURI::base());
		
		$mail = JFactory::getMailer();

		$mail->addRecipient( $vendeur->email );
		// L'administrateur est notifiée ou pas en fonction de la configuration choisie
		if ( $parametrage->updateEmailNotification == true )
			$mail->addCC( $MailFrom );
		$mail->setSender( array( $MailFrom, $FromName ) );
		$mail->setSubject( $subject );
		$mail->setBody( $body );

		$sent = $mail->Send();
	}
	
}