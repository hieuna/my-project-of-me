<?php
	global $form;
	if(!is_object($form))
	{
		/*ini_set('display_errors', 1);
    	error_reporting(E_ALL);*/
    	
    	ini_set('include_path', PATH_SEPARATOR .SITE_DIR. 'lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
    	include_once('HTML/QuickForm.php');

	}
?>