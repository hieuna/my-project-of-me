<?
require_once ("inc_security.php");
$fs_table1 = "products_multi";

$url = base64_decode ( getValue ( "url", "str", "GET", base64_encode ( "listing.php" ) ) );
$record_id = getValue ( "record_id", "int", "GET", 0 );
$other = getValue ( "other", "int", "GET", 0 );
//kiem tra quyen co duoc sua xoa hay ko


checkRowUser ( $fs_table, $field_id, $record_id, $url );
delete_file ( $fs_table, $field_id, $record_id, "pro_picture", $fs_filepath );
$db_delete = new db_execute ( "UPDATE products_multi SET pro_picture = '' WHERE pro_id = " . $record_id );
unset ( $db_delete );

redirect ( $url );
?>