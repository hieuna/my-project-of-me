<?php

abstract class VS_Module_Base
{
	public $db;
	public $smarty;
	public $VS_DB; //Bsg_Db
	
	public $dataGrid;
	public $test='a';
	public $islang;
	public $mod;
	public $lang_id;
	public $pk ;
	/**
	 * quick form config
	 * 
	 * @var object HTML Quick Form
	 * @var array $aElement
	 * @var array $aElementNotShow
	 * 
	 */
	public $quickForm;
	private $aElement = array();
	private $aElementNotShow = array();

	public function run($task){}
	public function getPageInfo($task){}
	
	public function __construct(&$pearDb=NULL, &$smarty= NULL)
	{
		global $oDb,$oSmarty;
		$this->db	= $pearDb;	
		$this->data= $oDb;
		$this->smarty = $smarty;
		$this->vsDb = new VS_DB($pearDb);
		$this->islang = $_SESSION['multilang'];
		$this->lang_id = $_SESSION['lang_id'];
		$this->mod = $_GET['atask']?$_GET['atask']:$_GET['amod'];
		$this -> arrAction = array(
			array(
				"task" => "add",
				"action" => "",
				"tooltip" => "Add record"		
			),	
			array(
				"task" => "edit",
				"text" => "Edit",
				"icon" => "edit.png",
				"action" => "",
				"tooltip" => "Edit record"		
			),		
			array(
			
				"task" => "delete",
				"text" => "Delete",
				"icon" => "delete.jpg",
				"confirm" => "Are you sure want to delete this item ?",
				"action" => "",
				"tooltip" => "Delete record"
			)
		);
	}
	
	/****************************FUNCTIONS FOR QUICK FORM*************************************/
	/**
	 * initForm
	 *
	 * @param string $task
	 * @param array $aElement
	 * @param string $formName
	 * @param string $method
	 * @param string $action
	 * @param string $target
	 * @param array $attributes
	 * @param boolean $trackSubmit
	 */
	
	public function initForm ($task, $aElement, $formName = '', $method = 'post', $action = '', $target = '', $attributes = null, $trackSubmit = false)
	{
		$this->quickForm = new HTML_QuickForm($formName, $method, $action, $target, $attributes, $trackSubmit);
		$this->quickForm->addElement('hidden', 'task', $task, array());
		
		$this->aElement = $aElement;
	}
	/**
	 * setNotShowElement
	 *
	 * @param array $array
	 */
	public function setElementNotShow ($array = array())
	{
		$this->aElementNotShow = $array;
	}
	
	public function setElementOrder ($arrayOrder = array())
	{
		$aElement = array();
		foreach ($arrayOrder as $element)
		{
			if($this->elementExisted($element))
			{
				$aElement[$element] = $this->aElement[$element];
			}
		}
		foreach ($this->aElement as $element=>$elementInfo)
		{
			if(!in_array($element, $arrayOrder))
			{
				$aElement[$element] = $this->aElement[$element];
			}
		}
		$this->aElement = $aElement;
	}
	
	public function insertElement ($after, $element, $elementInfo)
	{
		if($this->elementExisted($after))
		{
			$aElement = array();
			foreach ($this->aElement as $key=>$value)
			{
				$aElement[$key] = $value;
				if($key == $after)
				{
					$aElement[$element] = $elementInfo;
					break;
				}
			}
			$this->aElement = array_merge($aElement, $this->aElement);
		}
		if($after == 'AtBeginning')
		{
			$this->aElement = array_merge(array($element=>$elementInfo), $this->aElement);
		}
		//else if($after == 'AtEnd')
		else
		{
			$this->aElement[$element] = $elementInfo;
		}
	}
	
	public function elementExisted ($element)
	{
		return isset($this->aElement[$element]) ? true : false;
	}
	
	public function setFormData($aData)
	{
		$this->quickForm->setDefaults($aData);
	}

