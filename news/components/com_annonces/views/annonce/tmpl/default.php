<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/defined('_JEXEC') or die('Restricted access'); 
?>
<script type="text/javascript">function confirmDelete(delUrl) {	  if ( confirm("<?php echo JText::_('SURE TO DELETE')?>")) {	    document.location = delUrl;	  }}
function showhide(divid, state){	document.getElementById(divid).style.display=state;	if ( state == 'none' ) {		document.getElementById('boutonCache').style.display='none';		document.getElementById('boutonVoir').style.display='block';	} else {		document.getElementById('boutonVoir').style.display='none';		document.getElementById('boutonCache').style.display='block';	}}</script>
<?php	$script = '<!--			function validateForm( frm ) {				var valid = document.formvalidator.isValid(frm);				if (valid == false) {
					// do field validation					if (frm.email.invalid) {						alert( "' . JText::_( 'Please enter a valid e-mail address.', true ) . '" );					} else if (frm.text.invalid) {						alert( "' . JText::_( 'CONTACT_FORM_NC', true ) . '" );					}					return false;				} else {					frm.submit();				}			}			// -->';		$document =& JFactory::getDocument();		$document->addScriptDeclaration($script);?>
<div class="componentheading"><?php echo JText::_('ADS_DETAIL'). ': '. JText::_('VENTE') . ' ' . $this->annonce->objet ?></div><div class="contentpane">
	<div class="actionUser">
		<?php echo Util::editLink( false, $this->annonce->vendeurId, JText::_('MODIFY'), 'edit', 'edit', $this->annonce->id, 'itemid'); ?>
        <?php echo Util::editLink( false, $this->annonce->vendeurId, JText::_('DELETE'), 'annonces', 'delete', $this->annonce->id, 'itemid'); ?>
	</div>
	<div id="detailAnnonce">
		<div id="photobox">
			<div class="article-tools" style="background:<?php echo $this->parametrage->headerBgColor?>">
				<span class="titreParag">
				<?php echo JText::_('published').' '.JHTML::Date( $this->annonce->date, '%d/%m/%Y' ) ?>
				, <?php sprintf( JText::printf('VISITS', $this->annonce->hits)) ?>.
				</span>
			</div>
			<!--  GESTION DES PHOTOS -->
			<a name='ancre'></a>
			<div class='img_top image_top'>
				
				<?php
					$i = 0; $trouve = 0;
					foreach ( $this->tableau_images as $image )
					{
						$i++;
						if ( $image->existe == true ) 
						{ 
							if ( $trouve == 0 ) 
							{ 
								$trouve = 1; ?>
								<div class='img_top image_top'>
									<img id='grande_photo_id' src='<?php echo $image->url?>'/>
								</div>
							<?php 
							} ?>
								<div class="img_cont"><div class="img_thumb"><a href="#ancre" rel="nofollow" onclick="changer('grande_photo_id','<?php echo $image->url?>'); return false;"><img src="<?php echo $image->vignetteUrl?>"/></a></div></div>
					<?php }
					}
				?>
				<div class="img_clr"></div>
			</div>
		</div>
		<div id="rightbox" class="rightbox">
			<div class="article-tools" style="background:<?php echo $this->parametrage->headerBgColor?>"><span class="titreParag"><?php echo JText::_('Properties'); ?></span>
			</div>			<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="border: 1px solid #DEDEDE">				<tr class="sectiontableentry<?php $i=0; echo ($i++)%2 + 1; ?>">					<td><?php echo JText::_('Price'); ?>:</td>					<td class="prix"><?php echo sprintf( JText::_('PRICE FORMAT'), number_format($this->annonce->prix, 0, '.', ' ') , $this->parametrage->currency); ?></td>				</tr>				<tr class="sectiontableentry<?php echo ($i++)%2 + 1; ?>">					<td><?php echo JText::_('objet'); ?>:</td>					<td class="objet"><?php echo $this->annonce->objet ?></td>				</tr>				<?php if ( $this->annonce->showConstructor ) : ?>
					<tr class="sectiontableentry<?php echo ($i++)%2 + 1; ?>">
						<td><?php echo JText::_('Constructor'); ?>:</td>
						<td><strong><?php echo $this->annonce->constructeur ?></strong></td>
					</tr>
				<?php endif; ?>
				<?php if ( $this->annonce->showYear ) : ?>
					<tr class="sectiontableentry<?php echo ($i++)%2 + 1; ?>">
						<td><?php echo JText::_('Year'); ?>:</td>
						<td><strong><?php echo $this->annonce->annee ?></strong></td>
					</tr>
				<?php endif; ?>	
				<?php if ( $this->annonce->showDimensions ) : ?>
					<tr class="sectiontableentry<?php echo ($i++)%2 + 1; ?>">
						<td><?php echo JText::_('Length'); ?>:</td>
						<td><strong><?php echo number_format($this->annonce->longueur, 2, '.', ' ') . ' ' .$this->parametrage->metric ?></strong></td>
					</tr>
					<tr class="sectiontableentry<?php echo ($i++)%2 + 1; ?>">
						<td><?php echo JText::_('Width'); ?>:</td>
						<td><strong><?php echo number_format($this->annonce->largeur, 2, '.', ' ') .' ' . $this->parametrage->metric ?></strong></td>
					</tr>
				<?php endif; ?>
				<tr class="sectiontableentry<?php echo ($i++)%2 + 1; ?>">
					<td><?php echo JText::_('city'); ?>:</td>
					<td><strong><?php echo $this->annonce->villeObjet ?></strong></td>
				</tr>
				<?php 
					for ($j = 1; $j < 6; $j++) 
					{
						$propriete = 'propriete'.$j;
						$libelle = 'libelle'.$j;
						
						$valeur = $this->annonce->$propriete;
						$valeur2 = $this->annonce->$libelle;
						if ( $valeur ) : ?>
							<tr class="sectiontableentry<?php echo ($i++)%2 + 1; ?>">
								<td><?php echo $valeur2 ?>:</td>
								<td><strong><?php echo $valeur ?></strong></td>
							</tr>
						<?php endif; 
					}	
				?>
			</table>
			<div class="article-tools" style="background:<?php echo $this->parametrage->headerBgColor?>"><span class="titreParag"><?php echo JText::_('Seller'); ?></span></div>
			<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="border: 1px solid #DEDEDE">
				<tr class="sectiontableentry1">
					<td><?php echo JText::_('Name'); ?>:</td>
					<td><strong><?php echo $this->annonce->vendeur->name ?></strong></td>
				</tr>
				<tr class="sectiontableentry2">
					<td><?php echo JText::_('Tel'); ?>:</td>
					<td>
						<?php if ( $this->annonce->telephone ) { 
			            	echo JHTML::_('image', 'images/M_images/con_tel.png',$this->annonce->telephone, array('align' => 'middle')) . ' ' . nl2br($this->escape( $this->annonce->telephone ) );
						} else echo '-'; ?>
					</td>
				</tr>
				<tr class="sectiontableentry1">
					<td><?php echo JText::_('Mobile'); ?>:</td>
					<td>
						<?php if ( $this->annonce->portable ) { 
			            	echo JHTML::_('image', 'images/M_images/con_mobile.png',$this->annonce->portable, array('align' => 'middle')) . ' ' . nl2br($this->escape( $this->annonce->portable ) );
						} else echo '-'; ?>
					</td>
				</tr>
				<tr class="sectiontableentry2">
					<td colspan="2" align="right">
						<a href="#" onclick="showhide('contactbox', 'block'); return false"><button id="boutonVoir" class="button" type="submit" ><?php echo JText::_('SEND EMAIL'); ?></button></a>
						<a href="#" onclick="showhide('contactbox', 'none'); return false"><button id="boutonCache" class="button" style="display:none" type="submit" ><?php echo JText::_('CANCEL'); ?></button></a>
						<div id="contactbox" style="display:none">
							<form action="<?php echo JRoute::_( 'index.php' );?>" method="post" name="emailForm" id="emailForm" class="form-validate">
								<div id="contact_email">
									<label for="contact_name">
										&nbsp;<?php echo JText::_( 'Enter your name' );?>:
									</label>
									<br />
									<input type="text" name="name" id="contact_name" size="30" class="inputbox" value="<?php echo ( $this->user != null ? $this->user->get('name') : '') ?>" />
									<br />
									<label id="contact_emailmsg" for="contact_email">
										&nbsp;<?php echo JText::_( 'Email address' );?>:
									</label>
									<br />
									<input type="text" id="contact_email" name="email" size="30" value="<?php echo ( $this->user != null ? $this->user->get('email') : '') ?>" class="inputbox required validate-email" maxlength="100" />
									<br />
									<label id="contact_textmsg" for="contact_text">
										&nbsp;<?php echo JText::_( 'Your message' );?>:
									</label>
									<br />
									<textarea cols="25" rows="8" name="text" id="contact_text" class="inputbox required"></textarea>
									<br />
										<input type="checkbox" name="email_copy" id="contact_email_copy" value="1"  />
										<label for="contact_email_copy">
											<?php echo JText::_( 'EMAIL_A_COPY' ); ?>
										</label>
									<br />
									<br />
									<button class="button validate" type="submit"><?php echo JText::_('Send'); ?></button>
								</div>
						
							<input type="hidden" name="option" value="com_annonces" />
							<input type="hidden" name="view" value="annonce" />
							<input type="hidden" name="id" value="<?php echo $this->annonce->id; ?>" />
							<input type="hidden" name="task" value="contacterVendeur" />
							<?php echo JHTML::_( 'form.token' ); ?>
							</form>
						</div>
					</td>
				</tr>
				
			</table>
		</div>
		<div id="descriptionBox">
			<div class="article-tools" style="background:<?php echo $this->parametrage->headerBgColor?>"><span class="titreParag"><?php echo JText::_('DESC_SELLER'); ?></span>
			</div>
					<span><?php echo $this->annonce->description ?></span>
		</div>
	</div>
</div>