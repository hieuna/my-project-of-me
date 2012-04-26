<?
include ("config_security.php"); 
require_once("../../classes/database.php");
require_once("../../classes/upload.php");
require_once("../../classes/generate_form.php");
require_once("../../functions/file_functions.php");
require_once("../../functions/resize_image.php");
require_once("../../functions/functions.php");
$fs_table = "pictures_product";
$pro_action = getValue("action","str","GET");
if($pro_action=="edit"){
	$iTemp = getValue("temp","int");
	$ff_action        = "picturesproduct.php?action=edit&temp=" . $iTemp;
	$ff_redirect_succ = "picturesproduct.php?action=edit&temp=" . $iTemp;
}else{
	$iTemp = getValue("temp","str");
	$ff_action        = "picturesproduct.php?temp=" . $iTemp;
	$ff_redirect_succ = "picturesproduct.php?temp=" . $iTemp;
}
$ff_redirect_fail = "";
$Action		      = "";
$errorMsg		  ="";
$pro_picture	  ="";
$myform = new generate_form();
$myform->removeHTML(0);
$pipr_temp = $iTemp;
$myform->add("pipr_order","pipr_order",1,0,0,0,"",0,"");
$myform->add("pipr_note","pipr_note",0,0,0,0,"",0,"");
if($pro_action=="edit"){
	$myform->add("pipr_product","pipr_temp",1,1,"",0,"",0,"");
}else{
	$myform->add("pipr_temp","pipr_temp",0,1,"",0,"",0,"");
}
$myform->addTable($fs_table);
?>
<?
$formAction = "";
if (isset($_POST["Action"])) $formAction = $_POST["Action"];

//Update database	
if ($formAction == 'update')
{
	$errorMsg.= $myform->checkdata();
	$myupload=new upload("pipr_name",$fs_filepath,$extension_list,$limit_size);
	//echo $myupload->common_error;
	if($myupload->file_name!=""){
		$pipr_name = $myupload->file_name;
		resize_image($fs_filepath,$myupload->file_name,$medium_width,$medium_heght,$medium_quantity,"medium_");
		resize_image($fs_filepath,$myupload->file_name,80,80,$small_quantity,"small_");
		$myform->add("pipr_name","pipr_name",0,1,"",0,"",0,"");
		//chmod images
		@chmod($fs_filepath . $pipr_name,0644);
		@chmod($fs_filepath . 'small_' . $pipr_name,0644);
		@chmod($fs_filepath . 'medium_' . $pipr_name,0644);
		
		$errorMsg.=$myupload->warning_error;
		if ($errorMsg==""){
			$db_ex = new db_execute($myform->generate_insert_SQL());
			//echo $myform->generate_insert_SQL();
			redirect($ff_redirect_succ);
			exit();
		}
		else{
			echo '<script>alert("' . $errorMsg . '")</script>';
			redirect($ff_redirect_succ);
		}
	}
	if ($errorMsg!="") echo "<font color='red'>" . $errorMsg . "</font>";
}
if($pro_action=="edit"){
	$db_picture_product = new db_query("SELECT * FROM pictures_product WHERE pipr_product=" . $iTemp . " ORDER BY pipr_order ASC");
}else{
	$db_picture_product = new db_query("SELECT * FROM pictures_product WHERE pipr_temp='" . $iTemp . "' ORDER BY pipr_order ASC");
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/FSPortal.css" type="text/css">

<title>Untitled Document</title>
</head>

<body>
<? template_top(translate_text("upload_nhieu_anh"),0)?>
		  <table align="center" cellpadding="3" cellspacing="3" class="textBold" width="100%">
		  <form method="post" action="<?=$ff_action?>" name="form1" enctype="multipart/form-data">
			<tr>
				<td>UPLOAD Picture ( jpg,gif,png )</td>
				<td><input type="file" name="pipr_name" class="form" ></td>
				<td class="text">ORDER</td>
				<td><input type="text" class="form" size="5" name="pipr_order" value="1" id="pipr_order"></td>
			</tr>
			<tr>
				<td class="textBold">Note        : </td>
				<td colspan="3"><input type="text" class="form" size="40" name="pipr_note"></td>
			</tr>
			 <tr valign="baseline"> 
				<td nowrap align="right" colspan="2">&nbsp;</td>
				<td colspan="2"> <input type="submit" class="button"  value="Save Changes"> </td>
			 </tr>
			 <input type="hidden" name="Action" value="update">
		</form>
			<tr>
				<td colspan="4">
					<table cellpadding="5" cellspacing="0" width="100%" border="1" bordercolor="#999999" style="border-collapse:collapse">
					<tr>
						<td class="bottom-menu">PICTURE</td>
						<td class="bottom-menu" align="center">NOTE</td>
						<td class="bottom-menu" align="center">ORDER</td>
						<td class="bottom-menu" align="center">EDIT</td>
						<td class="bottom-menu" align="center">DELETE</td>
					</tr>
					<?
					while($row=mysql_fetch_array($db_picture_product->result)){
					?>
						<form name="picture<?=$row["pipr_id"]?>" action="update.php" method="get">
						<input type="hidden" name="temp" value="<?=getValue("temp","str")?>">
						<input type="hidden" name="action" value="<?=getValue("action","str")?>">
						<input type="hidden" name="id_pipr" value="<?=$row["pipr_id"]?>">
						<tr>
							<td width="70" align="center"><img src="<?=$fs_filepath?>small_<?=$row["pipr_name"]?>" border="0" width="60" height="60"></td>
							<td class="bottom-menu" align="center"><input type="text" class="form" size="25" name="pipr_note" value="<?=$row["pipr_note"]?>"></td>
							<td class="bottom-menu" align="center"><input type="text" class="form" size="7" name="pipr_order" value="<?=$row["pipr_order"]?>"></td>
							<td class="bottom-menu" align="center"><img src="<?=$fs_imagepath?>save_f2.png" style="cursor:hand" onClick="picture<?=$row["pipr_id"]?>.submit();"></td>
							<td class="bottom-menu" align="center"><img src="<?=$fs_imagepath?>cancel_f2.png" style="cursor:hand;" onClick="if (confirm('Are you sure to delete?')) { window.location.href='deletepicture.php?<? if($pro_action=="edit") echo "action=edit&";?>temp=<?=getValue("temp","str")?>&iPipr=<?=$row["pipr_id"]?>'}"></td>
						</tr>
						</form>
					<?
					}
					?>	
					</table>
				</td>
			</tr>
		  </table>
<? template_bottom() ?>
</body>
</html>
