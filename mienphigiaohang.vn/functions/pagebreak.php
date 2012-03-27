<?
// Function generatePageBar 2.0 (Support Ajax)
function generatePageBar($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous='<', $next='>', $first='<<', $last='>>', $break_type=1, $page_rewrite=0, $page_space=3, $obj_response='', $page_name="page",$title=""){
	
	$page_query_string	= "&" . $page_name . "=";
	// Nếu dùng ModRewrite thì dùng dấu , để phân trang
	if($page_rewrite == 1) $page_query_string = ",";
	
	if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
	else $num_of_page = (int)($total_record / $page_size) + 1;
	
	$page_space = 3;
	
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
	
	// Write frist page
	if($break_type == 1){
		if(($start_page != 1) && ($num_of_page > 1)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . '1' . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . '1';
			$page_bar .=  '<a href="' . createLinkPageBarRewrite($href,$title). '" class="' . $normal_class . '" onmouseover="this.className=\'' . $selected_class . '\'" onmouseout="this.className=\'' . $normal_class . '\'">' . $first . '</a> ';
		}
	}
	
	// Write previous page
	if($break_type == 1 || $break_type == 2 || $break_type == 4){
		if(($current_page > 1) && ($num_of_page > 1)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . ($current_page - 1) . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . ($current_page - 1);
			$page_bar .= ' <a href="' . createLinkPageBarRewrite($href,$title). '" class="' . $normal_class . '" onmouseover="this.className=\'' . $selected_class . '\'" onmouseout="this.className=\'' . $normal_class . '\'">' . $previous . '</a> ';
			if(($start_page > 1) && ($break_type == 1 || $break_type == 2)){
				$page_dot_before = $start_page - 1;
				if($page_dot_before < 1) $page_dot_before = 1;
				if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . $page_dot_before . '\',\'' . $obj_response . '\')';
				else $href = $url . $page_query_string . $page_dot_before;
				$page_bar .= '<a href="' . createLinkPageBarRewrite($href,$title). '" class="' . $normal_class . '" onmouseover="this.className=\'' . $selected_class . '\'" onmouseout="this.className=\'' . $normal_class . '\'">..</a> ';
			}
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
				else $href = $url . $page_query_string . $i;
				$page_bar .= ' <a href="' . createLinkPageBarRewrite($href,$title). '" class="' . $normal_class . '" onmouseover="this.className=\'' . $selected_class . '\'" onmouseout="this.className=\'' . $normal_class . '\'">' . $i . '</a> ';
			}
			else{
				$page_bar .= ' <font class="' . $selected_class . '">' . $i . '</font> ';
			}
		}
	}
	
	// Write next page
	if($break_type == 1 || $break_type == 2 || $break_type == 4){
		if(($current_page < $num_of_page) && ($num_of_page > 1)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . ($current_page + 1) . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . ($current_page + 1);
			if(($end_page < $num_of_page) && ($break_type == 1 || $break_type == 2)){
				$page_dot_after = $end_page + 1;
				if($page_dot_after > $num_of_page) $page_dot_after = $num_of_page;
				if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . $page_dot_after . '\',\'' . $obj_response . '\')';
				else $href = $url . $page_query_string . $page_dot_after;
				$page_bar .= '<a href="' . createLinkPageBarRewrite($href,$title). '" class="' . $normal_class . '">..</a> ';
			}
			$page_bar .= ' <a href="' . createLinkPageBarRewrite($href,$title). '" class="' . $normal_class . '" onmouseover="this.className=\'' . $selected_class . '\'" onmouseout="this.className=\'' . $normal_class . '\'">' . $next . '</a> ';
		}
	}
	
	// Write last page
	if($break_type == 1){
		if(($end_page < $num_of_page) && ($num_of_page > 1)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . $num_of_page . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . $num_of_page;
			$page_bar .= ' <a href="' . createLinkPageBarRewrite($href,$title). '" class="' . $normal_class . '" onmouseover="this.className=\'' . $selected_class . '\'" onmouseout="this.className=\'' . $normal_class . '\'">' . $last . '</a>';
		}
	}
	
	// Return pagebreak bar
	return $page_bar;
	
}

