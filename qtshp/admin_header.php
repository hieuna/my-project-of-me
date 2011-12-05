<?php
// SET ERROR REPORTING
error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_USER_ERROR);
ini_set('display_errors', TRUE);

// CHECK FOR PAGE VARIABLE
if(!isset($page)) { $page = ""; }

// DEFINE SE PAGE CONSTANT
define('PG_DEBUG', TRUE);
define('PG_PAGE', TRUE);
define('PG_ROOT', realpath(dirname(dirname(__FILE__))));
define('PG_ADMIN_SAFE_MODE', false);

// SET INCLUDE PATH TO ROOT OF SE
set_include_path(get_include_path() . PATH_SEPARATOR . realpath("../"));

// SET ERROR REPORTING
if( PG_DEBUG )
{
  	//ini_set('display_errors', TRUE);
  	//error_reporting(E_ALL);
	
  	if( file_exists('include/class_firephp.php') )
  	{
	    include 'include/class_firephp.php';
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
include "include/class_validate.php";
include "include/class_database.php";
include "include/class_datetime.php";
include "include/class_navigation.php";
include "include/class_acl.php";
include "include/object.php";
include "include/filter/filterinput.php";
include "include/environment/uri.php";
include "include/environment/request.php";
include "include/class_settings.php";
include "include/functions_sites.php";
include "include/functions_payment.php";
include "include/functions_general.php";
include "include/functions_email.php";
include "include/class_transaction.php";

include "include/class_theme.php";

// JS API MOD JSON FUNCTIONS
if( !function_exists('json_encode') )
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
//$settingAccess = $settingClass->getAccess();
$settingPayment = $settingClass->getPaymentMethod();

// CREATE DATETIME CLASS
$datetime = new PGDatetime();

// CREATE URL CLASS
$uri = PGURI::getInstance();

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

// CREATE ADMIN OBJECT AND ATTEMPT TO LOG ADMIN IN
$admin = new PGAdmin();
$admin->admin_checkCookies();

// ADMIN IS NOT LOGGED IN AND NOT ON LOGIN PAGE
if($page != "admin_login" && $page != "admin_lostpass" && $page != "admin_lostpass_reset" && $admin->admin_exists == 0)
{
  	cheader("admin_login.php");
}

PG_DEBUG ? $_benchmark->end('initialization') : NULL;
PG_DEBUG ? $_benchmark->start('page') : NULL;

?>