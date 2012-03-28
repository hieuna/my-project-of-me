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

class JobboardControllerEducation extends JController
{
	var $view;
	function add()
	{
		JToolBarHelper::title(JText::_( 'NEW_EDLEVEL'));
		JToolBarHelper::save();
		JToolBarHelper::cancel();

		JRequest::setVar('view','educationedit');
		$this->displaySingle('old');
	}

	function edit()
	{
		JToolBarHelper::save();
		JToolBarHelper::cancel();

		JRequest::setVar('view','educationedit');
		$this->displaySingle('old');
	}

	function remove()
	{
		$cid = JRequest::getVar( 'cid' , array() , '' , 'array' );
		JArrayHelper::toInteger($cid);

		$doc =& JFactory::getDocument();
		$style = " .icon-48-job_posts {background-image:url(components/com_jobboard/images/job_posts.png); no-repeat; }";
		$doc->addStyleDeclaration( $style );
		$this->setToolbar();

		global $option;
		if (count( $cid )) {
			$cids = implode( ',', $cid );
			$jobs_model= & $this->getModel('Education');
			$delete_result = $jobs_model->deleteEdlevels($cids);
			if ($delete_result <> true) {
				$this->setRedirect('index.php?option=' . $option . '&view=education', $delete_result);
			}
			else {
				$success_msg = (count($cid ) == 1)? JText::_('EDLEVEL_DELETED') : JText::_('EDLEVELS_DELETED');
				$this->setRedirect('index.php?option=' . $option . '&view=education', $success_msg);
			}
		}
	}

	function display() //display list of all users
	{
		$doc =& JFactory::getDocument();
		$style = " .icon-48-job_posts {background-image:url(components/com_jobboard/images/job_posts.png); no-repeat; }";
		$doc->addStyleDeclaration( $style );
		$view = JRequest::getVar('view');
		if(!$view)
		{
			JRequest::setVar('view', 'education');
		}
		$this->setToolbar($view);

		parent::display();
	}

	function displaySingle($type) //display a single User that can be edited
	{
		JRequest::setVar('view', 'educationedit');
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

	function setToolbar($view){
		JToolBarHelper::title(JText::_( 'EDUCATION_LEVELS'), 'job_posts.png');
		JToolBarHelper::deleteList();
		JToolBarHelper::addNewX();
		JToolBarHelper::editList();
		JToolBarHelper::back();
		//$selected = ($view == 'item7');
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
		JSubMenuHelper::addEntry(JText::_('EDUCATION_LEVELS'), $item7, true);
		JSubMenuHelper::addEntry(JText::_('DEPARTMENTS'), $item8);
		JSubMenuHelper::addEntry(JText::_('STATUSES'), $item9);
		JSubMenuHelper::addEntry(JText::_('SETTINGS'), $item10);
	}
}

$controller = new JobboardControllerEducation();
if(!isset($task)) $task = "display"; //cancel button doesn't pass task so may gen php warning on execute below
$controller->execute($task);
$controller->redirect();

?>