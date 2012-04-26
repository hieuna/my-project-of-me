<?
require_once(DIR_FS_FUNCTIONS . "template.php");
$iCat=getValue("iCat");
$iSup=getValue("iSup");
$iPri=getValue("iPri");
$module=getValue("module","str","GET","");
$tilte="Danh mục lụa chọn";
$sql='';
$db_category=new db_query("SELECT cat_name,cat_id,cat_type,cat_has_child
									FROM categories_multi
									WHERE  cat_parent_id=" . $iCat . " AND cat_active=1  AND cat_type='PRODUCT'
									ORDER BY cat_order ASC
									");
$db_dongia=new db_query("SELECT pri_min,pri_max,pri_name,cat_name,cat_type,count(*),pri_id
									FROM prices,categories_multi,products
									WHERE cat_active = 1 AND  pri_group=cat_group AND pro_price>=pri_min AND pro_price<=pri_max " . $sql . $sqlcategory . " AND pro_active=1 
									GROUP BY pri_min,pri_max
									");
$db_supplier=new db_query("SELECT sup_name, count(*) AS count,sup_id,cat_type,cat_name
							FROM supplier,products,categories_multi
							WHERE cat_active = 1 AND  pro_supplier=sup_id AND pro_category=cat_id" . $sql . $sqlcategory . " AND cat_active=1 AND pro_active=1 
							GROUP BY sup_id 
							ORDER BY sup_order ASC,sup_name ASC
							");
$total_supplier	=	mysql_num_rows($db_supplier->result);	
$total_dongia		=	mysql_num_rows($db_dongia->result);	
$total_category	=	mysql_num_rows($db_category->result);	
if($total_supplier==0 && $total_category==0 && $total_dongia==0){
	 include("inc_left_menu.php");		
}else{
?>
<?=template_top($tilte,"main","title_trang");?>
<?
if($total_category>0){
?>
<table cellpadding="4" cellspacing="0" width="100%" bgcolor="#efefef">
	<tr>
		<th height="30" align="right" width="15"><img src="/images/4.gif" align="absmiddle" /></th>
		<th class="textBold" align="left">Các danh mục khác</th>
	</tr>
</table>
<table cellpadding="1" cellspacing="0" width="100%">
	<?
	while($row=mysql_fetch_array($db_category->result)){
		$link_pro="/" . strtolower($row["cat_type"]) ."/" . urlencode(preg_replace("|[ -]|Ui","_",$row["cat_name"])) . "-" .  $row["cat_id"] . ".html";
		$count = 0;
		if($row["cat_has_child"]==0){
		//echo "SELECT count(*) AS count FROM products WHERE pro_category = " . $row["cat_id"];
			$db_count = new db_query("SELECT count(*) AS count FROM products WHERE pro_category = " . $row["cat_id"]);
			if($cou = mysql_fetch_array($db_count->result)){
				$count = $cou["count"];
			}
			unset($db_count);
		}
	?>
	<tr>
		<td width="20" class="text">&nbsp;</td>
		<td class="text"><a href="<?=$link_pro?>"><?=$row["cat_name"]?></a><? if(intval($count)>0){?> <font class="textSmall">(<?=$count?>)</font>	<? }?></td>
	</tr>
	<?
	}
	?>
	<tr>
		<td colspan="2" class="text">&nbsp;</td>
	</tr>
</table>
<?
}
?>
<?
}
?>
<?
if($total_supplier>0){
?>
<table cellpadding="4" cellspacing="0" width="100%" bgcolor="#efefef">
	<tr>
		<th height="30" align="right" width="15"><img src="/images/4.gif" align="absmiddle" /></th>
		<th class="textBold" align="left"><a class="textBold" href="/product/cac_hang_san_xuat-0/hsx-0.html"> Các hãng sản xuất</a></th>
	</tr>
</table>
<table cellpadding="2" cellspacing="0" width="100%" border="0">
<?
$num_col = 2;
$j=1;
?>
<?
if($row = mysql_fetch_array($db_supplier->result)) $go_next = 1;
else $go_next = 0;
while($go_next == 1){
?>
	<tr>
		<td>&nbsp;</td>
	<?
	for($i=0;$i<$num_col;$i++){
	?>
		<td valign="top" width="<?=intval(100/$num_col)?>%" class="text">
		<?
		if($go_next == 1){
			$link_pro="/" . strtolower($row["cat_type"]) ."/" . urlencode(preg_replace("|[ -]|Ui","_",RemoveSign($row["sup_name"]))) . "-" .  $iCat . "/hsx-" . $row["sup_id"] . ".html";
		?>
			<a href="<?=$link_pro?>" <? if($iSup==$row["sup_id"]){?>style="color:#FD9E0B; font-weight:bold;"<? }?>><?=$row["sup_name"]?></a> <font class="textSmall">(<?=$row["count"]?>)</font>
		<?
		$j++;
		}
		if($row = mysql_fetch_array($db_supplier->result)) $go_next = 1;
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
</table>
<?
if($total_dongia>0){
?>
<table cellpadding="4" cellspacing="0" width="100%" bgcolor="#efefef">
	<tr>
		<th height="30" align="right" width="15"><img src="/images/4.gif" align="absmiddle" /></th>
		<th class="textBold" align="left"><a class="textBold" href="/product/đơn_giá-0/dongia/0/0.html"> Đơn giá</a></th>
	</tr>
</table>
<table cellpadding="0" cellspacing="5" width="100%" border="0">
      <?
      $num_col = 2;
      $j=1;
      ?>
      <?
      if($row = mysql_fetch_array($db_dongia->result)) $go_next = 1;
      else $go_next = 0;
      while($go_next == 1){
      ?>
         <tr>
				<td>&nbsp;</td>
         <?
         for($i=0;$i<$num_col;$i++){
         ?>
            <td valign="top" width="<?=intval(100/$num_col)?>%" class="text" <? if($iPri==$row["pri_id"]){?> style="color:#FD9E0B; font-weight:bold;"<? }?>>
            <?
            if($go_next == 1){
					$db_count=new db_query("SELECT count(*) AS count FROM products,categories_multi WHERE cat_active = 1 AND  cat_id=pro_category AND pro_active=1 AND pro_price>=" . $row["pri_min"] . " AND pro_price<=" . $row["pri_max"] . $sqlcategory . "");
					$rowc=mysql_fetch_array($db_count->result);
					unset($db_count);
					$link_pro="/" . strtolower($row["cat_type"]) ."/" . urlencode(preg_replace("|[ -]|Ui","_",RemoveSign($row["cat_name"]))) . "-" .  $iCat . "/dongia/" . $row["pri_min"] . "/" . $row["pri_max"] . ".html";
            ?>
					<a href="<?=$link_pro?>" ><?=$row["pri_name"]?></a> <font class="textSmall">(<?=$rowc["count"]?>)</font>				
            <?
            $j++;
            }
            if($row = mysql_fetch_array($db_dongia->result)) $go_next = 1;
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
</table>
<?
}
?>
<?=template_bottom("main")?>
<?
}
?>
<?
unset($db_supplier);
unset($db_dongia);
unset($db_category);
?>
<? include("inc_support_online.php");?>
