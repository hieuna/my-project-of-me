<?php
// PREVENT MULTIPLE INCLUSION
if( defined('PG_HEADER') ) return;

// ATTEMPT TO OVERLOAD STRING FUNCTIONS
if( @extension_loaded('mbstring') )
{
  @ini_set('mbstring.func_overload', 2); // 6 or 7?
  @mb_internal_encoding("UTF-8");
}

// CHECK FOR PAGE VARIABLE
if( !isset($page) ) $page = "";

// DEFINE CONSTANTS
define('PG_DEBUG', TRUE);
define('PG_PAGE', TRUE);
define('PG_ROOT', realpath(dirname(__FILE__)));
define('PG_HEADER', TRUE);
define('PG_URL_ROOT', 'http://localhost/projects/');

// SET INCLUDE PATH TO ROOT OF SE
set_include_path(get_include_path() . PATH_SEPARATOR . realpath("./"));

// DEBUG
// SET ERROR REPORTING
if( PG_DEBUG )
{
	/*
  	ini_set('display_errors', TRUE);
  	error_reporting(E_ALL);
	*/
  	if( file_exists('./include/class_firephp.php') )
  	{
	    include './include/class_firephp.php';
	    $fb =& FirePHP::getInstance();
	    $fb->registerErrorHandler();
  	}
}
else
{
  	ini_set('display_errors', FALSE);
  	error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_USER_ERROR);
}

// BENCHMARK
include "include/class_benchmark.php";
$_benchmark = PGBenchmark::getInstance('default');

PG_DEBUG ? $_benchmark->start('total') : NULL;

PG_DEBUG ? $_benchmark->start('include') : NULL;

// INITIATE SMARTY
include "include/class_smarty.php";
$smarty =& PGSmarty::getInstance();
//$smarty->debugging = TRUE;

//ADD BY HIEUTV
require_once 'include/cache/memcache_config.php';
require_once 'include/cache/CGlobal.php';
require_once 'include/cache/CacheLib.php';
if(MEMCACHE_ON){
	CGlobal::$memcache_server=$memcache_server;
	require_once 'include/cache/memcache.class.php';
}

// INCLUDE DATABASE INFORMATION
include "include/database_config.php";

// INCLUDE CACHE/SESSION
include "include/cake/config.php";

include "include/class_admin.php";
include "include/class_user.php";
include "include/class_database.php";
include "include/class_datetime.php";
include "include/class_error.php";
include "include/class_log.php";
include "include/class_theme.php";
include "include/object.php";
include "include/filter/filterinput.php";
include "include/environment/uri.php";
include "include/environment/request.php";
include "include/class_settings.php";
include "include/functions_general.php";
include "include/functions_email.php";

// JS API MOD JSON FUNCTIONS
if(!function_exists('json_encode'))
{
  include_once "include/xmlrpc/xmlrpc.inc";
  include_once "include/xmlrpc/xmlrpcs.inc";
  include_once "include/xmlrpc/xmlrpc_wrappers.inc";
  include_once "include/jsonrpc/jsonrpc.inc";
  include_once "include/jsonrpc/jsonrpcs.inc";
  include_once "include/jsonrpc/json_extension_api.inc";
}

PG_DEBUG ? $_benchmark->end('include') : NULL;
PG_DEBUG ? $_benchmark->start('initialization') : NULL;

// INITIATE DATABASE CONNECTION
$database =& PGDatabase::getInstance();

// SET LANGUAGE CHARSET
$database->db_set_charset('utf8');

// GET SETTINGS
$settingClass = new PGSettings();
$setting = $settingClass->getSettings();
if (PGRequest::getCmd('session', '')) $settingMethod = $settingClass->getPaymentMethod(NULL, PGRequest::getCmd('session', ''));
else if (PGRequest::getCmd('order_session', '')) $settingMethod = $settingClass->getPaymentMethod(NULL, PGRequest::getCmd('order_session', ''));

// CREATE DATETIME CLASS
$datetime = new PGDatetime();

// CREATE URL CLASS
$uri = & PGURI::getInstance();

// CREATE REQUEST CLASS
//$request = new PGRequest();

// ENSURE NO SQL INJECTIONS THROUGH POST OR GET ARRAYS
$_POST = security($_POST);
$_GET = security($_GET);
$_COOKIE = security($_COOKIE);

// CREATE SESSION
$session_options = @unserialize($setting['setting_session_options']);
if( !empty($session_options) )
{
  if( !empty($session_options['storage']) ) Configure::write('Session.save', $session_options['storage']);
  if( !empty($session_options['name']) ) Configure::write('Session.cookie', $session_options['name']);
  if( !empty($session_options['expire']) ) Configure::write('Session.timeout', $session_options['expire']);
}

$session =& PGSession::getInstance(null, true);
$session->engine(@$session_options['storage'], $session_options);
if( defined('PG_SESSION_RESUME') && PG_SESSION_RESUME && isset($session_id) )
{
  $session->_userAgent = md5(env('HTTP_USER_AGENT') . Configure::read('Security.salt'));
  $session->id($session_id);
}

$session->start();

// CREATE USER OBJECT AND ATTEMPT TO LOG USER IN
$user = new PGUser();
$user->user_checkCookies();

// CREATE ADMIN OBJECT AND ATTEMPT TO LOG ADMIN IN
$admin = new PGadmin();
$admin->admin_checkCookies();
//PG_DEBUG ? $admin->admin_exists = true : null;

// CANNOT ACCESS USER-ONLY AREA IF NOT LOGGED IN
if( !$user->user_exists && substr($page, 0, 5) == "user_" ){
  	cheader("login.php?return_url=".$uri->current());
}else{
  PGTheme::add_css('./templates/css/users.css');
  PGTheme::add_css('./templates/css/general_user.css');
  PGTheme::add_css('./templates/admin/css/icon.css');
}

// CHECK USER'S PAGE OR NOT
$smarty->assign('page_style', substr($page,0,5)=="user_"?'user':'home');

PG_DEBUG ? $_benchmark->end('initialization') : NULL;

PG_DEBUG ? $_benchmark->start('page') : NULL;
?>
