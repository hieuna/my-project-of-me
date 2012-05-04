<?php
/**
 * @version		$Id: userslatest.php 1503 2012-02-28 15:48:24Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

if(K2_JVERSION=='16'){
	jimport('joomla.form.formfield');
	class JFormFieldUsersLatest extends JFormField {

		var	$type = 'userslatest';

		function getInput(){
			return JElementUsersLatest::fetchElement($this->name, $this->value, $this->element, $this->options['control']);
		}
	}
}

jimport('joomla.html.parameter.element');

class JElementUsersLatest extends JElement
{

	var	$_name = 'userslatest';

	function fetchElement($name, $value, &$node, $control_name){
		JHTML::_('behavior.modal');
		
		$params = &JComponentHelper::getParams('com_k2');
		
		$document = &JFactory::getDocument();
		
		if(version_compare(JVERSION,'1.6.0','ge')) {
			JHtml::_('behavior.framework');
		} else {
			JHTML::_('behavior.mootools');
		}

		$backendJQueryHandling = $params->get('backendJQueryHandling','remote');
		if($backendJQueryHandling=='remote'){
			$document->addScript('http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js');
			$document->addScript('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
		} else {
			$document->addScript(JURI::root(true).'/media/k2/assets/js/jquery-1.7.1.min.js');
			$document->addScript(JURI::root(true).'/media/k2/assets/js/jquery-ui-1.8.16.custom.min.js');
		}

		$mainframe = &JFactory::getApplication();

		if(K2_JVERSION=='16'){
			$fieldName = $name;
			if(!$node->getAttribute('multiple')){
				$fieldName .= '[]';
			}
			$image = JURI::root(true).'/administrator/templates/'.$mainframe->getTemplate().'/images/admin/publish_x.png';
		}
		else {
			$fieldName = $control_name.'['.$name.'][]';
			$image = JURI::root(true).'/administrator/images/publish_x.png';
		}
		
		$js = "
		var \$K2 = jQuery.noConflict();
		function jSelectUser(id, title, object) {
			var exists = false;
			\$K2('#usersList input').each(function(){
					if(\$K2(this).val()==id){
						alert('".JText::_('K2_THE_SELECTED_USER_IS_ALREADY_IN_THE_LIST', true)."');
						exists = true;
					}
			});
			if(!exists){
				var container = \$K2('<li/>').appendTo(\$K2('#usersList'));
				var img = \$K2('<img/>',{class:'remove', src:'".$image."'}).appendTo(container);
				img.click(function(){\$K2(this).parent().remove();});
				var span = \$K2('<span/>',{class:'handle'}).html(title).appendTo(container);
				var input = \$K2('<input/>',{value:id, type:'hidden', name:'".$fieldName."'}).appendTo(container);
				var div = \$K2('<div/>',{style:'clear:both;'}).appendTo(container);
				\$K2('#usersList').sortable('refresh');
				alert('".JText::_('K2_USER_ADDED_IN_THE_LIST', true)."');
			}
		}

		\$K2(document).ready(function(){
			\$K2('#usersList').sortable({
				containment: '#usersList',
				items: 'li',
				handle: 'span.handle'
			});
			\$K2('body').css('overflow-y', 'scroll');
			\$K2('#usersList .remove').click(function(){
				\$K2(this).parent().remove();
			});
		});
		";

		$document->addScriptDeclaration($js);
		$document->addStyleSheet(JURI::root(true).'/media/k2/assets/css/k2.modules.css?v=2.5.5');

		$current = array();
		if(is_string($value) && !empty($value)){
			$current[]=$value;
		}
		if(is_array($value)){
			$current=$value;
		}

		$output = '
		<div class="button2-left">
			<div class="blank">
				<a class="modal" title="'.JText::_('K2_CLICK_TO_SELECT_ONE_OR_MORE_USERS').'" href="index.php?option=com_k2&view=users&task=element&tmpl=component" rel="{handler: \'iframe\', size: {x: 700, y: 450}}">'.JText::_('K2_CLICK_TO_SELECT_ONE_OR_MORE_USERS').'</a>
			</div>
		</div>
		<div style="clear:both;"></div>
		';

		$output.= '<ul id="usersList">';
		foreach($current as $id){
			$row = &JFactory::getUser($id);
			$output .= '
			<li>
				<img class="remove" src="'.$image.'" alt="'.JText::_('K2_REMOVE_ENTRY_FROM_LIST').'" />
				<span class="handle">'.$row->name.'</span>
				<input type="hidden" value="'.$row->id.'" name="'.$fieldName.'"/>
				<span style="clear:both;"></span>
			</li>
			';
		}
		$output.='</ul>';
		return $output;
	}
}
