<?php
/**
 * @package JobBoard
 * @copyright Copyright (c)2010 Tandolin
 * @license GNU General Public License version 2, or later
 */

defined('_JEXEC') or die('Restricted access');


jimport('joomla.application.component.view');

class JobboardViewShare extends JView
{
	function display($tpl = null)
	{
        jimport('joomla.utilities.date');
        
 	   	$this->_addScripts();
        $config = JRequest::getVar('config','');
		$this->assignRef('config', $config);
		$data = JRequest::getVar('data','');
        $this->assignRef('data', $data);
        $this->assign('id', JRequest::getVar('job_id',''));
		$this->assign('setstate', JobBoardHelper::renderJobBoard());
        $this->assign('catid', JRequest::getVar('catid',''));
        $this->assign('msg', JRequest::getVar('msg',''));

        $document =& JFactory::getDocument();
        if($config->use_location) {
        	$job_location = ($data->country_name <> 'DB_ANYWHERE_CNAME')? ', '.$this->data->city : ', '.JText::_('WORK_FROM_ANYWHERE');
        } else $job_location = '';
         
        $document->setTitle(JText::_('EMAIL_JOB').': '.$this->data->job_title.$job_location );
		parent::display($tpl);
	}

	function _addScripts()
	{
	    $document =& JFactory::getDocument();
	    $document->addStyleSheet('components/com_jobboard/css/base.css');
	    $document->addStyleSheet('components/com_jobboard/css/share.css');
	}
}

?>