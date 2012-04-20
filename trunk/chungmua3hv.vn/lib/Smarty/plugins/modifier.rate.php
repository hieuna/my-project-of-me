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

function smarty_modifier_rate($numberRate, $personRate, $serviceRate='')
{
 	  
	for($i=1; $i<=5; $i++)
		{
			if($numberRate>=$i)
			{
				$str_point_rate.= "<img src='/images/icon_rate/".$personRate."_active.jpg' />&nbsp;";
			}
			elseif($i - intval($numberRate)==1 && $numberRate-intval($numberRate) >= 0.5)
			{
				
				$str_point_rate.= "<img src='/images/icon_rate/".$personRate."_active_half.jpg' />&nbsp;";
				
			}
			else
			{
				$str_point_rate.= "<img src='/images/icon_rate/".$personRate."_de_active.jpg' />&nbsp;";
			}
		}
		
		return $str_point_rate;	 
}

/* vim: set expandtab: */

?>
