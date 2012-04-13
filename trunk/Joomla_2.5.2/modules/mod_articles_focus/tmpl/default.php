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
		<?php
		$i = 0;
		foreach ($list as $item) : 
			$i++;
			if ($i == 1){
			?>
			<div style="border-top:1px solid #D7D7D7;clear:both;width:100%;">
				<a style="display:block;" href="<?php echo $item->link; ?>">
					<img src="http://www.tuoitre.vn/Images/Thumbnail/923/556923_336_600.jpg" style="width:181px;height:102px;border:solid 1px #efedee;padding-left:6px;padding-top:8px;" alt="">
				</a> 
			</div>
			<div style="padding-top:8px;" class="paddingLeft6px bold"><a href="<?php echo $item->link; ?>" class="color5"><?php echo $item->title; ?></a></div>			
			<?php }?>
		<?php endforeach; ?>
		<div style="padding-bottom:8px;" class="boxLinkShare">
			<ul>
			<?php
			$i = 0;
			foreach ($list as $item) : 
				$i++;
				if ($i > 1){
				?>			
				<li>
					<a href="<?php echo $item->link; ?>">
						<?php echo $item->title; ?>
					</a>
				</li>
				<?php }?>
			<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>
<?php endif; ?>