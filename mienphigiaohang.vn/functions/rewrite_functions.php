<?
/*
Function generate type url
*/
function generate_type_url($module="",$nCat, $iCat=""){
	global $con_mod_rewrite;
    global $lang_path;
    global $category_type;
    global $id_child;
    global $page_curent;
    
    $url_base       = getURL(1,0,0,0);
    $module_current = getValue("module","str","GET","");
    $id_current     = getValue("id","str","GET");
 
    if(isset($category_type[$module_current])) $key_module_current = $category_type[$module_current];
    else $key_module_current = $module;
    $nCat	        = replace_rewrite_url($nCat);
    if($key_module_current ==  $module){
        if($id_child == ""){
            if($iCat==''){
                $link	= $url_base . $lang_path . "/" . $nCat . ".html";
            }else{
                $link	= $url_base . $lang_path . "/" . $nCat . "-" . $module . $iCat . ".html";    
            }    
        }else{
            if($iCat==''){
                $link	= $url_base . $lang_path . "/" . $nCat . ".html";
            }else{
                $link	= $url_base . $lang_path . "/" . $nCat . "-" . $key_module_current . $iCat . "-c" . $id_child . ".html";    
            }
        }
    }else{
        if($page_curent == 'detail.php'){
            $link	= $url_base . $lang_path . "/" . $nCat . "-" . $module . $iCat . ".html";
        }else{
            $link	= $url_base . $lang_path . "/" . $nCat . "-" . $key_module_current . $id_current . "-c" . $iCat . ".html";    
        }
    }
	return $link;
}
?>

<?
/*
Function replace rewrite url
*/
function replace_rewrite_url($string, $rc="-", $urlencode=1,$accent=1){
	$string	= mb_strtolower($string, "UTF-8");
    if($accent == 1) $string	= removeAccent($string);
	$string	= preg_replace('/[^A-Za-z0-9]+/', ' ', $string);
	$string	= str_replace("   ", " ", trim($string));
	$string	= str_replace("  ", " ", trim($string));
	$string	= str_replace(" ", $rc, $string);
	$string	= str_replace($rc . $rc, $rc, $string);
	$string	= str_replace($rc . $rc, $rc, $string);
	if($urlencode == 1) $string	= urlencode($string);
	return $string;
}
?>
<?php
/*
Function t?o link cho c?c n?t remove thu?c t?nh b?n menu
*/
function creat_url_remove_icon($module="",$nCat, $iCat=""){
    global $category_type;
    global $lang_path;
    global $id_child;
    
    $url_base       = getURL(1,0,0,0);
    $module_current = getValue("module","str","GET","");
    $id_current     = getValue("id","str","GET");
    
    if($module_current!="") $key_module_current = $category_type[$module_current];
    else $key_module_current = $module;
    $nCat	        = replace_rewrite_url($nCat);
    
    if($id_child==""){
        $link = $url_base;
    }else{
        if($key_module_current == $module){
            if($key_module_current == 'p') $module = 'd';
            else $module = 'p';
            $link	= $url_base . $lang_path . "/" . $nCat . "-" . $module . $id_child . ".html";
        }else{
            if($key_module_current == 'd') $module = 'd';
            else $module = 'p';
            $link	= $url_base . $lang_path . "/" . $nCat . "-" . $module . $id_current . ".html";
        }
    }
	return $link;
}
?>