	/**
	 *  check array $GLOBALS['HTML_QUICKFORM_ELEMENT_TYPES']
	 *
	 */
	public function displayForm()
	{

		foreach ($this->aElement as $key=>$field)
		{
			if(!in_array($key, $this->aElementNotShow))
			{
				$label = $key;//will get from array language (language file)
				$type = $field['InputType'];
				switch($field['InputType'])
				{
					case 'group':
					case 'xbutton':
					case 'autocomplete':
					case 'hierselect':
					case 'html':
					case 'header':
					case 'advcheckbox':
					case 'password':
						break;
					case 'text':
					case 'textarea':
						$this->quickForm->addElement($type, $key, $label, $field['Attributes']);
						break;
					case 'checkbox':
						$this->quickForm->addElement($type, $key, $label, $field['Text'], $field['Attributes']);
						break;
					case 'radio':
						$this->quickForm->addElement($type, $key, $label, $field['Text'], $field['Value'], $field['Attributes']);
						break;
					case 'hidden':
						$this->quickForm->addElement($type, $key, $field['Value'], $field['Attributes']);
						break;
					case 'image':
						$this->quickForm->addElement($type, $field['Src'], $field['Attributes']);
						break;
					case 'file':
						$this->quickForm->addElement($type, $key, $label, $field['Attributes']);
						break;
					case 'select':
						$this->quickForm->addElement($type, $key, $label, $field['Options'], $field['Attributes']);
						break;
					case 'date':
					case 'datetime':
						$this->quickForm->addElement($type, $key, $label, $field['Options'], $field['Attributes']);
						break;
					case 'link':
						$this->quickForm->addElement($type, $key, $label, $field['Href'], $field['Text'], $field['Attributes']);
						break;
					case 'static':
						$this->quickForm->addElement($type, $key, $label, $field['Text']);
						break;
					case 'submit':
					case 'button':
					case 'reset':
						$this->quickForm->addElement($type, $key, $field['Value'], $field['Attributes']);
						break;
				}
			}
		}
		
		$this->quickForm->display();
	}
	
	/****************************FUNCTIONS FOR DATAGRID*************************************/
	public function redir($url)
	{
		if(!headers_sent())
		{
			header("Location: " . $url);
		}
		else 
		{
			echo "<script type='text/javascript' language='javascript'>location.href='{$url}'</script>";
		}
	}
	
	/**
	 * Kiểm tran trang thái có post dư liệu lên server không
	 *
	 * @return boolean
	 */
	
	public function isPost()
	{
		return (strtoupper($_SERVER['REQUEST_METHOD'])=='POST') ? true : false;
	}
	
	/*public function editor($id, $content, $att=array('width'=>'800', 'height'=>'300'))
	{
			
			
			require_once(SITE_DIR."lib/fckeditor/fckeditor.php");
			$editor = new FCKeditor($id) ;
			$editor->BasePath	= SITE_URL."/lib/fckeditor/";
			$editor->Value = $content; 
			$editor->Width=$att['width'];
			$editor->Height=$att['height'];
			//$editor->Config['SkinPath'] = SITE_URL."lib/fckeditor/editor/skins/office2003/";
			return $editor->Create();
			
	}*/	
	
	public function date_time($id, $value)
    {
		$path = '../lib';
        $str = '<link type="text/css" rel="stylesheet" href="'.$path.'/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></link>
                <script type="text/javascript" src="'.$path.'/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
                <script language = "javascript">var pathToImages = "'.$path.'/calendar/images/"; </script>
                ';

        $str .= '<input type="text" value="'.$value.'" readonly name="'.$id.'"><input type="button" value="Select" onclick="displayCalendar(document.forms[0].'.$id.',\'yyyy-mm-dd hh:ii\',this,true)">';

        return $str;
    }

    public function date($id, $value)
    {
		$path = '../lib';
        $str = '<link type="text/css" rel="stylesheet" href="'.$path.'/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></link>
                <script type="text/javascript" src="'.$path.'/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20081212"></script>
                <script language = "javascript">var pathToImages = "'.$path.'/calendar/images/"; </script>
                ';

        $str .= '<input type="text" value="'.$value.'" readonly name="'.$id.'"  id="'.$id.'" ><input type="button" value="Select" onclick="displayCalendar(document.forms[0].'.$id.',\'yyyy-mm-dd\',this)">';

        return $str;
    }
    /*
		// get rolls of user.
		@ Date create : 21-08-2008
		@ Author : Khanhnk
		@ Paramater :
			1. $actions : Array of action to check
			2. $modul : Modul's Name with this actions.
			3. $group_id : Id group of user checked.
	*/
	public function getAction($actions=array(),$modul='',$group_id=0)
	{	
	
	
	$result = array();
		if($group_id == '1'){
			return $actions;
		}else{
			$sql = "SELECT roll_name FROM bsg_roll r WHERE 
					exists(SELECT roll_id FROM bsg_module_roll mr WHERE mr.roll_id = r.roll_id AND 
					exists(SELECT module_id FROM bsg_module WHERE module_id=mr.module_id and module_Link = '$modul')
					AND exists(SELECT module_roll_id FROM bsg_group_module_roll WHERE module_roll_id= mr.roll_id and user_group_id = '$group_id') ) ";

			$tasks = $this -> db -> getCol($sql);

			if($tasks){
				foreach($actions as $action){
					if(in_array($action['task'],$tasks))
					{
						$result[] = $action;
						$check = null;
					}
				}
			}
			
			return $result;
		}
	
	}
    /*
		// loadJs.
		@ Date create : 1-10-2008
		@ Author : Hoinq
		@ Paramater :
			1. $str_js : list string space ','
	*/	
	
