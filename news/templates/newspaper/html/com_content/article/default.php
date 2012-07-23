<?php // no direct access
defined('_JEXEC') or die('Restricted access');

$canEdit	= ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own'));
?>
<div class="view_content">
	<?php if ($this->params->get('show_page_title', 1) && $this->params->get('page_title') != $this->article->title) : ?>
		<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
			<?php echo $this->escape($this->params->get('page_title')); ?>
		</div>
	<?php endif; ?>
	<?php if ($canEdit || $this->params->get('show_title') || $this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon')) : ?>
	<table class="contentpaneopen<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<?php if ($this->params->get('show_create_date')) : ?>
	<tr>
		<td valign="top" class="createdate" colspan="5">
			<?php echo JHTML::_('date', $this->article->created, JText::_('DATE_FORMAT_LC2')) ?>
		</td>
	</tr>
	<?php endif; ?>
	<tr>
		<?php if ($this->params->get('show_title')) : ?>
		<td class="contentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>" width="100%">
			<?php if ($this->params->get('link_titles') && $this->article->readmore_link != '') : ?>
			<a href="<?php echo $this->article->readmore_link; ?>" class="contentpagetitle<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
				<?php echo $this->escape($this->article->title); ?></a>
			<?php else : ?>
				<?php echo $this->escape($this->article->title); ?>
			<?php endif; ?>
		</td>
		<?php endif; ?>
		<?php if (!$this->print) : ?>
			<?php if ($this->params->get('show_pdf_icon')) : ?>
			<td align="right" width="100%" class="buttonheading">
			<?php echo JHTML::_('icon.pdf',  $this->article, $this->params, $this->access); ?>
			</td>
			<?php endif; ?>
	
			<?php if ( $this->params->get( 'show_print_icon' )) : ?>
			<td align="right" width="100%" class="buttonheading">
			<?php echo JHTML::_('icon.print_popup',  $this->article, $this->params, $this->access); ?>
			</td>
			<?php endif; ?>
	
			<?php if ($this->params->get('show_email_icon')) : ?>
			<td align="right" width="100%" class="buttonheading">
			<?php echo JHTML::_('icon.email',  $this->article, $this->params, $this->access); ?>
			</td>
			<?php endif; ?>
			<?php if ($canEdit) : ?>
			<td align="right" width="100%" class="buttonheading">
				<?php echo JHTML::_('icon.edit', $this->article, $this->params, $this->access); ?>
			</td>
			<?php endif; ?>
		<?php else : ?>
			<td align="right" width="100%" class="buttonheading">
			<?php echo JHTML::_('icon.print_screen',  $this->article, $this->params, $this->access); ?>
			</td>
		<?php endif; ?>
	</tr>
	</table>
	<?php endif; ?>
	
	<?php  if (!$this->params->get('show_intro')) :
		echo $this->article->event->afterDisplayTitle;
	endif; ?>
	<?php echo $this->article->event->beforeDisplayContent; ?>
	<table class="contentpaneopen<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<?php if (($this->params->get('show_section') && $this->article->sectionid) || ($this->params->get('show_category') && $this->article->catid)) : ?>
	<tr>
		<td>
			<?php if ($this->params->get('show_section') && $this->article->sectionid && isset($this->article->section)) : ?>
			<span>
				<?php if ($this->params->get('link_section')) : ?>
					<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->article->sectionid)).'">'; ?>
				<?php endif; ?>
				<?php echo $this->escape($this->article->section); ?>
				<?php if ($this->params->get('link_section')) : ?>
					<?php echo '</a>'; ?>
				<?php endif; ?>
					<?php if ($this->params->get('show_category')) : ?>
					<?php echo ' - '; ?>
				<?php endif; ?>
			</span>
			<?php endif; ?>
			<?php if ($this->params->get('show_category') && $this->article->catid) : ?>
			<span>
				<?php if ($this->params->get('link_category')) : ?>
					<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->article->catslug, $this->article->sectionid)).'">'; ?>
				<?php endif; ?>
				<?php echo $this->escape($this->article->category); ?>
				<?php if ($this->params->get('link_category')) : ?>
					<?php echo '</a>'; ?>
				<?php endif; ?>
			</span>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>
	
	<?php if ($this->params->get('show_url') && $this->article->urls) : ?>
	<tr>
		<td valign="top">
			<a href="http://<?php echo $this->article->urls ; ?>" target="_blank">
				<?php echo $this->escape($this->article->urls); ?></a>
		</td>
	</tr>
	<?php endif; ?>
	
	<tr>
	<td valign="top">
	<?php if (isset ($this->article->toc)) : ?>
		<?php echo $this->article->toc; ?>
	<?php endif; ?>
	<div class="fon33 mt1">
		<!--  <img class="img130" src="<?php echo $baseurl;?>images/stories/<?php echo $this->article->images;?>" />-->
		<?php echo $this->article->introtext; ?>
	</div>
	<div class="clr"></div>
	<div class="fon34"><?php echo $this->article->text; ?></div>
	</td>
	</tr>
	</table>
	<?php echo $this->article->event->afterDisplayContent; ?>
</div>	
<script type="text/javascript">
$('.view_content table.contentpaneopen table').css('width', '480px');
$('.img130').error(function() {
  $(this).hide();
});
</script>