<?php
/*******************************************************************************************
Credits: dezignwork.com
Desc:	 This class will will create a pagination div with all the links, page numbers/link
		 and highlighted current page. All the pagination content will be placed in a div. 
		 The style of the div can be changed.
********************************************************************************************/
class Paging {
	var $num_rows;		// required vars
	var $action;
	var $action_path;
	var $show_first_last= true;
	var $parameter_name;
	
	var $link_class= "paging_link_class";
	var $div_class= "paging_div";
	var $current_class= "paging_current_class";
	var $current_page;

	var $PAGE='Page';
	var $site_path= site_path;
	var $first_string= "First";
	var $last_string= "Last";
	var $back_string= "Back";
	var $next_string= "Next";
	var $not_found_string= "";

	function Paging($num_rows=0, $per_page=10, $action="", $parameter_name='page')
	{		
		$this->num_rows= $num_rows;
		$this->action=$action;
		$this->per_page=$per_page;
		$this->parameter_name=$parameter_name;
	}
	
	function set_not_found_string($str){
		$this->not_found_string= str;
	}
	
	function string_paging() {
		
		if(empty($this->current_page)) {
			$this->set_current_page(1);
		}
				
		
		if(!($this->num_rows>0)) {
			return $this->not_found_string;
		}
		
		$pages_required=ceil($this->num_rows/$this->per_page);
		if(!empty($this->link_class)) { $link_class=' class="'.$this->link_class.'"'; }
		if(!empty($this->div_class)) { $div_class=' class="'.$this->div_class.'"'; }
		if(!empty($this->current_class)) { $current_class=' class="'.$this->current_class.'"'; }
		$page_line="";		
		$page_line.= "<span  $div_class>";
		
		if($this->current_page%5!=0){
			$start_page= intval($this->current_page/5)*5+1;
		}else {
			$start_page= intval($this->current_page/5)*5-4;
		}
		
		$end_page=$start_page+4;
				
		
		if($end_page>$pages_required) { $end_page=$pages_required; }
		
				
		// arrow first
		if(($this->show_first_last)&($this->current_page>5)) {
			if(!empty($this->action_path)) {
				$page_line.='<span class="span_a_class">&nbsp;<a href="'.str_replace("{i}", "1", $this->action_path).'"><img '.$link_class.' src="'.$this->site_url.'lib/paging/first.gif" title="'.$this->first_string.'" border="0"></a>&nbsp;</span>&nbsp;';
			} else {
				$page_line.='<span class="span_a_class">&nbsp;<a href="'.$this->action."?".$this->parameter_name.'='.
					 "1".'"><img '.$link_class.' src="'.$this->site_url.'lib/paging/first.gif" title="'.$this->first_string.'" border="0"></a>&nbsp;</span>&nbsp;';
			}
		}
		
		// arrow back
		if($start_page>5) {
			if(!empty($this->action_path)) {
				$page_line.='<span class="span_a_class">&nbsp;<a href="'.str_replace("{i}", $start_page-1, $this->action_path).'"'.$link_class.'><img '.$link_class.' src="'.$this->site_url.'lib/paging/back.gif" title="'.$this->back_string.'" border="0"></a>&nbsp;</span>&nbsp;';
			} else {
				$page_line.='<span class="span_a_class">&nbsp;<a href="'.$this->action."?".$this->parameter_name.'='.($start_page-1).'" '.$link_class.'><img '.$link_class.' src="'.$this->site_url.'lib/paging/back.gif" title="'.$this->back_string.'" border="0"></a>&nbsp;</span>&nbsp;';
			}
		}
		
		// pages
		for($i=$start_page; $i<=$end_page; $i++) {
			if($i>$end_page) { break; }
			if($this->current_page!=$i) {
				if(!empty($this->action_path)) {
					$page_line.='<span class="span_a_class">&nbsp;<a href="'.str_replace("{i}", $i, $this->action_path).'">'.$i.'</a>&nbsp;</span>&nbsp;';
				} else {
					$page_line.='<span class="span_a_class">&nbsp;<a href="'.$this->action."?".$this->parameter_name.'='.
						 $i.'">'.$i.'</a>&nbsp;<span>';
				}
			} else {
				$page_line.='<span class="span_select_class">&nbsp;'.$i.'&nbsp;</span>&nbsp;';
			}

		} // end for
		//$page_line=substr($page_line,0,strlen($page_line)-8);
		
		// arrow next
		if($pages_required>$end_page) {
			if(!empty($this->action_path)) {
				$page_line.='<span class="span_a_class">&nbsp;<a href="'.str_replace("{i}", $end_page+1, $this->action_path).'"'.$link_class.'><img '.$link_class.' src="'.$this->site_url.'lib/paging/next.gif" title="'.$this->next_string.'" border="0"></a>&nbsp;</span>';
			} else {
				$page_line.='<span class="span_a_class">&nbsp;<a href="'.$this->action."?".$this->parameter_name.'='.($end_page+1).'" '.$link_class.'><img '.$link_class.' src="'.$this->site_url.'lib/paging/next.gif" title="'.$this->next_string.'" border="0"></a>&nbsp;</span>';
			}
		}
		
		// arrow last
		if(($this->show_first_last)&($pages_required>$end_page)) {
			if(!empty($this->action_path)) {
				$page_line.='&nbsp;<span class="span_a_class">&nbsp;<a href="'.str_replace("{i}", $pages_required, $this->action_path).'"'.$link_class.'><img '.$link_class.' src="'.$this->site_url.'lib/paging/last.gif" title="'.$this->last_string.'" border="0"></a>&nbsp;</span>';
			} else {
				$page_line.='<span class="span_a_class">&nbsp;<a href="'.$this->action."?".$this->parameter_name.'='.
					 $pages_required.'"'.$link_class.'><img '.$link_class.' src="'.$this->site_url.'lib/paging/last.gif" title="'.$this->last_string.'" border="0"></a>&nbsp;</span>';
			}
		}
		
		$page_line.= '</span>';
		$page_line= '<link href="'.$this->site_url.'lib/paging/style.css" rel="stylesheet" type="text/css" />'.$page_line;
		return $page_line;
	}
	
	// mutators
	function set_action_path($path) {
		$this->action_path=$path;
	}
	function set_site_url($site_url) {
		$this->site_url=$site_url;
	}	
	function set_link_class($class) {
		$this->link_class=$class;
	}
	function set_div_class($class) {
		$this->div_class=$class;
	}
	function set_parameter_name($name) {
		$this->parameter_name=$name;
	}
	function set_page_limit($limit) {
		$this->per_page=$limit;
	}
	function set_current_page($page) {
		$this->current_page=$page;
	}
	function set_show_first_last($b=true){
		$this->show_first_last= $b;
	}
	function set_link_string($first="Trang đầu", $back="Trang trước", $next="Trang sau", $last="Trang cuối"){
		$this->first_string= $first;
		$this->back_string= $back;
		$this->next_string= $next;
		$this->last_string= $last;		
	}
}

// end of class

	function create_paging($numrows, $limit, $page=1, $path=""){
		
		$objPaging=new Paging($numrows, $limit);
		
		$objPaging->set_current_page($page);
		$objPaging->set_show_first_last();									
		if($path!=""){
			$objPaging->set_action_path($path);
		}
		return $objPaging->string_paging();
	}
?>