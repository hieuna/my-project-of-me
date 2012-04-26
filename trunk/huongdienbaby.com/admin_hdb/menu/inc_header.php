<? require_once("config_security.php"); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Header</title>
<script language="javascript" src="../js/library.js"></script>
</head>
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0"  id="topCP">
<?  //------------------------------------------------------------------------------------------------*/ ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td bgcolor="<?=$bgcolor?>" height="60" style="border-bottom:solid 1px <?=$bordercolor?>">
		<? //---------Body------------*/ ?>
		<table width="30%" border="0" cellpadding="2" cellspacing="0" height="42">
			<tr> 
				<td width="20" ><img src="<?=$fs_imagepath?>edit.gif" hspace="0" vspace="2"></td>
				<td nowrap="nowrap"> 
					<a href="../userprofile/user_profile.php" class="textBold" target="workFrame">Thông tin cá nhân user: <?=$_SESSION["userlogin"]?></a>&nbsp;&nbsp;
				</td>
				<td width="20" ><a href="../login/logout.php" class="textBold" target="workFrame"><img src="<?=$fs_imagepath?>logoff.gif" hspace="0" vspace="2" border="0"></a></td>
				<td>
					<a href="../login/logout.php" class="textBold" target="workFrame">Thoát</a>
				</td>
            <td width="160" class="textBoldColor"><select name="lang_id" class="form" onChange="parent.location.href='change_language.php?lang_id=' + this.value">
               <?=$_SESSION["lang_id"]?><?
				   $db_lang = new db_query("SELECT *
                                 FROM languages
                                 ");
              while ($row = mysql_fetch_array($db_lang->result)){
              ?>
               <option value="<?=$row["lang_id"]?>" <? if ($_SESSION["lang_id"]==$row["lang_id"]) echo "selected";?>><?=$row["lang_name"]?></option>
              <?
              }
              $db_lang->close();
              unset($db_lang);						   
              ?>
              </select></td>
				  
			</tr>
		</table>
		<? //---------Body------------*/ ?>
		</td>
		<td bgcolor="<?=$bgcolor?>" style="border-bottom:solid 1px <?=$bordercolor?>" align="right">&nbsp;</td>
	</tr>
</table>
<? //------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
