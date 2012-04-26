<?
require_once("config_security.php");
require_once("../../functions/functions.php");
require_once("../" . $_SESSION["lang_id"] . "/lang_display.php");
$Action = getValue("Action","str","POST","");
if ($Action =="Translate"){
	//check quyền them sua xoa
	checkAddEdit("edit");
	//read all translate variable
	$filename = "../0/translate_display.txt";
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);
	$array_lang = explode("\n",$contents);
	//start file content
	$file_content = "<? \n" .
					"\$lang_display = array(\n";
	for ($i=0;$i<count($array_lang);$i++){
		$translate = str_replace("\'","'",$_POST["translate" . $i]);
		$translate = str_replace('\"',"&quot;",$translate);
		
		$file_content .= "\"" . trim($array_lang[$i]) . "\" => \"" . $translate . "\",\n";
	}
	$file_content .= ");";
	//save to text file
	$filename = "../" . $_SESSION["lang_id"] . "/lang_display.php";
	$handle = fopen($filename, "w");
	fwrite($handle, $file_content);
	fclose($handle);

	//Header( "HTTP/1.1 301 Moved Permanently" ); 
	//Header( "Location: translate_display.php" ); 		
}
//read all translate variable
$filename = "../0/translate_display.txt";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);
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
		<table width="100%" border="0" style="border-collapse:collapse; margin-left:10px;" bordercolor="#f2f2f2" cellpadding="5" cellspacing="0">
		<form action="translate_display.php" method="post">
			<? 
			
			for ($i=0;$i<count($array_lang);$i++){ ?>
				<tr <?=$fs_change_bg?>>
					<td>
						<strong><?=$array_lang[$i]?></strong><br />
						<?
						$translated_text="";
						if (isset($lang_display[trim($array_lang[$i])])) $translated_text = $lang_display[trim($array_lang[$i])];
						?>
						<input type="text" name="translate<?=$i?>" value="<?=$translated_text?>" class="form" style="width:98%" />
					</td>
				</tr>
			<?
			}
			?>
			<tr>
				<td>
					<input type="submit" name="Translate" class="form" value="Save changes" />
					<input type="hidden" name="Action" value="Translate" />
				</td>
			</tr>
		</form>
		</table>
		<? /*---------Body------------*/ ?>
<?=template_bottom()?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>