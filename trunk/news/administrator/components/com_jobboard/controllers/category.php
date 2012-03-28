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

class JobboardControllerCategory extends JController
{
	var $view;

	function __construct()
	{
		parent::__construct();
		$this->registerTask('unpublish', 'publish');
	}
	
	function add()
	{
		JToolBarHelper::title(JText::_( 'NEW_CATEGORY'));
		JToolBarHelper::save();
		JToolBarHelper::cancel();

		JRequest::setVar('view','categoryedit');
		$this->displaySingle('old');
	}

	function edit()
	{
		JToolBarHelper::title(JText::_( 'EDIT_CATEGORY'));
		JToolBarHelper::save();
		JToolBarHelper::cancel();

		JRequest::setVar('view','categoryedit');
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
		$undeletables = false;
		$count_cid = count( $cid );
		if ($count_cid) {
			for ($i=0; $i <= $count_cid; $i++) {
				if ($cid[$i] == 1){
					$un_deletable = $cid[$i];
					unset($cid[$i]);
					$undeletables = true;
				}
			}

				
			if($undeletables == false) {
				
				$success_msg = ($count_cid == 1)? JText::_('CATEGORY_DELETED') : JText::_('CATEGORIES_DELETED');
				$cids = implode( ',', $cid );
				$jobs_model= & $this->getModel('Category');
				$delete_result = $jobs_model->deleteCategories($cids);
				if ($delete_result <> true) {
					$this->setRedirect('index.php?option=' . $option . '&view=category', $delete_result);
				}
				else {
					$this->setRedirect('index.php?option=' . $option . '&view=category', $success_msg);
				}
			}
				
			if($undeletables == true) {
				$undel_messg = JText::_('ITEM_NO_DELETE').': #'.$un_deletable;
				if($count_cid == 1){
					$this->setRedirect('index.php?option=' . $option . '&view=category', $undel_messg);
				}else{
				    $success_msg = ($count_cid == 2)? JText::_('CATEGORY_DELETED') : JText::_('CATEGORIES_DELETED');
					$cids = implode( ',', $cid );
					$jobs_model= & $this->getModel('Category');
					$delete_result = $jobs_model->deleteCategories($cids);
					$success_msg .= '; '.$undel_messg;
					if ($delete_result <> true) {
						$this->setRedirect('index.php?option=' . $option . '&view=category', $delete_result);
					}
					else {
						$this->setRedirect('index.php?option=' . $option . '&view=category', $success_msg);
					}
				}
			}
		}
	}


	function setToolbar(){
		JToolBarHelper::title(JText::_( 'JOB_CATEGORIES'), 'job_posts.png');
		JToolBarHelper::deleteList();
		JToolBarHelper::publishList('publish', JText::_('CATEG_ACTIVATE') );
		JToolBarHelper::unpublishList('unpublish', JText::_('CATEG_DEACTIVATE') );
		JToolBarHelper::addNewX();
		JToolBarHelper::editList();
		JToolBarHelper::back();
//		$selected = ($view == 'item5');
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
		JSubMenuHelper::addEntry(JText::_('JOB_CATEGORIES'), $item5, true);
		JSubMenuHelper::addEntry(JText::_('CAREER_LEVELS'), $item6);
		JSubMenuHelper::addEntry(JText::_('EDUCATION_LEVELS'), $item7);
		JSubMenuHelper::addEntry(JText::_('DEPARTMENTS'), $item8);
		JSubMenuHelper::addEntry(JText::_('STATUSES'), $item9);
		JSubMenuHelper::addEntry(JText::_('SETTINGS'), $item10);
	}

	function display() //display list of all users
	{
		$doc =& JFactory::getDocument();
		$style = " .icon-48-job_posts {background-image:url(components/com_jobboard/images/job_posts.png); no-repeat; }";
		$doc->addStyleDeclaration( $style );

		JToolBarHelper::title(JText::_( 'JOB_CATEGORIES'), 'job_posts.png');
		JToolBarHelper::deleteList();
		JToolBarHelper::publishList('publish', JText::_('CATEG_ACTIVATE') );
		JToolBarHelper::unpublishList('unpublish', JText::_('CATEG_DEACTIVATE') );
		JToolBarHelper::addNewX();
		JToolBarHelper::editList();
		JToolBarHelper::back();
		$view = JRequest::getVar('view');
		if(!$view)
		{
			JRequest::setVar('view', 'category');
		}
		//$selected = ($view == 'item5');
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
		JSubMenuHelper::addEntry(JText::_('JOB_CATEGORIES'), $item5, true);
		JSubMenuHelper::addEntry(JText::_('CAREER_LEVELS'), $item6);
		JSubMenuHelper::addEntry(JText::_('EDUCATION_LEVELS'), $item7);
		JSubMenuHelper::addEntry(JText::_('DEPARTMENTS'), $item8);
		JSubMenuHelper::addEntry(JText::_('STATUSES'), $item9);
		JSubMenuHelper::addEntry(JText::_('SETTINGS'), $item10);

		parent::display();
	}

	function displaySingle($type) //display a single User that can be edited
	{
		JRequest::setVar('view', 'categoryedit');
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

	function publish()
	{
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$this->setRedirect( 'index.php?option=com_jobboard&view=category' );

		// Initialize variables
		$cid		= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$task		= JRequest::getCmd( 'task' );
		$publish	= ($task == 'publish');
		$cat_count	= count( $cid );

		if (empty( $cid )) {
			return JError::raiseWarning( 500, JText::_( 'NO_CATEGORIES_SELECTED' ) );
		}

		JArrayHelper::toInteger( $cid );
		$cids = implode( ',', $cid );
		$jobs_model= & $this->getModel('Category');
		$delete_result = $jobs_model->setPublishStatus($publish, $cids);

		if (!$delete_result) {
			return JError::raiseWarning( 500, $db->getError() );
		}
		if($cat_count == 1){
			$this->setMessage( JText::sprintf( $publish ? 'CATEGORY_PUBLISHED' : 'CATEGORY_UNPUBLISHED', $cat_count ) );
		} else {
			$this->setMessage( JText::sprintf( $publish ? 'CATEGORIES_PUBLISHED' : 'CATEGORIES_UNPUBLISHED', $cat_count ) );
		}
	}
}

$controller = new JobboardControllerCategory();
if(!isset($task)) $task = "display"; //cancel button doesn't pass task so may gen php warning on execute below
$controller->execute($task);
$controller->redirect();

?>