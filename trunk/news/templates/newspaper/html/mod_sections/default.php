<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<?php
$baseurl = JURI::base();
$db = JFactory::getDbo();

$nows = mktime(0,0,0,date("m"),date("d"),date("Y"));

$sql = $db->getQuery(true);
$query = $db->getQuery(true);

foreach ($list as $item) :
$query = "SELECT id, catid, sectionid, title, alias, title_alias, introtext, images, created FROM #__content WHERE sectionid=".$item->id." AND state=1 ORDER BY created DESC LIMIT 10";
$db->setQuery($query);
$rows = $db->loadObjectList();
?>
<div class="mt2">
	<div class="box4 bgr_menu3 clearfix">
		<ul id="nbm-sub-cat" class="ul2">
			<li class="active"><a href="<?php echo JRoute::_(ContentHelperRoute::getSectionRoute($item->id)); ?>"><?php echo $item->title;?></a></li>
		</ul>
	</div>
		<div class="mt1 clearfix">
			<div class="wid345 fl">
				<?php
				$link_0 = JRoute::_(ContentHelperRoute::getArticleRoute($rows[0]->id."-".$rows[0]->alias, $rows[0]->catid, $rows[0]->sectionid));
				$link_3 = JRoute::_(ContentHelperRoute::getArticleRoute($rows[3]->id."-".$rows[3]->alias, $rows[3]->catid, $rows[3]->sectionid));
				$ngay_nhap_0 = mktime(0,0,0,unFormatdate($rows[0]->created,"m"),unFormatdate($rows[0]->created,"d"),unFormatdate($rows[0]->created,"Y"));
				$ngay_nhap_3 = mktime(0,0,0,unFormatdate($rows[3]->created,"m"),unFormatdate($rows[3]->created,"d"),unFormatdate($rows[3]->created,"Y"));
				$days_0 = ($nows - $ngay_nhap_0)/86400;
				$days_3 = ($nows - $ngay_nhap_3)/86400;
				if ($days_0<1) {
					$addClass_0 = ' newnew';
				}else{
					$addClass_0 = '';
				}
				if ($days_3<1) {
					$addClass_3 = ' newnew';
				}else{
					$addClass_3 = '';
				} 
				?>
				<a href="<?php echo $link_0;?>" class="fon6<?php echo $addClass_0;?>"><?php echo $rows[0]->title;?></a>
				<div class="clr"></div>
				<a href="<?php echo $link_0;?>">
					<?php if ($rows[0]->images != ""):?>
					<img class="img80" title="<?php echo $rows[0]->title;?>" alt="<?php echo $rows[0]->title;?>" src="<?php echo $baseurl;?>images/stories/<?php echo $rows[0]->images;?>" />
					<?php else :?>
					<img class="img80" title="<?php echo $rows[0]->title;?>" alt="Chưa có ảnh" src="<?php echo $baseurl;?>images/no_image.jpg" />
					<?php endif;?>
				</a>
				<div class="fl wid245">
					<div class="fon5 mt0">
					<?php echo catchuoi($rows[0]->introtext, 250);?>
					</div>
				</div>
				<div class="clr"></div>
				<a href="<?php echo $link_3;?>" class="fon6<?php echo $addClass_3;?>"><?php echo $rows[3]->title;?></a>
				<div class="clr"></div>
				<a href="<?php echo $link_3;?>">
					<?php if ($rows[3]->images != ""):?>
					<img class="img80" title="<?php echo $rows[3]->title;?>" alt="<?php echo $rows[3]->title;?>" src="<?php echo $baseurl;?>images/stories/<?php echo $rows[3]->images;?>" />
					<?php else :?>
					<img class="img80" title="<?php echo $rows[3]->title;?>" alt="Chưa có ảnh" src="<?php echo $baseurl;?>images/no_image.jpg" />
					<?php endif;?>
				</a>
				<div class="fl wid245">
					<div class="fon5 mt0">
					<?php echo catchuoi($rows[3]->introtext, 250);?>
					</div>
				</div>
				<div class="clr"></div>
				<ul class="ul3 mt2"> 
				<?php
				$i = 0;
				foreach ($rows as $row):
					$link = JRoute::_(ContentHelperRoute::getArticleRoute($row->id."-".$row->alias, $row->catid, $row->sectionid));
					//Set new link
					$ngay_nhap = mktime(0,0,0,unFormatdate($row->created,"m"),unFormatdate($row->created,"d"),unFormatdate($row->created,"Y"));				
					$days = ($nows - $ngay_nhap)/86400;
					if ($days<1) {
						$addClass2 = ' class="newnew"';
					}else{
						$addClass2 = '';
					} 
					if($i>4):?>
					<li><a<?php echo $addClass2;?> href="<?php echo $link;?>"><?php echo $row->title;?></a></li>
					<?php 
					endif;
				$i++; 
				endforeach;	
				?>
				</ul>
			</div>
			<div class="wid340 fr">
				<?php
				$link_1 = JRoute::_(ContentHelperRoute::getArticleRoute($rows[1]->id."-".$rows[1]->alias, $rows[1]->catid, $rows[1]->sectionid));
				$link_2 = JRoute::_(ContentHelperRoute::getArticleRoute($rows[2]->id."-".$rows[2]->alias, $rows[2]->catid, $rows[2]->sectionid));
				$link_4 = JRoute::_(ContentHelperRoute::getArticleRoute($rows[4]->id."-".$rows[4]->alias, $rows[4]->catid, $rows[4]->sectionid));
				$ngay_nhap_1 = mktime(0,0,0,unFormatdate($rows[1]->created,"m"),unFormatdate($rows[1]->created,"d"),unFormatdate($rows[1]->created,"Y"));
				$ngay_nhap_2 = mktime(0,0,0,unFormatdate($rows[2]->created,"m"),unFormatdate($rows[2]->created,"d"),unFormatdate($rows[2]->created,"Y"));
				$ngay_nhap_4 = mktime(0,0,0,unFormatdate($rows[4]->created,"m"),unFormatdate($rows[4]->created,"d"),unFormatdate($rows[4]->created,"Y"));
				$days_1 = ($nows - $ngay_nhap_1)/86400;
				if ($days_1<1) {
					$addClass_1 = ' newnew';
				}else{
					$addClass_1 = '';
				} 
				$days_2 = ($nows - $ngay_nhap_2)/86400;
				if ($days_2<1) {
					$addClass_2 = ' newnew';
				}else{
					$addClass_2 = '';
				}
				$days_4 = ($nows - $ngay_nhap_4)/86400;
				if ($days_4<1) {
					$addClass_4 = ' newnew';
				}else{
					$addClass_4 = '';
				}  
				?>
				<a href="<?php echo $link_1;?>" class="fon6<?php echo $addClass_1;?>"><?php echo $rows[1]->title;?></a>
				<div class="clr"></div>
				<a href="<?php echo $link_1;?>">
					<?php if ($rows[1]->images != ""):?>
					<img class="img75" title="<?php echo $rows[1]->title;?>" alt="<?php echo $rows[1]->title;?>" src="<?php echo $baseurl;?>images/stories/<?php echo $rows[1]->images;?>" />
					<?php else :?>
					<img class="img75" title="<?php echo $rows[1]->title;?>" alt="Chưa có ảnh" src="<?php echo $baseurl;?>images/no_image.jpg" />
					<?php endif;?>
				</a>
				<div class="fl wid240">
					<div class="fon5 mt0">
					<?php echo catchuoi($rows[1]->introtext, 250);?>
					</div>
				</div>
				<div class="line1"></div>
				<a href="<?php echo $link_2;?>" class="fon6<?php echo $addClass_2;?>"><?php echo $rows[2]->title;?></a>
				<div class="clr"></div>
				<a href="<?php echo $link_2;?>">
					<?php if ($rows[2]->images != ""):?>
					<img class="img75" title="<?php echo $rows[2]->title;?>" alt="<?php echo $rows[2]->title;?>" src="<?php echo $baseurl;?>images/stories/<?php echo $rows[2]->images;?>" />
					<?php else :?>
					<img class="img75" title="<?php echo $rows[2]->title;?>" alt="Chưa có ảnh" src="<?php echo $baseurl;?>images/no_image.jpg" />
					<?php endif;?>
				</a>
				<div class="fl wid240">
					<div class="fon5 mt0">
					<?php echo catchuoi($rows[2]->introtext, 250);?>
					</div>
				</div>
				<div class="line1"></div>
				<a href="<?php echo $link_4;?>" class="fon6<?php echo $addClass_4;?>"><?php echo $rows[4]->title;?></a>
				<div class="clr"></div>
				<a href="<?php echo $link_4;?>">
					<?php if ($rows[4]->images != ""):?>
					<img class="img75" title="<?php echo $rows[4]->title;?>" alt="<?php echo $rows[4]->title;?>" src="<?php echo $baseurl;?>images/stories/<?php echo $rows[4]->images;?>" />
					<?php else :?>
					<img class="img75" title="<?php echo $rows[4]->title;?>" alt="Chưa có ảnh" src="<?php echo $baseurl;?>images/no_image.jpg" />
					<?php endif;?>
				</a>
				<div class="fl wid240">
					<div class="fon5 mt0">
					<?php echo catchuoi($rows[4]->introtext, 250);?>
					</div>
				</div>
			</div>
		</div>
	</ul>
</div>
<?php endforeach; ?>
