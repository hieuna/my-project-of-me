<?php
defined('PG_PAGE') or die();

define('PER_MANAGE', 'manage');
define('PER_ADD', 'add');
define('PER_EDIT', 'edit');
define('PER_DELETE', 'delete');
define('PER_VIEW', 'view');
define('PER_UPDATE', 'update');

class PGAcl
{
	/**
	 * Access page list
	 * @var	array
	 */
	var $apl       = null;
	
	/**
	 * Access task list
	 * @var	array
	 */
	var $atl       = null;
	
	/**
	 * Access pages list
	 * @var	array
	 */
	var $pages       = null;
	
	/**
	 * Constructor
	 * @param array An arry of options to oeverride the class defaults
	 */
	function PGAcl()
	{
		$this->apl = $this->atl = $this->pages = array();

		$this->atl = array(
			1 => 'manage',
			2 => 'new',
			3 => 'edit',
			4 => 'delete',
			5 => 'view',
			6 => 'update',
			7 => 'detail',
			8 => 'publish',
			9 => 'unpublish',
			10 => 'refund',
			11 => 'export',
			12 => 'riskAuthenticated',
			13 => 'support'
		);
		
		$this->apl = array(
			1 => 'administrator',
			2 => 'manager site',
			3 => 'user site',
		);
		
		$this->pages = array(
			'admin_users' => array(1, 2, 3, 4, 5),
			'admin_orders' => array(1, 5, 6, 7, 8, 9, 10, 11, 12, 13),
			'admin_errors' => array(1, 2, 3, 4, 6, 8, 9)
		);
	}
	
	/**
	 * check permission of user
	 * @date created: 2010-09-29
	 * @param $type: type access for check
	 * return boolean true if pass and false if not pass
	 *
	 */
	function checkPermission($page, $action) {
		
		global $database;
		global $admin;
		
		$aryAccess = array();
		
		$aryMethod = array_flip($this->atl);
		$actionId = $aryMethod[$action];
		if ($admin->admin_super || $admin->admin_info['admin_group'] == 1) return true;
		
		if ($admin->admin_info['admin_access']) {
			$aryAccess = unserialize($admin->admin_info['admin_access']);
			foreach ($aryAccess as $key=>$action_info) {
				if ($key == $page) {
					if (is_array($action_info) && in_array($actionId, $action_info)) {
						return true;
						break;
					}
				}
			}
		}		
		
		return false;
	}
	
	/**
	 * show page error
	 * @date created: 2010-10-01
	 * @param $smarty: object smarty
	 * return void
	 */
	function showErrorPage($smarty) {
		$smarty->assign("error_header", "Lỗi truy cập");
		$smarty->assign("error_message", "Bạn không có quyền truy cập chức năng này");
		$smarty->assign("error_submit", "Quay lại");
		$page = "admin_error";
		include "admin_footer.php";
		exit();
	}
	
}