	function loadJs($str_js)
	{
			$arr_js=explode(',',$str_js);
			if($_GET['task'] != 'ajax_title_type' && !isset($_GET['ajax']))				
				{
					foreach($arr_js as $js)
					echo '<script type="text/javascript" src="/admin/modules/'.$_GET['mod'].'/js/'.$js.'"></script>';
				}	
	}
	/*
		// ChangeOption.
		@ Date create : 1-10-2008
		@ Author : Hoinq
		@ Paramater :
			1. $arr_option : array option
	*/	
	function changeOption($arr_option, $str='')
	{
			if ($arr_option) {
				if($str!='')
					$option.='<option value ="">'.$str.'</option>';
				foreach ($arr_option as $key => $value) {
					$option .='<option value = "'.$key.'">'.$value.'</option>';
				}
			}			
	echo $option;
	}
	function getOption($arr_option, $name='', $root='',$selected='')
	{
		$str="<select name=".$name." id=".$name."'_id'>";
			if ($arr_option) {
				if($str!='')
					$str.='<option value ="0">'.$root.'</option>';
				foreach ($arr_option as $key => $value) {
					if($selected==$key)
							$selected='selected="selected"';
					$str .='<option value = "'.$key.'" '.$selected.'>'.$value.'</option>';
				}
			}
		$str .='</select>';
		return $str;
	}
	function redirect($url,$type="location") {
		$url = $url!='' ? $url : $this->url;
		echo '<script language = "javascript">
				location.href = "'.$url.'";
				</script>
		';
	}
	function get_config_vars ($var = '', $default = '') {
		global $oSmarty;
		$value = $oSmarty->get_config_vars($var);
		
		if ($value != '') {
			return (string) $value;
		} else {
			return $default;
		}
	}
	function getRootPath ($default = '') {
		if ($default != '') {
			return $default;
		}
		$sub = isset($_GET['sub']) ? $_GET['sub'] : NULL;
		$mod = isset($_GET['mod']) ? $_GET['mod'] : NULL;
		$task = isset($_GET['task']) ? $_GET['task'] : NULL;
		if ($sub) {
			$root_Path=$this->get_config_vars($sub . "_sub_root_path");
		}
		if($task) {
			$root_Path=$this->get_config_vars($task."_task_".$sub."_root_path");
			
		}
		$root_path = str_replace(">","<span style='postision:absolute;top:0px;'><img src='/admin/images/root.gif' border='0' style='cursor:pointer;' /></span>",$root_Path);
		 $str = "
                    <style>
                        html,body, td{
                            margin:0px;
                            overflow:auto;
                            font-family:Arial, Helvetica, sans-serif;
                            font-size:12px;
                        }

                        #root
                        {
                            width: 100%;
                            height: 29px;
                            text-align: left;
                            font-weight: bold;
                          	background-color:#F2F1F1;
							color:#000049;
							border-bottom:1px solid #D0D4D2;
                        }
                    </style>
                    <table cellspacing='0' cellpadding='0' width='100%'>
                        <tr>
                            <td valign='middle' id='root'>

                                &nbsp;&nbsp;".$root_path."
                            </td>
                        </tr>
                    </table>
                ";

      
		if(!isset($_GET['ajax']))						
			echo $str;
					
	}
	
