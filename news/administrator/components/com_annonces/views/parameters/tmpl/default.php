<?php/** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/
defined('_JEXEC') or die('Restricted access');
?>

<form action="index.php" method="post" name="adminForm">

<div id="config-document">
	<div id="page-validation">
		<?php require_once(dirname(__FILE__).DS.'vue_validation.html'); ?>
	</div>
	<div id="page-affichage">
		<?php require_once(dirname(__FILE__).DS.'vue_affichage.html'); ?>
	</div>
	<div id="page-style-css">
		<?php require_once(dirname(__FILE__).DS.'vue_style-css.html'); ?>
	</div>
	<div id="page-generale">
		<?php require_once(dirname(__FILE__).DS.'vue_general.html'); ?>
	</div>
</div>
		<?php echo JHTML::_( 'form.token' ); ?>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="id" value="1">
		<input type="hidden" name="option" value="com_annonces">
		<input type="hidden" name="controller" value="parameters">
</form>
