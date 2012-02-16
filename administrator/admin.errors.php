<?php
include "admin.header.php";

$page = "admin.errors";

$error_header = "Lỗi truy cập";
$error_message = "Bạn không đủ quyền truy cập vào chức năng này !";
$error_submit = "Quay lại";

$smarty->assign('error_header', $error_header);
$smarty->assign('error_message', $error_message);
$smarty->assign('error_submit', $error_submit);
$smarty->display($template_root.'administrator/admin.errors.tpl');

include "admin.footer.php";
?>