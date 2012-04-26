<?
require_once("config_security.php");

$keyword 	= getValue("keyword","str","GET","",1,1);
$iCha			=	getValue("iCha","int","GET",0);
$iCat			= 	getValue("iCat","int","GET",0);
$filter		=	getValue("filter");
$iSup		=	getValue("iSup");
$searchin	=	getValue("searchin","str","GET","");
$sqlCat		= 	"";

if ($iCat !=0){
	 $menu->getArray("categories_multi","cat_id","cat_parent_id"," cat_type='product' AND lang_id = " . $_SESSION["lang_id"]);
	 $sqlCat.= " AND cat_id IN( " . $menu->getAllChildId($iCat) . " )";
}
if($iSup != 0){
	$sqlCat.= " AND pro_supplier = " . $iSup;
}
switch($filter){
	case 1:
		$sqlCat.= " AND pro_new = 1 ";
	break;
	case 2:
		$sqlCat.= " AND pro_hot = 1 ";
	break;
	case 3:
		$sqlCat.= " AND pro_active = 1 ";
	break;
	
	case 4:
		$sqlCat.= " AND pro_active = 0 ";
	break;
	case 5:
		$sqlCat.= " AND pro_stock = 1 ";
	break;
	case 6:
		$sqlCat.= " AND pro_stock = 0 ";
	break;
	case 7:
		$sqlCat.= " AND pro_sp_khuyenmai = 1 ";
	break;
}
$search_field='pro_search';
//nếu chọn trường tìm kiếm
if(isset($arraySearchIn[$searchin])) $search_field = $searchin;

$mysql	=	new generate_quicksearch($keyword,$search_field);
if($keyword!='') $sqlCat.=$mysql->sql_keyword;
//sort column headers for:
$iSort	= getValue("iSort","str","GET","DESC");
//echo $iSort . "<br>";
if ($iSort = "DESC"){
	//echo $iSort;
	$iSort = "ASC";
	//echo $iSort . "<br>";
}
else{
	$iSort = "DESC";
	//echo $iSort . "<br>";
}
//$data_sort	= "";
//get page break params
$normal_class="break_page";
$selected_class="break_page";
$page_prefix = "Pages:&nbsp;";
$current_page = 1;
if (isset($_GET["page"])) $current_page = $_GET["page"];
$current_page = intval($current_page);
if ($current_page < 1) $current_page=1;
$page_size = 10;
$url = $_SERVER['SCRIPT_NAME'] . "?iCat=" . $iCat . "&iSort=" . $iSort . "&iSup=" . $iSup . "&filter=" . $filter . "&searchin=" . $searchin;

