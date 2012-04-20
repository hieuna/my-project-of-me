<?php
class editor {

	function run($task="")
	{	
		if( !$_SESSION[$_SESSION["prefix_"]]['user_id'] || $_SESSION[$_SESSION["prefix_"]]['user_type'] == '2'){			
			loadModule('user','login');
			exit();		
		}
		
		if( ($_GET["amod"]=="" ) && $_SESSION[$_SESSION["prefix_"]]['user_id'] != ''){		
			$this->runEXT();
		}
		else		
		{
			include_once("config/pear_quickform.php");
			include_once("lib/datagrid/datagrid.php");
			
			global $oDatagrid, $oDb, $oSmarty;
			$oDatagrid= new datagrid($oDb, $oSmarty);
			if(!isset($_GET['ajax']))
				echo '				
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<script type="text/javascript" src="'.SITE_URL.'lib/jquery/jquery.js"></script>
					<link href="'.SITE_URL.'lib/jquerylightbox/css/jquery.lightbox.css" rel="stylesheet" type="text/css" />
					<script type="text/javascript" src="'.SITE_URL.'lib/jquerylightbox/js/jquery.lightbox.js"></script>
					<link href="'.SITE_URL.'lib/css/admin.css" rel="stylesheet" type="text/css" />
					';
				//print_r($_SESSION);
			if($_SESSION[$_SESSION["prefix_"]]['user_id'] == '')
				$amod = "login";
			else
				$amod = $_GET["amod"];
			include($amod."/".$amod.".module.php");	
			$amod= new $amod();

			$amod->run();		
		}
	}

	function getPageinfo($task= "")
	{
		global $oSmarty;	
		switch ($task)
		{
			default:
				$aPageinfo = array(
					'title'=>$oSmarty->get_config_vars('title_admin'),
					'keyword'=>$oSmarty->get_config_vars('keyword_admin'), 
					'description'=>$oSmarty->get_config_vars('description_admin'), 
				);
				break;
		}
		return $aPageinfo;
	}
	
	function runEXT()
	{
		global $oDb;
		global $oSmarty;		
		$_SESSION[$_SESSION["prefix_"]]['group_id']= 1;
		$usertype = $_SESSION[$_SESSION["prefix_"]]['user_type'];
		
		//die($sql);
		$modul=$_GET['amod']; 
		echo $usertype;
		if($usertype == 1)
		{	
			$modules=$oDb->getAll("select * from admin_menu_guide where parent_id=0 and showed='1' order by z_index asc");
			if(is_array($modules))
			{
				foreach($modules as $key=>$module)
				{
					
					$sub = $oDb -> getAll("select * from admin_menu_guide where parent_id = ".$module['id']." and showed='1' order by z_index "); 
					if(is_array($sub) && count( $sub ))
					{					
						$modules[$key]['sub'] = $sub;
					}else{
						$modules[$key]['sub'] = array($module);
					}
					
				}			
			}
		}
		elseif($usertype == 3)
		{	
			$modules=$oDb->getAll("select * from admin_menu_guide where parent_id=0 and showed='1' order by z_index asc");
			if(is_array($modules))
			{
				foreach($modules as $key=>$module)
				{
					
					$sub = $oDb -> getAll("select * from admin_menu_guide where parent_id = ".$module['id']." and showed='1' order by z_index "); 
					if(is_array($sub) && count( $sub ))
					{					
						$modules[$key]['sub'] = $sub;
					}else{
						$modules[$key]['sub'] = array($module);
					}
					
				}			
			}
		}		else{			
			$arr_default = array('title' => "No Module");
			$sql = "select * from admin_menu_guide where parent_id=0 and showed='1' order by z_index asc";
			$allModule = $oDb -> getAll( $sql );
						
			$sql = "select t1.* from admin_menu_guide t1 where showed='1' and id in( select t2.module_id from tbl_module_roll t2 join tbl_usertype_moduleroll t3 on(t3.module_roll_id = t2.id ) where t3.user_type_id= '{$usertype}') order by z_index";
			$subs = $oDb -> getAll( $sql );
			
			foreach ( $allModule as $key => $value ){
				foreach ( $subs as $k => $val){
					if( $value['id'] == $val['id']){
						$modules[$key] = $value;
						$modules[$key]['sub'][] = $val;
						break;						
					}else if($val['parent_id'] != 0){
						if( $val['parent_id'] == $value['id']){
							if( !is_array( $modules[$key])){
								$modules[$key] = $value;
							}
							$modules[$key]['sub'][] = $val;
						}
					}
				}
			}
			
			if( !$modules ) $modules = array( $arr_default );
			#print_r( $modules );
		}
		
		$query_string= $_SERVER['QUERY_STRING'];
		
		$menu = "
		Ext.onReady(function(){
		Ext.state.Manager.setProvider(new Ext.state.CookieProvider());        
		var viewport = new Ext.Viewport({
		layout:'border',
		items:[
			new Ext.BoxComponent({ // raw
				region:'north',
				el: 'north',
				split:true
			}),{
				region:'south',
				html: '<div style=\"text-align: right; margin-right: 10px; font-weight: normal; color: #999999;\">&copy; 2008 Administrator control panel 2008 &copy;</div>',
				bodyStyle:'background:#dfe8f6',
				split:true
			},{
				region:'west',
				id:'west-panel',
				title:'Menu action',
				split:true,
				width: 200,
				minSize: 200,
				maxSize: 200,
				collapsible: true,
				margins:'0 0 0 0',
				layout:'accordion',
				layoutConfig:{
					animate:true
				},
				items: [//navigation
		";
		
		$tmp= array();
		
		foreach($modules as $mod)
		{
			$str= "{
				title:'".$mod['title']."',
				html: '";
	
				if( is_array($mod['sub']) )
				foreach($mod['sub'] as $sub)
				{					
					$str.= "<a style=\"text-decoration:none\" href=\"?mod=admin&".$sub['link']."\"  target=\"content\"><div id=\"sub_menu\" class=\"leftmenu_item\" onMouseOver=\"this.className=\'leftmenu_item_hover\'\" OnMouseOut=\"this.className=\'leftmenu_item\'\" OnClick=\"  \$(\'#sum_menu\').removeClass(\'leftmenu_item_selected\'); this.className=\'leftmenu_item_selected\' \" >".$sub['title']."</div></a>";				
				}
					
			$str.= "',
							border:false							
						}";
			$tmp[]= $str;
		}
		
		$tmp= implode(",", $tmp);
		
		$menu.= $tmp;
		
		$menu.= "
		]
			},
			{
				region:'center',
				html: '<iframe name=\"content\" src=\"?mod=admin&amod=welcome\" width=\"100%\" height=\"100%\" frameborder=\"0\"></iframe>',
				autoScroll:true				
			}
		 ]
		});
		
		});
		";
		
		$oSmarty->assign('menu',$menu);
		$oSmarty->display("ext.tpl");
	}	
}

?>