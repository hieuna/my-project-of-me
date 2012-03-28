<?php
/**
 * @package JobBoard
 * @copyright Copyright (c)2010 Tandolin
 * @license GNU General Public License version 2, or later
 */

// Protect from unauthorized access
defined('_JEXEC') or die('Restricted Access');

//JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
jimport('joomla.application.component.controller');

class JobboardControllerStatuses extends JController
{
	var $view;
	function add()
	{
		JToolBarHelper::title(JText::_( 'NEW_STATUS'));
		JToolBarHelper::save();
		JToolBarHelper::cancel();

		JRequest::setVar('view','statusedit');
		$this->displaySingle('old');
	}

	function remove()
	{
		$cid = JRequest::getVar( 'cid' , array() , '' , 'array' );
		JArrayHelper::toInteger($cid);
		global $option;

		$doc =& JFactory::getDocument();
		$style = " .icon-48-job_posts {background-image:url(components/com_jobboard/images/job_posts.png); no-repeat; }";
		$doc->addStyleDeclaration( $style );
		$this->setToolbar();
		$un_deletable = array();
	
		$undeletables = false;
		$count_cid = count( $cid );
		if ($count_cid) {
			for ($i=0; $i <= $count_cid; $i++) {
				if ($cid[$i] == 1 || $cid[$i] == 6 || $cid[$i] == 7){
					$un_deletable[] = $cid[$i];
					unset($cid[$i]);
					$undeletables = true;
				}
			}


			if($undeletables == false) {

				$success_msg = ($count_cid == 1)? JText::_('STATUS_DELETED') : JText::_('STATUSES_DELETED');
				$cids = implode( ',', $cid );
				$jobs_model= & $this->getModel('Statuses');
				$delete_result = $jobs_model->deleteStatuses($cids);
				if ($delete_result <> true) {
					$this->setRedirect('index.php?option=com_jobboard&view=statuses', $delete_result);
				}
				else {
					$this->setRedirect('index.php?option=com_jobboard&view=statuses', $success_msg);
				}
			}

			if($undeletables == true) {
				$undel_messg = JText::_('ITEM_NO_DELETE').': #'.$un_deletable[0];
				if($count_cid == 1){
					$this->setRedirect('index.php?option=' . $option . '&view=statuses', $undel_messg);
				}else{
					$unDeletableCount = count($un_deletable);
				    $success_msg = ( ($count_cid == 2 && $unDeletableCount == 1) || ($count_cid <= 3 && $unDeletableCount > 1) )? JText::_('STATUS_DELETED') : JText::_('STATUSES_DELETED');
					$cids = implode( ',', $cid );
					$jobs_model= & $this->getModel('Statuses');
					$delete_result = $jobs_model->deleteStatuses($cids);
					if($unDeletableCount > 1) {
						for($i=1; $i < $unDeletableCount; $i++){
							$undel_messg .= ', #'.$un_deletable[$i];	
						}					  	
					}
					if($unDeletableCount == $count_cid) {
						$success_msg = $undel_messg;	
					} else {
						$success_msg .= '; '.$undel_messg;						
					}
					if ($delete_result <> true) {
						$this->setRedirect('index.php?option=com_jobboard&view=statuses', $delete_result);
					}
					else {
						$this->setRedirect('index.php?option=com_jobboard&view=statuses', $success_msg);
					}
				}
			}
		}
	}

	function setToolbar(){
		JToolBarHelper::title(JText::_( 'APPL_STATUSES'), 'job_posts.png');
		JToolBarHelper::deleteList();
		JToolBarHelper::addNewX();
		JToolBarHelper::editList();
		JToolBarHelper::back();
		//$selected = ($view == 'item9');
		// prepare links
		$item1 = 'index.php?option=com_jobboard&view=dashboard';
		$item2 = 'index.php?option=com_jobboard&view=jobs';
		$item3 = 'index.php?option=com_jobboard&view=applicants';
		$item4 = 'index.php?option=com_jobboard&view=messages';
		$item5 = 'index.php?option=com_jobboard&view=category';
		$item6 = 'index.php?option=com_jobboard&view=careerlevels';
		$item7 = 'index.php?option=com_jobboard&view=education';
		$item8 = 'index.php?option=com_jobboard&view=departments';
		$item9 = 'index.php?option=com_jobboard&view=statuses';
		$item10 = 'index.php?option=com_jobboard&view=config';
		// add sub menu items
		JSubMenuHelper::addEntry(JText::_('M_DASHBOARD'), $item1);
		JSubMenuHelper::addEntry(JText::_('M_JOBS'), $item2);
		JSubMenuHelper::addEntry(JText::_('JOB_APPLICANTS'), $item3);
		JSubMenuHelper::addEntry(JText::_('EMAIL_TEMPLATES'), $item4);
		JSubMenuHelper::addEntry(JText::_('JOB_CATEGORIES'), $item5);
		JSubMenuHelper::addEntry(JText::_('CAREER_LEVELS'), $item6);
		JSubMenuHelper::addEntry(JText::_('EDUCATION_LEVELS'), $item7);
		JSubMenuHelper::addEntry(JText::_('DEPARTMENTS'), $item8);
		JSubMenuHelper::addEntry(JText::_('STATUSES'), $item9, true);
		JSubMenuHelper::addEntry(JText::_('SETTINGS'), $item10);
	}
	function edit()
	{
		$doc =& JFactory::getDocument();
		$style = " .icon-48-applicant_details {background-image:url(components/com_jobboard/images/applicant_details.png); no-repeat; }";
		$doc->addStyleDeclaration( $style );

		JToolBarHelper::title(JText::_( 'EDIT_STATUS'), 'applicant_details.png');
		JToolBarHelper::back();
		JToolBarHelper::apply();
		JToolBarHelper::save();
		JToolBarHelper::cancel();
		/*
		 $status_model =& $this->getModel('Status');
		 $statuses = $status_model->getStatuses();
		 $departments = $status_model->getDepartments();
		 JRequest::setVar('statuses', $statuses);
		 JRequest::setVar('departments', $departments);*/

		JRequest::setVar('view','statusedit');
		$this->displaySingle('old');
	}

	function display() //display list of all users
	{
		$doc =& JFactory::getDocument();
		$style = " .icon-48-job_applicants {background-image:url(components/com_jobboard/images/job_applicants.png); no-repeat; }";
		$doc->addStyleDeclaration( $style );
		$this->setToolbar();

		$view = JRequest::getVar('view');
		if(!$view)
		{
			JRequest::setVar('view', 'statuses');
		}
		parent::display();
	}

	function displaySingle($type) //display a single User that can be edited
	{
		JRequest::setVar('view', 'statusedit');
		if($type='new') JRequest::setVar('task','add');
		parent::display();
	}

	function cancel()
	{
		//reset the parameters
		JRequest::setVar('task', '');
		JRequest::setVar('view','dashboard');

		//call up the dashboard screen controller
		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'controllers'.DS.'dashboard.php');
	}
}

$controller = new JobboardControllerStatuses();
if(!isset($task)) $task = "display"; //cancel button doesn't pass task so may gen php warning on execute below
$controller->execute($task);
$controller->redirect();

?>