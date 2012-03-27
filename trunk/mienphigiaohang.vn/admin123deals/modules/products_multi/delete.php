<?php
require_once("inc_security.php");
//check quyền them sua xoa
checkAddEdit("delete");

$fs_redirect	= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET");
$action         = getValue("action","str","GET","");
$field_id		= "pro_id";
    //Delete data with ID
    delete_pic($fs_table,"pro_id",$record_id,"pro_picture",$fs_img_products);
    $db_del = new db_execute("DELETE FROM ". $fs_table ." WHERE pro_id =" . $record_id);
    unset($db_del);
    //$db_del = new db_execute("DELETE FROM admin_user_category WHERE auc_category_id =" . $record_id);
    //unset($db_del);
redirect($fs_redirect);

?>