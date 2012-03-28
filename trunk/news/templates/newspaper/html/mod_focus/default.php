<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$baseurl = JURI::base();
if(count($list)>0){
?>
<div class="box_modules clearfix">
	<div class="title_box_modules">Tiêu điểm</div>
	<table cellpadding="0" cellspacing="0" class="focus">
		<tr>
			<?php
			$i = 0;
			$j = 2; 
			foreach ($list as $item) :
			$j++;
			if ($i%2 == 0) {
				$class = ' class="bdr"';
				$style = ' style="background: #fff;"'; 
			}else {
				$class = '';
				$style = ' style="background: #F2F8FF;"'; 
			}
			?>
				<td<?php echo $class;?> valign="top">
					<a href="<?php echo $item->link; ?>">
						<img class="img45" src="<?php echo $baseurl;?>/images/stories/<?php echo $item->images;?>" />
					</a>
					<a href="<?php echo $item->link; ?>" class="mostread<?php echo $params->get('moduleclass_sfx'); ?>">
						<?php echo $item->text; ?></a>
				</td>
			<?php 
			$i++;
			if ($i%2 == 0){
				if ($j%4 == 0) echo '</tr><tr style="background: #F2F8FF;">';
				else  echo '</tr><tr>';
			}
			endforeach; 
			?>
		</tr>
	</table>
</div>
<?php }?>