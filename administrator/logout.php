<?php
ob_start();
session_start();
session_unset();
session_destroy();
$admin_id 		= 0;
$admin_group 	= 0;
$admin_access 	= "";
header('Location: login.php');
?>