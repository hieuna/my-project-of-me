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
	<div class="title_bg">Tin phản hồi nhiều nhất</div>
	<div class="box-module-content">
		<ul class="ul-module<?php echo $moduleclass_sfx; ?>">
			<?php
			$i = 0; 
			foreach ($list as $item) :
			$i++;
			if ($i%2 == 0) $bg = ' style="background: #ebf8fe;"'; else $bg = ''  
			?>
			<li<?php echo $bg;?>>
				<a href="<?php echo $item->link; ?>">
					<img class="img65" src="<?php echo htmlspecialchars(json_decode($item->images)->image_intro); ?>" alt="<?php echo $item->title; ?>" />
				</a>
				<a href="<?php echo $item->link; ?>">
					<?php echo $item->title; ?> (<?php echo $item->count;?>)
				</a>
			</li>
			<div class="clearfix"></div>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
