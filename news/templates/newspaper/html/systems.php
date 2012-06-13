<?php
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

$id			= JRequest::getInt('id', 0, 'GET');
if ($view == 'section') $where = ' AND cd.sectionid='.$id;
else if ($view == 'category') $where = ' AND cd.catid='.$id;
else if ($view == 'article') {
	$db			= JFactory::getDbo();
	$sql = "SELECT catid FROM #__content WHERE id=".$id;
	$db->setQuery($sql);
	$rowid	=	$db->loadObject();
	$where = ' AND cd.id!='.$id.' AND cd.catid='.$rowid->catid;
}
else $where = '';

$baseurl	= JURI::base();
$db			= JFactory::getDbo();
$sql		= "SELECT cd.id, cd.title, cd.alias, cd.title_alias, cd.catid, cd.sectionid, cd.images, ct.alias AS calias, "
			."\n CASE WHEN CHAR_LENGTH(cd.alias) THEN CONCAT_WS(':', cd.id, cd.alias) ELSE cd.id END as slug, "
			."\n CASE WHEN CHAR_LENGTH(ct.alias) THEN CONCAT_WS(':', ct.id, ct.alias) ELSE ct.id END as catslug "
			."\n FROM #__content AS cd, #__categories AS ct"
			."\n WHERE cd.catid=ct.id"
			."\n AND cd.systems=1"
			.$where
			."\n ORDER BY cd.created DESC, cd.ordering ASC"
			;
$db->setQuery($sql);
$rows		= $db->loadObjectList();
if (count($rows) > 0){
	if ($view == 'frontpage'){
	?>
	<div class="systems" id="tab_systems">
		<ul>
			<?php
			$i = 0; 
			foreach ($rows as $row):
			$link = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catslug, $row->sectionid));
			$i++;
			?>
			<li>
				<a href="<?php echo $link;?>"><img src="<?php echo $baseurl;?>/images/stories/<?php echo $row->images;?>" alt="<?php echo $row->title;?>" /></a>
				<a href="<?php echo $link;?>"><?php echo $row->title;?></a>
			</li>
			<?php
			if($i%6 == 0 && $i>0){
				if ($i == count($rows)) echo '</ul>';
				else echo '</ul><ul>';
			}	 
			endforeach;
			?>
	</div>
	<div class="clearfix"></div>
	<?php
	}else if ($view == 'section' || $view == 'category' || $view == 'article'){
	?>
	<div id="tab_system_customers">
		<div class="tab_system_left">
			<div class="cls wid335 fl" style="background: #0691d7; position: relative;" id="load_system">
				<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($rows[0]->slug, $rows[0]->catslug, $rows[0]->sectionid));?>">
				<img class="full" src="<?php echo $baseurl;?>/images/stories/<?php echo $rows[0]->images;?>" alt="<?php echo $rows[0]->title;?>" />
				</a>
				<div class="show_title_system_main"><?php echo $rows[0]->title;?></div>
			</div>
			<div class="cls wid335 fr" id="tab_slide">
				<ul>
				<?php
				$i = 0;
				foreach ($rows as $row):
				$link = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catslug, $row->sectionid));
				if ($i > 0){
				?>
				<li id="<?php echo $row->id; ?>">
					<div class="item fl">
						<div class="sys_ul_image">
							<a href="<?php echo $link;?>"><img src="<?php echo $baseurl;?>/images/stories/<?php echo $row->images;?>" alt="<?php echo $row->title;?>" /></a>
						</div>
						<a href="<?php echo $link;?>"><?php echo $row->title;?></a>
					</div>
				</li>
				<?php
				}
				if ($i%6 == 0 && $i>0) echo '</ul><ul>';
				$i++; 
				endforeach;
				?>
				</ul>
			</div>
		</div>
		<div class="tab_system_right">
			<div>
			<embed width="300" height="250" align="middle" quality="high" wmode="transparent" allowscriptaccess="always" flashvars="alink1=http%3A%2F%2Flogging.admicro.vn%2F_adc.html%3Fadm_domain%3Dhttp%253A%2F%2Fdantri.com.vn%2F%26adm_campaign%3D1022230%26adm_aditem%3D132333%26adm_zoneid%3D224%26adm_channelid%3D-1%26adm_rehttp%3Dhttp%253A%2F%2Fphimmadagascar3.com.vn%2F%26adm_random%3D0.14842282715897448&amp;atar1=_blank" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" alt="" src="http://admicro2.vcmedia.vn/images/mad3_stnd_mpu_300x250chuan.swf">
			</div>
			<div>
			<embed width="300" height="125" align="middle" quality="high" wmode="transparent" allowscriptaccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" alt="" src="http://admicro2.vcmedia.vn/images/03_hocviennganhang_300x125_3.swf">
			</div>
		</div>
	</div>
	<script>
//	$(document).ready(function(){
//		$('.tab_system_left li').hover(function(){
//			var id = $(this).attr('id');
//			$('#load_system').load("ajax.php?task=load_system&id="+id);
//		});
//	});
	</script>
	<?php	
	} 
}
?>