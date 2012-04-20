<?php

require_once 'D:/AppServ/www/projects/chungmua3hv.vn/lib/htmlpurifier/library/HTMLPurifier.auto.php';
class security

{

    function secureSuperGlobalGET(&$value, $key)

    {

  		 $config = HTMLPurifier_Config::createDefault();
   		$purifier = new HTMLPurifier($config);
   		$_GET[$key] = $purifier->purify($_GET[$key]);        

			$_GET[$key] = htmlspecialchars(stripslashes($_GET[$key]));
        $_GET[$key] = str_ireplace("script", "blocked", $_GET[$key]);

        $_GET[$key] = mysql_escape_string($_GET[$key]);

        return $_GET[$key];

    
    
    }

   

    function secureSuperGlobalPOST(&$value, $key)

    {
		$config = HTMLPurifier_Config::createDefault();
   		$purifier = new HTMLPurifier($config);
   		$_POST[$key] = $purifier->purify($_POST[$key]);       

        $_POST[$key] = htmlspecialchars(stripslashes($_POST[$key]));

        $_POST[$key] = str_ireplace("script", "blocked", $_POST[$key]);

        $_POST[$key] = mysql_escape_string($_POST[$key]);

	
    
   	

 	
	return $_POST[$key];

    }

       

    function secureGlobals()

    {

        array_walk($_GET, array($this, 'secureSuperGlobalGET'));

        array_walk($_POST, array($this, 'secureSuperGlobalPOST'));

    }

}	

?>