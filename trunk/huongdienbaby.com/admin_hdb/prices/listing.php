<?
require_once("config_security.php");
require_once("../../classes/database.php");
require_once("../../functions/functions.php");
$sql='';
$iGrp=getValue("iGrp");
$keyword=getValue("keyword","str","GET","",1);
if($keyword!='') $sql.=" AND pri_name LIKE '%" . $keyword . "%'";
if($iGrp!=0) $sql.=" AND pri_group=" . $iGrp;
$db_supplier=new db_query("SELECT * FROM " . $fs_table . " WHERE lang_id=" . $_SESSION["lang_id"] . " " . $sql . " ORDER BY pri_order ASC");
?>
<html>
<head>
<title>Channel Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css">
</head>
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
		formobj.submit();
	}
</script>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? template_top(translate_text("danh_sach_khoang_gia"))?>
			<script language="javascript">
				function check_all(start_loop, end_loop){
					for(i=start_loop; i<=end_loop; i++){
						try{
							eval("document.all.record_id_" + i + ".checked = true");
						}
						catch(e){}
					}
				}
				
				function uncheck_all(start_loop, end_loop){
					for(i=start_loop; i<=end_loop; i++){
						try{
							eval("document.all.record_id_" + i + ".checked = false");
						}
						catch(e){}
					}
				}
				function check(start_loop, end_loop){
					if(document.all.check_all.checked == false){
						uncheck_all(start_loop, end_loop);
					}else{
						check_all(start_loop, end_loop);
					}
				}
				function delete_all(){
					if (confirm('Bạn có muốn xóa những bài bạn đã chọn không?')){
						document.data.action = "delete.php?returnurl=<?=base64_encode(getURL())?>";
						document.data.submit();
					}
				}
			</script>
		<div style="padding:7px;" align="left" class="textBold">
		<?=translate_text("tim_kiem")?> :&nbsp;
			<?
			$iGrp=getValue("iGrp");
			$db_group=new db_query("SELECT * FROM groupprices ORDER BY grp_order ASC,grp_name ASC");
			?>
			<select onChange="window.location.href='listing.php?iGrp='+this.value" class="form">
				<option value="0">Chọn nhóm giá</option>
				<?
				while($rowg=mysql_fetch_array($db_group->result)){
				?>
					<option value="<?=$rowg["grp_id"]?>" <? if($rowg["grp_id"]==$iGrp) echo "selected";?>><?=$rowg["grp_name"]?></option>
				<?
				}
				?>
			</select>
			<?
			unset($db_group);
			?>
		</div>
		<table border="1" cellpadding="3" cellspacing="2" width="100%" style="border-collapse:collapse" bordercolor="#CCCCCC">
			<tr class="textBold"> 
			<td width="5"><input type="checkbox" id="check_all" onClick="check('1','1000')"></td>
			<td width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>save.gif" border="0"></td>
			<td align="center"><?=translate_text("name")?></td>
			<td align="center" width="5%"><?=translate_text("group_prices")?></td>
			<td align="center" width="5%"><?=translate_text("price_from")?></td>
			<td align="center" width="5%"><?=translate_text("price_to")?></td>
			<td align="center" width="5%"><?=translate_text("order")?></td>
			<td align="center" nowrap="nowrap" width="5px;">Active</td>
			<td align="center" width="16"><img src="<?=$fs_imagepath?>edit.png" border="0" width="16"></td>
			<td align="center" width="16"><img src="<?=$fs_imagepath?>delete.png" border="0"></td>
			</tr>
			<form action="quickedit.php?returnurl=<?=base64_encode(getURL())?>" method="post" name="form_listing">
				<input type="hidden" name="iQuick" value="update">
			<? $countno=0;?>
			<? 
			while($row=mysql_fetch_array($db_supplier->result)){
			$countno++;
			?>
			<tr>
			<td>
				<input type="checkbox" name="record_id[]" id="record_id_<?=$countno?>" value="<?=$row["pri_id"]?>">
			</td>
			<td width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>ed_save.gif" border="0" style="cursor:pointer" onClick=" document.all.record_id_<?=$countno;?>.checked=true ; ValidateForm(form_listing);" alt="Save"></td>
			<td><input type="text" name="pri_name_<?=$row["pri_id"]?>" size="50" id="pri_name_<?=$row["pri_id"]?>" value="<?=$row["pri_name"]?>" class="form"></td>
			<td>
					<?
					$db_group=new db_query("SELECT * FROM groupprices ORDER BY grp_order ASC,grp_name ASC");
					?>
					<select name="pri_group_<?=$row["pri_id"]?>" id="pri_group_<?=$row["pri_id"]?>" class="form">
						<option value="0"><?=translate_text("chon_nhom_gia")?></option>
						<?
						while($rowg=mysql_fetch_array($db_group->result)){
						?>
							<option value="<?=$rowg["grp_id"]?>" <? if($rowg["grp_id"]==$row["pri_group"]) echo "selected";?>><?=$rowg["grp_name"]?></option>
						<?
						}
						?>
					</select>
					<?
					unset($db_group);
					?>
			</td>
			<td><input type="text" name="pri_min_<?=$row["pri_id"]?>" id="pri_min_<?=$row["pri_id"]?>" value="<?=$row["pri_min"]?>" style=" width:50px;" class="form"></td>
			<td><input type="text" name="pri_max_<?=$row["pri_id"]?>" id="pri_max_<?=$row["pri_id"]?>" value="<?=$row["pri_max"]?>" style=" width:50px;" class="form"></td>
			<td><input type="text" name="pri_order_<?=$row["pri_id"]?>" id="pri_order_<?=$row["pri_id"]?>" value="<?=$row["pri_order"]?>" style=" width:50px;" class="form"></td>
			<td align="center"><a href="active.php?record_id=<?=$row["pri_id"]?>&type=pri_active&value=<?=abs($row["pri_active"]-1)?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$row["pri_active"];?>.gif" alt="Active!"></a></td>
			<td align="center" width="16"><a class="text" href="edit.php?record_id=<?=$row["pri_id"]?>&returnurl=<?=base64_encode(getURL())?>"><img src="<?=$fs_imagepath?>icon_edit_data.gif" alt="EDIT" border="0"></a></td>
			<td align="center"><img src="<?=$fs_imagepath?>delete.gif" alt="DELETE" border="0" onClick="if (confirm('Are you sure to delete?')){ window.location.href='delete.php?record_id=<?=$row["pri_id"]?>&returnurl=<?=base64_encode(getURL())?>'}" style="cursor:pointer"></td>
			</tr>
			<? } ?>
			</form>
			</table>
<? template_bottom() ?>
</body>
</html>