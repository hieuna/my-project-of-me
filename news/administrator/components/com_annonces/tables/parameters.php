<?php/** * @version		1.3 com_annonces - petites annonces $ * @package		simple_ads_-_petites_annonces * @copyright	Copyright (c) 2011 - All rights reserved. * @license		GNU/GPL * @author		Anthony JULOU * @author mail	ajulou@yahoo.fr * **/defined('_JEXEC') or die('Restricted access');
class Parameters extends JTable{	/**	 * Unique Key	 * @var int	 */	var $id					= "1";
	var $currency = "";
	var $published_days = 0;
	var $dateFormat = "";
	var $metric = "";
	var $headerBgColor = "";
	var $updateEmailNotification = 0;
	var $nbpage = 0;
	var $viewDetailLayout = "default";
	var $searchActive = 0;
	var $unableSubmitAdInList = 0;
	var $adminValidation = 0;		var $maxSize = 0;
	function Parameters(& $db) {		parent::__construct('#__annonces_parameters', 'id', $db);	}}
?>