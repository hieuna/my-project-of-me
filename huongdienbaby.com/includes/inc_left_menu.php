<style type="text/css" media="all">
    #nav_bar
    {
        float:left;
        position:relative;	
		font-family:Arial,Verdana,"Helvetica Neue",Helvetica,sans-serif;
		width:187px;
		padding-left:12px;
		border-right:1px solid #DEDEDE;
		border-left:1px solid #DEDEDE;
		padding-top:5px;
    }
    #nav_bar > ul > li a
    {
        color: #333333;
        text-decoration:none;
		font-weight:normal;
		display:block;
    }
    #nav_bar  ul
    {
        list-style:none;
        margin:0; padding:0;
    }
	#nav_bar > ul > li:hover
	{
		background:url(/images/li_narow.png) no-repeat;
		background-position:165px 2px;
	}
    #nav_bar > ul > li
    {
        margin:0; 
		padding: 0 0 7px;
		line-height: 16px;
		font-size: 13px;
    }

	#nav_bar > ul > li a:hover
    {
		font-weight:bold;
		color: #E47911;
    }
	 #nav_bar > ul > li .nav_tag 
	{
		color: #999999;
		display: block;
		font-size: 11px;
		font-weight: normal;
		line-height: 13px;
	}
    #nav_bar #sub_nav
    {
        position:absolute;
        top:0;
        left:197px;
        width:200px;
		display:none;
		background:#FFF;
		z-index:9999;
		border-right:1px solid #DEDEDE;
    }
	#nav_bar #sub_nav .nav_subcats_div 
	{
		background-color: #EDEDED;
		border-left: 1px solid #DEDEDE;
		border-right: 2px solid #F7F7F7;
		height: 100%;
		left:-1px;
		padding: 0 2px 0 0;
		position: absolute;
		width: 0;
	}
	#sub_nav > ul
	{
		margin-top:5px;
	}
	#sub_nav > ul > li
    {
        margin:0; 
		padding: 0 0 7px;
		line-height: 16px;
		font-size: 13px;
		margin-left:12px;
    }
	#sub_nav > ul > li a:hover
    {
		color: #E47911;
		font-weight:bold;
    }
	
	 #sub_nav > ul > li .nav_tag 
	{
		color: #999999;
		display: block;
		font-size: 11px;
		font-weight: normal;
		line-height: 13px;
	}
	#sub_nav > ul > li a
    {
        color: #333333;
        text-decoration:none;
		font-weight:normal;
    }
	#sub_nav > ul > li.nav_browse_cat_head 
	{
		color: #E47911;
		font-size: 18px;
		margin-bottom: 5px;
		padding-top: 5px;
		overflow: visible;
	}
	#sub_nav #sub_nav_bottom
	{
		position:absolute;
		background:#FFF url(/images/t_bottom.jpg) no-repeat scroll right bottom;
		height: 10px;
		bottom:-10px;
		width:100%;
	}
	#sub_nav #sub_nav_top
	{
		background: url(/images/tem_top1.png) no-repeat scroll right center;
		height: 29px;
		line-height: 24px;
		position:absolute;
		top:-24px;
		width:100%;
	}
</style>
<?
$iCat				=	getValue("iCat");
$iSup				=	getValue("iSup");
$iPri				=	getValue("iPri");
$iData			=	getValue("iData");
$module			=	getValue("module","str","GET","",1,1);
$title			=	translate_display_text("menu_lua_chon");
if($module == "static" || $module == ""){
	 $iCat = 0;
	 $module = "product";
	 //$sqlcategory = '';
}
$sql				=	'';
$sub_ul='';
function showsubmenu($icat= -1,$cat_name){
	global $module;
	global $lang_id;
	global $lang_path;
	global $con_extenstion;
	global $con_mod_rewrite;
	
	$strReturn ='';
	$db_row = new db_query("SELECT cat_name, cat_id, cat_type, cat_order, cat_teaser
							FROM categories_multi
							WHERE cat_parent_id = ".$icat." AND cat_active=1  
							ORDER BY cat_order ASC
							");
	$strReturn .= '<ul>';
	if(mysql_num_rows($db_row->result))
	{
		$strReturn .= '<li class="nav_browse_cat_head">'.$cat_name.'</li>';
		while($row = mysql_fetch_assoc($db_row->result))
		{
			$link_pro = createLink("type",array('module'=>$row["cat_type"],"title"=>$row["cat_name"],"iCat"=>$row["cat_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
			$strReturn .= '<li><a href="'.$link_pro.'">'.$row['cat_name'].'</a>'; 
			$strReturn .= (trim($row['cat_teaser']) != "")?'<div class="nav_tag">'.$row['cat_teaser'].'</div>':'';
			$strReturn .= '</li>';
		}
	}
	$strReturn .= '</ul>';
	return $strReturn;
}
?>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<div class="t_top" style="margin-left:2px;"><div><a href="<?=$lang_path?>type.php?module=product"><?=$title?></a></div></div>
<div id="nav_bar"  style="margin-left:2px;">
    <ul>
	<?
    $db_category=new db_query("SELECT cat_name, cat_id, cat_type, cat_has_child, cat_teaser
                                FROM categories_multi
                                WHERE cat_parent_id =0 AND cat_left = 1 AND cat_active=1  AND cat_type='" . $module . "' AND categories_multi.lang_id = " . $lang_id . "
                                ORDER BY cat_order ASC
                                ");
    $total_category	=	mysql_num_rows($db_category->result);
    $dem = 0;
    while($row = mysql_fetch_assoc($db_category->result))
    {
		$link_pro = createLink("type",array('module'=>$row["cat_type"],"title"=>$row["cat_name"],"iCat"=>$row["cat_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
	?>
        <li><a href="<?=$link_pro?>"><?=$row['cat_name']?></a>
        	<?=(trim($row['cat_teaser']) != "")?'<div class="nav_tag">'.$row['cat_teaser'].'</div>':''?>
        </li>
	<?
		$sub_ul .= showsubmenu($row['cat_id'],$row['cat_name']);
	}
	?>
    </ul>
    <div id="sub_nav">
        <div class="nav_subcats_div"></div>
        <div id="sub_nav_top"><div class="nav_subcats_div" style="height:7px; bottom:0px;"></div>&nbsp;</div>
        <?=$sub_ul?>
        <div id="sub_nav_bottom"><div class="nav_subcats_div" style="height:5px;"></div>&nbsp;</div>
    </div>
</div><!--end #nav_bar-->
<script type="text/javascript">
    $(document).ready(function(){
        
        $('#sub_nav').css('min-height',function(){return $('#nav_bar').outerHeight();});
        $('#nav_bar').mouseover(function(){$('#sub_nav').show(0);}).mouseout(function(){$('#sub_nav').hide(0);});
        $('#sub_nav>ul').hide();
        var $items = $('#nav_bar>ul>li');
        $items.mouseover(function() 
        {
            var index = $items.index($(this));
            $('#sub_nav>ul').hide().eq(index).show();
        });
    })
</script>
<div style="clear:both;">
<div class="t_bottom" style="margin-left:2px;"><div>&nbsp;</div></div>
<?
unset($db_supplier);
unset($db_dongia);
unset($db_category);
?>