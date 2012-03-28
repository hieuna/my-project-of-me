<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined('_JEXEC') or die('Restricted access'); ?>

<script language="javascript" type="text/javascript">
function submitbutton(pressbutton)
{
	var form = document.adminForm;
	var catdescription = <?php echo $this->editor->getContent( 'catdescription' ); ?>
	
	if (pressbutton == 'cancel') {
		submitform( pressbutton );
		return;
	}

	// do field validation
	if (form.catname.value == ""){
		alert( "<?php echo JText::_( 'ADD NAME CATEGORY' ); ?>" );
	} else {
		<?php echo $this->editor->save( 'catdescription' ); ?>
		submitform( pressbutton );
	}
}
</script>

<?php $infoimage = JHTML::image('components/com_annonces/assets/images/icon-16-hint.png', JText::_( 'NOTES' ) );
?>

<form enctype="multipart/form-data" action="index.php" method="post" name="adminForm" id="adminForm">
<div>
		<fieldset class="adminform">
		<legend><?php echo JText::_( 'ADS' ); ?></legend>
			<table class="adminform">
				<tr>
					<td>
						<label for="title"><?php echo JText::_('catname'); ?></label>
					</td>
					<td>
						 <input class="inputbox required" type="text" id="catname" name="catname" value="<?php echo $this->escape($this->categorie->catname); ?>" size="40" maxlength="100" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="title"><?php echo JText::_('alias'); ?></label>
					</td>
					<td>
						 <input class="inputbox required" type="text" id="alias" name="alias" value="<?php echo $this->escape($this->categorie->alias); ?>" size="40" maxlength="100" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="title"><?php echo JText::_('PUBLISHED'); ?></label>
					</td>
					<td>
						 <?php
				             echo JHTML::_('select.booleanlist','published','class="inputbox"',$this->categorie->published); 
							?>
					</td>
				</tr>
			</table>
		</fieldset>	
						
		<fieldset class="fieldset">
    		<legend><?php echo JText::_('Display options'); ?></legend>
        	<table class="adminform">
        		<tr>
					<td width="25%">
						<label for="title"><?php echo JText::_('showDimensions'); ?></label>
					</td>
					<td>
						 <?php
				             echo JHTML::_('select.booleanlist','showDimensions','class="inputbox"',$this->categorie->showDimensions); 
							?>
					</td>
				</tr>
				<tr>
					<td width="25%">
						<label for="title"><?php echo JText::_('showConstructor'); ?></label>
					</td>
					<td>
						 <?php
				             echo JHTML::_('select.booleanlist','showConstructor','class="inputbox"',$this->categorie->showConstructor); 
							?>
					</td>
				</tr>
				<tr>
					<td width="25%">
						<label for="title"><?php echo JText::_('showYear'); ?></label>
					</td>
					<td>
						 <?php
				             echo JHTML::_('select.booleanlist','showYear','class="inputbox"',$this->categorie->showYear); 
							?>
					</td>
				</tr>
	       	</table>
	</fieldset>
	
	<fieldset class="fieldset">
    		<legend><?php echo JText::_('More Fields'); ?></legend>
        	<table class="adminform">
        		<?php for ( $i = 1; $i <6; $i++ ) 
        		{ 
        			$property = 'property'.$i;
        			?>
	        		<tr>
						<td width="25%">
							<label for="title"><?php echo JText::_('FIELD').' '.$i; ?></label>
						</td>
						<td>
							<input class="inputbox required" type="text" id="<?php echo $property ?>" name="<?php echo $property ?>" value="<?php echo $this->escape($this->categorie->$property); ?>" size="40" maxlength="100" />
						</td>
					</tr>
				<?php 
        		}?>
        	</table>
	</fieldset>
	
	
	<fieldset class="description">
      	<legend><?php echo JText::_('DESCRIPTION') ?></legend>
      	<?php
      		echo $this->editor->display('catdescription', $this->categorie->catdescription, '100%', '400', '70', '15', array('pagebreak', 'readmore') );
		?>
    </fieldset>

	
</div>
<div class="clr"></div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_annonces" />
<input type="hidden" name="id" value="<?php echo $this->categorie->id; ?>" />
<?php echo JHTML::_( 'form.token' ); ?>
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="categories" />
<input type="hidden" name="view" value="categorie" />
</form>
