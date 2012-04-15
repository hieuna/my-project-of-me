<?php
// ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Restricted access' );
function com_install() {

  if (!extension_loaded ('curl'))
  {
    echo ("<font color='red'>CURL extension not loaded. Please load the CURL extension in your PHP configuration.</font><br />");
  }

  if (!extension_loaded ('mcrypt'))
  {
    echo ("<font color='red'>MCRYPT extension not loaded. Please load the MCRYPT extension in your PHP configuration.</font><br />");
  }

  if (!ini_get ('short_open_tag'))
  {
    echo ("<font color='red'>short_open_tag in php.ini must be turned On.</font><br />");
  }

if (!@mkdir(JPATH_SITE .DS."images".DS."stories".DS."grabnews", 0777)) {
	echo "<font color='red'>Attention:</font><br />";
	echo "- Please set permissions 0777 (write) to images/stories/grabnews/<br />";
}	
	$content = '<p>Your component License Manager was installed successfull!</p>';

	return $content;
}
?>