<? include("config_security.php"); ?>
<? require_once("../../classes/database.php"); ?>
<? require_once("../../functions/pagebreak.php"); ?>
<? require_once("../../functions/functions.php"); ?>
<? require_once("../../functions/date_function.php"); ?>
<? require_once("../../functions/pagebreak.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Order Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="<?=$fs_stype_css?>" rel="stylesheet" type="text/css">  
</head>
<?
$isAdmin					= 	getValue("isAdmin", "int", "SESSION");
$keyword					= 	getValue("keyword", "str", "GET", "");
$keyword					= 	str_replace("\'","''",$keyword);
$Status						= 	getValue("Status","int","GET");
$startdate					= 	getValue("startdate","str","GET","");
$enddate					= 	getValue("enddate","str","GET","");
$sql						= 	"";

if($startdate != ""){
	$startdate				= 	convertDateTime($startdate,"0:0:0");
	$sql					.= 	" AND ord_date>=" . $startdate;
}
if($enddate != ""){
	$enddate				= 	convertDateTime($enddate,"0:0:0");
	$sql					.= 	" AND ord_date<=" . $enddate;
}
if($Status!=0){
	$sql					.= 	" AND ord_status=" . $Status;
}
if($keyword != "") $sql 	.= 	" ord_code LIKE '%" . $keyword . "%' OR ord_name LIKE '%" . $keyword . "%' ";
//get page break params
$pb_normal_class			=	"textBold";
$pb_selected_class			=	"text";
$pb_page_prefix 			= 	"Page";
$pb_current_page 			= 	1;
if (isset($_GET["page"])) $pb_current_page = $_GET["page"];
$pb_current_page = intval($pb_current_page);
if ($pb_current_page < 1) $pb_current_page=1;
//page size here
$pb_page_size				=	20;
$pb_url 					= 	"listing.php?keyword=" . $keyword . "&Status=" . $Status . "&startdate=" . $startdate . "&enddate=" . $enddate;
$db_count 					= new db_query("SELECT Count(*) AS count
											 FROM orders 
											 WHERE 1 " . $sql);
$row_count = mysql_fetch_array($db_count->result);
$pb_total_record 			= $row_count['count'];
$db_count->close();
unset($db_count);
//end get page break params
$db_admin_listing = new db_query("SELECT * 
								 FROM orders 
								 WHERE 1 " . $sql . "
								 ORDER BY ord_date DESC, ord_id DESC
								 LIMIT " . ($pb_current_page-1) * $pb_page_size . "," . $pb_page_size);
?>
<script language="javascript" src="../js/library.js"></script>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0"  id="mainCP">
<? template_top(translate_text("danh_sach_don_hang"))?>
<table width="100%" border="0" cellpadding="7" cellspacing="0" background="../css/bg_header.gif">
	<tr> 
	  <td align="left" valign="middle" class="textBold"><?=translate_text("ORDER_LISTING")?></td>
	 <form name="search_order" action="listing.php" method="get">
		<td align="right" valign="middle" class="textBold">
		<strong>Từ ngày:</strong>
		<input type="text" name="startdate" id="startdate" value="<?=($startdate!='') ? date("d/m/Y",$startdate) : ''?>" class="form">
		<strong>Đến ngày:</strong>
		<input type="text" name="enddate" id="enddate" class="form" value="<?=($enddate!='') ? date("d/m/Y",$enddate) : ''?>">
		<strong>Trạng thái:</strong> 
		<select name="Status" id="Status" class="form">
			<option value="0">Tất cả</option>
			<?
			foreach($arrayStatus as $key=>$value){
			?>
				<option value="<?=$key?>" <?=($Status==$key) ? 'selected' : ''?>><?=$value?></option>
			<?
			}
			?>
		</select>
		<?=translate_text("tu_khoa")?>: 
		  <input type="text" name="keyword" class="form" value="<?=$keyword?>">
		  <input type="submit" value="<?=translate_text("tim_kiem")?>" class="form">
	 </td>
	 </form>	
	</tr>
  </table>
<table width="100%" border="1" bordercolor="#CCCCCC" style="border-collapse:collapse; background:#F2F2F2" cellpadding="4" cellspacing="1" class="bgTableBorder">
  <tr align="center" valign="middle" bgcolor="#CCCCCC" class="textBold"> 
	<td width="20" class="textBold"><?=translate_text("stt")?></td>
	<td width="30" class="textBold"><?=translate_text("Ten_don_hang")?></td>
	<td width="30" class="textBold">Email</td>
	<td width="30" class="textBold">Phone</td>
	<td width="30" class="textBold"><?=translate_text("dia_chi")?></td>
	<td width="30" class="textBold"><?=translate_text("thoi_gian")?></td>
	<td width="30" class="textBold"><?=translate_text("chi_tiet")?></td>
	<td width="30" class="textBold"><?=translate_text("trang_thai")?></td>
	<td width="40" align="center"><?=translate_text("xoa")?></td>
  </tr>
  <?
  $countno = 0;
  while ($row = mysql_fetch_array($db_admin_listing->result))
  {
	  $countno++;
  ?>
  <tr align="left" valign="middle" <? if ($row["ord_status"] == 1 || $row["ord_status"] == 0){?> bgcolor="#FFFF00" <? } else{?>class="bgTable" <? }?>> 
	<td align="center" class="textBold"><?=$countno;?></td>
	<td align="center" class="text"><?=htmlspecialchars($row['ord_name']);?></td>
	<td align="center" class="text"><?=htmlspecialchars($row['ord_email']);?></td>
	<td align="center" class="text"><?=htmlspecialchars($row['ord_phone']);?></td>
	<td align="center" class="text"><?=htmlspecialchars($row['ord_address']);?></td>
	<td align="right" class="text">
		<div><?=date("d/m/Y", $row['ord_date']);?></div>
		<div style="font-weight:normal; color:#666666"><?=date("H:i A", $row['ord_date']);?></div>
	</td>
	<td align="center" class="textBold"><a href="order_detail.php?record_id=<?=$row['ord_id'];?>"><?=translate_text("chi_tiet")?></a></td>
	<td class="textBold" align="center">
	<select name="ord_status" id="ord_status" class="form" onChange="window.location.href='update.php?record_id=<?=$row["ord_id"]?>&url=<?=base64_encode(getURL())?>&staus='+this.value">
		<?
		foreach($arrayStatus as $key=>$value){
			if($value != ''){
			?>
			<option value="<?=$key?>" <? if($key==$row["ord_status"]) echo 'selected';?>><?=$value?></option>
			<?
			}
		}
		?>
	</select>
	</td>
	<td align="center"><img src="<?=$fs_imagepath?>delete.gif" alt="DELETE" border="0" onClick="if (confirm('<?=translate_text("ban_muon_xoa")?>?')) { window.location.href='delete.php?iOrd=<?=$row['ord_id']?>';}" style="cursor:pointer"></td>
  </tr>
  <?
  }
  ?>
</table>
<div style="padding:10px;"><?=generatePageBar($pb_page_prefix,$pb_current_page,$pb_page_size,$pb_total_record,$pb_url,$pb_normal_class,$pb_selected_class);?></div>
<? template_bottom() ?>
</body>
</html>
<? unset($db_admin_listing);?>