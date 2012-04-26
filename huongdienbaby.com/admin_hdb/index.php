<?
session_start();	
require_once("../functions/functions.php");
$loginpath="login/login.php";
if (!isset($_SESSION["logged"])){
	redirect($loginpath);
}
else{
	if ($_SESSION["logged"] != 1){
		redirect($loginpath);
	}
}	
$framemainsrc = 'blank.htm';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>Control Pannel</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/FSportal.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="js/service.js"></script>
<script language="javascript">
<!--
var opt_no_frames = false;
var opt_integrated_mode = false;
var _help_prefix = "";
var _help_module = "";
var _context = "";

//-->
</script>
</head>
<frameset rows="60,*" border="0" framespacing="0" frameborder="0">
		<frame src="menu/inc_header.php" name="topFrame" frameborder="0" border="0" framespacing="0" marginheight="0" marginwidth="0" noresize="noresize" scrolling="no">
		<frameset id="MainFrameSet" cols="210,*" border="0" frameborder="0" framespacing="0">
			<frame src="menu/index.php"  scrolling="NO" name="leftFrame" frameborder="0" border="0" noresize="noresize">
			<frame src="<?=$framemainsrc?>" name="workFrame" frameborder="0" border="0" framespacing="0" marginheight="7" marginwidth="7" noresize="noresize" scrolling="auto">
		</frameset>
	</frameset><noframes></noframes>
</html>
<? 
?>
