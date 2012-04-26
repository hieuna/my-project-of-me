<?
require_once("config_security.php");
require_once("../../functions/functions.php");
require_once("../../functions/translate.php");
$array_type = array("Top"=>1,"Center"=>2,"Left"=>3,"Right"=>4,"Scroll left"=>6,"Scroll right"=>7);
$iCat=getValue("iCat");
$type=getValue("iType","str","GET","",1);
$sql="";
?><table cellpadding="0" cellspacing="0">
	<tr>
		<td class="textBold" style="padding-left:3px; padding-right:3px;"><?=translate_text("filter_type_banner");?></td>
		<td>
			<select name="iType" id="iType" onchange="window.location.href='listing.php?iType=' + this.value + '&iCat=<?=$iCat?>';" class="form">
				<option value="">- Set banner in position -</option>
			<?
			foreach($array_type as $value => $key){
				if($key == $type){
					echo "<option value='" . $key . "' selected>" . $value . "</option>";
				}
				else{
					echo "<option value='" . $key . "'>" . $value . "</option>";
				}
			}
			?>
			</select>
		</td>
	</tr>
</table>
