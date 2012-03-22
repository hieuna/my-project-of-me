<?php
/** Mod ty gia thoi tiet cho website joomlaa
*** Cai dat don gian de hieu
*** Version 1.080911.654
*** Viet boi Le Duy. Website kiethuc.vn2up.com
*** Support duyle.2oco@gmail.com hoac tham khao tai website kienthuc.vn2up.com
**/
defined('_JEXEC') or die('Restricted access');
$doc =& JFactory::getDocument();	
$doc->addCustomTag('<link rel="stylesheet" href="modules/mod_gold/css/rategoldweather.css" type="text/css" />');
$doc->addCustomTag('<link rel="stylesheet" href="modules/mod_gold/css/securities.css" type="text/css" />');
$doc->addScript('http://vnexpress.net/Service/Gold_Content.js');
$doc->addScript('http://vnexpress.net/Service/Forex_Content.js');
$doc->addScript('http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js');
JHTML::script('grw.js','modules/'.$module->module.'/css/');
JHTML::script('jssecurities.js','modules/'.$module->module.'/css/');

$showGrw = $params->get('ShowGoldReatWeather');
$showSec = $params->get('ShowSecurities');

require(JModuleHelper::getLayoutPath('mod_gold',$params->get('layout')));//Start LOAD layout module



