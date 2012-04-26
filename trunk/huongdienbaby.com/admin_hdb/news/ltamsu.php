<?
require_once("config_security.php");
require_once("../../classes/database.php");
require_once("../../functions/date_function.php");
require_once("../../functions/pagebreak.php");
require_once("../../functions/functions.php");

$keyword 		= getValue("keyword","str","GET","",1);
$iCat				= getValue("iCat","int","GET",0);
$filter			= getValue("filter");
$sqlCat			= "";
switch($filter){
	case 1:
		$sqlCat.= " AND new_new = 1 ";
	break;
	case 2:
		$sqlCat.= " AND new_hot = 1 ";
	break;
	case 3:
		$sqlCat.= " AND new_approve = 1 ";
	break;
	case 4:
		$sqlCat.= " AND new_approve = 0 ";
	break;
	
}

$search_field = 'new_title';
$mysql	=	new generate_quicksearch($keyword,$search_field);
if($keyword!='') $sqlCat.=$mysql->sql_keyword;

//get page break params
$normal_class			=	"break_page";
$selected_class		=	"break_page";
$page_prefix 			= "Pages:&nbsp;";
$current_page 			= 1;
if (isset($_GET["page"])) $current_page = $_GET["page"];
$current_page = intval($current_page);
if ($current_page < 1) $current_page=1;
$page_size = 10;
$url = $_SERVER['SCRIPT_NAME'] . "?iCat=" . $iCat;

