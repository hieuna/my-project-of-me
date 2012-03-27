<?php
ob_start();
session_start ();
require_once ("../functions/functions.php");
require_once ("../classes/database.php");
require_once ("../classes/denyconnect.php");


//Chống bot truy cập
$denyconnect = new denyconnect ();
function authenticate() {
	header ( 'WWW-Authenticate: Basic realm="Authentication System"' );
	header ( 'HTTP/1.0 401 Unauthorized' );
	echo "You must enter a valid login ID and password to access this resource\n";
	exit ();
}

$ip = $_SERVER ['REMOTE_ADDR'];
$uip = getValue ( "uip", "str", "POST", "", 2 );

if ($uip != "") {
	if (! file_exists ( "ipstore/" . ip2long ( $ip ) . ".cfn" )) {
		$filename = "ipstore/" . ip2long ( $ip ) . ".cfn";
		$handle = @fopen ( $filename, 'a' );
		if (! $handle)
			exit ();
		fwrite ( $handle, "" );
		fclose ( $handle );
	}
	redirect ( "login.php" );
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Reset IP</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<div align="center">
<?
$auth_user = "";
$auth_pwd = "";

if (isset ( $_SERVER ['PHP_AUTH_USER'] ))
	$auth_user = $_SERVER ['PHP_AUTH_USER'];
if (isset ( $_SERVER ['PHP_AUTH_PW'] ))
	$auth_pwd = $_SERVER ['PHP_AUTH_PW'];

if ($auth_user != "user123deals" || $auth_pwd != "passdeocopass@123") {
	authenticate ();
} else {
	?>
<form action="resetip.php" method="post">
<label>Nhập vào IP của bạn <strong><?=$ip?></strong></label>
<input type="text" id="uip" name="uip" />
<input type="submit" value="Add" />
</form>
<?
}
?>
</div>
</body>
</html>
<?
ob_end_flush ();
?>