<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty string_format modifier plugin
 *
 * Type:     modifier<br>
 * Name:     string_format<br>
 * Purpose:  format strings via sprintf
 * @link http://smarty.php.net/manual/en/language.modifier.string.format.php
 *          string_format (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_capcha($characters)
{
		$possible = '23456789BCDFGHJKMNPQRSTVWXYZ';
		
		$code = '';
		$i = 0;
		while ($i < $characters)
		{ 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		$_SESSION['security_code'] = $code;	
		return $code;
}

/* vim: set expandtab: */

?>
