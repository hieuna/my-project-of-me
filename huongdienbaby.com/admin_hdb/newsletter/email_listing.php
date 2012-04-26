<?
include("config_security.php");
require_once("../../functions/functions.php");
$fs_title	= "Danh sách email";
$db_listing	= new db_query("SELECT * FROM newsletter");
?>
<html>
<head>
<title><?=$fs_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css">

<? template_top(translate_text("listing_email"))?>
		<? /*---------Body------------*/ ?>
		<?
		$i = 0;
		while($listing = mysql_fetch_array($db_listing->result)){
			$i++;
			echo '<a title="Xóa email này" class="text_link" href="delete_email.php?email=' . $listing["email"] . '&redirect=' . base64_encode(getURL()) . '">' . $listing["name"] . ' &lt;' . $listing["email"] . '&gt;;</a><img src="' . $fs_imagepath . 'delete.png" alt="DELETE" border="0" onClick="if (confirm(\'Are you sure to delete?\')){ window.location.href=\'delete_email.php?email=' . $listing["email"] . '&redirect=' . base64_encode(getURL()) . '\'}" style="cursor:pointer">';
			if($i < mysql_num_rows($db_listing->result)) echo '<br />';
		}
		?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<?
$db_listing->close();
unset($db_listing);
?>