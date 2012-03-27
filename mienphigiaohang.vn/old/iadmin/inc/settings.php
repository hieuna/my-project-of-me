<?php
	require('../libs/Smarty.class.php');
	include('../includes/config.php');
	include('../includes/main.php');
	include('../includes/func.php');
	$smarty = new Smarty();
	
	$smarty->template_dir = 'templates/';
	$smarty->compile_dir = 'templates_c/';
	//$smarty->cache_dir = 'cache';
	$smarty->config_dir = 'configs';
	$smarty->assign('skinpath',"http://".$_SERVER['HTTP_HOST'].'/iadmin/templates');
//	$smarty->assign('codepath',$config['codepath']);
	$smarty->assign('domain',$config['domain']);
?>