//hàm tạo link khi cần thiết chuyển sang mod rewrite
function createLinkPageBarRewrite($url,$title,$rewrite = 1){
	$keyReplace = '/';
    global $lang_path;
    $path = getURL(1,0,0,0);
    $array_value =  array();
    
    $string_url = strstr($url,"?");
    $string_url = str_replace("?","",$string_url);
    $arr = explode("&",$string_url);
 
    foreach ( $arr as $key => $value ) {
        $arr_temp = explode("=",$value);
        if(isset($arr_temp[1]) && isset($arr_temp[0])){
            $array_value[$arr_temp[0]] = isset($arr_temp[0]) ? $arr_temp[1] : "";    
        }
    }
    
    $type   = isset($array_value["module"]) ? $array_value["module"] : "";
    $child  = isset($array_value["id_child"]) ? "-c" . $array_value["id_child"] : "";
    $page   = isset($array_value["page"]) ? $array_value["page"] : "";
    $id     = isset($array_value["id"]) ? $array_value["id"] : "";
    
    if($page !='') 
	//tao luat cho mod rewrite
	switch($type){
		case "product":
			$menuReturn = $path . $lang_path .$keyReplace . replace_rewrite_url($title) . '-p' . $id . $child .  "-" . $page . ".html";
		    break;
		case "discount":
            if($id==13){
                $menuReturn = $path . $lang_path .$keyReplace . 'san-pham-doi-tac-d13' . '-' . $page . ".html";
            }else{
                $menuReturn = $path . $lang_path .$keyReplace . replace_rewrite_url($title) . '-d' . $id . $child . "-" . $page . ".html";    
            }
            break;
		case "search":
			$menuReturn = $path . $lang_path .$keyReplace . replace_rewrite_url($title) . '-s' . $id . $child . "-" . $page . ".html";
		    break;
        case "product_discount":
			$menuReturn = $path . $lang_path .$keyReplace . 'san-pham-giam-gia-nhieu' . '-' . $page . ".html";
		    break;
        case "product_merchant":
			$menuReturn = $path . $lang_path .$keyReplace . $id . '_' . $page;
		    break;
        default:
            $menuReturn = 11;
	}
	return $menuReturn;
}


// Function generatePageBar using javascript next Page
function generatePageBarScript($page_prefix, $current_page, $page_size, $total_record, $div_show, $normal_class, $selected_class, $previous='<', $next='>', $first='<<', $last='>>', $break_type=1, $page_rewrite=0, $page_space=3, $div_page){
	if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
	else $num_of_page = (int)($total_record / $page_size) + 1;
	
	$page_space = 3;
	
	$start_page = $current_page - $page_space;
	if($start_page <= 0) $start_page = 1;
	
	$end_page = $current_page + $page_space;
	if($end_page > $num_of_page) $end_page = $num_of_page;
	
	// Remove XSS
//	$url = str_replace('\"', '"', $url);
//	$url = str_replace('"', '', $url);
	
	if($break_type < 1) $break_type = 1;
	if($break_type > 4) $break_type = 4;
	
	// Pagebreak bar
	$page_bar = "";
	
	// Write prefix on screen
	if($page_prefix != "") $page_bar .= '<font class="' . $normal_class . '_fix'. '">' . $page_prefix . '</font> ';
	
	// Write frist page
	if($break_type == 1){
		if(($start_page != 1) && ($num_of_page > 1)){
			$page_bar .=  '<a style="cursor: pointer;" onclick="changecontentPageBar('.$num_of_page.',1,\''.$div_show.'\',\''.$div_page.'\',\''.$normal_class.'\',\''.$selected_class.'\')" class="' . $normal_class . '" >' . $first . '</a> ';
		}
	}
	
	// Write previous page
	if($break_type == 1 || $break_type == 2 || $break_type == 4){
		if(($current_page > 1) && ($num_of_page > 1)){
            $temp = $current_page - 1;
			$page_bar .= ' <a style="cursor: pointer;" onclick="changecontentPageBar('.$num_of_page.','.$temp.',\''.$div_show.'\',\''.$div_page.'\',\''.$normal_class.'\',\''.$selected_class.'\')" class="' . $normal_class . '" >' . $previous . '</a> ';
			if(($start_page > 1) && ($break_type == 1 || $break_type == 2)){
				$page_dot_before = $start_page - 1;
				if($page_dot_before < 1) $page_dot_before = 1;
				$page_bar .= '<a style="cursor: pointer;" onclick="changecontentPageBar('.$num_of_page.','.$temp.',\''.$div_show.'\',\''.$div_page.'\',\''.$normal_class.'\',\''.$selected_class.'\')" class="' . $normal_class . '" >..</a> ';
			}
		}
	}
	unset($temp);
	// Write page numbers
	if($break_type == 1 || $break_type == 2 || $break_type == 3){
		$start_loop = $start_page;
		if($break_type == 3) $start_loop = 1;
		$end_loop	= $end_page;
		if($break_type == 3) $end_loop = $num_of_page;
		for($i=$start_loop; $i<=$end_loop; $i++){
			if($i != $current_page){
				$page_bar .= ' <a id="'.$div_page. $i.'" style="cursor: pointer;" onclick="changecontentPageBar('.$num_of_page.','.$i.',\''.$div_show.'\',\''.$div_page.'\',\''.$normal_class.'\',\''.$selected_class.'\')" class="' . $normal_class . '" >' . $i . '</a> ';
			}
			else{
				$page_bar .= ' <font id="'.$div_page. $i.'" class="' . $selected_class . '">' . $i . '</font> ';
			}
		}
	}
	
	// Write next page
	if($break_type == 1 || $break_type == 2 || $break_type == 4){
		if(($current_page < $num_of_page) && ($num_of_page > 1)){
			if(($end_page < $num_of_page) && ($break_type == 1 || $break_type == 2)){
				$page_dot_after = $end_page + 1;
				if($page_dot_after > $num_of_page) $page_dot_after = $num_of_page;
				$page_bar .= '<a style="cursor: pointer;" onclick="changecontentPageBar('.$num_of_page.','.$page_dot_after.',\''.$div_show.'\',\''.$div_page.'\',\''.$normal_class.'\',\''.$selected_class.'\')" class="' . $normal_class . '">..</a> ';
			}
            $temp = $current_page + 1;
			$page_bar .= ' <a style="cursor: pointer;" onclick="changecontentPageBar('.$num_of_page.','.$temp.',\''.$div_show.'\',\''.$div_page.'\',\''.$normal_class.'\',\''.$selected_class.'\')" class="' . $normal_class . '" >' . $next . '</a> ';
            unset($temp);
        }
	}
	
	// Write last page
	if($break_type == 1){
		if(($end_page < $num_of_page) && ($num_of_page > 1)){
			$page_bar .= ' <a style="cursor: pointer;" onclick="changecontentPageBar('.$num_of_page.','.$num_of_page.',\''.$div_show.'\',\''.$div_page.'\',\''.$normal_class.'\',\''.$selected_class.'\')" class="' . $normal_class . '" >' . $last . '</a>';
		}
	}
	
	// Return pagebreak bar
	return $page_bar;
	
}

