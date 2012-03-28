<?php
/**
 * @package JobBoard
 * @copyright Copyright (c)2010 Tandolin
 * @license GNU General Public License version 2, or later
 */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class JobboardViewDashboard extends JView
{
	function display($tpl = null)
	{
		$this->assign('jb_render', JobBoardHelper::renderJobBoardx());
		parent::display($tpl);
	}
	
}
?>