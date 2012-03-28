<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined('_JEXEC') or die('Restricted access'); ?>

<script language="javascript" type="text/javascript">
	function submitbutton(task)
	{
		var form = document.adminForm;
		
		if (task == 'cancel') {
			submitform( task );
		} else if (form.date.value == ""){
			alert( "<?php echo JText::_( 'ENTER DATE'); ?>" );
		} else if (form.objet.value == ""){
			alert( "<?php echo JText::_( 'ENTER OBJECT'); ?>" );
			form.objet.focus();
		} else if (!form.date.value.match(/[0-9]{4}-[0-1][0-9]-[0-3][0-9]/gi)) {
			alert("<?php echo JText::_( 'DATE WRONG'); ?>");
		} 
		<?php if ( $this->annonce->showConstructor ) { ?>
			else if ( form.constructeur.value.length==0 ) {
				alert("<?php echo JText::_( 'ENTER CONSTRUCTOR', true ); ?>");
					form.constructeur.focus();
					return false;
			}
		<?php } ?>
		<?php if ( $this->annonce->showYear ) { ?>
			else if ( form.annee.value.length==0 ) {
				alert("<?php echo JText::_( 'ENTER YEAR', true ); ?>");
					form.annee.focus();
					return false;
			}
		<?php } ?> 
		else if ( form.villeObjet.value.length==0 ) {
			alert("<?php echo JText::_( 'ENTER CITY', true ); ?>");
				form.villeObjet.focus();
				return false;
		} 
		<?php if ( $this->annonce->showDimensions ) { ?>
			else if ( toTransFloat(form.longueur) == '' ) {
				alert("<?php echo JText::_( 'ENTER LENGTH', true ); ?>");
					form.longueur.focus();
					return false;
			}
			else if ( toTransFloat(form.largeur) == '' ) {
					alert("<?php echo JText::_( 'ENTER WIDTH', true ); ?>");
					form.largeur.focus();
					return false;
			}
		<?php } ?> 
		else {
			<?php
			echo $this->editor->save( 'description' );
			?>

			submitform( task );
		}
	}

	function toTransFloat( input )
	{
		value = input.value;
		if ( value != null && value.length != 0 )
			value = value.replace( ',' , '.' );
		else 
			return false;

		input.value = ( isNaN( parseFloat( value ) ) == false ? parseFloat( value ) : "" ); 
		return input.value;
	}
	
	function supprimerPhoto( photoId )
	{
		var form = document.adminForm;
		form.photoSupprId.value=photoId;
		submitform( 'effacerPhoto' );
	}

	function changerCategorie()
	{
		var form = document.getElementById('adminForm');
		form.task.value='changerCategorie';
		form.submit();
	}
	
</script>

<?php $infoimage = JHTML::image('components/com_annonces/assets/images/icon-16-hint.png', JText::_( 'NOTES' ) );?>

