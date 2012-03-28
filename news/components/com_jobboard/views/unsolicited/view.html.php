<?php
/**
 * @package JobBoard
 * @copyright Copyright (c)2010 Tandolin
 * @license GNU General Public License version 2, or later
 */

defined('_JEXEC') or die('Restricted access');


jimport('joomla.application.component.view');

class JobboardViewUnsolicited extends JView
{
	function display($tpl = null)
	{
 	   	$this->_addScripts();
        $config = JRequest::getVar('config','');
		$this->assignRef('config', $config);
        $this->assign('catid', JRequest::getVar('catid',''));
		$this->assign('setstate', JobBoardHelper::renderJobBoard());
        $this->assign('errors', JRequest::getVar('errors',''));

        $document =& JFactory::getDocument();
        $document->setTitle(JText::_('SUBMIT_YOUR_CV_RESUME'));
		parent::display($tpl);
	}

	function _addScripts()
	{
	    $document =& JFactory::getDocument();
	    $document->addStyleSheet('components/com_jobboard/css/base.css');
	    $document->addStyleSheet('components/com_jobboard/css/unsolicited_cv.css');
	    $document->addScript('components/com_jobboard/js/submit.js');
	}
	
}

?>