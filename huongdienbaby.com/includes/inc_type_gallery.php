<?
require_once("../classes/generate_quicksearch.php");
require_once("../functions/pagebreak.php");


$sql 			= '';
$keyword		=	getValue("keyword","str","GET","",1,1);
/*
keyword : tu khoa tim kiem
$keyword_reject: loai bo tu khoa
$search_field : tm trong truong
*/
$keyword		=	getValue("keyword","str","GET","",1,1);
if($keyword !=''){
	$sql .= " AND (gal_name LIKE '%" . str_replace(chr(32),'%',$keyword) . "%' OR gal_description LIKE '%" . str_replace(chr(32),'%',$keyword) . "%') ";
}


$normal_class		= 	"page_picture";
$selected_class	= 	"page_picture_current";

$previous			= '<img align="absmiddle" src="/images/icon_prev.gif" style="margin-right:5px" border="0" /> Trước';
$next					= 'Sau <img align="absmiddle" src="/images/icon_next.gif" style="margin-left:5px" border="0" />';
$first				= "<<";
$last					= ">>";
$break_type			= 2;//"1 => << < 1 2 [3] 4 5 > >>", "2 => < 1 2 [3] 4 5 >", "3 => 1 2 [3] 4 5", "4 => < >"
$current_page 		= 	1;
$page_rewrite		= 0;//$con_mod_rewrite;
$page_space			= 3;
$page_prefix		= "";
$obj_response		= "";
$current_page 		=	1;
$page_size 			=	$con_gallery_page;

if (isset($_GET["page"])) $current_page = $_GET["page"];
$current_page 		=	intval($current_page);
if ($current_page < 1) $current_page=1;
$url		 			=	$lang_path . "type.php?module=gallery&iCat=" . $iCat . "&keyword=" .$keyword;

//bat dau lenh sql
$db_count = new db_query ("SELECT Count(*) AS count
									FROM galleries
									INNER JOIN categories_multi ON (gal_category=cat_id)
									WHERE cat_active=1  AND gal_active=1 " . $sql . $sqlcategory);
									
$row_count 			= mysql_fetch_array($db_count->result);
$total_record 		= $row_count['count'];

$db_count->close();
unset($db_count);

//end get page break params
$db_product	=	new db_query("SELECT *
										FROM galleries
										INNER JOIN categories_multi ON (gal_category=cat_id)
										WHERE cat_active=1  AND gal_active=1 " . $sql . $sqlcategory . "
										ORDER BY gal_order ASC,cat_id ASC,gal_name ASC
										LIMIT " . ($current_page-1) * $page_size . "," . $page_size);
$total = mysql_num_rows($db_product->result);
$title = translate_display_text("album_anh");										
if($row=mysql_fetch_array($db_product->result)){
	$title = $row["cat_name"];
	mysql_data_seek($db_product->result,0);
}
?>
<div class="t_top"><div><?=$title?></div></div>
<div class="t_center">
 <table cellpadding="5" cellspacing="0" width="100%">
	<tbody>
	<?
	$num_col = 4;
	$j=0;
	@mysql_data_seek($db_product->result,0);
	?>
	<?
	if($row = mysql_fetch_array($db_product->result)) $go_next = 1;
	else $go_next = 0;
	while($go_next == 1){
	?>
		<tr>
		<?
		for($i=0;$i<$num_col;$i++){
		?>
			<td valign="top" align="center" width="<?=intval(100/$num_col)?>%">
			<?
			if($go_next == 1){
			 $link_pro = "/gallery/" . $row["gal_picture"];
			 $tooltip  = $row["gal_description"];
			 $tooltip	= str_replace("'","",$tooltip);
			 $tooltip	= str_replace('"','&quot;',$tooltip);
			 $tooltip	= str_replace(chr(13),"<br>",trim($tooltip));
			?>
				<div>
					<div class="gallery"><a href="<?=$link_pro?>" <? if($tooltip!=''){?>onmouseover="showtip('<?=$tooltip?>')" onmouseout="hidetip();" <? }?> class="thickbox noborder" title="<?=htmlspecialchars($row["gal_name"])?>"><img src="/gallery/small_<?=$row["gal_picture"]?>" onError="this.src='<?=($row["gal_type"]==0) ? '/images/nomove.jpg' : '/images/noimage.jpg'?>'" border="0"></a></div>
					<div class="gallery_name"><?=$row["gal_name"]?></div>
				</div>
			<?
			$j++;
			}
			if($row = mysql_fetch_array($db_product->result)) $go_next = 1;
			else $go_next = 0;
			?>
			</td>
		<? 
		}
		?>
		</tr>
	<?
	}
	?>
	</tbody>
 </table>
 <? if($total_record >$page_size){?><div class="page_picture_div"><?=generatePageBar_2($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type, $page_rewrite, $page_space, $obj_response, "page", "")?></div><? }?>
 </div>
<div class="t_bottom"><div>&nbsp;</div></div>


