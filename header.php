<?php
ob_start();
session_start();

include "config/config.php";
include "includes/define.table.php";

// INCLUDE DATABASE INFORMATION
include "includes/database_config.php";

include "includes/class_menu.php";
include "includes/class_category.php";
include "includes/class_product.php";
include "includes/class_banner.php";
include "includes/class_hotdeal.php";
include "includes/class_customer_hotdeal.php";
include "includes/class_datetime.php";
include "includes/class_database.php";
include "includes/filter/filterinput.php";
include "includes/environment/uri.php";
include "includes/environment/request.php";
include "includes/functions_general.php";
include "includes/smarty/Smarty.class.php";

// INITIATE DATABASE CONNECTION
$database =& PGDatabase::getInstance();

// SET LANGUAGE CHARSET
$database->db_set_charset('utf8');

// CREATE URL CLASS
$PGRequest = new PGRequest();

// CREATE DATETIME CLASS
$datetime = new PGDatetime();

// CREATE URL CLASS
$uri = & PGURI::getInstance();

// CREATE NEW SMARTY
$smarty	= new Smarty();
$smarty->template_dir	=	$template_root;
$smarty->compile_dir	=	$template_root_c;


$name_template = "shopping";
$dir_template = $template_root.$name_template;

$smarty->assign('http_root',$http_root);
$smarty->assign('template_root', $template_root);
$smarty->assign('name_template', $name_template);
$smarty->assign('dir_template', $dir_template);


$smarty->display($dir_template.'/header.tpl');
?>
