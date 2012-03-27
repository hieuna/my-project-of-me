<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$baseurl = JURI::base();
//var_dump($list); 
?>
<div class="box_modules clearfix">
	<div class="title_box_modules">Bài đọc nhiều nhất</div>
	<ul class="mostread<?php echo $params->get('moduleclass_sfx'); ?>">
	<?php
	$i =1; 
	foreach ($list as $item) :
	$i++;
	if ($i%2 == 0) $style = ' style="background: #FFF;"'; else $style = ' style="background: #F2F8FF;"'; 
	?>
		<li class="mostread<?php echo $params->get('moduleclass_sfx'); ?> clearfix"<?php echo $style;?>>
			<a href="<?php echo $item->link; ?>">
				<img class="img45" src="<?php echo $baseurl;?>/images/stories/<?php echo $item->images;?>" />
			</a>
			<a href="<?php echo $item->link; ?>" class="mostread<?php echo $params->get('moduleclass_sfx'); ?>">
				<?php echo $item->text; ?></a>
		</li>
	<?php endforeach; ?>
	</ul>
</div>