	/*
		// get Path .
		@ Date create : 2008-21-1
		@ Author : Khanhnk
		@ Paramater :
			1. $sRawPath : Raw Path. Replace character >> to image seperator.
	*/	
	function getPath( $sRawPath = ''){
		$root_path = str_replace(">>","<span style='postision:absolute;top:0px;'><img src='".SITE_URL."lib/datagrid/templates/images/root3.gif' border='0' style='cursor:pointer;' /></span>",$sRawPath);
		
		 $str = "   <table cellspacing='0' cellpadding='0' width='100%'>
                        <tr>
                            <td valign='middle' id='root' style='background:#DFE8F6; border-bottom:1px solid #99BBE8'>

                                &nbsp;&nbsp;".$root_path."
                            </td>
                        </tr>
                    </table>
                ";
		if(!isset($_GET['ajax']))						
			echo $str;
	}
	
	/*
		// get Action .
		@ Date create : 2008-21-1
		@ Author : Khanhnk
		@ Paramater :
			1. $action: action in form. Default will get Action: Add, Edit, Delete
	*/	
	function getAct( $action=''){
		if(!$action){
			$act1 = $this-> getActionAdd();
			$act2 = $this-> getActionEdit();
			$act3 = $this-> getActionDelete();
			$result = array( $act1,	$act2,$act3	);
		}else{
			$action = strtolower( $action );
			switch( $action ){
				case 'add':
					$result = $this-> getActionAdd();
					break;
				case 'edit':
					$result = $this-> getActionEdit();
					break;				
				case 'delete':
					$result = $this-> getActionDelete();
					break;
				default: $result = $this -> getActionOther( $action );
					break;
			}
		}
		
		return $result;
	}
	function getAct1( $action=''){
		if(!$action){
			$act2 = $this-> getActionEdit();
			$act3 = $this-> getActionDelete();
			$result = array( $act2,$act3	);
		}else{
			$action = strtolower( $action );
			switch( $action ){
				case 'edit':
					$result = $this-> getActionEdit();
					break;				
				case 'delete':
					$result = $this-> getActionDelete();
					break;
				default: $result = $this -> getActionOther( $action );
					break;
			}
		}
		
		return $result;
	}
	
	function getActionOther( $action ){
		global  $oDb;
		$sql = "select id from tbl_roll where name='{$action}'";
		$rollId = $oDb -> getOne( $sql );
		if( !$rollId ) return "No Permission";
		if( $this -> checkPermission( $rollId ))
			return  array(
				"task" => $action
			);
		else return array();
	}
	
	function checkPermission( $rollId ){		
		global $oDb;
		$link = "amod={$_GET['amod']}";
		if( $_GET['atask'] ) $link.= "&atask={$_GET['atask']}";
		$userTypeId = $_SESSION[$_SESSION["prefix_"]]['user_type'];
		if( $userTypeId == 1) return  true;
		$sql = "select t1.id from tbl_module_roll t1 join admin_menu t2 on(t1.module_id = t2.id) where t1.roll_id = '{$rollId}' and t2.link = '{$link}' and t2.showed='1' ";
		$moduleRoll = $oDb -> getOne( $sql );
		
		if( $moduleRoll ){
			$sql = "select id from tbl_usertype_moduleroll where module_roll_id = '{$moduleRoll}' and user_type_id ='{$userTypeId}'";
			$checked = $oDb -> getOne( $sql );
			if( $checked ) return true;
			else  return false;
		}else{
			return false;
		}
	}
	
	function getActionAdd(){
		if( $this-> checkPermission( 1 )||$_SESSION[SESSION_PREFIX.'user_type']==1)
		return $result = array(
					"task" => "add",
					"icon"=>"add.png",
					"tooltip" => "Add Item"		
				);
		else 
			return array();
	}
	
	function getActionEdit(){
		if( $this-> checkPermission( 2 )||$_SESSION[SESSION_PREFIX.'user_type']==1)
		return $result = array(
					"task" => "edit",
					"icon" => "icon_edit.gif",
					"tooltip" => "Edit Item"		
				);
		else 
			return  array();
	}

//--------------------------------------------------------------------------------------------------------------/	
	
