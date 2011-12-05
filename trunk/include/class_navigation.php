<?php
class pager
{

	var $limit = 50;
	var $offset = 0;
	var $page = 1;
	var $total = 0;
	var $limit_page_num=2000; // Unlimit if $limit_page_num = "~";
	
	function __construct($limit, $total, $page){
		$this->limit = $limit;
		$this->total = $total;
		$this->page = $page;
		$this->offset = ($this->page - 1) * $this->limit;
	}
    
	function page_link()
	{
        $total  = (int) $this->total;
        $limit    = max((int) $this->limit, 1);
        $page     = (int) $this->page;
		
		$page= ($page== "") ? 1 : $page;	
				
		if ( $total > 0 )
		{		
			$total = ceil($total/$limit);
		}

		//Limit page number
		$total = ($this->limit_page_num == "~") ? $total : ((int)($total > $this->limit_page_num) ? $this->limit_page_num : $total);
		
		$v_f = 3;
		$v_a = 2;
		$v_l = 3;
		$max_pages = $v_f + $v_a + $v_l + 5;
		$z_1 = $z_2 = $z_3 = false;
		$pg = $this->page ? $this->page : 1;		
		$work['B_LINK'] = "";
		$work['F_LINK'] = "";
		$work['P_LINK'] = "";
		
		$pgt = $pg-1;
		$prevActive = ($pg == 1)?false:true;
		$work['F_LINK']	=	$this->pagination_start_dots(1, $prevActive);
		$work['P_LINK']	=	$this->pagination_previous_link($pgt, $prevActive);
		
		$work['B_LINK'] .= '<div class="button2-left"><div class="page">';
		for($m = 1; $m <= $total; $m++) {
			if ($total > $max_pages) {
				if (($m > $v_f) && (($m < $pg - $v_a) || ($m > $pg + $v_a)) && ($m < $total - $v_l + 1)) {
					if (!$z_1 && ($m > $v_f)) {
						$work['B_LINK'] .= "<span style=\"float:left\">...</span>";
						$z_1 = true;
					}
					else if (!$z_2 && ($m > $pg + $v_a)) {
						//$work['B_LINK'] .= "<span style=\"float:left\">...</span>";
						$z_2 = true;
					}
					continue;
				}
			}
			
			if($m == $pg) $work['B_LINK'] .= $this->pagination_current_page($m);
			else $work['B_LINK'] .= $this->pagination_page_link($m);		
		}	
		$work['B_LINK'] .= '</div></div>';
		
		$pgs = $pg + 1;
		
		$nextActive = ($pg == $total)?false:true;
		$work['N_LINK']	=	$this->pagination_next_link($pgs, $nextActive);			
		$work['L_LINK']	=	$this->pagination_end_dots($total, $nextActive);
		
		$html = $this->pagination_make_jump().$work['F_LINK'].$work['P_LINK'].$work['B_LINK'].$work['N_LINK'].$work['L_LINK'];
		$html .= '<div class="limit">Page '.$pg.' of '.$total.' ('.$this->total.' items)</div>';
		$html = '<del class="container"><div class="pagination">'.$html.'<input type="hidden" value="'.$pg.'" name="p"></div></del>';
		return $html;
	}

	//===========================================================================
	// pagination_make_jump
	//===========================================================================
	function pagination_make_jump() {
		$content = '<div class="limit">Hiển thị #
						<select onchange="submitform();" size="1" class="inputbox" id="limit" name="limit">
							<option '.($this->limit==20?'selected="selected"':'').' value="20">20</option>
							<option '.($this->limit==30?'selected="selected"':'').' value="30">30</option>
							<option '.($this->limit==50?'selected="selected"':'').' value="50">50</option>
							<option '.($this->limit==100?'selected="selected"':'').' value="100">100</option>
						</select>
					</div>';
		return $content;
	}
	
	//===========================================================================
	// pagination_current_page
	//===========================================================================
	function pagination_current_page($page="") {
		$content = '<span>'.$page.'</span>';
		return $content;
	}
	
	//===========================================================================
	// pagination_end_dots
	//===========================================================================
	function pagination_end_dots($page="", $active) {
		if ($active) $content = '<div class="button2-left"><div class="end"><a onclick="javascript: document.adminForm.p.value='.$page.'; submitform();return false;" title="End" href="javascript:void(0);">End</a></div></div>';
		else $content = '<div class="button2-left off"><div class="end"><span>End</span></div></div>';
		return $content;
	}
	
	//===========================================================================
	// pagination_next_link
	//===========================================================================
	function pagination_next_link($page="", $active) {
		if ($active) $content = '<div class="button2-left"><div class="next"><a onclick="javascript: document.adminForm.p.value='.$page.'; submitform();return false;" title="Next" href="javascript:void(0);">Next</a></div></div>';
		else $content = '<div class="button2-left off"><div class="next"><span>Next</span></div></div>';
		return $content;
	}
	
	//===========================================================================
	// pagination_page_link
	//===========================================================================
	function pagination_page_link($page="") {
		$content = '<a onclick="javascript: document.adminForm.p.value='.$page.'; submitform();return false;" title="Trang '.$page.'" href="javascript:void(0);">'.$page.'</a>';
		return $content;
	}
	
	//===========================================================================
	// pagination_previous_link
	//===========================================================================
	function pagination_previous_link($page="", $active) {
		if ($active) $content = '<div class="button2-right"><div class="prev"><a onclick="javascript: document.adminForm.p.value='.$page.'; submitform();return false;" title="Prev" href="javascript:void(0);">Prev</a></div></div>';
		else $content = '<div class="button2-right off"><div class="prev"><span>Prev</span></div></div>';
		return $content;
	}
	
	//===========================================================================
	// pagination_start_dots
	//===========================================================================
	function pagination_start_dots($page="", $active) {
		if ($active) $content = '<div class="button2-right"><div class="start"><a onclick="javascript: document.adminForm.p.value='.$page.'; submitform();return false;" title="Start" href="javascript:void(0);">Start</a></div></div>';
		else $content = '<div class="button2-right off"><div class="start"><span>Start</span></div></div>';
		return $content;
	}

}
?>