<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$baseurl = JURI::base();
$nows = mktime(0,0,0,date("m"),date("d"),date("Y"));
$ngay_nhap = mktime(0,0,0,unFormatdate($this->item->created,"m"),unFormatdate($this->item->created,"d"),unFormatdate($this->item->created,"Y"));				
$days = ($nows - $ngay_nhap)/86400;
if ($days<1) $addClass = ' newnew';
else $addClass = '';
?>
<?php $canEdit   = ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')); ?>
<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished">
<?php endif; ?>

<?php if ($this->item->params->get('show_title') || $this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon') || $canEdit) : ?>
<table class="contentpaneopen<?php echo $this->escape($this->item->params->get( 'pageclass_sfx' )); ?>">
<tr>
	<td class="contentheading<?php echo $this->escape($this->item->params->get( 'pageclass_sfx' )); ?>" width="100%">
		<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->id, $this->item->catid, $this->item->sectionid)); ?>" class="contentpagetitle<?php echo $this->escape($this->item->params->get( 'pageclass_sfx' )); echo $addClass; ?>">
			<?php echo $this->escape($this->item->title); ?>
		</a>
	</td>
</tr>
</table>
<?php endif; ?>
<?php  if (!$this->item->params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
endif; ?>
<?php echo $this->item->event->beforeDisplayContent; ?>
<table class="contentpaneopen<?php echo $this->escape($this->item->params->get( 'pageclass_sfx' )); ?>">
<tr>
<td valign="top" colspan="2">
	<div class="mt1 clearfix">
		<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->id, $this->item->catid, $this->item->sectionid)); ?>">
			<?php if ($this->item->images != ""):?>
			<img class="img130" src="<?php echo $baseurl;?>images/stories/<?php echo $this->item->images;?>" />
			<?php else :?>
			<img class="img130" src="<?php echo $baseurl;?>images/no_image.jpg" />
			<?php endif;?>
		</a>
		<div class="fl wid300 mt0">
			<?php if (isset ($this->item->toc)) : ?>
				<?php echo $this->item->toc; ?>
			<?php endif; ?>
			<?php echo $this->item->text; ?>
		</div>
	</div>
</td>
</tr>

</table>
<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>
<span class="article_separator">&nbsp;</span>
<?php echo $this->item->event->afterDisplayContent; ?>
<script type="text/javascript">
$('.img130').error(function() {
  $(this).hide();
  $(this).parent().next('.wid300').css('width', 'auto');
});
</script>