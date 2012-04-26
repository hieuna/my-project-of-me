<? require_once("../classes/database.php")?>
<?
$visited_timeout = 15 * 60; //
$last_visited_time = getdate();
$last_visited_time = $last_visited_time[0];

//Kiem tra co session_id hay ko, neu co
if (session_id()!=""){
	
	$query = "REPLACE INTO active_users(au_session_id,au_last_visit) 
			  VALUES('" . session_id() . "'," . $last_visited_time . ")";
	$db_exec = new db_execute($query);		  
}

// Delete timeout
$query = "DELETE FROM active_users
		  WHERE au_last_visit < " . ($last_visited_time - $visited_timeout);
$db_exec = new db_execute($query);		  
// Update Count
$query = "SELECT count(*) AS count FROM active_users";
$db_count = new db_query($query);

$row = mysql_fetch_array($db_count->result);

echo translate_display_text("truc_tuyen") . " : " . (intval($row["count"]));
?>