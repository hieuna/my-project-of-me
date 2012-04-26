<? require_once("../menu/config_security.php");?>
<?
$lang_id = 0;
if (isset($_GET["lang_id"])) $lang_id = $_GET["lang_id"];
$lang_id = intval($lang_id);
$db_language=new db_query("SELECT * FROM languages WHERE lang_id=" . $lang_id);
if($row=mysql_fetch_array($db_language->result)){
	$_SESSION["lang_id"] = $lang_id;
	$_SESSION["lang_path"] = $row["lang_path"];
}
Header( "HTTP/1.1 301 Moved Permanently" ); 
Header("Location: ../index.php" ); 	   
?>