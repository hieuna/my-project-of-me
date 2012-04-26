<?
//Created by: Mr Toan
require_once("config_security.php");
require_once("../../classes/database.php");
require_once("../../classes/generate_quicksearch.php");
require_once("../../functions/functions.php");
require_once("../../functions/pagebreak.php");
$module		=	getValue("module","str","GET","",1);
$keyword		=	getValue("keyword","str","GET","",1,1);
$export		=	getValue("export");
$sort			=	getValue("sort");
$iCat			=	getValue("iCat");
$typesort	=	getValue("typesort");
$searchin	=	getValue("searchin","str","GET","");
$filter		=	getValue("filter");
$sqlsort		=	'';
$sql			=	'';
$sqlCat		= 	"";
if ($iCat !=0) $sqlCat.= " AND cat_id = " . $iCat . " ";
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
	case 7:
		$sqlCat.= " AND pro_khuyenmai = 1 ";
	break;
}
$sql .= $sqlCat;
/*
keyword : từ khóa tìm kiếm
$keyword_reject: loại bỏ từ khóa
$search_field : tìm trong trường
*/
$search_field='pro_search';
//nếu chọn trường tìm kiếm
if(isset($arraySearchIn[$searchin])) $search_field = $searchin;

$mysql	=	new generate_quicksearch($keyword,$search_field);
if($keyword!='') $sql.=$mysql->sql_keyword;

//----Select data
//get page break params
$normal_class="break_page";
$selected_class="break_page";
$page_prefix = "Pages:&nbsp;";
$current_page = 1;
if (isset($_GET["page"])) $current_page = $_GET["page"];
$current_page = intval($current_page);
if ($current_page < 1) $current_page=1;
$page_size = 50;
$url = $_SERVER['SCRIPT_NAME'] . "?iCat=" . $iCat . "&keyword=" . $keyword . "&sort=" . $sort . "&typesort=" . $typesort;

