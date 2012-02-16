<?php
include "../config/config.php";
include "../includes/define.table.php";

// INCLUDE DATABASE INFORMATION
include "../includes/database_config.php";

include "../includes/class_datetime.php";
include "../includes/class_database.php";
include "../includes/filter/filterinput.php";
include "../includes/environment/uri.php";
include "../includes/environment/request.php";
include "../includes/functions_general.php";


// INITIATE DATABASE CONNECTION
$database =& PGDatabase::getInstance();

// SET LANGUAGE CHARSET
$database->db_set_charset('utf8');

// CREATE URL CLASS
$PGRequest = new PGRequest();

// CREATE DATETIME CLASS
$datetime = new PGDatetime();

$task = PGRequest::getCmd('task', '');
if ($task == 'feauture_product'){
	$product_id		= PGRequest::getInt('product_id', 'GET', 0);
	$sql = "SELECT name FROM ".TBL_PRODUCT_FEAUTURE." WHERE product_id=".$product_id." ORDER BY product_option_value_id ASC";
	$result = $database->db_query($sql);
	echo '<select name="feauture[]" multiple="multiple" style="width:250px; height:200px;">';
	while ($row = $database->db_fetch_assoc($result)){
		echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
	}
	echo '</select>';
}