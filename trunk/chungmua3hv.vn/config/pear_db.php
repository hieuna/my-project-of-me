<?php



	global $oDb;



	if(!is_object($oDb))



	{



		



		user_set_include_path("lib/PEAR");		



		$db_name= 'db_chungmua3hv';



		$user= "root";



		$pass= "ngockieuvan@vccorp.vn";



		require_once('DB.php');



		



		$oDb =&DB::connect("mysql://$user:$pass@localhost/$db_name");



		$oDb->setFetchMode(DB_FETCHMODE_ASSOC);



		user_rollback_include_path();



	}



?>