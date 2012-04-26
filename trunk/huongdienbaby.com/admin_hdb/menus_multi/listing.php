<?
require_once("config_security.php");
require_once("../../classes/database.php");
require_once("../../classes/menu.php");
require_once("../../functions/functions.php");

$position	= getValue("position","int","GET",1);
$menu		= new menu();
$listAll	= $menu->getAllChild("menus_multi","mnu_id","mnu_parent_id","0","mnu_position = " . $position . " AND lang_id = " . $_SESSION["lang_id"],"mnu_id,mnu_name,mnu_link,mnu_target,mnu_order,mnu_position,mnu_parent_id,mnu_has_child,mnu_picture,mnu_picture_hover","mnu_order ASC, mnu_name ASC","mnu_has_child");
?>
<html>
<head>
<title>Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
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
		if (checkblank(formobj.new_title.value)) { alert('Please enter the title!'); return false;}
		
		formobj.submit();
	}
</script>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<? template_top(translate_text("them_moi_category"))?>
<div align="right">
		<table cellpadding="3">
			<tr>
				<td class="textBold"><?=translate_text("filter_menu_position")?></td>
				<td>
				<select name="mnu_position" class="form" onChange="window.location.href='listing.php?position='+this.value">
					<?
					$select = getValue("position");
					foreach($array_type as $value => $key){
						if($key == $select){
							echo "<option value='" . $key . "' selected>" . $value . "</option>";
						}
						else{
							echo "<option value='" . $key . "'>" . $value . "</option>";
						}
					?>
					<? } ?>
				</select>
				</td>
			</tr>
		</table>			
</div>
		<? /*---------Body------------*/ ?>
		<table border="1" cellpadding="3" cellspacing="2" width="100%" style="border-collapse:collapse" bordercolor="#CCCCCC">
			<tr class="textBold" bgcolor="<?=$bgcolor?>"> 
			<td align="center" width="80">Menu name</td>
			<td width="10" align="center">Order</td>
			<td align="center">Target</td>
			<td align="center" nowrap="nowrap">Menu position</td>
			<td align="center"><img src="<?=$fs_imagepath?>edit.png" border="0"></td>
			<td align="center"><img src="<?=$fs_imagepath?>delete.png" border="0"></td>
			</tr>
			<? for($i=0;$i<count($listAll);$i++){ ?>
			<tr <?=$fs_change_bg?>>
			<td nowrap="nowrap" width="50%">
			<?
			for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
				if($listAll[$i]["mnu_link"] != ""){
					echo " <a href='../../home/" . $listAll[$i]["mnu_link"] . "' target='_blank' class='mnu_name'>" . $listAll[$i]["mnu_name"] . "</a>";
				}
				else echo "<font class='mnu_name'>+ <strong>" . $listAll[$i]["mnu_name"] . "</strong></font>";
			?><br><font style="font-family:Tahoma; size:11px; color:#3366CC; font-weight:normal"><?=$listAll[$i]["mnu_link"]?></font>
			<td>
			<?
			for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
				if($listAll[$i]["mnu_has_child"] == 0){
					echo " <b> &bull; " . $listAll[$i]["mnu_order"] . "</b>";
				}
				else{
					echo " <i>&Xi; " . $listAll[$i]["mnu_order"] . "</i>";
				}
			?>
			</td>
			<td align="center">
			<?
			switch($listAll[$i]["mnu_target"]){
				case "_self":
					echo "Current window";
				break;
				case "_blank":
					echo "New window";
				break;
			}
			?>
			</td>
			<td align="center">
			<?
			switch($listAll[$i]["mnu_position"]){
				case 1:
					echo "Top Menu";
				break;
				case 2:
					echo "Left Menu";
				break;
				case 3:
					echo "Right Menu";
				break;
				case 4:
					echo "Bottom Menu";
				break;
			}
			?>
			</td>
			<td align="center"><a class="text" href="edit.php?record_id=<?=$listAll[$i]["mnu_id"]?>&position=<?=$listAll[$i]["mnu_position"]?>&url=<?=base64_encode(getURL())?>"><img src="<?=$fs_imagepath?>icon_edit_data.gif" alt="EDIT" border="0"></a></td>
			<td align="center"><img src="<?=$fs_imagepath?>delete.gif" alt="DELETE" border="0" onClick="if (confirm('Are you sure to delete?')){ window.location.href='delete.php?record_id=<?=$listAll[$i]["mnu_id"]?>&position=<?=$listAll[$i]["mnu_position"]?>&url=<?=base64_encode(getURL())?>'}" style="cursor:pointer"></td>
			</tr>
			<? } ?>
			</table>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>