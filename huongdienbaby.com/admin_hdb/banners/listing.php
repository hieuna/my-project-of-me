<?
/*-- Created by: Mr Toan --*/
require_once("config_security.php");

$sql="";
$iType = getValue("iType","int","GET",0);
$iCat = getValue("iCat","int","GET",0);
if ($iType !=0) $sql.=" AND ban_type=" . $iType;
$sqlbanner = "SELECT * 
					FROM banners
					WHERE banners.lang_id = " . $_SESSION["lang_id"] . $sql . "
					ORDER BY  ban_order DESC";
$db_banner_listing = new db_query($sqlbanner);?>
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
		if (checkblank(formobj.ban_name.value)) { alert('Please enter the banner name!'); return false;}
		formobj.submit();
	}
</script>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>

<? template_top("Danh_sach_quang_cao")?>
		<div class="textBold" style="padding:5px;"> Lựa chọn : 
			<select name="iType" id="iType" onChange="window.location.href='listing.php?iType='+this.value" class="form">
				<option value="0">All banner</option>
				<?
				foreach($array_type as $key=>$value){
				?>
					<option value="<?=$key?>" <? if($iType == $key) echo 'selected';?>><?=$value?></option>
				<?
				}
				?>
			</select>
		</div>
		<? /*---------Body------------*/ ?>
		<table border="1" cellpadding="3" cellspacing="2" width="100%" style="border-collapse:collapse" bordercolor="#CCCCCC">
			<tr> 
				<td width="1%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>no.gif" border="0"></td>
				<td width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>save.gif" border="0"></td>
				<td><img src="<?=$fs_imagepath?>general.gif" border="0"></td>
				<td width="5%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>images.gif" border="0"></td>
				<td align="center" class="textBold">Info</td>
				<td align="center" class="textBold">Xem</td>
				<td align="center"><img src="<?=$fs_imagepath?>active.gif" border="0"></td>
				<td align="center"><img src="<?=$fs_imagepath?>delete.png" border="0"></td>
			</tr>
		<?
		$countno = 0;
		while ($row = mysql_fetch_array($db_banner_listing->result))
		{
		  $countno++;
		?>
		<form action="quickedit.php?iQuick=update&iType=<?=$iType;?>&url=<?=base64_encode(getURL())?>" name="data<?=$row["ban_id"]?>" id="data<?=$row["ban_id"]?>" method="post" enctype="multipart/form-data">
			<tr bgcolor="<? if($row["ban_active"] == 0){ echo "#FFFF00"; }else{ echo "#FFFFFF"; } ?>"> 
			<td align="center" class="textBold"><?=$countno;?></td>
			<td align="center"><img src="<?=$fs_imagepath?>ed_save.gif" border="0" style="cursor:pointer" onClick="ValidateForm(data<?=$row["ban_id"]?>);" alt="Save"></td>
			<td nowrap="nowrap">
			<table border="0" cellpadding="2" cellspacing="0" width="100%">
				<tr>
					<td align="right" class="textBold">Name:</td>
					<td><input type="text" size="30" class="form" name="ban_name" id="ban_name" value="<?=htmlspecialchars($row["ban_name"]);?>"></td>
				</tr>
				<tr>
					<td align="right" class="textBold">Url:</td>
					<td><input type="text" size="40" class="form" name="ban_url" id="ban_url" value="<?=htmlspecialchars($row["ban_url"]);?>"></td>
				</tr>
				<tr>
					<td align="right" nowrap class="textBold">Target:</td>
					<td>
						<?
						reset($mnu_target);
						echo "<select name='ban_target' id='ban_target' class='form'>";
						echo "<option value=''>- Select target -</option>";
						foreach($mnu_target as $key => $value){
							if($value == $row["ban_target"]){
								echo "<option value='" . $value . "' selected>" . $key . "</option>";
							}
							else{
								echo "<option value='" . $value . "'>" . $key . "</option>";
							}
						}
						echo "</select>";
						?>					</td>
				</tr>
				<tr>
					<td nowrap="nowrap" align="right" class="textBold">Image upload:</td>
					<td>
						<input type="file" name="picture" id="picture" class="form" size="20">					</td>
				</tr>
				<tr>
					<td nowrap="nowrap" align="right" class="textBold">Position:</td>
					<td>
						<?
						reset($array_type);
						echo "<select name='ban_type' id='ban_type' class='form'>";
						$pos = getValue("pos","int","GET",$row["ban_type"]);
						foreach($array_type as $key => $value){
							if($key == $pos){
								echo "<option value='" . $key . "' selected>" . $value . "</option>";
							}
							else{
								echo "<option value='" . $key . "'>" . $value . "</option>";
							}
						}
						echo "</select>";
						?>					</td>
				</tr>
				<tr>
					<td nowrap="nowrap" align="right" class="textBold">Order:</td>
					<td><input type="text" size="1" maxlength="5" class="form" name="ban_order" id="ban_order" value="<?=$row["ban_order"];?>"></td>
				</tr>
			</table>			</td>
			<td align="center">
			<div style="overflow:hidden; position:relative; width:200px; height:150px">
			<?
			$path = $fs_filepath . $row["ban_picture"];
			if($row["ban_picture"] != "" && file_exists($path)){
				if(getExtension($row["ban_picture"])=='swf'){
					$flash_size=getimagesize($path);
					if(isset($flash_size[3])) $flash_size=$flash_size[3];
					?>
					<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" <?=$flash_size?>>
                 <param name="movie" value="<?=$path?>">
                 <param name="quality" value="high">
                 <embed src="<?=$path?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" <?=$flash_size?>></embed>
				    </object>
					<?				
				}else{
					?>
						<div style="overflow:hidden; position:relative; width:200px; height:150px">
					<?
					echo "<img src='" . $fs_filepath . $row["ban_picture"] . "' border='0'>";
					?>
						</div>
					<?
				}
			}
			else{
				echo "File does't exists!";
			}
			?>
			</div>
			<?
			if($row["ban_picture"] != ""){
				echo "<a href='delete_picture.php?record_id=" . $row["ban_id"] . "&iType=" . $iType . "&url=" . base64_encode(getURL()) . "' class='text'>[Delete Banner]</a>";
			}
			?></td>
			<td><textarea  class="form" name="ban_description" style="width:100%; height:100%" id="ban_description"><?=$row["ban_description"];?></textarea></td>
			<td align="center"><?=$row["ban_hits"]?></td>
			<td align="center">
				<a href="active.php?record_id=<?=$row["ban_id"]?>&type=ban_active&value=<?=abs($row["ban_active"]-1)?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$row["ban_active"];?>.gif" alt="Active!"></a>			</td>
			<td align="center"><img src="<?=$fs_imagepath?>delete.png" alt="DELETE" border="0" style="cursor:pointer" onClick="if (confirm('Are your sure to delete')){ window.location.href='delete.php?record_id=<?=$row["ban_id"];?>&iType=<?=$iType;?>&url=<?=base64_encode(getURL())?>';}"></td>
			</tr><input type="hidden" name="iQuick" value="update">
			<input type="hidden" name="record_id" value="<?=$row["ban_id"];?>">
			</form>
			<? } ?>
			</table>
<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<? 
$db_banner_listing->close();
unset($db_banner_listing);
?>