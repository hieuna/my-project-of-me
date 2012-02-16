<?php
ob_start();
session_start();

include "config/config.php";
include "includes/define.table.php";

// INCLUDE DATABASE INFORMATION
include "includes/database_config.php";

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

$smarty	= new Smarty();
$smarty->template_dir	=	$template_root;
$smarty->compile_dir	=	$template_root_c;
$smarty->assign('http_root',$http_root);

//get background
$sql = "Select * From `banner_gateway` Where `pos`='MOBILE 0' Order by `id` desc LIMIT 0, 1;";
$result = mysql_query($sql);
 while ($row = mysql_fetch_array($result)) {
 	$filePath = $row{'file'};
 	$bg = $filePath;
 }
        
//search auto completed
$sql = "SELECT p.product_id AS product_id, p.price AS price, p.image AS image, d.name AS name FROM product AS p, product_description AS d WHERE p.product_id=d.product_id ORDER BY d.name ASC";
$result = mysql_query($sql);
$array = '';
$i = 0;
while ($row = mysql_fetch_array($result)){
	$i++;
	if ($i>1){
	$array .= ",";
	}
	$array .= '"'.$row["name"].'"';
}

$smarty->assign('bg', $bg);
$smarty->assign('array', $array);
$smarty->display($template_root.'/header.tpl');
?>
