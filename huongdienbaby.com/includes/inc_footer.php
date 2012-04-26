<br clear="all" />
<div class="t_top"><div id="detail"><?=mb_strtoupper(translate_display_text("he_thong_cua_hang_viet_long"),"UTF-8")?></div></div>
	<div class="t_center">
		<div class="description" style="padding:5px;">
		<table width="100%">
		<tr>
		<td width="150px" valign="top" align="left" >
		<? include("inc_visited.php");?>		
		</td>
		<td align="right">
		<? 
			$db_footer = new db_query("SELECT sta_id, sta_title, sta_description FROM statics WHERE sta_id = " . intval($con_static_footer));
			?>
			<? if($footer = mysql_fetch_array($db_footer->result)){?>
				<div class="description"><?=$footer["sta_description"]?></div>
			<? }?>
		</td>
		</tr>
		</table>
 	</div>
	<div align="right" style="color:#CCCCCC">Thiết kế website </a><a href="http://www.finalstyle.com" style="color:#CCCCCC">Finalstyle</a></div>
<script type="text/javascript">

try {

var pageTracker = _gat._getTracker("UA-7385902-1");

pageTracker._trackPageview();

} catch(err) {}</script>
