<?
require_once("config_security.php");

$iCat			= 	getValue("iCat","int","GET",0);
$type = getValue("type","int","GET",0);
$sqlCat		= 	"";
if ($iCat !=0) $sqlCat.= " AND cat_id = " . $iCat . " ";
if ($type !=0) $sqlCat.= " AND gal_type = " . $type . " ";
//get page break params
$normal_class			=	"break_page";
$selected_class		=	"break_page";
$page_prefix 			= "Pages:&nbsp;";
$current_page 			= 1;
if (isset($_GET["page"])) $current_page = $_GET["page"];
$current_page = intval($current_page);
if ($current_page < 1) $current_page=1;
$page_size = 20;
$url 						= $_SERVER['SCRIPT_NAME'] . "?iCat=" . $iCat;

$db_count = new db_query("SELECT Count(*) AS count
								  FROM categories_multi, " . $fs_table . "
								  WHERE categories_multi.lang_id = " . $_SESSION["lang_id"] . " AND cat_id = gal_category " . $sqlCat  . $sqlcategory);
$row_count = mysql_fetch_array($db_count->result);
$total_record = $row_count['count'];
$db_count->close();
unset($db_count);
//end get page break params
//gal_date DESC,cat_id ASC, 
$db_list = new db_query("SELECT *," . $fs_table . ".admin_id AS adminid
								 FROM categories_multi, " . $fs_table . "
								 WHERE categories_multi.lang_id = " . $_SESSION["lang_id"] . " AND cat_id = gal_category " . $sqlCat  . $sqlcategory . "
								 ORDER BY gal_order DESC,gal_date DESC
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
		if (checkblank(formobj.gal_name.value)) { alert('Please enter the title!'); return false;}
		
		formobj.submit();
	}
</script>
<!-- tinyMCE -->
	</head>

<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0"  id="mainCP">
<script language="javascript" src="../js/tooltip.js"></script>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<? template_top(translate_text("danh_sach_san_pham"))?>
		<? /*---------Body------------*/ ?>
		<table border="0" cellpadding="2" cellspacing="1" align="right">
			<tr>
				<?
				$iCat = getValue("iCat","int","GET",0);
				$type = getValue("type","int","GET",0);
				if(count($arrayType)>0){
				?>
				<td class="textBold" nowrap="nowrap" align="right"><?=translate_text("filter_type")?>:</td>
				<td>
					<select onChange="window.location.href='<?=$_SERVER['SCRIPT_NAME']?>?iCat=<?=$iCat?>&type='+this.value" class="form">
						<option value="0" <?=($type==0) ? ' selected="selected"' : ''?>>--[<?=translate_text("tat_ca")?>]--</option>
						<?
						foreach($arrayType as $key=>$value){
						?>
						<option value="<?=$key?>" <?=($type==$key) ? ' selected="selected"' : ''?>>--[<?=$value?>]--</option>
						<?
						}
						?>
					</select>
				</td>
				<?
				}
				?>
				<td class="textBold" nowrap="nowrap" align="right"><?=translate_text("filter_category")?>:</td>
				<td>
					<select onChange="window.location.href='<?=$_SERVER['SCRIPT_NAME']?>?type=<?=$type?>&iCat='+this.value" class="form">
						<option value="">--[<?=translate_text("select_category")?>]--</option>
						<?
						
						for($i=0;$i<count($listAll);$i++){
							$db_counts = new db_query("SELECT count(*) as gal_count FROM " . $fs_table . " WHERE lang_id = " . $_SESSION["lang_id"] . " AND gal_category = " . $listAll[$i]["cat_id"]);
							$row_temps = mysql_fetch_array($db_counts->result);
							unset($db_counts);
						?>
							<option value="<?=$listAll[$i]["cat_id"]?>" <? if($iCat==$listAll[$i]["cat_id"]) echo 'selected="selected"';?>>
							<?
							for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
								echo "<font color='red'>+ </font>" . $listAll[$i]["cat_name"] . ' (' . $row_temps["gal_count"] . ')';
							?>
							</option>
					
						<?
						}
						?>
					</select>
				</td>
				<td>&nbsp;</td>
			</tr>
		</table><br clear="all">
		<table border="1" bordercolor="#E5ECF9" cellpadding="3" cellspacing="2" width="100%" style="border-collapse:collapse">
			<? /*---------------Title----------------*/ ?>
			<tr>
				<td width="1%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>no.gif" border="0"></td>
				<td width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>save.gif" border="0"></td>
				<td width="5%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>images.gif" border="0"></td>
				<td><img src="<?=$fs_imagepath?>general.gif" border="0"></td>
				<td width="40%"><img src="<?=$fs_imagepath?>teaser.gif" border="0"></td>
				<td align="center"><img src="<?=$fs_imagepath?>hot.gif" border="0"></td>
				<td align="center"><img src="<?=$fs_imagepath?>new.gif" border="0"></td>
				<td class="textBold"><?=translate_text("order")?></td>
				<td align="center"><img src="<?=$fs_imagepath?>delete.png" border="0"></td>
			</tr>
			<? /*---------------Listing----------------*/ ?>
			<?
			$countno = ($current_page-1) * $page_size;
			while ($row = mysql_fetch_array($db_list->result)){
				$countno++;
			?>
			<form class="form" method="post" action="quickedit.php?iQuick=update&url=<?=base64_encode(getURL())?>" name="data<?=$row["gal_id"];?>" id="data<?=$row["gal_id"];?>" enctype="multipart/form-data">
			<tr <?=$fs_change_bg?>>
				<td align="center"><?=$countno;?></td>
				<td align="center" <? if($row["adminid"] == $admin_id) echo ' bgcolor="#FFFF66"';?>><img src="<?=$fs_imagepath?>ed_save.gif" border="0" style="cursor:pointer" onClick="ValidateForm(data<?=$row["gal_id"]?>);" alt="Save"></td>
				<td align="center">
				<?
				
				$path = $fs_filepath . 'small_' . $row["gal_picture"];
				if($row["gal_picture"] != "" && file_exists($path)){
					echo "<img  onmouseover=\"popup('<img src=\'" .  $fs_filepath . 'medium_' .  $row["gal_picture"] . "\'>','" . $bordercolor . "')\" ;=\"\" onmouseout=\"kill()\" src='" . $fs_filepath . 'small_' . $row["gal_picture"] . "'  style=\"cursor:pointer\" width=50 height=50 border='0'>";
				}
				?>
				</td>
				<td valign="top">
					<? /*-----------------*/ ?>
					<table border="0" cellpadding="2" cellspacing="1" width="100%">
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("title")?>:</td>
							<td><input type="text" name="gal_name" id="gal_name" class="form" size="40" maxlength="255" value="<?=$row["gal_name"];?>"></td>
						</tr>
                  <tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("image")?>:</td>
							<td><input type="file" name="picture" id="picture" class="form"></td>
						</tr>
					</table>
					<? /*-----------------*/ ?>				</td>
				<td align="center">
            <div><textarea name="gal_description" id="gal_description" class="form" style="width:100%; " rows="3"><?=$row["gal_description"]?></textarea></div>
            </td>
				<td><a href="active.php?type=gal_hot&value=<?=abs($row["gal_hot"]-1)?>&record_id=<?=$row["gal_id"]?>&iCat=<?=$iCat?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$row["gal_hot"];?>.gif" alt="Uncheck Active hot data!"></a>				</td>
				<td><a href="active.php?type=gal_new&value=<?=abs($row["gal_new"]-1)?>&record_id=<?=$row["gal_id"]?>&iCat=<?=$iCat?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$row["gal_new"];?>.gif" alt="Uncheck Active hot data!"></a>				</td>
				<td><input type="text" name="gal_order" id="gal_order" class="form" size="3" value="<?=$row["gal_order"];?>"></td>
				<td align="center">
					<img src="<?=$fs_imagepath?>delete.png" alt="DELETE" border="0" onClick="if (confirm('<?=translate_text("Are_you_sure_to_delete")?>: <?=str_replace("'","",$row["gal_name"])?> ?')) { window.location.href='delete.php?iCat=<?=$iCat?>&record_id=<?=$row["gal_id"];?>&url=<?=base64_encode(getURL())?>'}" style="cursor:pointer">
					<input type="hidden" name="iQuick" value="update"><input type="hidden" name="record_id" value="<?=$row["gal_id"];?>">			  </td>
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