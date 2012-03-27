<?php
require_once("inc_security.php"); 
 
$list = new fsDataGird($field_id,$field_name,"Danh sách");

//**********************Menu Quicksearch                 
//Category
$menu       = new menu();
$listAll    = $menu->getAllChild("categories_multi","cat_id","cat_parent_id","0"," cat_type = 'product' ","cat_id,cat_name,cat_type","cat_type DESC,cat_order ASC, cat_name ASC","cat_has_child");
$iCat       = getValue("iCat");
$arrayCat = array(0=>'--[Danh mục]--');
foreach($listAll as $i=>$cat){
    if($cat["cat_type"]=='product'){
        $tt = '';
        for($j=0;$j<$cat["level"];$j++) $tt .= '--';
        $arrayCat[$cat["cat_id"]] = $tt . $cat["cat_name"];
    }
} 

//Trạng thái
$iActive       = getValue("iActive");
$arrayActive = array(   0 =>"--[Tất cả]--",
                        1 =>"Không kích hoạt",
                        2 =>"Đang kích hoạt"
                        );

//Thời gian
$iTime       = getValue("iTime");
$arrayTime = array(     0 =>"--[Tất cả]--",
                        1 =>"Đã kết thúc",
                        2 =>"Đạng thực hiện",
                        3 =>"Chưa bắt đầu"
                        );

//Keyword
$keyword                = getValue("keyword","str","GET","",1,1);
$sql                    = '';
$mysql                  = new generate_quicksearch(RemoveSign($keyword),"pro_name");

//Show menu Search
$list->addSearch("Tên","keyword","text","");     
$list->addSearch("Category","iCat","array",$arrayCat,$iCat);
$list->addSearch("Trạng thái","iTime","array",$arrayTime,$iTime); 
$list->addSearch("Actice","iActive","array",$arrayActive,$iActive); 
//Ghép Query 
if($keyword!='' && $keyword != translate_text("Enter keyword")){
    $sql   .= $mysql->sql_keyword;
}

if($iCat!=0){
    $sql .=" AND cat_id IN(" . $menu->getAllChildId($iCat) . ")";
}
if($iActive!=0){
    if($iActive==1) $active = 0;
    else $active = 1;
    $sql .= " AND pro_active = ".$active." ";
}
if($iTime!=0){
   if($iTime==1){
        $sqlTime    =   " AND pro_end < ".time();
   }elseif($iTime==2){
        $sqlTime    =   " AND pro_start < ".time()." AND pro_end > ".time()." ";
   }elseif($iTime==3){
        $sqlTime    =   " AND pro_start > ".time()."";
   }else{
       
   }
   $sql .= $sqlTime;
}                      
 
$record_id          = getValue("record_id"); 
// PHẦN PHÂN TRANG.       
$normal_class   = "normal_page";
$selected_class = "selected_page";
$page_prefix    = "Trang: &nbsp;";
$current_page   = getValue("page");
if($current_page<1) $current_page = 1;
$page_size = 10;

$time_display   = 7 * 24 * 60 * 60;
$time_start     = time()  - $time_display;

//$sql .= " AND pro_start > " . $time_start;

$url                = getURL(0,0,1,1,"page");
$total_record       = getValue('total_record');

$query_count_db     = "SELECT COUNT(pro_id) AS count
                       FROM " . $fs_table . ",categories_multi
                       WHERE categories_multi.lang_id = " . $lang_id. " AND cat_id = pro_category_id AND cat_type = 'product' " . $sql;

$db_count           = new db_query($query_count_db);
$listing_count   = mysql_fetch_array($db_count->result);
$total_record    = $listing_count['count'];
$db_count->close();
unset($db_count);

$current_page    = getValue("page", "int", "GET", 1);
if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
else $num_of_page = (int)($total_record / $page_size) + 1;
if($current_page > $num_of_page) $current_page = $num_of_page;
if($current_page < 1) $current_page = 1;


//Query Select
$query_listAll = "SELECT * 
                        FROM " . $fs_table . ",categories_multi
                        WHERE categories_multi.lang_id = " . $lang_id. " AND cat_id = pro_category_id AND cat_type = 'product' " . $sql . 
                       " ORDER BY pro_id DESC
                        LIMIT ".($current_page-1)*$page_size. " , " .$page_size;
