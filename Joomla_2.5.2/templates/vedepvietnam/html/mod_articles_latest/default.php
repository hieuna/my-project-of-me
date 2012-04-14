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
         <a href="http://tuoitre.vn/Chinh-tri-Xa-hoi/485694/12-tau-ca-Viet-ung-cuu-mot-tau-ca-Viet.html" target="_self" >  <img src="http://tuoitre.vn/imageviewNB.aspx?ArticleID=485694" alt="" style="border: 0px; height: 280px;" />  </a> 
    </div>     
    <div class="contentfirst">
        <div style="clear: both;padding-top:5px;height:22px;overflow:hidden;">
            <a class="txt_18_bold" style="line-height:22px;" href="<?php echo $list[0]->link;?>">
               <?php echo $list[0]->title;?>
            </a>     
        </div>
        <div style="clear: both; width: 100%; overflow: hidden;height:55px;">
            <span class="txt_black_m" style="line-height: 16px;">Thêm vào mô tả bài viết</span>                
                <a style="padding-left:10px;" class="color1" target="_self"
                    href="http://tuoitre.vn/Chinh-tri-Xa-hoi/485694/12-tau-ca-Viet-ung-cuu-mot-tau-ca-Viet.html">Xem tiếp &raquo;</a>
        </div>
        <div class="clearFix"></div>
    </div>    
    <div class="contentOther"> 
    		<?php
    		$i = 0; 
    		foreach ($list as $item) :
    		if ($i > 0){ 
    		?>      
                <div style="width:10px;float:left;height:94px;"></div>
                <div style="width:110px;float:left;height:114px;">
                     <a href="<?php echo $item->link;?>" class="color3 fontsize12"><img alt="img" src="http://www.tuoitre.vn/Images/Thumbnail/32/557032_336_600.jpg" style="width:110px;height:62px;border:0px;" /></a>                               
                    <a href="<?php echo $item->link;?>" class="color3 fontsize12"><?php echo $item->title;?></a>                        
                </div>
                <div style="width:2px;float:left;height:94px;overflow:hidden;"></div>            
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