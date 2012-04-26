<?
require_once("../functions/template.php");
require_once("../functions/functions.php");
require_once("../classes/database.php");
require_once("../classes/generate_quicksearch.php");
require_once("../functions/pagebreak.php");

$currency = getValue("currency","int","GET",$con_currency);
$iPrice = getValue("iPrice");

$iPri					= getValue("iPri");
$iSup					= getValue("iSup");
$filter					= getValue("filter");
$iCat 					= getValue("iCat");
$keyword 				= getValue("keyword","str","GET","",1,1);
$keyword 				= trim($keyword);
$sql='';
$arraySort				= array(1=>"pro_date DESC",2=>"pro_price ASC",3=>"pro_price DESC",4=>"pro_name ASC",5=>"pro_name DESC");
$arraySortSelect		= array(1=>"Cập nhật mới nhất",2=>"Giá tăng dần",3=>"Giá giảm dần",4=>"Tên sản phẩm A->Z",5=>"Tên sản phẩm Z->A");
$sort					=	getValue("sort");
$currency 				= getValue("currency","int","GET",$con_currency);
$iSup 					= getValue("iSup");
$search_field			= 'pro_search';
$sqlorder				= '';
$fieldor				= "pro_price ASC";
$mysql					=	new generate_quicksearch($keyword,$search_field);
//goi class generate sql fulltext search
if($keyword!='' && $keyword != 'Từ khóa'){
	$sql			.= $mysql->sql_keyword;
}
if(array_key_exists($filter,$arraySort)) $fieldor = $arraySort[$filter];
if($iSup != 0 ) $sql .= " AND sup_id = " . $iSup;
if($iPri !=0 ){
	$db_price = new db_query("SELECT pri_min,pri_max FROM prices WHERE pri_id = " . $iPri);
	if($row=mysql_fetch_array($db_price->result)){
		$sql .= " AND pro_price >= " . $row["pri_min"];
		$sql .= " AND pro_price <= " . $row["pri_max"];
	}
}
$normal_class		= 	"page";
$selected_class	= 	"page_select";

$previous			= 'Trước';
$next					= 'Sau ';
$first				= "<<";
$last					= ">>";
$break_type			= 2;//"1 => << < 1 2 [3] 4 5 > >>", "2 => < 1 2 [3] 4 5 >", "3 => 1 2 [3] 4 5", "4 => < >"
$current_page 		= 	1;
$page_rewrite		= 0;//$con_mod_rewrite;
$page_space			= 3;
$page_prefix		= "";
$obj_response		= "";
$page_size 			= $con_products_page;

if (isset($_GET["page"])) $current_page = $_GET["page"];
$current_page = intval($current_page);
if ($current_page < 1) $current_page=1;
$url		 = $lang_path ."type.php?module=product&iCat=" . $iCat . "&iSup=" . $iSup . "&iPri=" . $iPri . "&filter=" . $filter . "&keyword=" . $keyword;