$db_count = new db_query("SELECT Count(*) AS count
								FROM products,categories_multi
								 WHERE cat_id=pro_category  "  . $sql . $sqlcategory . "");
$row_count = mysql_fetch_array($db_count->result);
$total_record = $row_count['count'];
$db_count->close();
unset($db_count);
//end get page break params
//pro_date DESC,cat_id ASC,

$db_data = new db_query("SELECT products.admin_id AS adminid,products.*,cat_id,cat_name
								 FROM products,categories_multi
								 WHERE cat_id=pro_category  "  . $sql . $sqlcategory . "
								 ORDER BY cat_order ASC,cat_id DESC ,pro_date ASC
								 LIMIT " . ($current_page-1) * $page_size . "," . $page_size);
$proName = "...";
if(mysql_num_rows($db_data->result) > 0){
	$row = mysql_fetch_array($db_data->result);
	$proName = $row["pro_name"];
	mysql_data_seek($db_data->result,0);
}
$keyword = getValue("keyword","str","GET","",1,1);
$keyword = trim($keyword);
$keyword=str_replace('\&quot;','&quot;',$keyword);
$disable='';
$disable='';
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
<script language="javascript">
function check_all(start_loop, end_loop,cat_id){
	if(document.getElementById("check_"+cat_id).checked==true){
		for(i=start_loop; i<=end_loop; i++){
			try{
				document.getElementById("record_"+cat_id+"_" + i).checked = true
				document.getElementById("tr_"+cat_id+"_" + i).style.background='#FFFF99';
			}
			catch(e){}
		}
	}else{
		for(i=start_loop; i<=end_loop; i++){
			try{
				document.getElementById("record_"+cat_id+"_" + i).checked = false;
				document.getElementById("tr_"+cat_id+"_" + i).style.background='#FFFFFF';
			}
			catch(e){}
		}
	}
}
var arrayProductId=new Array();
var arrayCategoryId=new Array();
</script>
<? template_top(translate_text("bang_cap_nhat_gia"))?>
		<? include("import.php");?>
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
									echo "<font color='red'>+ </font>" . $listAll[$i]["cat_name"] . ' ' . $listAll[$i]["count"] . '';
								?>
								</option>
							<? }else{ ?>
								<option value="<?=$listAll[$i]["cat_id"]?>">
								<?
								for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
									echo "<font color='red'>+ </font>" . $listAll[$i]["cat_name"] . ' ' . $listAll[$i]["count"] . '';
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
             <td><input type="submit" value="Tìm kiếm" class="form" /></td>
         </tr>
         </form>
      </table>
		</div>
		<table border="1" cellpadding="1" cellspacing="0" width="100%" align="center" bordercolor="#CCCCCC" style="border-collapse:collapse">
      	<form action="updateprice.php" method="post" name="form_type">
         <input type="hidden"  name="returnurl" value="<?=getURL()?>"  />
         <input type="hidden" name="iQuick" value="update" />
			<tr class="textBold" bgcolor="#D8D8D8" height="25">
            	<td width="25" align="center">STT</td>
               <td width="25" align="center"><input type="checkbox"onclick="chontatca()" id="all_select" <?=$disable?> /></td>
                <td width="50%">Sản phẩm</td>
                <td align="center" width="135">Giá</td>
					 <td align="center" width="135">kho</td>
						<td align="center"><img src="<?=$fs_imagepath?>hot.gif" border="0"></td>
						<td align="center"><img src="<?=$fs_imagepath?>new.gif" border="0"></td>
						<td align="center" width="135">Khuyến mại</td>
						<td align="center"><img src="<?=$fs_imagepath?>active.gif" border="0"></td>
						<td align="center"><img src="<?=$fs_imagepath?>edit.png" border="0"></td>
                <td width="40" align="center">Cập nhật</td>
           </tr>
		<? 
		$stt=0;
		$cat_id=-1;
		$j=1;
		$totalrecord=mysql_num_rows($db_data->result);
		$date=getValue("date");
		$today=getdate();
		$today=$today[0];
		$today=$today-$date;
		$totaltondau=0;
		$totaldaban=0;
		$totaldamua=0;
		while($row = mysql_fetch_array($db_data->result)){ 
			//lay tong nhap
			$count_nhap=0;
			$sqlnhap='';
			//lay tong ban
			$count_ban=0;
			$sqlban='';
			//tinh ton kho
			$stt++;
		?>
      	<?
         if($cat_id!=$row["cat_id"]){
				$cat_id=$row["cat_id"];
			?>
        	<tr height="25" bgcolor="#FFFF99"	>
         	<td colspan="3" bgcolor="#F2F2F2"><input type="checkbox" tabindex="<?=$totalrecord+$j-1?>" <?=$disable?>  onclick="check_all(1,<?=$totalrecord?>,<?=$row["cat_id"]?>)" id="check_<?=$row["cat_id"]?>" />&nbsp;&nbsp;<b><?=$row["cat_name"]?></b></td>
				<td class="textBold" align="center">Giá</td>
				<td class="textBold" align="center">Kho</td>
				<td align="center"><img src="<?=$fs_imagepath?>hot.gif" border="0"></td>
				<td align="center"><img src="<?=$fs_imagepath?>new.gif" border="0"></td>
				<td class="textBold" align="center">khuyến mại</td>
				<td align="center"><img src="<?=$fs_imagepath?>active.gif" border="0"></td>
				<td align="center"><img src="<?=$fs_imagepath?>edit.png" border="0"></td>
         </tr>
         <?
         }
			?>
        	<tr id="tr_<?=$row["cat_id"]?>_<?=$j?>" <?=$fs_change_bg?>>
            	<td align="center"><?=$stt?><script language="javascript">arrayProductId[<?=$j-1?>]='record_<?=$row["cat_id"]?>_<?=$j?>'; arrayCategoryId[<?=$j-1?>]='check_<?=$row["cat_id"]?>';</script></td>
               <td width="25" align="center" <? if($row["adminid"] == $admin_id) echo ' bgcolor="#FFFF66"';?>><input type="checkbox" <?=$disable?>  tabindex="<?=$totalrecord+$j?>" name="record_id[]" id="record_<?=$row["cat_id"]?>_<?=$j?>" value="<?=$row["pro_id"]?>" /></td>
                <td style="padding-left:3px;"><?=$row["pro_name"]?></td>
                <td align="center"><input type="text" <?=$disable?> class="form" style="width:130px; color:#FF0000" name="pro_price_<?=$row["pro_id"]?>" id="pro_price" onkeyup="document.getElementById('record_<?=$row["cat_id"]?>_<?=$j?>').checked = true; document.getElementById('tr_<?=$row["cat_id"]?>_<?=$j?>').style.background='#FFFF99'" value="<?=$row["pro_price"]?>" /></td>
					  <td align="center"><input type="text" <?=$disable?> class="form" style="width:40px; color:#FF0000" name="pro_stock_<?=$row["pro_id"]?>" id="pro_stock" onkeyup="document.getElementById('record_<?=$row["cat_id"]?>_<?=$j?>').checked = true; document.getElementById('tr_<?=$row["cat_id"]?>_<?=$j?>').style.background='#FFFF99'" value="<?=$row["pro_stock"]?>" /></td>	
						<td align="center"><a tabindex="1" href="active.php?type=pro_hot&value=<?=abs($row["pro_hot"]-1)?>&record_id=<?=$row["pro_id"]?>&iCat=<?=$iCat?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$row["pro_hot"];?>.gif" alt="Uncheck Active hot data!"></a></td>
						<td align="center"><a tabindex="1" href="active.php?type=pro_new&value=<?=abs($row["pro_new"]-1)?>&record_id=<?=$row["pro_id"]?>&iCat=<?=$iCat?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$row["pro_new"];?>.gif" alt="Uncheck Active hot data!"></a></td>
						<td align="center"><input type="text" <?=$disable?> class="form" style="width:250px; color:#FF0000" name="pro_khuyenmai_<?=$row["pro_id"]?>" id="pro_khuyenmai" onkeyup="document.getElementById('record_<?=$row["cat_id"]?>_<?=$j?>').checked = true; document.getElementById('tr_<?=$row["cat_id"]?>_<?=$j?>').style.background='#FFFF99'" value="<?=$row["pro_khuyenmai"]?>" /></td>
						<td align="center"><a tabindex="1" href="active.php?type=pro_active&value=<?=abs($row["pro_active"]-1)?>&record_id=<?=$row["pro_id"]?>&iCat=<?=$iCat?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$row["pro_active"];?>.gif" alt="Check Active approve data!"></a></td>
						<td align="center"><a tabindex="1" href="edit.php?record_id=<?=$row["pro_id"];?>&url=<?=base64_encode(getURL())?>"><img src="<?=$fs_imagepath?>icon_edit_data.gif" alt="EDIT" border="0"></a></td>
                <td align="center"><img src="<?=$fs_imagepath?>save.gif" alt="Lưu sửa đổi"  border="0" style="cursor:pointer" onclick="document.form_type.submit();"></td>
           </tr>
        <? 
		  $j++;
		  } ?>
        	<tr><td colspan="6" height="25" align="center"><input type="submit" <?=$disable?>  class="form" value="Update" ></td></tr>
         </form>
		</table>
		<table width="100%">
			<? if($total_record > $page_size){ ?>
			<tr>
				<td align="right" style="padding-right:5px" class="break_page">
				<?=generatePageBar($page_prefix,$current_page,$page_size,$total_record,$url,$normal_class,$selected_class);?>				</td>
			</tr>
			<? } ?>
		</table>
		<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<script language="javascript">
function chontatca(){
	if(document.getElementById("all_select").checked==true){
		for(i=0;i<arrayProductId.length;i++){
			document.getElementById(arrayProductId[i]).checked = true;
			document.getElementById(arrayCategoryId[i]).checked = true;
		}
	}else{
		for(i=0;i<arrayProductId.length;i++){
			document.getElementById(arrayProductId[i]).checked = false;
			document.getElementById(arrayCategoryId[i]).checked = false;
		}
	}
} 
</script>
<?
$db_data->close();
unset($db_data);
?>