<?php



		ob_start();



		session_start();

			

		//	print_r($_SESSION);

		

			

		$_SESSION["prefix_"]= session_id();

		ini_set("display_errors",1);

		include_once('classes/module.class.php');



		include_once('classes/db.class.php');



		include_once("config/common.php");		



		include_once("config/include_path.php");



		include_once("config/pear_db.php");	



		include_once("config/smarty.php");



		include("config/security.php");



		global 	$secure;

	$secure = new security();
	if($_GET['mod']!='admin')
			$secure->secureGlobals();

//		$expire=time()+60*60*24*30;

//		//	setcookie(_BUSINESS."USERID", $business["Business_ID"], time()+60*60*24*30);

				

		



		$mod = $_GET['mod'];



		//echo $_SESSION["lang_id"];



		if(!$_SESSION["theme"])		



			$_SESSION['theme']=DEFAULT_THEME;



		



		if($_GET['theme'] !="")



			$_SESSION['theme']=$_GET['theme'];



			



		if(!$_SESSION['lang_id'] || ($_GET['lang']!=''))



			getDefaultLang('vn');



		if($_GET["CID"])

			loadCity();

		



		updateSession();

		checkMultiLang();



		

		$oSmarty->config_load($_SESSION["lang_file"]);		



		$task = ($_GET['task'])?$_GET['task']:'';	





		if(isset($_GET['ajax'])){



			loadModule( $mod, $task );



		}else{



			loadModule("layout");



		}







?>