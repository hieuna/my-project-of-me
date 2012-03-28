<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined('_JEXEC') or die('Restricted access'); 
?>
<form action="index.php" method="post" name="adminForm">
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( 'NUM' ); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort', 'DATE', 'a.date', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th  class="title">
				<?php echo JHTML::_('grid.sort', 'Objet', 'a.objet', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
			<th  class="title">
				<?php echo JHTML::_('grid.sort', 'Constructor', 'a.constructeur', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
			<th  class="title">
				<?php echo JHTML::_('grid.sort', 'Catname', 'c.catname', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
			<th  class="title">
				<?php echo JText::_('SELLER') ?>
			</th>
			<th width="5%" align="center">
				<?php echo JHTML::_('grid.sort', 'Approuved', 'a.approuved', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
			<th width="5%" align="center">
				<?php echo JHTML::_('grid.sort', 'Published', 'a.published', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
			<th width="1%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort', 'ID', 'a.id', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
		</tr>
			
	</thead>
	<tfoot>
			<tr>
				<td colspan="9">
					<?php echo $this->pageNav->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		
		$published		= JHTML::_('grid.published', $row, $i );
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$link 		= JRoute::_( 'index.php?option=com_annonces&controller=annonces&task=edit&cid[]='. $row->id );

		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $row->id; ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<?php echo JHTML::Date( $row->date, '%d/%m/%Y' ) ?>
			</td>
			<td>
				<a href="<?php echo $link; ?>"><?php echo $row->objet; ?></a>
			</td>
			<td>
				<?php echo $row->constructeur; ?>
			</td>
			<td>
				<?php echo $row->catname; ?>
			</td>
			<td>
				<a href="mailto:<?php echo $row->mailVendeur; ?>"><?php echo $row->vendeur; ?></a>
			</td>
			<td align="center">
				<?php echo Util::htmlButtonApprouved( $row, $i) ?>
			</td>
			<td align="center">
				<?php echo $published;?>
			</td>
			<td align="center">
				<?php echo $row->id; ?>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
	</table>
</div>

<input type="hidden" name="option" value="com_annonces" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="" />
<input type="hidden" name="controller" value="annonces" />
</form>
