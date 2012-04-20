<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty url_friendy modifier plugin
 *
 * Type:     modifier<br>
 * Name:     url_friendly<br>
 * Purpose:  convert dynamic url to friendly url for SEO
 * @author   thanhnv
 * @param string dynamic_url
 * @return string friendly_url
 * 
 * @desc must include rewrite_url.php file first
 */

function smarty_modifier_url_friendly($string)
{
	$string= remove_marks($string);
	
	if($_SESSION["lang"]!=DEFAULT_LANG)
	{
		$urlPart = cutString($string, '?');
		//php self
		$self = $urlPart[0];
				
		//query string
		$params = $urlPart[1];
		
	//	$string= $self."?".$params;
		$string= $self."?lang=".$_SESSION["lang"]."&".$params;
	}
	
	if($_SESSION["theme"]!=DEFAULT_THEME)
	{
		$urlPart = cutString($string, '?');
		//php self
		$self = $urlPart[0];
				
		//query string
		$params = $urlPart[1];
		
	//	$string= $self."?".$params;
		$string= $self."?theme=".$_SESSION["theme"]."&".$params;
	}
	
	if(URL_FRIENDLY==true)
	{		
		return makeUrlFriendly($string);
	}
	else
	{
		return $string;
	}
}


?>
