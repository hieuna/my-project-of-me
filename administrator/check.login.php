<?php
	$admin_id 		= $_SESSION['admin_id'];
	$admin_group 	= $_SESSION['admin_group'];
	$admin_access 	= $_SESSION['admin_access'];
	if(!isset($admin_id) && $admin_id==0) header("Location: login.php");
?>