	function getActionDelete(){
		if( $this-> checkPermission( 4 )||$_SESSION[SESSION_PREFIX.'user_type']==1)
		return $result = array(
					"task" => "delete",					
					"icon" => "delete.jpg",
					"confirm" => "Are you sure want to delete this item ?",
					"tooltip" => "Delete Item"		
				);
		else 
			return  array();
	}
	
//--------------------------------------------------------------------------------------------------------------/	
	function showFlash( $file,$type='', $attribute = array("width" => 150, "height" => 110) ){
		switch($type){
			case "swf":
				$str = "<object style=\"cursor:pointer;\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=0,0,0,0\" width=\"{$attribute['width']}\" height=\"{$attribute['height']}\" ><param name=\"movie\" value=\"{$file}\" /><param name=\"allowScriptAccess\" value=\"sameDomain\" /><param name=\"quality\" value=\"high\" /><embed  style=\"cursor:pointer;\" src=\"{$file}\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"{$attribute['width']}\" height=\"{$attribute['height']}\" ></embed></object>";
			break;
			case "gif": case "jpg": case "png":
			$str="<img src=\"{$file}\" style=\"width:{$attribute['width']}px; height:{$attribute['height']}px\" border=\"0\">";
			break;
			
			
			default:
				echo"";
		}
		
		return $str;
	}

//--------------------------------------------------------------------------------------------------------------/

	function multiLevel( $table, $pkey, $parent, $sql_select = '*', $where = '', $order=''){
		$aResult = array();		
		$this -> getCategoryMultiLevel($aResult, 0, 0, $table, $pkey, $parent, $sql_select, $where, $order );		
		return  $aResult;
	}

//--------------------------------------------------------------------------------------------------------------/
	function getCategoryMultiLevel( &$aRef, $parentId, $level=0, $table, $pkey, $parent, $sql_select, $where='' , $order='' ){
		global  $oDb ;
		if( $where ) $condition = " and {$where}";
		if( $order ) $condition .= " order by {$order}";
		
		if( $level == 0)
			$sql = "SELECT {$sql_select} FROM {$table} WHERE (`{$parent}` = '0' or `{$parent}` is NULL) {$condition}";
		else
			$sql = "SELECT {$sql_select} FROM {$table} WHERE `{$parent}` = '{$parentId}' {$condition}";
		
		$result = $oDb -> getAll( $sql );	 		
		if( $result ){
			if( $level > 0)
				$aRef[count($aRef)-1]['hashchild'] = true;
			foreach ( $result as $key => $val){
				$val['level'] = $level;				
				$aRef[] = $val;				
				$this -> getCategoryMultiLevel( &$aRef, $val[$pkey], $level + 1, $table, $pkey, $parent, $sql_select, $where, $order  );
			}
		} 
	}
	
//--------------------------------------------------------------------------------------------------------------/
	
	function getPrefix( $level ){
		$prefix = "&emsp;&emsp;";
		return str_repeat( $prefix, $level );
	}
	
//--------------------------------------------------------------------------------------------------------------/
	
	
	/**
	* assign variable to smarty
	* @author: bsg.vn
	* @return: string
	*/
	function assign($var, $value) {
		$this->smarty->assign ($var, $value);
	}
	function fetch($var) {
		return $this->smarty->fetch ($var);
	}
	function getAll($sql) {
		return $this->db->getAll($sql);
	}
	function getRow($sql) {
		return $this->db->getRow($sql);
	}
	function query($sql) {
		return $this->db->query($sql);
	}
	function getOne($sql) {
		return $this->db->getOne($sql);
	}
	function getCol($sql) {
		return $this->db->getCol($sql);
	}
	function getAssoc($sql) {
		return $this->db->getAssoc($sql);
	}
	
	function encode($string) {
		return encode($string);
	}
	
	function decode($string) {
		return decode($string);
	}
	
