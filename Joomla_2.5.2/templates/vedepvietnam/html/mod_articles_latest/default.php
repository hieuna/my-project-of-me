<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_latest
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<?php if (!empty($list)) :?>
<div class="latestnews">
    <div class="bgimage">       
         <a href="<?php echo $list[0]->link;?>">
         <img src="<?php echo htmlspecialchars(json_decode($list[0]->images)->image_intro); ?>" alt="" style="border: 0px; width: 532px;" />
         </a> 
    </div>     
    <div class="contentfirst">
        <div style="clear: both;padding-top:5px;height:22px;overflow:hidden;">
            <a class="txt_18_bold" href="<?php echo $list[0]->link;?>">
               <?php echo $list[0]->title;?>
            </a>     
        </div>
        <div style="clear: both; width: 100%; overflow: hidden;height:55px;">
            <span class="txt_black_m"><?php echo $list[0]->introtext;?></span>                
            <a style="padding-left:10px;" class="color1" href="<?php echo $list[0]->link;?>">Xem tiếp &raquo;</a>
        </div>
        <div class="clearFix"></div>
    </div>    
    <div class="contentOther"> 
    		<?php
    		$i = 0; 
    		foreach ($list as $item) :
    		$images = json_decode($item->images);
    		if ($i > 0){ 
    		?>      
                <div class="spance1"></div>    
                <div class="latest-orther">
                	<div class="img-thumnal-latest">
                     <a href="<?php echo $item->link;?>" class="color3 fontsize12">
                     	<img alt="img" src="<?php echo htmlspecialchars($images->image_intro); ?>" />
                     </a>
                     </div>                               
                    <a href="<?php echo $item->link;?>" class="color3 fontsize12"><?php echo $item->title;?></a>                        
                </div>
                <div class="spance2"></div>            
			<?php
    		}
			$i++; 
			endforeach; 
			?>                
        <div class="clearFix"></div>
    </div>
    <div class="clearFix"></div>
</div>
<?php endif; ?>