<?
require_once("config_security.php");
require_once("../../classes/database.php");
$db_admin_listing = new db_query ("SELECT * 
								  FROM admin_user
								  WHERE adm_loginname NOT IN('admin','finalstyle') AND adm_delete = 0
								  ORDER BY adm_loginname ASC, adm_active DESC");
?>
<html>
<head>
<title>Add New</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<? template_top(translate_text("danh_sach_user_admin"))?>
		<? /*---------Body------------*/ ?>
		<table width="100%" border="0" cellpadding="4" bgcolor="#E5ECF9" cellspacing="1" class="bgTableBorder">
			<tr height="25" bgcolor="#FFFFFF">
			<td width="20" class="textBold">No</td>
			<td align="center" class="textBold" nowrap="nowrap"><?=mb_strtoupper(translate_text("ten_dang_nhap"),"UTF-8")?></td>
			<td align="center" class="textBold">EMAIL</td>
			<td align="center" class="textBold"><?=mb_strtoupper(translate_text("phan_quyen_module"),"UTF-8")?></td>
			<td align="center" class="textBold" nowrap="nowrap"><?=mb_strtoupper(translate_text("quyen_category"),"UTF-8")?></td>
			<td align="center" class="textBold">NGÔN NGỮ</td>
			<td align="center" class="textBold">ACTIVE</td>			
			<td width="40" align="center" class="textBold"><?=mb_strtoupper(translate_text("sua"),"UTF-8")?></td>
			<td align="center" class="textBold"><img src="<?=$fs_imagepath?>delete.gif" border="0"></td>
			</tr>
			<?
			$countno = 0;
			while ($row = mysql_fetch_array($db_admin_listing->result))
			{
			  $countno++;
			?>
			  <tr align="left" valign="middle" class="bgTable" bgcolor="#FFFFFF"> 
				<td align="center" class="textBold"><?=$countno;?></td>
				<td class="textBold"><?=$row["adm_loginname"];?></td>
				<td class="textBold"><?=$row["adm_email"];?></td>
				
				<td align="center" class="text">
					<?
					$db_access = new db_query("SELECT * 
											   FROM admin_user, admin_user_right, modules
											   WHERE adm_id = adu_admin_id AND mod_id = adu_admin_module_id AND adm_id =" . $row['adm_id']);
					while ($row_access = mysql_fetch_array($db_access->result)){
						echo $row_access['mod_name'] . ", ";
					}
					unset($db_access);
					?>
				</td>
				<td align="center" class="text">
					<?
					if($row["adm_all_category"]==1){
						echo translate_text("all_category");
					}else{
						$db_access = new db_query("SELECT * 
													FROM admin_user, admin_user_category, categories_multi
													WHERE adm_id = auc_admin_id AND cat_id = auc_category_id AND adm_id =" . $row['adm_id']);
						while ($row_channel = mysql_fetch_array($db_access->result)){
							echo $row_channel['cat_name'] . ", ";
						}
						unset($db_access);
					}
					?>
				</td>
				<td align="center">
					<?
					$db_access = new db_query("SELECT * 
											   FROM languages,admin_user_language
											   WHERE lang_id = aul_lang_id AND aul_admin_id =" . $row['adm_id']);
					while ($row_channel = mysql_fetch_array($db_access->result)){
						echo $row_channel['lang_name'] . ", ";
					}
					unset($db_access);
					?>
				</td>
				<td align="center"><a href="active.php?record_id=<?=$row["adm_id"]?>&type=adm_active&value=<?=abs($row["adm_active"]-1)?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$row["adm_active"];?>.gif" alt="Active!"></a></td>
				<td align="center"><a href="edit.php?iAdm=<?=$row["adm_id"];?>"><img src="<?=$fs_imagepath?>edit.gif" alt="EDIT" border="0"></a></td>
				<td align="center"><img src="<?=$fs_imagepath?>delete.gif" alt="DELETE" border="0" onClick="if (confirm('Are you sure to delete?')){ window.location.href='active.php?record_id=<?=$row["adm_id"]?>&type=adm_delete&value=<?=abs($row["adm_delete"]-1)?>&url=<?=base64_encode(getURL())?>'}" style="cursor:pointer"></td>
			  </tr>
			<? } ?>
		</table>
		<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<? unset($db_admin_listing);?>