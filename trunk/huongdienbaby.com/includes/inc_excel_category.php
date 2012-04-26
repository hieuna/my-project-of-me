<?
$tilte="Danh mục";
$arrayFieldCheck	=	array(1=>"Tên sản phẩm",64=>"Khuyến mại",2=>"Thông tin tóm tắt",4=>"Giá",8=>"Bảo hành",16=>"Kho hàng");
$showField			= getValue("showField","arr","POST","");
$listField			=0;
if(isset($showField[0])){
	for($i=0;$i<count($showField);$i++){
		$listField=$listField+intval(str_decode($showField[$i]));
	}
}else{
	$listField			=15;
}

$module=strtoupper(getValue("module","str","GET","product",1));
$action=getValue("action","str","POST","");
//if($module=="STATIC") $module="PRODUCT";
$module="PRODUCT";
$db_menu_cha=new db_query("SELECT cat_type,cat_name,cat_id
									FROM categories_multi
									WHERE cat_type='product' AND lang_id=" . $lang_id . " AND cat_parent_id=0 
									ORDER BY cat_order ASC,cat_name ASC");
$total_record = mysql_num_rows($db_menu_cha->result);
require_once("../classes/menu.php");
$menuid 				= new menu();
$menuid->getArray("categories_multi","cat_id","cat_parent_id"," lang_id = " . $lang_id);

?>
<div style="padding:4px"></div>
<div class="tem_top"><div onclick="javascript:show_left_menu(9999999999)" style="cursor:pointer"><?=translate_display_text("hien_thi_bang_lua_chon")?></div></div>
	<div align="left" <? if($action!=''){?> style="display:none"<? }?> id="left_menu_9999999999">
	<form action="<?=$lang_path?>baogia.php" method="post" name="baogiaexcel" style="padding-top:0px; margin:0px">
	<input type="hidden" name="action" value="view" />
	<table cellpadding="4" cellspacing="0">
		<tr>
			<td align="center" class="textBold" >Hiển thị : </td>
			<? 
			foreach($arrayFieldCheck as $key=>$value){?>
			<td align="center" class="textBold"><input type="checkbox" name="showField[]" value="<?=str_encode($key)?>" <? if(($key & $listField) !=0) echo "checked";?> /> <?=$value?></td>
			<? 
			}
			?>
		</tr>
	</table>
	<?
	$i = 0;
	while ($row = mysql_fetch_array($db_menu_cha->result)) {
		$listiCat		=  $menuid->getAllChildId($row["cat_id"]);
		$i++;
		
		// Link for menu root
		$link_root = createLink("type",array('module'=>$row["cat_type"],"title"=>$row["cat_name"],"iCat"=>$row["cat_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);	
		// Select menu sub
		$db_sub_menu = new db_query ("SELECT cat_type,cat_name,cat_id
												FROM categories_multi
												
												WHERE cat_type = '" . $module . "' AND categories_multi.lang_id = " . $lang_id . " AND cat_id IN(" . $listiCat . ")
												ORDER BY cat_order ASC,cat_name ASC");
		$href = (mysql_num_rows($db_sub_menu->result) > 0) ? "javascript:show_left_menu(" . $row["cat_id"] . ")" : $link_root;
	?>
		<a class="left_menu_0" href="<?=$href?>"<? if($i == 1) echo ' style="border-top:none"';?>><input type="checkbox" id="check_<?=$row["cat_id"]?>" onClick="check_all(1,<?=mysql_num_rows($db_sub_menu->result)?>,<?=$row["cat_id"]?>); <?="javascript:show_left_menu(" . $row["cat_id"] . ")"?>" name="listid[]" value="<?=$row["cat_id"]?>" /> <?=$row["cat_name"]?></a>
		<?
		if (mysql_num_rows($db_sub_menu->result) > 0) {
		?>
			<div id="left_menu_<?=$row["cat_id"]?>" style="display:none">
			<?
			$k=0;
			while($sub = mysql_fetch_array($db_sub_menu->result)){
				$k++;
			?>
				<div class="left_menu_1"> <input type="checkbox" name="listid[]" id="record_<?=$row["cat_id"]?>_<?=$k?>" value="<?=$sub["cat_id"]?>" /><?=$sub["cat_name"]?></div>
			<?
			}
			?>
			<div align="center"><input type="button" class="buttom" onclick="document.baogiaexcel.submit();" value="Xem báo giá" />&nbsp;</div>
			</div>
		<?
		}
		unset($db_sub_menu);
		?>
	<?
	}
	?>
<script language="javascript">
function show_left_menu(id){
	object = document.getElementById("left_menu_" + id);
	if (object != undefined) {
		if (object.style.display == "none") {
			object.style.display = "block";
		}
		else {
			object.style.display = "none";
		}
	}
	else alert("object not found !");
}
</script>
<script language="javascript">
function check_all(start_loop, end_loop,cat_id){
	if(document.getElementById("check_"+cat_id).checked==true){
		for(i=start_loop; i<=end_loop; i++){
			try{
				document.getElementById("record_"+cat_id+"_" + i).checked = true
			}
			catch(e){};
		}
	}else{
		for(i=start_loop; i<=end_loop; i++){
			try{
				document.getElementById("record_"+cat_id+"_" + i).checked = false;
			}
			catch(e){}
		}
	}
}
var arrayProductId=new Array();
var arrayCategoryId=new Array();
</script>
</form>
<?
$db_menu_cha->close();
unset($db_menu_cha);
?>
</div>