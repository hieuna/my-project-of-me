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
<div class="boxShareClunmleft2TOp">
	<div class="boxShareClunmleft2Btom">
		<div class="color2 bold fontsize16 padding6 textCter">
			<a href="#" class="color2">Tiêu điểm</a>
		</div>
		<div class="box_image_focus">
			<a href="<?php echo $list[0]->link; ?>">
				<img src="<?php echo htmlspecialchars(json_decode($list[0]->images)->image_intro); ?>" alt="<?php echo $list[0]->title; ?>" />
			</a> 
		</div>
		<div style="padding-top:8px;" class="paddingLeft6px bold"><a href="<?php echo $list[0]->link; ?>" class="color5"><?php echo $list[0]->title; ?></a></div>			
		<div style="padding-bottom:8px;" class="boxLinkShare">
			<ul>
			<?php
			$i = 0;
			foreach ($list as $item) : 
			if ($i > 0){
			?>			
				<li>
					<a href="<?php echo $item->link; ?>">
						<?php echo $item->title; ?>
					</a>
				</li>
			<?php
			}
			$i++; 
			endforeach; 
			?>
			</ul>
		</div>
	</div>
</div>
<?php endif; ?>