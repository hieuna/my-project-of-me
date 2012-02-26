<?php
include "config/config.php";
include "includes/define.table.php";

include "includes/database_config.php";

include "includes/class_database.php";
include "includes/filter/filterinput.php";
include "includes/environment/uri.php";
include "includes/environment/request.php";
include "includes/functions_general.php";

// INITIATE DATABASE CONNECTION
$database =& PGDatabase::getInstance();

// SET LANGUAGE CHARSET
$database->db_set_charset('utf8');

// CREATE URL CLASS
$uri = & PGURI::getInstance();

$task		= PGRequest::GetCmd('task', '');
if ($task == 'change_price_color'){
	$color_id		= intval($_REQUEST["color_id"]);
	$sql = "SELECT price_color FROM ".TBL_PRODUCT_COLOR." WHERE color_id=".$color_id;
	$result = $database->db_query($sql);
	$row = $database->getRow($result);
	echo number_format($row["price_color"], 0, ".", ",");	
}
?>	