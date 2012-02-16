<?php
define('TIME_NOW',time());
define('MEMCACHE_ON', 1);
//my server
$server_list=array(
  'localhost/payment/'
  //'ungho.todo.vn/'
);
$memcache_server =  array(
  array("host"=>"192.168.6.27","port"=>"11666") //LIVE IP : 192.168.4.21 Port : 11222
);
define('MEMCACHE_ID','payment'); // dung lam ID phan biet session giua cac site mini shop
/*
 memcache - session memcache
 db - session database
 file - session file
*/
define('SESSION_TYPE' , '');
define('MEMCACHE_SESSION_HOST', "192.168.6.27");
define('MEMCACHE_SESSION_PORT', "11666");
define('_SESS_TIME_EXPIRE', "10800");

define('DIR_CACHE', "_cache/");
define('PAGE_CACHE_DIR',DIR_CACHE.'pages/');
define('PAGE_CACHE',1);
define('CACHE_ON', 1);
define('CACHE_DB', 1);
define('USER_ACTIVE_ON',1); // Bat acctive user qua email
?>