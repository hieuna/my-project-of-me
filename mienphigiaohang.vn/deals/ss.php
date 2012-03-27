<?php
session_start();
if(isset($_SESSION["city"])){
	$sesok = $_SESSION["city"];
	}
else $sesok =0;
?>