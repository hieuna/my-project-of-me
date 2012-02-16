<?php
define('PER_MANAGE', 'manager');
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
			2 => 'add',
			3 => 'edit',
			4 => 'delete',
			5 => 'view',
			6 => 'publish',
			7 => 'unpublish',
			8 => 'refund',
			9 => 'export',
			10 => 'riskAuthenticated',
			11 => 'support'
		);
		
		$this->apl = array(
			1 => 'administrator',
			2 => 'manager site',
			3 => 'user site',
			4 => 'all site'
		);
		
		$this->pages = array(
			//'admin_users' => array(1, 2, 3, 4, 5),
			//'admin_orders' => array(1, 5, 6, 7, 8, 9, 10, 11, 12, 13),
			//'admin_errors' => array(1, 2, 3, 4, 6, 8, 9),
			//'admin_coupon' => array(1, 3, 4, 5),
			'admin_admins' => array(1, 2, 3, 5, 6, 7),
			'admin_sites' => array(1, 2, 3, 5, 6, 7),
			'admin_hotdeal' => array(1, 2, 3, 4, 5, 6, 7),
			'admin_customer_hotdeal' => array(1, 2, 3, 4, 5, 6, 7)
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
		global $admin_id, $admin_group, $admin_access;
		
		$aryAccess = array();

		$aryMethod = array_flip($this->atl);
		$actionId = $aryMethod[$action];
		if ($admin_id>0 && $admin_group == 1) return true;
		
		$page = str_replace("admin.", "admin_", $page);
		if ($admin_access) {
			$aryAccess = unserialize($admin_access);
			foreach ($aryAccess as $key=>$action_info) {
				if ($key == $page) {
					if (is_array($action_info) && in_array($actionId, $action_info)) {
						/*
						return true;
						break;
						*/
						return $action_info;
					}
				}
			}
		}
				
		return $action_info;
	}
	
}