$db_count = new db_query("SELECT Count(*) AS count
								  FROM categories_multi, products
								  WHERE categories_multi.lang_id = " . $_SESSION["lang_id"] . " AND cat_id = pro_category " . $sqlCat . $cat_type . $sqlcategory);
$row_count = mysql_fetch_array($db_count->result);
$total_record = $row_count['count'];
$db_count->close();
unset($db_count);
//end get page break params
//pro_date DESC,cat_id ASC, 
$db_list = new db_query("SELECT *,products.admin_id AS adminid
								 FROM categories_multi, products
								 WHERE categories_multi.lang_id = " . $_SESSION["lang_id"] . " AND cat_id = pro_category " . $sqlCat . $cat_type . $sqlcategory . "
								 ORDER BY pro_date DESC
								 LIMIT " . ($current_page-1) * $page_size . "," . $page_size);
?>
<html>
<head>
<title>Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="<?=$fs_stype_css?>" rel="stylesheet" type="text/css"> 
<script language="javascript">	
	function trim(sString) 
	{
		while (sString.substring(0,1) == ' ')
		{
		sString = sString.substring(1, sString.length);
		}
		while (sString.substring(sString.length-1, sString.length) == ' ')
		{
		sString = sString.substring(0,sString.length-1);
		}
		return sString;
	}
	function checkblank(str)
	{
		if (trim(str)=='')
			return true;
		else
			return false;
	}
	function ValidateForm(formobj)
	{
		if (checkblank(formobj.pro_name.value)) { alert('Please enter the title!'); return false;}
		
		formobj.submit();
	}
</script>
<!-- tinyMCE -->
	</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0"  id="mainCP">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<? template_top(translate_text("danh_sach_san_pham"))?>
		<? /*---------Body------------*/ ?>
		<div style="background:#CCCCCC">
		<table border="0" cellpadding="5" cellspacing="3" align="center" bordercolor="#CCCCCC" style="border-collapse:collapse; margin:5px;">
      	<form action="<?=getURL()?>" method="get" name="timkhohang">
      	<tr>
             <td class="textBold" nowrap="nowrap" align="right">Categories:</td>
             <td>
                 <select name="iCat" id="iCat" class="form" onChange="document.timkhohang.submit()">
							<option value="0">--[<?=translate_text("select_category");?>]--</option>
							<?
							for($i=0;$i<count($listAll);$i++){
								if($listAll[$i]["cat_id"] == $iCat){
							?>
								<option value="<?=$listAll[$i]["cat_id"]?>" selected="selected">
								<?
								for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
									echo "<font color='red'>+ </font>" . $listAll[$i]["cat_name"] . '';
								?>
								</option>
							<? }else{ ?>
								<option value="<?=$listAll[$i]["cat_id"]?>">
								<?
								for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
									echo "<font color='red'>+ </font>" . $listAll[$i]["cat_name"] . '';
								?>
								</option>
							<?
								}
							}
							?>
                 </select>
             </td>
             <?
             $keyword=getValue("keyword","str","GET","");
				 ?>
             <td class="textBold">Từ khóa :</td>
             <td><input type="text" class="form" name="keyword" value="<?=$keyword?>" style="width:120px" /></td>
				 <td class="textBold">Tìm trong : </td>
				 <td>
				 	<select class="form" name="searchin">
						<?
						foreach($arraySearchIn as $key=>$value){
						?>
							<option value="<?=$key?>" <? if($key==$searchin) echo 'selected';?>><?=$value?></option>
						<?
						}
						?>
				 	</select>
				 </td>
				 <td class="textBold">Lọc : </td>
				 <td>
				 	<select class="form" name="filter">
				 		<option value="0">Chọn tất cả</option>
						<?
						foreach($arrayCheck as $key=>$value){
						?>
							<option value="<?=$value?>" <? if($value==$filter) echo 'selected';?>><?=$key?></option>
						<?
						}
						?>
				 	</select>
				 </td>
				 <td class="textBold">Hãng : </td>
				 <td>
				 	<select class="form" name="iSup">
				 		<option value="0">Chọn tất cả</option>
						<?
						foreach($arraySupplier as $key=>$value){
						?>
							<option value="<?=$key?>" <? if($key==$iSup) echo 'selected';?>><?=$value?></option>
						<?
						}
						?>
				 	</select>
				 </td>
             <td><input type="submit" value="Tìm kiếm" class="form" /></td>
         </tr>
         </form>
      </table>
		</div>
		<table border="1" bordercolor="#E5ECF9" cellpadding="3" cellspacing="2" width="100%" style="border-collapse:collapse">
			<? /*---------------Title----------------*/ ?>
			<tr>
				<td width="1%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>no.gif" border="0"></td>
				<td width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>save.gif" border="0"></td>
				<td width="5%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>images.gif" border="0"></td>
				<td><a href="<?=$_SERVER['SCRIPT_NAME']?>?iSort=<?=$iSort;?>"><img src="<?=$fs_imagepath?>general.gif" border="0"></a></td>
				<td width="40%"><img src="<?=$fs_imagepath?>teaser.gif" border="0"></td>
				<td align="center">Kho</td>
				<td align="center"><img src="<?=$fs_imagepath?>hot.gif" border="0"></td>
				<td align="center"><img src="<?=$fs_imagepath?>new.gif" border="0"></td>
				<td align="center"><img src="<?=$fs_imagepath?>active.gif" border="0"></td>
				<td align="center"><img src="<?=$fs_imagepath?>edit.png" border="0"></td>
				<td align="center"><img src="<?=$fs_imagepath?>delete.png" border="0"></td>
			</tr>
			<? /*---------------Listing----------------*/ ?>
			<?
			$countno = ($current_page-1) * $page_size;
			while ($row = mysql_fetch_array($db_list->result)){
				$countno++;
			?>
			<form class="form" method="post" action="quickedit.php?iQuick=update&url=<?=base64_encode(getURL())?>" name="data<?=$row["pro_id"];?>" id="data<?=$row["pro_id"];?>" enctype="multipart/form-data">
			<tr <?=$fs_change_bg?>>
				<td align="center"><?=$countno;?></td>
				<td align="center" <? if($row["adminid"] == $admin_id) echo ' bgcolor="#FFFF66"';?>><img src="<?=$fs_imagepath?>ed_save.gif" border="0" style="cursor:pointer" onClick="ValidateForm(data<?=$row["pro_id"]?>);" alt="Save"></td>
				<td align="center">
				<? if($row["pro_picture"] != ""){ ?>
				<a href="delete_picture.php?record_id=<?=$row["pro_id"]?>&url=<?=base64_encode(getURL())?>" class="text">[Delete picture]</a>
				<? } ?><br>
				<a href="" target="_blank"><img src="<?=$fs_filepath . "small_" . $row["pro_picture"]?>" <? if(file_exists("../../images/noimage.jpg")) echo ' onError="this.src=\'../../images/noimage.jpg\'"';?> height="80" border="0">
				
				</a><br><input type="file" name="picture" id="picture" class="form" size="7">				</td>
				<td>
					<? /*-----------------*/ ?>
					<table border="0" cellpadding="2" cellspacing="1" width="100%">
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("category")?>:</td>
							<td>
							  <select name="pro_category" id="pro_category" class="form">
									<option value="0">--[<?=translate_text("select_category");?>]--</option>
									<?
									for($i=0;$i<count($listAll);$i++){
									?>
										<option value="<?=$listAll[$i]["cat_id"]?>" <? if($listAll[$i]["cat_id"]==$row["pro_category"]) echo 'selected="selected"'?>>
										<?
										for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
											echo "<font color='red'>+ </font>" . $listAll[$i]["cat_name"] . '';
										?>
										</option>
									<?
									}
									?>
							  </select>
							</td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("title")?>:</td>
							<td><input type="text" name="pro_name" id="pro_name" class="form" size="40" maxlength="100" value="<?=htmlspecialchars($row["pro_name"]);?>"></td>
						</tr>
                  <tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("price")?>:</td>
							<td><input type="text" name="pro_price" id="pro_price" class="form" size="20" maxlength="100" value="<?=$row["pro_price"];?>"> (<?=$con_currency?>)</td>
						</tr>
						<? /*
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%">Bảo hành:</td>
							<td><input type="text" name="pro_warranty" id="pro_warranty" class="form" size="30" maxlength="100" value="<?=$row["pro_warranty"];?>"></td>
						</tr>
						*/ ?>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%">Cập nhật :</td>
							<td><input type="text" name="pro_date" id="pro_date" class="form" size="10" value="<?=getShortDate($row["pro_date"]);?>"> <input type="button" class="form" value="Upload nhiều ảnh" style="color:#FF0000; background:#EBE9E9; " onClick="javascript:window.open('picturesproduct.php?temp=<?=$row["pro_id"]?>&action=edit','','resizable=0,WIDTH=500,HEIGHT=350,scrollbars=1')"></td>
						</tr>
					</table>
					<? /*-----------------*/ ?>				</td>
				<td align="center">
				<div align="left"><strong>Khuyến mại</strong>: <input type="text" name="pro_khuyenmai" id="pro_khuyenmai" class="form" size="50" value="<?=$row["pro_khuyenmai"];?>">
				<a href="active.php?type=pro_sp_khuyenmai&value=<?=abs($row["pro_sp_khuyenmai"]-1)?>&record_id=<?=$row["pro_id"]?>&iCat=<?=$iCat?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>check_<?=$row["pro_sp_khuyenmai"];?>.gif" title="Sản phẩm khuyến mại"></a>
				</div>
            <div><textarea name="pro_teaser" id="pro_teaser" class="form" style="width:100%; " rows="5"><?=$row["pro_teaser"]?></textarea></div>
            </td>
				<td align="center"><input type="text" class="form" name="pro_stock" id="pro_stock" value="<?=$row["pro_stock"]?>" style="width:30px;"></td> 
				<td align="center"><a href="active.php?type=pro_hot&value=<?=abs($row["pro_hot"]-1)?>&record_id=<?=$row["pro_id"]?>&iCat=<?=$iCat?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>check_<?=$row["pro_hot"];?>.gif" alt="Uncheck Active hot data!"><? if($row["pro_hot"]==1){?><br><img src="<?=$fs_imagepath?>hot.gif" border="0"><? }?></a></td>
				
				<td align="center"><a href="active.php?type=pro_new&value=<?=abs($row["pro_new"]-1)?>&record_id=<?=$row["pro_id"]?>&iCat=<?=$iCat?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>check_<?=$row["pro_new"];?>.gif" alt="Uncheck Active hot data!"><? if($row["pro_new"]==1){?><br><img src="<?=$fs_imagepath?>new.gif" border="0"><? }?></a></td>
				
				<td><a href="active.php?type=pro_active&value=<?=abs($row["pro_active"]-1)?>&record_id=<?=$row["pro_id"]?>&iCat=<?=$iCat?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>check_<?=$row["pro_active"];?>.gif" alt="Check Active approve data!"><br></a>				</td>
				
				<td align="center"><a href="edit.php?record_id=<?=$row["pro_id"];?>&url=<?=base64_encode(getURL())?>"><img src="<?=$fs_imagepath?>icon_edit_data.gif" alt="EDIT" border="0"></a></td>
				
				<td align="center">
					<img src="<?=$fs_imagepath?>delete.png" alt="DELETE" border="0" onClick="if (confirm('Are you sure to delete the products: <?=str_replace("'","",$row["pro_name"])?> ?')) { window.location.href='delete.php?iCat=<?=$iCat?>&record_id=<?=$row["pro_id"];?>&url=<?=base64_encode(getURL())?>'}" style="cursor:pointer">
					<input type="hidden" name="iQuick" value="update"><input type="hidden" name="record_id" value="<?=$row["pro_id"];?>">			  </td>
			</tr>
			</form>
			<? } ?>
			<tr>
				<td colspan="10">&nbsp;</td>
			</tr>
			<? if($total_record > $page_size){ ?>
			<tr>
				<td colspan="10" align="right" style="padding-right:5px" class="break_page">
			<?=generatePageBar($page_prefix,$current_page,$page_size,$total_record,$url,$normal_class,$selected_class);?>				</td>
			</tr>
			<? } ?>
</table>
		<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<? unset($db_products);?>