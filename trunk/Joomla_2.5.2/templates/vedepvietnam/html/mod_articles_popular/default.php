<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_popular
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<?php if (count($list) > 0):?>
	<a class="title_accordion" href="javascript: void(0);">Tin đọc nhiều nhất</a>
	<div>
		<ul class="mostread<?php echo $moduleclass_sfx; ?>">
			<?php foreach ($list as $item) : ?>
			<li>
				<a href="<?php echo $item->link; ?>">
					<?php echo $item->title; ?>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif;?>