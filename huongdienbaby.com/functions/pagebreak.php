<?
//Function generatePageBar 2.0 (Support Ajax) -- Code Editor: boy_infotech
function generatePageBar($prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous = "&nbsp;<< ", $next = " >>&nbsp;"){
	if ($total_record % $page_size == 0){
		$num_of_page = $total_record / $page_size;
	}
	else{
		$num_of_page = (int)($total_record / $page_size) + 1;
	}
	
	$start_page = $current_page - 5;
	if($start_page <= 0) $start_page = 1;
	
	$end_page = $current_page + 5;
	if($end_page > $num_of_page) $end_page = $num_of_page;
	
	//WRITE prefix on screen
	echo "<font class='" . $normal_class . "'>" . $prefix . "</font> ";
	//Write Previous
	if(($current_page > 1) && ($num_of_page > 1)){
		echo "<a title='Previous page' href='" . $url . "&page=" . ($current_page-1) . "' class='" . $normal_class . "'>" . $previous . "</a>";
		if($start_page !=1) echo " <b>..</b> ";
	}
	for($i=$start_page; $i<=$end_page; $i++){
		if($i != $current_page){
			echo "&nbsp;<a title='Page " . $i . "' href='" . $url . "&page=" . $i . "' class='" . $normal_class . "'>" . $i . "</a>&nbsp;";
		}
		else{
			echo "&nbsp;<font title='Page " . $i . "' class='" . $selected_class . "'>[" . $i . "]</font>&nbsp;";
		}
	}
	//Write Next
	if(($current_page < $num_of_page) && ($num_of_page > 1)){
		if($end_page < $num_of_page) echo " <b>..</b> ";
		echo "<a title='Next page' href='" . $url . "&page=" . ($current_page+1) . "' class='" . $normal_class . "'>" . $next . "</a>";
	}
}
function generatePageBar_2($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous='<', $next='>', $first='<<', $last='>>', $break_type=1, $page_rewrite=0, $page_space=3, $obj_response='', $page_name="page", $anchor=""){
	
	$page_query_string	= "&" . $page_name . "=";
	// Nếu dùng ModRewrite thì dùng dấu , để phân trang
	if($page_rewrite == 1) $page_query_string = ",";
	
	if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
	else $num_of_page = (int)($total_record / $page_size) + 1;
	
	$start_page = $current_page - $page_space;
	if($start_page <= 0) $start_page = 1;
	
	$end_page = $current_page + $page_space;
	if($end_page > $num_of_page) $end_page = $num_of_page;
	
	// Remove XSS
	$url = str_replace('\"', '"', $url);
	$url = str_replace('"', '', $url);
	
	if($break_type < 1) $break_type = 1;
	if($break_type > 4) $break_type = 4;
	
	// Pagebreak bar
	$page_bar = "";
	
	// Write prefix on screen
	if($page_prefix != "") $page_bar .= '<font class="' . $normal_class . '">' . $page_prefix . '</font> ';
	
	// Write previous page
	if($break_type == 1 || $break_type == 2 || $break_type == 4){
		if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . ($current_page - 1) . '\',\'' . $obj_response . '\')';
		else $href = $url . $page_query_string . ($current_page - 1) . $anchor;
		if($current_page > 1) $page_bar .= ' <a href="' . $href . '" class="' . $normal_class . '">' . $previous . '</a> ';
		else $page_bar .= ' <div class="' . $normal_class . '">' . $previous . '</div> ';
		if(($start_page > 1) && ($break_type == 1 || $break_type == 2)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . '1\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . "1" . $anchor;
			$page_bar .= ' <a href="' . $href . '" class="' . $normal_class . '">1</a> ';
			$page_bar .= '<div class="page_picture_dot">...</div>';
		}
	}
	
	// Write page numbers
	if($break_type == 1 || $break_type == 2 || $break_type == 3){
		$start_loop = $start_page;
		if($break_type == 3) $start_loop = 1;
		$end_loop	= $end_page;
		if($break_type == 3) $end_loop = $num_of_page;
		for($i=$start_loop; $i<=$end_loop; $i++){
			if($i != $current_page){
				if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . $i . '\',\'' . $obj_response . '\')';
				else $href = $url . $page_query_string . $i . $anchor;
				$page_bar .= ' <a href="' . $href . '" class="' . $normal_class . '">' . $i . '</a> ';
			}
			else{
				$page_bar .= ' <font class="' . $selected_class . '">' . $i . '</font> ';
			}
		}
	}
	
	// Write next page
	if($break_type == 1 || $break_type == 2 || $break_type == 4){
		if(($end_page < $num_of_page) && ($break_type == 1 || $break_type == 2)){
			$page_bar .= '<div class="page_picture_dot">...</div>';
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . $num_of_page . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . $num_of_page . $anchor;
			$page_bar .= ' <a href="' . $href . '" class="' . $normal_class . '">' . $num_of_page . '</a> ';
		}
		if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . ($current_page + 1) . '\',\'' . $obj_response . '\')';
		else $href = $url . $page_query_string . ($current_page + 1) . $anchor;
		if($current_page < $num_of_page) $page_bar .= ' <a href="' . $href . '" class="' . $normal_class . '">' . $next . '</a> ';
		else $page_bar .= ' <div class="' . $normal_class . '">' . $next . '</div> ';
	}
	
	// Return pagebreak bar
	return $page_bar;
	
}
?>