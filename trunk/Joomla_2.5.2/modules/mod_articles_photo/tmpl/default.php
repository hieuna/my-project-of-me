<?php
// no direct access
defined('_JEXEC') or die;
?>
<?php if (!empty($list)) :?>
	<div class="tinanh_top"></div>
	<div class="tinanh_content">  
	    <div style="width:285px;margin:10px auto;clear:both;overflow:hidden">          
	        <a href="<?php echo $list[0]->link; ?>">
				<img src="<?php echo htmlspecialchars(json_decode($list[0]->images)->image_intro); ?>" width="283" alt="<?php echo $list[0]->title; ?>" />
			</a> 
	        <br />
	        <span class="txt_black_m" style="line-height:17px;"><?php echo $list[0]->introtext; ?></span>        
	        <a href="<?php echo $list[0]->link; ?>" style="float:right;font-style:italic;" class="txt_004a80_m">Xem tiếp &raquo;</a>           
	    </div>
	    <ul class="listOtherNewsChaoco">        
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
	<div class="tinanh_bottom" style="margin-bottom:6px;"></div>
<?php endif; ?>