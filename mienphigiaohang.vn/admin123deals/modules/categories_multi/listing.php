<?
require_once ("inc_security.php");

$list = new fsDataGird ( $field_id, $field_name, "Danh sách danh mục sản phẩm" );

$cat_type = getValue ( "cat_type", "str", "GET", "" );
$iCat = getValue ( "iCat" );
if ($cat_type == "")
	$cat_type = getValue ( "cat_type", "str", "POST", "" );
$sql = "1";
if ($cat_type != "")
	$sql = "cat_type = '" . $cat_type . "'";
$menu = new menu ();
$menu->show_count = 1;
$listAll = $menu->getAllChild ( "categories_multi", "cat_id", "cat_parent_id", $iCat, $sql . " AND lang_id = " . $lang_id . $sqlcategory, "cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child,cat_picture,cat_active,admin_id,cat_sea_active", "cat_type ASC,cat_order ASC, cat_name ASC", "cat_has_child" );

$arrayCat = array (0 => translate_text ( "Categories" ) );
$db_cateogry = new db_query ( "SELECT cat_type,cat_name,cat_id
									FROM categories_multi
									WHERE cat_parent_id = 0" );
while ( $row = mysql_fetch_array ( $db_cateogry->result ) ) {
	$arrayCat [$row ["cat_id"]] = $row ["cat_name"];
}

$list->addSearch ( translate_text ( "Loại danh mục" ), "cat_type", "array", $array_value, $cat_type );
$list->addSearch ( translate_text ( "Categories" ), "iCat", "array", $arrayCat, $iCat );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>




</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/?>
<?=

template_top ( translate_text ( "Category listing" ), $list->urlsearch () )?>
	<?
	if (! is_array ( $listAll ))
		$listAll = array ();
	?>
	<table border="1" cellpadding="3" cellspacing="0" class="table"
	width="100%" bordercolor="<?=$fs_border?>">
	<tr>
		<td class="bold bg" width="5" align="center">STT</td>
			<?
			if ($array_config ["image"] == 1) {
				?>
			<td class="bold bg" width="5%" nowrap="nowrap" align="center">Ảnh</td>
			<?
			}
			?>
			<td class="bold bg" align="center">Tên danh mục</td>
			<?
			if ($array_config ["order"] == 1) {
				?>
			<td class="bold bg" align="center">Thứ tự</td>
			<?
			}
			?>
			<td class="bold bg" align="center" width="5">Active</td>
		

		<td class="bold bg" align="center" width="5"><img
			src="<?=$fs_imagepath?>copy.gif" border="0"></td>
		<td class="bold bg" align="center" width="16"><img
			src="<?=$fs_imagepath?>edit.png" border="0" width="16"></td>
		<td class="bold bg" align="center" width="16"><img
			src="<?=$fs_imagepath?>delete.gif" border="0"></td>
	</tr>
	<form action="quickedit.php?returnurl=<?=base64_encode ( getURL () )?>"
		method="post" name="form_listing" id="form_listing"
		enctype="multipart/form-data">
	<input type="hidden" name="iQuick" value="update">	
		<?
		$i = 0;
		$cat_type = '';
		foreach ( $listAll as $key => $row ) {
			$i ++;
			?>
		<?
			if ($cat_type != strtolower ( $row ["cat_type"] )) {
				$cat_type = strtolower ( $row ["cat_type"] );
				?>
			<tr>
		<td colspan="14" align="center" class="bold" bgcolor="#FFFFCC"
			style="color: #FF0000; padding: 6px;"><?=isset ( $array_value [$cat_type] ) ? $array_value [$cat_type] : ''?></td>
	</tr>
		<?
			}
			?>
		<tr <?
			if ($i % 2 == 0)
				echo ' bgcolor="#FAFAFA"';
			?>>
		<td align="center"><strong><?=$i?></strong></td>
			
			<?
			if ($array_config ["image"] == 1) {
				?>
			<td align="center">
				<?
				$path = $fs_filepath . $row ["cat_picture"];
				if ($row ["cat_picture"] != "" && file_exists ( $path )) {
					echo '<a rel="tooltip"  title="<img src=\'' . $fs_filepath . $row ["cat_picture"] . '\' border=\'0\'>" href="#"><img  src="' . $fs_filepath . $row ["cat_picture"] . '"  style="cursor:pointer" width=100%  border=\'0\'></a>';
				
				}
				?>
							
			</td>
			<?
			}
			?>
			<td nowrap="nowrap"><strong><?=$row ["cat_name"];?></strong></td>

		<td align="center"><strong><?=$row ["cat_order"]?></strong></td>
		<td align="center"><a onClick="loadactive(this); return false;"
			href="active.php?record_id=<?=$row ["cat_id"]?>&type=cat_active&value=<?=abs ( $row ["cat_active"] - 1 )?>&url=<?=base64_encode ( getURL () )?>"><img
			border="0"
			src="<?=$fs_imagepath?>check_<?=$row ["cat_active"];?>.gif"
			title="Active!"></a></td>

		

		<td align="center" width="16"><img src="<?=$fs_imagepath?>copy.gif"
			title="<?=translate_text ( "Are you want duplicate record" )?>"
			border="0"
			onClick="if (confirm('<?=translate_text ( "Are you want duplicate record" )?>?')){ window.location.href='copy.php?record_id=<?=$row ["cat_id"]?>&returnurl=<?=base64_encode ( getURL () )?>'}"
			style="cursor: pointer"></td>

		<td align="center" width="16"><a class="text"
			href="edit.php?record_id=<?=$row ["cat_id"]?>&returnurl=<?=base64_encode ( getURL () )?>"><img
			src="<?=$fs_imagepath?>edit.png" alt="EDIT" border="0"></a></td>

		<td align="center"><img src="<?=$fs_imagepath?>delete.gif"
			alt="DELETE" border="0"
			onClick="if (confirm('Are you sure to delete?')){ window.location.href='delete.php?record_id=<?=$row ["cat_id"]?>&returnurl=<?=base64_encode ( getURL () )?>'}"
			style="cursor: pointer"></td>

	</tr>
	
	</form> 
		<?
		}
		?>

		</table>
<?=template_bottom ()?>
<?/*------------------------------------------------------------------------------------------------*/?>
</body>
</html>
