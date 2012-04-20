<?php	
	global $oSmarty;	
	if(!is_object($oSmarty))
	{	
		user_set_include_path("lib/Smarty");
			
		include("Smarty.class.php");
		$oSmarty= new Smarty();
	
		global $module;
		if(!$module)
			$module= "home";
		$oSmarty->template_dir= "templates";		
		$oSmarty->config_dir= "languages";
		//$oSmarty->config_load('en.conf');		
		$oSmarty->compile_dir= "templates_c";
		
		user_rollback_include_path();
	}
	
?>