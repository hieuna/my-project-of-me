<? include ("config_security.php"); ?>
<? require_once("../../classes/database.php"); ?>
<?
$iOrd = 0;
if (isset($_GET["iOrd"])) $iOrd = $_GET["iOrd"];
$iOrd = intval($iOrd);
$db_del = new db_execute("DELETE
								  FROM orders
								  WHERE ord_id=" . $iOrd);
unset($db_del);
header("location: listing.php");
?>