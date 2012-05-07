<?php defined('_JEXEC') or die('Restricted access'); ?>
<div class="article_others">
	<h3 class="contentheading"><?php echo JText::_( 'More Articles...' ); ?></h3>
	<ul>
	<?php
	 foreach ($this->links as $link) : ?>
		<li>
			<a class="blogsection" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($link->slug, $link->catslug, $link->sectionid)); ?>">
				<?php echo $this->escape($link->title); ?></a>
		</li>
	<?php endforeach; ?>
	</ul>
</div>