<?php
include "config/config.php";
include "includes/define.table.php";

// INCLUDE DATABASE INFORMATION
include "includes/database_config.php";

include "includes/class_banner.php";
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
$url_template = $http_root."templates/".$name_template;

$objBanner = new PGBanner();

//Load Banner Topup
$topup = $objBanner->loadTopup();

$smarty->assign('topup', $topup);
$smarty->display($dir_template."/viewtopup.tpl");
?>