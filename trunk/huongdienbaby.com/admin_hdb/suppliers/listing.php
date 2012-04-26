<?
require_once("config_security.php");
$sql='';
$keyword=getValue("keyword","str","GET","",1);
if($keyword!='') $sql.=" AND sup_name LIKE '%" . $keyword . "%'";

$db_supplier=new db_query("SELECT * FROM supplier WHERE lang_id=" . $_SESSION["lang_id"] . " " . $sql . " ORDER BY sup_order ASC");
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
<? template_top(translate_text("danh_sach_hang_san_xuat"))?>
		<? /*---------Body------------*/ ?>
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
		<div style="padding:7px;" align="left">
		
			<form action="<?=getURL()?>" method="get">
				<strong><?=translate_text("tim_kiem")?></strong> :&nbsp;
				<input type="text" class="form" name="keyword">
				<input type="submit" value="Tìm" class="form">
			</form>
		</div>
		<table border="1" cellpadding="3" cellspacing="2" width="100%" style="border-collapse:collapse" bordercolor="#CCCCCC">
			<tr class="textBold"> 
			<td width="5"><input type="checkbox" id="check_all" onClick="check('1','1000')"></td>
			<td width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>save.gif" border="0"></td>
			<td align="center"><?=translate_text("name")?></td>
			<td align="center" width="5%"><?=translate_text("order")?></td>
			<td align="center" width="5%">ID</td>
			<td align="center" nowrap="nowrap" width="10"><?=translate_text("active")?></td>
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
				<input type="checkbox" name="record_id[]" id="record_id_<?=$countno?>" value="<?=$row["sup_id"]?>">
			</td>
			<td width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>ed_save.gif" border="0" style="cursor:pointer" onClick=" document.all.record_id_<?=$countno;?>.checked=true ; ValidateForm(form_listing);" alt="Save"></td>
			<td><input type="text" name="sup_name_<?=$row["sup_id"]?>" size="50" id="sup_name_<?=$row["sup_id"]?>" value="<?=$row["sup_name"]?>" class="form"></td>
			<td><input type="text" name="sup_order_<?=$row["sup_id"]?>" id="sup_order_<?=$row["sup_id"]?>" value="<?=$row["sup_order"]?>" style=" width:50px;" class="form"></td>
			<td align="center"><?=$row["sup_id"]?></td>
			<td align="center"><a href="active.php?record_id=<?=$row["sup_id"]?>&type=sup_active&value=<?=abs($row["sup_active"]-1)?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$row["sup_active"];?>.gif" alt="Active!"></a></td>
			<td align="center" width="16"><a class="text" href="edit.php?record_id=<?=$row["sup_id"]?>&returnurl=<?=base64_encode(getURL())?>"><img src="<?=$fs_imagepath?>icon_edit_data.gif" alt="EDIT" border="0"></a></td>
			<td align="center"><img src="<?=$fs_imagepath?>delete.gif" alt="DELETE" border="0" onClick="if (confirm('Are you sure to delete?')){ window.location.href='delete.php?record_id=<?=$row["sup_id"]?>&returnurl=<?=base64_encode(getURL())?>'}" style="cursor:pointer"></td>
			</tr>
			<? } ?>
			</form>
			</table>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>