<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty truncate modifier plugin
 *
 * Type:     modifier<br>
 * Name:     truncate<br>
 * Purpose:  Truncate a string to a certain length if necessary,
 *           optionally splitting in the middle of a word, and
 *           appending the $etc string or inserting $etc into the middle.
 * @link http://smarty.php.net/manual/en/language.modifier.truncate.php
 *          truncate (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param integer
 * @param string
 * @param boolean
 * @param boolean
 * @return string
 */
function smarty_modifier_href_link($mod='',$task='',$category='',$id='',$title='',$pages='',$filter='',$sort='',$tags='' , $query='',$ext='html')
{
	
	$href= "";
	$rewrite=true;
	if($rewrite=='true')
	{
		if($mod=='software' || $mod=='hardware'||$mod=='games'||$mod=='games'||$mod=='games')
		{
			if($category=='')
				$href.="$mod/";
			else
				$href.="$category/";
				
			if($title)
				{
					$href.="$id-$title.$ext";	
					
				}			
		}
		if($mod=='news' || $mod=='blog')
		{
			$href.="$mod/";
			
			if($category)
				if($title=='')
					$href.="$id-$category/";
				
			if($title)
				{
					$href.="$id-$title.$ext";	
					
				}			
		}		
		if($mod=='search')
			{
				$href.="$mod/";
				if($tags)
					$href.="$tags/";
			}
		if($filter)
		{
			
			$href.="$filter-";	
			
		}	
		if($sort)
		{
			
			$href.="$sort/";	
			
		}	
		if($pages)
		{
			
			$href.="$pages/";	
			
		}		
		if($query)
		{
			$href.= "?$query";
		}
	}
	else
	{
		if($mod)
		{
			$href.="?mod=$mod";
		}
		if($task)
		{
			$href.="&task=$task";
		}
		if($cid)
		{
			$href.="&cid=$cid";
		}		
		if($id)
		{
			$href.="&id=$id";
		}	
		if($filter)
		{
			$href.="&filter=$filter";
		}	
		if($sort)
		{
			$href.="&sort=$sort";
		}	
		
		if($page)
		{
			$href.="&pages=$pages";
		}
					
		if($query)
		{
			$href.= "&$query";
		}		
	}
	
	return $href;
}

/* vim: set expandtab: */

?>