//die($query_listAll);
$db_listing    = new db_query($query_listAll);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<script type="text/javascript" language="javascript">
function openWindow(url, wname, width, height) {
window.open(url, wname, "height=" + height + ",width=" + width + "location = 0, status = 1, resizable = 0, scrollbars=1, toolbar = 0");
return true;
}
</script>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top("Danh sách sản phẩm",$list->urlsearch())?>  
    <table border="1" cellpadding="3" cellspacing="0" class="table" width="100%" bordercolor="<?=$fs_border?>">
        <tr>
            <td colspan="10" align="left" style="padding-left:5px" class="break_page">
                <?=generatePageBar_basic($page_prefix,$current_page,$page_size,$total_record,$url,$normal_class,$selected_class);?>                
                <strong style="padding-left:100px">Tổng số: <?=$total_record?> bản ghi</strong>
            </td>    
        </tr>
        <tr style="background:#E7F5F3; font-weight:bold"> 
            <td  width="5"><img src="<?=$fs_imagepath?>no.gif" border="0"></td>
            <td width="5"><img src="<?=$fs_imagepath?>check_all.gif" border="0"></td>
            <td  width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>save.png" border="0"></td>
            <?
            if($array_config["image"]==1){
            ?>
            <td  width="12%" nowrap="nowrap" align="center">Ảnh sản phẩm</td>
            <?
            }
            ?>
            <td  align="center">Tên sản phẩm</td>
            <td  align="center" width="25%">Giá sản phẩm</td>
            <td  align="center" width="20%">TT số lượng</td>
            <td  align="center" width="3%"><img src="<?=$fs_imagepath?>active.gif" border="0" ></td>                
            <td  align="center" width="3%"><img src="<?=$fs_imagepath?>edit.png" border="0" width="16"></td>
            <td  align="center" width="3%"><img src="<?=$fs_imagepath?>delete.gif" border="0"></td>
        </tr>
        <form action="quickedit.php?returnurl=<?=base64_encode(getURL())?>" method="post" name="form_listing" id="form_listing" enctype="multipart/form-data">
        <input type="hidden" name="total_record"  value="<?=$total_record?>" />
        <input type="hidden" name="iQuick" value="update">    
        <?      
        $countno = ($current_page - 1) * $page_size;
        while($row = mysql_fetch_array($db_listing->result)){
            $countno++;
        ?>
        <tr onmouseout="this.style.background='#FEFEFE'" onmouseover="this.style.background='#DDF8CC'">
            <td width="2%" nowrap="nowrap" align="center"><?=$countno?></td>
            <td>
                <input type="checkbox" name="record_id[]" id="record_<?=$countno?>" value="<?=$row["pro_id"]?>">
          </td>
            <td width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>save.png" border="0" style="cursor:pointer" onClick="document.form_listing.submit()" alt="Save"></td>
            <?
            if($array_config["image"]==1){
            ?>
            <td align="center">
                <?
                $path = $fs_img_products . 'normal_' . $row["pro_picture"];
                if($row["pro_picture"] != "" && file_exists($path)){
                    echo '<img  src="' . $path . '"  style="max-width:100px;max-hight:120px" border=\'0\'>';
                    ?>
                    <a href="deletepicture.php?record_id=<?=$row["pro_id"]?>&url=<?=base64_encode(getURL())?>" style="color:#0630F4"><img src="<?=$fs_imagepath?>delete.png" border="0" /></a>
                    <?
                }
                ?>                       
            </td>
            <?
            }
            ?>
            <td nowrap="nowrap"><textarea name="pro_name<?=$row["pro_id"];?>" cols="40" class="form" id="pro_name<?=$row["pro_id"];?>" onkeyup="check_edit('record_<?=$countno?>')"><?=$row["pro_name"];?>
            </textarea>                                         
          </td>
            <td  align="center">
             <table>
                    <tr>
                        <td align="left">Tại Miễn Phí:</td>
                        <td class="textBold" style="color:#F00" width="20px"><?=$row["pro_price_deal"]?></td>
                        <td rowspan="2" valign="middle" align="center" class="textBold" style="font-size:18px">=&gt;<?=$row["pro_discount"]?> %</td>
                    </tr>
                    <tr>
                        <td align="left">Giá Ship:</td>
                        <td class="textBold" style="color:#F00" width="20px"><?=$row["pro_price_merchant"]?></td>
                    </tr>               
              </table>               
            </td>
            <td align="left">
            Số lượng giới hạn: <input type="text"  name="pro_quality<?=$row["pro_id"];?>" id="pro_quality<?=$row["pro_id"];?>" onKeyUp="check_edit('record_<?=$countno?>')" value="<?=$row["pro_quality"];?>" class="form" size="10"><br /><br />
            Số lượng đã bán: <span style="color:#036; font-weight:bold"><?=$row["pro_coupon"];?></span><br /><br /> 
            Số lượng còn lại: <span style="color:#F00; font-weight:bold"><?=$row["pro_quality"] - $row["pro_coupon"];?></span><br /><br />                       	               	
            </td>
            <td align="center"><a onclick="loadactive(this); return false;" href="active.php?record_id=<?=$row["pro_id"]?>&type=pro_active&value=<?=abs($row["pro_active"]-1)?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>check_<?=$row["pro_active"];?>.gif" title="Active!"></a></td>                                                        
            <td align="center" width="16"><a class="text" href="edit.php?record_id=<?=$row["pro_id"]?>&returnurl=<?=base64_encode(getURL())?>"><img src="<?=$fs_imagepath?>edit.png" alt="EDIT" border="0"></a></td>
            <td align="center"><img src="<?=$fs_imagepath?>delete.gif" alt="DELETE" border="0" onClick="if (confirm('Bạn có chắc muốn xóa?')){ window.location.href='delete.php?record_id=<?=$row["pro_id"]?>&returnurl=<?=base64_encode(getURL())?>'}" style="cursor:pointer" /></td>
        </tr>
        <? } ?>
        <tr>
            <td colspan="10" align="left" style="padding-left:5px" class="break_page">
                <?=generatePageBar_basic($page_prefix,$current_page,$page_size,$total_record,$url,$normal_class,$selected_class);?>                
                <strong style="padding-left:100px">Tổng số: <?=$total_record?> bản ghi</strong>
            </td>    
        </tr>
        <tr>
            <td colspan="11">
        <table width="100%" border="0">
             <tr style="background-color: transparent;" class="bold bg">
                <td align="left" width="215">
                   <img style="padding-left:25px" height="18" border="0" align="absmiddle" src="<?=$fs_imagepath?>enter.png" title="Chọn" /><input type="checkbox" name="check_all" id="check_all" onClick="checkall(<?=$total_record?>)">Chọn tất
                </td>
                <td align="left" width="275">
                    <a style="cursor:pointer" onclick="delete_all()"><strong>Xóa tất các lựa chọn! <img border="0" align="absmiddle" src="<?=$fs_imagepath?>uncheck_all.gif" title="Xóa tất các lựa chọn"></strong></a>
                </td>
                <td align="left" colspan="8">
                    <a style="cursor:pointer" onclick="active_all()"><strong>Kích hoạt tất các lựa chọn! <img border="0" align="absmiddle" src="<?=$fs_imagepath?>active_1.gif" title="Kích hoạt tất các lựa chọn"></strong></a>
                </td>
            </tr>
            </table>
            <input type="hidden" name="action_all" id="action_all" value="" />
            </td>
        </tr>
        </form>
        </table>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<script type="text/javascript" language="javascript">
function delete_all(){
	if(confirm('Bạn có muốn xóa tất cả các mục đã chọn')){
		document.getElementById('action_all').value = "del_all";
		document.form_listing.submit();
	}
}

function active_all(){
	if(confirm('Bạn có muốn kích hoạt tất cả các mục đã chọn')){
		document.getElementById('action_all').value = "act_all";
		document.form_listing.submit();
	}
}
</script>
</body>
</html>