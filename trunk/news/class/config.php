<?php
error_reporting(E_ALL ^E_WARNING ^E_NOTICE);
define('CPATH_BASE', dirname(__FILE__));
// Defined DB
/*
define('DB_HOST', 'localhost');
define('DB_USER', 'tapchidn');
define('DB_PASSWORD', '2b677TWlB87e');
define('DB', 'tapchidn_01');
*/
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'ngockieuvan@vccorp.vn');
define('DB', 'database_projects');
// Kết nối db
$link = @mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die('Unable to establish a DB connection');
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $link);
mysql_select_db(DB,$link);