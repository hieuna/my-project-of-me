<?
//code by Dinh toan
require_once("config_security.php");
require_once("../../classes/database.php");
require_once("../../functions/pagebreak.php");
require_once("../../functions/functions.php");

$iCat	= getValue("iCat","int","GET",0);
$sqlCat	= "";
if ($iCat !=0) $sqlCat = " AND faq_category = " . $iCat . " ";
//get page break params
$normal_class="break_page";
$selected_class="break_page";
$page_prefix = "Pages:&nbsp;";
$current_page = 1;
if (isset($_GET["page"])) $current_page = $_GET["page"];
$current_page = intval($current_page);
if ($current_page < 1) $current_page=1;
$page_size = 30;
$url = $_SERVER['SCRIPT_NAME'] . "?iCat=" . $iCat;

$db_count = new db_query("SELECT Count(*) AS count
						  FROM " .  $fs_table . "
						 WHERE lang_id = " . $_SESSION["lang_id"] . " " . $sqlCat);
$row_count = mysql_fetch_array($db_count->result);
$total_record = $row_count['count'];
$db_count->close();
unset($db_count);
//end get page break params
//faq_date DESC,cat_id ASC, 
$db_list = new db_query("SELECT *
						 FROM " .  $fs_table . "
						 WHERE lang_id = " . $_SESSION["lang_id"] . " " . $sqlCat  . "
						 ORDER BY faq_id DESC,faq_name ASC
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
		if (checkblank(formobj.faq_name.value)) { alert('Please enter the title!'); return false;}
		
		formobj.submit();
	}
</script>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<? template_top(translate_text("danh_sach_hoi_dap"))?>
		<? /*---------Body------------*/ ?>
		<div style="padding:7px;" align="left" class="textBold">
		<?=translate_text("tim_kiem")?> :&nbsp;
			<?
			$iGrp=getValue("iGrp");
			$db_group=new db_query("SELECT * FROM categories_multi WHERE cat_type = 'faq' ORDER BY cat_order ASC,cat_name ASC");
			?>
			<select onChange="window.location.href='listing.php?iGrp='+this.value" class="form">
				<option value="0"><?=translate_text("select_category")?> </option>
				<?
				while($rowg=mysql_fetch_array($db_group->result)){
				?>
					<option value="<?=$rowg["cat_id"]?>" <? if($rowg["cat_id"]==$iGrp) echo "selected";?>><?=$rowg["cat_name"]?></option>
				<?
				}
				?>
			</select>
			<?
			unset($db_group);
			?>
		</div>
		<table border="1" cellpadding="3" cellspacing="2" width="100%" bordercolor="#CCCCCC" style="border-collapse:collapse">
			<? /*---------------Title----------------*/ ?>
			
			<? /*---------------Listing----------------*/ ?>
			<?
			$countno = ($current_page-1) * $page_size;
			$lang_path = '/' . $_SESSION["lang_path"] . '/';
			while ($row = mysql_fetch_array($db_list->result)){
				$link_pro= "";
				$countno++;
			?>
			<form class="form" method="post" action="quickedit.php?iQuick=update&iCat=<?=$iCat?>&url=<?=base64_encode(getURL())?>" name="data<?=$row["faq_id"];?>" id="data<?=$row["faq_id"];?>" enctype="multipart/form-data">
			<tr <?=$fs_change_bg?>>
				<td align="center"><?=$countno;?></td>
				<td align="center" <? if($row["admin_id"] == $admin_id) echo ' bgcolor="#FFFF66"';?>><img src="<?=$fs_imagepath?>ed_save.gif" border="0" style="cursor:pointer" onClick="ValidateForm(document.data<?=$row["faq_id"]?>);" alt="Save"></td>
				<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("full_name")?>:</td>
				<td><input type="text" name="faq_name" id="faq_name" class="form" size="40" maxlength="100" value="<?=$row["faq_name"];?>"></td>
				<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("email")?>:</td>
				<td><input type="text" name="faq_email" id="faq_email" class="form" size="40" maxlength="100" value="<?=$row["faq_email"];?>"></td>
				<td class="textBold" nowrap="nowrap" align="right"><?=translate_text("category")?>:</td>
				<td>
				<select name="faq_category" class="form">
					<option value="0">--[Select one category]--</option>
					<?
					$db_cate = new db_query("SELECT cat_id,cat_name
														FROM categories_multi 
														WHERE categories_multi.lang_id = " . $_SESSION["lang_id"] . $sqlcategory . " AND cat_type = 'faq'
														ORDER BY cat_order ASC");
					$cha_id = 0;
					while ($row_cat = mysql_fetch_array($db_cate->result)) {
					//get number of record
					$db_counts = new db_query("SELECT count(*) as faq_count FROM " .  $fs_table . " WHERE lang_id = " . $_SESSION["lang_id"] . " AND faq_category = " . $row_cat["cat_id"]);
					$row_temps = mysql_fetch_array($db_counts->result);
					unset($db_counts);
					if ($row_cat["cat_id"] == $row["faq_category"])
						echo "<option value='" . $row_cat["cat_id"] . "' selected>&nbsp;&nbsp;|--&nbsp;" . $row_cat["cat_name"] . "&nbsp;(" . $row_temps["faq_count"] . ")" . "</option>";
					else
						echo "<option value='" . $row_cat["cat_id"] . "'>&nbsp;&nbsp;|--&nbsp;" . $row_cat["cat_name"] . "&nbsp;(" . $row_temps["faq_count"] . ")" . "</option>";
					}
					unset($db_cate);
					?>
				</select>
				</td>
				<td>
						<a href="active.php?record_id=<?=$row["faq_id"]?>&type=faq_approve&value=<?=abs($row["faq_approve"]-1)?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=intval($row["faq_approve"]);?>.gif" alt="Uncheck Active approve data!"></a>
				</td>
				<td align="center"><a href="edit.php?iCat=<?=$iCat?>&record_id=<?=$row["faq_id"];?>&url=<?=base64_encode(getURL())?>"><img src="<?=$fs_imagepath?>edit.gif" alt="EDIT" border="0"></a></td>
				<td align="center">
					<img src="<?=$fs_imagepath?>delete.gif" alt="DELETE" border="0" onClick="if (confirm('Bạn muốn xóa: <?=str_replace("'","",$row["faq_name"])?> ?')) { window.location.href='delete.php?iCat=<?=$iCat?>&record_id=<?=$row["faq_id"];?>&url=<?=base64_encode(getURL())?>'}" style="cursor:pointer">
					<input type="hidden" name="iQuick" value="update"><input type="hidden" name="record_id" value="<?=$row["faq_id"];?>">
					</td>
			</tr>
			</form>
			<? } ?>
			<tr>
				<td colspan="10">&nbsp;</td>
			</tr>
			<? if($total_record > $page_size){ ?>
			<tr>
				<td colspan="10" align="right" style="padding-right:5px" class="break_page">
				<?=generatePageBar($page_prefix,$current_page,$page_size,$total_record,$url,$normal_class,$selected_class);?>
				</td>
			</tr>
			<? } ?>
		</table>
		<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<? unset($db_news);?>