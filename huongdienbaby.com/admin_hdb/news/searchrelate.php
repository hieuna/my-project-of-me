<? include ("config_security.php"); ?>
<?
$keyword=getValue("keyword","str","GET","",1);
$db_room=new db_query("SELECT * FROM news,categories_multi
								WHERE cat_id=new_category AND new_title LIKE '%" . $keyword . "%'
								ORDER BY new_title ASC");
?>
<select id="list_relate" name="list_relate[]" class="form" multiple="multiple" size="10">
   <?
   $cha_id = 0;
   while($row = mysql_fetch_array($db_room->result)){
   ?>
		<?
		if($cha_id != $rowl["cat_id"]){
			$cha_id	= $rowl["cat_id"];
		?>
		<optgroup label="<?=$rowl["cat_name"]?>"></optgroup>
		<?
		}
		?>
      <option title="<?=$row["new_title"]?>" value="<?=$row["new_id"]?>" ><?=$row["new_title"]?></option>
   <?
   }
   ?>
  </select>
<?
$db_room->close();
unset($db_room);
?>  
