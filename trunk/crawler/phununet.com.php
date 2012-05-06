<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" id="minwidth" >
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Thông kê kết quả crawl tin tức</title>
</head>
<body>
<?php
error_reporting(E_ALL ^E_NOTICE ^E_WARNING);
define('CPATH_BASE', dirname(__FILE__));
$site 	= 'Phununet.com';
$siteID = 4;
$limitUploadServer = 500;

include "include/database_config.php";
include "include/class_database.php";
include 'include/filterinput.php';
include "class/class.".$site.".php";
include('class/class.up2server.php');

// INITIATE DATABASE CONNECTION
$db =& SEDatabase::getInstance();

// SET LANGUAGE CHARSET
$db->database_set_charset('utf8');

$class = 'crawl_'.str_replace( ".","_", strtolower($site) );
$crawl = new $class();

$crawl->getAllCategories();

$crawl->getPages();

$crawl->getLinks();

$crawl->getAllContent();

$crawl->getAllCrawled();

$crawl->clean();

$up = new crawlUp2Server();
$up->web_source_id 	= $siteID;
$up->web_source_name= $site;
$up->limit_upload	= $limitUploadServer;

$up->getContents();
$up->getImages();
$up->upContents();
$up->getLogs();
$up->writeLogs();

echo $up->log;

$up->clean();
?>
</body></html>