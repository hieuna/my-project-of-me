<?php
// ENSURE THIS IS BEING INCLUDED IN AN SE SCRIPT
defined ( 'PG_PAGE' ) or exit ();

PG_DEBUG ? $_benchmark->end ( 'page' ) : NULL;
PG_DEBUG ? $_benchmark->start ( 'shutdown' ) : NULL;

// Token
if (! defined ( 'PG_PAGE_AJAX' )) {
	$token = md5 ( uniqid ( mt_rand (), true ) );
	$session->set ( 'token', $token );
	$smarty->assign ( 'token', $token );
}

// ASSIGN GLOBAL SMARTY OBJECTS/VARIABLES
$smarty->assign_by_ref ( 'error', errorGet () );
$smarty->assign_by_ref ( 'uri', $uri );
$smarty->assign_by_ref ( 'user', $user );
$smarty->assign_by_ref ( 'datetime', $datetime );
$smarty->assign_by_ref ( 'database', $database );
$smarty->assign_by_ref ( 'admin', $admin );
$smarty->assign_by_ref ( 'setting', $setting );
$smarty->assign ( 'global_page', $page );
$smarty->assign ( 'page_title', $page_title ? $page_title : 'Cổng thanh toán trực tuyến SohaPay' );
$smarty->assign ( 'global_page_title', (! empty ( $global_page_title ) ? $global_page_title : NULL) );
$smarty->assign ( 'global_page_description', (! empty ( $global_page_description ) ? str_replace ( "\"", "'", $global_page_description ) : NULL) );
//Tao URL Huy va Tiep tuc
$smarty->assign ( 'sessionCookie', PGRequest::getCmd ( 'sessionCookie', '', 'COOKIE' ) );
$smarty->assign('jsonUser', json_encode($user));

// Lấy giá trị từ các class
$smarty->assign('pgMessage', PGError::html());
$smarty->assign('pgThemeJs', PGTheme::get_js());
$smarty->assign('pgThemeCss', PGTheme::get_css());
$smarty->assign('pgThemeTitleRight', PGTheme::get_page_title_right());
$smarty->assign('pgBodyClass', PGTheme::get_body_class());
$smarty->assign('pgJsSettings', PGTheme::get_js_settings());

if (PG_DEBUG) {
	$_benchmark->end ( 'shutdown' );
	
	$smarty->assign ( 'debug_uid', $_benchmark->getUid () );
	$smarty->assign_by_ref ( 'debug_benchmark_object', $_benchmark );
	
	$_benchmark->start ( 'output' );
}

// DISPLAY PAGE
$smarty->display ( "$page.tpl" );

if (PG_DEBUG && $admin->admin_info ['admin_group'] == 1) {
	$_benchmark->end ( 'output' );
	$_benchmark->end ( 'total' );
	
	$smarty->assign ( 'debug_benchmark', $_benchmark->getLog () );
	$smarty->assign ( 'debug_benchmark_total', $_benchmark->getTotalTime () );
	
	// DEBUG CACHE
	$time_now = date ( 'H:i:s - d-m-Y', TIME_NOW );
	$html_debug = CGlobal::$query_debug;
	$conn_debug = CGlobal::$conn_debug;
	
	$debug_cache = "<div style='text-align:center'><span style='color:#666;'>$conn_debug</span></div>";
	$debug_cache .= "<div align='center'><strong>Server IP address : <span style='color:red'>{$_SERVER['SERVER_ADDR']}</span> - Time now is : <span style='color:red'>{$time_now}</span></strong></div>";
	$debug_cache .= $html_debug;
	
	if (CGlobal::$error_handle) {
		$debug_cache .= "<table width='95%' border='1' cellpadding='6' cellspacing='0' bgcolor='#FEFEFE'  align='center'>
		<tr><td style='font-size:14px' bgcolor='#EFEFEF'  align='center'>Payment Error handle</td></tr>
		" . CGlobal::$error_handle . "
		</table><br />\n\n";
	}
	
	$smarty->assign ( 'debug_cache', $debug_cache );
	
	// Save logging info
	file_put_contents ( './log/' . $_benchmark->getUid () . '.html', $smarty->fetch ( 'debug.tpl' ) );
}

exit ();
?>