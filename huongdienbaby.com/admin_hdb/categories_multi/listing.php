<?
require_once("config_security.php");
require_once("../../classes/database.php");
require_once("../../functions/functions.php");
require_once("../../classes/menu.php");
$cat_type = getValue("cat_type","str","GET","");
$iCat		 = getValue("iCat");
if($cat_type=="") $cat_type=getValue("cat_type","str","POST","");
$sql="1";
if($cat_type!="")  $sql="cat_type = '" . $cat_type . "'";
$menu = new menu();
$listAll = $menu->getAllChild("categories_multi","cat_id","cat_parent_id",$iCat,$sql . " AND lang_id = " . $_SESSION["lang_id"] . $sqlcategory,"cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child,cat_picture,cat_active,cat_show,cat_group,admin_id,cat_link,cat_left,cat_teaser","cat_order ASC, cat_name ASC","cat_has_child");
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
		document.formobj.submit();
	}
</script>
<script language="javascript" src="../js/library.js"></script>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
			<script language="javascript">
				function delete_all(){
					if (confirm('Bạn có muốn xóa những bài bạn đã chọn không?')){
						document.data.action = "delete.php?returnurl=<?=base64_encode(getURL())?>";
						document.data.submit();
					}
				}
			</script>
<script language="javascript" src="../js/tooltip.js"></script>
<? template_top(translate_text("them_moi_category"))?>
<div align="right">
		<table cellpadding="3">
			<form action="<?=getURL()?>" method="get" name="formsearchcategory">
			<tr>
				<td class="textBold"><?=translate_text("select_type_category")?></td>
				<td>
					<select name="cat_type" class="form" onChange="document.formsearchcategory.submit()">
						<option value=""><?=translate_text("type_category")?></option>
						<?
						foreach($array_value as $key => $value){
						?>
						<option value="<?=$key?>" <? if($key == $cat_type) echo "selected='selected'";?>><?=$value?></option>
						<? } ?>
					</select>
				</td>
				<td class="textBold"><?=translate_text("category")?></td>
				<td>
					<?
					$db_cateogry = new db_query("SELECT cat_type,cat_name,cat_id
															FROM categories_multi
															WHERE cat_parent_id = 0");
					?>
					<select name="iCat" class="form" onChange="document.formsearchcategory.submit()">
						<option value="0">All category</option>
						<?
						while($row = mysql_fetch_array($db_cateogry->result)){
						?>
						<option value="<?=$row["cat_id"]?>" <? if($iCat==$row["cat_id"]) echo 'selected';?>><?=$row["cat_name"]?></option>
						<?
						}
						?>
					</select>
				</td>
			</tr>
			</form>
		</table>			
</div>
		<table border="1" cellpadding="3" cellspacing="2" width="100%" style="border-collapse:collapse" bordercolor="#CCCCCC">
			<tr class="textBold"> 
			<td width="5"><input type="checkbox" id="check_all" onClick="check('1','1000')"></td>
			<td width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>save.gif" border="0"></td>
			<td width="5%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>images.gif" border="0"></td>
			<td align="center" ><?=translate_text("name")?></td>
			<td align="center" nowrap="nowrap"><?=translate_text("group_price")?></td>
			<td width="10" align="center"><?=translate_text("order")?></td>
            <td align="center" nowrap="nowrap" width="5px;">Left</td>
			<td align="center" nowrap="nowrap" width="5px;">Show</td>
			<td align="center" nowrap="nowrap" width="5px;">Active</td>
			<td align="center" width="16"><img src="<?=$fs_imagepath?>edit.png" border="0" width="16"></td>
			<td align="center" width="16"><img src="<?=$fs_imagepath?>delete.gif" border="0"></td>
			</tr>
			<form action="quickedit.php?returnurl=<?=base64_encode(getURL())?>" method="post" name="form_listing" id="form_listing" enctype="multipart/form-data">
			<? $countno=0;?>
			<? for($i=0;$i<count($listAll);$i++){ $countno++;?>
			<?
				$cat_link = '';
				if($listAll[$i]["cat_link"] != '' && strpos($listAll[$i]["cat_link"],"iMnu=") == false){
					$cat_link			= (strpos($listAll[$i]["cat_link"],"?")==false) ? $listAll[$i]["cat_link"] . '?iMnu=' . $listAll[$i]["cat_id"] :  $listAll[$i]["cat_link"] . '&iMnu='  . $listAll[$i]["cat_id"];
					$db_update = new db_execute("UPDATE " . $fs_table ." SET cat_link = '" . $cat_link . "' WHERE cat_id = " . $listAll[$i]["cat_id"]);
					unset($db_update);
				}
			?>
			<tr <?=$fs_change_bg?>>
			<td <? if($listAll[$i]["admin_id"] == $admin_id) echo ' bgcolor="#FFFF66"';?>><input type="checkbox" name="record_id[]" id="record_<?=$listAll[$i]["cat_id"]?>_<?=$countno?>" value="<?=$listAll[$i]["cat_id"]?>">
			<input type="hidden" name="iQuick" value="update">			</td>
			<td width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>ed_save.gif" border="0" style="cursor:pointer" onClick="submitAll('form_listing',<?=$listAll[$i]["cat_id"]?>,<?=$countno?>)" alt="Save"></td>
			<td align="center"><?=$listAll[$i]["cat_link"]?>
				<?
				$path = $fs_filepath . $listAll[$i]["cat_picture"];
				if($listAll[$i]["cat_picture"] != "" && file_exists($path)){
					echo "<img  onmouseover=\"popup('<img src=\'" .  $fs_filepath . $listAll[$i]["cat_picture"] . "\'>','" . $bordercolor . "')\" ;=\"\" onmouseout=\"kill()\" src='" . $fs_filepath . $listAll[$i]["cat_picture"] . "'  style=\"cursor:pointer\" width=120 height=20 border='0'>";
					?><a href="delete_picture.php?record_id=<?=$listAll[$i]["cat_id"]?>&url=<?=base64_encode(getURL())?>" class="text"><img src="../images/deleteimg.gif" border="0" height="20" style="cursor:pointer"></a><?
				}
				?>
				<input type="file" name="picture<?=$listAll[$i]["cat_id"]?>" id="picture<?=$listAll[$i]["cat_id"]?>" class="form" size="10">			</td>
			<td nowrap="nowrap">
			<?
			for($j=0;$j<$listAll[$i]["level"];$j++) echo "--";
			?>
			<input type="text"  name="cat_name<?=$listAll[$i]["cat_id"];?>" id="cat_name<?=$listAll[$i]["cat_id"];?>" onKeyUp="changeCheck(<?=$listAll[$i]["cat_id"]?>,<?=$countno?>)" value="<?=$listAll[$i]["cat_name"];?>" class="form" size="50">
			</td>
			<td>
				<select name="cat_group<?=$listAll[$i]["cat_id"]?>" id="cat_group<?=$listAll[$i]["cat_id"]?>" class="form">
					<option value="0"><?=translate_text("chon_nhom_gia")?></option>
					<?
					foreach($arrayGroup as $key=>$value){
					?>
						<option value="<?=$key?>" <? if($listAll[$i]["cat_group"]==$key) echo 'selected';?>><?=$value?></option>
					<?
					}
					?>
				</select>
			</td>
			<td width="80">
			<?
			for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
				if($listAll[$i]["cat_has_child"] == 0){
					echo ' <b> &bull;</b> <input type="text" name="cat_order' . $listAll[$i]["cat_id"] . '" id="cat_order' . $listAll[$i]["cat_id"] . '" value="' . $listAll[$i]["cat_order"] . '" class="form" size="2">';
				}
				else{
					echo ' <i>&Xi; </i><input type="text" name="cat_order' . $listAll[$i]["cat_id"] . '" id="cat_order' . $listAll[$i]["cat_id"] . '" value="' . $listAll[$i]["cat_order"] . '" class="form" size="2">';
				}
			?>			</td>
            <td align="center"><a href="active.php?record_id=<?=$listAll[$i]["cat_id"]?>&type=cat_left&value=<?=abs($listAll[$i]["cat_left"]-1)?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$listAll[$i]["cat_left"];?>.gif" alt="Active!"></a></td>
			<td align="center"><a href="active.php?record_id=<?=$listAll[$i]["cat_id"]?>&type=cat_show&value=<?=abs($listAll[$i]["cat_show"]-1)?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$listAll[$i]["cat_show"];?>.gif" alt="Active!"></a></td>
			<td align="center"><a href="active.php?record_id=<?=$listAll[$i]["cat_id"]?>&type=cat_active&value=<?=abs($listAll[$i]["cat_active"]-1)?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$listAll[$i]["cat_active"];?>.gif" alt="Active!"></a></td>
			<td align="center" width="16"><a class="text" href="edit.php?record_id=<?=$listAll[$i]["cat_id"]?>&returnurl=<?=base64_encode(getURL())?>"><img src="<?=$fs_imagepath?>edit.gif" alt="EDIT" border="0"></a></td>
			<td align="center"><img src="<?=$fs_imagepath?>delete.gif" alt="DELETE" border="0" onClick="if (confirm('Are you sure to delete?')){ window.location.href='delete.php?record_id=<?=$listAll[$i]["cat_id"]?>&returnurl=<?=base64_encode(getURL())?>'}" style="cursor:pointer"></td>
			</tr>
			<? } ?>
			</form>
			</table>
<? template_bottom() ?>
<script language="javascript" src="../js/library.js"></script>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>