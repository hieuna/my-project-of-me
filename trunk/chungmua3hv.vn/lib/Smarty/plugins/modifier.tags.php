<?php

function smarty_modifier_tags($tags)
{
   $tags = explode(";",$tags);

   foreach($tags as $tag)
   		{
			
			$str.=' '."<a href='/search/".strip_tags($tag)."/'>".$tag."</a>";
	
		}
		
	return $str;		
		
}


?>
