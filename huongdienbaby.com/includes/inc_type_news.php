<?
require_once("../functions/pagebreak.php");
$sql='';
$module = getValue("module","str","GET","",1,1);
$keyword		=	getValue("keyword","str","GET","",1,1);
if($keyword !=''){
	$sql .= " AND (new_title LIKE '%" . str_replace(chr(32),'%',$keyword) . "%' OR new_teaser LIKE '%" . str_replace(chr(32),'%',$keyword) . "%') ";
}
$normal_class			=	"page";
$selected_class		=	"page_current";
$page_prefix 			= 	translate_display_text("trang");
$current_page 			= 	1;
$page_size 				=	intval($con_news_page)+10;
if (isset($_GET["page"])) $current_page = $_GET["page"];
$current_page = intval($current_page);
if ($current_page < 1) $current_page=1;
$url		 = $lang_path . "type.php?module=" . $module . "&iCat=" . $iCat . "&keyword=" . $keyword;

$db_count = new db_query ("SELECT Count(*) AS count
									FROM news,categories_multi
									WHERE cat_id = new_category AND new_approve=1 ". $sqlcategory ." AND cat_active=1 AND cat_type='" . $module . "' " . $sql);
$row_count 		= mysql_fetch_array($db_count->result);
$total_record 	= $row_count['count'];
$db_count->close();
unset($db_count);
$db_type_news = new db_query("SELECT new_title,new_id,cat_id,cat_type,new_teaser,new_date,new_picture,cat_name
											  FROM news,categories_multi
											  WHERE cat_id = new_category AND new_approve=1 ". $sqlcategory ." AND cat_active=1 AND cat_type='" . $module . "' " . $sql . "
											  ORDER BY new_date DESC,new_id DESC
											  LIMIT " . ($current_page-1) * $page_size . "," . $page_size);
?>
<?
$title_news = $arrayType[$module];
if($iCat!=0){
	if($row=mysql_fetch_array($db_type_news->result)){
		$title_news = $row["cat_name"];
		@mysql_data_seek($db_type_news->result,0);
	}
}
if($total_record>0){
?>
<div class="t_top"><div id="detail"><?=$title_news?></div></div>
	<div class="t_center">
	<table cellpadding="5" cellspacing="0" width="100%">
		<tbody>
		<?
		$i=0;
		while(($row=mysql_fetch_array($db_type_news->result)) && $i<$con_news_page){
			$i++;
			$link_detail 	= createLink("detail",array('module'=>$row["cat_type"],"title"=>$row["new_title"],"iCat"=>$row["cat_id"],"iData"=>$row["new_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
		?>
			<?
			$db_relate = new db_query("SELECT new_title,new_id,new_category
												FROM news,relate_news
												WHERE new_id = rel_relate AND rel_id = " . $row["new_id"] . " AND rel_relate <> " . $row["new_id"] . "
												");
			?>
			<tr>
				<td width="100" valign="top"><a href="<?=$link_detail?>" title="<?=htmlspecialchars($row["new_title"])?>"><img src="/pictures/small_<?=$row["new_picture"]?>" onError="this.src='/images/noimage.jpg'" width="120" border="0"></a></td>
				<td valign="top">
					<div class="left_news"><a href="<?=$link_detail?>" title="<?=htmlspecialchars($row["new_title"])?>"><?=$row["new_title"]?></a></div>
					<div style="margin-top:2px; margin-bottom:5px;"><font color="#B00070"><?=date("h:i",$row["new_date"])?></font> | <?=date("d/m/Y",$row["new_date"])?></font></div>
					<div class="description"><?=$row["new_teaser"]?></div>
					<div style="margin-top:3px;">
						<?
						$re=0;
						$total_relate = mysql_num_rows($db_relate->result);
						while($rowr=mysql_fetch_array($db_relate->result)){
							if($re==0) echo '<img src="/images/bullet9.gif" border="0"> ';
							$re++;
							$link_detail 	= createLink("detail",array('module'=>$row["cat_type"],"title"=>$rowr["new_title"],"iCat"=>$rowr["new_category"],"iData"=>$rowr["new_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
						?>
							<a href="<?=$link_detail?>" title="<?=htmlspecialchars($rowr["new_title"])?>" class="relate"><strong><?=$rowr["new_title"]?></strong></a> <?=($re<$total_relate) ? '/' : '';?> 
						<?
						}
						?>
					</div>
				</td>
			</tr>
			<?
			unset($db_relate);
			?>
		<?
		}
		?>
			<?
			if($total_record>$con_news_page){
			?>
			<tr>
				<td colspan="2" style="color:#004593">
					<div class="title_bold"> <?=translate_display_text("cac_bai_viet_khac")?></div>
					<ul class="news_new">
						<?
						while($other=mysql_fetch_array($db_type_news->result)){
							$link_detail 	= createLink("detail",array('module'=>$other["cat_type"],"title"=>$other["new_title"],"iCat"=>$other["cat_id"],"iData"=>$other["new_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
						?>
							<li><a href="<?=$link_detail?>"><?=$other["new_title"]?> <font color="#999999">(<?=date("d/m",$row["new_date"])?>)</font></a></li>
						<?
						}
						?>
					</ul>
				</td>
			</tr>
			<?
			}
			?>
			<?
			if($total_record>$page_size){
			?>
			<tr>
				<td class="<?=$normal_class?>" colspan="2" align="center"><?=generatePageBar($page_prefix,$current_page,$page_size,$total_record,$url,$normal_class,$selected_class,$previous=translate_display_text("truoc"),$next=translate_display_text("tiep"));?></td>
			</tr>
			<?
			}
			?>
		</tbody>
	</table><br>
 	</div>
<div class="t_bottom"><div>&nbsp;</div></div>
<?
}
?>