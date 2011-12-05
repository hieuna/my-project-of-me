<?php
$page = "user_logout";
include "header.php";

if( @$_GET['token'] == $session->get('token') || strtoupper($_SERVER['REQUEST_METHOD']) === 'POST' )
{
  	$user->user_logout();
}

// CHECK FOR REDIRECTION URL
$return_url = urldecode ( PGRequest::getVar ( 'return_url', '' ) );
$return_url = str_replace ( "&amp;", "&", $return_url );
if ($return_url == "") $return_url = "index.php";
if (strpos($return_url, 'payment_method.php')!==false) $return_url = "login.php";

// FORWARD TO USER LOGIN PAGE
cheader($return_url);
?>