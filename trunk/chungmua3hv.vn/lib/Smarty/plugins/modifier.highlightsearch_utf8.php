<?php
/*
* Smarty plugin
* ————————————————————-
* Type: modifier
* Name: highlight
* Version: 0.5
* Date: 2003-03-27
* Author: Pavel Prishivalko, aloner#telephone.ru
* Purpose: Highlight search term in text
* Install: Drop into the plugin directory
*
* Extended To 0.5 By: Alexey Kulikov
* Strips Tags for nice output, allows multiple term for highlight
* Modified and simplified to high light b2 searches by Donncha O Caoimh
* ————————————————————-
*/
function smarty_modifier_highlightsearch_utf8($keyword, $text, $start_tag='<b style="color: #fc5f00;">', $end_tag="</b>")
{	
	$str= $text;
	
	$arr= explode(" ", stripslashes($keyword));

	for($i=0; $i<count($arr); $i++)
		if($arr[$i]!=" ")
		{
		   $term = preg_quote($arr[$i]);
		   $str= preg_replace('/('.$term.')/i', $start_tag.'$1'.$end_tag, $str);   
		}
	return $str;
}

?>