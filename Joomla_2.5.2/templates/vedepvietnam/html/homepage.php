<?php
defined('_JEXEC') or die;

$baseurl = JURI::base();
$db = JFactory::getDbo();

//Get Categories
$query 		= $db->getQuery(true);

$query->select("id, title, alias");
$query->from("#__categories");
$query->where("published=1 AND level=2");
$query->order("parent_id ASC, id ASC");
$db->setQuery($query);
$results = $db->loadObjectList();
echo '<ul id="colHomeCenter">';
foreach ($results as $result)
{
	$subquery 	= $db->getQuery(true);
	$subquery->select("id, title, alias");
	$subquery->from("#__categories");
	$subquery->where("published=1 AND level=3 AND parent_id=".$result->id);
	$subquery->order("parent_id ASC, id ASC");
	$db->setQuery($subquery, 0, 3);
	$sbResults = $db->loadObjectList();
	//echo count($sbResults);
	if (count($sbResults) == 0) $array = $result->id;
	else $array = $result->id.",";
	?>
	<li>
		<div class="ChannelSample_left"></div>
		<div class="ChannelSample_rpt">
			<div class="sortHomeTitle">
				<div class="boxTabMnuShare">
	                <a class="txt_16_bold afl"><?php echo $result->title;?></a>
	                <?php
	                $i = 1;
	                foreach ($sbResults as $sbresult){
	                	if ($i == count($sbResults)) $str = ""; else $str = ",";
	                	$array .= $sbresult->id.$str;
	                	?>
	                	<a class="txt_12 afr"><?php echo $sbresult->title;?></a><span class="txt_space">|</span>
	                	<?php
	                	$i++; 
	                }
	                $array;
	                ?>
	                <div class="clearFix"></div>
	            </div>
			</div>
			<div style="clear:both;">
				<?php
				$sql = $db->getQuery(true);
				$sql->select("id, title, alias, introtext, images, catid");
				$sql->from("#__content");
				$sql->where("state=1 AND catid IN(".$array.")");
				$sql->order("ordering ASC, created DESC");
				$db->setQuery($sql , 0, 6);
				$rows = $db->loadObjectList();
				//echo $sql; 
				?>
				<div class="boxContentOderShare">
					<?php
					$i = 0; 
					foreach ($rows as $row){
						$i++;
						$link = JRoute::_(ContentHelperRoute::getArticleRoute($row->id, $row->catid));
						if ($i == 1){
						$images = json_decode($row->images);
						if (isset($images->image_intro) and !empty($images->image_intro)) :
						?>
						<a href="<?php echo $link;?>">  
						<img
						<?php if ($images->image_intro_caption):
							echo 'class="caption"'.' title="' .htmlspecialchars($images->image_intro_caption) .'"';
						endif; ?>
						src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>" class="thumnail_view" />
						</a>
						<?php endif; ?>
						<div class="paddingbt4 fontsize13 bold">
					        <a href="<?php echo $link;?>" class="color3"><?php echo $row->title;?></a>
					    </div>
					    <div class="textLeft"><?php echo $row->introtext;?></div>
						<!--  <div style="height:40px;overflow:hidden;" class="clearFix">-->
					    <?php }else{?>
			                <div class="ItemSubCS">             
			                    <a href="<?php echo $link;?>" class="fontsize12 color5"><?php echo $row->title;?></a>                    
			                </div>                
					    <?php }?>
					    <!--  </div>-->
				    <?php }?>
				    <div class="xemtiep">                
				        <a href="<?php echo $link;?>" style="padding-left:13px;float:left;line-height:23px;" class="fontsize12 color2">Xem tiếp »</a>
				        <a style="font-weight:bold;float:left;line-height:23px;padding-left:3px;" class="fontsize12 color11" target="_blank" href="http://tuoitre.vn/RssFeeds.aspx?ChannelID=194">RSS</a>
				    </div>
				</div>
			</div>
		</div>
		<div class="ChannelSample_right"></div>
		<div style="clear: both;"></div>
	</li>
	<?php
}
echo '</ul>';
?>