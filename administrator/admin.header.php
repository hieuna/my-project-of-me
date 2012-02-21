<?php
ob_start();
session_start();

include "../config/config.php";
include "../includes/clsCommons.php";
include "../includes/FCKeditor/fckeditor.php";
include "../includes/clsPaging.php";
include "../includes/define.table.php";

//MEMCACHE
include '../includes/cache/memcache_config.php';
include '../includes/cache/CGlobal.php';
include '../includes/cache/CacheLib.php';
if(MEMCACHE_ON){
	CGlobal::$memcache_server=$memcache_server;
	include '../includes/cache/memcache.class.php';
}

// INCLUDE DATABASE INFORMATION
include "../includes/database_config.php";

include "../includes/class_admin.php";
include "../includes/class_validate.php";
include "../includes/class_acl.php";
include "../includes/class_category.php";
include "../includes/class_product.php";
include "../includes/class_site.php";
include "../includes/class_hotdeal.php";
include "../includes/class_customer_hotdeal.php";
include "../includes/class_banner.php";
include "../includes/class_datetime.php";
include "../includes/class_database.php";
include "../includes/class_settings.php";
include "../includes/class_navigation.php";
include "../includes/cake/compact.php";
include "../includes/filter/filterinput.php";
include "../includes/environment/uri.php";
include "../includes/environment/request.php";
include "../includes/functions_general.php";
include "../includes/smarty/Smarty.class.php";


// INITIATE DATABASE CONNECTION
$database =& PGDatabase::getInstance();

// SET LANGUAGE CHARSET
$database->db_set_charset('utf8');

// GET SETTINGS
$settingClass = new PGSettings();
$setting = $settingClass->getSettings();

// CREATE URL CLASS
$PGRequest = new PGRequest();

// CREATE DATETIME CLASS
$datetime = new PGDatetime();

// CREATE URL CLASS
$uri = & PGURI::getInstance();

// CREATE ADMIN OBJECT
$admin = new PGAdmin();

$smarty	= new Smarty();
$smarty->template_dir	=	$template_root;
$smarty->compile_dir	=	$template_root_c;
$smarty->assign('http_root',$http_root);

//CREATE clsCommons();
$cls = new clsCommons();
$lblDisplay='';

$smarty->display($template_root.'administrator/admin.header.tpl');
?>