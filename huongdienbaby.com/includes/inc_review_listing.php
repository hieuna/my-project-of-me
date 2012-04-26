<?
$iData=getValue("iData");
$db_review=new db_query("SELECT review.*
								 FROM products,review
								 WHERE pro_id=rev_product AND pro_id=" . $iData . "
								 ORDER BY rev_id DESC LIMIT 20");
?>
<table cellpadding="2" cellspacing="0" width="100%">
<?
$i=0;
while($rev=mysql_fetch_array($db_review->result)){
$i++;
?>
	<tr>
		<td class="text">Đăng bởi : <b><?=$rev["rev_name"]?></b>&nbsp;<font class="date">( <?=date("d/m/Y",$rev["rev_date"]);?> )</font></td>
	</tr>
	<tr>
		<td><div class="text" align="justify"><?=$rev["rev_description"]?></div></td>
	</tr>
	<tr>
		<td class="textBold"><font color="#FF0000">Bình chọn :</font> <script language="javascript">start(<?=$rev["rev_diem"]?>)</script></td>
	</tr>
	<?
	if($i<mysql_num_rows($db_review->result)){
	?>
	<tr>
		<td><hr size="1" color="#CCCCCC" /></td>
	</tr>
	<?
	}
	?>
<?
}
?>
</table>