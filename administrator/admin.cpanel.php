<?php
include ("admin.header.php");
include ("check.login.php");

$smarty->display($template_root.'administrator/admin.cpanel.tpl');

include ("admin.footer.php");
?>