//Phân trang Ajax
function generatePageBarAjax($file,$page_prefix, $current_page, $page_size, $total_record, $div_show, $normal_class, $selected_class, $previous='<', $next='>', $first='<<', $last='>>', $break_type=1, $page_rewrite=0, $page_space=3, $div_page,$query=""){
	
	if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
	else $num_of_page = (int)($total_record / $page_size) + 1;
	
	$page_space = 3;
	
	$start_page = $current_page - $page_space;
	if($start_page <= 0) $start_page = 1;
	
	$end_page = $current_page + $page_space;
	if($end_page > $num_of_page) $end_page = $num_of_page;
	
	// Remove XSS
//	$url = str_replace('\"', '"', $url);
//	$url = str_replace('"', '', $url);
	
	if($break_type < 1) $break_type = 1;
	if($break_type > 4) $break_type = 4;
	
	// Pagebreak bar
	$page_bar = "";
	
	// Write prefix on screen
	if($page_prefix != "") $page_bar .= '<font class="' . $normal_class . '_fix'. '">' . $page_prefix . '</font> ';
	
	// Write frist page
	if($break_type == 1){
		if(($start_page != 1) && ($num_of_page > 1)){
			$page_bar .=  '<a style="cursor: pointer;" onclick="load_ajax(\''. $file .'?page=1'. $query .'\',\''.$div_show.'\')" class="' . $normal_class . '" >' . $first . '</a> ';
		}
	}
	
	// Write previous page
	if($break_type == 1 || $break_type == 2 || $break_type == 4){
		if(($current_page > 1) && ($num_of_page > 1)){
            $temp = $current_page - 1;
			$page_bar .= ' <a style="cursor: pointer;" onclick="load_ajax(\''. $file .'?page='.$temp. $query .'\',\''.$div_show.'\')" class="' . $normal_class . '" >' . $previous . '</a> ';
			if(($start_page > 1) && ($break_type == 1 || $break_type == 2)){
				$page_dot_before = $start_page - 1;
				if($page_dot_before < 1) $page_dot_before = 1;
				$page_bar .= '<a style="cursor: pointer;" onclick="load_ajax(\''. $file .'?page='.$page_dot_before. $query . '\',\''.$div_show.'\')" class="' . $normal_class . '" >..</a> ';
			}
		}
	}
	unset($temp);
	// Write page numbers
	if($break_type == 1 || $break_type == 2 || $break_type == 3){
		$start_loop = $start_page;
		if($break_type == 3) $start_loop = 1;
		$end_loop	= $end_page;
		if($break_type == 3) $end_loop = $num_of_page;
		for($i=$start_loop; $i<=$end_loop; $i++){
			if($i != $current_page){
				$page_bar .= ' <a id="'.$div_page. $i.'" style="cursor: pointer;" onclick="load_ajax(\''. $file .'?page='.$i. $query . '\',\''.$div_show.'\')" class="' . $normal_class . '" >' . $i . '</a> ';
			}
			else{
				$page_bar .= ' <font id="'.$div_page. $i.'" class="' . $selected_class . '">' . $i . '</font> ';
			}
		}
	}
	
	// Write next page
	if($break_type == 1 || $break_type == 2 || $break_type == 4){
		if(($current_page < $num_of_page) && ($num_of_page > 1)){
            $temp = $current_page + 1;
			if(($end_page < $num_of_page) && ($break_type == 1 || $break_type == 2)){
				$page_dot_after = $end_page + 1;
				if($page_dot_after > $num_of_page) $page_dot_after = $num_of_page;
				$page_bar .= '<a style="cursor: pointer;" onclick="load_ajax(\''. $file .'?page='.$page_dot_after. $query . '\',\''.$div_show.'\')" class="' . $normal_class . '">..</a> ';
			}
			$page_bar .= ' <a style="cursor: pointer;" onclick="load_ajax(\''. $file .'?page='.$temp.$query.'\',\''.$div_show.'\')" class="' . $normal_class . '" >' . $next . '</a> ';
		}
	}
	unset($temp);
	// Write last page
	if($break_type == 1){
		if(($end_page < $num_of_page) && ($num_of_page > 1)){
			$page_bar .= ' <a style="cursor: pointer;" onclick="load_ajax(\''. $file .'?page='.$num_of_page.$query.'\',\''.$div_show.'\')" class="' . $normal_class . '" >' . $last . '</a>';
		}
	}
	
	// Return pagebreak bar
	return $page_bar;
	
}

