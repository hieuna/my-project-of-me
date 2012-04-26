<?
require_once("config_security.php");
require_once("../../functions/functions.php");
$Action = getValue("Action","str","POST","");
if ($Action =="Translate"){
	//check quyền them sua xoa
	checkAddEdit("edit");
	//read all translate variable
	$filename = "../0/translate.txt";
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);
	$array_lang = explode("\n",$contents);
	//start file content
	$file_content = "<? \n" .
					"\$lang = array(\n";
	for ($i=0;$i<count($array_lang);$i++){
		$translate = str_replace("\'","'",$_POST["translate" . $i]);
		$translate = str_replace('\"',"&quot;",$translate);
		
		$file_content .= "\"" . trim($array_lang[$i]) . "\" => \"" . $translate . "\",\n";
	}
	$file_content .= ");";
	//save to text file
	$filename = "../0/lang.php";
	$handle = fopen($filename, "w");
	fwrite($handle, $file_content);
	fclose($handle);
}
//read all translate variable
$filename = "../0/translate.txt";
$handle = @fopen($filename, "r");
$contents = @fread($handle, filesize($filename));
@fclose($handle);
$array_lang = explode("\n",$contents);
?>
<html>
<head>
<title>Add New</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<?=template_top(translate_text("translate_admin"))?>
		<? /*---------Body------------*/ ?>
		<table width="100%" border="1" style="border-collapse:collapse" bordercolor="#e5ecf9" cellpadding="3" cellspacing="3">
		<form action="translate.php" method="post">
			<? for ($i=0;$i<count($array_lang);$i++){ ?>
				<tr <?=$fs_change_bg?>>
					<td>
						<strong><?=$array_lang[$i]?></strong><br />
						<?
						$translated_text="";
						if (isset($lang[trim($array_lang[$i])])) $translated_text = $lang[trim($array_lang[$i])];
						?>
						<input type="text" name="translate<?=$i?>" value="<?=$translated_text?>" class="form" style="width:98%" />
					</td>
				</tr>
			<?
			}
			?>
			<tr>
				<td>
					<input type="submit" name="Translate" class="form" value="<?=translate_text("save_change")?>" />
					<input type="hidden" name="Action" value="Translate" />
				</td>
			</tr>
		</form>
		</table>
		<? /*---------Body------------*/ ?>
<?=template_bottom()?>
</body>
</html>