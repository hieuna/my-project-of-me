<?php
defined('PG_PAGE') or die();

//  THIS CLASS CONTAINS URL-RELATED METHODS.
//  IT IS USED TO RETURN THE CURRENT URL AND CREATE NEW URLS
//  METHODS IN THIS CLASS:
//    se_url()
//    url_create()
//    url_current()
//    url_userdir()
//    url_encode()

class PGUrl
{

	// INITIALIZE VARIABLES
	var $is_error;			// DETERMINES WHETHER THERE IS AN ERROR OR NOT
	var $url_base;			// CONTAINS THE BASE URL TO WHICH FILENAMES CAN BE APPENDED
	//var $convert_urls;		// CONTAINS THE URL CONVERSIONS

	// THIS METHOD SETS THE BASE URL TO WHICH FILENAMES CAN BE APPENDED
	// INPUT:
	// OUTPUT: A STRING REPRESENTING A PATH TO WHICH FILENAMES CAN BE APPENDED TO CREATE URLs
  
	function PGUrl()
  	{
	  	global $database;
	    
	  	$server_array = explode("/", $_SERVER['PHP_SELF']);
	  	$server_array_mod = array_pop($server_array);
	  	if($server_array[count($server_array)-1] == "admin") 
	  	{ 
	  		$server_array_mod = array_pop($server_array); 
	  	}
	  	$server_info = implode("/", $server_array);
	  	$this->url_base = "http".(443==$_SERVER['SERVER_PORT']?'s':'')."://".$_SERVER['HTTP_HOST'].$server_info."/";
	}
  
  	// END PGUrl() METHOD
  
	// THIS METHOD RETURNS THE URL TO THE CURRENT PAGE
	// INPUT: 
	// OUTPUT: A STRING REPRESENTING THE URL TO THE CURRENT PAGE
	function url_current()
  	{
	  	$current_url_domain = $_SERVER['HTTP_HOST'];
	  	$current_url_path = $_SERVER['SCRIPT_NAME'];
	  	$current_url_querystring = $_SERVER['QUERY_STRING'];
	  	$current_url = "http://".$current_url_domain.$current_url_path;
	  	if($current_url_querystring != "") {  $current_url .= "?".$current_url_querystring; }
	  	$current_url = urlencode($current_url);
	  	return $current_url;
	}
  
  	// END url_current() METHOD

	// THIS METHOD RETURNS A URLENCODED VERSION OF THE GIVEN STRING
	// INPUT: $url REPRESENTING ANY STRING
	// OUTPUT: A STRING REPRESENTING A URLENCODED VERSION OF THE GIVEN STRING
	function url_encode($url)
  	{
	  	return urlencode($url);
	}
  	// END url_encode() METHOD
  
	function isValidURL($url)
	{
		return ( ! preg_match('/^(http|https):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $url)) ? FALSE : TRUE;	}
	}

?>
