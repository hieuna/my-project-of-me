<?
require_once("../classes/database.php");
$db_visited = new db_query("SELECT vi_count FROM visited");
$row = mysql_fetch_array($db_visited->result);
$visited = translate_display_text("luot_truy_cap") . " : <b> " . number_format($row["vi_count"],0,".",",") . "</b>";
$db_visited->close();
unset($db_visited);
?>
<div align="left" style="padding:5px;"> &nbsp; <?=$visited?></div>
<div align="left" style="padding:5px;"> &nbsp; <? include("../includes/inc_active_user.php");?></div>