	/**
	* assign variable to smarty
	* @author: bsg.vn
	* @return: string
	*/
	function display($file) {
		$this->smarty->display($file);
	}
//---------------------------------------------------------------------------------------------------------------/
/**
 * get array value of language
 *
 * @return array
 */
	function getAssocLang(){
		$arrLang = $this->db->getAssoc("SELECT id, name FROM lang order by isdefault desc");
		if ($this->islang)
			return  $arrLang;
		else 
		{
			foreach ($arrLang as $key=>$value)
			{
				$arrOneLang[$key] = $value;
				break;
			}
			return  $arrOneLang;
		}
	}
	
//---------------------------------------------------------------------------------------------------------------/
	/**
	 * Get value of language default
	 *
	 * @return interger;
	 */
	function getLangDefault()
	{
		return $this->db->getOne("SELECT id FROM lang order by isdefault desc");
	}
//---------------------------------------------------------------------------------------------------------------/
	/**
	 * Get of url in paging
	 * @author annx@bsg.vn
	 * @return unknown
	 */
	function setUrl(){
		$url =substr(SITE_URL,-1,-1).$_SERVER['REQUEST_URI'];
		if($_GET['page'])
			$url = str_replace("page,{$_GET['page']}/",'',$url);
		return $url .="page,i++/"; 		
		
	}
	function checkLogin(){
		if($_SESSION[_BUSINESS]["USERID"] == "" and $_SESSION[_BUSINESS]["USERNAME"] ==""){
			//$this->redirect(SITE_URL."login");
			return 0;
		}else
			return 1;
	}
	function checkMember(){
		if($_SESSION[_BUSINESS]["USERID"] != "" and $_SESSION[_BUSINESS]["USERNAME"] !=""){
			
			$this->redirect(SITE_URL);
		}
	}
	function formatBytes($b,$p = null) {
    /**
     *
     * @author Martin Sweeny
     * @version 2010.0617
     *
     * returns formatted number of bytes.
     * two parameters: the bytes and the precision (optional).
     * if no precision is set, function will determine clean
     * result automatically.
     *
     **/
    $units = array("B","kB","MB","GB","TB","PB","EB","ZB","YB");
    $c=0;
    if(!$p && $p !== 0) {
        foreach($units as $k => $u) {
            if(($b / pow(1024,$k)) >= 1) {
                $r["bytes"] = $b / pow(1024,$k);
                $r["units"] = $u;
                $c++;
            }
        }
        return number_format($r["bytes"],2) . " " . $r["units"];
    } else {
        return number_format($b / pow(1024,$p)) . " " . $units[$p];
    }
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
	function checkCookies(){
			global $oDb,$oSmarty;
		if($_COOKIE[_BUSINESS."USERID"]){
		 	$id= intval($_COOKIE[_BUSINESS."USERID"]);
			$checksss= $oDb->getRow("select * from tbl_cookies where Cookies_UserID ='{$id}'");
			if($checksss["Cookies_Remember"]=='1'){
					$business = $oDb->getRow("select Business_ID,Business_Email,Business_Password,Business_GroupID, Business_Photo, Business_TypeAcc,Business_AliasName from tbl_business where Business_ID ='".$checksss["Cookies_UserID"]."'");
					$_SESSION[_BUSINESS]["USERID"] = $business["Business_ID"];
					$_SESSION[_BUSINESS]["CATEGORY"] = $business["Business_GroupID"];
					$_SESSION[_BUSINESS]["USERNAME"] = $business["Business_Email"];
					$_SESSION[_BUSINESS]["ALIASNAME"] =$business["Business_AliasName"];
					$_SESSION[_BUSINESS]["TYPEACC"] =$business["Business_TypeAcc"];
					$_SESSION[_BUSINESS]["AVATAR"] =$business["Business_Photo"];	
			}
		}
	}
	
	function rand_str($length = 32, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890')
	{
		// Length of character list
		$chars_length = (strlen($chars) - 1);
	
		// Start our string
		$string = $chars{rand(0, $chars_length)};
	   
		// Generate random string
		for ($i = 1; $i < $length; $i = strlen($string))
		{
			// Grab a random character from our list
			$r = $chars{rand(0, $chars_length)};
		   
			// Make sure the same two characters don't appear next to each other
			if ($r != $string{$i - 1}) $string .=  $r;
		}
	   
		// Return the string
		return $string;
	}	
	function getDetailObject($id) {
		return  $this-> vsDb ->getRow($id);
	}
	function sendMail($type="reg",$subject="",$to="nobody@domain.com",$link="",$ps="")
	{
		
		switch($type)
		{
			case 'reg':
				$ct = 'Bạn hoặc một ai đó đã sử dụng địa chỉ email này để đăng ký tài khoản tại chungmua3hv.vn.
Nếu bạn không tạo tài khoản trên chungmua3hv.vn, vui lòng bỏ qua nội dung của email này, lệnh sẽ được huỷ trong vòng 24 giờ. ';	
				$content = "<p><strong>Xin chào quý khách,</strong></p>
<p>Bạn vừa đăng ký thành viên trên website chungmua3hv.vn. Email được gửi đến bạn để xác thực việc đăng ký của bạn.</p>
<p>Để kích hoạt tài khoản của bạn xin mời bạn <a href=\"{$link}\">Nhấn vào đây</a><br/>
		Trong trường hợp trình duyệt web không tự chuyển được vui lòng copy {$link} vào trình duyệt và nhấn Enter.";
			break;
			case 'forgot':
				$ct = 'Chungmua3HV xin gửi lại bạn link kích hoạt để đặt lại mật khẩu mới.';
				$content = "<p><strong>Xin chào quý khách,</strong></p><div style=\"background:#fff; margin-bottom: 10px; padding:10px; border:1px solid #CCC; font-size:13px;\">Vui lòng bấm <a href=\"{$link}\">vào đây</a> để đặt lại mật khẩu.</div>";
			break;
			case 'sendorder':
				$ct = 'Chungmua3HV xin gửi bạn thông tin đơn hàng.';
				$content = $link;
			break;
		}
				require("lib/phpmailer/class.phpmailer.php");
				$mail = new PHPMailer();
				$msp = $this->get_config_vars('company_email');
				$company = $this->get_config_vars('company_name');
				$address = $this->get_config_vars('company_address');
				$phone = $this->get_config_vars('company_phone');
				$mail->IsSendmail(); // telling the class to use SendMail transport
				$mail->FromName = "Chungmua3HV";
				$mail->From = "sales@chungmua3hv.vn";
				$mail->Sender="sales@chungmua3hv.vn";
				$mail->Host = "chungmua3hv.vn";
				//$mail->AddAddress("dinhhungvn@gmail.com", "Josh Adams");
				$mail->AddAddress($to);                  // name is optional
				$mail->AddReplyTo($msp, "Hỗ trợ khách hàng");
				$mail->Subject = $subject;
				$mail->AddBCC($msp,'dinhhungvn@gmail.com');
				$mail->IsHTML(true);                                  // set email format to HTML
				
				$content = "
<div style=\"border:5px solid #51443B\"><div style=\"margin:0 auto;border:20px solid #E6A01D; width:auto;background: none repeat scroll 0 0 #fff;padding:10px 15px 15px 15px;\">
		{$content}
		
<div style=\"clear:both; margin:10px; border-top:1px solid #CCC; padding-top:5px;\">
<p>Mọi thông tin thắc mắc xin quý khách vui lòng liên hệ:</p>
<p><strong>Công ty TNHH Thương Mại VHH Hà Nội</strong></p>
<p>Địa chỉ: 1155 Giải Phóng, Hoàng Mai, Hà Nội</p>
<p>Số tài khoản: <strong>0301.000.300.851</strong></p>
<p>Ngân hàng: <strong> Vietcombank – Chi nhánh Hoàn Kiếm</strong></p>
<p>Email: <a href=\"mailto:chungmua3hv@gmail.com\">chungmua3hv@gmail.com</a> - Phone: (04) 668 00 492 -  Fax: (043) 642 0573</p>
<p>Đương dây nóng: <strong>01656 555 999</strong></p>
   <center><p><strong>Cảm ơn bạn đã sử dụng dịch vụ của chungmua3hv.vn.</strong></p></center>

</div>

</div></div><div style=\"font-size:10px; text-align:center; font-family:Arial, Helvetica, sans-serif\">
  <div style=\"border-bottom:1px solid #999; padding-bottom:5px; margin-bottom:10px;\"><p>Lưu ý: Đây chỉ là thư thông báo. Các hồi đáp lại thông báo này sẽ không được theo dõi hoặc giải đáp.</p>
   </div>
  <p><strong>Công ty TNHH Thương Mại VHH Hà Nội</strong></p>
Địa chỉ: 1155 Giải Phóng, Hoàng Mai, Hà Nội<br />
    Copyright by chungmua3hv.vn - Design by <a href=\"http://www.smartnet.vn\">Smartnet Media</a></div>";		
				$mail->Body    = stripslashes($content);
				//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
				
				if(!$mail->Send())
				{
				   //echo "Message could not be sent. <p>";
				   echo "Mailer Error: " . $mail->ErrorInfo;
				   exit;
				}				
				//echo "Message has been sent<br>";
				unset($subject);
				unset($content);
				unset($receivers);
				unset($mail);
				
		
	}
}



?>