function generatePageBar_basic($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous='<', $next='>', $first='<<', $last='>>', $break_type=1, $page_rewrite=0, $page_space=3, $obj_response='', $page_name="page"){
	
	$page_query_string	= "&" . $page_name . "=";
	// Nếu dùng ModRewrite thì dùng dấu , để phân trang
	if($page_rewrite == 1) $page_query_string = ",";
	
	if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
	else $num_of_page = (int)($total_record / $page_size) + 1;
	
	$page_space = 3;
	
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
	
	// Write frist page
	if($break_type == 1){
		if(($start_page != 1) && ($num_of_page > 1)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . '1' . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . '1';
			$page_bar .=  '<a href="' . $href . '" class="' . $normal_class . '">' . $first . '</a> ';
		}
	}
	
	// Write previous page
	if($break_type == 1 || $break_type == 2 || $break_type == 4){
		if(($current_page > 1) && ($num_of_page > 1)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . ($current_page - 1) . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . ($current_page - 1);
			$page_bar .= ' <a href="' . $href . '" class="' . $normal_class . '">' . $previous . '</a> ';
			if(($start_page > 1) && ($break_type == 1 || $break_type == 2)){
				$page_dot_before = $start_page - 1;
				if($page_dot_before < 1) $page_dot_before = 1;
				if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . $page_dot_before . '\',\'' . $obj_response . '\')';
				else $href = $url . $page_query_string . $page_dot_before;
				$page_bar .= '<a href="' . $href . '" class="' . $normal_class . '">..</a> ';
			}
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
				else $href = $url . $page_query_string . $i;
				$page_bar .= ' <a href="' . $href . '" class="' . $normal_class . '">' . $i . '</a> ';
			}
			else{
				$page_bar .= ' <font class="' . $selected_class . '">' . $i . '</font> ';
			}
		}
	}
	
	// Write next page
	if($break_type == 1 || $break_type == 2 || $break_type == 4){
		if(($current_page < $num_of_page) && ($num_of_page > 1)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . ($current_page + 1) . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . ($current_page + 1);
			if(($end_page < $num_of_page) && ($break_type == 1 || $break_type == 2)){
				$page_dot_after = $end_page + 1;
				if($page_dot_after > $num_of_page) $page_dot_after = $num_of_page;
				if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . $page_dot_after . '\',\'' . $obj_response . '\')';
				else $href = $url . $page_query_string . $page_dot_after;
				$page_bar .= '<a href="' . $href . '" class="' . $normal_class . '">..</a> ';
			}
			$page_bar .= ' <a href="' . $href . '" class="' . $normal_class . '">' . $next . '</a> ';
		}
	}
	
	// Write last page
	if($break_type == 1){
		if(($end_page < $num_of_page) && ($num_of_page > 1)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . $num_of_page . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . $num_of_page;
			$page_bar .= ' <a href="' . $href . '" class="' . $normal_class . '">' . $last . '</a>';
		}
	}
	
	// Return pagebreak bar
	return $page_bar;
	
}
//phân trang của deals
function generatePageBar_deal($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous='<< Quay lại', $next='Xem tiếp >>', $first='Về đầu', $last='Cuối cùng', $break_type=1, $page_rewrite=0, $page_space=3, $obj_response='', $page_name="page"){
	
	$page_query_string	= "&" . $page_name . "=";
	// Nếu dùng ModRewrite thì dùng dấu , để phân trang
	if($page_rewrite == 1) $page_query_string = ",";
	
	if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
	else $num_of_page = (int)($total_record / $page_size) + 1;
	
	$page_space = 3;
	
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
	if($page_prefix != "") $page_bar .= '<li><a class="' . $normal_class . '">' . $page_prefix . '</a></li> ';
	
	// Write frist page
	if($break_type == 1){
		if(($start_page != 1) && ($num_of_page > 1)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . '1' . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . '1';
			$page_bar .=  '<li><a href="' . $href . '" class="' . $normal_class . '">' . $first . '</a></li> ';
		}
	}
	
	// Write previous page
	if($break_type == 1 || $break_type == 2 || $break_type == 4){
		if(($current_page > 1) && ($num_of_page > 1)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . ($current_page - 1) . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . ($current_page - 1);
			$page_bar .= ' <li><a href="' . $href . '" class="' . $normal_class . '">' . $previous . '</a> </li>';
			if(($start_page > 1) && ($break_type == 1 || $break_type == 2)){
				$page_dot_before = $start_page - 1;
				if($page_dot_before < 1) $page_dot_before = 1;
				if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . $page_dot_before . '\',\'' . $obj_response . '\')';
				else $href = $url . $page_query_string . $page_dot_before;
				$page_bar .= '<li><a href="' . $href . '" class="' . $normal_class . '">..</a> </li>';
			}
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
				else $href = $url . $page_query_string . $i;
				$page_bar .= ' <li><a href="' . $href . '" class="' . $normal_class . '">' . $i . '</a></li> ';
			}
			else{
				$page_bar .= ' <li><a class="' . $selected_class . '">' . $i . '</a></li> ';
			}
		}
	}
	
	// Write next page
	if($break_type == 1 || $break_type == 2 || $break_type == 4){
		if(($current_page < $num_of_page) && ($num_of_page > 1)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . ($current_page + 1) . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . ($current_page + 1);
			if(($end_page < $num_of_page) && ($break_type == 1 || $break_type == 2)){
				$page_dot_after = $end_page + 1;
				if($page_dot_after > $num_of_page) $page_dot_after = $num_of_page;
				if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . $page_dot_after . '\',\'' . $obj_response . '\')';
				else $href = $url . $page_query_string . $page_dot_after;
				$page_bar .= '<li><a href="' . $href . '" class="' . $normal_class . '">..</a> </li>';
			}
			$page_bar .= ' <li><a href="' . $href . '" class="' . $normal_class . '">' . $next . '</a></li> ';
		}
	}
	
	// Write last page
	if($break_type == 1){
		if(($end_page < $num_of_page) && ($num_of_page > 1)){
			if($obj_response != '') $href = 'javascript:load_data(\'' . $url . $page_query_string . $num_of_page . '\',\'' . $obj_response . '\')';
			else $href = $url . $page_query_string . $num_of_page;
			$page_bar .= ' <li><a href="' . $href . '" class="' . $normal_class . '">' . $last . '</a></li>';
		}
	}
	
	// Return pagebreak bar
	return $page_bar;
	
}


?>