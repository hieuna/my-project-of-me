<?php
$page = "admin_home";
$page_title = "Trang chủ";
include "admin_header.php";

$task = PGRequest::getCmd('task','');
cheader($uri->base().'admin_orders.php');
include "admin_footer.php";
?>