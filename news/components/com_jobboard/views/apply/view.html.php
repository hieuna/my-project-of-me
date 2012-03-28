<?php
/**
 * @package JobBoard
 * @copyright Copyright (c)2010 Tandolin
 * @license GNU General Public License version 2, or later
 */

defined('_JEXEC') or die('Restricted access');


jimport('joomla.application.component.view');

class JobboardViewApply extends JView
{
	function display($tpl = null)
	{
        jimport('joomla.utilities.date');
 	   	$this->_addScripts();
        $config = JRequest::getVar('config','');
		$this->assignRef('config', $config);
		$data = JRequest::getVar('data','');
        $this->assignRef('data', $data);
		$this->assign('setstate', JobBoardHelper::renderJobBoard());
        $this->assign('appl', JRequest::getVar('appl',''));
        $this->assign('id', JRequest::getVar('job_id',''));
        $this->assign('catid', JRequest::getVar('catid',''));
        $this->assign('errors', JRequest::getVar('errors',''));

        $document =& JFactory::getDocument();
        if($config->use_location) {
        	$job_location = ($data->country_name <> 'DB_ANYWHERE_CNAME')? ', '.$this->data->city : ', '.JText::_('WORK_FROM_ANYWHERE');
        } else $job_location = '';
         
        $document->setTitle($this->data->job_title. $job_location .' '.$this->data->post_date.' (UTC)');
		parent::display($tpl);
	}

	function _addScripts()
	{
	    $document =& JFactory::getDocument();
	    $document->addStyleSheet('components/com_jobboard/css/base.css');
	    $document->addStyleSheet('components/com_jobboard/css/apply.css');
	    $document->addScript('components/com_jobboard/js/submit.js');
	}
	
}

?>