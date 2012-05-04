<?php
/*
 * @version   3.1.0 Mon Apr 30 22:42:47 2012 -0700
 * @package   yoonique zoo shortcut plugin
 * @author    yoonique[.]net
 * @copyright Copyright (C) yoonique[.]net and all rights reserved.
 * @license   GPL v3
 */



// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin');

class plgSystemYoonique_zopim extends JPlugin
{
	function plgSystemYoonique_zopim(&$subject, $config)
	{
		parent::__construct($subject, $config);
		
	}
	
	function onAfterRender()
	{
		$app = &JFactory::getApplication();
		
		$zopim_id = $this->params->get('zopim_id', '');
		
		if($zopim_id == '' || $app->isAdmin()) {
			return;
		}

		$language_id = $this->params->get('language_id', '');

		$buffer = JResponse::getBody();

		$zopim = '$zopim';

		$zopim_widget = <<<EOF
<!--Start of yoonique.net Zopim Live Chat Script-->
<script type="text/javascript">window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set._.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');$.src='//cdn.zopim.com/?$zopim_id';z.t=+new Date;$.type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');</script><!--End of yoonique.net Zopim Live Chat Script-->
EOF;
		$zopim_language = <<<EOF
<script type="text/javascript">$zopim(function() { $zopim.livechat.setLanguage('$language_id'); });</script>
EOF;
	
		$buffer = str_replace ("</head>", $zopim_widget."</head>", $buffer);

		if ($language_id) {
			$buffer = str_replace ("</body>", $zopim_language."</body>", $buffer);
		}
		
		JResponse::setBody($buffer);
		
		return true;
	}
}
?>
