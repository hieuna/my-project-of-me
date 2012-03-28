<?php /** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined('_JEXEC') or die('Restricted access'); ?>

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
				<th  class="title">
				<?php echo JHTML::_('grid.sort', 'Catname', 'c.catname', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
			<th width="5%" align="center">
				<?php echo JHTML::_('grid.sort', 'Published', 'c.published', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
			<th width="7%">
				<?php echo JHTML::_('grid.sort', 'ACCESS', 'c.access', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="80">
				<?php echo JHTML::_('grid.sort', 'REORDER', 'c.ordering', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="1%">
				<?php echo JHTML::_('grid.order', $this->items, 'filesave.png', 'saveordercat' ); ?>
			</th>
			<th width="1%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort', 'ID', 'c.id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
		</tr>
			
	</thead>
	<tfoot>
			<tr>
				<td colspan="9">
					<?php if ( $this->pageNav) echo $this->pageNav->getListFooter(); ?>
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
		$link 		= JRoute::_( 'index.php?option=com_annonces&controller=categories&task=edit&cid[]='. $row->id );
		$access 	= JHTML::_('grid.access', $row, $i );
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $row->id; ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<a href="<?php echo $link; ?>"><?php echo $row->catname; ?></a>
			</td>
			<td align="center">
				<?php echo $published;?>
			</td>
			<td align="center">
				<?php echo $access; ?>
			</td>
			<td class="order" colspan="2">
				<span><?php echo $this->pageNav->orderUpIcon( $i, true, 'orderup', 'Move Up', $this->ordering ); ?></span>

				<span><?php echo $this->pageNav->orderDownIcon( $i, $n, true, 'orderdown', 'Move Down', $this->ordering );?></span>

				<?php $disabled = $this->ordering ?  '' : '"disabled=disabled"'; ?>

				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" <?php echo $disabled; ?> class="text_area" style="text-align: center" />
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
<input type="hidden" name="view" value="categories" />
<input type="hidden" name="controller" value="categories" />
</form>