$db_count = new db_query ("SELECT Count(*) AS count
									FROM products
									INNER JOIN categories_multi ON(pro_category=cat_id)
									WHERE cat_active=1 AND pro_active=1 AND categories_multi.lang_id=" . $lang_id . $sqlcategory . $sql);
$row_count 		= mysql_fetch_array($db_count->result);
$total_record 	= $row_count['count'];
$db_count->close();
unset($db_count);

//end get page break params
$db_product = new db_query("SELECT *
										FROM products
										INNER JOIN categories_multi ON(pro_category=cat_id)
										WHERE cat_active=1 AND pro_active=1 AND categories_multi.lang_id=" . $lang_id . $sqlcategory . $sql . "
										ORDER BY pro_name ASC
										LIMIT " . ($current_page-1) * $page_size . "," . $page_size);
$total_product = mysql_num_rows($db_product->result);
?>
<script language="javascript">
function check_quantity(id){
	window.location.href='<?=$lang_path?>addtocart.php?iData=' + id + '&nQuantity=1&returnurl=<?=base64_encode(getURLR($con_mod_rewrite))?>';
}
</script>
<div class="top_type">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="15">&nbsp;</td>
			<td width="10%" nowrap="nowrap"><?=translate_display_text("chon_san_pham")?>&nbsp;</td>
			<td>&nbsp;
				<select  onchange="window.location.href='<?=$lang_path?>type.php?module=product&iCat=<?=$iCat?>&iPri=<?=$iPri?>&iSup=<?=$iSup?>&filter='+ this.value;">
					<option value="0"><?=translate_display_text("lua_chon")?></option>
					<? foreach($arraySortSelect as $key=>$value){?>
						<option value="<?=$key?>" <? if($filter==$key) echo 'selected';?>><?=$value?></option>
					<? }?>
				</select>
			</td>
			<td>
			<? 
			$order=getValue("order","str","COOKIE","");
			$count_order=explode("|",$order);
			?>
			<a href="<?=$lang_path?>showcart.php"><img src="/images/cart.gif" border="0" align="absmiddle" /> <?=translate_display_text("co")?> <font color="#FF0000"><?=intval(count($count_order)/3)?></font> <?=translate_display_text("san_pham")?></a>
			</td>
			<? if($total_record>$page_size){?><td class="text" align="right">Trang: <?=generatePageBar($page_prefix,$current_page,$page_size,$total_record,$url,$normal_class,$selected_class);?></td><? }?>
			<td width="20">&nbsp;</td>
		</tr>
	</table>
</div>
 <table cellpadding="0" cellspacing="0" width="99%" border="0" style="border-collapse:collapse; margin-left:6px;" bordercolor="#CCCCCC">
	<tbody>
	<?
	$num_col = 4;
	$j=1;
	?>
    <!--<tr><td colspan="<?=$num_col?>" background="/images/bg_top.jpg" style="font-size:1px;" height="8">&nbsp;</td></tr>-->
	<?
	if($row = mysql_fetch_array($db_product->result)) $go_next = 1;
	else $go_next = 0;
	while($go_next == 1){
	?>
        <!--<tr style="background:url(/images/bg_center.jpg)">-->
		<?
		for($i=0;$i<$num_col;$i++){
		?>
			<td valign="top" width="" align="left" class="td_product" style="padding-top:7px;">
							
			<?
			if($go_next == 1){
			 $link_pro	= createLink("detail",array('module'=>$row["cat_type"],"title"=>$row["pro_name"],"iCat"=>$row["cat_id"],"iData"=>$row["pro_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
			 //$tooltip	= tooltip($row["pro_name"],(trim($row["pro_teaser"])!='') ? $row["pro_teaser"] : '',$row["pro_price"],$row["pro_khuyenmai"],$con_currency);
			 $tooltip	= tooltip($row["pro_name"],"<img width='200' src='../pictures_products/" . $row["pro_picture"] . "'>",(trim($row["pro_teaser"])!='') ? $row["pro_teaser"] : '',$row["pro_khuyenmai"],$con_currency);;
			 $strhotnew = '';
			 if($row["pro_new"]==1) $strhotnew .= '<div class="new_hot"><img src="/images/new.gif" border="0"></div><br clear="all">';
			 if($row["pro_sp_khuyenmai"]==1) $strhotnew .= '<div class="new_sales"><img src="/images/sales.png" border="0"></div>';
			?>
				<table cellpadding="0" cellspacing="0">
					<tr height="180">
						<td valign="top">
                        	<!--<div style="width:179px;overflow:hidden; float:left" align="center">-->
							<div style="width:170px;overflow:hidden; float:left" align="center">
								<div style="height:120px; line-height:120px;"><a href="<?=$link_pro?>"  onmouseover="showtip('<?=$tooltip?>')" onmouseout="hidetip();"><img src="/pictures_products/small_<?=$row["pro_picture"]?>" alt="<?=htmlspecialchars($row["pro_name"])?>"  onError="this.src='/images/noimage.jpg'" border="0"></a></div>
								<?=$strhotnew?>
								<div class="product"><a href="<?=$link_pro?>"><?=$row["pro_name"]?></a></div>
								<? if($row["pro_price"] > 0){ ?>
									<div style="color:#5e5e5e; z-index:10"><span style="color:#FF0000; padding-right:7px;"><?=formatNumber($row["pro_price"])?></span><?=$con_currency?></div> 
									<?  } else { ?>
									<div style="color:#FF0000;"> Liên hệ 043-7478341. </div>
									<? } ?>
									
									
							</div>
						</td>
					</tr>
				</table>
			<?
			$j++;
			}
			if($row = mysql_fetch_array($db_product->result)) $go_next = 1;
			else $go_next = 0;
			?>
		<div><hr style="width:100%; border:dashed #CCCCCC; border-width:1px 0 0; height:0"/> </div>
			</td>
		<?
		}
		?>
		</tr>
		<? if($j<=$total_product){?>
            <!--<tr><td colspan="<?=$num_col?>" background="/images/gach_pro.jpg">&nbsp;</td></tr>-->
		<? }?>
	<?
	}
	?>
        <!--<tr><td colspan="<?=$num_col?>" background="/images/bg_buttom.jpg" style="font-size:1px;" height="7">&nbsp;</td></tr>-->
	</tbody>
 </table>
 <? if($total_record>$page_size){?>
 <table cellpadding="3" cellspacing="0" width="100%">
 	<tr>
		<td class="text" align="center">Trang: <?=generatePageBar($page_prefix,$current_page,$page_size,$total_record,$url,$normal_class,$selected_class);?></td>
	</tr>
 </table>
<? }?>
<script language="javascript">
	function sosanh(total){
		var sososanh = 0;
		value='';
		for(i=1;i<=total;i++){
			if(document.getElementById("product_"+i).checked==true){
				sososanh++;
				value +=document.getElementById("product_"+i).value + ',';
			}
		}
		if(sososanh <2 || sososanh >3){
			alert(" Bạn phải chọn ít nhất 2 \r Và nhiều nhất là 3 sản phẩm\r sản phẩm để so sánh");
		}else{
			window.location.href='<?=$lang_path?>so_sanh_san_pham.php?iCat=<?=$iCat?>&list=' + value+'0&url=<?=base64_encode(getURLR())?>';
		}
	}
</script>