$db_count = new db_query("SELECT Count(*) AS count
						  FROM news
						  WHERE new_category = 0 AND news.lang_id = " . $_SESSION["lang_id"]  . $sqlCat);
$row_count = mysql_fetch_array($db_count->result);
$total_record = $row_count['count'];
$db_count->close();
unset($db_count);
//end get page break params
//new_date DESC,cat_id ASC, 
$db_list = new db_query("SELECT *
						 FROM news
						 WHERE new_category = 0 AND news.lang_id = " . $_SESSION["lang_id"]  . $sqlCat . "
						 ORDER BY new_date DESC,new_title ASC
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
		if (checkblank(formobj.new_title.value)) { alert('Please enter the title!'); return false;}
		
		formobj.submit();
	}
</script>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<script language="javascript" src="../js/tooltip.js"></script>
<? template_top(translate_text("danh_sach_thong_tin"))?>
		<? /*---------Body------------*/ ?>
		<div style="background:#CCCCCC">
		<table border="0" cellpadding="5" cellspacing="3" align="center" bordercolor="#CCCCCC" style="border-collapse:collapse; margin:5px;">
      	<form action="<?=getURL()?>" method="get" name="timkhohang">
      	<tr>
             <?
             $keyword=getValue("keyword","str","GET","");
				 ?>
             <td class="textBold">Từ khóa :</td>
             <td><input type="text" class="form" name="keyword" value="<?=$keyword?>" style="width:120px" /></td>
             <td><input type="submit" value="Tìm kiếm" class="form" /></td>
         </tr>
         </form>
      </table>
		</div>
		<table border="1" bordercolor="#E5ECF9" cellpadding="3" cellspacing="2" width="100%" style="border-collapse:collapse">
			<? /*---------------Title----------------*/ ?>
			<tr>
				<td width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>save.gif" border="0"></td>
				<td width="5%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>images.gif" border="0"></td>
				<td><a href="<?=$_SERVER['SCRIPT_NAME']?>?iSort=<?=$iSort;?>"><img src="<?=$fs_imagepath?>general.gif" border="0"></a></td>
				<td><img src="<?=$fs_imagepath?>teaser.gif" border="0"></td>
				<td align="center"><img src="<?=$fs_imagepath?>hot.gif" border="0"></td>
				<td align="center"><img src="<?=$fs_imagepath?>new.gif" border="0"></td>
				<td align="center">Bài viết</td>
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
			<form class="form" method="post" action="quickedit.php?iQuick=update&url=<?=base64_encode(getURL())?>" name="data<?=$row["new_id"];?>" id="data<?=$row["new_id"];?>" enctype="multipart/form-data">
			<tr>
				<td align="center"><img src="../images/ed_save.gif" border="0" style="cursor:pointer" onClick="ValidateForm(data<?=$row["new_id"]?>);" alt="Save"></td>
				<td align="center">
				<? if($row["new_picture"] != ""){ ?>
					<a href="delete_picture.php?record_id=<?=$row["new_id"]?>&url=<?=base64_encode(getURL())?>" class="text">[Delete picture]</a><br>
				<? } ?>
				<a href="" target="_blank"><img height="60"  onmouseover="popup('<img src=\'<?=$fs_filepath . "medium_" .$row["new_picture"] ?>\'>','<?=$bordercolor?>')" ;="" onMouseOut="kill()"  src="<?=$fs_filepath . "small_" . $row["new_picture"]?>" <? if(file_exists("../../images/noimage.jpg")) echo ' onError="this.src=\'../../images/noimage.jpg\'"';?> height="80" style="cursor:pointer" border="0">	</a>
				<br><input type="file" name="picture" id="picture" class="form" size="3">				
				</td>
				<td>
					<? /*-----------------*/ ?>
					<table border="0" cellpadding="2" cellspacing="1" width="100%">
						<tr>
							<td class="textBold" nowrap="nowrap" align="right">CATEGORIES:</td>
							<td>
							<select name="new_category" class="form">
								<option value="0">--[Select one category]--</option>
								<?
                        $iParent = getValue("iCat","int","GET",0);
                        for($i=0;$i<count($listAll);$i++){
                           if($listAll[$i]["cat_id"] == $row["new_category"]){
                        ?>
                           <option value="<?=$listAll[$i]["cat_id"]?>" selected="selected">
                           <?
                           for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
                              echo "<font color='red'>+ </font>" . $listAll[$i]["cat_name"];
                           ?>
                           </option>
                        <? }else{ ?>
                           <option value="<?=$listAll[$i]["cat_id"]?>">
                           <?
                           for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
                              echo "<font color='red'>+ </font>" . $listAll[$i]["cat_name"];
                           ?>
                           </option>
                        <?
                           }
                        }
                        ?>
							</select>							</td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("title")?>:</td>
							<td><input type="text" name="new_title" id="new_title" class="form" size="28" maxlength="100" value="<?=htmlspecialchars($row["new_title"]);?>"></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("date")?>:</td>
							<td><input type="text" name="new_date" id="new_date" class="form" size="10" maxlength="10" value="<?=getShortDate($row["new_date"]);?>"></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("source")?>:</td>
							<td nowrap="nowrap"><input type="text" name="new_location" id="new_location" class="form" size="10" maxlength="50" value="<?=$row["new_location"];?>">&nbsp;<i>(Ex: vnexpress.net)</i></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("note_for_image")?>:</td>
							<td><input type="text" name="new_image_note" id="new_image_note" class="form" size="28" maxlength="255" value="<?=$row["new_image_note"];?>"></td>
						</tr>
					</table>
					<? /*-----------------*/ ?>				</td>
				<td align="center"><textarea name="new_teaser" id="new_teaser" cols="60" rows="7" class="form"><?=preg_replace('|'. quotemeta('<') .'(.*)' . quotemeta('>') . '|U','',($row["new_teaser"]!='') ? $row["new_teaser"] : cut_string($row["new_description"],250))?></textarea></td>
				<td>
						<a href="active.php?type=new_hot&value=<?=abs($row["new_hot"]-1)?>&record_id=<?=$row["new_id"]?>&iCat=<?=$iCat?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$row["new_hot"];?>.gif" alt="Uncheck Active hot data!"></a>				</td>
				<td><a href="active.php?type=new_new&value=<?=abs($row["new_new"]-1)?>&record_id=<?=$row["new_id"]?>&iCat=<?=$iCat?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$row["new_new"];?>.gif" alt="Uncheck Active hot data!"></a>				</td>
				<td><a href="active.php?type=new_baiviet&value=<?=abs($row["new_baiviet"]-1)?>&record_id=<?=$row["new_id"]?>&iCat=<?=$iCat?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=intval($row["new_baiviet"]);?>.gif" alt="Uncheck Active hot data!"></a></td>
				<td>
						<a href="active.php?type=new_approve&value=<?=abs($row["new_approve"]-1)?>&record_id=<?=$row["new_id"]?>&iCat=<?=$iCat?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$row["new_approve"];?>.gif" alt="Check Active approve data!"></a>				</td>
				<td align="center"><a href="edit.php?record_id=<?=$row["new_id"];?>&url=<?=base64_encode(getURL())?>"><img src="<?=$fs_imagepath?>icon_edit_data.gif" alt="EDIT" border="0"></a></td>
				<td align="center">
					<img src="<?=$fs_imagepath?>delete.png" alt="DELETE" border="0" onClick="if (confirm('Ban muon xoa tin nay ?')) { window.location.href='delete.php?iCat=<?=$iCat?>&record_id=<?=$row["new_id"];?>&url=<?=base64_encode(getURL())?>'}" style="cursor:pointer">
					<input type="hidden" name="iQuick" value="update"><input type="hidden" name="record_id" value="<?=$row["new_id"];?>">					</td>
			</tr>
			</form>
			<? } ?>
			<tr>
				<td colspan="11">&nbsp;</td>
			</tr>
			<? if($total_record > $page_size){ ?>
			<tr>
				<td colspan="11" align="right" style="padding-right:5px" class="break_page">
				<?=generatePageBar($page_prefix,$current_page,$page_size,$total_record,$url,$normal_class,$selected_class);?>
				</td>
			</tr>
			<? } ?>
		</table>
<br><br>
		<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<? unset($db_news);?>