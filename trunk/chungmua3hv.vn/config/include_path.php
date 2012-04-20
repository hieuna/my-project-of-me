<?php
		
function user_set_include_path($path="lib/PEAR")
{
	global $old_include_path;
	$old_include_path= ini_get("include_path");
	ini_set("include_path", SITE_DIR."$path");	
}

function user_rollback_include_path()
{
	global $old_include_path;
	ini_set("include_path", $old_include_path);
}

?>