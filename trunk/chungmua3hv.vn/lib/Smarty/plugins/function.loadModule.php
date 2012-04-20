<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * @param array Format:
 * <pre>
 * array('name' => name of module)
 * </pre>
 * @param Smarty
 */
function smarty_function_loadModule($params, &$smarty)
{
     $module = $params['name'];
	 $task = $params['task'];
	 $otherParams= $params['otherParams'];
     loadModule($module, $task, $otherParams);
}

/* vim: set expandtab: */

?>
