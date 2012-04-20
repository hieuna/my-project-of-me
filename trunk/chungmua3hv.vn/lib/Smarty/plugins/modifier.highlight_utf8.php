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
function smarty_modifier_highlight_utf8($keywords, $text_source, $utftext, $start_tag="<b class='xxx'>", $end_tag="</b>")
{	
	$str = $utftext;
	mb_internal_encoding('utf-8');
	$text = $text_source;
	
	if($keywords != '')
	{		
		$tmp= explode(" ", strtolower($keywords));
		$arr_key = array();
		foreach($tmp as $key)
		{
			if($key!="")
				$arr_key[]= $key;
		}
			
			
		if(count($arr_key) >1)
		{	
			for($i = 0; $i < count($arr_key)-1 ;$i++)
			{
				for($j = $i+1; $j < count($arr_key) ;$j++)
				{
					if(($pos1 = strpos($arr_key[$i],$arr_key[$j]))!==false)
					{
						if(strlen($arr_key[$i]) < strlen($arr_key[$j]))
						{
							$temp = $arr_key[$i];
							$arr_key[$i] = $arr_key[$j];
							$arr_key[$j] = $temp;
						}
					}
				}	
			}
		}	
		
		
		foreach($arr_key as $keyword)
		{			
			$offset = 0;
			
			while(($pos = strpos(strtolower($text),$keyword,$offset))!==false)
			{
				
				$temp_sub1 = substr($text,0,$pos);
				$temp_sub2 = substr($text,$pos,strlen($keyword));
				$temp_sub3 = substr($text,$pos + strlen($keyword),strlen($text) - $pos - strlen($keyword));
				
				$text = $temp_sub1.$start_tag.$temp_sub2.$end_tag.$temp_sub3;	
				
				$sub1 = mb_substr($str,0,$pos,'utf-8');
				$sub2 = mb_substr($str,$pos,strlen($keyword),'utf-8');
				$sub3 = mb_substr($str,$pos + strlen($keyword),mb_strlen($str,'utf-8') - $pos - strlen($keyword),'utf-8');
				$str = $sub1.$start_tag.$sub2.$end_tag.$sub3;
				
				$offset = $pos + strlen($keyword) + strlen($start_tag) + strlen($end_tag);				
			}
		}
	}
	return $str;
}

?>