<form enctype="multipart/form-data" action="index.php" method="post" name="adminForm" id="adminForm">
<div>
<fieldset class="adminform">
	<legend><?php echo JText::_( 'Details' ); ?></legend>
		<fieldset class="adminform">
		<legend><?php echo JText::_( 'ADS' ); ?></legend>
			<table class="adminform">
				<tr>
					<td width="20%">
						<label for="dates">
							<?php echo JText::_( 'DATE' ).':'; ?>
						</label>
					</td>
					<td>
						<?php echo JHTML::_('calendar', $this->annonce->date, "date", "date"); ?>
           				<span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('FORMAT DATE'); ?>">
							<?php echo $infoimage; ?>
						</span>
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="title"><?php echo JText::_('APPROUVED'); ?></label>
					</td>
					<td>
						 <?php
				             echo JHTML::_('select.booleanlist','approuved','class="inputbox"',$this->annonce->approuved); 
							?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="title"><?php echo JText::_('PUBLISHED'); ?></label>
					</td>
					<td>
						 <?php
				             echo JHTML::_('select.booleanlist','published','class="inputbox"',$this->annonce->published); 
							?>
					</td>
				</tr>
			</table>
		</fieldset>	
						
		<fieldset class="fieldset">
    		<legend><?php echo JText::_('Properties'); ?></legend>
        	<table class="adminform">
        		<tr>
					<td width="20%">
						<label for="title"><?php echo JText::_( 'CATEGORY' ).':';?></label>
					</td>
					<td>
						 <?php
		                	$html = JHTML::_('select.genericlist', $this->categories, 'categorie','size="1" onchange="javascript:changerCategorie()"', 'value', 'text', $this->annonce->categorie );
		                	echo $html;
		          		?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="title"><?php echo JText::_('OBJET'); ?></label>
					</td>
					<td>
						 <input class="inputbox required" type="text" id="objet2" name="objet" value="<?php echo $this->escape($this->annonce->objet); ?>" size="40" maxlength="100" />
						 <span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('ENTER OBJECT'); ?>">
							<?php echo $infoimage; ?>
						</span>
					</td>
				</tr>
				<?php if ( $this->annonce->showConstructor ) { ?>
					<tr>
						<td>
							<label for="title"><?php echo JText::_('constructor'); ?></label>
						</td>
						<td>
							<input class="inputbox required" type="text" id="constructeur" name="constructeur" value="<?php echo $this->escape($this->annonce->constructeur); ?>" size="40" maxlength="100" />
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('ENTER CONSTRUCTOR'); ?>">
								<?php echo $infoimage; ?>
							</span>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<label for="title"><?php echo JText::_('ETAT_NEUF'); ?></label>
					</td>
					<td>
						<?php
	                		echo JHTML::_('select.booleanlist','etatneuf','class="inputbox"',$this->annonce->etatneuf); 
	          			?>
					</td>
				</tr>
				<?php if ( $this->annonce->showYear ) { ?>
					<tr>
						<td>
							<label for="title"><?php echo JText::_('YEAR'); ?></label>
						</td>
						<td>
							<input class="inputbox required" type="text" id="annee" name="annee" value="<?php echo $this->escape($this->annonce->annee); ?>" size="6" maxlength="4" />
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('ENTER YEAR'); ?>">
								<?php echo $infoimage; ?>
							</span>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<label for="title"><?php echo JText::_('city'); ?></label>
					</td>
					<td>
						<input class="inputbox required" type="text" id="villeObjet" name="villeObjet" value="<?php echo $this->escape($this->annonce->villeObjet); ?>" size="40" maxlength="60" />
						<span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('ENTER CITY'); ?>">
								<?php echo $infoimage; ?>
						</span>
					</td>
				</tr>
				<?php if ( $this->annonce->showDimensions ) { ?>
					<tr>
						<td>
							<label for="title"><?php echo JText::_('LENGTH'); ?></label>
						</td>
						<td>
							<input class="inputbox required" type="text" id="longueur" name="longueur" value="<?php echo $this->escape($this->annonce->longueur); ?>" size="5" maxlength="10" />
							<?php echo '&nbsp;'. $this->parametrage->metric ?>
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('ENTER LENGTH'); ?>">
								<?php echo $infoimage; ?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="title"><?php echo JText::_('WIDTH'); ?></label>
						</td>
						<td>
							<input class="inputbox required" type="text" id="largeur" name="largeur" value="<?php echo $this->escape($this->annonce->largeur); ?>" size="5" maxlength="10" />
							<?php echo '&nbsp;'. $this->parametrage->metric ?>
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('ENTER WIDTH'); ?>">
								<?php echo $infoimage; ?>
							</span>
						</td>
					</tr>
				<?php } ?>
				<?php 
					for ($i = 1; $i <= 5; $i++) 
					{
						$propriete = 'propriete'.$i;
						$valeur = $this->annonce->$propriete;
						
						$libelle = "libelle".$i;
						$valeurLibelle = $this->annonce->$libelle;
						
						$affiche = strlen( $valeurLibelle );
						
						if ( $affiche > 0 ) { ?>
							<tr>
								<td>
									<label for="<?php echo 'propriete'.$i?>"><?php echo $valeurLibelle.':';  ?></label>
								</td>
								<td>
									<input class="inputbox" type="text" id="<?php echo 'propriete'.$i?>" name="<?php echo 'propriete'.$i?>" value="<?php echo $valeur ?>" size="30" maxlength="50" />
								</td>
							</tr>
						<?php }
					}	
				?>
				
				<tr>
					<td>
						<label for="title"><?php echo JText::_('PRICE'); ?></label>
					</td>
					<td>
						 <input class="inputbox required" type="text" id="prix" name="prix" value="<?php echo $this->escape($this->annonce->prix); ?>" size="5" maxlength="10" />
						 <?php echo '&nbsp;'. $this->parametrage->currency ?>
					</td>
				</tr>
        	</table>
	</fieldset>
	
	<fieldset>
      	  <legend><?php echo JText::_('SELLER'); ?></legend>
      	  
      	  <table class="adminform">
        	<tr>
				<td width="20%">
					<label for="title"><?php echo JText::_( 'SELLER' ).':';?></label>
				</td>
				<td>
					 <?php
	                	$html = JHTML::_('select.genericlist', $this->listUsers, 'vendeurId','size="1"', 'value', 'text', $this->annonce->vendeurId );
	                	echo $html;
	          		?>
				</td>
			</tr>
	      	<tr>
				<td width="20%">
					<label for="telephone"><?php echo JText::_( 'Tel' ).':'; ?></label>
				</td>
				<td>
					 <input class="inputbox" type="text" id="telephone" name="telephone" value="<?php echo $this->escape($this->annonce->telephone); ?>" size="20" maxlength="20" />
				</td>
			</tr>
      	  	<tr>
				<td width="20%">
					<label for="telephone"><?php echo JText::_( 'mobile' ).':'; ?></label>
				</td>
				<td>
					 <input class="inputbox" type="text" id="portable" name="portable" value="<?php echo $this->escape($this->annonce->portable); ?>" size="20" maxlength="20" />
				</td>
			</tr>
		 </table>
        </fieldset>
        
        <fieldset>
      	  <legend><?php echo JText::_('PHOTOS'); ?></legend>
      		<table class="adminform">
        		<tr>
		          <?php
	      		    $j=1;
	      		    foreach ( $this->tableau_images as $image )
					{ 
						?>
							<td>
								<?php if ( $image->existe==true):  ?>
									<img src="<?php echo $image->vignetteUrl?>"/> 
									<input type="button" value="<?php echo JText::_('DELETE')?>" onClick="return supprimerPhoto('<?php echo $j?>')" />
								<?php endif; ?>	
								<br/><label for="photo<?php echo $j?>"><?php echo JText::_( 'PHOTO' ).' '.$j; ?></label><br/>
								<input class="inputbox" name="photo<?php echo $j?>" id="photo<?php echo $j?>" type="file" />
							</td>
						<?php 
						$j++;
					}
	        	?>
	        	</tr>
	        </table>
          
    	</fieldset>

    	<fieldset class="description">
      		<legend><?php echo JText::_('DESC_SELLER') ?></legend>
      		<?php
      			echo $this->editor->display('description', $this->annonce->description, '100%', '400', '70', '15', array('pagebreak', 'readmore') );
			?>
    	</fieldset>
  </fieldset> 
	
</div>
<div class="clr"></div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_annonces" />
<input type="hidden" name="id" value="<?php echo $this->annonce->id; ?>" />
<?php echo JHTML::_( 'form.token' ); ?>
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="annonces" />
<input type="hidden" name="view" value="annonce" />
<input type="hidden" name="photoSupprId" id="photoSupprId" value=""/>
</form>
