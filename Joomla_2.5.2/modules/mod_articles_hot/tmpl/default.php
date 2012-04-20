<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_archive
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<?php if (!empty($list)) :?>
	<div class="title_bg">Tin nóng</div> 
	<div class="box-module-content" style="border: none;">
		<ul class="ul-module<?php echo $moduleclass_sfx; ?>">
			<?php foreach ($list as $item) : ?>
			<li class="hot"><font color="red">»</font>
				<a href="<?php echo $item->link; ?>">
					<?php echo $item->title; ?>
				</a>
			</li>
			<div class="clearfix"></div>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
