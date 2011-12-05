<?php
// ENSURE THIS IS BEING INCLUDED IN AN SE SCRIPT
defined('PG_PAGE') or exit();

PG_DEBUG&&is_object($_benchmark) ? $_benchmark->end('page') : NULL;
PG_DEBUG&&is_object($_benchmark) ? $_benchmark->start('shutdown') : NULL;

$permission = ($admin->admin_info['admin_access']) ? unserialize($admin->admin_info['admin_access']) : array();
if (count($permission)) {
	foreach ($permission as $key=>$perm) {
		if (count($perm) == 1 && !$perm[0]) {
			$permission[$key] = array();
		}
	}
}
// ASSIGN ALL SMARTY VARIABLES/OBJECTS AND DISPLAY PAGE
$smarty->assign('page', $page);
$smarty->assign('page_title', $page_title);
$smarty->assign('toolbar', $toolbar);
$smarty->assign_by_ref('database', $database);
$smarty->assign_by_ref('uri', $uri);
$smarty->assign_by_ref('setting', $setting);
$smarty->assign_by_ref('admin', $admin);
$smarty->assign_by_ref('permission', $permission);

// L?y giá tr? t? các class
$smarty->assign('pgThemeJs', PGTheme::get_js());
$smarty->assign('pgThemeCss', PGTheme::get_css());

if( PG_DEBUG&&is_object($_benchmark) )
{
  $_benchmark->end('shutdown');
  
  $smarty->assign('debug_uid', $_benchmark->getUid());
  $smarty->assign_by_ref('debug_benchmark_object', $_benchmark);
  
  $_benchmark->start('output');
}

$smarty->display("$page.tpl");

if(PG_DEBUG && is_object($_benchmark) && $admin->admin_exists && $admin->admin_info['admin_group'] == 1)
{
  	$_benchmark->end('output');
  	$_benchmark->end('total');
  
  	$smarty->assign('debug_benchmark', $_benchmark->getLog());
  	$smarty->assign('debug_benchmark_total', $_benchmark->getTotalTime());
  
  	// DEBUG CACHE
	$time_now 		= date('H:i:s - d-m-Y', TIME_NOW);
	$html_debug 	= CGlobal::$query_debug;
	$conn_debug 	= CGlobal::$conn_debug;

	$debug_cache = "<div style='text-align:center'><span style='color:#666;'>$conn_debug</span></div>";
	$debug_cache .= "<div align='center'><strong>Server IP address : <span style='color:red'>{$_SERVER['SERVER_ADDR']}</span> - Time now is : <span style='color:red'>{$time_now}</span></strong></div>";
	$debug_cache .= $html_debug;
	
	if(CGlobal::$error_handle){
		$debug_cache .= "<table width='95%' border='1' cellpadding='6' cellspacing='0' bgcolor='#FEFEFE'  align='center'>
		<tr><td style='font-size:14px' bgcolor='#EFEFEF'  align='center'>Payment Error handle</td></tr>
		".CGlobal::$error_handle."
		</table><br />\n\n";
	}

	$smarty->assign('debug_cache', $debug_cache);
	
  	// Save logging info
  	file_put_contents(PG_ROOT.'/log/'.$_benchmark->getUid().'.html', $smarty->fetch('debug.tpl'));
  	//file_put_contents(PG_ROOT.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR.$_benchmark->getUid(), $smarty->fetch('debug.tpl'));
}

exit();
?>